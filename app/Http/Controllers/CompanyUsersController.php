<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CompanyUserCreateRequest;
use App\Http\Requests\CompanyUserUpdateRequest;
use App\Contracts\CompanyUserRepository;
use App\Validators\CompanyUserValidator;

/**
 * Class CompanyUsersController.
 *
 * @package namespace App\Http\Controllers;
 */
class CompanyUsersController extends Controller
{
    /**
     * @var CompanyUserRepository
     */
    protected $repository;

    /**
     * @var CompanyUserValidator
     */
    protected $validator;

    /**
     * CompanyUsersController constructor.
     *
     * @param CompanyUserRepository $repository
     * @param CompanyUserValidator $validator
     */
    public function __construct(CompanyUserRepository $repository, CompanyUserValidator $validator)
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
        $companyUsers = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $companyUsers,
            ]);
        }

        return view('companyUsers.index', compact('companyUsers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CompanyUserCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CompanyUserCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $companyUser = $this->repository->create($request->all());

            $response = [
                'message' => 'CompanyUser created.',
                'data'    => $companyUser->toArray(),
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
        $companyUser = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $companyUser,
            ]);
        }

        return view('companyUsers.show', compact('companyUser'));
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
        $companyUser = $this->repository->find($id);

        return view('companyUsers.edit', compact('companyUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CompanyUserUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CompanyUserUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $companyUser = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'CompanyUser updated.',
                'data'    => $companyUser->toArray(),
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
                'message' => 'CompanyUser deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'CompanyUser deleted.');
    }
}
