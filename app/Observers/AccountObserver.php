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
                    $account->level = $lastMainAcount->level ;
                } else {
                    $account->code = 1000;
                    $account->level = 1;

                }

                $account->level = 1;
            }elseif($account->kind=='following_main'){

               $perantAccount= AccountingAccount::find($account->account_id);
                $lastfollowingAcount = AccountingAccount::where('kind','following_main')->where('account_id',$account->account_id)->latest()->first();

               if (!is_null($lastfollowingAcount)) {
                   $account->code = optional($lastfollowingAcount)->code + 1000;
                   $account->level = optional($lastfollowingAcount)->level;
               }else{
                   $account->code = optional($perantAccount)->code . 1000;
                   $account->level = optional($perantAccount)->level +1;

               }
            }
            elseif($account->kind=='sub'){

                $perantAccount = AccountingAccount::find($account->account_id);
                $lastsubAcount = AccountingAccount::where('kind','sub')->where('account_id',$account->account_id)->latest()->first();

                if (!is_null($lastsubAcount)) {

                    $account->code = optional($lastsubAcount)->code + 1;
                    $account->level = optional($lastsubAcount)->level;

                }else{
                    $account->level = optional($perantAccount)->level + 1 ;

                }
            }
        }
////////////////////////غير تلقائى-------------تسلسلى

        elseif (getsetting('automatic')=='0'&&getsetting('coding_status')=='0'){

           if($account->kind=='sub'||$account->kind=='following_main'){

                $perantAccount= AccountingAccount::find($account->account_id);
                $lastsubAcount = AccountingAccount::whereIn('kind',['following_main', 'sub'])->where('account_id',$account->account_id)->latest()->first();

                if (!is_null($lastsubAcount)) {
                    $account->code = optional($lastsubAcount)->code + getsetting('increased_number');
                    $account->level = optional($lastsubAcount)->level ;
                }else{

                    $account->code = optional($perantAccount)->code . getsetting('increased_number');
                    $account->level = optional($perantAccount)->level + 1;


                }
            }
        }

        ////////////////////////غير تلقائى-------------تزايدى

        elseif (getsetting('automatic')=='0'&&getsetting('coding_status')=='1'){
            // dd($account);
            if ($account->kind=='main'){
                $lastMainAcount = AccountingAccount::where('kind', 'main')->latest()->first();
                if (!is_null($lastMainAcount)) {

                    $account->code = optional($lastMainAcount)->code + 1;
                    $account->level = optional($lastMainAcount)->level ;

                } else {
                    $account->code =getsetting('main_coding');
                    $account->level = 1;
                }

            }elseif($account->kind=='sub'||$account->kind=='following_main'){
                $perantAccount= AccountingAccount::find($account->account_id);
                // dd($perantAccount);
                $lastsubAcount = AccountingAccount::whereIn('kind',['following_main', 'sub'])->where('account_id',$account->account_id)->latest()->first();
                if (!is_null($lastsubAcount)) {
                    if (strpos(optional($lastsubAcount)->code, '*') == true) {
                        $lastsubAcount->code = rtrim($lastsubAcount->code, '*');

                    }
                    $account->code = optional($lastsubAcount)->code + 1;
                    $account->level = optional($lastsubAcount)->level;


                }else{

                    $account->code = optional($perantAccount)->code . 1;
                    $account->level = optional($perantAccount)->level +1;
                }

            }
        }

    }

}
