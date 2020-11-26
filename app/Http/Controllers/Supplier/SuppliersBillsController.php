<?php

namespace App\Http\Controllers\Supplier;

use App\Models\Product;
use App\Models\SupplierBill;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;
use App\Traits\Supplier\BillsOperations;

class SuppliersBillsController extends Controller
{
    use Viewable,BillsOperations;
    private  $viewable = 'suppliers.suppliers_bills.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills = SupplierBill::orderBy('id','desc')->get();
        return $this->toIndex(compact('bills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = User::where('is_supplier',1)->where('supplier_type','dolphin')->pluck('name', 'id');
        $products=Product::all();
        return $this->toCreate(compact('suppliers','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'supplier_id'=>'required|numeric',
            'bill_number'=>'required|numeric|unique:supplier_bills,bill_number',
            'date'=>'required|string|date',
            'payment_method'=>'required|in:cash,bank_transfer,check',
            'amount_paid'=>'required|numeric',
            'amount_rest'=>'required|numeric',
            'vat'=>'required|numeric',
            "transfer_date"=>"date|string|required_if:payment_method,bank_transfer|nullable",
            "transfer_number"=>"numeric|required_if:payment_method,bank_transfer|nullable",
            "bank_name"=>"string|required_if:payment_method,check|nullable",
            "check_number"=>"numeric|required_if:payment_method,check|nullable",
            "check_date"=>"date|string|required_if:payment_method,check|nullable",
            'products'=>'required|array',
            'qtys'=>'required|array',
            'prices'=>'required|array',
        ];
        $this->validate($request,$rules);

        $this->CreateSupplierBill($request);
        alert()->success('تم إنشاء الفاتورة بنجاح')->autoclose(5000);
        return redirect()->route('supplier.suppliers-bills.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bill = SupplierBill::findOrFail($id);
        return $this->toShow(compact('bill'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bill = SupplierBill::findOrFail($id);
        $suppliers = User::where('is_supplier',1)->where('supplier_type','dolphin')->pluck('name', 'id');
        $products=Product::all();
        return $this->toEdit(compact('bill','suppliers','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $bill = SupplierBill::findOrFail($id);

        $rules = [
            'supplier_id'=>'required|numeric',
            'bill_number'=>'required|numeric|unique:supplier_bills,bill_number,'.$bill->id,
            'date'=>'required|string|date',
            'payment_method'=>'required|in:cash,bank_transfer,check',
            'amount_paid'=>'required|numeric',
            'amount_rest'=>'required|numeric',
            'vat'=>'required|numeric',
            "transfer_date"=>"date|string|required_if:payment_method,==,bank_transfer",
            "transfer_number"=>"numeric|required_if:payment_method,==,bank_transfer",
            "bank_name"=>"string|required_if:payment_method,==,check",
            "check_number"=>"numeric|required_if:payment_method,==,check",
            "check_date"=>"date|string|required_if:payment_method,==,check",
            'products'=>'required|array',
            'qtys'=>'required|array',
            'prices'=>'required|array',
        ];

        $this->validate($request,$rules);

        $this->UpdateSupplierBill($request,$bill);
        alert()->success('تم تعديل الفاتورة بنجاح')->autoclose(5000);
        return redirect()->route('supplier.suppliers-bills.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
