<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBank;
use App\Models\AccountingSystem\AccountingBenod;
use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchCategory;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingCurrency;
use App\Models\AccountingSystem\AccountingMoneyClause;
use App\Models\AccountingSystem\AccountingProductCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class CurrencyController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.currencies.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $currencies=AccountingCurrency::all();
        return $this->toIndex(compact('currencies'));
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

            'ar_name'=>'required|string',
            'en_name'=>'required|string',

        ];
        $message=[
            'en_name.required'=>'اسم العملة باللغه الانجليزيه مطلوب ',
        ];
        $this->validate($request,$rules,$message);
        $requests = $request->all();
        AccountingCurrency::create($requests);
        alert()->success('تم حفظ العملة  بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.currencies.index');

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

        $currency=AccountingCurrency::find($id);


        return $this->toEdit(compact('currency'));
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
        $currency =AccountingCurrency::findOrFail($id);

        $rules = [

            'ar_name'=>'required|string',
            'en_name'=>'required|string',
        ];
        $message=[
            'en_name.required'=>'اسم العملة باللغه الانجليزيه مطلوب ',
        ];
        $this->validate($request,$rules,$message);
        $requests = $request->all();
        $currency->update($requests);
        alert()->success('تم تعديل  البنك بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.currencies.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $currency =AccountingCurrency::findOrFail($id);
        $currency->delete();
        alert()->success('تم حذف   العملة  بنجاح !')->autoclose(5000);
            return back();


    }



}
