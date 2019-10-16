<?php

namespace App\Providers;

use App\Contracts\CountryRepository;
use App\Contracts\ShopRepository;
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
        //:end-bindings:
    }
}
