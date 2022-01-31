<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingProduct;
use App\Models\Supplier\User;
use App\Models\SupplyRequisition;
use Illuminate\Http\Request;

class SupplyRequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('AccountingSystem.supply-requisition.index')->with('requests', SupplyRequisition::latest()->get());
    }

    public function appendProduct(AccountingProduct $product)
    {
        return response()->json(['html' => view('AccountingSystem.supply-requisition.products', ['product' => $product,'index'=>\request('index',0)+1])->render
        ()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('AccountingSystem.supply-requisition.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $inputs= $request->validate([
            'accounting_company_id'=>'required',
            'accounting_branch_id'=>'required',
            'accounting_supplier_id'=>'required',
            'products'=>'required|array|min:1',
            'products.*.accounting_product_id'=>'required',
            'products.*.unit'=>'required',
            'products.*.quantity'=>'required'
        ]);
       $inputs['creator_id']=auth()->id();
        $supply_requisition=SupplyRequisition::create($inputs);
        $supply_requisition->items()->createMany($request['products']);
      $users=  User::where('supplier_id',$request['accounting_supplier_id'])->get();
      \Notification::send($users,new SupplierNotification(['title'=>'امر توريد جديد','body'=>"لقد تم اضافة امر توريد جديد لكم برقم $supply_requisition->id",
          'model'=>['id'=>$supply_requisition->id]]));
        alert()->success("تم ارسال طلب التوريد بنجاح !");
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(SupplyRequisition $supplyRequisition)
    {
        return  view('AccountingSystem.supply-requisition.show',compact('supplyRequisition'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
