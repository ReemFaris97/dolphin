<?php

namespace App\Http\Controllers\Admin;

use App\Models\SupplierDiscard;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class DiscardsController extends Controller
{

    use Viewable;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }


    public function getAjaxSupplierProducts(Request $request){
       $supplier = User::find($request->id);
       $products = $supplier->supplierProducts();
       return response()->json([
           'status'=>true,
           'data'=>view('admin.discards.supplier_products',compact('products'))->render()
       ]);
    }
}
