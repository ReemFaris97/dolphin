<?php

namespace App\Http\Controllers\AccountingSystem;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingAsset;
use App\Models\AccountingSystem\AccountingCostCenter;
use App\Models\AccountingSystem\AccountingJobTitle;
use App\Traits\Viewable;

class AssetCustodyController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.assets_custodies.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $assets=AccountingAsset::all()->reverse();

        return $this->toIndex(compact('assets'));
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

        ];
        $this->validate($request,$rules);
        $requests = $request->all();

        AccountingAsset::create($requests);
        alert()->success('تم اضافة  الاصل بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.assets-custodies.index');
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
        $asset =AccountingAsset::findOrFail($id);

        return $this->toEdit(compact('asset'));


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

        $asset =AccountingAsset::findOrFail($id);
        $rules = [

            'name'=>'required|string|max:191',

        ];
        $this->validate($request,$rules);
        $requests = $request->all();

        $asset->update($requests);
        alert()->success('تم تعديل المسمى الوظيفى بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.assets-custodies.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asset =AccountingAsset::findOrFail($id);
        $asset->delete();
        alert()->success('تم حذف  الاصل بنجاح !')->autoclose(5000);
            return back();


    }


}
