<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingAttendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendances = AccountingAttendance::with("typeable")->get();
        return view(
            "AccountingSystem.attendances.index",
            compact("attendances")
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::pluck("name", "id");

        return view("AccountingSystem.attendances.create", compact("users"));
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
            "typeable_id" => "required",
            "type" => "required",
            "date" => "required",
        ];

        $this->validate($request, $rules);

        $inputs = $request->all();
        //        $inputs['typeable_type'] = 'employee';
        $inputs["date"] = Carbon::parse($request->date);
        $user = User::find($request->typeable_id);
        $user->attendances()->create($request->only("date"));
        alert()
            ->success("تم  التسجيل بنجاح !")
            ->autoclose(5000);
        return redirect()->route("accounting.attendances.index");
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
        $users = User::pluck("name", "id");
        $attendance = AccountingAttendance::find($id)->toArray();
        $attendance["date"] = Carbon::parse($attendance["date"])->format(
            "Y-m-d\TH:i"
        );
        $attendance = (object) $attendance;
        return view(
            "AccountingSystem.attendances.edit",
            compact("attendance", "users")
        );
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
        $attendance = AccountingAttendance::find($id);

        $rules = [
            "typeable_id" => "required",
            "type" => "required",
            "date" => "required",
        ];

        $this->validate($request, $rules);

        $inputs = $request->all();
        $inputs["date"] = Carbon::parse($request->date);
        $attendance->update($inputs);
        alert()
            ->success("تم  تعديل التسجيل بنجاح !")
            ->autoclose(5000);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attendance = AccountingAttendance::findOrFail($id);
        $attendance->delete();
        alert()
            ->success("تم حذف  التسجيل بنجاح !")
            ->autoclose(5000);
        return back();
    }
}
