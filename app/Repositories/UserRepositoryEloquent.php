<?php

namespace App\Repositories;

use Illuminate\Container\Container as Application;
use Illuminate\Http\Request;
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

    /**
     * @param Request $request
     * @return mixed
     */
    public function searchInfluencersByCriteria(Request $request)
    {
        $user = $this->model
                ->select([
                    'users.id',
                    'users.email',
                    'users.first_name',
                    'users.last_name',
                    'user_platforms.provider',
                    'user_platforms.provider_name',
                    'user_platforms.provider_photo',
                    'user_platform_metas.rating',
                    'user_platform_metas.eng_rate',
                    'user_platform_metas.work_rate',
                    'user_platform_metas.tags',
                    'user_platform_metas.post_count',
                    'user_platform_metas.comment_count',
                    'user_platform_metas.like_count',
                    'user_platform_metas.follower_count',
                    'user_platform_metas.following_count'
                    ])
                ->join('user_platforms', 'users.id', '=', 'user_platforms.user_id')
                ->join('user_platform_metas', 'user_platform_metas.user_platform_id', '=', 'user_platforms.id')
                ->where('users.type', 'influencer');

        $user = $user->paginate(1);

        return $user;

    }

}
