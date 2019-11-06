<?php

namespace App\Models;

use CampaingObjectives;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
     * @return BelongsTo
     */
    public function campaignObjectives()
    {
        return $this->belongsTo(CampaingObjectives::class);
    }

}
