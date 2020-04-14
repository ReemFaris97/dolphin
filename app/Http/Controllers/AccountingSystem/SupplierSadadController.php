<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchCategory;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingMoneyClause;
use App\Models\AccountingSystem\AccountingProductCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingBenod;
use App\Models\AccountingSystem\AccountingClient;
use App\Models\AccountingSystem\AccountingSafe;
use App\Models\AccountingSystem\AccountingSupplier;
use App\Traits\Viewable;

class SupplierSadadController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.suppliers_sadad.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clauses = AccountingMoneyClause::where('concerned','supplier')->get()->reverse();
        return $this->toIndex(compact('clauses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $safes = AccountingSafe::pluck('name', 'id')->toArray();
        $suppliers = AccountingSupplier::pluck('name', 'id')->toArray();
        $benods = AccountingBenod::pluck('ar_name', 'id')->toArray();
        return $this->toCreate(compact('safes', 'suppliers', 'benods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $rules = [


        // ];
        // $this->validate($request,$rules);
        $requests = $request->all();

        $safe = AccountingSafe::find($requests['safe_id']);

        $clause = AccountingMoneyClause::create($requests);

        $clause->update([
            'num'=>mt_rand(),
        ]);

        if($clause->concerned == 'supplier'){

        $supplier = AccountingSupplier::find($requests['supplier_id']);
        if ($clause->type == 'revenue') {
            //من  المورد  للخزينه رصيد الخزينة  بيزيدالايراااد
            // فى  حاله  المرتجعات
            $safe->update([
                'amount' => $safe->amount + $requests['amount']
            ]);
            $supplier->update([
                'user_id'=>auth()->user()->id,
                'balance' => $supplier->balance + $requests['amount']
            ]);
        } elseif ($clause->type == 'expenses') {
            // من  الخزنه  للمورد بيقلل رصيد الخزنه مديونيه للمورد كمان هيقل
            //فى حاله  انشاء  مشترى

                $safe->update([
                    'amount' => $safe->amount - $requests['amount']
                ]);



                $supplier->update([
                    'user_id'=>auth()->user()->id,
                    'balance' => $supplier->balance - $requests['amount']
                ]);
//                dd($supplier);

        }
    }
        alert()->success('تم اضافة سند  سداد بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.suppliers_sadad.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clause = AccountingMoneyClause::findOrFail($id);
        $safes = AccountingSafe::pluck('name', 'id')->toArray();
        $clients = AccountingClient::pluck('name', 'id')->toArray();
        $suppliers = AccountingSupplier::pluck('name', 'id')->toArray();
        $benods = AccountingBenod::pluck('ar_name', 'id')->toArray();
        return $this->toEdit(compact('clause', 'safes', 'clients', 'suppliers', 'benods'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $clause = AccountingMoneyClause::findOrFail($id);

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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clause = AccountingMoneyClause::findOrFail($id);
        $clause->delete();
        alert()->success('تم حذف  البند بنجاح !')->autoclose(5000);
        return back();


    }
    public function getBalance($id){
        $supplier=AccountingSupplier::find($id);
        return response()->json([
            'status'=>true,
            'data'=>($supplier->balance)
        ]);
    }
    public function getNewBalance($amount){
        $supplier=AccountingSupplier::find($id);
        $newBalance=$supplier->balance -$amount;
        return response()->json([
            'status'=>true,
            'data'=>($supplier->balance)
        ]);
    }
}
