<?php

namespace App\Providers;

use App\Models\AccountingSystem\AccountingAccount;
use App\Models\AccountingSystem\AccountingAsset;
use App\Models\AccountingSystem\AccountingAssetDamageLog;
use App\Models\AccountingSystem\AccountingBank;
use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingClient;
use App\Models\AccountingSystem\AccountingDevice;
use App\Models\AccountingSystem\AccountingEntry;
use App\Models\AccountingSystem\AccountingEntryAccount;
use App\Models\AccountingSystem\AccountingMoneyClause;
use App\Models\AccountingSystem\AccountingPayment;
use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingProductBarcode;
use App\Models\AccountingSystem\AccountingProductCategory;
use App\Models\AccountingSystem\AccountingProductSubUnit;
use App\Models\AccountingSystem\AccountingPurchase;
use App\Models\AccountingSystem\AccountingPurchaseReturn;
use App\Models\AccountingSystem\AccountingSafe;
use App\Models\AccountingSystem\AccountingSale;
use App\Models\AccountingSystem\AccountingStore;
use App\Models\AccountingSystem\AccountingSupplier;
use App\Observers\AccountObserver;
use App\Observers\AssetDamageObserver;
use App\Observers\AssetObserver;
use App\Observers\BankObserver;
use App\Observers\ClientObsever;
use App\Observers\EntryAccountObserver;
use App\Observers\EntryObserver;
use App\Observers\MoneyClauseLogObserver;
use App\Observers\PaymentObserver;
use App\Observers\PurchaseObserver;
use App\Observers\PurchaseReturnObserver;
use App\Observers\SafeObserver;
use App\Observers\SaleObserver;
use App\Observers\StoreObserver;
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
              AccountingAccount::observe(AccountObserver::class);
              AccountingEntry::observe(EntryObserver::class);
              AccountingEntryAccount::observe(EntryAccountObserver::class);
              AccountingSupplier::observe(SupplierObserver::class);
              AccountingStore::observe(StoreObserver::class);
              AccountingPayment::observe(PaymentObserver::class);
               AccountingBank::observe(BankObserver::class);
                AccountingSafe::observe(SafeObserver::class);
                AccountingAsset::observe(AssetObserver::class);
                AccountingAssetDamageLog::observe(AssetDamageObserver::class);
                AccountingClient::observe(ClientObsever::class);

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
        Validator::extend('device_type', function ($attribute, $value, $parameters) {
dd($parameters);
                $count = AccountingDevice::where($parameters[1], $parameters[4])->where('model_type','App\Models\AccountingSystem\AccountingBranch')->
                    where('model_id', $parameters[6])->count() === 0;
                return $count;

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



        Validator::extend('supplier_name', function ($attribute, $value, $parameters) {
            $count= AccountingSupplier::where($parameters[1],$parameters[3])->
                where($parameters[2], $parameters[4])->count()===0;

            return $count;

        });

        Validator::extend('product_name', function ($attribute, $value, $parameters) {
            $count= AccountingProduct::where($parameters[1],$parameters[3])->
                where($parameters[2], $parameters[4])->count()===0;

            return $count;

        });
        Validator::extend('barcode_name', function ($attribute, $value, $parameters) {
             $product= AccountingProduct::where($parameters[1],$parameters[4])->count();

            $productsubunit= AccountingProductSubUnit::where($parameters[2],$parameters[4])->count();
            $productbarcode= AccountingProductBarcode::where($parameters[3],$parameters[4])->count();
            if($product===0&$productsubunit===0&$productbarcode===0){
                return true;
            }else{
                return false;
            }
        });

        Validator::extend('barcode_anther', function ($attribute, $value, $parameters) {
//            dd($value);
            $product= AccountingProduct::where($parameters[1],$value)->count();

            $productsubunit= AccountingProductSubUnit::where($parameters[2],$value)->count();
            $productbarcode= AccountingProductBarcode::where($parameters[3],$value)->count();
            if($product===0&$productsubunit===0&$productbarcode===0){
                return true;
            }else{
                return false;
            }
        });

        Validator::extend('barcode_unit', function ($attribute, $value, $parameters) {
//            dd($value);
            $product= AccountingProduct::where($parameters[1],$value)->count();

            $productsubunit= AccountingProductSubUnit::where($parameters[2],$value)->count();
            $productbarcode= AccountingProductBarcode::where($parameters[3],$value)->count();
            if($product===0&$productsubunit===0&$productbarcode===0){
                return true;
            }else{
                return false;
            }
        });
    }
}
