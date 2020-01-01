<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\CampaignTouchPointProductShippmentRepository;
use App\Models\CampaignTouchPointProductShippment;
use App\Validators\CampaignTouchPointProductShippmentValidator;

/**
 * Class CampaignTouchPointProductShippmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CampaignTouchPointProductShippmentRepositoryEloquent extends BaseRepository implements CampaignTouchPointProductShippmentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CampaignTouchPointProductShippment::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function createShippment($data,$details)
    {
        $this->create([
            'outside_order_id'=> $data->id,
            'dispatch_date' => date('Y-m-d',strtotime($data->created_at)),
            'discount_code' => $data->discount_codes != null ? $data->discount_codes[0]->code : null,
            'fulfillment_status' => $data->fulfillment_status ?? null,
            'order_status_url' => $data->order_status_url,
            'outside_customer_id' => $data->customer->id,
            'shipping_address' => $data->shipping_address !=null ? json_encode($data->shipping_address) : null,
            'order_json' => json_encode($data),
            'send_by' => $details['send_by'],
            'touch_point_id' => $details['touch_point_id'],
            'touch_point_product_id' => $details['touch_point_product_id']
        ]);
    }

}
