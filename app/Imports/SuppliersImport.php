<?php

namespace App\Imports;

use App\Models\AccountingSystem\AccountingAccount;
use App\Models\AccountingSystem\AccountingSupplier;
use DB;
use Hash;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Schema;

class SuppliersImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        Schema::disableForeignKeyConstraints();
        // DB::table('accounting_suppliers')->where('id', '!=', 0)->delete();

        foreach ($rows as $row) {
            DB::table('accounting_suppliers')->updateOrInsert([
                'name' => $row['asm_alaamyl'],
                'email' => $row['mokaa_alantrnt'],
            ], [
                'phone' => $this->getPhone($row),
                'branch_id' => 7,
                'password' => Hash::make(123456),
                'account_id' => $this->getAccountId($row),
                'phones' => $this->concatPhones($row)
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }

    private function getAccountId($row) : int
    {
        $mainAcc = AccountingAccount::firstOrCreate(['ar_name' => $row['alhsab_alasl']])->id;

        return AccountingAccount::firstOrCreate(['ar_name'=>$row['asm_alhsab']], ['account_id'=>$mainAcc])->id;
    }

    private function getPhone($row):string
    {
        $all_phones=  $row['rkm_alhatf1'].'  '. $row['rkm_alhatf2'].'  '. $row['rkm_alkhlyoy'];
        $arr=explode('  ', $all_phones);
        $a=array_filter($arr, fn ($v) =>preg_match_all('/^[0-9]/', trim($v)));
        return current($a);
    }

    private function concatPhones($row):string
    {
        $myArr = [
            'rkm_alhatf1'=>$row['rkm_alhatf1'],
            'rkm_alhatf2'=>$row['rkm_alhatf2'],
            'rkm_alkhlyoy'=>$row['rkm_alkhlyoy'],
        ];
        return json_encode($myArr);
    }
}
