<?php

namespace App\Services;

use App\Contracts\ShopRepository;
use App\Models\Shop;
use Carbon\Carbon;
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
    public function createOrFindCustomer($user)
    {
        $options = [
            'email' => $user->email
        ];

        $found = $this->searchCustomer($options);

        if( $found == null) {
            $resp = $this->createCustomer($user);
            return $resp;
        }

        return $found;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function createCustomer($user)
    {
        $shopify = $this->getShopifyObj($this->shop);
        $data = [
            'customer' => [
                "first_name"    => $user->first_name,
                "last_name"     => $user->last->name ?? '', ////empty string if null
                "email"         => $user->email,
                "addresses"     => [
                    [
                        "address1"      => $user->UserDetail->address ?? '',
                        "city"          => $user->UserDetail ? $this->city->find([$user->UserDetail->city_id])->pluck('name')->first() : '',
                        "country"       => $user->UserDetail ? $this->country->find([$user->UserDetail->country_id])->pluck('name')->first() : '',
                        "phone"         => $user->UserDetail->phone ?? '',
                        "zip"           => $user->UserDetail->zip ?? '',
                        "first_name"    => $user->first_name,
                        "last_name"     => $user->last_name
                    ]
                ],
                "send_email_invite" => true
            ]
        ];
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
            'METHOD'  => 'GET',
        ]);

        return $resp->customers;
    }

    /**
     * @param $product_id
     * @param $customer_id
     * @return mixed
     */
    public function createDiscountRule($product_id, $customer_id)
    {
        $data = [
            "price_rule"    => [
                "title"                 => "100BARTERRULE_".rand(),
                "target_type"           => "line_item",
                "target_selection"      => "entitled",
                "allocation_method"     => "across",
                "value_type"            => "percentage",
                "value"                 => "-15.0",
                "customer_selection"    => "prerequisite",
                "starts_at"             => Carbon::now(),
                "usage_limit"           => 1,
                "entitled_product_ids"  => [
                        $product_id
                    ],
                "prerequisite_customer_ids"=> [
                        $customer_id
                ]
            ]
        ];

        $shopify = $this->getShopifyObj($this->shop);

        $resp = $shopify->call([
            'URL'   => '/admin/price_rules.json',
            'METHOD'=> 'POST',
            'DATA'  => $data
        ]);
//        dd($resp,"rule");
        return $this->createDiscountCode($resp->price_rule->id);
    }

    /**
     * @param $rule_id
     * @return mixed
     */
    public function createDiscountCode($rule_id)
    {
        $data = [
            "discount_code" => [
                "code" => "100BARTERCODE_".rand()
            ]
        ];
        $shopify = $this->getShopifyObj($this->shop);
        $resp = $shopify->call([
            'URL'   => '/admin/price_rules/'.$rule_id.'/discount_codes.json',
            'METHOD'=> 'POST',
            'DATA'  => $data
        ]);

        return $resp->discount_code;
    }

    /**
     * @param $variant_id
     * @param $quantity
     * @param $customer
     * @return mixed
     */
    public function createOrder($variant_id, $quantity, $customer)
    {
        $data = [
            'order' => [
                "customer" => [
                    "id" => $customer->id
                ],
                //"send_fulfillment_receipt"=>true,
                "requires_shipping" => true,
                "line_items" => [
                    [
                        'variant_id' => $variant_id,
                        'quantity'   => $quantity,
                        "taxable"    => false,
                    ]
                ],
                "discount_codes" => [
                    [
                        "code"      => "100BARTERCODE",
                        "amount"    => "100.0",
                        "type"      => "percentage"
                    ]
                ],
                "shipping_address" => $customer->addresses[0],
                "tax_lines" => [
                    [
                        "price" => 00.00,
                        "rate"  => 0.00,
                        "title" => "Tax Free"
                    ]
                ],
                "shipping_lines" => [
                    [
                        "title"              => "Free Shipping",
                        "price"              => "0.00",
                        "code"               => "Free Shipping",
                        "source"             => "shopify",
                        "carrier_identifier" => null,
                        "discounted_price"   => "0.00",
                        "tax_lines"          => [],
                        "price_set"          => [
                            "shop_money"     => [
                                "amount"            => "0.00",
                                "currency_code"     => "USD"
                            ],
                            "presentment_money"=> [
                                "amount"            => "0.00",
                                "currency_code"     => "USD"
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $shopify = $this->getShopifyObj($this->shop);
        $resp = $shopify->call([
            'URL'       => '/admin/orders.json',
            'METHOD'    => 'POST',
            'DATA'      => $data
        ]);
        return $resp->order;
    }

    /**
     * @param $order_id
     * @return mixed
     */
    public function tracking($order_id)
    {
        $shopify = $this->getShopifyObj($this->shop);
        $resp = $shopify->call([
            'URL' => '/admin/orders/'.$order_id.'/fulfillments.json',
            'METHOD' => 'GET'
        ]);
        return $resp->fulfillments;
    }
}
