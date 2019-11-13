<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\PlacementTypeRepository;
use App\Models\PlacementType;
use App\Validators\PlacementTypeValidator;

/**
 * Class PlacementTypeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PlacementTypeRepositoryEloquent extends BaseRepository implements PlacementTypeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PlacementType::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
