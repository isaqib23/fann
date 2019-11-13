<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\UserCreditCardRepository;
use App\Models\UserCreditCard;
use App\Validators\UserCreditCardValidator;

/**
 * Class UserCreditCardRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserCreditCardRepositoryEloquent extends BaseRepository implements UserCreditCardRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserCreditCard::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
