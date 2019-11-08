<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\CampaignPaymentRepository;
use App\Models\CampaignPayment;
use App\Validators\CampaignPaymentValidator;

/**
 * Class CampaignPaymentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CampaignPaymentRepositoryEloquent extends BaseRepository implements CampaignPaymentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CampaignPayment::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
