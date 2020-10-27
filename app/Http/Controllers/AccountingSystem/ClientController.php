<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingClient;
use App\Models\AccountingSystem\AccountingColumnCell;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingFaceColumn;
use App\Models\AccountingSystem\AccountingPackage;
use App\Models\AccountingSystem\AccountingPermium;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class ClientController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.clients.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients =AccountingClient::all()->reverse();
        return $this->toIndex(compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return $this->toCreate();
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

            'name'=>'required|string|max:191',
            'phone'=>'required|numeric|unique:accounting_clients,phone',
            'email'=>'required|string|unique:accounting_clients,email',



        ];
        $this->validate($request,$rules);
        $requests = $request->all();
            if (getsetting('automatic_clients')==1){
                $requests['account_id']=getsetting('accounting_id_clients');
            }

        AccountingClient::create($requests);
        alert()->success('تم اضافة  العميل بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.clients.index');
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
        $client =AccountingClient::findOrFail($id);

        return $this->toEdit(compact('client'));


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
            'phone'=>'required|numeric|unique:accounting_clients,phone,'.$client->id,
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

    public function  permiums()
    {
        $clients=AccountingClient::pluck('name','id')->toArray();
        return view("AccountingSystem.clients.permiums",compact('clients'));

    }

    public function  permium_store(Request $request)
    {
        $inputs=$request->all();
        AccountingPermium::create([$inputs]);
        alert()->success('تم تقسيط مديونيه   العميل بنجاح !')->autoclose(5000);

        return back();


    }


    public function  offer_copy()
    {
        $clients=AccountingClient::pluck('name','id')->toArray();

        return view("AccountingSystem.clients.offers_copy",compact('clients'));


    }

    public function  copy(Request $request)
    {
        $inputs=$request->all();

        $first_client_id =$inputs['first_client_id'];
        $second_client_id=$inputs['second_client_id'];
        $packages=AccountingPackage::where('client_id',$first_client_id)->get();
            foreach ($packages as $package)
            {
                $newpackage= New AccountingPackage();
                $newpackage= $package->replicate();
                $newpackage->client_id=$second_client_id;
                $newpackage->save();
            }
        alert()->success('تم نسخ عروض    العميل بنجاح !')->autoclose(5000);
        return back();


    }


    public function getClient($id){
        $client=AccountingClient::find($id);
        return response()->json([
            'status'=>true,
            'data'=>($client->balance)
        ]);
    }

}
