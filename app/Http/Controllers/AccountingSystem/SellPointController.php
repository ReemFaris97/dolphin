<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingColumnCell;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingFaceColumn;
use App\Models\AccountingSystem\AccountingProductCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class SellPointController extends Controller
{
    use Viewable;
//    private $viewable = 'AccountingSystem.sells_points.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sell_point()
    {
        $categories=AccountingProductCategory::all();
//foreach ($categories as $category){
//  dd($category->products()->get());
//}

        return  view('AccountingSystem.sell_points.sell_point',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $columns=AccountingFaceColumn::pluck('name','id')->toArray();
        return $this->toCreate(compact('columns'));
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

            'column_id'=>'required|numeric|exists:accounting_face_columns,id',

        ];
        $this->validate($request,$rules);
        $requests = $request->all();

        AccountingColumnCell::create($requests);
        alert()->success('تم اضافة  الصف بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.columns.index');
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
        $cell =AccountingColumnCell::findOrFail($id);
        $columns=AccountingFaceColumn::pluck('name','id')->toArray();

        return $this->toEdit(compact('cell','columns'));


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
        $cell =AccountingColumnCell::findOrFail($id);
        $rules = [

            'name'=>'required|string|max:191',

            'column_id'=>'required|numeric|exists:accounting_face_columns,id',
        ];
        $this->validate($request,$rules);
        $requests = $request->all();
        $cell->update($requests);
        alert()->success('تم تعديل  الصف بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.cells.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shift =AccountingBranchShift::findOrFail($id);
        $shift->delete();
        alert()->success('تم حذف  الوردية بنجاح !')->autoclose(5000);
            return back();


    }
}
