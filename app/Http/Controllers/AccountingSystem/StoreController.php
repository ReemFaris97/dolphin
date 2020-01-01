<?php

namespace App\Http\Controllers\AccountingSystem;

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

    public function inventory(){
        $stores=AccountingStore::pluck('ar_name','id')->toArray();
        $products=[];
        return view('AccountingSystem.stores.inventory',compact('stores','products'));

    }


    public  function inventory_store(Request $request)
    {
        $store_id = $request['store_id'];
        $stores = AccountingStore::pluck('ar_name', 'id')->toArray();

        $product_store = AccountingProductStore::where('store_id', $store_id)->wheredate('created_at', '=', $request['date'])->pluck('id')->toArray();


        $products = AccountingProduct::whereIn('id', $product_store)->get();

        $inventory = AccountingInventory::create([
            'date' => $request['date'],
            'store_id' => $store_id,
            'user_id' => \Auth::user()->id,

        ]);

        if (isset($products)) {
              foreach ($products as $product) {
           $inventory_product= AccountingInventoryProduct::create([
                'inventory_id' => $inventory->id,
                'product_id'=>$product->id,
                'quantity'=>$product->quantity,

            ]);
        }
    }

        alert()->success('تم  حفظ جرد المخزن بنجاح !')->autoclose(5000);

        return view('AccountingSystem.stores.inventory',compact('stores','products','inventory'));

    }
    public  function inventory_settlement(Request $request){


    $inputs=$request->all();
   //dd($inputs);
    $inventory_product=AccountingInventoryProduct::where('inventory_id',$inputs['inventory_id'])->where('product_id',$inputs['product_id'])->first();
   $inventory_product->update([
       'Real_quantity'=>$inputs['Real_quantity'],
       'status'=>1,
       'updated_at'=>Carbon::now()->format('Y-m-d')
   ]);



    }

    public  function invertory_filters(){

        $stores = AccountingStore::pluck('ar_name', 'id')->toArray();
        $inventories=[];

        return view('AccountingSystem.stores.invertory_filter',compact('stores','inventories'));
    }

    public  function inventory_filter(Request $request)
    {


        $inputs = $request->all();
        $stores = AccountingStore::pluck('ar_name', 'id')->toArray();

        $inventories= AccountingInventory::where('store_id', $inputs['store_id'])->wheredate('created_at', $inputs['date'])->get();

        return view('AccountingSystem.stores.invertory_filter',compact('stores','inventories'));

    }
    public function invertory_details($id){


        $inventory_products=AccountingInventoryProduct::where('inventory_id',$id)->get();
        $inventory= AccountingInventory::find($id);
        return view('AccountingSystem.stores.invertory_details',compact('inventory_products','inventory'));
    }

    public  function transaction_form(){

        return view('AccountingSystem.stores.transactions');

    }


    public function getproducts($id)
    {


        return products($id);
    }


    public function productsingle(Request $request)
    {

        $ids=$request['ids'];

        $products=AccountingProduct::whereIN('id',$ids)->get();

        return response()->json([
            'status'=>true,
            'data'=>view('AccountingSystem.stores.product')->with('products',$products)->render()
        ]);

    }



    public function transaction(Request $request,$id){

        $inputs=$request->all();
   //  dd($inputs);
      $trans=  AccountingTransaction::create([
            'product_id'=>$request['product_id'],
            'quantity'=>$request['quantity'],

            'store_to'=>$request['store_to'],
            'store_form'=>$id,
        ]);
    //  dd($trans);


        /////////update product_store_form_quantity
        $product_store_form=AccountingProductStore::where('store_id',$id)->where('product_id',$request['product_id'])->first();
        if ($product_store_form->quantity-$request['quantity'] >= 0)
        {
            $product_store_form->update([
                'quantity' => $product_store_form->quantity - $request['quantity'],
            ]);
        }
        /////////update product_store_to_quantity


        $product_store_to=AccountingProductStore::where('store_id',$request['store_to'])->where('product_id',$request['product_id'])->first();

        if (isset($product_store_to)){
        $product_store_to->update([
                'quantity'=>$product_store_to->quantity+$request['quantity'],
        ]);
            }else{
            AccountingProductStore::create([

                'product_id'=>$request['product_id'],
                'quantity'=>$request['quantity'],
                'store_id'=>$request['store_to'],
            ]);
        }

        alert()->success('تم النقل من المستودع بنجاح !')->autoclose(5000);
        return back();



    }







    public function transactions(Request $request){

        $inputs=$request->all();

        $quantity=collect($inputs['quantity']);
        $cost=collect($inputs['cost']);
        $price=collect($inputs['price']);
        $products=collect($inputs['product_id']);
        $merges=$products->zip($quantity,$cost,$price);
            $req=AccountingSroreRequest::create([
          'store_to' => $request['to_store_id'],
         'store_form' => $request['form_store_id'],
           'status'=>'pending'

            ]);
            foreach ($merges as $merge) {

                $trans = AccountingTransaction::create([

                    'product_id' => $merge[0],
                    'quantity' => $merge[1],

                    'cost' => $merge[2],
                    'price' => $merge[3],
                    'request_id'=>$req->id,
                ]);

               $store_form = $request['form_store_id'];


               /////////update product_store_form_quantity
              $product_store_form = AccountingProductStore::where('store_id', $store_form)->where('product_id',$merge[0])->first();
             //  dd($product_store_form->quantity-$request['quantity'] );
               if ($product_store_form->quantity - $merge[1] >= 0) {
                  $product_store_form->update([
                       'quantity' => $product_store_form->quantity - $merge[1],
                    ]);
//
////                    /////////update product_store_to_quantity
//                  $product_store_to = AccountingProductStore::where('store_id', $request['to_store_id'])->where('product_id',$merge[0])->first();
//
//                  if (isset($product_store_to)) {
//                        $product_store_to->update([
//                            'quantity' => $product_store_to->quantity + $merge[1],
//                        ]);
//                    } else {
//                        AccountingProductStore::create([
//                            'product_id' => $merge[0],
//                            'quantity' => $merge[1],
//                            'store_id' => $request['to_store_id'],
//                        ]);
//                    }
                  alert()->success('تم التحويل من المخزن بنجاح !')->autoclose(5000);

              } else {
                    alert()->warning('الكميه بالمخزن المنقول منه غير كافية')->autoclose(5000);


                }//endcheckif

            }//endforeach
            alert()->success('تم اضافة سند التحويل بنجاح !')->autoclose(5000);
        return back();





    }


    public  function  requests()
    {
$current_store=\Auth::user()->accounting_store_id;
        $requests = AccountingSroreRequest::where('store_form',$current_store)->get();
        return view('AccountingSystem.stores.store_requests', compact('requests'));

    }

    public  function  request($id)
    {

        $transactions = AccountingTransaction::where('request_id',$id)->get();
        $request = AccountingSroreRequest::find($id);
        return view('AccountingSystem.stores.store_request', compact('transactions','request'));

    }
        public  function  products_entry_form(){

        $products=AccountingProduct::all();
        return view('AccountingSystem.stores.products_entry_form',compact('products'));

    }

    public  function  products_entry_store(Request $request){

dd($request->all());



    }

    public  function  products_exchange_form(){

        $products=AccountingProduct::all();
        return view('AccountingSystem.stores.products_exchange_form',compact('products'));

    }

    public  function  products_exchange_store(Request $request){

        dd($request->all());



    }

}

