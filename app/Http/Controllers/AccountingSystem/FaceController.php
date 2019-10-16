<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchFace;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingCompany;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class FaceController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.faces.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faces =AccountingBranchFace::all()->reverse();
        return $this->toIndex(compact('faces'));
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

            'name'=>'required|string|max:191',

            'branch_id'=>'required|numeric|exists:accounting_branches,id',

        ];
        $this->validate($request,$rules);
        $requests = $request->all();

        AccountingBranchFace::create($requests);
        alert()->success('تم اضافة   الوجه  بنجاح !')->autoclose(5000);
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
        $face =AccountingBranchFace::findOrFail($id);
        $branches=AccountingBranch::pluck('name','id')->toArray();

        return $this->toEdit(compact('face','branches'));


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
        $face =AccountingBranchFace::findOrFail($id);

        $rules = [

            'name'=>'required|string|max:191',

            'branch_id'=>'required|numeric|exists:accounting_branches,id',
        ];
        $this->validate($request,$rules);
        $requests = $request->all();
        $face->update($requests);
        alert()->success('تم تعديل الوجه  بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.faces.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $face =AccountingBranchFace::findOrFail($id);
        $face->delete();
        alert()->success('تم حذف  الوجة بنجاح !')->autoclose(5000);
            return back();


    }
}
