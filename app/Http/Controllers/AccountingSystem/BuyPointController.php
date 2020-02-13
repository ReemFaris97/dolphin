<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingClient;
use App\Models\AccountingSystem\AccountingColumnCell;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingFaceColumn;
use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingProductCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingProductStore;
use App\Models\AccountingSystem\AccountingProductTax;
use App\Models\AccountingSystem\AccountingSafe;
use App\Models\AccountingSystem\AccountingSession;
use App\Models\AccountingSystem\AccountingSupplier;
use App\Traits\Viewable;
use App\User;
use Request as GlobalRequest;

class BuyPointController extends Controller
{
    // use Viewable;
//    private $viewable = 'AccountingSystem.sells_points.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function buy_point()
    {
        $categories=AccountingProductCategory::pluck('ar_name','id')->toArray();

        $suppliers=AccountingSupplier::pluck('name','id')->toArray();
        $safes=AccountingSafe::pluck('name','id')->toArray();

        return  view('AccountingSystem.buy_points.buy_point',compact('categories','suppliers','safes'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public  function getProductAjex(Request $request){
        // dd($request['store_id']);
        $store_product=AccountingProductStore::where('store_id',auth()->user()->accounting_store_id)->pluck('product_id','id')->toArray();
        $products=AccountingProduct::where('category_id',$request['id'])->whereIn('id',$store_product)->get();
        // $products_a=AccountingProduct::where('category_id',$id)->pluck('id','id')->toArray();



        return response()->json([
            'status'=>true,
            'data'=>view('AccountingSystem.buy_points.products')->with('products',$products)->render()
        ]);
    }

    public  function pro_search($q){

        $products=AccountingProduct::where('name','LIKE','%'.$q.'%')->get();
        // $products_a=AccountingProduct::where('category_id',$id)->pluck('id','id')->toArray();

        return response()->json([
            'status'=>true,
            'data'=>view('AccountingSystem.buy_points.sell')->with('products',$products)->render()
        ]);

    }

    public  function barcode_search($q){

        $products=AccountingProduct::where('bar_code',$q)->get();
        // $products_a=AccountingProduct::where('category_id',$id)->pluck('id','id')->toArray();

        return response()->json([
            'status'=>true,
            'data'=>view('AccountingSystem.buy_points.sell')->with('products',$products)->render()
        ]);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sell_login()
    {

        $users=User::where('is_saler',1)->pluck('name','id')->toArray();
        return view('AccountingSystem.buy_points.login',compact('users'));
    }

    /**
     *
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
        $cell =AccountingColumnCell::findOrFail($id);
        $columns=AccountingFaceColumn::pluck('name','id')->toArray();

        return $this->toEdit(compact('cell','columns'));


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
        $cell =AccountingColumnCell::findOrFail($id);
        $rules = [
            'name'=>'required|string|max:191',
            'column_id'=>'required|numeric|exists:accounting_face_columns,id',
        ];
        $this->validate($request,$rules);
        $requests = $request->all();
        $cell->update($requests);
        alert()->success('تم تعديل  الصف بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.cells.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shift =AccountingBranchShift::findOrFail($id);
        $shift->delete();

        alert()->success('تم حذف  الوردية بنجاح !')->autoclose(5000);
            return back();


    }
}
