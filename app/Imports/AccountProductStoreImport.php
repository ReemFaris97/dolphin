<?php

namespace App\Imports;

use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingProductStore;
use App\Models\AccountingSystem\AccountingProductSubUnit;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AccountProductStoreImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $i => $row) {

            $product = AccountingProduct::OfBarcode($row['albarkod'])->orWhere('name', $row['asm_almad'])->first();
            try {
                AccountingProductStore::create([
                    'product_id' => $product->id,
                    'store_id' => 1,
                    'unit_id' => optional(AccountingProductSubUnit::OfBarcode($row['albarkod'])->first())->id,
                    'quantity' => $row['alkmy'],
                    'price' => $row['alsaar_alafrady'],
                ]);
            } catch (\Exception $e) {
               // dd($i, $row);
            }
        }
    }
}
