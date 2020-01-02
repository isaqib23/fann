<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class CampaignPayment.
 *
 * @package namespace App\Models;
 */
class CampaignPayment extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'campaign_id',
        'payment_type_id',
        'is_primary'
    ];

    /**
     * @return HasOne
     */
    public function paymentType()
    {
        return $this->hasOne(PaymentType::class, 'id', 'payment_type_id');
    }

}
