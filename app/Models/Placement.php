<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Placements.
 *
 * @package namespace App\Models;
 */
class Placement extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'image'
    ];


    /**
     * @return BelongsTo
     */
    public function campagin()
    {
        return $this->belongsTo(Campaign::class, 'primary_placement_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function userPlatforms()
    {
        return $this->hasOne(UserPlatform::class);
    }
<<<<<<< HEAD
=======

    /**
     * @return HasMany
     */
    public function touchPoint()
    {
        return $this->hasMany(CampaignTouchPoint::class,'placement_id', 'id');
    }
>>>>>>> c2ae2f5527e10bc8312c976c06fe742fc737d269
}
