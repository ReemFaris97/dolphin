<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingColumnCell;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingFaceColumn;
use App\Models\AccountingSystem\AccountingSafe;
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
        $devices =AccountingDevice::all()->reverse();
        return $this->toIndex(compact('devices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $companies=AccountingCompany::pluck('name','id')->toArray();
        $branches=AccountingBranch::pluck('name','id')->toArray();
        return $this->toCreate(compact('companies','branches'));

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

            'name'=>'required|string|max:191|device_name:accounting_devices,name,company_id,branch_id,'.$request['name'].','.$request['company_id'].','.$request['branch_id'],
            'code'=>'required|string|max:191|device_code:accounting_devices,code,company_id,branch_id,'.$request['code'].','.$request['company_id'].','.$request['branch_id'],

            // 'column_id'=>'required|numeric|exists:accounting_face_columns,id',

        ];
        $messsage = [
            'name.store_name'=>"اسم الجهاز موجود بالفعل بالشركة",
            'code.store_code'=>"كود الجهاز موجود بالفعل بالشركة",

        ];
        $this->validate($request,$rules,$messsage);
        $requests = $request->all();


        if ($requests['company_id']==NULL & $requests['branch_id']!=NULL)
        {
            $requests['model_id']= $requests['branch_id'];
               $requests[ 'model_type']='App\Models\AccountingSystem\AccountingBranch';
        }
        if ($requests['branch_id']==NULL & $requests['company_id']!=NULL)
        {
            $requests[ 'model_id']= $requests['company_id'];
             $requests[ 'model_type']='App\Models\AccountingSystem\AccountingCompany';
        }
        $device=AccountingDevice::create($requests);
        AccountingSafe::create([
            'device_id'=>$device->id,
            'name'=>$device->name,
            'status'=>'cashier',
            'model_type'=>$device->model_type='App\Models\AccountingSystem\AccountingBranch'?'App\Models\AccountingSystem\AccountingBranch':'App\Models\AccountingSystem\AccountingCompany',
            'model_id'=>$device->model_id,

        ]);
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
        $companies=AccountingCompany::pluck('name','id')->toArray();
        $branches=AccountingBranch::pluck('name','id')->toArray();

        return $this->toEdit(compact('device','branches','companies'));


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

        ];
        $this->validate($request,$rules);
        $requests = $request->all();
        $device->update($requests);


        if (array_key_exists('company_id',$requests)) {

            $device->update([
                'model_id' => $requests['company_id']
            ]);
        }elseif(array_key_exists('branch_id',$requests)) {


            $device->update([
                'model_id' => $requests['branch_id']
            ]);
        }
        alert()->success('تم تعديل  الصف بنجاح !')->autoclose(5000);
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
