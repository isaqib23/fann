<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
     * @return HasOne
     *
     */
    public function placement()
    {
        return $this->belongsTo(Campaign::class, 'primary_placement_id','id');
    }
}
