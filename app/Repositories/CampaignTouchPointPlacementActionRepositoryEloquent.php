<?php

namespace App\Repositories;

use App\Contracts\CampaignTouchPointPlacementActionRepository;
use App\Models\CampaignTouchPointPlacementAction;
use Illuminate\Container\Container as Application;
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
     * @var PlacementTypeRepositoryEloquent
     */
    private $placementTypeRepositoryEloquent;

    /**
     * CampaignTouchPointPlacementActionRepositoryEloquent constructor.
     * @param Application $app
     * @param PlacementTypeRepositoryEloquent $placementTypeRepositoryEloquent
     */
    public function __construct(
        Application $app,
        PlacementTypeRepositoryEloquent $placementTypeRepositoryEloquent
    )
    {
        parent::__construct($app);
        $this->placementTypeRepositoryEloquent = $placementTypeRepositoryEloquent;
    }

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
        return $this->updateOrCreate(
            [
                'campaign_touch_point_id'   => $data['campaign_touch_point_id'],
            ],
            [
            'campaign_touch_point_id'       => $data['campaign_touch_point_id'],
            'placement_type_id'             => $data['placement_type_id'],
            'link'                          => $data['link'],
            'link_type'                     => $data['link_type']
        ]);
    }

    /**
     * @param $data
     * @return mixed
     * @throws ValidatorException
     */
    public function prepareDataAndStore($data)
    {
        if (array_key_exists('slug', $data)) {
            $placementType = $this->placementTypeRepositoryEloquent->findByField('slug', $data['slug'])->first();

            $data['placement_type_id'] = $placementType->id;

            unset($data['slug']);
        }

        return $this->store($data);
    }

}
