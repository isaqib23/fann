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

    /**
     * @param Request $request
     * @return array
     */
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

    /**
     * @param $input
     * @return mixed
     */
    public function findById($input)
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
            'URL' => '/admin/products/'.$input.'.json?' . urldecode(http_build_query($options)),
            'METHOD' => 'GET'
        ]);

        return $resp->product;
    }

    /**
     * @param $user
     * @param $data
     * @return mixed
     */
    public function createOrFindCustomer($user,$data)
    {
        $options = [
            'email' => $user->email
        ];

        $found = $this->searchCustomer($options);

        if( $found == null) {
            $resp = $this->createCustomer($data);
            return $resp;
        }

        return $found;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function createCustomer($data)
    {
        $shopify = $this->getShopifyObj($this->shop);
        $resp = $shopify->call([
            'URL'   => '/admin/customers.json',
            'METHOD'=> 'POST',
            'DATA'  => $data
        ]);
        return $resp->customer;
    }

    /**
     * @param $fields
     * @return mixed
     */
    public function searchCustomer($options)
    {
        $shopify = $this->getShopifyObj($this->shop);
        $resp = $shopify->call([
            'URL'     => '/admin/customers/search.json?'.urldecode(http_build_query($options)),
            'METHOD' => 'GET',
        ]);

        return $resp->customers;
    }

    /**
     * @return mixed
     */
    public function allCustomers()
    {
        $shopify = $this->getShopifyObj($this->shop);
        $resp = $shopify->call([
            'URL'     => '/admin/customers.json',
            'METHOD' => 'GET',
        ]);
        return $resp->customers;
    }
    public function createRule($product_id, $customer_id)
    {
//        dd($customer_id);
//        dd($product_id);
        $shopify = $this->getShopifyObj($this->shop);
        dd($shopify);
        /////
        $data = [
            'price_rule' => [
                'title'                      => '100OFF',
                'target_type'                => 'line_item',
                'target_selection'           => 'entitled',
                'allocation_method'          => 'across',
                'customer_selection'         => 'all',
                'value_type'                 => 'percentage',
                'value'                      => '-10.0',
//                'prerequisite_customer_ids'  => [
//                    $customer_id
//                ],
                'entitled_product_ids'   => [
                    $product_id
                ],
//                'prerequisite_quantity_range' => [
//                    'greater_than_or_equal_to' => 1
//                ],
//                'prerequisite_subtotal_range' => [
//                    'greater_than_or_equal_to' => '00.0'
//                ],
////                'once_per_customer'          => true,
//                "usage_limit"                => 1,
            ]
        ];
//        dd($data);

        $resp = $shopify->call([
            'URL'   => '/admin/price_rules.json',
            'METHOD'=> 'POST',
            'DATA'  => $data
        ]);

        dd($resp);
    }

    public function createOrder($variant_id,$quantity)
    {
        $data = [
           'order' => [
                'line_items' => [
                    'title' => 'Big Brown Bear Boots',
                    'variant_id' => $variant_id,
                    'quantity'   => $quantity
                ]
            ]
        ];
        $shopify = $this->getShopifyObj($this->shop);
        $resp = $shopify->call([
            'URL'       => '/admin/orders.json',
            'METHOD'    => 'POST',
            'DATA'      => $data
        ]);
        dd($resp);
    }
}
