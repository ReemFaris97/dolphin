<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBonusDiscount;
use App\Models\AccountingSystem\AccountingDocument;
use App\Models\User;
use App\Traits\Viewable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BonusDiscountController extends Controller
{
    use Viewable;
    private $viewable = "AccountingSystem.bouns_discount.";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bouns = AccountingBonusDiscount::with("typeable")->get();
        return $this->toIndex(compact("bouns"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::pluck("name", "id");
        return $this->toCreate(compact("users"));
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
            "value" => "required",
            "date" => "required",
        ];
        $this->validate($request, $rules);
        $requests = $request->all();
        $requests["typeable_type"] = "App\Models\User";
        AccountingBonusDiscount::create($requests);
        alert()
            ->success("تم اضافة الخصم او البونص بنجاح !")
            ->autoclose(5000);
        return redirect()->route("accounting.bonus-discount.index");
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
        $bonus = AccountingBonusDiscount::findOrFail($id);
        return $this->toEdit(compact("bonus", "users"));
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
        $bonus = AccountingBonusDiscount::findOrFail($id);
        $rules = [
            "typeable_id" => "required",
            "type" => "required",
            "value" => "required",
            "date" => "required",
        ];
        $this->validate($request, $rules);
        $requests = $request->all();
        $requests["typeable_type"] = "App\Models\User";
        $bonus->update($requests);
        alert()
            ->success("تم تعديل الخصم او البونص بنجاح !")
            ->autoclose(5000);
        return redirect()->route("accounting.bonus-discount.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AccountingBonusDiscount::find($id)->delete();
        alert()
            ->success("تم  الحذف بنجاح !")
            ->autoclose(5000);
        return back();
    }
}
