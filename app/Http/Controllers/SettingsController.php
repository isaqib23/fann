<?php

namespace App\Http\Controllers;

use App\Models\UserCreditCard;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\SettingsCreateRequest;
use App\Http\Requests\SettingsUpdateRequest;
use App\Contracts\SettingsRepository;
use App\Services\StripeService;
/**
 * Class SettingsController.
 *
 * @package namespace App\Http\Controllers;
 */
class SettingsController extends Controller
{
    /**
     * @var SettingsRepository
     */
    protected $repository;
    protected $stripe;

    /**
     * SettingsController constructor.
     *
     * @param SettingsRepository $repository
     * @param SettingsValidator $validator
     */
    public function __construct(SettingsRepository $repository)
    {
        $this->repository = $repository;
        $this->stripe = new StripeService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $userCreditCard = new UserCreditCard();

        $cards = $userCreditCard->where('user_id',$user->id)->get();

        return response()->json([
            'card' => $cards,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SettingsCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(SettingsCreateRequest $request)
    {
        try {

            $user = $request->user();
            $cardDetails = $request->all();
            $customer = $user->stripe_customer_id;

            // Create Stripe Customer
            if($user->stripe_customer_id == Null){
                $customer = $this->stripe->create_customer($user);

                // Update User Stripe Customer ID
                $user->stripe_customer_id = $customer;
                $user->save();
            }

            // Create Stripe Token
            $token = $this->stripe->create_token($cardDetails);
            $card = $this->stripe->create_card($customer,$token->id);


            // Save User Card Details
            UserCreditCard::create([
                'user_id'   => $user->id,
                'card_id'   => $card->id,
                'brand'     => $card->brand,
                'country'   => $card->country,
                'exp_month' => $card->exp_month,
                'exp_year'  => $card->exp_year,
                'funding'   => $card->funding,
                'last4'     => $card->last4,
            ]);

            return response()->json([
                'card' => $card->id,
            ]);
        } catch (ValidatorException $e) {
            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SettingsUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(SettingsUpdateRequest $request, $id)
    {

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
