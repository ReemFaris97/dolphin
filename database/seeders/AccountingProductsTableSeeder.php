<?php

namespace Database\Seeders;

use App\Imports\ProductsImport;
use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingStore;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Schema;

class AccountingProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::beginTransaction();
        DB::table('accounting_products')->truncate();
        DB::table('accounting_products_barcodes')->truncate();
        DB::table('accounting_product_taxes')->truncate();
        DB::table('accounting_products_subUnits')->truncate();
        Excel::import(new ProductsImport($this->command), 'imports/products.xlsx');
        $products= AccountingProduct::pluck('id');
        AccountingStore::find(1)->products()->sync($products->toArray());
        DB::commit();
        Schema::enableForeignKeyConstraints();
    }
}
