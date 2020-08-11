<?php

namespace App\Http\Controllers\AccountingSystem;


use App\Models\AccountingSystem\AccountingAccount;
use App\Models\AccountingSystem\AccountingEntry;
use App\Models\AccountingSystem\AccountingEntryAccount;
use App\Models\AccountingSystem\AccountingEntryLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;
use Illuminate\Support\Facades\DB;

class EntryController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.entries.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entries =AccountingEntry::all()->reverse();
        return $this->toIndex(compact('entries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accounts=AccountingAccount::select('id', DB::raw("concat(ar_name, ' - ',code) as code_name"))->where('kind','sub')->pluck('code_name','id')->toArray();
        return $this->toCreate(compact('accounts'));
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
            'source'=>'required|string|max:191',
            'date'=>'required',
            'amount'=>'required',
            'type'=>'required',
           'from_account_id'=>'required|exists:accounting_accounts,id',
           'to_account_id'=>'required|exists:accounting_accounts,id',
        ];
        $message=[
            'from_account_id.required'=>'اسم الحساب الاول(المدين) مطلوب ',
            'to_account_id.required'=>'اسم الحساب الثانى(الدائن) مطلوب ',
        ];
        $this->validate($request,$rules,$message);

        $requests = $request->except('from_account_id','to_account_id');
        $requests['type']='manual';

        $entry=AccountingEntry::create($requests);
           AccountingEntryAccount::create([
               'entry_id'=>$entry->id,
               'from_account_id'=>$request['from_account_id'],
               'to_account_id'=>$request['to_account_id'],
               'amount'=>$request['amount'],
           ]);

        alert()->success('تم اضافةالقيد اليومى بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.entries.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entry=AccountingEntry::find($id);
        $logs=AccountingEntryLog::where('entry_id',$id)->get();
        return view("AccountingSystem.entries.show",compact('entry','logs'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entry =AccountingEntry::findOrFail($id);
        $accounts=AccountingAccount::select('id', DB::raw("concat(ar_name, ' - ',code) as code_name"))->where('kind','sub')->pluck('code_name','id')->toArray();
        $entryAccount=AccountingEntryAccount::where('entry_id',$id)->first();
        return $this->toEdit(compact('entry','accounts','entryAccount'));


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
        $entry =AccountingEntry::findOrFail($id);
        $rules = [

            'source'=>'required|string|max:191',
            'date'=>'required',
            'amount'=>'required',
            'type'=>'required',
//            'from_account_id'=>'required|numeric|exists:accounting_accounts,id',
//            'to_account_id'=>'required|numeric|exists:accounting_accounts,id',
        ];
        $this->validate($request,$rules);

        $requests = $request->all();
        $entry->update($requests);
        $entryAccount=AccountingEntryAccount::where('entry_id',$id)->first();
        $entryAccount->update([
            'from_account_id'=>$request['from_account_id'],
            'to_account_id'=>$request['to_account_id'],
            'amount'=>$request['amount'],
        ]);


        alert()->success('تم تعديل  القيد بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.entries.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shift =AccountingEntry::findOrFail($id);
        $shift->delete();
        alert()->success('تم حذف القيد بنجاح !')->autoclose(5000);
            return back();
    }

    public  function filter(Request $request){
        $requests=request()->all();

        if ($request->has('code')&$request->code!=NULL) {

            $entries = AccountingEntry::where('code', $requests['code'])->get();
        }elseif ($request->has('date')&$request->date!=NULL) {

            $entries = AccountingEntry::where('date', $requests['date'])->get();


        }elseif ($request->has('type')&$request->type!=NULL) {
                    if($requests['type']=='manual'){
            $entries = AccountingEntry::where('type','manual')->get();
                    }elseif($requests['type']=='automatic'){
             $entries = AccountingEntry::where('type','automatic')->get();
                    }
        }elseif ($request->has('source')&$request->source!=NULL) {
            $entries = AccountingEntry::where('source','Like', '%'.$requests['source'].'%')->get();
        }else{
            $entries = AccountingEntry::all()->reverse();

        }
        return $this->toIndex(compact('entries'));


    }

    public  function posting($id){
        $entry=AccountingEntry::find($id);
        $entry->update([
            'status'=>'posted'
        ]);
        foreach ($entry->accounts as $account){
           $fromAccount=AccountingAccount::find($account->from_account_id);
            $toAccount=AccountingAccount::find($account->to_account_id);
            $fromAccount->update([
                'amount'=>$fromAccount->amount+$account->amount
            ]);
            $toAccount->update([
                'amount'=>$toAccount->amount-$account->amount
            ]);

            $fromAccountParent=AccountingAccount::find($account->from_account_id);
            $toAccount=AccountingAccount::find($account->to_account_id);
            $fromAccount->update([
                'amount'=>$fromAccount->amount+$account->amount
            ]);

            $toAccount->update([
                'amount'=>$toAccount->amount-$account->amount
            ]);


        }

            alert()->success('تم ترحيل القيد بنجاح !')->autoclose(5000);
            return back();

    }

    public function  toaccounts($id){

        $accounts=AccountingAccount::select('id', DB::raw("concat(ar_name, ' - ',code) as code_name"))->where('kind','sub')->where('id','!=',$id)->pluck('code_name','id')->toArray();

        return response()->json([
            'status'=>true,
            'data'=>view('AccountingSystem.entries.account')->with('accounts',$accounts)->render()
        ]);

    }
}
