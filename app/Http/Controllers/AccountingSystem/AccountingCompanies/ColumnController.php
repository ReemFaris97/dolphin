<?php

namespace App\Http\Controllers\AccountingSystem\AccountingCompanies;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchFace;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingFaceColumn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class ColumnController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.AccountingCompanies.columns.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns=AccountingFaceColumn::all()->reverse();
        return $this->toIndex(compact('columns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $faces=AccountingBranchFace::pluck('name','id')->toArray();
        return $this->toCreate(compact('faces'));
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

            'face_id'=>'required|numeric|exists:accounting_branch_faces,id',

        ];
        $this->validate($request,$rules);
        $requests = $request->all();

        AccountingFaceColumn::create($requests);
        alert()->success('تم اضافة  العمود بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.faces.index');
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
        $column =AccountingFaceColumn::findOrFail($id);
        $faces=AccountingBranch::pluck('name','id')->toArray();

        return $this->toEdit(compact('column','faces'));


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
        $column =AccountingFaceColumn::findOrFail($id);

        $rules = [

            'name'=>'required|string|max:191',

            'face_id'=>'required|numeric|exists:accounting_branch_faces,id',

        ];
        $this->validate($request,$rules);
        $requests = $request->all();
        $column->update($requests);
        alert()->success('تم تعديل  العمود بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.columns.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $column =AccountingFaceColumn::findOrFail($id);
        $column->delete();
        alert()->success('تم حذف  العمود بنجاح !')->autoclose(5000);
            return back();


    }
}
