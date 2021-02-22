<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingUserHolidaysBalance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserHolidaysRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $holidaysRequests = AccountingUserHolidaysBalance::with('typeable','holiday','typeable.branch')->whereType('request')->get();
        return view('AccountingSystem.holidays_requests.index',compact('holidaysRequests'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::pluck('name','id');
        return view('AccountingSystem.holidays_requests.create',compact('users'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            $rules=[
                'typeable_id'=>'required',
                'holiday_id'=>'required',
                'days'=>'required',
                'start_date'=>'required'
            ];
        $this->validate($request,$rules);
        $userHolidaysBalance = AccountingUserHolidaysBalance::whereTypeableIdAndHolidayId($request->typeable_id,$request->holiday_id)->get();
        $startDate = Carbon::parse(now()->format('Y-m-01 00:00:00'));
        $endDate = Carbon::parse(now()->format('Y-m-31 23:59:59'));
        $balance = $userHolidaysBalance->where('type','balance')->sum('days');
        $requests = $userHolidaysBalance->where('type','request')
            ->where('start_date','>=',$startDate)
            ->where('start_date','<=',$endDate)->sum('days');
        if(($balance - $requests) < $request->days){
            alert()->success('يجب ان يكون طلب الاجازه اصغر من الرصيد الموجود!')->autoclose(5000);
            return back()->withInput($request->all());
        }
        $inputs = $request->all();
        $inputs['typeable_type'] = 'employee';
        AccountingUserHolidaysBalance::create($inputs);
        alert()->success('تم اضافة طلب الاجازة بنجاح !')->autoclose(5000);
        return back();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
