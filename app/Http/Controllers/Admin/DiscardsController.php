<?php

namespace App\Http\Controllers\Admin;

use App\Models\SupplierDiscard;
use App\Traits\Distributor\DistributorOperation;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Supplier\DiscardsOperations;
use App\Traits\Viewable;

class DiscardsController extends Controller
{

    use Viewable,DiscardsOperations;
    private  $viewable = 'admin.discards.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $suppliers_discards = SupplierDiscard::orderBy('id','desc')->get();
       return $this->toIndex(compact('suppliers_discards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = User::where('is_supplier',1)->where('supplier_type','dolphin')->pluck('name', 'id');
        return $this->toCreate(compact('suppliers'));
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
            'supplier_id'=>'required|numeric|exists:users,id',
            'reason'=>'required|string|max:191',
            'date'=>"required|date",
            'return_type'=>"required",
            'products'=>'required|array',
            'products.*'=>"required|numeric|exists:products,id",
        ];
            if($request->return_type === 'switch'){
                $rules['switch_products'] ='required|array';
                $rules['switch_products.*'] ="required|numeric|exists:products,id";
            }
            if($request->return_type === 'decrease'){
                $rules['paid_amount'] = 'required|numeric|min:1';
            }

            $this->validate($request,$rules);
            $discard = $this->RegisterDiscard($request);
            $this->RegisterDiscardProducts($discard,$request,'discard');

        if($request->has('return_type') && $request->return_type == 'switch'){
                $this->RegisterDiscardProducts($discard,$request,'switch');
        }

        if($request->has('return_type') && $request->return_type=='decrease'){
            $this->RegisterTransaction($request);
        }

        toast('تم الحفظ بنجاح', 'success', 'top-right');
        return redirect()->route('admin.suppliers-discards.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $discard = SupplierDiscard::findOrFail($id);
        return $this->toShow(compact('discard'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $discard = SupplierDiscard::find($id);
        if($discard){
            $discard->delete();
        }
        toast('تم الحذف بنجاح', 'success', 'top-right');
        return redirect()->route('admin.suppliers-discards.index');
    }


    public function getAjaxSupplierProducts(Request $request){
       $supplier = User::find($request->id);
       $products = $supplier->supplierProducts();
       return response()->json([
           'status'=>true,
           'receivables'=>$supplier->TotalOfSupplierReceivables(),
           'data'=>view('admin.discards.supplier_products',compact('products'))->render()
       ]);
    }
}
