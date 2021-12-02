<?php

namespace App\Imports;

use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingProductStore;
use App\Models\AccountingSystem\AccountingProductSubUnit;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AccountProductStoreImport implements ToCollection, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    protected Command $command;

    public function __construct($command=null)
    {
        $this->command = $command;
    }
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        $this->command->withProgressBar($rows, function ($row) {
            $product = AccountingProduct::where(fn ($q) =>$q->OfBarcode($row['albarkod'])->orWhere('name', $row['asm_almad']))->first();
            try {
                AccountingProductStore::create([
                    'product_id' => $product->id,
                    'store_id' => 1,
                    'unit_id' => optional(AccountingProductSubUnit::OfBarcode($row['albarkod'])->first())->id,
                    'quantity' => $row['alkmy'],
                    'price' => $row['alsaar_alafrady'],
                ]);
            } catch (\Exception $e) {
                dd($row);
            }
        });
    }

    public function batchSize(): int
    {
        return  100;
    }

    public function chunkSize(): int
    {
        return 250;
    }
}
