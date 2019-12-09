<?php

namespace App\Repositories;

use Illuminate\Container\Container as Application;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\UserRepository;
use App\Models\User;
use App\Validators\UserValidator;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function searchInfluencersByCriteria($data)
    {
        $user = $this->model
                ->join('user_platforms', 'users.id', '=', 'user_platforms.user_id')
                ->join('user_platform_metas', 'user_platform_metas.user_platform_id', '=', 'user_platforms.id')
                ->where('users.type', 'influencer');

        $user = $user->get();

        return $user;

    }

}
