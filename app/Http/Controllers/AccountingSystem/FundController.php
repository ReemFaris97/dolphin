<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingColumnCell;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingFaceColumn;
use App\Models\AccountingSystem\AccountingFund;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingDevice;
use App\Models\AccountingSystem\AccountingTransactionFund;
use App\Traits\Viewable;

class FundController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.funds.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $funds = AccountingFund::query()->latest()->get();

        return $this->toIndex(compact('funds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = AccountingCompany::pluck('name', 'id')->toArray();
        $branches = AccountingBranch::pluck('name', 'id')->toArray();
        return $this->toCreate(compact('companies', 'branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs=$request->validate([
            'name'=>['required','string','max:255'],
            'name_en'=>['required','string','max:255'],
            'company_id'=>['nullable','integer','exists:accounting_companies,id'],
            'branch_id'=>['nullable','integer','exists:accounting_branches,id'],
            'is_bank'=>['nullable','boolean'],
            'bank_account_number'=>['nullable','string','required_if:is_bank,==,1','max:100'],
            'description'=>['nullable','string'],
          ]);
        AccountingFund::create($inputs);
        alert()->success('تم اضافة الخزينة بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.funds.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fund = AccountingFund::findOrFail($id);
        //branch_all_funds
        //حسبى الله ونعم والوكيل فى اللى كتب الكود
        $funds= AccountingFund::where('id', '!=', $id)->get();

        return $this->toShow(compact('transactions', 'fund', 'funds'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fund = AccountingFund::findOrFail($id);
        $companies = AccountingCompany::pluck('name', 'id');
        $branches = AccountingBranch::pluck('name', 'id');
        return $this->toEdit(compact('fund', 'branches', 'companies'));
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
        $fund = AccountingFund::findOrFail($id);
        $inputs=$request->validate([
            'name'=>['required','string','max:255'],
            'name_en'=>['required','string','max:255'],
            'company_id'=>['nullable','integer','exists:accounting_companies,id'],
            'branch_id'=>['nullable','integer','exists:accounting_branches,id'],
            'is_bank'=>['nullable','boolean'],
            'bank_account_number'=>['nullable','string','required_if:is_bank,==,1','max:100'],
            'description'=>['nullable','string'],
          ]);
        $fund->update($inputs);

        alert()->success('تم تعديل الخزينة  بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.funds.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AccountingFund::destroy($id);
        alert()->success('تم حذف  الخزينة بنجاح !')->autoclose(5000);
        return back();
    }
}
