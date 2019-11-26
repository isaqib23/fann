<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Http\Response;
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
     * CompanyUsersController constructor.
     *
     * @param CompanyUserRepository $repository
     */
    public function __construct(CompanyUserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $userCompany = null;

        if(auth()->user()->CompanyUser !=null) {
            $userCompany = auth()->user()->CompanyUser->company;
        }

        return response()->json([
            'details' => $userCompany,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CompanyUserCreateRequest $request
     *
     * @return Response
     *
     * @throws ValidatorException
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
     * @return Response
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
     * @return Response
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
     * @throws ValidatorException
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
     * @return Response
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
