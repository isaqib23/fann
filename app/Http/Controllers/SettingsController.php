<?php

namespace App\Http\Controllers;

use App\Contracts\NicheRepository;
use App\Contracts\UserCreditCardRepository;
use http\Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\SettingsUpdateRequest;
use App\Contracts\SettingsRepository;
use App\Services\StripeService;
use Illuminate\Http\Response;

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
     * @var NicheRepository
     */
    private $nicheRepository;

    /**
     * SettingsController constructor.
     *
     * @param SettingsRepository $repository
     * @param UserCreditCardRepository $creditCardRepository
     * @param NicheRepository $nicheRepository
     */
    public function __construct(
        SettingsRepository $repository,
        UserCreditCardRepository $creditCardRepository,
        NicheRepository $nicheRepository
    )
    {
        $this->repository = $repository;
        $this->creditCardRepository = $creditCardRepository;
        $this->stripe = new StripeService();
        $this->nicheRepository = $nicheRepository;
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    {
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
     * @param Request $request
     * @return void
     */
    public function getNiches(Request $request)
    {
        $niches = $this->nicheRepository->all(['id', 'name']);

        return response()->json([
            'details' => $niches
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show()
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

    /**
     * @param Request $request
     * @return string
     */

    public function addFundsToStripe(Request $request)
    {
        $user = auth()->user();

        $request->merge([
            'user_id'       => $user->id,
            'customer_id'   => $user->stripe_customer_id,
            'card_id'   => $user->UserCard->card_id,
            'first_name'    => $user->first_name,
            'email'         => $user->email
        ]);

        $charge = $this->stripe->make_charge($request);

        return response()->json([
        'details' => $charge
    ]);;
    }
}
