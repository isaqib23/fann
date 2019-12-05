<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\CampaignInviteRepository;
use App\Models\CampaignInvite;
use App\Validators\CampaignInviteValidator;

/**
 * Class CampaignInviteRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CampaignInviteRepositoryEloquent extends BaseRepository implements CampaignInviteRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CampaignInvite::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
