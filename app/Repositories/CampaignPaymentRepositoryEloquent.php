<?php

namespace App\Repositories;

use App\Contracts\PaymentTypeRepository;
use Illuminate\Container\Container as Application;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\CampaignPaymentRepository;
use App\Models\CampaignPayment;
use App\Validators\CampaignPaymentValidator;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class CampaignPaymentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CampaignPaymentRepositoryEloquent extends BaseRepository implements CampaignPaymentRepository
{

    /**
     * @var PaymentTypeRepository
     */
    private $paymentTypeRepository;

    /**
     * CampaignPaymentRepositoryEloquent constructor.
     * @param Application $app
     * @param PaymentTypeRepository $paymentTypeRepository
     */
    public function __construct(
        Application $app,
        PaymentTypeRepository $paymentTypeRepository
    )
    {
        parent::__construct($app);
        $this->paymentTypeRepository = $paymentTypeRepository;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CampaignPayment::class;
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
        if ($data['payment_type_id'] != 0) {
            return $this->updateOrCreate(
                [
                    'campaign_id' => $data['campaign_id'],
                ],
                [
                    'campaign_id'       => $data['campaign_id'],
                    'payment_type_id'   => $data['payment_type_id'],
                    'is_primary'        => $data['is_primary']
                ]);
        }
    }

    /**
     * @param $data
     * @param $campaignId
     * @throws ValidatorException
     */
    public function storeMultiple($data, $campaignId)
    {
        if (array_key_exists('platform', $data)) {
            unset($data['platform']);
        }

        foreach ($data as $key =>  $value)
        {
            $this->store([
                'campaign_id'     => $campaignId,
                'payment_type_id' => $this->fieldsMapper($key, $value),
                'is_primary'      => ($value == 'barter') ? $data['additionalPayAsAmount'] : $data['additionalPayAsBarter']
                ]);
        }
    }

    /**
     * @param $key
     * @param $value
     * @return int
     */
    public function fieldsMapper($key, $value)
    {
        $payment_id = 0;

        switch(true)
        {
            case ($key == 'paymentType'):
                $resp = $this->paymentTypeRepository->findByField('slug', $value)->first();
                $payment_id = $resp->id;
                break;
            case ($key == 'additionalPayAsBarter' && $value == 'true'):
                $resp = $this->paymentTypeRepository->findByField('slug', 'barter')->first();
                $payment_id = $resp->id;
                break;
            case ($key == 'additionalPayAsAmount' && $value == 'true'):
                $resp = $this->paymentTypeRepository->findByField('slug', 'paid')->first();
                $payment_id = $resp->id;
                break;
            default:
                'nothing';
                break;
        }

        return $payment_id;
    }

}
