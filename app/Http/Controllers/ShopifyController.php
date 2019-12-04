<?php

namespace App\Http\Controllers;

use App\Contracts\ShopRepository;
use App\Contracts\ShopRepository as ShopRepositoryAlias;
use App\Services\BillingService;
use App\Services\IntegrityService;
use App\Services\ShopifyProductService;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

/**
 * Class ShopifyController
 * @package App\Http\Controllers
 */
class ShopifyController extends Controller
{
    /**
     * @var ShopRepositoryAlias
     */
    protected $repository;

    /**
     * @var ShopifyProductService
     */
    private $productService;

    /**
     * ShopifyController constructor.
     * @param ShopRepositoryAlias $shopRepository
     * @param ShopifyProductService $productService
     */
    public function __construct(
        ShopRepository $shopRepository,
        ShopifyProductService $productService
    )
    {
        $this->repository = $shopRepository;
        $this->productService = $productService;
    }

    /**
     * helper method to perform shopify auth
     *
     * @param                          $shop
     * @param Request $request
     *
     * @return Factory|View
     */
    public function install($shop, Request $request)
    {
        $user = $request->user();
        $shops = $this->repository->findByField('domain',$shop);
        if($shops->count() == 0) {
            $shopify = $this->getShopifyObj($shop, '');
            $permissionURL = $shopify->installURL([
                'permissions' => config('shopify.permissions'),
                'redirect' => route('shopify.auth-callback')
            ]);

            // ----- add state param to personalize the user_id
            $permissionURL .= '&state=' . $user->id;

            return response()->json([
                'status' => true,
                'url' => $permissionURL
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'You have entered shop domain name that already exists in our records.'
        ]);
    }

    /**
     * action for shopify callback URL, to store access token and login the user.
     *
     * @param Request $request
     *
     * @return void
     * @throws Exception
     */
    public function authCallback(Request $request)
    {
        if (isset($_GET['code'])) {
            $shop = $_GET['shop'];
            $code = $_GET['code'];
            $user = $_GET['state'];
            $shopInfo = [];

            $shopify = $this->getShopifyObj($shop, '');
            $accessToken = $shopify->getAccessToken($code);

            $shopify->setup(['ACCESS_TOKEN' => $accessToken]);

            try {
                $shopInfo = $shopify->call(['URL' => 'shop.json', 'METHOD' => 'GET']);

                $this->repository->create([
                    'user_id'   => $user,
                    'domain'    => $shop,
                    'token'     => $accessToken,
                    'name'      => $shopInfo->shop->name
                ]);

                // ----- adding uninstall hook
                $resp = $shopify->call([
                    'METHOD'    => 'POST',
                    'URL'       => '/admin/webhooks.json',
                    'DATA'      => [
                        'webhook' => [
                            'topic'     => 'app/uninstalled',
                            'address'   => route('shopify.uninstall'),
                            'format'    => 'json'
                        ]
                    ]
                ]);
                echo '<script type="text/javascript">window.close();</script>';
            } catch (Exception $e) {
                echo $e->getMessage();
                exit;
            }
        }
    }

    /**
     * Hook method to remove shop from shops table
     * @param Request $request
     * @return void
     */
    public function uninstall(Request $request)
    {
        $shop = $request->input('myshopify_domain');
        try {
            $shop = $this->repository->findByField('domain', $shop)->first();
            if ($shop != null) $shop->delete();
            return response([ 'status' => true], 200);
        } catch (Exception $e) {
            return response([ 'status' => true], 200);
        }
    }

    public function cleanUninstall(Request $request)
    {
        $data = $request->all();
        $shop = $this->repository->find($data['id']);

        /**
         * ----- revoke API Access, this will trigger uninstall webhook
         * ----- which will clean the shop table too
         */
        $client = new Client(['base_uri' => 'https://'.$shop->domain.'/']);
        $response = $client->delete('admin/api_permissions/current.json', [
            'headers' => [
                'Content-Type'              => 'application/json',
                'Accept'                    => 'application/json',
                'Content-Length'            => '0',
                'X-Shopify-Access-Token'    => $shop->token
            ],
            'curl'  => [
                CURLOPT_RETURNTRANSFER => true
            ]
        ]);
        $shop->delete();
        return response([ 'status' => true], 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function linkedShops(Request $request)
    {
        return response()->json($request->user()->shops);
    }

    public function publish(Request $request)
    {
        $products = $request->get('products');
        $shop = $this->repository->find($request->get('shop'));
        $shopify = $this->getShopifyObj($shop->domain, $shop->token);
        $responses = [];

        foreach ($products as $crntProduct) {
            $resp = $shopify->call([
                'METHOD'    => 'POST',
                'URL'       => '/admin/api/2019-07/products.json',
                'DATA'      => [
                    'product' => $crntProduct
                ]
            ]);
            $responses[] = $resp;
            // -----  iterate over variants and attach images
            $productId = $resp->product->id;
            foreach ($resp->product->variants as $variantIndex=>$respVariant) {
                $variantId = $respVariant->id;
                $dataVariant = $crntProduct['variants'][$variantIndex];

                $varResp = $shopify->call([
                    'METHOD'    => 'POST',
                    'URL'       => '/admin/api/2019-07/products/'.$productId.'/images.json',
                    'DATA'      => [
                        'image' => [
                            'variant_ids' => [$variantId],
                            'src' => $dataVariant['images'][0]['src']
                        ]
                    ]
                ]);
            }

            // ----- delete folder and zip ...
            Storage::disk('public')->deleteDirectory($request->user()->id.DIRECTORY_SEPARATOR.$crntProduct['folder']);
            Storage::disk('public_uploads')->delete($request->user()->id.DIRECTORY_SEPARATOR.$crntProduct['folder'].'.zip');
        }

        return response()->json($responses);
    }

    /**
     * @param $title
     * @param Request $request
     * @return mixed
     */
    public function findProducts(Request $request)
    {
        //$shop = $request->get('shop');
        $shopObj = $this->repository->findByField('id', $request->input('shop'))->first();

        $this->productService->setShop($shopObj);

        return response()->json(
            $this->productService->findByInput($request->input('keyword'))
        );
    }

}
