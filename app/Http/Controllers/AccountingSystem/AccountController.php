<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingAccount;
use App\Models\AccountingSystem\AccountingAccountLog;
use App\Models\AccountingSystem\AccountingAccountSetting;
use App\Models\AccountingSystem\AccountingEntryAccount;
use App\Models\AccountingSystem\AccountingEntryLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingEntry;
use App\Traits\Viewable;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    use Viewable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts=AccountingAccount::where('kind','main')->get();
        // $accounts_centercost=AccountingAccount::whereHas('children', function($query) {
        //     $query->whereHas('children');
        // })->get();
        // dd($accounts_centercost);
        return view("AccountingSystem.charts_accounts.index",compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accounts=AccountingAccount::select('id', DB::raw("concat(ar_name, ' - ',code) as code_name"))->pluck('code_name','id')->toArray();
        return view("AccountingSystem.charts_accounts.create",compact('accounts'));
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
            'ar_name'=>'required|string|max:50',
            'en_name'=>'required|string|max:100',
            'kind'=>'required|in:main,sub,following_main',
            'status'=>'required|in:debtor,Creditor',
            'account_id'=>'required_if:kind,sub|required_if:kind,following_main'
        ];
        $message=[
            'en_name.required'=>'اسم الحساب باللغه الانجليزيه مطلوب ',
            'ar_name.required'=>'اسم الحساب باللغه  العربيه مطلوب',
            'account_id.required_if'=>'الحساب الرئيسى مطلوب فى حالة نوع الحساب  رئيسى تابع او فرعى',
        ];

        $this->validate($request,$rules,$message);
        $requests = $request->all();
        $account= AccountingAccount::create($requests);
//          AccountingAccountSetting::create([
//            'account_id'=>$account->id,
//             'main_code'=>$account->code,
//        ]);

            // if(isset($requests['openning_balance'])){

            // }
        alert()->success('تم انشاء حسابا  بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.ChartsAccounts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $account=AccountingAccount::with('allChildrenAccounts')->where('id',$id)->first();
        $logs=AccountingAccountLog::where('account_id',$id)->get();
        
        $postingEntries=AccountingEntry::where('status','posted')->pluck('id');
        $accountLogsForm=AccountingAccountLog::where('account_id',$id)->whereIn('entry_id',$postingEntries)->where('affect','debtor')->get();
        $accountLogsTo=AccountingAccountLog::where('account_id',$id)->whereIn('entry_id',$postingEntries)->where('affect','creditor')->get();

        return view("AccountingSystem.charts_accounts.show",compact('account','logs','accountLogsForm','accountLogsTo'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $account=AccountingAccount::find($id);
        $accounts=AccountingAccount::select('id', DB::raw("concat(ar_name, ' - ',code) as code_name"))->pluck('code_name','id')->toArray();
        return view("AccountingSystem.charts_accounts.edit",compact('account','accounts'));
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
        $account=AccountingAccount::find($id);
        $rules = [
            'ar_name'=>'required|string|max:50',
            'en_name'=>'required|string|max:100',
            'kind'=>'required|in:main,sub,following_main',
            'status'=>'required|in:debtor,Creditor',
        ];
        $message=[
            'en_name.required'=>'اسم الحساب باللغه الانجليزيه مطلوب ',
           'ar_name.required'=>'اسم الحساب باللغه  العربيه مطلوب',
//            'code.required'=>'كود الحساب مطلوب',
//            'code.numeric'=>'  كود الحساب مطلوب يكون رقما',
        ];
        $this->validate($request,$rules,$message);
        $requests = $request->all();
        $account->update($requests);
        alert()->success('تم تعديل  الحساب بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.ChartsAccounts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $account =AccountingAccount::findOrFail($id);
        $account->delete();
        alert()->success('تم حذف  الحساب بنجاح !')->autoclose(5000);
        return back();
    }

    public  function  active($id){
        $account =AccountingAccount::findOrFail($id);
        $account->update([
            'active'=>1
        ]);
        alert()->success('تم تفعيل  الحساب بنجاح !')->autoclose(5000);
        return back();
    }


    public  function  dis_active($id){
        $account =AccountingAccount::findOrFail($id);
        $account->update([
            'active'=>0
        ]);
        alert()->success('تم الغاء تفعيل  الحساب بنجاح !')->autoclose(5000);
        return back();
    }


    public function trial_balance(Request $request){


        $accounts=AccountingAccount::all();

    //     $accountsTransactions=  AccountingAccountLog::where('account_id',51)->select('id',
    //     \DB::raw('count(*) as num'), \DB::raw('IF(affect ="creditor",sum(amount),0) AS creditor_amount'),
    //     \DB::raw('IF(affect ="debtor",sum(amount),0) AS debtor_amount'));
    //     if ($request->has('from') && $request->has('to')) {
    //         $accountsTransactions = $accountsTransactions->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::parse($request->to)]);
    //     }
    //    dd($accountsTransactions->get());
        return view("AccountingSystem.charts_accounts.trial_balance",compact('accounts','request'));
    }


}
