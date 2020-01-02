<?php

namespace App\Repositories;

use App\Transformers\CampaignTransformer;
use Exception;
use Illuminate\Support\Str;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\CampaignRepository;
use App\Models\Campaign;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class CampaignRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CampaignRepositoryEloquent extends BaseRepository implements CampaignRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Campaign::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param $request
     * @return mixed
     * @throws ValidatorException
     */
    public function store($request)
    {
        return $this->updateOrCreate(
            [
                'id'    => $request['id'],
            ],
            [
                'name' => $request['name'],
                'slug' => $this->createSlug($request['name']),
                'objective_id'  => $request['objective_id']
            ]);
    }

    /**
     * @param $title
     * @param int $id
     * @return string
     * @throws Exception
     */
    public function createSlug($title, $id = 0)
    {
        // Normalize the title
        $slug = Str::slug($title);

        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($slug, $id);

        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug)) {
            return $slug;
        }
        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= ($allSlugs->count() + 1); $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }

        throw new Exception('Can not create a unique slug');
    }

    /**
     * @param $slug
     * @param int $id
     * @return mixed
     */
    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Campaign::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }


    public function savePlacementAndPayment($request)
    {


    }

    /**
     * @param $request
     * @return array
     *
     */
    public function getCampaignTouchPointWithPresenter($request)
    {
        $campaign = $this->with([
            'payment'  => function($query){
                $query->with(['paymentType']);
            },
            'touchPoint' => function($query){
                $query->with(['additional','media','placementAction']);
            },
            'objective'
        ])
            ->findWhere(['slug' => $request->input('slug')])
            ->first();

        $campaign = (new CampaignTransformer)->transform($campaign);

        return $campaign;
    }

    /**
     * @param $request
     * @return array
     *
     */
    public function getCampaignObjectivetWithPresenter($request)
    {
        $objective = $this->with([
            'payment'  => function($query){
                $query->with(['paymentType']);
            },
            'placement'
        ])
            ->findWhere([
                'slug'  => $request->input('slug')
            ])->first();

        $campaign = [];

        if($objective) {
            $campaign = (new CampaignTransformer)->CampaignPaymentPresentor($objective, $objective->toArray());
        }

        return $campaign;
    }

    /**
     * @param $request
     * @return mixed
     * @throws ValidatorException
     */
    public function updateCampaignStatus($request)
    {
        if ($request->has('isFeatured')) {
            $this->updateCampaignFeaturedStatus($request);
        }

        return $this->update(
            [
                'status'      => $request->input('status')
            ],
            $request->input('campaignId')
        );
    }

    /**
     * @param $request
     * @return mixed
     * @throws ValidatorException
     */
    public function updateCampaignFeaturedStatus($request)
    {
        return $this->update(
            [
                'is_featured' => $request->input('isFeatured'),
            ],
            $request->input('campaignId')
        );

    }
}
