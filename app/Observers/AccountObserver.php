<?php

namespace App\Observers;

use App\Models\AccountingSystem\AccountingAccount;
use App\Models\AccountingSystem\AccountingSale;

class AccountObserver
{

    public function creating(AccountingAccount $account)
    {
///////////////////////تلقائى
        if (getsetting('automatic')=='1') {

            if ($account->kind=='main'){
                $lastMainAcount = AccountingAccount::where('kind', 'main')->latest()->first();
                if (!is_null($lastMainAcount)) {

                    $account->code = $lastMainAcount->code + 1000;

                } else {
                    $account->code = 1000;
                }

            }elseif($account->kind=='following_main'){

               $perantAccount= AccountingAccount::find($account->account_id);
                $lastfollowingAcount = AccountingAccount::where('kind','following_main')->where('account_id',$account->account_id)->latest()->first();

               if (!is_null($lastfollowingAcount)) {
                   $account->code = $lastfollowingAcount->code + 1000;
               }else{
                   $account->code = $lastfollowingAcount->code . 1000;

               }
            }
            elseif($account->kind=='sub'){

                $perantAccount = AccountingAccount::find($account->account_id);
                $lastsubAcount = AccountingAccount::where('kind','sub')->where('account_id',$account->account_id)->latest()->first();

                if (!is_null($lastsubAcount)) {
                    $account->code = $lastsubAcount->code + 1;
                }else{
                    $account->code = $perantAccount->code . 1;

                }
            }
        }
////////////////////////غير تلقائى-------------تسلسلى

        elseif (getsetting('automatic')=='0'&&getsetting('coding_status')=='0'){

           if($account->kind=='sub'||$account->kind=='following_main'){

                $perantAccount= AccountingAccount::find($account->account_id);
                $lastsubAcount = AccountingAccount::whereIn('kind',['following_main', 'sub'])->where('account_id',$account->account_id)->latest()->first();

                if (!is_null($lastsubAcount)) {
                    $account->code = $lastsubAcount->code + getsetting('increased_number');
                }else{

                    $account->code = $perantAccount->code . getsetting('increased_number');

                }
            }
        }

        ////////////////////////غير تلقائى-------------تزايدى

        elseif (getsetting('automatic')=='0'&&getsetting('coding_status')=='1'){

            if ($account->kind=='main'){
                $lastMainAcount = AccountingAccount::where('kind', 'main')->latest()->first();
                if (!is_null($lastMainAcount)) {

                    $account->code = $lastMainAcount->code + 1;

                } else {
                    $account->code =getsetting('main_coding');
                }

            }elseif($account->kind=='sub'||$account->kind=='following_main'){
                $perantAccount= AccountingAccount::find($account->account_id);
                $lastsubAcount = AccountingAccount::whereIn('kind',['following_main', 'sub'])->where('account_id',$account->account_id)->latest()->first();
                if (!is_null($lastsubAcount)) {

                    $account->code = $lastsubAcount->code + 1;

                }else{
                    $account->code = $perantAccount->code . 1;

                }

            }
        }



    }

    // public function updating(AccountingAccount $account)
    // {

    //         $account->update([
    //             'amount' => $account->children()->sum('amount'),
    //         ]);



    // }

}
