<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\SettingsRepository;
use App\Models\Settings;
use App\Validators\SettingsValidator;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class SettingsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SettingsRepositoryEloquent extends BaseRepository implements SettingsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Settings::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }



}
