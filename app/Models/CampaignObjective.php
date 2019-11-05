<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
     * @return BelongsTo
     */
    public function objectiveCategory()
    {
        return $this->belongsTo(CampaignObjectiveCategory::class);
    }

    /**
     * Scope a query to only include active users.
     *
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

}
