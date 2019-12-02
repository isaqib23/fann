<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\InfluencerStatisticsCreateRequest;
use App\Http\Requests\InfluencerStatisticsUpdateRequest;
use App\Contracts\InfluencerStatisticsRepository;
use App\Validators\InfluencerStatisticsValidator;

/**
 * Class InfluencerStatisticsController.
 *
 * @package namespace App\Http\Controllers;
 */
class InfluencerStatisticsController extends Controller
{
    /**
     * @var InfluencerStatisticsRepository
     */
    protected $repository;

    /**
     * @var InfluencerStatisticsValidator
     */
    protected $validator;

    /**
     * InfluencerStatisticsController constructor.
     *
     * @param InfluencerStatisticsRepository $repository
     * @param InfluencerStatisticsValidator $validator
     */
    public function __construct(InfluencerStatisticsRepository $repository, InfluencerStatisticsValidator $validator)
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
        $influencerStatistics = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $influencerStatistics,
            ]);
        }

        return view('influencerStatistics.index', compact('influencerStatistics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  InfluencerStatisticsCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(InfluencerStatisticsCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $influencerStatistic = $this->repository->create($request->all());

            $response = [
                'message' => 'InfluencerStatistics created.',
                'data'    => $influencerStatistic->toArray(),
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
        $influencerStatistic = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $influencerStatistic,
            ]);
        }

        return view('influencerStatistics.show', compact('influencerStatistic'));
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
        $influencerStatistic = $this->repository->find($id);

        return view('influencerStatistics.edit', compact('influencerStatistic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  InfluencerStatisticsUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(InfluencerStatisticsUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $influencerStatistic = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'InfluencerStatistics updated.',
                'data'    => $influencerStatistic->toArray(),
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
                'message' => 'InfluencerStatistics deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'InfluencerStatistics deleted.');
    }
}
