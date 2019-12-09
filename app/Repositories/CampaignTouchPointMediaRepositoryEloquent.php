<?php

namespace App\Repositories;

use App\Contracts\CampaignTouchPointMediaRepository;
use App\Models\CampaignTouchPointMedia;
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
            'format' => $data['format']
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
        foreach ($data as $key =>  $value)
        {
            $value['campaign_id'] = $touchPoint['campaign_id'];

            $Image = new ImageHelper();
            $storedImage = $Image->storeImage($value);

            $this->store([
                'campaign_touch_point_id' => $touchPoint['id'],
                'path'                    => $storedImage['path'].'/'.$storedImage['name'],
                'format'                  => 'image'
            ]);

        }
    }
}
