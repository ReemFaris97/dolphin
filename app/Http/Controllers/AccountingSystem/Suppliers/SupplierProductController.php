<?php

namespace App\Http\Controllers\AccountingSystem\Suppliers;

use App\DataTables\AccountingSuppliersProductsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Supplier\Product;

class SupplierProductController extends Controller
{
    public function index(AccountingSuppliersProductsDataTable $dataTable)
    {
        return $dataTable->render('AccountingSystem.suppliers-products.index');
    }

    public function edit($id)
    {
        return redirect()->route('accounting.products.create')->with(Product::find($id)->toArray());
    }

    public function destroy($id)
    {
        Product::find($id)->delete();
        alert()->success('تم الحذف بنجاح !')->autoclose(5000);
        return back();
    }
}
