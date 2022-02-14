<?php

namespace App\Http\Controllers\AccountingSystem\Products;

use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingProductSubUnit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function deleteSubUnits(AccountingProductSubUnit $subUnit)
    {
        $subUnit->delete();
        return response()->json([
            "status" => true,
            "message" => "تم الحذف بنجاح !",
        ]);
    }
}
