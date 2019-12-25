<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingClient;
use App\Models\AccountingSystem\AccountingNotifiaction;
use App\Models\AccountingSystem\AccountingOffer;
use App\Models\AccountingSystem\AccountingPackage;
use App\Models\AccountingSystem\AccountingProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;
use Illuminate\Support\Facades\Mail;

class OfferController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.offers.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers =AccountingOffer::all()->reverse();
        return $this->toIndex(compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $products=AccountingProduct::all();
        $clients=AccountingClient::pluck('name','id')->toArray();

        return $this->toCreate(compact('products','clients'));
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

            'client_id'=>'required|numeric|exists:accounting_clients,id',





        ];
        $this->validate($request,$rules);
        $requests = $request->all();
//        dd($requests);
       $qtys=$requests['qtys'];
       $prices=$requests['prices'];
        $total=0;
       for ($i=0;$i<count($qtys);$i++){

           for ($j=0;$j<count($prices);$j++){

               if ($i==$j){

                   $total+=$qtys[$i]* $prices[$j];
               }

           }

       }


       $package= AccountingPackage::create([
            'client_id'=>$requests['client_id'],
            'total'=>$total
        ]);

       $client=AccountingClient::find($requests['client_id']);
       ////////////////////////

        $products = collect($requests['products']);
        $qtys = collect($requests['qtys']);
        $prices = collect($requests['prices']);
        $merges = $products->zip($qtys,$prices);

        foreach ($merges as $merge)

        {
            $offer= AccountingOffer::create(['product_id'=>$merge['0'],'quantity'=> $merge['1'],'price'=>$merge['2'],'package_id'=>$package->id]);

        }

        Mail::send('AccountingSystem.offers.offer', ['package' => $package,'client'=>$client], function ($message) use ($client) {
            $message->to($client->email)
                ->subject('عرض اسعار');

        });


//        return response()->json(['message' => 'Request completed']);
        alert()->success('تم  ارسال  العرض  للعميل بنجاح !')->autoclose(5000);
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
        $products=AccountingProduct::all();
        $clients=AccountingClient::pluck('name','id')->toArray();

        return $this->toEdit(compact('clients','products'));


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
        $client =AccountingClient::findOrFail($id);
        $rules = [

            'name'=>'required|string|max:191',

            'phone'=>'required|numeric|exists:accounting_clients,id',
        ];
        $this->validate($request,$rules);
        $requests = $request->all();
        $client->update($requests);
        alert()->success('تم تعديل  العميل بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.clients.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client =AccountingClient::findOrFail($id);
        $client->delete();
        alert()->success('تم حذف  العميل بنجاح !')->autoclose(5000);
            return back();


    }
    public function getAjaxProductQty(Request $request){
        $product = AccountingProduct::find($request->id);
        return response()->json([
            'data'=>$product->qty
        ]);
    }

    public function  notification(Request $request,$id){

       $inputs=$request->all();

       AccountingNotifiaction::create([
           'client_id'=>$request['client_id'],
           'package_id'=>$id,
       ]);

       $package=AccountingPackage::find($id);
        $package->update([
            'status'=>$request['status'],
        ]);

        return response()->json(['message' => 'تم القبول']);

    }


}
