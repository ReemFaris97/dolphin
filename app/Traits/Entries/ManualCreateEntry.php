<?php
namespace  App\Traits\Entries;

use App\Models\AccountingSystem\AccountingAccountLog;
use App\Models\AccountingSystem\AccountingEntry;
use App\Models\AccountingSystem\AccountingEntryAccount;

trait ManualCreateEntry
{
    /**
     * Boot the has password trait for a model.
     *
     * @return void
     */
    public static function ManualCreateEntry($request)
    {
        $requests = $request->except('from_account_id', 'to_account_id');


        $requests['type']='manual';

        $entrydata = $request->all();
        // $entrydata['details'] = $request['details'][0];
        $entry=AccountingEntry::create($entrydata);
        $account_id=collect($request['account_id']);
        $debtor=collect($request['debtor']);
        $creditor=collect($request['creditor']);
        $types=[];
        foreach ($debtor as $key=>$item) {
            if ($item==0) {
                $types[$key]='creditor';
            } else {
                $types[$key]='debtor';
            }
        }

        $all= $account_id->zip($debtor, $creditor, $types);
        $debtorAccounts=[];
        $creditorAccounts=[];

        foreach ($all as $key=>$item) {
            if ($item[3]=='debtor') {
                $debator= AccountingEntryAccount::create([
                    'entry_id'=>$entry->id,
                    'account_id'=>$item['0'],
                    'affect'=>'debtor',
                    'amount'=>$item['1'],
                ]);
                array_push($debtorAccounts, $debator);
            }
            if ($item[3]=='creditor') {
                $creditor = AccountingEntryAccount::create([
                    'entry_id'=>$entry->id,
                    'affect'=>'creditor',
                    'account_id'=>$item['0'],
                    'amount'=>$item['2'],
                ]);
                array_push($creditorAccounts, $creditor);
            }
        }
        foreach ($debtorAccounts as$debtorAccount) {
            foreach ($creditorAccounts as $creditorAccount) {
                $last=AccountingAccountLog::where('account_id', $debtorAccount->account_id)->latest()->first();
                AccountingAccountLog::create([
                'entry_id'=>$entry->id,
                'account_id'=>$debtorAccount->account_id,
                'account_amount_before'=>optional($last)->account_amount_after ??$debtorAccount->account->amount,
                'another_account_id'=>$creditorAccount->account_id,
                'amount'=>$creditorAccount->amount,
                'account_amount_after'=>optional($last)->account_amount_after??$debtorAccount->account->amount  - $creditorAccount->amount,
                'affect'=>'debtor',
                    ]);
            }
        }
        foreach ($creditorAccounts as$creditorAccount) {
            foreach ($debtorAccounts as$debtorAccount) {
                $last=AccountingAccountLog::where('account_id', $creditorAccount->account_id)->latest()->first();
                AccountingAccountLog::create([
                    'entry_id'=>$entry->id,
                    'account_id'=>$creditorAccount->account_id,
                    'account_amount_before'=>optional($last)->account_amount_after??$creditorAccount->account->amount,
                    'another_account_id'=>$debtorAccount->account_id,
                    'amount'=>$creditorAccount->amount,
                    'account_amount_after'=>optional($last)->account_amount_after??$debtorAccount->account->amount  - $creditorAccount->amount,
                    'affect'=>'creditor',
                    ]);
            }
        }
    }
}
