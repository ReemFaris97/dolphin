<?php

namespace App\Http\Controllers\AccountingSystem\AccountingCompanies;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingCompany;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class ShiftController extends Controller
{
    use Viewable;
    private $viewable = "AccountingSystem.AccountingCompanies.shifts.";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shifts = auth("accounting_companies")->user()->shifts;

        return $this->toIndex(compact("shifts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = AccountingBranch::where(
            "company_id",
            auth("accounting_companies")->user()->id
        )
            ->pluck("name", "id")
            ->toArray();
        return $this->toCreate(compact("branches"));
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
            "name" => "required|string|max:191",
            "from" => "required|string",
            "to" => "required|string",
            "branch_id" => "required|numeric|exists:accounting_branches,id",
        ];
        $this->validate($request, $rules);
        $requests = $request->all();

        AccountingBranchShift::create($requests);
        alert()
            ->success("تم اضافة  الوردية للفرع  بنجاح !")
            ->autoclose(5000);
        return redirect()->route("company.shifts.index");
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
        $shift = AccountingBranchShift::findOrFail($id);
        $branches = AccountingBranch::where(
            "company_id",
            auth("accounting_companies")->user()->id
        )
            ->pluck("name", "id")
            ->toArray();

        return $this->toEdit(compact("shift", "branches"));
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
        $shift = AccountingBranchShift::findOrFail($id);

        $rules = [
            "name" => "required|string|max:191",
            "from" => "required|string",
            "to" => "required|string",
            "branch_id" => "required|numeric|exists:accounting_branches,id",
        ];
        $this->validate($request, $rules);
        $requests = $request->all();
        $shift->update($requests);
        alert()
            ->success("تم تعديل  الوردية بنجاح !")
            ->autoclose(5000);
        return redirect()->route("company.shifts.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shift = AccountingBranchShift::findOrFail($id);
        $shift->delete();
        alert()
            ->success("تم حذف  الوردية بنجاح !")
            ->autoclose(5000);
        return back();
    }
}
