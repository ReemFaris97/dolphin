<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBond;
use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingInventory;
use App\Models\AccountingSystem\AccountingInventoryProduct;
use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingProductStore;
use App\Models\AccountingSystem\AccountingSroreRequest;
use App\Models\AccountingSystem\AccountingStore;
use App\Models\AccountingSystem\AccountingTransaction;
use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class StoreController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.stores.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores =AccountingStore::all()->reverse();
       // dd($stores);
        return $this->toIndex(compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $companies=AccountingCompany::pluck('name','id')->toArray();
        $branches=AccountingBranch::pluck('name','id')->toArray();
        return $this->toCreate(compact('companies','branches'));
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

            'ar_name'=>'required|string|max:191',
            'en_name'=>'nullable|string|max:191',
            'image'=>'nullable|sometimes|image',
            'company_id'=>'nullable|numeric|exists:accounting_companies,id',

        ];
        $this->validate($request,$rules);
        $requests = $request->except('image');
       // dd($requests);

        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'photos');
        }


        if ($requests['company_id']==NULL & $requests['branch_id']!=NULL)
        {

            $requests['model_id']= $requests['branch_id'];
               $requests[ 'model_type']='App\Models\AccountingSystem\AccountingBranch';
                


        }
        if ($requests['branch_id']==NULL & $requests['company_id']!=NULL)
        {

            $requests[ 'model_id']= $requests['company_id'];
             $requests[ 'model_type']='App\Models\AccountingSystem\AccountingCompany';

        }
//dd($requests);
       AccountingStore::create($requests);

        alert()->success('تم اضافة  الفرع بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.stores.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $store =AccountingStore::findOrFail($id);


        return $this->toShow(compact('store'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $store =AccountingStore::findOrFail($id);
        $companies=AccountingCompany::pluck('name','id')->toArray();
        $branches=AccountingBranch::pluck('name','id')->toArray();
        return $this->toEdit(compact('store','companies','branches'));
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
        $store =AccountingStore::findOrFail($id);

        $rules = [
            'ar_name'=>'required|string|max:191',
            'en_name'=>'nullable|string|max:191',
            'image'=>'nullable|sometimes|image',
            'company_id'=>'nullable|numeric|exists:accounting_companies,id',
        ];
     //   dd($request->all());
        $this->validate($request,$rules);
        $requests = $request->except('image');
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'photos');
        }


        $store->update($requests);

        if (array_key_exists('company_id',$requests)) {

            $store->update([
                'model_id' => $requests['company_id']
            ]);
        }elseif(array_key_exists('branch_id',$requests)) {


            $store->update([
                'model_id' => $requests['branch_id']
            ]);
        }
        alert()->success('تم تعديل  المخزن بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.stores.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $store =AccountingStore::findOrFail($id);
        $store->delete();
        alert()->success('تم حذف  المخزن بنجاح !')->autoclose(5000);
            return back();

    }

    public function first_balances(){

        $stores=AccountingStore::pluck('ar_name','id')->toArray();
        $branches=AccountingBranch::pluck('name','id')->toArray();
        $allproducts=AccountingProduct::pluck('name','id')->toArray();
        return view('AccountingSystem.stores.first_balances_report',compact('stores','branches','allproducts'));

    }

    public function balances_filter(Request $request){

//        dd($request);
        $inputs=$request->all();
//        dd($inputs);
        if ($inputs['status']==0){
                $stores = AccountingStore::where('model_type','App\Models\AccountingSystem\AccountingBranch')->whereIn('model_id',$inputs['branch_id'])->pluck('id')->toArray();
                $product_quantity=AccountingProductStore::where('product_id',$inputs['product_id'])->whereIn('store_id',$inputs['store_id'])->where('created_at','>=',$inputs['date'])->sum('quantity');

        }
        $product=AccountingProduct::find($inputs['product_id']);

        return response()->json([
            'status'=>true,
            'data'=>view('AccountingSystem.stores.single_product')->with('product',$product)->render()
        ]);

    }

    public function store_product($id){
        $products=AccountingProductStore::where('store_id',$id)->get();
//
//        $products=AccountingProduct::whereIn('id',$product_store)->get();
        $store =AccountingStore::findOrFail($id);
        $stores=AccountingStore::where('id','!=',$id)->pluck('ar_name','id')->toArray();
    //dd($products);


        $all_stores=AccountingStore::all();
        $storess=$all_stores->except($id);
        return view('AccountingSystem.stores.product',compact('products','store','stores','storess'));
    }

    public function store_products_copy(Request $request,$id){

    $products_id=AccountingProductStore::where('store_id',$request["store_id"])->pluck('product_id')->toArray();

//          dd($products_id);

          foreach ($products_id as $product_id){
          AccountingProductStore::create([
              'store_id'=>$id,
              'product_id'=>$product_id
          ]);

          }
        alert()->success('تم نسخ الاصناف  المخزن بنجاح !')->autoclose(5000);
        return back();
    }

    public function settlements(){

        $stores=AccountingStore::pluck('ar_name','id')->toArray();
        $products=[];
        return view('AccountingSystem.stores.settlements',compact('stores','products'));

    }
    public  function settlements_store(Request $request){
        $store_id=$request['store_id'];
        $stores=AccountingStore::pluck('ar_name','id')->toArray();
//dd($store_id);
        $product_store=AccountingProductStore::where('store_id',$store_id)->pluck('id')->toArray();
        $products=AccountingProduct::whereIn('id',$product_store ) ->get();
       // dd($products);
        return view('AccountingSystem.stores.settlements',compact('stores','products'));

    }


    public function getproducts($id)
    {


        return products($id);
    }

    public function getkeepers($id)
    {


        return keepers($id);
    }

    public  function  products_exchange_form(){

        $products=AccountingProduct::all();
        return view('AccountingSystem.stores.products_exchange_form',compact('products'));

    }

    public  function  bond_store(Request $request)
    {

        $inputs = $request->all();
//        dd($inputs);
        $bond = AccountingBond::create($inputs);
//        $totalprice=$inputs[]
//        foreach ($inputs['prices'] as $price ){
//
//        }
        $products_store = AccountingProductStore::where('store_id', $bond->store_id)->get();
        $quantity = collect($inputs['qtys']);
        $products = collect($inputs['products']);
        $prices = collect($inputs['prices']);

        $merges = $products->zip($quantity,$prices);
        if ($bond->type == 'entry') {
            foreach ($products_store as $productstore) {
                foreach ($merges as $merge) {
                    if ($productstore->product_id == $merge[0]) {
                        $productstore->update([
                            'product_id' => $merge[0],
                            'quantity' => $productstore->quantity + $merge[1],
                            'band_id' => $bond->id
                        ]);
                    }
                }
            }
        } else {
            foreach ($products_store as $productstore) {
            foreach ($merges as $merge) {
                if ($productstore->product_id == $merge[0]) {
                    $productstore->update([
                        'product_id' => $merge[0],
                        'quantity' => $productstore->quantity - $merge[1],
                        'band_id' => $bond->id
                    ]);
                }
            }
        }
    }
        alert()->success('تم اضافة  سند الادخال  المخزن بنجاح !')->autoclose(5000);
        return view('AccountingSystem.stores.show_bond',compact('inputs','merges'));
    }



    public  function  products_exchange_store(Request $request){




    }


    public  function company_stores($id){

        $basic_stores=AccountingStore::where('model_id',$id)->where('model_type','App\Models\AccountingSystem\AccountingCompany')->pluck('ar_name','id')->toArray();


        return response()->json([
            'status'=>true,
            'data'=>view('AccountingSystem.stores.basic_store')->with('basic_stores',$basic_stores)->render()
        ]);

    }

    public  function branch_stores($id){

        $basic_stores=AccountingStore::where('model_id',$id)->where('model_type','App\Models\AccountingSystem\AccountingBranch')->pluck('ar_name','id')->toArray();


        return response()->json([
            'status'=>true,
            'data'=>view('AccountingSystem.stores.basic_store')->with('basic_stores',$basic_stores)->render()
        ]);

    }

}

