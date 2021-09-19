<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingAllowance;
use App\Traits\Viewable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AllowanceController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.allowances.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allowances =AccountingAllowance::all()->reverse();

        return $this->toIndex(compact('allowances'));
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
            'name'=>'required|string|max:191|unique:accounting_allowances,name',
        ];
        $this->validate($request, $rules);
        $requests = $request->all();
        AccountingAllowance::create($requests);
        alert()->success('تم اضافة  البدلات بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.allowances.index');
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
        $allowance =AccountingAllowance::findOrFail($id);
        return $this->toEdit(compact('allowance'));
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
        $allowance =AccountingAllowance::findOrFail($id);
        $rules = [
            'name'=>'required|string|max:191|unique:accounting_allowances,name,'.$id,
        ];
        $this->validate($request, $rules);
        $requests = $request->all();
        $allowance->update($requests);
        alert()->success('تم تعديل البدلات بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.allowances.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AccountingAllowance::find($id)->delete();
        alert()->success('تم  الحذف بنجاح !')->autoclose(5000);
        return back();
    }
}
