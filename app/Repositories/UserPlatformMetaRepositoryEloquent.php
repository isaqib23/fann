<?php

namespace App\Repositories;

use App\Models\UserPlatformMeta;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\UserPlatformMetaRepository;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class InfluencerDetailRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserPlatformMetaRepositoryEloquent extends BaseRepository implements UserPlatformMetaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserPlatformMeta::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param $data
     * @return mixed
     * @throws ValidatorException
     */
    public function store($data, $platform)
    {

        return $this->updateOrCreate(
            [
                'user_id'           => $data->user_id,
                'user_platform_id'  => $platform->id
            ],
            [
                'user_id'               => $data->user_id,
                'user_platform_id'      => $platform->id,
                'rating'                => (isset($data->rating)) ? $data->rating : null,
                'eng_rate'              => (isset($data->eng_rate)) ? $data->eng_rate : null,
                'work_rate'             => (isset($data->work_rate)) ? $data->work_rate : null,
                'tags'                  => (isset($data->tags)) ? $data->tags : null,
                'comment_count'         => (isset($data->comment_count)) ? $data->comment_count : null,
                'like_count'            => (isset($data->like_count)) ? $data->like_count : null,
                'follower_count'        => (isset($data->followers)) ? $data->followers : null,
                'following_count'       => (isset($data->followings)) ? $data->followings : null,
            ]);

    }
}
