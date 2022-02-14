<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingHoliday;
use App\Models\AccountingSystem\AccountingUserHolidaysBalance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Validation\ValidationException;

class UserHolidaysRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $holidaysRequests = AccountingUserHolidaysBalance::with(
            "typeable",
            "holiday"
        )
            ->whereType("request")
            ->latest()
            ->get();
        return view(
            "AccountingSystem.holidays_requests.index",
            compact("holidaysRequests")
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
        $holidays = AccountingHoliday::pluck("name", "id");

        return view(
            "AccountingSystem.holidays_requests.create",
            compact("users", "holidays")
        );
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
            "holiday_id" => "required",
            "days" => "required",
            "start_date" => "required",
        ];
        $this->validate($request, $rules);
        $userHolidaysBalance = AccountingUserHolidaysBalance::whereTypeableIdAndHolidayId(
            $request->typeable_id,
            $request->holiday_id
        )->get();
        $startDate = Carbon::parse(now()->format("Y-m-01 00:00:00"));
        $endDate = Carbon::parse(now()->format("Y-m-31 23:59:59"));
        $balance = $userHolidaysBalance->where("type", "balance")->sum("days");
        $requests = $userHolidaysBalance
            ->where("type", "request")
            ->where("start_date", ">=", $startDate)
            ->where("start_date", "<=", $endDate)
            ->sum("days");
        $user = User::find($request->typeable_id);
        $holiday = AccountingHoliday::findOrFail($request->holiday_id);

        if ($user->holiday_balance < $request->days) {
            //            alert()->error('','يجب ان يكون طلب الاجازه اصغر من الرصيد الموجود! !')->persistent(true,false);
            throw ValidationException::withMessages([
                "days" => ["يجب ان يكون طلب الاجازه اصغر من الرصيد الموجود! !"],
            ]);
            //            return back();
        } else {
            $inputs = $request->all();
            $inputs["typeable_type"] = "App\Models\User";
            AccountingUserHolidaysBalance::create($inputs);
            //            $user->holiday_balance=$user->holiday_balance - $holiday->duration;
            //            $user->save();
            $user->update([
                "holiday_balance" => $user->holiday_balance - $request->days,
            ]);

            //            dd($user->holiday_balance);
            alert()
                ->success("تم اضافة طلب الاجازة بنجاح !")
                ->autoclose(5000);
            return back();
        }
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
        $holidays = AccountingHoliday::pluck("name", "id");
        $request = collect(AccountingUserHolidaysBalance::find($id))->toArray();
        $request["start_date"] = Carbon::parse($request["start_date"])->format(
            "Y-m-d"
        );
        $request = (object) $request;
        return view(
            "AccountingSystem.holidays_requests.edit",
            compact("holidays", "users", "request")
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
        $holiday = AccountingUserHolidaysBalance::find($id);
        $request->validate([
            "typeable_id" => "required",
            "holiday_id" => "required",
            "days" => "required",
            "start_date" => "required",
        ]);

        $userHolidaysBalance = AccountingUserHolidaysBalance::query()
            ->where("typeable_id", $request->typeable_id)
            ->where("holiday_id", $request->holiday_id)
            ->where("id", "!=", $id)
            ->get();
        $startDate = now()->startOfMonth();
        $endDate = now()->endOfMonth();
        $balance = $userHolidaysBalance->where("type", "balance")->sum("days");
        $requests = $userHolidaysBalance
            ->where("type", "request")
            ->where("start_date", ">=", $startDate)
            ->where("start_date", "<=", $endDate)
            ->sum("days");
        if ($balance < $request->days) {
            throw ValidationException::withMessages([
                "typeable_id" => [
                    "يجب ان يكون طلب الاجازه اصغر من الرصيد الموجود! !",
                ],
            ]);
        } else {
            $inputs = $request->all();
            $inputs["typeable_type"] = User::class;
            $holiday->update($inputs);
            alert()
                ->success("تم  التعديل بنجاح !")
                ->autoclose(5000);
            return redirect()->route("accounting.holidays-requests.index");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AccountingUserHolidaysBalance::find($id)->delete();
        alert()
            ->success("تم  الحذف بنجاح !")
            ->autoclose(5000);
        return back();
    }
    public function getUserData($id)
    {
        $user = User::with("holidays")->find($id);
        $data = [
            "role" => $user->role->name ?? "---",
            "nationality" => $user->nationality ?? "---",
            "branch" => optional($user->branch)->name ?? "---",
            "holiday_balance" => $user->holiday_balance ?? "---",
        ];
        $holidays = $user->holidays
            ->transform(function ($q) {
                $q["pivot_data"] = $q->pivot;
                return $q;
            })
            ->groupBy("id");
        $startDate = Carbon::parse(now()->format("Y-m-01 00:00:00"));
        $endDate = Carbon::parse(now()->format("Y-m-31 23:59:59"));
        $data["holidays"] = [];
        foreach ($holidays as $holiday) {
            $balance = $holiday
                ->where("pivot_data.type", "balance")
                ->sum("pivot_data.days");
            $requests = $holiday
                ->where("pivot_data.type", "request")
                ->where("pivot_data.start_date", ">=", $startDate)
                ->where("pivot_data.start_date", "<=", $endDate)
                ->sum("pivot_data.days");
            $data["holidays"][] = [
                "name" => optional($holiday->first())->name,
                "balance" => $balance - $requests . " " . "",
            ];
        }
        return response()->json($data);
    }
}
