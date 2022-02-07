<?php

namespace App\Http\Controllers\AccountingSystem;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingCostCenter;
use App\Traits\Viewable;
use DB;

class CostCenterController extends Controller
{
    use Viewable;
    private $viewable = "AccountingSystem.cost_centers.";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $centers = AccountingCostCenter::where("kind", "main")->get();
        return $this->toIndex(compact("centers"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $centers = AccountingCostCenter::whereIn("kind", [
            "main",
            "following_main",
        ])
            ->select("id", DB::raw("concat(name, ' - ',code) as code_name"))
            ->pluck("code_name", "id")
            ->toArray();

        return $this->toCreate(compact("centers"));
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

        AccountingCostCenter::create($requests);
        alert()
            ->success("تم اضافة   مركز التكلفة بنجاح !")
            ->autoclose(5000);
        return redirect()->route("accounting.costCenters.index");
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
        $center = AccountingCostCenter::findOrFail($id);
        $centers = AccountingCostCenter::whereIn("kind", [
            "sub",
            "following_main",
        ])
            ->select("id", DB::raw("concat(name, ' - ',code) as code_name"))
            ->pluck("code_name", "id")
            ->toArray();

        return $this->toEdit(compact("center", "centers"));
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
        $center = AccountingCostCenter::findOrFail($id);
        $rules = [
            "name" => "required|string|max:191",
        ];
        $this->validate($request, $rules);
        $requests = $request->all();

        $center->update($requests);
        alert()
            ->success("تم تعديل   مركز التكلفةبنجاح !")
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
        $center = AccountingCostCenter::findOrFail($id);
        $center->delete();
        alert()
            ->success("تم حذف   مركز التكلفة بنجاح !")
            ->autoclose(5000);
        return back();
    }

    public function active($id)
    {
        $center = AccountingCostCenter::findOrFail($id);
        $center->update([
            "active" => 1,
        ]);
        alert()
            ->success("تم تفعيل  مركز التكلفة  بنجاح !")
            ->autoclose(5000);
        return back();
    }

    public function dis_active($id)
    {
        $center = AccountingCostCenter::findOrFail($id);
        $center->update([
            "active" => 0,
        ]);
        alert()
            ->success("تم الغاء تفعيل مركز التكلفة  بنجاح !")
            ->autoclose(5000);
        return back();
    }
}
