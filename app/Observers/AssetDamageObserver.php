<?php

namespace App\Observers;

use App\Models\AccountingSystem\AccountingAccount;
use App\Models\AccountingSystem\AccountingAsset;
use App\Models\AccountingSystem\AccountingAssetDamageLog;

use App\Models\AccountingSystem\AccountingCustodyLog;
use App\Models\AccountingSystem\AccountingEntry;
use App\Models\AccountingSystem\AccountingEntryAccount;

use App\Models\Task;
use Carbon\Carbon;

class AssetDamageObserver
{
    /**
     * Handle the task "created" event.
     *
     * @param  \App\Models\AccountingSystem\AccountingAsset  $asset
     * @return void
     */
    public function created(AccountingAssetDamageLog $damageLog)
    {

        $account=AccountingAccount::where('asset_id',$damageLog->asset->id)->first();
        $accounts=AccountingAccount::where('asset_id',$damageLog->asset->id)->get();

        $entry=AccountingEntry::create([
            'date'=>Carbon::now(),
            'source'=>'الاصول',
            'type'=>'automatic',
            'details'=>'  اضافة هالك'. " ".$damageLog->asset->ar_name,
            'status'=>'new'
        ]);
        $account_damage=AccountingAccount::find(getsetting('accounting_damage_asset_id'));
// dd($account->id +1);

      AccountingEntryAccount::create([
            'entry_id'=>$entry->id,
            'from_account_id'=>$account_damage->id,
            'to_account_id'=>$account->id+1,
            'amount'=>$damageLog->amount,
        ]);




    }

    /**
     * Handle the task "updated" event.
     *
     * @param  \App\Task  $task
     * @return void
     */

}
