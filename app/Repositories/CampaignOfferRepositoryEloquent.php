<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\CampaignOfferRepository;
use App\Models\CampaignOffer;
use App\Validators\CampaignOfferValidator;

/**
 * Class CampaignOfferRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CampaignOfferRepositoryEloquent extends BaseRepository implements CampaignOfferRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CampaignOffer::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
