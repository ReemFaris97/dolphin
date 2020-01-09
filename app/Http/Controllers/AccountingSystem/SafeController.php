<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingColumnCell;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingFaceColumn;
use App\Models\AccountingSystem\AccountingSafe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class SafeController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.safes.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $safes =AccountingSafe::all()->reverse();
        return $this->toIndex(compact('safes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $branches=AccountingBranch::pluck('name','id')->toArray();
        return $this->toCreate(compact('branches'));
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

            'code'=>'required|string|max:191',

            'branch_id'=>'required|numeric|exists:accounting_branches,id',

        ];
        $this->validate($request,$rules);
        $requests = $request->all();

        AccountingSafe::create($requests);
        alert()->success('تم اضافة  الخزينة بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.safes.index');
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
        $safe =AccountingSafe::findOrFail($id);
        $branches=AccountingBranch::pluck('name','id')->toArray();

        return $this->toEdit(compact('safe','branches'));


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
        $safe =AccountingSafe::findOrFail($id);
        $rules = [

            'code'=>'required|string|max:191',

            'branch_id'=>'required|numeric|exists:accounting_branches,id',

        ];
        $this->validate($request,$rules);
        $requests = $request->all();
        $safe->update($requests);
        alert()->success('تم تعديل الخزينة  بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.safes.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $safe =AccountingSafe::findOrFail($id);
        $safe->delete();
        alert()->success('تم حذف  الخزينة بنجاح !')->autoclose(5000);
            return back();

    }
}
