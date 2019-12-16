<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
     * @var array
     */
    protected $casts = [
        'meta_json' => 'array'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'access_token',
        'provider',
        'placement_id',
        'provider_id',
        'provider_name',
        'provider_photo',
        'meta_json'
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function userPlatformMeta()
    {
        return $this->hasMany(UserPlatformMeta::class);
    }

}
