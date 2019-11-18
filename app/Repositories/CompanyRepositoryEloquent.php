<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\CompanyRepository;
use App\Models\Company;
use App\Validators\CompanyValidator;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class CompanyRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CompanyRepositoryEloquent extends BaseRepository implements CompanyRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Company::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param $request
     * @return mixed
     * @throws ValidatorException
     */
    public function store($request)
    {

        return $this->update([
            'name'   => $request->input('company_user.company.name'),
            'address'   => $request->input('company_user.company.address'),
            'timezone'   => $request->input('company_user.company.timezone'),
            'logo'     => ($request->has('company_user.company.logo')) ? $request->has('company_user.company.logo') : '',
            'niche'   => ($request->has('company_user.company.niche')) ? $request->has('company_user.company.niche') : '',
            'state_id' => $request->input('company_user.company.state_id'),
            'country_id'  => $request->input('company_user.company.country_id'),
            'website'   => $request->input('company_user.company.website'),
            'phone'     => $request->input('company_user.company.phone'),
        ], $request->input('company_user.company.id'));

    }

}
