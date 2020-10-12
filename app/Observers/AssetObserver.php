<?php

namespace App\Observers;

use App\Models\AccountingSystem\AccountingAccount;
use App\Models\AccountingSystem\AccountingAsset;
use App\Models\AccountingSystem\AccountingAssetDamageLog;
use App\Models\AccountingSystem\AccountingBank;
use App\Models\AccountingSystem\AccountingCustodyLog;
use App\Models\AccountingSystem\AccountingEntry;
use App\Models\AccountingSystem\AccountingEntryAccount;
use App\Models\AccountingSystem\AccountingPayment;
use App\Models\Task;
use Carbon\Carbon;

class AssetObserver
{
    /**
     * Handle the task "created" event.
     *
     * @param  \App\Models\AccountingSystem\AccountingAsset  $asset
     * @return void
     */
    public function created(AccountingAsset $asset)
    {
        $account=  AccountingAccount::create([
            'ar_name'=>$asset->name,
            'en_name'=>$asset->name,
            'kind'=>'sub',
            'status'=>'debtor',
            'active'=>'1',
            'account_id'=>$asset->account_id,
            'asset_id'=>$asset->id,
        ]);

        if($asset->type=='asset'){

            $accountDamged=  AccountingAccount::create([
                'ar_name'=>'مجمع اهلاك'.' '. $asset->name,
                'en_name'=>$asset->name,
                'kind'=>'sub',
                'status'=>'creditor',
                'active'=>'1',
                'account_id'=>$asset->account_id,
                'asset_id'=>$asset->id,

            ]);
            $accountDamged->update([
                'code'=> '**'.$account->code
            ]);

          AccountingAssetDamageLog::create([
            'asset_id'=>$asset->id,
            'code'=>rand(10000,4),
            'date'=>Carbon::now(),
            'amount'=>0,
            'amount_asset_after'=>$asset->purchase_price
        ]);




        $entry=AccountingEntry::create([
            'date'=>$account->created_at,
            'source'=>'الاصول',
            'type'=>'automatic',
            'details'=>' اضافه اصل'.$account->ar_name,
            'status'=>'new'
        ]);

        AccountingEntryAccount::create([
            'entry_id'=>$entry->id,
            'from_account_id'=>$account->id,
            'to_account_id'=>$asset->payment->bank->account->id?? $asset->payment->safe->account->id,
            'amount'=>$asset->purchase_price,
        ]);

          }elseif($asset->type=='custdoy'){

            AccountingCustodyLog::create([
                'asset_id'=>$asset->id,
                'operation_name'=>'اضافه عهدة',
                'code'=>rand(10000,4),
                'date'=>Carbon::now(),
                'amount'=>0,
                'amount_asset_after'=>$asset->purchase_price
            ]);





            $entry=AccountingEntry::create([
                'date'=>$account->created_at,
                'source'=>'العهد',
                'type'=>'automatic',
                'details'=>' اضافه عهده'.$account->ar_name,
                'status'=>'new'
            ]);

            AccountingEntryAccount::create([
                'entry_id'=>$entry->id,
                'from_account_id'=>$account->id,
                'to_account_id'=>$asset->payment->bank->account->id,
                'amount'=>$asset->purchase_price,
            ]);

          }

    }

    /**
     * Handle the task "updated" event.
     *
     * @param  \App\Task  $task
     * @return void
     */

}
