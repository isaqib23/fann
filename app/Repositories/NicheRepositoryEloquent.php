<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\NicheRepository;
use App\Models\Niche;
use App\Validators\NicheValidator;

/**
 * Class NicheRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class NicheRepositoryEloquent extends BaseRepository implements NicheRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Niche::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
