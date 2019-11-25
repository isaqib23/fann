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
        // Save Company Logo
        if($request->file('logo')){
            $image = $request->file('logo');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/');
            $image->move($destinationPath, $name);
        }

        return $this->updateOrCreate(
            ['id' => $request->input('userCompany.id')],
            [
                'name' => $request->input('userCompany.name'),
                'address' => $request->input('userCompany.address'),
                'timezone' => $request->input('userCompany.timezone'),
                'logo' => ($request->file('logo')) ? $name : $request->input('userCompany.logo'),
                'niche_id' => $request->input('userCompany.niche_id'),
                'state_id' => $request->input('userCompany.state_id'),
                'country_id' => $request->input('userCompany.country_id'),
                'website' => $request->input('userCompany.website'),
                'phone' => $request->input('userCompany.phone'),
            ]);

    }

}
