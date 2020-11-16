<?php

namespace App\Http\Controllers\Distributor;

use App\Models\DistributorCar;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class CarsController extends Controller
{

    use Viewable;
    private  $viewable = 'distributor.cars.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = DistributorCar::all()->reverse();
        return $this->toIndex(compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::whereIsDistributor(1)->get()->reverse();
        return $this->toCreate(compact('users'));
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
            'user_id'=>'required|numeric|exists:users,id',
            'car_name'=>'required|string|max:191',
            'car_model'=>"required|string|max:191",
        ];
        $this->validate($request,$rules);
        DistributorCar::create($request->all());
        toast('تم إضافة السيارة بنجاح','success','top-right');
        return redirect()->route('distributor.cars.index');
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
        $car = DistributorCar::findOrFail($id);
        $users = User::whereIsDistributor(1)->get()->reverse();
        return $this->toEdit(compact('users','car'));
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
        $car = DistributorCar::find($id);

        $rules = [
            'user_id'=>'required|numeric|exists:users,id',
            'car_name'=>'required|string|max:191',
            'car_model'=>"required|string|max:191",
        ];
        $this->validate($request,$rules);
        $car->update($request->all());
        toast('تم تعديل السيارة بنجاح','success','top-right');
        return redirect()->route('distributor.cars.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DistributorCar::find($id)->delete();
        toast('تم حذف السيارة بنجاح','success','top-right');
        return redirect()->route('distributor.cars.index');
    }

    public function changeStatus($id)
    {
        $item=DistributorCar::find($id);
        if ($item->is_active == 1) {
            $item->update(['is_active'=>0]);
            toast('تم إلغاء التفعيل بنجاح','success','top-right');
            return redirect()->route('distributor.cars.index');
        } else {
            $item->update(['is_active'=>1]);
            toast('تم  التفعيل بنجاح','success','top-right');
            return redirect()->route('distributor.cars.index');
        }
    }
}
