<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingCompany;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class CompanyController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.companies.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = AccountingCompany::all()->reverse();
        return $this->toIndex(compact('companies'));
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
            'phone'=>'required|numeric|unique:accounting_companies,phone',
            'email'=>'required|string|unique:accounting_companies,email',
            'password'=>'required|string|max:191',
            'image'=>'nullable|sometimes|mimes:jpg,jpeg,gif,png',
        ];
        $this->validate($request,$rules);
        $requests = $request->except('image');
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'photos');
        }
        AccountingCompany::create($requests);
        alert()->success('تم اضافة  الشركة بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.companies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company =AccountingCompany::findOrFail($id);
        $branches=AccountingBranch::where('company_id',$id)->get();
        return $this->toShow(compact('company','branches'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company =AccountingCompany::findOrFail($id);

        return $this->toEdit(compact('company'));


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
        $company =AccountingCompany::findOrFail($id);

        $rules = [

            'name'=>'required|string|max:191',
            'phone'=>'required|numeric|unique:accounting_companies,phone,'.$company->id,
            'email'=>'required|string|unique:accounting_companies,email,'.$company->id,
            'image'=>'nullable|sometimes|mimes:jpg,jpeg,gif,png'
        ];
        $this->validate($request,$rules);
        $requests = $request->except('image');
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'photos');
        }
        $company->update($requests);
        alert()->success('تم تعديل  الشركة بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.companies.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company =AccountingCompany::findOrFail($id);
        $company->delete();
        alert()->success('تم حذف  الشركة بنجاح !')->autoclose(5000);
            return back();


    }
}
