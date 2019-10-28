<?php

namespace App\Http\Controllers\AccountingSystem\AccountingCompanies;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchCategory;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingMoneyClause;
use App\Models\AccountingSystem\AccountingProductCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class TranscationController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.AccountingCompanies.clauses.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clauses =AccountingMoneyClause::all()->reverse();
        return $this->toIndex(compact('clauses'));
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

            'ar_name'=>'required|string|max:191',
            'en_name'=>'nullable|string|max:191',
            'ar_description'=>'nullable|string',
            'en_description'=>'nullable|string',




        ];
        $this->validate($request,$rules);
        $requests = $request->all();

        AccountingMoneyClause::create($requests);
        alert()->success('تم اضافة  البند   بنجاح !')->autoclose(5000);
        return redirect()->route('company.clauses.index');
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
        $clause =AccountingMoneyClause::findOrFail($id);

        return $this->toEdit(compact('clause'));


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
        $clause =AccountingMoneyClause::findOrFail($id);

        $rules = [
            'ar_name'=>'required|string|max:191',
            'en_name'=>'nullable|string|max:191',
            'ar_description'=>'nullable|string',
            'en_description'=>'nullable|string',

        ];
        $this->validate($request,$rules);
        $requests = $request->all();

        $clause->update($requests);
        alert()->success('تم تعديل  البند بنجاح !')->autoclose(5000);
        return redirect()->route('company.clauses.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clause =AccountingMoneyClause::findOrFail($id);
        $clause->delete();
        alert()->success('تم حذف  البند بنجاح !')->autoclose(5000);
            return back();


    }
}
