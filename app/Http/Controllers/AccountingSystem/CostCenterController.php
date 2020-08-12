<?php

namespace App\Http\Controllers\AccountingSystem;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingCostCenter;
use App\Traits\Viewable;

class CostCenterController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.cost_centers.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $centers =AccountingCostCenter::all()->reverse();

        return $this->toIndex(compact('centers'));
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

        ];
        $this->validate($request,$rules);
        $requests = $request->all();

        AccountingCostCenter::create($requests);
        alert()->success('تم اضافة   مركز التكلفة بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.costCenters.index');
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
        $center =AccountingCostCenter::findOrFail($id);

        return $this->toEdit(compact('center'));


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

        $center =AccountingCostCenter::findOrFail($id);
        $rules = [

            'name'=>'required|string|max:191',

        ];
        $this->validate($request,$rules);
        $requests = $request->all();

        $center->update($requests);
        alert()->success('تم تعديل   مركز التكلفةبنجاح !')->autoclose(5000);
        return redirect()->route('accounting.fiscalYears.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $center =AccountingCostCenter::findOrFail($id);
        $center->delete();
        alert()->success('تم حذف   مركز التكلفة بنجاح !')->autoclose(5000);
            return back();


    }
}
