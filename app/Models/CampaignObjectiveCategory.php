<?php

namespace App\Models;

use CampaingObjectives;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CampaignObjectiveCategory extends Model
{
    /**
     * @var string
     */
    protected $table = 'campaign_objective_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'is_active'
    ];

    /**
     * @return HasMany
     */
    public function campaignObjectives()
    {
        return $this->hasMany(CampaingObjectives::class, 'parent_category_id', 'id');
    }
}
