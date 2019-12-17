<?php

namespace App\Repositories;

use App\Contracts\CampaignTouchPointMediaRepository;
use App\Models\CampaignTouchPointMedia;
use Illuminate\Container\Container as Application;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Helpers\ImageHelper;

/**
 * Class CampaignTouchPointImageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CampaignTouchPointMediaRepositoryEloquent extends BaseRepository implements CampaignTouchPointMediaRepository
{
    /**
     * @var ImageHelper
     */
    private $imageHelper;

    /**
     * CampaignTouchPointMediaRepositoryEloquent constructor.
     * @param Application $app
     * @param ImageHelper $imageHelper
     */
    public function __construct(
        Application $app,
        ImageHelper $imageHelper
    )
    {
        parent::__construct($app);
        $this->imageHelper = $imageHelper;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CampaignTouchPointMedia::class;
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
            'path' => $data['path'],
            'format' => $data['format'],
            'name'  => $data['name']
        ]);
    }

    /**
     * @param $data
     * @param $touchPoint
     * @throws ValidatorException
     */
    public function storeMultiple($data, $touchPoint)
    {
        $touchPoint = is_object($touchPoint) ? $touchPoint->toArray() : $touchPoint;
        foreach ($data as $key =>  $value) {
            if(isset($value['src'])) {
                $storedImage = $this->imageHelper->storeImage($value, 'campaigns', $touchPoint['campaign_id']);
                $this->store([
                    'campaign_touch_point_id' => $touchPoint['id'],
                    'path'                    => $storedImage['path'],
                    'name'                    => $storedImage['name'],
                    'format'                  => 'image'
                ]);
            }
        }
    }
}
