<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingClient;
use App\Models\AccountingSystem\AccountingColumnCell;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingFaceColumn;
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
}
