<?php

namespace App\Http\Controllers;

use App\Contracts\CompanyRepository;
use App\Contracts\CompanyUserRepository;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    /**
     * @var CompanyRepository
     */
    protected $companyRepository;

    /**
     * @var CompanyUserRepository
     */
    protected $companyUserRepository;


    /**
     * SettingsController constructor.
     *
     * @param CompanyRepository $companyRepository
     * @param CompanyUserRepository $companyUserRepository
     */
    public function __construct(
        CompanyRepository $companyRepository,
        CompanyUserRepository $companyUserRepository
    )
    {
        $this->companyRepository = $companyRepository;
        $this->companyUserRepository = $companyUserRepository;
    }

    /**
     * Update user
     *
     * @param Request $request
     * @return App\User
     * @throws ValidationException
     */
    public function update(Request $request)
    {

        $request->merge(json_decode($request->input('user'),true));

        $rules = [
            'data.*.first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,' . $request->user()->id,
            'password' => 'nullable|string|min:6|confirmed',
            'logo'=> 'required',
            'userCompany.name' => 'required|string|max:191',
            'userCompany.website' => 'required|url',
            'userCompany.phone' => 'required|numeric',
            'userCompany.address' => 'required',
            'userCompany.state_id' => 'required',
            'userCompany.country_id' => 'required',
            'userCompany.niche_id' => 'required'
        ];

        $this->validate($request, $rules);

        $user = $request->user();
        $user->fill([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email')
        ]);

        // Update User Company Details
        $company = $this->companyRepository->store($request);
        $companyUser = $this->companyUserRepository->findByField('user_id',auth()->user()->id);

        if($companyUser->count() == 0){
            $this->companyUserRepository->store($company->id);
        }

        if ($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();
        return response()->json(compact('user'));
    }
}
