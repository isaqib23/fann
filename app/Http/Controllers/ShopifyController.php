<?php

namespace App\Http\Controllers;

use App\Contracts\CampaignTouchPointProductShippmentRepository;
use App\Contracts\CityRepository;
use App\Contracts\CountryRepository;
use App\Contracts\ShopRepository;
use App\Contracts\ShopRepository as ShopRepositoryAlias;
use App\Contracts\StateRepository;
use App\Contracts\UserRepository;
use App\Services\BillingService;
use App\Services\IntegrityService;
use App\Services\ShopifyProductService;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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
     * @var userRepository
     */
    protected $user;

    /**
     * @var countryRepository
     */
    protected $country;

    /**
     * @var stateRepository
     */
    protected $state;

    /**
     * @var cityRepository
     */
    protected $city;

    /**
     * @var productShipmentRepository
     */
    protected $shippment;

    /**
     * ShopifyController constructor.
     * @param ShopRepositoryAlias $shopRepository
     * @param ShopifyProductService $productService
     * @param UserRepository $userRepository
     * @param CountryRepository $countryRepository
     * @param StateRepository $stateRepository
     * @param CityRepository $cityRepository
     * @param CampaignTouchPointProductShippmentRepository $ProductShippmentRepository
     */
    public function __construct(
        ShopRepository $shopRepository,
        ShopifyProductService $productService,
        UserRepository $userRepository,
        CountryRepository $countryRepository,
        StateRepository $stateRepository,
        CityRepository $cityRepository,
        CampaignTouchPointProductShippmentRepository $ProductShippmentRepository
    )
    {
        $this->repository = $shopRepository;
        $this->productService = $productService;
        $this->user = $userRepository;
        $this->country = $countryRepository;
        $this->state = $stateRepository;
        $this->city = $cityRepository;
        $this->shippment = $ProductShippmentRepository;
    }

    /**
     * helper method to perform shopify auth
     *
     * @param $shop
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
        $shopObj = $this->repository->findByField('id', $request->input('shop'))->first();

        $this->productService->setShop($shopObj);

        return response()->json(
            $this->productService->findByInput($request->input('keyword'))
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function findSingleProduct(Request $request)
    {
        $shopObj = $this->repository->findByField('id', $request->input('shop'))->first();

        $this->productService->setShop($shopObj);

        return response()->json(
            $this->productService->findById($request->input('product_id'))
        );
    }

    /**
     * @return
     */
    public function shipProduct()
    {
        $details = [
            'send_by'                => 31,
            'touch_point_id'         => 1061,
            'touch_point_product_id' => 11
        ];
        $user_id = 8;
        $variant_id = 30360911642678;

        $shopObj = $this->repository->findByField('id', 7)->first(); ////SHOP id
        $this->productService->setShop($shopObj);

        $user = $this->user->with(['UserDetail'])->find([$user_id])->first();

        $createdCustomer = $this->productService->createOrFindCustomer($user);
        $createdOrder = $this->productService->createOrder($variant_id, $quantity=1, $createdCustomer[0]);

        $this->shippment->createShippment($createdOrder, $details);

        $order_id = 1941024112694;///outside_order_id
        $fulfillments = $this->productService->tracking($order_id);

        $this->shippment->updateShippment(['fulfillments'=>json_encode($fulfillments)],$order_id);
    }
}
