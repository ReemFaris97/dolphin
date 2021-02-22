<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Debt;
use App\Models\AccountingSystem\AccountingDebt;
use App\Models\AccountingSystem\AccountingDebtPayment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DebtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $debts = AccountingDebt::with('typeable','payments')->get()->transform(function($q){
            $q['all_payments'] = $q->paymentWithPayed();
            return $q;
        });
        return view('AccountingSystem.debts.index',compact('debts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::pluck('name','id');
        return view('AccountingSystem.debts.create',compact('users'));
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
            'typeable_id'=>'required',
            'date'=>'required',
            'reason'=>'required',
            'payments_count'=>'required',
            'pay_from'=>'required',
            'value'=>'required'
        ];
        $this->validate($request,$rules);
        $requests = $request->all();
        $requests['typeable_type'] = 'employee';
        AccountingDebt::create($requests);
        alert()->success('تم اضافة  السلفة بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.debts.index');

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
        $users =User::pluck('name','id');
        $debt = AccountingDebt::find($id)->toArray();
        $debt['date'] = Carbon::parse($debt['date'])->format('Y-m-d');
        $debt['pay_from'] = Carbon::parse($debt['pay_from'])->format('Y-m-d');
        $debt = (object)$debt;
        return view('admin.debts.edit',compact('debt','users'));
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
        $debt=AccountingDebt::findOrFail($id);
        $rules = [
            'typeable_id'=>'required',
//            'type'=>'required',
            'value'=>'required',
            'date'=>'required'
        ];
        $this->validate($request,$rules);
        $requests = $request->all();
        $requests['typeable_type'] = 'employee';
        $debt->update($requests);
        alert()->success('تم تعديل السلفة بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.debts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AccountingDebt::find($id)->delete();
        alert()->success('تم  الحذف بنجاح !')->autoclose(5000);
        return back();
    }
    public function payDebt(Request $request,$id){
        $debt = AccountingDebt::find($id);
        $debt->payments()->create($request->all());
        alert()->success('تم  التعديل بنجاح !')->autoclose(5000);
        return back();
    }
}
