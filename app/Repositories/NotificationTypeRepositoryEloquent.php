<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\NotificationTypeRepository;
use App\Models\NotificationType;
use App\Validators\NotificationTypeValidator;

/**
 * Class NotificationTypeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class NotificationTypeRepositoryEloquent extends BaseRepository implements NotificationTypeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return NotificationType::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
