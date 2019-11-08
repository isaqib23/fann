<?php

namespace App\Providers;

use App\Contracts\CampaignObjectiveCategoryRepository;
use App\Contracts\CampaignObjectiveRepository;
use App\Contracts\CampaignPaymentRepository;
use App\Contracts\CampaignRepository;
use App\Contracts\CampaignTouchPointImageRepository;
use App\Contracts\CampaignTouchPointRepository;
use App\Contracts\CountryRepository;
use App\Contracts\PaymentTypeRepository;
use App\Contracts\PlacementRepository;
use App\Contracts\ShopRepository;
use App\Repositories\CampaignObjectiveCategoryRepositoryEloquent;
use App\Repositories\CampaignObjectiveRepositoryEloquent;
use App\Repositories\CampaignPaymentRepositoryEloquent;
use App\Repositories\CampaignRepositoryEloquent;
use App\Repositories\CampaignTouchPointImageRepositoryEloquent;
use App\Repositories\CampaignTouchPointRepositoryEloquent;
use App\Repositories\CountryRepositoryEloquent;
use App\Repositories\PaymentTypeRepositoryEloquent;
use App\Repositories\PlacementRepositoryEloquent;
use App\Repositories\ShopRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(ShopRepository::class, ShopRepositoryEloquent::class);
        $this->app->bind(CountryRepository::class, CountryRepositoryEloquent::class);
        $this->app->bind(CampaignRepository::class, CampaignRepositoryEloquent::class);
        $this->app->bind(CampaignObjectiveRepository::class, CampaignObjectiveRepositoryEloquent::class);
        $this->app->bind(CampaignObjectiveCategoryRepository::class, CampaignObjectiveCategoryRepositoryEloquent::class);
        $this->app->bind(PlacementRepository::class, PlacementRepositoryEloquent::class);
        $this->app->bind(PaymentTypeRepository::class, PaymentTypeRepositoryEloquent::class);
        $this->app->bind(CampaignPaymentRepository::class, CampaignPaymentRepositoryEloquent::class);
        $this->app->bind(CampaignTouchPointRepository::class, CampaignTouchPointRepositoryEloquent::class);
        $this->app->bind(CampaignTouchPointImageRepository::class, CampaignTouchPointImageRepositoryEloquent::class);
        //:end-bindings:
    }
}
