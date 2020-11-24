<?php

namespace App\Imports;

use App\Models\AccountingSystem\AccountingProductCategory;
use Maatwebsite\Excel\Concerns\ToModel;

class CategoryImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        return new AccountingProductCategory([
            'ar_name' => $row[0]??'',
            'en_name' => $row[1]??'',
            'compony_id' => $row[5]??'',
        ]);
    }
}
