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
            ['id' => $request->input('userComapny.id')],
            [
                'name' => $request->input('userComapny.name'),
                'address' => $request->input('userComapny.address'),
                'timezone' => $request->input('userComapny.timezone'),
                'logo' => ($request->file('logo')) ? $name : $request->input('userComapny.logo'),
                'niche' => $request->input('userComapny.niche'),
                'state_id' => $request->input('userComapny.state_id'),
                'country_id' => $request->input('userComapny.country_id'),
                'website' => $request->input('userComapny.website'),
                'phone' => $request->input('userComapny.phone'),
            ]);

    }

}
