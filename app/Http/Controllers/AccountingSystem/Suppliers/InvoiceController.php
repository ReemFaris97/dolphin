<?php

namespace App\Http\Controllers\AccountingSystem\Suppliers;

use App\Http\Controllers\Controller;
use App\Models\Supplier\Invoice;
use App\Notifications\SupplierNotification;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('AccountingSystem.suppliers.invoice.index')->with('invoices',Invoice::when(\request('supplier_id'),function($q){
            $q->where('accounting_supplier_id',\request('supplier_id'));
        })->withSum('items','total')->withCount('items')->latest()->get());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $suppliers_invoice)
    {
        return view('AccountingSystem.suppliers.invoice.show',['invoice'=>$suppliers_invoice]);
    }

    public function update(Request $request,Invoice $suppliers_invoice)
    {
     $inputs=   $request->validate([
            'status'=>'required|in:accept,reject'
        ]);
        $suppliers_invoice->update($inputs);
        \Notification::send($suppliers_invoice->supplier->users,new SupplierNotification([
            'title'=>'تطبيق الموردين',
            'body'=>"تحديث علي حالة عرض السعر رقم $suppliers_invoice->id",
            'type'=>'price_offer',
            'model'=>[
                'id'=>$suppliers_invoice->id,
            ]
        ]));
        alert()->success('تم التعديل بنجاح !');
        return back();
    }
}
