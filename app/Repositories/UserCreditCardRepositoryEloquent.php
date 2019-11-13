<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\UserCreditCardRepository;
use App\Models\UserCreditCard;
use App\Validators\UserCreditCardValidator;
use Prettus\Validator\Exceptions\ValidatorException;

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

    /**
     * @param $request
     * @return mixed
     * @throws ValidatorException
     */
    public function store($request)
    {
        return $this->create([
            'user_id'   => $request->input('user_id'),
            'card_id'   => $request->input('card_id'),
            'brand'     => $request->input('brand'),
            'country'   => $request->input('country'),
            'exp_month' => $request->input('expMonth'),
            'exp_year'  => $request->input('expYear'),
            'funding'   => $request->input('funding'),
            'last4'     => $request->input('last4'),
        ]);

    }

}
