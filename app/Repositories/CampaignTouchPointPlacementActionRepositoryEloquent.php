<?php

namespace App\Repositories;

use App\Contracts\CampaignTouchPointPlacementActionRepository;
use App\Models\CampaignTouchPointPlacementAction;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class CampaignTouchPointPlacementRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CampaignTouchPointPlacementActionRepositoryEloquent extends BaseRepository implements CampaignTouchPointPlacementActionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CampaignTouchPointPlacementAction::class;
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
        return $this->create([
            'campaign_touch_point_id' => $data['campaign_touch_point_id'],
            'placement_type_id'       => $data['placement_type_id'],
            'link'                    => $data['link'],
            'link_type'               => $data['link_type']
        ]);
    }

    public function prepareDataToStore($data)
    {
        return $this->store($data);
    }

}
