<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CampaignObjective extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'parent_category_id',
        'is_active'
    ];

    /**
     * @return HasOne
     */
    public function objectiveCategory()
    {
        return $this->hasOne(CampaignObjectiveCategory::class, 'id', 'parent_category_id');
    }

    /**
     * Scope a query to only include active users.
     *
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

}
