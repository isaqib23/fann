<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\CompanyUserRepository;
use App\Models\CompanyUser;
use App\Validators\CompanyUserValidator;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class CompanyUserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CompanyUserRepositoryEloquent extends BaseRepository implements CompanyUserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CompanyUser::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param $company_id
     * @return mixed
     * @throws ValidatorException
     */
    public function store($company_id)
    {

        return $this->create([
            'user_id'   => auth()->user()->id,
            'company_id'   => $company_id,
        ]);

    }
}
