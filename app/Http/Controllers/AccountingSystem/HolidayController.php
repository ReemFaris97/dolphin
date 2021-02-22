<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingHoliday;
use App\Traits\Viewable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HolidayController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.holidays.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $holidays =AccountingHoliday::all()->reverse();

        return $this->toIndex(compact('holidays'));
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
            'duration'=>'required|string|max:191',
        ];
        $this->validate($request,$rules);
        $requests = $request->all();
        AccountingHoliday::create($requests);
        alert()->success('تم اضافة  الاجازة بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.holidays.index');

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
        $holiday =AccountingHoliday::findOrFail($id);

        return $this->toEdit(compact('holiday'));

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
        $holiday =AccountingHoliday::findOrFail($id);
        $rules = [

            'name'=>'required|string|max:191',

        ];
        $this->validate($request,$rules);
        $requests = $request->all();

        $holiday->update($requests);
        alert()->success('تم تعديل الاجازة بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.holidays.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AccountingHoliday::find($id)->delete();
        alert()->success('تم  الحذف بنجاح !')->autoclose(5000);
        return back();
    }
}
