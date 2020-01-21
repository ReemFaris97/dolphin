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
use App\Models\AccountingSystem\AccountingSession;
use App\Traits\Viewable;
use App\User;
use Auth;
use Carbon\Carbon;
use Request as GlobalRequest;

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
    // dd($requests);

        $rules = [

            'client_id'=>'required|numeric|exists:accounting_clients,id',
                // 'reminder'=>'required|numeric|gt:0',

        ];
        $this->validate($request,$rules);

        $sale=AccountingSale::create($requests);
    //    dd($sale);
        $sale->update([
            'bill_num'=>$sale->id."-".$sale->created_at,
            'user_id'=>$requests['user_id'] ,
        ]);
        //  dd($sale);

        $products=$requests['product_id'];
        $quantities=$requests['quantity'];
//        $total=0;
//        for ($i=0;$i<count($products);$i++){
//            $product=AccountingProduct::find($products[$i]);
//            $price=$product->selling_price;
//
//            for ($j=0;$j<count($quantities);$j++){
//
//                if ($i==$j){
//
//                    $total+=$price* $quantities[$j];
//                }
//
//            }
//
//        }

        $products = collect($requests['product_id']);
        $qtys = collect($requests['quantity']);

        $merges = $products->zip($qtys);

        foreach ($merges as $merge)
        {
            $product=AccountingProduct::find($merge['0']);
            $item= AccountingSaleItem::create([
                'product_id'=>$merge['0'],
                'quantity'=> $merge['1'],
                'price'=>$product->selling_price,
                'sale_id'=>$sale->id
            ]);
        }




        alert()->success('تمت عملية البيع بنجاح !')->autoclose(5000);
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

        // dd($request->all());
        $session=AccountingSession::findOrFail($id);
        $session->update([
         'end_session'=>Carbon::now(),
         'custody'=>$request['custody'],
        ]);


        $users=User::where('is_saler',1)->pluck('name','id')->toArray();
        alert()->success(' تم اغلاق  الجلسة بنجاح!')->autoclose(5000);

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

    public function returns(){

        $sales=AccountingSale::pluck('id','id')->toArray();

    return view('AccountingSystem.sales.returns',compact('sales'));
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



}
