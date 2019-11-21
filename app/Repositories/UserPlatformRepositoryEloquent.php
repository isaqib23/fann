<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\UserPlatformRepository;
use App\Models\UserPlatform;
use App\Validators\UserPlatformValidator;

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
    
}
