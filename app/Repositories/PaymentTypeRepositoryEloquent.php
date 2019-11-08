<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\PaymentTypeRepository;
use App\Models\PaymentType;
use App\Validators\PaymentTypeValidator;

/**
 * Class PaymentTypeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PaymentTypeRepositoryEloquent extends BaseRepository implements PaymentTypeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PaymentType::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
