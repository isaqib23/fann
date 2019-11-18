<?php

namespace App\Services;

use App\Contracts\ShopRepository;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Traits\ShopifyTrait;
use GuzzleHttp\Client;
use PhpParser\Parser;
use Psr\Http\Message\ResponseInterface;

class ShopifyProductService
{
    use ShopifyTrait;

    /**
     * @var Shop
     */
    private $shop;

    /**
     * @param Shop $shop
     */
    public function setShop(Shop $shop) {
        $this->shop = $shop;
    }

    /**
     * @param $input
     * @return mixed
     */
    public function findByInput($input)
    {
        $shopify = $this->getShopifyObj($this->shop);

        if (ctype_digit($input)) {
            $options = [
                'limit' => 10,
                'fields' => 'id,title,variants,images,image,handle',
                'ids' => $input
            ];
        } else {
            $options = [
                'limit' => 10,
                'fields' => 'id,title,variants,images,image,handle',
                'title' => $input
            ];
        }

        $resp = $shopify->call([
            'URL' => '/admin/products.json?' . urldecode(http_build_query($options)),
            'METHOD' => 'GET'
        ]);

        return $resp->products;
    }

    public function prepEventData(Request $request)
    {
        if (!$request->has('ids')) return [];

        $productIds = $request->get('ids');
        $shopify = $this->getShopifyObj($this->shop);
        $options = [
            'limit'     => 10,
            'fields'    => 'id,title,variants,tags,product_type',
            'ids'       => join(',', array_keys($productIds))
        ];

        $resp = $shopify->call([
            'URL' => '/admin/products.json?'.urldecode(http_build_query($options)),
            'METHOD' => 'GET'
        ]);


        $products = [];
        foreach ($resp->products as $product) {
            $variants = [];
            $targetVariantIds = explode(',', $productIds[$product->id]);

            foreach ($product->variants as $variant) {
                if (in_array($variant->id, $targetVariantIds)) {
                    $variants[(string)$variant->id] = [
                        'title' => $variant->title
                    ];
                }
            }

            $products[(string)$product->id] = [
                'title'     => $product->title,
                'tags'      => explode(', ', $product->tags),
                'variants'  => $variants,
                'type'      => $product->product_type
            ];

        }

        $settings = $this->shop->settings->transform();
        $settings['shop'] = $this->shop->name;
        $settings['shop_id'] = $this->shop->id;
        $settings['baseURL'] = env('APP_URL');
        if(env('MONGO_LOGGING')) $settings['logging'] = true;

        return [
            'products'  => $products,
            'options'   => $request->all(),
            'pixels'    => $this->shop->pixels,
            'config'  => $settings
        ];
    }


}
