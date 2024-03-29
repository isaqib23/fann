<?php

namespace App\Http\Controllers;

use App\Contracts\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\UserDetailCreateRequest;
use App\Http\Requests\UserDetailUpdateRequest;
use App\Contracts\UserDetailRepository;
use App\Validators\UserDetailValidator;

/**
 * Class UserController
 *
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @var UserDetailRepository
     */
    protected $repository;

    /**
     * @var UserDetailValidator
     */
    protected $validator;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserDetailsController constructor.
     *
     * @param UserDetailRepository $repository
     * @param UserDetailValidator $validator
     * @param UserRepository $userRepository
     */
    public function __construct(
        UserDetailRepository $repository,
        UserDetailValidator $validator,
        UserRepository $userRepository
    )
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $userDetails = $this->repository->findByField('user_id',auth()->user()->id)->first();

        return response()->json([
            'details' => $userDetails,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     * @throws ValidationException
     */
    public function create(Request $request)
    {
        $request->merge(json_decode($request->input('user'),true));

        try {

            $rules = [
                'userDetail.bio'        => 'required|string|max:191',
                'userDetail.address'    => 'required',
                'logo'                  => 'required',
                'userDetail.niche_id'      => 'required',
                'userDetail.timezone'   => 'required',
                'userDetail.state_id'   => 'required',
                'userDetail.country_id' => 'required',
                'userDetail.website'    => 'required|url',
                'userDetail.phone'      => 'required|numeric'
            ];

            $this->validate($request, $rules);

            $request->merge([
                'user_id' => auth()->user()->id,
            ]);

            $userDetail = $this->repository->store($request);

            return response()->json([
                'details'    => $userDetail,
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
     * @return Response
     */
    public function show($id)
    {
        $userDetail = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $userDetail,
            ]);
        }

        return view('userDetails.show', compact('userDetail'));
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
        $userDetail = $this->repository->find($id);

        return view('userDetails.edit', compact('userDetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserDetailUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws ValidatorException
     */
    public function update(UserDetailUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $userDetail = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'UserDetail updated.',
                'data'    => $userDetail->toArray(),
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
                'message' => 'UserDetail deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'UserDetail deleted.');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function searchInfluencers(Request $request)
    {
        $response = $this->userRepository->searchInfluencersByCriteria(
            $request
        );

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Influencer data found',
                'details' => $response,
            ]);
        }
    }
}
