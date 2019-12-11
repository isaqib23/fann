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
                    'user_platform_metas.post_count',
                    'user_platform_metas.comment_count',
                    'user_platform_metas.like_count',
                    'user_platform_metas.follower_count',
                    'user_platform_metas.following_count'
                    ])
                ->join('user_platforms', 'users.id', '=', 'user_platforms.user_id')
                ->join('user_platform_metas', 'user_platform_metas.user_platform_id', '=', 'user_platforms.id')
                ->where('users.type', 'influencer');

        //--- when Placement is not empty or null
        if (!empty($request->placement) ) {
            $user->where('user_platforms.placement_id', getPlacementIdBySlug($request->placement));
        }

        //-- group fields in if condition along with join
        if ($request->niche != 0 || !empty($request->country) ) {
            $user->join('user_details', 'user_details.user_id', '=', 'users.id');

            //--- when niche is not empty or null
            if (!empty($request->niche) && $request->niche != 0 ) {
                $user->orWhere('user_details.niche_id', $request->niche);
            }

            //--- when country is not empty or null
            if (!empty($request->country)) {
                $user->where('user_details.country_id', $request->country);
            }
        }

        //--- when followers is not empty or null
        if (is_array($request->followers) && $request->followers[1] != 0) {
            $user->whereBetween('user_platform_metas.follower_count', $request->followers);
        }

        //--- when likes is not empty or null
        if (is_array($request->likes) && $request->likes[1] != 0) {
            $user->whereBetween('user_platform_metas.like_count', $request->likes);
        }

        //--- when rating is not empty or null
        if (!empty($request->rating))  {
            $user->where('user_platform_metas.rating', $request->rating);
        }

        //--- when eng_rate is not empty or null
        if (!empty($request->eng_rate))  {
            $user->whereBetween('user_platform_metas.eng_rate', $request->eng_rate);
        }

        //--- when age_range is not empty or null
        //--- when gender is not empty or null
        //--- when placement is not empty or null

        $user = $user->paginate(1);

        return $user;

    }

}
