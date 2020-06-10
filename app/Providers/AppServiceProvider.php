<?php

namespace App\Providers;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingMoneyClause;
use App\Models\AccountingSystem\AccountingPurchase;
use App\Models\AccountingSystem\AccountingPurchaseReturn;
use App\Models\AccountingSystem\AccountingSale;
use App\Observers\MoneyClauseLogObserver;
use App\Observers\PurchaseObserver;
use App\Observers\PurchaseReturnObserver;
use App\Observers\SaleObserver;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Validator;

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
              AccountingMoneyClause::observe(MoneyClauseLogObserver::class);
              AccountingPurchaseReturn::observe(PurchaseReturnObserver::class);


          Validator::extend('branch_name', function ($attribute, $value, $parameters) {
             $count= AccountingBranch::where($parameters[1],$parameters[3])->
                                       where($parameters[2], $parameters[4])->count()==0;


              return $count;

        });
    }
}
