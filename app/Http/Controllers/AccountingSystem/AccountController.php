<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingAccount;
use App\Models\AccountingSystem\AccountingAccountLog;
use App\Models\AccountingSystem\AccountingAccountSetting;
use App\Models\AccountingSystem\AccountingEntryAccount;
use App\Models\AccountingSystem\AccountingEntryLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingAsset;
use App\Models\AccountingSystem\AccountingCenterAccount;
use App\Models\AccountingSystem\AccountingCostCenter;
use App\Models\AccountingSystem\AccountingEntry;
use App\Models\AccountingSystem\AccountingPayment;
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

        return view("AccountingSystem.charts_accounts.index",compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $accounts=AccountingAccount::whereIn('kind',['main','following_main'])->select('id', DB::raw("concat(ar_name, ' - ',code) as code_name"))->pluck('code_name','id')->toArray();
        $centers=AccountingCostCenter::where('active',1)->pluck('name','id')->toArray();
        return view("AccountingSystem.charts_accounts.create",compact('accounts','centers'));
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

            if(isset($requests['center_id'])){
                    foreach($requests['center_id'] as $center_id){
                        AccountingCenterAccount::create([
                               'account_id'=>$account->id,
                               'center_id'=>$center_id,
                        ]);
                    }

            }


                /////الرصيد الافتتاحى
            if($account->kind=='sub'&&$account->type == "exist"){
                //++++++++++فى حاله  تساوى  طبيعه  الحساب  مع  طبيعه الارصييد الافتتاحى
                if($requests['status']==$requests['affect']){
                    AccountingAccountLog::create([
                        'entry_id'=>null,
                        'account_id'=>$account->id,
                        'account_amount_before'=>null,
                        'another_account_id'=>null,
                        'amount'=>$requests['openning_balance'],
                        'account_amount_after'=>$requests['openning_balance'],
                        'affect'=>$requests['affect'],
                        'status'=>'opening_balance',
                    ]);
                }else{
                    // dd("fdre3wer");
                    AccountingAccountLog::create([

                        'entry_id'=>null,
                        'account_id'=>$account->id,
                        'account_amount_before'=>null,
                        'another_account_id'=>null,
                        'amount'=>-$requests['openning_balance'],
                        'account_amount_after'=>-$requests['openning_balance'],
                        'affect'=>$requests['affect'],
                        'status'=>'opening_balance',

                    ]);
                }

            }

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
        $logs=AccountingAccountLog::where('account_id',$id)->where('status','entry')->get();
        $log_openning_balance=AccountingAccountLog::where('account_id',$id)->where('status','opening_balance')->first();

        $postingEntries=AccountingEntry::where('status','posted')->pluck('id');
        $accountLogsForm=AccountingAccountLog::where('account_id',$id)->whereIn('entry_id',$postingEntries)->where('affect','debtor')->get();
        $accountLogsTo=AccountingAccountLog::where('account_id',$id)->whereIn('entry_id',$postingEntries)->where('affect','creditor')->get();
        $centers=AccountingCenterAccount::where('account_id',$id)->get();
        $asset=AccountingAsset::find($account->asset_id);
        $custody=AccountingAsset::find($account->asset_id);
        $payments = AccountingPayment::where('active','1')->pluck('name','id')->toArray();

        return view("AccountingSystem.charts_accounts.show",compact('account','logs','log_openning_balance','accountLogsForm','accountLogsTo','centers','asset','custody','payments'));

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


        $centers=AccountingCostCenter::where('active',1)->pluck('name','id')->toArray();
        return view("AccountingSystem.charts_accounts.edit",compact('account','accounts','centers'));
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
         if($account->kind=='sub'&&$account->type == "exist"){
           $logs=AccountingAccountLog::where('account_id',$account->id)->get();
           foreach($logs as $log){
            $log->delete();
           }
                //++++++++++فى حاله  تساوى  طبيعه  الحساب  مع  طبيعه الارصييد الافتتاحى
                if($requests['status']==$requests['affect']){
                    AccountingAccountLog::create([
                        'entry_id'=>null,
                        'account_id'=>$account->id,
                        'account_amount_before'=>null,
                        'another_account_id'=>null,
                        'amount'=>$requests['openning_balance'],
                        'account_amount_after'=>$requests['openning_balance'],
                        'affect'=>$requests['affect'],
                        'status'=>'opening_balance',
                    ]);
                }else{
                    // dd("fdre3wer");
                    AccountingAccountLog::create([

                        'entry_id'=>null,
                        'account_id'=>$account->id,
                        'account_amount_before'=>null,
                        'another_account_id'=>null,
                        'amount'=>-$requests['openning_balance'],
                        'account_amount_after'=>-$requests['openning_balance'],
                        'affect'=>$requests['affect'],
                        'status'=>'opening_balance',

                    ]);
                }
            }
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
           if($account->kind=='sub'){
        $entries=AccountingEntryAccount::where('account_id',$id)->get();

        if($entries->count()==0){
            $account =AccountingAccount::findOrFail($id);
            $account->delete();
            alert()->success('تم حذف  الحساب بنجاح !')->autoclose(5000);
            return redirect()->route('accounting.ChartsAccounts.index');

        }else{
            alert()->warning('لا يمكن حذف الحساب  لوجود قيود!')->autoclose(5000);
               return back();
        }
     }elseif($account->kind=='main'||$account->kind=='following_main'){

        if($account->children->count()==0){
            $account =AccountingAccount::findOrFail($id);
            $account->delete();
            alert()->success('تم حذف  الحساب بنجاح !')->autoclose(5000);
            return redirect()->route('accounting.ChartsAccounts.index');

        }else{
            alert()->warning('لا يمكن حذف الحساب  لوجود حسابات   تابعه له!')->autoclose(5000);
               return back();
        }

     }

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


    if ($request->has('level') ) {

        $accounts=AccountingAccount::where('level',$request['level'])->get();
    }else{
        $accounts=AccountingAccount::all();
    }
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
