<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\UserPlatformRepository;
use App\Models\UserPlatform;
use App\Validators\UserPlatformValidator;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class UserPlatformRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserPlatformRepositoryEloquent extends BaseRepository implements UserPlatformRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserPlatform::class;
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
    public function store($data)
    {
        return $this->updateOrCreate(
            [
                'user_id' => $data->user_id,
                'provider' => $data->provider
            ],
            [
                'user_id'           => $data->user_id,
                'access_token'      => $data->access_token,
                'provider'          => $data->provider,
                'placement_id'       => $data->placement_id,
                'provider_id'       => $data->provider_id,
                'provider_name'     => $data->provider_name,
                'provider_photo'    => $data->provider_photo,
                'followers'         => $data->followers,
                'followings'        => $data->followings,
                'meta_json'         => $data->meta_json
            ]);

    }
}
