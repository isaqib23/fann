<?php

namespace App\Http\Controllers;


use App\Contracts\CampaignAssignedJobDetailRepository;
use App\Contracts\CampaignAssignedJobRepository;
use App\Contracts\CampaignInviteRepository;
use App\Contracts\CampaignOfferRepository;
use App\Contracts\CampaignPaymentRepository;
use App\Contracts\CampaignTouchPointRepository;
use App\Contracts\PlacementRepository;
use App\Http\Requests\TouchPointRequest;
use App\Models\CampaignAssignedJobDetail;
use http\Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CampaignUpdateRequest;
use App\Contracts\CampaignRepository;
use App\Validators\CampaignValidator;
use App\Contracts\CampaignObjectiveRepository;
use Prettus\Validator\LaravelValidator;

/**
 * Class CampaignsController.
 *
 * @package namespace App\Http\Controllers;
 */

class CampaignsController extends Controller
{
    /**
     * @var CampaignRepository
     */
    protected $repository;

    /**
     * @var LaravelValidator
     */

    protected $validator;

    /**
     * @var CampaignObjectiveRepository
     */

    protected $campaignObjectiveRepository;

    /**
     * @var PlacementRepository
     */

    private $placementRepository;

    /**
     * @var CampaignTouchPointRepository
     */

    private $campaignTouchPointRepository;

    /**
     * @var CampaignPaymentRepository
     */

    private $campaignPaymentRepository;

    /**
     * @var CampaignInviteRepository
     */

    private $campaignInviteRepository;
    /**
     * @var CampaignAssignedJobDetailRepository
     */
    private $campaignAssignedJobDetailsRepository;
    /**
     * @var CampaignAssignedJobRepository
     */
    private $campaignAssignedJobRepository;


    /**
     * CampaignsController constructor.
     *
     * @param CampaignRepository $repository
     * @param CampaignObjectiveRepository $campaignObjectiveRepository
     * @param PlacementRepository $placementRepository
     * @param CampaignTouchPointRepository $campaignTouchPointRepository
     * @param CampaignPaymentRepository $campaignPaymentRepository
     * @param LaravelValidator $validator
     * @param CampaignInviteRepository $campaignInviteRepository
     * @param CampaignAssignedJobDetailRepository $campaignAssignedJobDetailsRepository
     * @param CampaignAssignedJobRepository $campaignAssignedJobRepository
     */

    public function __construct(
        CampaignRepository $repository,
        CampaignObjectiveRepository $campaignObjectiveRepository,
        PlacementRepository $placementRepository,
        CampaignTouchPointRepository $campaignTouchPointRepository,
        CampaignPaymentRepository $campaignPaymentRepository,
        LaravelValidator $validator,
        CampaignInviteRepository $campaignInviteRepository,
        CampaignAssignedJobDetailRepository $campaignAssignedJobDetailsRepository,
        CampaignAssignedJobRepository $campaignAssignedJobRepository
    )
    {
        $this->repository = $repository;
        $this->campaignObjectiveRepository = $campaignObjectiveRepository;
        $this->placementRepository = $placementRepository;
        $this->campaignTouchPointRepository = $campaignTouchPointRepository;
        $this->campaignPaymentRepository = $campaignPaymentRepository;
        $this->validator = $validator;
        $this->campaignInviteRepository = $campaignInviteRepository;
        $this->campaignAssignedJobDetailsRepository = $campaignAssignedJobDetailsRepository;
        $this->campaignAssignedJobRepository = $campaignAssignedJobRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $campaigns = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $campaigns,
            ]);
        }

        return view('campaigns.index', compact('campaigns'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function store(Request $request)
    {
        try {

           // $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $campaign = $this->repository->store($request->all());

            $response = [
                'message' => 'Campaign created.',
                'details'    => $campaign->toArray(),
            ];

            if ($request->wantsJson()) {
                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (Exception $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
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
        $campaign = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $campaign,
            ]);
        }

        return view('campaigns.show', compact('campaign'));
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
        $campaign = $this->repository->find($id);

        return view('campaigns.edit', compact('campaign'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CampaignUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws ValidatorException
     */
    public function update(CampaignUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $campaign = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Campaign updated.',
                'data'    => $campaign->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
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
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Campaign deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Campaign deleted.');
    }

    /**
     * @return JsonResponse
     */
    public function getCampaignObjectives()
    {
        $objectives = $this->campaignObjectiveRepository->synthObjectiveAlongWithCategory();
        return response()->json([
            'details' => $objectives,

        ]);
    }

    /**
     * @return JsonResponse
     */
    public function getAllPlacements()
    {
        $placements =  $this->placementRepository->all(['id', 'name', 'slug', 'image']);

        return response()->json([
            'details' => $placements
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function savePlacementAndPaymentType(Request $request)
    {
        $data = $request->all();

        $this->repository->update(
            [ 'primary_placement_id' => $data['platform']],
            $data['campaign_id']
        );


        $data = [
            'campaign_id'       => $data['campaign_id'],
            'payment_type_id'   => ($data['paymentType'] == 'barter') ? 2 : 1,
            'is_primary'        => ($data['paymentType'] == 'barter') ? $data['additionalPayAsAmount'] : $data['additionalPayAsBarter']
        ];

        $objective = $this->campaignPaymentRepository->store($data);

        return response()->json([
            'details'   => $objective,
        ]);
    }

    /**
     * @param TouchPointRequest $request
     * @return JsonResponse|RedirectResponse
     */
    public function saveTouchPoint(TouchPointRequest $request)
    {
        try {
            $data = $request->all();

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $saveTouchPoint = $this->campaignTouchPointRepository->saveInHierarchy($data);

            // Get Last added Touch Point
            $request->merge(['slug' => $request->input('campaignInformation.slug')]);
            $savedTouchPoint = $this->repository->getCampaignTouchPointWithPresenter($request);

            $response = [
                'message' => 'Touch Point Created.',
                'details' => $savedTouchPoint,
                'touch_point_id' => $saveTouchPoint->id,
            ];

            return response()->json($response);

        } catch (ValidatorException $e) {
            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function saveInvitation(Request $request)
    {
        $response = $this->campaignInviteRepository->store($request);

        return response()->json([
            'details' => $response
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getCampaignTouchPoint(Request $request)
    {
        $campaign = $this->repository->getCampaignTouchPointWithPresenter($request);

        return response()->json([
            'details' => $campaign
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getCampaignSavedObjective(Request $request)
    {
        $objective = $this->repository->getCampaignObjectivetWithPresenter($request);

        return response()->json([
            'details' => $objective
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function updateCampaignStatus(Request $request)
    {
        $campaign = $this->repository->updateCampaignStatus($request);

        return response()->json([
            'details' => $campaign
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getActiveCampaignsByCompany(Request $request)
    {
        $campaigns = [];

        if(!is_null(auth()->user()->CompanyUser)) {
            $campaigns = $this->repository->getActiveCampaignsByCompany($request);
        }

        return response()->json([
            'details' => $campaigns
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getCampaignById(Request $request)
    {
        $campaigns = $this->repository->getCampaignById($request);

        return response()->json([
            'details' => $campaigns
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getCampaignProposals(Request $request)
    {
        $campaigns = $this->repository->getCampaignProposals($request);

        return response()->json([
            'details' => $campaigns
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getInfluencerAssignTouchPoint(Request $request)
    {
        $campaigns = $this->campaignAssignedJobRepository->getInfluencerAssignTouchPoint($request);

        return response()->json([
            'details' => $campaigns,
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getInfluencerCampaign(Request $request)
    {
        $campaigns = $this->campaignInviteRepository->getInfluencerCampaign($request);

        return response()->json([
            'details' => $campaigns,
        ]);
    }

    public function getActiveCampaigns(Request $request)
    {
        $campaigns = $this->cam->getActiveCampaigns($request);

        return response()->json([
            'details' => $campaigns,
        ]);
    }
}
