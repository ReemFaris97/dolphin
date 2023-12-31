<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingAccount;
use App\Models\AccountingSystem\AccountingBank;
use App\Models\AccountingSystem\AccountingBenod;
use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchCategory;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingCurrency;
use App\Models\AccountingSystem\AccountingMoneyClause;
use App\Models\AccountingSystem\AccountingProductCategory;
use App\Models\AccountingSystem\AccountingSafe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class BankController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.banks.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $banks=AccountingBank::all();
        $safes=AccountingSafe::all();
        return $this->toIndex(compact('banks','safes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banks=AccountingBank::all();
        $safes=AccountingSafe::all();

        $currencies=AccountingCurrency::pluck('ar_name','id')->toArray();
        $branches=AccountingBranch::pluck('name','id')->toArray();
        return $this->toCreate(compact('branches','currencies','banks','safes'));
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

            'name'=>'required|string',
            'en_name'=>'required|string',
            'bank_number'=>'required|string',

        ];
        $message=[
            'en_name.required'=>'اسم البنك باللغه الانجليزيه مطلوب ',
            'bank_number.required'=>'رمز البنك مطلوب',
        ];
        $this->validate($request,$rules,$message);
        $requests = $request->all();
        AccountingBank::create($requests);
        alert()->success('تم حفظ البنك  بنجاح !')->autoclose(5000);
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

        $bank=AccountingBank::find($id);

        $currencies=AccountingCurrency::pluck('ar_name','id')->toArray();
        $branches=AccountingBranch::pluck('name','id')->toArray();

        return $this->toEdit(compact('bank','currencies','branches'));
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
        $bank =AccountingBank::findOrFail($id);

        $rules = [

            'name'=>'required|string',
            'en_name'=>'required|string',
            'bank_number'=>'required|string',
        ];
        $message=[
            'en_name.required'=>'اسم البنك باللغه الانجليزيه مطلوب ',
            'bank_number.required'=>'رمز البنك مطلوب',
        ];
        $this->validate($request,$rules,$message);
        $requests = $request->all();
        $bank->update($requests);
        $account=AccountingAccount::where('bank_id',$bank->id)->first();
        if ($account){

            $account->update([
              'ar_name'=>$request['name'],
              'en_name'=>$request['en_name'],
            ]);
        }
        alert()->success('تم تعديل  البنك بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.banks.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bank =AccountingBank::findOrFail($id);
        $bank->delete();
        alert()->success('تم حذف   البنك  بنجاح !')->autoclose(5000);
            return back();


    }


    public function getbenods($type)
    {

        $clauses=AccountingMoneyClause::where('type',$type)->get();
        return response()->json([
            'status'=>true,
            'data'=>view('AccountingSystem.benods.getAjaxBenods')->with('clauses',$clauses)->render()
        ]);


    }
}
