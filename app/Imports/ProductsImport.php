<?php

namespace App\Imports;

use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingProductCategory;
use App\Models\AccountingSystem\AccountingIndustrial;

use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
// dd($row);
        return new AccountingProduct([
            'name'     => $row[0]??'',
            'en_name'    => $row[1]??'',
            'company_id'     => ,
            'bar_code'    => $row[3]??'',
            'category_id' => AccountingProductCategory::query()->firstOrCreate(['ar_name'=>$row[4],'en_name'=>$row[4]])->id,
            // 'industrial_id'=>  AccountingIndustrial::where("name", "like", "%".$row[5]."%"),
            'color'     => $row[6]??'',
            'size'    => $row[7]??'',
            // ''     => $row[8],
            // ''    => $row[9],
            // ''     => $row[10],
            'description' => $row[1]??'',
            // 'name'     => $row[12],
            // 'email'    => $row[13],
            'min_quantity'     => $row[14]??'',
            'max_quantity'    => $row[15]??'',
            'main_unit'     => $row[16]??'',
            'purchasing_price' => $row[17]??'',
            'selling_price' => $row[18]??'',
            // ''    => $row[19],
            // ''    => $row[20],
            // ''    => $row[21],
            // ''    => $row[22],

        ]);
    }
}
