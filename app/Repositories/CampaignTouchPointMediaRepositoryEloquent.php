<?php

namespace App\Repositories;

use App\Contracts\CampaignTouchPointMediaRepository;
use App\Models\CampaignTouchPointMedia;
use Intervention\Image\ImageManagerStatic as Image;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Validator\Exceptions\ValidatorException;

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
            $path = public_path( env('CAMPAIGN_IMAGES_PATH') .$value['name']);
            Image::make($value['src'])->save($path);

            $this->store([
                'campaign_touch_point_id' => $touchPoint['id'],
                'path'                    => env('CAMPAIGN_IMAGES_PATH') .$value['name'],
                'format'                  => 'image'
            ]);
        }
    }


}
