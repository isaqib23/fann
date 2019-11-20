<?php
namespace App\vendor\stripe\stripe_php\init;
namespace App\Services;

use Exception;
use Illuminate\Http\JsonResponse;

/**
 * Class YoutubeService
 * @package App\Services
 */
class StripeService
{

    protected $stripeSettings;
    /**
     * StripeService constructor.
     */
    public function __construct()
    {
        $this->stripeSettings = $this->get_stripe_settings();
    }

    public function get_stripe_settings(){
        $mode = config('services.stripe.mode');
        $settings = new \stdClass();
        if($mode == 'sandbox') {
            $settings->secret = config('services.stripe.sandbox.secret');
            $settings->publish = config('services.stripe.sandbox.publish');
            $settings->currency = config('services.stripe.currency');
            $settings->client_id = config('services.stripe.sandbox.client_id');
            $settings->api_version = config('services.stripe.api_version');
            $settings->mode = 'sandbox';

            return $settings;
        }

        $settings->secret = config('services.stripe.production.secret');
        $settings->publish = config('services.stripe.production.publish');
        $settings->currency = config('services.stripe.currency');
        $settings->client_id = config('services.stripe.production.client_id');
        $settings->api_version = config('services.stripe.api_version');

        return $settings;
    }

    public function create_customer($user){
        \Stripe\Stripe::setApiKey($this->stripeSettings->secret);

        $customer = \Stripe\Customer::create([
            'description'   => 'Customer for '.$user->email,
            'email'         => $user->email,
            'name'         => $user->name
        ]);

        return $customer->id;
    }

    public function create_card($customer,$token){
        \Stripe\Stripe::setApiKey($this->stripeSettings->secret);

        $card = \Stripe\Customer::createSource(
            $customer,
            [
                'source' => $token,
            ]
        );

        return $card;
    }

    public function make_charge($request){
        \Stripe\Stripe::setApiKey($this->stripeSettings->secret);

        $charge = \Stripe\Charge::create([
            'amount' => \bcmul($request->input('payment'), 100),
            'currency' => 'usd',
            'customer' => $request->input('customer_id'),
            'source' => $request->input('card_id'),
            'description' => 'Funds from '.$request->input('first_name').' ('.$request->input('email').')',
        ]);

        return $charge->id;
    }

    public function create_token($card){
        \Stripe\Stripe::setApiKey($this->stripeSettings->secret);
        $token = \Stripe\Token::create([
            'card' => [
                'number' => trim($card['number']),
                'exp_month' => $card['expMonth'],
                'exp_year' => $card['expYear'],
                'cvc' => $card['cvc'],
            ],
        ]);

        return $token;
    }
}
