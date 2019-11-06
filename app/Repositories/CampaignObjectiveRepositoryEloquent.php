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

    /**
     * @return mixed
     */
    public function getObjectWithCategory()
    {
       return $this->with(['objectiveCategory'])->findWhere([
           'is_active' => 1
       ]);
    }

    /**
     * @return array
     */
    public function synthObjectiveAlongWithCategory()
    {
        $response  = [];
        $objectives = $this->getObjectWithCategory();
        foreach ($objectives as $objective) {
            $response [$objective->objectiveCategory->name]['category'] = [
                'id' => $objective->objectiveCategory->id,
                'name' => $objective->objectiveCategory->name,
                'image' => $objective->objectiveCategory->image
            ];
            $response [$objective->objectiveCategory->name]['main'][] = [
                'id' => $objective->id,
                'name' => $objective->name,
                'slug' => $objective->slug
            ];
        }
        return $response;
    }


}
