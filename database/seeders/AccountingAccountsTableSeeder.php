<?php

namespace Database\Seeders;

use App\Imports\AccountsImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class AccountingAccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new AccountsImport, 'imports/accounts.xlsx');
    }
}
