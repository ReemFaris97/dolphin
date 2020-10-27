<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchCategory;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingProductCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class CategoryController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.categories.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories =AccountingProductCategory::all()->reverse();
        return $this->toIndex(compact('categories'));
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

            'ar_name'=>'required|string|max:191|category_name:accounting_product_categories,ar_name,company_id,'.$request['ar_name'].','.$request['company_id'],
            'en_name'=>'nullable|string|max:191',
            'ar_description'=>'nullable|string',
            'en_description'=>'nullable|string',
            'image'=>'nullable|sometimes|image',
            'company_id'=>'required|numeric|exists:accounting_companies,id',



        ];
        $messsage = [
            'ar_name.category_name'=>"اسم التصنيف  موجود بالفعل بالشركة",
        ];
        $this->validate($request,$rules,$messsage);
        $requests = $request->except('image');
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'photos');
        }
        AccountingProductCategory::create($requests);
        alert()->success('تم اضافة  تصنيف القسم  بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.categories.index');
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
            'company_id'=>'required|numeric|exists:accounting_companies,id',

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
