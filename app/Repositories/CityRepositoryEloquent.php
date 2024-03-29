<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\CityRepository;
use App\Models\City;
use App\Validators\CityValidator;

/**
 * Class CityRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CityRepositoryEloquent extends BaseRepository implements CityRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return City::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
