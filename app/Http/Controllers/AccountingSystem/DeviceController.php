<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingCompany;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;
use App\Models\AccountingSystem\AccountingDevice;

class DeviceController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.devices.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devices =AccountingDevice::latest()->get();
        return $this->toIndex(compact('devices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies=AccountingCompany::pluck('name', 'id')->toArray();
        $branches=AccountingBranch::pluck('name', 'id')->toArray();
        return $this->toCreate(compact('companies', 'branches'));
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
            'code'=>'nullable|string|max:191|unique:accounting_devices,code',
            'model_id'=>'required|integer',
        ];
     
        $this->validate($request, $rules);

        $requests = $request->all();
        $requests['model_type']=AccountingBranch::class;


      
        AccountingDevice::create($requests);
       
        alert()->success('تم اضافة  الجهاز بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.devices.index');
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
        $device=AccountingDevice::findOrFail($id);
        $companies=AccountingCompany::pluck('name', 'id')->toArray();
        $branches=AccountingBranch::pluck('name', 'id')->toArray();

        return $this->toEdit(compact('device', 'branches', 'companies'));
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
        $device =AccountingDevice::findOrFail($id);
        $rules = [
            'name'=>'required|string|max:191',
            'code'=>'nullable|string|max:191|unique:accounting_devices,code,'.$id,
            'model_id'=>'required|integer',
        ];
        $this->validate($request, $rules);
        $requests = $request->all();
        $device->update($requests);
        alert()->success('تم تعديل  الجهاز بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.devices.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $device =AccountingDevice::findOrFail($id);
        $device->delete();
        alert()->success('تم حذف  الجهاز بنجاح !')->autoclose(5000);
        return back();
    }
}
