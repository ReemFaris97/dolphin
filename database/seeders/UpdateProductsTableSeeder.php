<?php

namespace Database\Seeders;

use App\Imports\AccountProductStoreImport;
use DB;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class UpdateProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounting_product_stores')->truncate();
        Excel::import(new AccountProductStoreImport(), 'imports/storage.xlsx');
    }
}
