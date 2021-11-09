<?php

namespace Database\Seeders;

use App\Imports\SuppliersImport;
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
        Excel::import(new SuppliersImport, 'imports/suppliers.xlsx');
    }
}
