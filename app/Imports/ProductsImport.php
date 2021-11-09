<?php

namespace App\Imports;

use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingProductCategory;
use App\Models\AccountingSystem\AccountingIndustrial;
use App\Models\AccountingSystem\AccountingProductBarcode;
use App\Models\AccountingSystem\AccountingProductMainUnit;
use App\Models\AccountingSystem\AccountingProductSubUnit;
use App\Models\AccountingSystem\AccountingProductTax;
use App\Models\AccountingSystem\AccountingSupplier;
use DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Schema;

class ProductsImport implements ToCollection, WithHeadingRow //, WithChunkReading
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        Schema::disableForeignKeyConstraints();
        DB::table('accounting_products')->delete();

        foreach ($rows as $row) {
            $product_id = DB::table('accounting_products')->insertGetId([
                'name' => $row['asm_almad'],
                'en_name' => $row['alasm_allatyny'],
                'type' => 'product_expiration',
                'bar_code' => explode(' ', $row['albarkod'])[0],
                'main_unit' => $row['aloahd'],
                'selling_price' => $row['mbyaa'],
                'purchasing_price' => $row['shraaa'],
                'supplier_id' => optional(AccountingSupplier::where('name', $row['alshrk_almsnaa'])->first())->id,
                'industrial_id' => AccountingSupplier::firstOrNew(['name'=>$row['alshrk_almsnaa']])->id,
            ]);

            $this->handleRelatoins($row, $product_id);
        }
    }

    private function handleRelatoins($row, $product_id)
    {
        DB::table('accounting_products_barcodes')->delete();

        $barcodes = explode(' ', $row['albarkod']);
        foreach ($barcodes as $value) {
            DB::table('accounting_products_barcodes')->insert(['product_id' => $product_id,'barcode' => $value]);
        }

        DB::table('accounting_product_taxes')->delete();
        $taxes = [];
        $taxes['product_id'] = $product_id;
        $taxes['price_has_tax'] = $row['aaatmad_alnsb_lldryb'] == 'Y' ? 1:0;
        $taxes['tax'] = $row['aaatmad_alnsb_lldryb'] == 'Y' ? 1:0;
        $taxes['tax_value'] = $row['aldryb'];
        DB::table('accounting_product_taxes')->insert($taxes);

        $units = collect([
            [
                'product_id' => $product_id,
                'name' => $row['aloahd2'],
                'bar_code' => $row['albarkod2'],
                'main_unit_present' => $row['altaaadl2']
            ],
            [
                'product_id' => $product_id,
                'name' => $row['aloahd3'],
                'bar_code' => $row['albarkod3'],
                'main_unit_present' => $row['altaaadl3']
            ],
            [
                'product_id' => $product_id,
                'name' => $row['aloahd4'],
                'bar_code' => $row['albarkod4'],
                'main_unit_present' => $row['altaaadl4']
            ],
            [
                'product_id' => $product_id,
                'name' => $row['aloahd5'],
                'bar_code' => $row['albarkod5']??null,
                'main_unit_present' => $row['altaaadl5']
            ],
        ])->filter(fn ($i) =>$i['name']!=null);

        DB::table('accounting_products_subUnits')->insert($units->toArray());

        dump("mama ana 5last :D \b ");
    }

    // public function chunkSize(): int
    // {
    //     return 1;
    // }
}
