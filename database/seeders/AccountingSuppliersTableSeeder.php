<?php

namespace Database\Seeders;

use App\Imports\SuppliersImport;
use DB;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class AccountingSuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //     DB::beginTransaction();
        // DB::table('accounting_suppliers')->truncate();
        Excel::import(new SuppliersImport, 'imports/suppliers.xlsx');
//    DB::commit();
    }
}
