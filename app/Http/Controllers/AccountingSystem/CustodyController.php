<?php

namespace App\Http\Controllers\AccountingSystem;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingAccount;
use App\Models\AccountingSystem\AccountingAsset;
use App\Models\AccountingSystem\AccountingCurrency;
use App\Models\AccountingSystem\AccountingCustodyLog;
use App\Models\AccountingSystem\AccountingEntry;
use App\Models\AccountingSystem\AccountingEntryAccount;
use App\Models\AccountingSystem\AccountingJobTitle;
use App\Models\AccountingSystem\AccountingPayment;
use App\Traits\Viewable;
use Carbon\Carbon;
use DB;

class CustodyController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.custodies.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $custodies=AccountingAsset::where('type','custdoy')->get();
// dd($custodies);
        return $this->toIndex(compact('custodies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $currencies=AccountingCurrency::pluck('ar_name','id')->toArray();
        $payments = AccountingPayment::where('active','1')->pluck('name','id')->toArray();
        $accounts=AccountingAccount::select('id',DB::raw("concat(ar_name, ' - ',code) as code_name"))->where('kind','!=','sub')->pluck('code_name','id')->toArray();
        return $this->toCreate(compact('currencies','payments','accounts'));
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

        ];
        $this->validate($request,$rules);
        $requests=$request->all();

        AccountingAsset::create($requests);
        alert()->success('تم اضافة  الاصل بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.custodies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $custody =AccountingAsset::findOrFail($id);
        $payments = AccountingPayment::where('active','1')->pluck('name','id')->toArray();

        return $this->toShow(compact('custody','payments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $custody =AccountingAsset::findOrFail($id);
        return $this->toEdit(compact('custody'));


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
        $custody=AccountingAsset::findOrFail($id);
        $rules = [
            'name'=>'required|string|max:191',
        ];
        $this->validate($request,$rules);
        $requests = $request->all();
        $custody->update($requests);
        alert()->success('تم تعديل العهد بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.custodies.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $custody =AccountingAsset::findOrFail($id);
        $custody->delete();
        alert()->success('تم حذف  العهدة بنجاح !')->autoclose(5000);
            return back();


    }
    public function add_amount(Request $request,$id){
     $custody=AccountingAsset::find($id);
     $acount=AccountingAccount::where('asset_id',$id)->first();
     $last=AccountingCustodyLog::where('asset_id',$id)->latest()->first();
        AccountingCustodyLog::create([
            'asset_id'=>$id,
            'operation_name'=>'اضافه عهدة',
            'code'=>rand(10000,4),
            'date'=>Carbon::now(),
            'amount'=>$request['amount'],
            'amount_asset_after'=> $last->amount_asset_after +$request['amount'],
            'payment_id'=>$request['payment_id']
        ]);
        $payment=AccountingPayment::find($request['payment_id']);
        $entry=AccountingEntry::create([
            'date'=>Carbon::now(),
            'source'=>'العهد',
            'type'=>'automatic',
            'details'=>' اضافه عهده'.$custody->ar_name,
            'status'=>'new'
        ]);

        AccountingEntryAccount::create([
            'entry_id'=>$entry->id,
            'from_account_id'=> $acount->id,
            'to_account_id'=>$payment->bank->account_id??$payment->safe->account_id,
            'amount'=>$request['amount'],
        ]);

        alert()->success('تم اضافه العهده  العهدة بنجاح !')->autoclose(5000);
        return back();
    }


    public function decreased_amount(Request $request,$id){
        $custody=AccountingAsset::find($id);
        $acount=AccountingAccount::where('asset_id',$id)->first();
        $last=AccountingCustodyLog::where('asset_id',$id)->latest()->first();
             $log=   AccountingCustodyLog::create([
                    'asset_id'=>$id,
                    'operation_name'=>'تخفيض عهدة',
                    'code'=>rand(10000,4),
                    'date'=>Carbon::now(),
                    'amount'=>$request['amount'],
                    'amount_asset_after'=> $last->amount_asset_after-$request['amount']
                ]);

                $entry=AccountingEntry::create([
                    'date'=>Carbon::now(),
                    'source'=>'العهد',
                    'type'=>'automatic',
                    'details'=>' تخفيض عهده'.$custody->ar_name,
                    'status'=>'new'
                ]);

                AccountingEntryAccount::create([
                    'entry_id'=>$entry->id,
                    'from_account_id'=>$custody->payment->bank->account->id,
                    'to_account_id'=> $acount->id,
                    'amount'=>$request['amount'],
                ]);

                alert()->success('تم  تخفيض العهده  العهدة بنجاح !')->autoclose(5000);
                return back();
            }

}
