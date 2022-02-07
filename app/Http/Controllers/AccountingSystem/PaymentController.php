<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBank;
use App\Models\AccountingSystem\AccountingBenod;
use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchCategory;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingCurrency;
use App\Models\AccountingSystem\AccountingMoneyClause;
use App\Models\AccountingSystem\AccountingPayment;
use App\Models\AccountingSystem\AccountingProductCategory;
use App\Models\AccountingSystem\AccountingSafe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class PaymentController extends Controller
{
    use Viewable;
    private $viewable = "AccountingSystem.payments.";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = AccountingPayment::all();
        return $this->toIndex(compact("payments"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $safes = AccountingSafe::pluck("name", "id")->toArray();
        $banks = AccountingBank::pluck("name", "id")->toArray();
        $payments = AccountingPayment::all();

        return $this->toCreate(compact("safes", "banks", "payments"));
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
            "name" => "required|string",
            "bank_id" => "required_if:type,bank",
            "safe_id" => "required_if:type,safe",
        ];
        $message = [
            "name.required" => "مسمى خيار الدفع مطلوب ",
            "bank_id.required_if" => "اسم البنك  مطلوب ",
            "safe_id.required_if" => "اسم الصندوق  مطلوب ",
        ];
        $this->validate($request, $rules, $message);
        $requests = $request->all();
        AccountingPayment::create($requests);
        alert()
            ->success("تم حفظ خيار الدفع  بنجاح !")
            ->autoclose(5000);
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
        $payment = AccountingPayment::find($id);
        $safes = AccountingSafe::pluck("name", "id")->toArray();
        $banks = AccountingBank::pluck("name", "id")->toArray();

        return $this->toEdit(compact("payment", "safes", "banks"));
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
        $payment = AccountingPayment::findOrFail($id);

        $rules = [
            "name" => "required|string",
        ];
        $message = [
            "name.required" => "اسم العملة باللغه الانجليزيه مطلوب ",
        ];
        $this->validate($request, $rules, $message);
        $requests = $request->all();
        $payment->update($requests);
        alert()
            ->success("تم تعديل  خيار الدفع بنجاح !")
            ->autoclose(5000);
        return redirect()->route("accounting.payments.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment = AccountingPayment::findOrFail($id);
        $payment->delete();
        alert()
            ->success("تم حذف   خيار الدفع  بنجاح !")
            ->autoclose(5000);
        return back();
    }
}
