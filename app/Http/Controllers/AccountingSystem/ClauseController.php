<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBank;
use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchCategory;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingMoneyClause;
use App\Models\AccountingSystem\AccountingProductCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingAccount;
use App\Models\AccountingSystem\AccountingBenod;
use App\Models\AccountingSystem\AccountingClient;
use App\Models\AccountingSystem\AccountingCostCenter;
use App\Models\AccountingSystem\AccountingEntry;
use App\Models\AccountingSystem\AccountingEntryAccount;
use App\Models\AccountingSystem\AccountingPayment;
use App\Models\AccountingSystem\AccountingSafe;
use App\Models\AccountingSystem\AccountingSupplier;
use App\Traits\Viewable;
use DB;

class ClauseController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.clauses.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clauses =AccountingMoneyClause::all()->reverse();
        return $this->toIndex(compact('clauses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $benods=AccountingBenod::pluck('ar_name','id')->toArray();
        $payments=AccountingPayment::where('active',1)->pluck('name','id')->toArray();
        $centers=AccountingCostCenter::pluck('name','id')->toArray();
        $accounts=AccountingAccount::select('id', DB::raw("concat(ar_name, ' - ',code) as code_name"))->where('kind','sub')->pluck('code_name','id')->toArray();
        $client_accounts=AccountingAccount::select('id', DB::raw("concat(ar_name, ' - ',code) as code_name"))->where('kind','sub')->where('client_id','!=',Null)->pluck('code_name','id')->toArray();
        $supplier_accounts=AccountingAccount::select('id', DB::raw("concat(ar_name, ' - ',code) as code_name"))->where('kind','sub')->where('supplier_id','!=',Null)->pluck('code_name','id')->toArray();

        return $this->toCreate(compact('payments','benods','centers','accounts','client_accounts','supplier_accounts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//   dd($request->all());
         $rules = [

             'type'=>'required',
             'amount'=>'required',

         ];
        $message=[

            'type.required'=>'نوع السند  مطلوب ',
            'amount.required'=>' المبلغ  مطلوب ',

        ];
        $this->validate($request,$rules,$message);
        $requests = $request->all();
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'photos');
        }
// dd($requests);
        $clause = AccountingMoneyClause::create($requests);

        if($clause->type=='revenue'){

            $entry=AccountingEntry::create([
                'date'=>$clause->date,
                'source'=>'السندات',
                'type'=>'automatic',
                'details'=>' اضافه سند قبض',
                'status'=>'new'
            ]);

            AccountingEntryAccount::create([
                'entry_id'=>$entry->id,
                'from_account_id'=>$clause->account_id,
                'to_account_id'=>$clause->revenue_account_id,
                'amount'=>$clause->amount,
            ]);
        }

       else if($clause->type=='check_revenue'){

            $entry=AccountingEntry::create([
                'date'=>$clause->date,
                'source'=>'السندات',
                'type'=>'automatic',
                'details'=>'  اضافه سند قبض شيك',
                'status'=>'new'
            ]);

            AccountingEntryAccount::create([
                'entry_id'=>$entry->id,
                'from_account_id'=>$clause->account_id,
                'to_account_id'=>$clause->revenue_account_id,
                'amount'=>$clause->amount,
            ]);
        }
        elseif($clause->type=='expenses'){
            $entry=AccountingEntry::create([
                'date'=>$clause->date,
                'source'=>'السندات',
                'type'=>'automatic',
                'details'=>' اضافه سند صرف',
                'status'=>'new'
            ]);

            AccountingEntryAccount::create([
                'entry_id'=>$entry->id,
                'from_account_id'=>$clause->payment->bank->account->id ?? $clause->payment->safe->account->id,
                'to_account_id'=>$clause->account_id,
                  'amount'=>$clause->amount,
            ]);
        }
        elseif($clause->type=='check_expenses'){
            $entry=AccountingEntry::create([
                'date'=>$clause->date,
                'source'=>'السندات',
                'type'=>'automatic',
                'details'=>'  اضافه سند صرف شيك',
                'status'=>'new'
            ]);

            AccountingEntryAccount::create([
                'entry_id'=>$entry->id,
                'from_account_id'=>$clause->payment->bank->account->id ?? $clause->payment->safe->account->id,
                'to_account_id'=>$clause->account_id,
                  'amount'=>$clause->amount,
            ]);
        }

        alert()->success('تم اضافة السند بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.clauses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clause =AccountingMoneyClause::findOrFail($id);
        $safes =AccountingSafe::pluck('name','id')->toArray();
        $clients =AccountingClient::pluck('name','id')->toArray();
        $suppliers =AccountingSupplier::pluck('name','id')->toArray();
        $benods=AccountingBenod::pluck('ar_name','id')->toArray();
        $banks =AccountingBank::pluck('name','id')->toArray();

        return $this->toEdit(compact('clause','safes','clients','suppliers','benods','banks'));
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
        $clause =AccountingMoneyClause::findOrFail($id);

        // $rules = [
        //     'ar_name'=>'required|string|max:191',
        //     'en_name'=>'nullable|string|max:191',
        //     'ar_description'=>'nullable|string',
        //     'en_description'=>'nullable|string',
        // ];
        // $this->validate($request,$rules);
        $requests = $request->all();
        $clause->update($requests);
        alert()->success('تم تعديل  البند بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.clauses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clause =AccountingMoneyClause::findOrFail($id);
        $clause->delete();
        alert()->success('تم حذف  البند بنجاح !')->autoclose(5000);
            return back();


    }

    public  function  show($id){

        $clause =AccountingMoneyClause::findOrFail($id);
        return view('AccountingSystem.clauses.show',compact('clause'));
    }


    public function checks(){

        $clauses=AccountingMoneyClause::whereIn('type',['check_revenue','check_expenses'])->get();
        return view('AccountingSystem.clauses.checks',compact('clauses'));

    }
}
