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
        //$data = \DB::table('organisations')->get();

        $organisation = '[{"id":1,"name":"Employee Update Sessions","description":"Test organisation created for attendoplus.com.","image":"5af15b46289f5.jpg","website":"","address":"Melbourne, Australia","phone":"1300430800","user_id":0,"status":"active","created_at":null,"updated_at":null},{"id":2,"name":"ACME Health and Safety Session","description":"An organisation formed with Roadrunner corporation.","image":"5af1543e6bdb4.jpg","website":"","address":"Perth, Australia","phone":"0220879376","user_id":0,"status":"active","created_at":null,"updated_at":null},{"id":3,"name":"The Shareholders Club","description":"This is a test organisation created by Attendoplus to demonstrate that the app can be used by any number of organisations. ","image":"5af3c3b24374e.jpg","website":"","address":"Brisbane, Australia","phone":"1300430800","user_id":0,"status":"active","created_at":null,"updated_at":null},{"id":4,"name":"Australian and New Zealand Society of Nuclear Medicine (ANZSNM)","description":"The one society for all nuclear medicine professionals","image":"5af151615ee7c.jpg","website":"","address":"Australia","phone":"1300330402","user_id":0,"status":"active","created_at":null,"updated_at":null},{"id":5,"name":"Australasian Beach Association","description":"Life\'s a beach but there is more to life than a beach. A beach represents tranquility and biodiversity.","image":"5af155bdccc35.jpg","website":"","address":"Gold Coast, Australia","phone":"1300430800","user_id":0,"status":"active","created_at":null,"updated_at":null},{"id":6,"name":"Drajon Management","description":"This is the test area to bring people from Attendo to Attendo plus.","image":"5af2b94b2b481.jpg","website":"","address":"Darwin, Australia","phone":"130430800","user_id":0,"status":"active","created_at":null,"updated_at":null},{"id":7,"name":"Australasian Association of Clinical Biochemists","description":"The AACB is the major professional society for practicing clinical biochemists in Australia and New Zealand and is a full member of the International Federation of Clinical Chemistry and Laboratory Medicine (IFCC) and Asia-Pacific Federation for Clinical ","image":"5af3c2aaedcef.jpg","website":"","address":"Sydney,  Australia","phone":"02296696600","user_id":0,"status":"active","created_at":null,"updated_at":null},{"id":8,"name":"AANMS  Australasian Association of Nuclear Medicine Specialists","description":"The AANMS (Australasian Association of Nuclear Medicine Specialists ) is the peak body representing nuclear medicine and molecular imaging in Australia and New Zealand. The Association was formerly known as the Australian and New Zealand Association of Ph","image":"5af152bad972e.jpg","website":"","address":"Sydney, Australia","phone":"0220879376","user_id":0,"status":"active","created_at":null,"updated_at":null},{"id":9,"name":"ASA  Australasian Sonographers Association","description":"The Australasian Sonographers Association (ASA) is the peak body and leading voice for sonographers in Australia and New Zealand. Established by the Victorian Ultrasonographers Group in 1992, the Assocation has since gone from strength to strength. The AS","image":"5af3c45fb02ef.jpg","website":"","address":"Melbourne, Australia","phone":"0395520000","user_id":0,"status":"active","created_at":null,"updated_at":null},{"id":10,"name":"AIMS Australian Institute of Medical Scientists","description":"We are a not for profit national membership body for Medical Science and pleased to follow up on requests in writing or via the email address below as it relates to the benefits of joining AIMS, or for information on any of our member or stakeholder servi","image":"5af1536cadf7b.jpg","website":"","address":"Brisbane, Australia","phone":"0738762988","user_id":0,"status":"active","created_at":null,"updated_at":null},{"id":11,"name":"Australian Society of Medical Imaging and Radiation Therapy (ASMIRT )","description":"The Australian Society of Medical Imaging and Radiation Therapy is the peak body representing medical radiation practitioners in Australia.  Our mission is to empower medical radiation practitioners for the health of all Australians.\r\nThe members of the S","image":"5af1554d35047.jpg","website":"","address":"Melbourne, Australia","phone":"0394193336","user_id":0,"status":"active","created_at":null,"updated_at":null},{"id":12,"name":"HGSA  Human Genetics Society of Australasia","description":"The Human Genetics Society of Australasia was formed in 1977 to provide a forum for the various disciplines collected under the title of Human Genetics. The HGSA is a full member of the International Federation of Human Genetics Societies and domestically","image":"5af1584b02cc9.jpg","website":"","address":"Sydney, Australia","phone":"0296696602","user_id":0,"status":"active","created_at":null,"updated_at":null},{"id":13,"name":"NSWNMS New South Wales Society of Nuclear Medicine","description":"NSWSNMS Goals &amp; Objectives: \r\nTo represent the interests of Nuclear Medicine Scientists within New South Wales.\r\nTo promote the advancement of Nuclear case study analysis paper Medicine for NMS professionally, educationally and industrially within the","image":"5af1579ac7f1c.jpg","website":"","address":"Sydney, Australia","phone":"0242534100","user_id":0,"status":"active","created_at":null,"updated_at":null},{"id":14,"name":"RAINS Rural Alliance in Nuclear Scintigraphy","description":"The purpose of RAINS is to offer a support network for rural and remote Nuclear Medicine professionals. The network aims to engage with and develop strategies to overcome the unique professional difficulties encountered in rural and remote Australia. RAIN","image":"5af3c4ae450cf.jpg","website":"","address":"NSW, Australia","phone":"00000000000","user_id":0,"status":"active","created_at":null,"updated_at":null},{"id":15,"name":"Victorian Society of Nuclear Medicine Technologists VSNMT ","description":"The VSNMT is an organisation representing the interests of nuclear medicine technologists. Nuclear medicine technologists are university trained health professionals and are an integral part of the medical community. They work in partnership with medical ","image":"5af156c508b91.jpg","website":"","address":"Melbourne, Australia","phone":"0394172773","user_id":0,"status":"active","created_at":null,"updated_at":null},{"id":16,"name":"RCPA Test","description":"Test organization created named National for My CPD App","image":"","website":"www.ifisol.com","address":"Brisbane, Australlia","phone":"0220879376","user_id":0,"status":"pending","created_at":null,"updated_at":null},{"id":17,"name":"RCPA [test]","description":"Test organization created named National for My CPD App","image":"","website":"www.ifisol.com","address":"Brisbane, Australlia","phone":"0220879376","user_id":0,"status":"pending","created_at":null,"updated_at":null},{"id":18,"name":"Passionate Connections","description":"Test organisation created named National for My CPD App.","image":"5af3c599b8a50.jpg","website":"","address":"Sydney Australia","phone":"1300430800","user_id":0,"status":"active","created_at":null,"updated_at":null},{"id":19,"name":"ABC Club","description":"Test organization created named National for My CPD App","image":"5af3c41dc5c31.jpg","website":"","address":"Adelaide, Australia","phone":"0220879376","user_id":0,"status":"active","created_at":null,"updated_at":null},{"id":20,"name":"Testing Pty Ltd","description":"Test organization created named National for My CPD App","image":"","website":"www.ifisol.com","address":"Brisbane, Australlia","phone":"0220879376","user_id":0,"status":"pending","created_at":null,"updated_at":null},{"id":21,"name":"Tesla Physics Society","description":"We are fans of Nicola Tesla and our club is dedicated to his science. We are still working on a website so thought to send you to something you know.","image":"5af3c65e13b30.jpg","website":"","address":"Auckland, New Zealand","phone":"0220879376","user_id":0,"status":"active","created_at":null,"updated_at":null},{"id":22,"name":"Leading Edge Leadership","description":"Test organization created named National  ","image":"5af3c53fa3210.jpg","website":"","address":"Adelaide, Australia","phone":"0220879376","user_id":0,"status":"active","created_at":null,"updated_at":null},{"id":23,"name":"Juniordewcrew Malaysia dumc","description":"This is a working group for hard working Malaysians.","image":"5af15b002dc5f.jpg","website":"","address":"Kuala Lumpur, Malaysia","phone":"1300430800","user_id":0,"status":"active","created_at":null,"updated_at":null},{"id":24,"name":"Testing","description":"Test organization created named National for Attendo Plus CPD App.","image":"5af3c309e8173.jpg","website":"","address":"Kuala Lumpur, Malaysia","phone":"0220879376","user_id":0,"status":"active","created_at":null,"updated_at":null},{"id":25,"name":"Royal Darwin Hospital","description":"Test organization created named National for My CPD App","image":"","website":"www.ifisol.com","address":"Brisbane, Australlia","phone":"0220879376","user_id":0,"status":"pending","created_at":null,"updated_at":null},{"id":26,"name":"Test Organisation","description":"This is a test organisation which hopefully will be deleted if things go well. ","image":"5aaa3a649aaf0.jpg","website":"www.ifisol.com","address":"C-03.","phone":"03335063763","user_id":0,"status":"pending","created_at":null,"updated_at":null},{"id":27,"name":"EIBC","description":"This is a test organisation","image":"5aaf55aabc7e1.jpg","website":"","address":"TO Delete","phone":"03335063763","user_id":1312,"status":"pending","created_at":null,"updated_at":null},{"id":28,"name":"Drajon Management Testing","description":"The land of the Long White Cloud","image":"5af2b98602851.jpg","website":"","address":"Auckland, New Zealand","phone":"1300430800","user_id":0,"status":"active","created_at":null,"updated_at":null},{"id":29,"name":"EIBC","description":"The EIBC is a brand new high tech facility located in Melbourne\'s eastern suburbs providing flexible working options for low-cost business development and growth.","image":"5af15ac17c287.jpg","website":"","address":"5A Hartnett Close, Mulgrave","phone":"1300462822","user_id":1313,"status":"active","created_at":null,"updated_at":null},{"id":30,"name":"Bendigo Health ICU","description":"Bendigo Health","image":"5b44593dc7a21.jpg","website":"","address":"Bendigo","phone":"1300500402","user_id":0,"status":"active","created_at":null,"updated_at":null},{"id":31,"name":"Manawanui In Charge","description":"Manawanui is the pioneer and leading facilitator of Self-Directed Funding in New Zealand.","image":"5b57eeed2050c.jpg","website":"www.manawanui.org.nz","address":"Parkhead Place, Rosedale, Auckland New Zealand","phone":"0220879376","user_id":0,"status":"active","created_at":null,"updated_at":null},{"id":32,"name":"Pindi Boys","description":"pindi boys ","image":"5b5afc875bbdb.jpg","website":"www.facebook.com","address":"Tarlai Kalan, Islamabad Capital Territory, Pakistan","phone":"3338075042","user_id":0,"status":"active","created_at":null,"updated_at":null},{"id":33,"name":"Meeting","description":"This organization is only for meeting events","image":"c20540f4a72e935fde9b75172ca8b948.jpg","website":"www.google.com","address":"Ted Northe Ln, Vancouver, BC V6E 1H1, Canada","phone":"3331234567","user_id":1589,"status":"pending","created_at":null,"updated_at":null},{"id":34,"name":"Meeting Organisation","description":"This is the personal Organisation for meeting Events","image":"25dfcea55d601dc00777588bbcd61d52.jpg","website":"www.google.com","address":"Ted Northe Ln, Vancouver, BC V6E 1H1, Canada","phone":"3331234567","user_id":1590,"status":"active","created_at":null,"updated_at":null},{"id":35,"name":"Scrum","description":"testing","image":"919450ee2724fb9639029b7cb97cb5a0.jpg","website":"www.google.com","address":"New Zealand","phone":"03457645677","user_id":1592,"status":"active","created_at":null,"updated_at":null}]';


        //return response()->json($data);
        echo "<pre>";print_r(json_decode($organisation));exit;
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
