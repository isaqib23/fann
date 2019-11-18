<?php

namespace App\Http\Controllers;

use App\Contracts\CompanyRepository;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    /**
     * @var UserCreditCardRepository
     */
    protected $companyRepository;


    /**
     * SettingsController constructor.
     *
     * @param CompanyRepository $companyRepository
     */
    public function __construct(
        CompanyRepository $companyRepository
    )
    {
        $this->companyRepository = $companyRepository;
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
        exit;
        $rules = [
            'first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,' . $request->user()->id,
            'password' => 'nullable|string|min:6|confirmed',
            'company_user.company.website' => 'required|url',
            'company_user.company.phone' => 'required|numeric',
            'company_user.company.address' => 'required',
            'company_user.company.state_id' => 'required',
            'company_user.company.country_id' => 'required',
        ];

        $this->validate($request, $rules);

        $user = $request->user();
        $user->fill([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email')
        ]);

        // Update User Company Details
        $this->companyRepository->store($request);

        if ($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();
        return response()->json(compact('user'));
    }
}
