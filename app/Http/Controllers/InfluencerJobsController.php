<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\InfluencerJobCreateRequest;
use App\Http\Requests\InfluencerJobUpdateRequest;
use App\Contracts\InfluencerJobRepository;
use App\Validators\InfluencerJobValidator;

/**
 * Class InfluencerJobsController.
 *
 * @package namespace App\Http\Controllers;
 */
class InfluencerJobsController extends Controller
{
    /**
     * @var InfluencerJobRepository
     */
    protected $repository;

    /**
     * @var InfluencerJobValidator
     */
    protected $validator;

    /**
     * InfluencerJobsController constructor.
     *
     * @param InfluencerJobRepository $repository
     * @param InfluencerJobValidator $validator
     */
    public function __construct(InfluencerJobRepository $repository, InfluencerJobValidator $validator)
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
        $influencerJobs = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $influencerJobs,
            ]);
        }

        return view('influencerJobs.index', compact('influencerJobs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  InfluencerJobCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(InfluencerJobCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $influencerJob = $this->repository->create($request->all());

            $response = [
                'message' => 'InfluencerJob created.',
                'data'    => $influencerJob->toArray(),
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
        $influencerJob = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $influencerJob,
            ]);
        }

        return view('influencerJobs.show', compact('influencerJob'));
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
        $influencerJob = $this->repository->find($id);

        return view('influencerJobs.edit', compact('influencerJob'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  InfluencerJobUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(InfluencerJobUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $influencerJob = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'InfluencerJob updated.',
                'data'    => $influencerJob->toArray(),
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
                'message' => 'InfluencerJob deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'InfluencerJob deleted.');
    }
}
