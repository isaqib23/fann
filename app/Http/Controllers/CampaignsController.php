<?php

namespace App\Http\Controllers;


use App\Contracts\CampaignPaymentRepository;
use App\Contracts\CampaignTouchPointAdditionalRepository;
use App\Contracts\CampaignTouchPointMediaRepository;
use App\Contracts\CampaignTouchPointPlacementActionRepository;
use App\Contracts\CampaignTouchPointProductRepository;
use App\Contracts\CampaignTouchPointRepository;
use App\Contracts\PlacementRepository;
use App\Http\Requests\TouchPointRequest;
use http\Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CampaignCreateRequest;
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
     * @var CampaignValidator
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
     * @var CampaignTouchPointMediaRepository
     */
    private $campaignTouchPointMediaRepository;

    /**
     * @var CampaignTouchPointRepository
     */
    private $campaignTouchPointRepository;

    /**
     * @var CampaignTouchPointAdditionalRepository
     */
    private $campaignTouchPointAdditionalRepository;

    /**
     * @var CampaignPaymentRepository
     */
    private $campaignPaymentRepository;

    /**
     * @var CampaignTouchPointProductRepository
     */
    private $campaignTouchPointProductRepository;

    /**
     * @var CampaignTouchPointPlacementActionRepository
     */
    private $campaignTouchPointPlacementActionRepository;

    /**
     * CampaignsController constructor.
     *
     * @param CampaignRepository $repository
     * @param CampaignObjectiveRepository $campaignObjectiveRepository
     * @param PlacementRepository $placementRepository
     * @param CampaignTouchPointMediaRepository $campaignTouchPointMediaRepository
     * @param CampaignTouchPointRepository $campaignTouchPointRepository
     * @param CampaignTouchPointPlacementActionRepository $campaignTouchPointPlacementActionRepository
     * @param CampaignTouchPointAdditionalRepository $campaignTouchPointAdditionalRepository
     * @param CampaignPaymentRepository $campaignPaymentRepository
     * @param CampaignTouchPointProductRepository $campaignTouchPointProductRepository
     * @param LaravelValidator $validator
     */
    public function __construct(
        CampaignRepository $repository,
        CampaignObjectiveRepository $campaignObjectiveRepository,
        PlacementRepository $placementRepository,
        CampaignTouchPointMediaRepository $campaignTouchPointMediaRepository,
        CampaignTouchPointRepository $campaignTouchPointRepository,
        CampaignTouchPointPlacementActionRepository $campaignTouchPointPlacementActionRepository,
        CampaignTouchPointAdditionalRepository $campaignTouchPointAdditionalRepository,
        CampaignPaymentRepository $campaignPaymentRepository,
        CampaignTouchPointProductRepository $campaignTouchPointProductRepository,
        LaravelValidator $validator
    )
    {
        $this->repository = $repository;
        $this->campaignObjectiveRepository = $campaignObjectiveRepository;
        $this->placementRepository = $placementRepository;
        $this->campaignTouchPointMediaRepository = $campaignTouchPointMediaRepository;
        $this->campaignTouchPointRepository = $campaignTouchPointRepository;
        $this->campaignTouchPointPlacementActionRepository = $campaignTouchPointPlacementActionRepository;
        $this->campaignTouchPointAdditionalRepository = $campaignTouchPointAdditionalRepository;
        $this->campaignPaymentRepository = $campaignPaymentRepository;
        $this->campaignTouchPointProductRepository = $campaignTouchPointProductRepository;
        $this->validator = $validator;
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
        $response =  $this->repository->savePlacementAndPayment($request->all());

        return response()->json([
            'details' => $response
        ]);
    }

    /**
     * @param TouchPointRequest $request
     * @return JsonResponse|RedirectResponse
     */
    public function saveTouchPoint(TouchPointRequest $request)
    {
        dd($request->all());
        try {
            $data = $request->all();

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $this->repository->update(
                [ 'description' => $data['touchPoint']['campaignDescription'] ],
                $data['campaignId']
            );

           $saveTouchPoint =  $this->campaignTouchPointRepository->saveInHierarchy($data);

            $response = [
                'message'    => 'Touch Point Created.',
                'details'    => $saveTouchPoint,
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

}
