<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingColumnCell;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingFaceColumn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;
use phpDocumentor\Reflection\Types\Null_;

class CellController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.cells.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cells =AccountingColumnCell::all()->reverse();
        return $this->toIndex(compact('cells'));
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
        return redirect()->route('accounting.cells.index');
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

//        'column_id'=>'required|numeric|exists:accounting_face_columns,id',
        ];
        $this->validate($request,$rules);
        $requests = $request->all();
        if ($requests['column_id']==Null){
            $requests['column_id']=$cell-> column_id;
        }
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
        $shift =AccountingColumnCell::findOrFail($id);
        $shift->delete();
        alert()->success('تم حذف  الخليه بنجاح !')->autoclose(5000);
            return back();


    }
}
