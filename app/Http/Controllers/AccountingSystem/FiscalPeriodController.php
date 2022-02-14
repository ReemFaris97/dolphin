<?php

namespace App\Http\Controllers\AccountingSystem;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingFiscalPeriod;
use App\Models\AccountingSystem\AccountingFiscalYear;
use App\Traits\Viewable;

class FiscalPeriodController extends Controller
{
    use Viewable;
    private $viewable = "AccountingSystem.fiscal_periods.";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periods = AccountingFiscalPeriod::all()->reverse();
        return $this->toIndex(compact("periods"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $years = AccountingFiscalYear::pluck("name", "id")->toArray();
        return $this->toCreate(compact("years"));
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
            "name" => "sometimes",
            "year_id" => "required|numeric|exists:accounting_fiscal_years,id",
        ];
        $this->validate($request, $rules);
        $requests = $request->all();
        if ($requests["type"] == "automatic") {
            if ($requests["duration"] == "monthly") {
                foreach (months() as $key => $month) {
                    AccountingFiscalPeriod::create([
                        "year_id" => $requests["year_id"],
                        "type" => $requests["type"],
                        "duration" => $requests["duration"],
                        "name" => $key,
                    ]);
                }
            }
            if ($requests["duration"] == "quarterly") {
                foreach (quarterly() as $key => $month) {
                    AccountingFiscalPeriod::create([
                        "year_id" => $requests["year_id"],
                        "type" => $requests["type"],
                        "duration" => $requests["duration"],
                        "name" => $key,
                    ]);
                }
            }
            if ($requests["duration"] == "half") {
                AccountingFiscalPeriod::create([
                    "year_id" => $requests["year_id"],
                    "type" => $requests["type"],
                    "duration" => $requests["duration"],
                    "name" => 1,
                ]);
                AccountingFiscalPeriod::create([
                    "year_id" => $requests["year_id"],
                    "type" => $requests["type"],
                    "duration" => $requests["duration"],
                    "name" => 2,
                ]);
            }
            if ($requests["duration"] == "yearly") {
                AccountingFiscalPeriod::create([
                    "year_id" => $requests["year_id"],
                    "type" => $requests["type"],
                    "duration" => $requests["duration"],
                    "name" => "year",
                ]);
            }
        } elseif ($requests["type"] == "manual") {
            AccountingFiscalPeriod::create($requests);
        }
        alert()
            ->success("تم اضافة  الفترة المالية بنجاح !")
            ->autoclose(5000);
        return redirect()->route("accounting.fiscalPeriods.index");
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
        $period = AccountingFiscalPeriod::findOrFail($id);
        $years = AccountingFiscalYear::pluck("name", "id")->toArray();
        return $this->toEdit(compact("period", "years"));
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
        $period = AccountingFiscalPeriod::findOrFail($id);
        $rules = [
            "name" => "required|string|max:191",
            "year_id" => "required|numeric|exists:accounting_fiscal_years,id",
        ];
        $this->validate($request, $rules);
        $requests = $request->all();

        $period->update($requests);
        alert()
            ->success("تم تعديل  الفترة المالية بنجاح !")
            ->autoclose(5000);
        return redirect()->route("accounting.fiscalPeriods.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $period = AccountingFiscalPeriod::findOrFail($id);
        $period->delete();
        alert()
            ->success("تم حذف  الفتره المالية بنجاح !")
            ->autoclose(5000);
        return back();
    }
}
