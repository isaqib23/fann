<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class UserPlatform.
 *
 * @package namespace App\Models;
 */
class UserPlatform extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug'
    ];

    /**
     * @return HasOne
     */
    public function userPlatformMeta()
    {
        return $this->hasOne(UserPlatformMeta::class);
    }

}
