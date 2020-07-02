<?php

namespace App\Observers;


use App\Models\AccountingSystem\AccountingEntry;
use App\Models\AccountingSystem\AccountingEntryLog;

class EntryObserver
{

    public function creating(AccountingEntry $entry)
    {
                $exiss = AccountingEntry::latest()->first();
                if (!is_null($exiss)) {
                    $entry->code =$exiss->code+1;
                } else {
                    $entry->code = getsetting('entry_code');
                }
    }

    public  function  created(AccountingEntry $entry){


    }

    public  function  updated(AccountingEntry $entry){


    }

}
