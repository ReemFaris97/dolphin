<?php

namespace App\Observers;


use App\Models\AccountingSystem\AccountingAccount;
use App\Models\AccountingSystem\AccountingClient;


class ClientObsever
{



    public  function  created(AccountingClient $client){
        AccountingAccount::create([
            'ar_name'=>$client->name,
            'en_name'=>$client->name,
            'kind'=>'sub',
            'status'=>'debtor',
            'active'=>'1',
            'account_id'=>getsetting('accounting_id_client'),
            'client_id'=>$client->id,
        ]);

    }

    public  function  updated(AccountingClient $client){


    }

}
