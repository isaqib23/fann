<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\InfluencerDetailCreateRequest;
use App\Http\Requests\InfluencerDetailUpdateRequest;
use App\Contracts\InfluencerDetailRepository;

/**
 * Class InfluencerDetailsController.
 *
 * @package namespace App\Http\Controllers;
 */
class InfluencerDetailsController extends Controller
{
    /**
     * @var InfluencerDetailRepository
     */
    protected $repository;

    /**
     * InfluencerDetailsController constructor.
     *
     * @param InfluencerDetailRepository $repository
     */
    public function __construct(InfluencerDetailRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $influencerDetails = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $influencerDetails,
            ]);
        }

        return view('influencerDetails.index', compact('influencerDetails'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  InfluencerDetailCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(InfluencerDetailCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $influencerDetail = $this->repository->create($request->all());

            $response = [
                'message' => 'InfluencerDetail created.',
                'data'    => $influencerDetail->toArray(),
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
        $influencerDetail = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $influencerDetail,
            ]);
        }

        return view('influencerDetails.show', compact('influencerDetail'));
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
        $influencerDetail = $this->repository->find($id);

        return view('influencerDetails.edit', compact('influencerDetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  InfluencerDetailUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(InfluencerDetailUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $influencerDetail = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'InfluencerDetail updated.',
                'data'    => $influencerDetail->toArray(),
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
                'message' => 'InfluencerDetail deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'InfluencerDetail deleted.');
    }
}
