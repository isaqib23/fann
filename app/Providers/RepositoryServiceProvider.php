<?php

namespace App\Providers;

use App\Contracts\CampaignObjectiveCategoryRepository;
use App\Contracts\CampaignObjectiveRepository;
use App\Contracts\CampaignPaymentRepository;
use App\Contracts\CampaignRepository;
use App\Contracts\CampaignTouchPointAdditionalRepository;
use App\Contracts\CampaignTouchPointMediaRepository;
use App\Contracts\CampaignTouchPointPlacementActionRepository;
use App\Contracts\CampaignTouchPointProductRepository;
use App\Contracts\CampaignTouchPointRepository;
use App\Contracts\CityRepository;
use App\Contracts\CompanyRepository;
use App\Contracts\CompanyUserRepository;
use App\Contracts\CountryRepository;
use App\Contracts\NicheRepository;
use App\Contracts\NotificationRepository;
use App\Contracts\NotificationTypeRepository;
use App\Contracts\PaymentTypeRepository;
use App\Contracts\PlacementRepository;
use App\Contracts\SettingsRepository;
use App\Contracts\PlacementTypeRepository;
use App\Contracts\ShopRepository;
use App\Contracts\StateRepository;
use App\Contracts\UserCreditCardRepository;
use App\Contracts\UserDetailRepository;
use App\Repositories\CampaignObjectiveCategoryRepositoryEloquent;
use App\Repositories\CampaignObjectiveRepositoryEloquent;
use App\Repositories\CampaignPaymentRepositoryEloquent;
use App\Repositories\CampaignRepositoryEloquent;
use App\Repositories\CampaignTouchPointAdditionalRepositoryEloquent;
use App\Repositories\CampaignTouchPointMediaRepositoryEloquent;
use App\Repositories\CampaignTouchPointPlacementActionRepositoryEloquent;
use App\Repositories\CampaignTouchPointProductRepositoryEloquent;
use App\Repositories\CampaignTouchPointRepositoryEloquent;
use App\Repositories\CityRepositoryEloquent;
use App\Repositories\CompanyRepositoryEloquent;
use App\Repositories\CompanyUserRepositoryEloquent;
use App\Repositories\CountryRepositoryEloquent;
use App\Repositories\NicheRepositoryEloquent;
use App\Repositories\NotificationRepositoryEloquent;
use App\Repositories\NotificationTypeRepositoryEloquent;
use App\Repositories\PaymentTypeRepositoryEloquent;
use App\Repositories\PlacementRepositoryEloquent;
use App\Repositories\SettingsRepositoryEloquent;
use App\Repositories\PlacementTypeRepositoryEloquent;
use App\Repositories\ShopRepositoryEloquent;
use App\Repositories\StateRepositoryEloquent;
use App\Repositories\UserCreditCardRepositoryEloquent;
use App\Repositories\UserDetailRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package App\Providers
 */
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
        $this->app->bind(SettingsRepository::class, SettingsRepositoryEloquent::class);
        $this->app->bind(UserCreditCardRepository::class, UserCreditCardRepositoryEloquent::class);
        $this->app->bind(CampaignTouchPointMediaRepository::class, CampaignTouchPointMediaRepositoryEloquent::class);
        $this->app->bind(PlacementTypeRepository::class, PlacementTypeRepositoryEloquent::class);
        $this->app->bind(CampaignTouchPointPlacementActionRepository::class, CampaignTouchPointPlacementActionRepositoryEloquent::class);
        $this->app->bind(CampaignTouchPointProductRepository::class, CampaignTouchPointProductRepositoryEloquent::class);
        $this->app->bind(CampaignTouchPointAdditionalRepository::class, CampaignTouchPointAdditionalRepositoryEloquent::class);
        $this->app->bind(CompanyRepository::class, CompanyRepositoryEloquent::class);
        $this->app->bind(CompanyUserRepository::class, CompanyUserRepositoryEloquent::class);
        $this->app->bind(StateRepository::class, StateRepositoryEloquent::class);
        $this->app->bind(CityRepository::class, CityRepositoryEloquent::class);
        $this->app->bind(NotificationRepository::class, NotificationRepositoryEloquent::class);
        $this->app->bind(NotificationTypeRepository::class, NotificationTypeRepositoryEloquent::class);
        $this->app->bind(NicheRepository::class, NicheRepositoryEloquent::class);
        $this->app->bind(UserDetailRepository::class, UserDetailRepositoryEloquent::class);
        //:end-bindings:
    }
}
