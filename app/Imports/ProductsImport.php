<?php

namespace App\Imports;

use App\Models\AccountingSystem\AccountingProductCategory;
use App\Models\AccountingSystem\AccountingSupplier;
use DB;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToCollection, WithHeadingRow //, WithChunkReading
{
    protected Command $command;

    public function __construct($command = null)
    {
        $this->command = $command;
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        DB::beginTransaction();
        $this->command->withProgressBar($rows, function ($row) {
            $product_id = DB::table("accounting_products")->insertGetId([
                "name" => $row["asm_almad"],
                "en_name" => $row["alasm_allatyny"],
                "type" => "product_expiration",
                "category_id" => AccountingProductCategory::query()->firstOrCreate(
                    ["ar_name" => $row["alsnf"]]
                )->id,
                "bar_code" => json_encode(explode(" ", $row["albarkod"])),
                "main_unit" => $row["aloahd"],
                "selling_price" => $row["mbyaa"],
                "purchasing_price" => $row["shraaa"],
                "supplier_id" => optional(
                    AccountingSupplier::where(
                        "name",
                        $row["alshrk_almsnaa"]
                    )->first()
                )->id,
                "industrial_id" => AccountingSupplier::firstOrNew([
                    "name" => $row["alshrk_almsnaa"],
                ])->id,
            ]);

            $this->handleRelatoins($row, $product_id);
        });
    }

    private function handleRelatoins($row, $product_id)
    {
        $barcodes = explode(" ", $row["albarkod"]);
        foreach ($barcodes as $value) {
            DB::table("accounting_products_barcodes")->insert([
                "product_id" => $product_id,
                "barcode" => $value,
            ]);
        }

        $taxes = [];
        $taxes["product_id"] = $product_id;
        $taxes["tax_band_id"] = 1;
        $taxes["price_has_tax"] = $row["aaatmad_alnsb_lldryb"] == "Y" ? 1 : 0;
        $taxes["tax"] = $row["aaatmad_alnsb_lldryb"] == "Y" ? 1 : 0;
        $taxes["tax_value"] = $row["aldryb"];
        DB::table("accounting_product_taxes")->insert($taxes);

        $units = collect([
            [
                "product_id" => $product_id,
                "name" => $row["aloahd2"],
                "bar_code" => json_encode(explode(" ", $row["albarkod2"])),
                "main_unit_present" => $row["altaaadl2"],
                "selling_price" => $row["mbyaa2"],
                "purchasing_price" => $row["shraaa2"],
            ],
            [
                "product_id" => $product_id,
                "name" => $row["aloahd3"],
                "bar_code" => json_encode(explode(" ", $row["albarkod3"])),
                "main_unit_present" => $row["altaaadl3"],
                "selling_price" => $row["mbyaa3"],
                "purchasing_price" => $row["shraaa3"],
            ],
            [
                "product_id" => $product_id,
                "name" => $row["aloahd4"],
                "bar_code" => json_encode(explode(" ", $row["albarkod4"])),
                "main_unit_present" => $row["altaaadl4"],
                "selling_price" => $row["mbyaa4"],
                "purchasing_price" => $row["shraaa4"],
            ],
            [
                "product_id" => $product_id,
                "name" => $row["aloahd5"],
                "bar_code" => json_encode(explode(" ", $row["albarkod5"])),
                "main_unit_present" => $row["altaaadl5"],
                "selling_price" => $row["mbyaa5"],
                "purchasing_price" => $row["shraaa5"],
            ],
        ])->filter(fn($i) => $i["name"] != null);

        DB::table("accounting_products_subUnits")->insert($units->toArray());
    }

    // public function chunkSize(): int
    // {
    //     return 1;
    // }
}
