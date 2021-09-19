<?php

namespace App\Http\Controllers\AccountingSystem;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingCostCenter;
use App\Models\AccountingSystem\AccountingJobTitle;
use App\Traits\Viewable;

class JobTitleController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.job_titles.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titles =AccountingJobTitle::all()->reverse();

        return $this->toIndex(compact('titles'));
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
            'name'=>'required|string|max:191|unique:accounting_job_titles,id',
        ];
        $this->validate($request, $rules);
        $requests = $request->all();
        AccountingJobTitle::create($requests);
        alert()->success('تم اضافة  المسمى الوظيفى بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.jobTitles.index');
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
        $title =AccountingJobTitle::findOrFail($id);

        return $this->toEdit(compact('title'));
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
        $title =AccountingJobTitle::findOrFail($id);
        $rules = [

            'name'=>'required|string|max:191|unique:accounting_job_titles,id,'.$id,

        ];
        $this->validate($request, $rules);
        $requests = $request->all();

        $title->update($requests);
        alert()->success('تم تعديل المسمى الوظيفى بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.jobTitles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $title =AccountingJobTitle::findOrFail($id);
        $title->delete();
        alert()->success('تم حذف   المسمى الوظيفى بنجاح !')->autoclose(5000);
        return back();
    }

    public function active($id)
    {
        $title =AccountingJobTitle::findOrFail($id);
        $title->update([
            'active'=>1
        ]);
        alert()->success('تم تفعيل  المسمى الوظيفى بنجاح !')->autoclose(5000);
        return back();
    }


    public function dis_active($id)
    {
        $title =AccountingJobTitle::findOrFail($id);
        $title->update([
            'active'=>0
        ]);
        alert()->success('تم الغاء تفعيل  المسمى الوظيفى بنجاح !')->autoclose(5000);
        return back();
    }
}
