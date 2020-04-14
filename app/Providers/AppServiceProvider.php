<?php

namespace App\Providers;

use App\Models\AccountingSystem\AccountingPurchase;
use App\Models\AccountingSystem\AccountingSale;
use App\Observers\PurchaseObserver;
use App\Observers\SaleObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //don't remove this line if you are using migrations
        Schema::defaultStringLength('191');

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
                \Config::set('app.timezone',env('TIME_ZONE','Asia/Riyadh'));

              AccountingSale::observe(SaleObserver::class);
              AccountingPurchase::observe(PurchaseObserver::class);

    }
}
