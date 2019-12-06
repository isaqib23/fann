<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\UserPlatformMetaRepository;
use App\Models\InfluencerDetail;
use App\Validators\InfluencerDetailValidator;

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
        return InfluencerDetail::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
