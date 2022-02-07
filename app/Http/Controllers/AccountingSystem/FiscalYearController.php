<?php

namespace App\Http\Controllers\AccountingSystem;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingFiscalYear;
use App\Traits\Viewable;

class FiscalYearController extends Controller
{
    use Viewable;
    private $viewable = "AccountingSystem.fiscal_years.";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $years = AccountingFiscalYear::all()->reverse();
        return $this->toIndex(compact("years"));
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
            "name" => "required|string|max:191",
        ];
        $this->validate($request, $rules);
        $requests = $request->all();

        AccountingFiscalYear::create($requests);
        alert()
            ->success("تم اضافة  السنة المالية بنجاح !")
            ->autoclose(5000);
        return redirect()->route("accounting.fiscalYears.index");
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
        $year = AccountingFiscalYear::findOrFail($id);

        return $this->toEdit(compact("year"));
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
        $year = AccountingFiscalYear::findOrFail($id);
        $rules = [
            "name" => "required|string|max:191",
        ];
        $this->validate($request, $rules);
        $requests = $request->all();

        $year->update($requests);
        alert()
            ->success("تم تعديل  السنة المالية بنجاح !")
            ->autoclose(5000);
        return redirect()->route("accounting.fiscalYears.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $year = AccountingFiscalYear::findOrFail($id);
        $year->delete();
        alert()
            ->success("تم حذف  السنه المالية بنجاح !")
            ->autoclose(5000);
        return back();
    }
}
