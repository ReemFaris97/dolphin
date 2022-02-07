<?php

namespace App\Imports;

use App\Models\AccountingSystem\AccountingAccount;
use App\Models\AccountingSystem\AccountingCurrency;
use DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Schema;

class AccountsImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        Schema::disableForeignKeyConstraints();
        DB::table("accounting_accounts")
            ->where("id", "!=", 0)
            ->delete();

        $status = [
            "مدين ودائن" => null,
            "مدين" => "debtor",
            "دائن" => "Creditor",
        ];
        $rows->sortBy("alhsab_alab");
        foreach ($rows as $row) {
            DB::table("accounting_accounts")->insert([
                "ar_name" => $row["asm_alhsab"],
                "en_name" => $row["alasm_allatyny"],
                "kind" =>
                    $row["alhsab_alab"] == null ? "main" : "following_main",
                "code" => $row["alrmz"],
                "closing_account" => $row["alhsab_alkhtamy"],
                "active" => $row["ghyr_faaal"] == "ﻻ" ? 0 : 1,
                "account_id" => optional(
                    AccountingAccount::where(
                        "ar_name",
                        $row["alhsab_alab"]
                    )->first()
                )->id,
                "status" => $status[$row["gh_alhsab"]],
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
