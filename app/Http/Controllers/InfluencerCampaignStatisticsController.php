<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\InfluencerCampaignStatisticsCreateRequest;
use App\Http\Requests\InfluencerCampaignStatisticsUpdateRequest;
use App\Contracts\InfluencerCampaignStatisticsRepository;
use App\Validators\InfluencerCampaignStatisticsValidator;

/**
 * Class InfluencerCampaignStatisticsController.
 *
 * @package namespace App\Http\Controllers;
 */
class InfluencerCampaignStatisticsController extends Controller
{
    /**
     * @var InfluencerCampaignStatisticsRepository
     */
    protected $repository;

    /**
     * @var InfluencerCampaignStatisticsValidator
     */
    protected $validator;

    /**
     * InfluencerCampaignStatisticsController constructor.
     *
     * @param InfluencerCampaignStatisticsRepository $repository
     * @param InfluencerCampaignStatisticsValidator $validator
     */
    public function __construct(InfluencerCampaignStatisticsRepository $repository, InfluencerCampaignStatisticsValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $influencerCampaignStatistics = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $influencerCampaignStatistics,
            ]);
        }

        return view('influencerCampaignStatistics.index', compact('influencerCampaignStatistics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  InfluencerCampaignStatisticsCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(InfluencerCampaignStatisticsCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $influencerCampaignStatistic = $this->repository->create($request->all());

            $response = [
                'message' => 'InfluencerCampaignStatistics created.',
                'data'    => $influencerCampaignStatistic->toArray(),
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
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $influencerCampaignStatistic = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $influencerCampaignStatistic,
            ]);
        }

        return view('influencerCampaignStatistics.show', compact('influencerCampaignStatistic'));
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
        $influencerCampaignStatistic = $this->repository->find($id);

        return view('influencerCampaignStatistics.edit', compact('influencerCampaignStatistic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  InfluencerCampaignStatisticsUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(InfluencerCampaignStatisticsUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $influencerCampaignStatistic = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'InfluencerCampaignStatistics updated.',
                'data'    => $influencerCampaignStatistic->toArray(),
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'InfluencerCampaignStatistics deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'InfluencerCampaignStatistics deleted.');
    }
}
