<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchFace;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingFaceColumn;
use App\Models\AccountingSystem\AccountingIndustrial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class IndustrialController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.industrials.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $industrials=AccountingIndustrial::all()->reverse();
        return $this->toIndex(compact('industrials'));
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

        AccountingIndustrial::create($requests);
        alert()->success('تم اضافة  الشركة المصنعة بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.industrials.index');
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
        $industrial=AccountingIndustrial::findOrFail($id);

        return $this->toEdit(compact('industrial'));


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
        $industrial =AccountingIndustrial::findOrFail($id);

        $rules = [

            'name'=>'required|string|max:191',


        ];
        $this->validate($request,$rules);
        $requests = $request->all();
        $industrial->update($requests);
        alert()->success('تم تعديل  العمود بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.industrials.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $industrial =AccountingIndustrial::findOrFail($id);
        $industrial->delete();
        alert()->success('تم حذف  الشركة المصنعة بنجاح !')->autoclose(5000);
            return back();
    }
}
