<?php

namespace App\Providers;

use App\Contracts\CampaignObjectiveCategoryRepository;
use App\Contracts\CampaignObjectiveRepository;
use App\Contracts\CampaignRepository;
use App\Contracts\CountryRepository;
use App\Contracts\ShopRepository;
use App\Repositories\CampaignObjectiveCategoryRepositoryEloquent;
use App\Repositories\CampaignObjectiveRepositoryEloquent;
use App\Repositories\CampaignRepositoryEloquent;
use App\Repositories\CountryRepositoryEloquent;
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
        //:end-bindings:
    }
}
