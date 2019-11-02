<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBenod;
use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchCategory;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingMoneyClause;
use App\Models\AccountingSystem\AccountingProductCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class BenodController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.benods.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return $this->toIndex();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clauses=AccountingMoneyClause::pluck('ar_name','id')->toArray();


        return $this->toCreate(compact('clauses'));
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


            'desc'=>'nullable|string',
            'image'=>'nullable|sometimes|image',



        ];
        $this->validate($request,$rules);
        $requests = $request->except('image');
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'photos');
        }
        AccountingBenod::create($requests);
        alert()->success('تم تسجيل البيان   بنجاح !')->autoclose(5000);
        return back();

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
        $category =AccountingProductCategory::findOrFail($id);

        return $this->toEdit(compact('category'));


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
        $category =AccountingProductCategory::findOrFail($id);

        $rules = [
            'ar_name'=>'required|string|max:191',
            'en_name'=>'nullable|string|max:191',
            'ar_description'=>'nullable|string',
            'en_description'=>'nullable|string',
            'image'=>'nullable|sometimes|image',
        ];
        $this->validate($request,$rules);
        $requests = $request->except('image');
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'photos');
        }
        $category->update($requests);
        alert()->success('تم تعديل  القسم بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.categories.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category =AccountingProductCategory::findOrFail($id);
        $category->delete();
        alert()->success('تم حذف  التصنيف بنجاح !')->autoclose(5000);
            return back();


    }
}
