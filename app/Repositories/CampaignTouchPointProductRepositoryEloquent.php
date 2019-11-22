<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\CampaignTouchPointProductRepository;
use App\Models\CampaignTouchPointProduct;
use App\Validators\CampaignTouchPointProductValidator;

/**
 * Class CampaignTouchPointProductRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CampaignTouchPointProductRepositoryEloquent extends BaseRepository implements CampaignTouchPointProductRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CampaignTouchPointProduct::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function store($data)
    {
        return $this->create([

        ]);
    }

}
