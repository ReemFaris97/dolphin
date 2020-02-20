<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingColumnCell;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingFaceColumn;
use App\Models\AccountingSystem\AccountingSafe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingDevice;
use App\Models\AccountingSystem\AccountingTransactionSafe;
use App\Traits\Viewable;

class SafeController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.safes.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $safes =AccountingSafe::all()->reverse();
        $safes_followed =AccountingSafe::where("type",0)->get();

        return $this->toIndex(compact('safes','safes_followed'));
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

            'name'=>'required|string|max:191',


        ];
        $this->validate($request,$rules);
        $requests = $request->all();

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

        AccountingSafe::create($requests);
        alert()->success('تم اضافة الخزينة بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.safes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $transactions=AccountingTransactionSafe::where('safe_form_id',$id)->get();
    //   dd($transactions);
      return $this->toShow(compact('transactions'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $safe =AccountingSafe::findOrFail($id);
        $companies=AccountingCompany::pluck('name','id')->toArray();
        $branches=AccountingBranch::pluck('name','id')->toArray();
        return $this->toEdit(compact('safe','branches'));


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
        $safe =AccountingSafe::findOrFail($id);
        $rules = [

            'code'=>'required|string|max:191',

            'branch_id'=>'required|numeric|exists:accounting_branches,id',

        ];
        $this->validate($request,$rules);
        $requests = $request->all();
        $safe->update($requests);


        if (array_key_exists('company_id',$requests)) {

            $safe->update([
                'model_id' => $requests['company_id']
            ]);
        }elseif(array_key_exists('branch_id',$requests)) {


            $safe->update([
                'model_id' => $requests['branch_id']
            ]);
        }
        alert()->success('تم تعديل الخزينة  بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.safes.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $safe =AccountingSafe::findOrFail($id);
        $safe->delete();
        alert()->success('تم حذف  الخزينة بنجاح !')->autoclose(5000);
            return back();

    }


    public  function company_devices($id){

        $devices=AccountingDevice::where('model_id',$id)->where('model_type','App\Models\AccountingSystem\AccountingCompany')->pluck('name','id')->toArray();
    //    dd($devices);
        return response()->json([
            'status'=>true,
            'data'=>view('AccountingSystem.safes.basic_device')->with('devices',$devices)->render()
        ]);
    }

    public  function branch_devices($id){

        $devices=AccountingDevice::where('model_id',$id)->where('model_type','App\Models\AccountingSystem\AccountingBranch')->pluck('ar_name','id')->toArray();
        return response()->json([
            'status'=>true,
            'data'=>view('AccountingSystem.safes.basic_device')->with('devices',$devices)->render()
        ]);

    }


    public function transactionsafe_store(Request $request,$id){

        $inputs=$request->all();
        // dd($inputs);
            AccountingTransactionSafe::create([
                'safe_form_id'=>$inputs['safe_form_id'],
                'safe_to_id'=>$inputs['safe_to_id'],
                'amount'=>$inputs['amount'],
                'notes'=>$inputs['notes'],
            ]);

        $safe_form=AccountingSafe::where('id',$inputs['safe_form_id'])->first();
        $safe_to=AccountingSafe::where('id',$inputs['safe_to_id'])->first();
                    if($safe_form->amount>=0){
                        $safe_form->update([
                            'amount'=>$safe_form->amount - $inputs['amount']
                        ]);
                        $safe_to->update([
                            'amount'=>$safe_to->amount +$inputs['amount']
                        ]);
                    }




        alert()->success('تم  اضافة التحويل من الخزنة بنجاح !')->autoclose(5000);
        return back();
    }
}
