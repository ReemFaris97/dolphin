<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingOffer;
use App\Models\AccountingSystem\AccountingPackage;
use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingSale;
use App\Models\AccountingSystem\AccountingSaleItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingDevice;
use App\Models\AccountingSystem\AccountingProductStore;
use App\Models\AccountingSystem\AccountingReturn;
use App\Models\AccountingSystem\AccountingSession;
use App\Models\AccountingSystem\AccountingStore;
use App\Traits\Viewable;
use App\User;
use Auth;
use Carbon\Carbon;
use Cookie;
use Hash;
use Request as GlobalRequest;
use Session;

class SaleController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.sales.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales =AccountingSale::all()->reverse();
        return $this->toIndex(compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return $this->toCreate(compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requests = $request->all();
        if(!$request->client_id){

            $requests['client_id']=5;
        }


        $sale=AccountingSale::create($requests);
        $user=User::find($requests['user_id']);


        $sale->update([
            'bill_num'=>$sale->id."-".$sale->created_at,
            'user_id'=>$requests['user_id'] ,
            'store_id'=>$user->accounting_store_id,
            'debts'=>$requests['reminder'] ,
            'payment'=>'agel'
        ]);
        if($requests['discount_byPercentage']!=0&&$requests['discount_byAmount']==0){
            $sale->update([
                'discount_type'=>'percentage',
                'discount'=>$requests['discount_byPercentage'],

            ]);

        }elseif($requests['discount_byAmount']!=0&&$requests['discount_byPercentage']==0){

            $sale->update([
                'discount_type'=>'amount',
                'discount'=>$requests['discount_byAmount'],
            ]);
        }
        if($requests['reminder']==0){
            $sale->update([
            'payment'=>'cash'
            ]);
        }
        $products=$requests['product_id'];
        $quantities=$requests['quantity'];
        $products = collect($requests['product_id']);
        $qtys = collect($requests['quantity']);

        $merges = $products->zip($qtys);

        foreach ($merges as $merge)
        {
            $product=AccountingProduct::find($merge['0']);

            if($product->quantity>0){

            $item= AccountingSaleItem::create([
                'product_id'=>$merge['0'],
                'quantity'=> $merge['1'],
                'price'=>$product->selling_price,
                'sale_id'=>$sale->id
            ]);
            //update_product_quantity
            $product->update([
                'quantity'=>$product->quantity- $merge['1'],
            ]);
             //update_product_quantity_store
            $productstore=AccountingProductStore::where('store_id',$user->accounting_store_id)->where('product_id',$merge['0'])->first();
            $productstore->update([
                'quantity'=>$productstore->quantity - $merge['1'],
            ]);
        }
    }
        alert()->success('تمت عملية البيع بنجاح !')->autoclose(5000);
        return d()->with('sale_id',$sale->id);
    }


    public function store_returns(Request $request){


       $requests=$request->all();


       $items=collect($requests['item_id']);
       $quantities=collect($requests['quantity']);
       $merges=$items->zip($quantities);

        // dd($requests['session_id']);
       foreach($merges as $merge){
        AccountingReturn::create([
        'sale_id'=>$requests['sale_id'],
        'session_id'=>$requests['session_id'],
        'user_id'=>$requests['user_id'],
        'item_id'=>$merge[0],
        'quantity'=>$merge[1],
      ]);
      }

      dd($merges);
      //update_sale_item
      foreach($merges as $merge){
      $item= AccountingSaleItem::find($merge[0]);
      $item->update([
          'quantity'=>$merge[1],
      ]);


      }



      alert()->success('تم اضافة  فاتورة  الاسترجاع  بنجاح !')->autoclose(5000);
      return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $sale =AccountingSale::findOrFail($id);
        $product_items=AccountingSaleItem::where('sale_id',$id)->get();
        return $this->toShow(compact('sale','product_items'));
    }


    public function sale_end(Request $request,$id)
    {


           $user=User::findOrFail($id);
           $session=AccountingSession::findOrFail($request['session_id']);
           $sales_payed_cash=AccountingSale::where('session_id',$request['session_id'])->sum('cash');
           $sales_payed_network=AccountingSale::where('session_id',$request['session_id'])->sum('network');
           $sales_payed=AccountingSale::where('session_id',$request['session_id'])->sum('payed');
           $returns_total=AccountingReturn::where('session_id',$request['session_id'])->sum('price');



           $session->update([
            'end_session'=>Carbon::now(),
           ]);

        //    dd($session);
           if(!Hash::check($request['password'],$user->password)){

            return response('false', 200);
        }else{
            // dd('Write here your update password code');
            return view('AccountingSystem.sell_points.session_summary',compact('session','sales','sales_payed_cash','sales_payed_network','sales_payed','returns_total'));
        }


    }

    public function end_session($id){
        $session=AccountingSession::findOrFail($id);
        $users=User::where('is_saler',1)->pluck('name','id')->toArray();

           $session->update([
            'status'=>'closed',

           ]);

           $device=AccountingDevice::find($session->device_id);
           $device->update([
               'available'=>'1'
           ]);
        //    Session::forget('session_id');

           Cookie::queue(Cookie::forget('session'));

           return view('AccountingSystem.sell_points.login',compact('users'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shift =AccountingBranchShift::findOrFail($id);
        $branches=AccountingBranch::pluck('name','id')->toArray();

        return $this->toEdit(compact('shift','branches'));
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
        $shift =AccountingBranchShift::findOrFail($id);

        $rules = [
            'name'=>'required|string|max:191',
            'from'=>'required|string',
            'to'=>'required|string',
            'branch_id'=>'required|numeric|exists:accounting_branches,id',
        ];
        $this->validate($request,$rules);
        $requests = $request->all();
        $shift->update($requests);
        alert()->success('تم تعديل  الوردية بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.shifts.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shift =AccountingSale::findOrFail($id);
        $shift->delete();
        alert()->success('تم حذف  الفاتوره بنجاح !')->autoclose(5000);
            return back();



    }

    public  function  sale_order($id)
    {
        $package=AccountingPackage::find($id);
        $product_offers=AccountingOffer::where('package_id',$id)->get();

        $sale=AccountingSale::create([
            'amount'=>$package->total,
            'client_id'=>$package->client_id,
            'total'=>$package->total,
            'payment'=>'agel',
            'debts'=>$package->total,
            'package_id'=>$id
        ]);

        foreach ($product_offers as $offer){

            AccountingSaleItem::create([
                'product_id'=>$offer->product_id,
                'quantity'=>$offer->quantity,
                'price'=>$offer->price,
                'sale_id'=>$sale->id,
            ]);
        }

        alert()->success('تم امر البيع بنجاح !')->autoclose(5000);
        return back();

    }

    public function returns($id){

        $sales=AccountingSale::pluck('id','id')->toArray();
        $session=AccountingSession::findOrFail($id);


    return view('AccountingSystem.sales.returns',compact('sales','session'));
    }
    public function returns_Sale($id){

        $sale=AccountingSale::find($id);
        // $products_a=AccountingProduct::where('category_id',$id)->pluck('id','id')->toArray();

        return response()->json([
            'status'=>true,
            'data'=>view('AccountingSystem.sales.sale')->with('sale',$sale)->render()
        ]);
    }

    public function sale_details($id){

        $items=AccountingSaleItem::where('sale_id',$id)->get();
        // $products_a=AccountingProduct::where('category_id',$id)->pluck('id','id')->toArray();
        return response()->json([
            'status'=>true,
            'items'=>view('AccountingSystem.sales.items')->with('items',$items)->render()
        ]);
    }


    public function remove_Sale($id){

        $item=AccountingSaleItem::find($id);

        $item->delete();


    }

}
