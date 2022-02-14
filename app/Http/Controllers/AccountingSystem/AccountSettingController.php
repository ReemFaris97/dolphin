<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingAccount;
use App\Models\AccountingSystem\AccountingAccountSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accounts = AccountingAccountSetting::all();
        $chart_accounts = AccountingAccount::all();
        return view(
            "AccountingSystem.settings.accounts_setting",
            compact("accounts", "chart_accounts")
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
        //
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
        $account = AccountingAccountSetting::find($id);
        $inputs = $request->all();
        $account->update([
            "automatic" => $inputs["automatic"] ?? $account->automatic,
            "main_code" => $inputs["main_code"] ?? $account->main_code,
            "increased_number" =>
                $inputs["increased_number"] ?? $account->increased_number,
            "status" => $inputs["status"] ?? $account->status,
        ]);
        alert()
            ->success("تم تكويد الحساب بنجاح !")
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
        //
    }
}
