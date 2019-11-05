<?php

namespace App\Repositories;

use App\Contracts\CampaignObjectiveRepository;
use App\Models\CampaignObjective;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;


/**
 * Class CampaignObjectiveRepositoryEloquent
 * @package App\Repositories
 */
class CampaignObjectiveRepositoryEloquent extends BaseRepository implements CampaignObjectiveRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     *
     */
    public function model()
    {
        return CampaignObjective::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


    public function getObjectGroupByCategory()
    {
        $this->model()->active();

    }


}
