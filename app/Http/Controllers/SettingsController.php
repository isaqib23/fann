<?php

namespace App\Http\Controllers;

use App\Contracts\UserCreditCardRepository;
use App\Models\UserCreditCard;
use http\Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\SettingsCreateRequest;
use App\Http\Requests\SettingsUpdateRequest;
use App\Contracts\SettingsRepository;
use App\Services\StripeService;
use Illuminate\Http\Response;
use Prettus\Validator\Exceptions\ValidatorException;

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

    /**
     * @var UserCreditCardRepository
     */
    protected $creditCardRepository;

    /**
     * @var StripeService
     */
    protected $stripe;

    /**
     * SettingsController constructor.
     *
     * @param SettingsRepository $repository
     * @param UserCreditCardRepository $creditCardRepository
     */
    public function __construct(
        SettingsRepository $repository,
        UserCreditCardRepository $creditCardRepository
    )
    {
        $this->repository = $repository;
        $this->creditCardRepository = $creditCardRepository;
        $this->stripe = new StripeService();
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $path = public_path() . "/js/cities.json";
        $cities = json_decode(file_get_contents($path), true);

        echo "<pre>";print_r($cities);exit;
        $user = $request->user();

        $cards = $this->creditCardRepository->findByField('user_id',$user->id);

        return response()->json([
            'cards' =>$cards
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {

            $user = $request->user();
            $cardDetails = $request->all();
            $customer = $user->stripe_customer_id;

            // Create Stripe Customer
            if ($user->stripe_customer_id == Null) {
                $customer = $this->makeStripeCustomer($user);
            }

            // Create Stripe Token
            $token = $this->stripe->create_token($cardDetails);
            $card = $this->stripe->create_card($customer,$token->id);

            $request->merge([
                'user_id' => $user->id,
                'card_id' => $card->id,
                'country' => $card->country,
                'funding' => $card->funding,
                'last4' => $card->last4
            ]);
            // Save User Card Details
            $this->creditCardRepository->store($request);

            return response()->json([
                'card' => $card->id
            ]);

        } catch (Exception $e) {

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
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param SettingsUpdateRequest $request
     * @param string $id
     *
     * @return void
     */
    public function update(SettingsUpdateRequest $request, $id)
    {

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {

    }

    /**
     * @param $user
     * @return string
     */
    private function makeStripeCustomer($user): string
    {
        $customer = $this->stripe->create_customer($user);

        // Update User Stripe Customer ID
        $user->stripe_customer_id = $customer;
        $user->save();

        return $customer;
    }
}
