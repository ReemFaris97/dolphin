<?php

namespace App\Providers;

use App\Models\AccountingSystem\AccountingAccount;
use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingDevice;
use App\Models\AccountingSystem\AccountingEntry;
use App\Models\AccountingSystem\AccountingEntryAccount;
use App\Models\AccountingSystem\AccountingMoneyClause;
use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingProductCategory;
use App\Models\AccountingSystem\AccountingPurchase;
use App\Models\AccountingSystem\AccountingPurchaseReturn;
use App\Models\AccountingSystem\AccountingSafe;
use App\Models\AccountingSystem\AccountingSale;
use App\Models\AccountingSystem\AccountingStore;
use App\Models\AccountingSystem\AccountingSupplier;
use App\Observers\AccountObserver;
use App\Observers\EntryAccountObserver;
use App\Observers\EntryObserver;
use App\Observers\MoneyClauseLogObserver;
use App\Observers\PurchaseObserver;
use App\Observers\PurchaseReturnObserver;
use App\Observers\SaleObserver;
use App\Observers\SupplierObserver;
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
              AccountingSale::observe(SaleObserver::class);
              AccountingAccount::observe(AccountObserver::class);
              AccountingEntry::observe(EntryObserver::class);
              AccountingEntryAccount::observe(EntryAccountObserver::class);
              AccountingSupplier::observe(SupplierObserver::class);


        Validator::extend('branch_name', function ($attribute, $value, $parameters) {
            $count= AccountingBranch::where($parameters[1],$parameters[3])->
                where($parameters[2], $parameters[4])->count()===0;

            return $count;

        });

        Validator::extend('store_name', function ($attribute, $value, $parameters) {
           if ($parameters[5]=="") {
               $count = AccountingStore::where($parameters[1], $parameters[4])->where('model_type','App\Models\AccountingSystem\AccountingBranch')->
                   where('model_id', $parameters[6])->count() === 0;
               return $count;
           }elseif ($parameters[6]==""){
               $count = AccountingStore::where($parameters[1], $parameters[4])->where('model_type','App\Models\AccountingSystem\AccountingCompany')->
                   where('model_id', $parameters[5])->count() === 0;
               return $count;
           }




        });

        Validator::extend('device_name', function ($attribute, $value, $parameters) {
            if ($parameters[5]=="") {
                $count = AccountingDevice::where($parameters[1], $parameters[4])->where('model_type','App\Models\AccountingSystem\AccountingBranch')->
                    where('model_id', $parameters[6])->count() === 0;
                return $count;
            }elseif ($parameters[6]==""){
                $count = AccountingDevice::where($parameters[1], $parameters[4])->where('model_type','App\Models\AccountingSystem\AccountingCompany')->
                    where('model_id', $parameters[5])->count() === 0;
                return $count;
            }




        });
        Validator::extend('device_code', function ($attribute, $value, $parameters) {
            if ($parameters[5]=="") {
                $count = AccountingDevice::where($parameters[1], $parameters[4])->where('model_type','App\Models\AccountingSystem\AccountingBranch')->
                    where('model_id', $parameters[6])->count() === 0;
                return $count;
            }elseif ($parameters[6]==""){
                $count = AccountingDevice::where($parameters[1], $parameters[4])->where('model_type','App\Models\AccountingSystem\AccountingCompany')->
                    where('model_id', $parameters[5])->count() === 0;
                return $count;
            }




        });

        Validator::extend('safe_name', function ($attribute, $value, $parameters) {
            if ($parameters[5]=="") {
                $count = AccountingSafe::where($parameters[1], $parameters[4])->where('model_type','App\Models\AccountingSystem\AccountingBranch')->
                    where('model_id', $parameters[6])->count() === 0;
                return $count;
            }elseif ($parameters[6]==""){
                $count = AccountingSafe::where($parameters[1], $parameters[4])->where('model_type','App\Models\AccountingSystem\AccountingCompany')->
                    where('model_id', $parameters[5])->count() === 0;
                return $count;
            }




        });

        Validator::extend('category_name', function ($attribute, $value, $parameters) {
            $count= AccountingProductCategory::where($parameters[1],$parameters[3])->
                where($parameters[2], $parameters[4])->count()===0;

            return $count;

        });

        Validator::extend('product_name', function ($attribute, $value, $parameters) {
            $count= AccountingProduct::where($parameters[1],$parameters[3])->
                where($parameters[2], $parameters[4])->count()===0;

            return $count;

        });
        Validator::extend('barcode_name', function ($attribute, $value, $parameters) {
            $count= AccountingProduct::where($parameters[1],$parameters[3])->
                where($parameters[2], $parameters[4])->count()===0;

            return $count;

        });

    }
}
