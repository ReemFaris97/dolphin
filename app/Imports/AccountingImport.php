<?php

namespace App\Imports;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AccountingImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        // dd($this);
        return [
            0 => new ProductsImport(),
            1 => new CategoryImport(),
        ];
    }
}
?>
