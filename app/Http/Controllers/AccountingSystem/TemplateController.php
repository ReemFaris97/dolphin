<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingAccount;
use App\Models\AccountingSystem\AccountingAllowance;
use App\Models\AccountingSystem\AccountingTemplate;
use App\Traits\Viewable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TemplateController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.templates.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates =AccountingTemplate::all()->reverse();

        return $this->toIndex(compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accounts=AccountingAccount::select(['ar_name','id'])->get();
        return $this->toCreate(compact('accounts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
        $rules = [
            'name'=>'required|string|max:191',
        ];
        $this->validate($request,$rules);
        $requests = $request->all();
        AccountingTemplate::create($requests);
        alert()->success('تم اضافة  البدلات بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.templates.index');

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
            'name'=>'required|string|max:191',
        ];
        $this->validate($request,$rules);
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
