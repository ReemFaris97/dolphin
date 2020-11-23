<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingDamage;
use App\Models\AccountingSystem\AccountingDamageProduct;

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

class StoreTransactionController extends Controller
{


    public  function transaction_form(){

        return view('AccountingSystem.stores.transactions');

    }


    public function productsingle(Request $request)
    {

        $ids=$request['ids'];
        $store_id=$request['store_id'];
        $store=AccountingStore::find($store_id);
        $products=AccountingProduct::whereIN('id',$ids)->get();

        return response()->json([
            'status'=>true,
            'data'=>view('AccountingSystem.stores.product',compact('products','store'))->render()
        ]);

    }

    public function store_products($id)
    {
        $store_product=AccountingProductStore::where('store_id',$id)->pluck('product_id','id')->toArray();
        $products=AccountingProduct::whereIn('id',$store_product)->pluck('name','id')->toArray();
        // dd(count($products));
        return response()->json([
            'status'=>true,
            'data'=>view('AccountingSystem.stores.store_products',compact('products'))->render()
        ]);

    }


    public function productsettlement(Request $request)
    {

        $ids=$request['ids'];
        $store_id=$request['store_id'];
       $store=AccountingStore::find($store_id);
        $products=AccountingProduct::whereIN('id',$ids)->get();

        return response()->json([
            'status'=>true,
            'data'=>view('AccountingSystem.stores.product_settlement',compact('products','store'))->render()
        ]);

    }



    public function productdamage(Request $request)
    {

        $ids=$request['ids'];
        $store_id=$request['store_id'];
        $store=AccountingStore::find($store_id);
        $products=AccountingProduct::whereIN('id',$ids)->get();

        return response()->json([
            'status'=>true,
            'data'=>view('AccountingSystem.stores.product_damaged',compact('products','store'))->render()
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
        $rules = [

            'quantity'=>'required',
        ];
        $massage=[
            'quantity.required'=>'اختر المخزن المحول منه ثم الاصناف المحولة',
        ];
        $this->validate($request,$rules,$massage);
        $quantity=collect($inputs['quantity']);
        $cost=collect($inputs['cost']);
        $price=collect($inputs['price']);
        $products=collect($inputs['product_id']);
        $merges=$products->zip($quantity,$cost,$price);
        $req=AccountingSroreRequest::create([
            'store_to' => $request['to_store_id'],
            'store_form' => $request['form_store_id'],
            'status'=>'pending',
             'user_id'=>$request['user_id'],
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
//                    /////////update product_store_to_quantity
                  $product_store_to = AccountingProductStore::where('store_id', $request['to_store_id'])->where('product_id',$merge[0])->first();

                  if (isset($product_store_to)) {
                        $product_store_to->update([
                            'quantity' => $product_store_to->quantity + $merge[1],
                        ]);
                    } else {
                        AccountingProductStore::create([
                            'product_id' => $merge[0],
                            'quantity' => $merge[1],
                            'store_id' => $request['to_store_id'],
                        ]);
                    }
                alert()->success('تم التحويل من المستودع بنجاح !')->autoclose(5000);

            } else {
                alert()->warning('الكميه بالمستودع المنقول منه غير كافية')->autoclose(5000);


            }//endcheckif

        }//endforeach

        session(['transaction' => $inputs]);

        alert()->success('تم اضافة  التحويل بنجاح !')->autoclose(5000);

        return view('AccountingSystem.stores.transaction_bond', compact('req'));






    }


    public  function  requests()
    {
        $current_store=\Auth::user()->accounting_store_id;
        $requests = AccountingSroreRequest::where('store_to',$current_store)->get();
        return view('AccountingSystem.stores.store_requests', compact('requests'));

    }
    public  function  requests_all()
    {
//        $current_store=\Auth::user()->accounting_store_id;
        $requests = AccountingSroreRequest::all();
        return view('AccountingSystem.stores.store_requests_all', compact('requests'));

    }

    public  function  request($id)
    {

        $transactions = AccountingTransaction::where('request_id',$id)->get();
        $request = AccountingSroreRequest::find($id);
        return view('AccountingSystem.stores.store_request', compact('transactions','request'));

    }


    public  function  request_detail($id)
    {

        $transactions = AccountingTransaction::where('request_id',$id)->get();
        $request = AccountingSroreRequest::find($id);
        return view('AccountingSystem.stores.store_request_detail', compact('transactions','request'));

    }



    public  function  request_($id)
    {

        $transactions = AccountingTransaction::where('request_id',$id)->get();
        $request = AccountingSroreRequest::find($id);
        return view('AccountingSystem.stores.store_request', compact('transactions','request'));

    }

    public  function  accept_request($id)
    {
        $req=AccountingSroreRequest::find($id);
        $req->update([
            'status'=>'accepted',
            'updated_at'=>Carbon::now(),
        ]);


        ////                    /////////update product_store_to_quantity

        $tansactions=AccountingTransaction::where('request_id',$req->id)->pluck('quantity', 'product_id')->toArray();
//         dd($tansactions);
        foreach ($tansactions as $product_id=>$quantity ) {
            $product_store_to = AccountingProductStore::where('store_id', $req->store_to)->where('product_id', $product_id)->first();

            if (isset($product_store_to)) {
                $product_store_to->update([
                    'quantity' => $product_store_to->quantity + $quantity,
                ]);
            } else {
                AccountingProductStore::create([
                    'product_id' => $product_id,
                    'quantity' => $quantity,
                    'store_id' => $req->store_to,
                ]);
            }
            alert()->success('تم  قبول الاستلام التحويل من المستودع بنجاح !')->autoclose(5000);
            return redirect()->route('accounting.stores.requests');
        }
    }
    public  function  refused_request(Request $request,$id)
    {

//        dd($request->all());

        $req=AccountingSroreRequest::find($id);
        $req->update([
            'status'=>'accepted',
            'refused_reason'=>$request['refused_reason'],
            'updated_at'=>Carbon::now(),
        ]);


        /////////update product_store_from_quantity

        $tansactions=AccountingTransaction::where('request_id',$req->id)->pluck('quantity', 'product_id')->toArray();
        foreach ($tansactions as $product_id=>$quantity ) {
            $product_store_from = AccountingProductStore::where('store_id', $req->store_from)->where('product_id', $product_id)->first();
            if (isset($product_store_to)) {
                $product_store_to->update([
                    'quantity' => $product_store_from->quantity - $quantity,
                ]);
            } else {
                AccountingProductStore::create([
                    'product_id' => $product_id,
                    'quantity' => $quantity,
                    'store_id' => $req->store_form,
                ]);
            }
            alert()->success('تم  رفض الاستلام التحويل من المستودع بنجاح !')->autoclose(5000);
            return redirect()->route('accounting.stores.requests');
        }

    }



    ////////////////////////////////////الاصناف التالفه






    public function damaged_create(){



        return view('AccountingSystem.stores.damaged_create');


    }
    public function damaged_store(Request $request){

        $inputs=$request->all();
        $rules = [
            'user_id'=>'required|numeric|exists:users,id',
            'quantity'=>'required',
        ];
    
        $massage=[
            'quantity.required'=>'اختر المخزن  ثم حددالاصناف التالفة',
        ];
        $this->validate($request,$rules,$massage);

        $quantity=collect($inputs['quantity']);
        $products=collect($inputs['product_id']);
        $merges=$products->zip($quantity);
      $damage= AccountingDamage::create([
            'store_id' => $request['store_id'],
            'user_id' => $request['user_id'],
        ]);

        foreach ($merges as $merge) {

           $damaged_product= AccountingDamageProduct::create([
                'product_id' => $merge[0],
                'quantity' => $merge[1],
                'damage_id' => $damage->id,
            ]);


            /////////update product_store_form_quantity
            $product_store_form = AccountingProductStore::where('store_id', $request['store_id'])->where('product_id',$merge[0])->first();
            //  dd($product_store_form->quantity-$request['quantity'] );
            if ($product_store_form->quantity - $merge[1] >= 0) {
                $product_store_form->update([
                    'quantity' => $product_store_form->quantity - $merge[1],
                ]);
            }
        }


        alert()->success('تم   تسجيل التالف من المستودع بنجاح !')->autoclose(5000);

        return redirect()->route('accounting.stores.damaged_index');
    }

    public function damaged_index(){

        $damages=AccountingDamage::all();

        return view('AccountingSystem.stores.damaged_index',compact('damages'));


    }

    public function damaged_show($id){

        $damage=AccountingDamage::find($id);
        $damage_products=AccountingDamageProduct::where('damage_id',$id)->get();

        return view('AccountingSystem.stores.show_damaged_products',compact('damage_products','damage'));


    }

}
