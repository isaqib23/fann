<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\CampaignTouchPointProductRepository;
use App\Models\CampaignTouchPointProduct;
use App\Validators\CampaignTouchPointProductValidator;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class CampaignTouchPointProductRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CampaignTouchPointProductRepositoryEloquent extends BaseRepository implements CampaignTouchPointProductRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CampaignTouchPointProduct::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param $data
     * @return mixed
     * @throws ValidatorException
     */
    public function store($data)
    {
        return $this->updateOrCreate(
            [
                'outside_product_id' => $data['productId'],
            ],
            [
                'name' => $data['title'],
                'outside_product_id' => $data['productId'],
                'outside_product_variant_id' => $data['id'],
                'outside_platform' => 'Shopify',
                'outside_product_image' => $data['pImage'],
            ]);
    }

}
