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
use App\Models\AccountingSystem\AccountingBenod;
use App\Models\AccountingSystem\AccountingClient;
use App\Models\AccountingSystem\AccountingSafe;
use App\Models\AccountingSystem\AccountingSupplier;
use App\Traits\Viewable;

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
        $banks =AccountingBank::pluck('name','id')->toArray();
        $safes =AccountingSafe::pluck('name','id')->toArray();
        $clients =AccountingClient::pluck('name','id')->toArray();
        $suppliers =AccountingSupplier::pluck('name','id')->toArray();
        $benods=AccountingBenod::pluck('ar_name','id')->toArray();
        return $this->toCreate(compact('safes','clients','suppliers','benods','banks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //    dd($request->all());
         $rules = [

             'benod_id'=>'required|numeric|exists:accounting_benods,id',


         ];
         $this->validate($request,$rules);
        $requests = $request->all();
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'photos');
        }
        $safe = AccountingSafe::find($requests['safe_id']);

        $clause = AccountingMoneyClause::create($requests);

        //--------------------------client----------------------------------------
        if ($clause->concerned == 'client') {
            $client = AccountingClient::find($requests['client_id']);
            if ($clause->type == 'revenue') {
                //من  العميل  للخزينه رصيد الخزينة  بيزيدالايراااد
                //المبيعات
                $safe->update([

                    'amount' => $safe->amount + $requests['amount']

                ]);
                $client->update([

                    'balance' => $client->balance -$requests['balance']

                ]);

            } elseif ($clause->type == 'expenses') {
                //من االخزنه للعمييل  بيقلل مد
                //فى حاله المرتجاع   للمبيعات
                if ($requests['amount'] <= $safe->amount) {
                    $safe->update([

                        'amount' => $safe->amount - $requests['amount']

                    ]);
                }
                $client->update([
                    'balance' => $client->balance+$requests['balance']
                ]);
            }
            //--------------------------supplier------------------------------------
        } elseif ($clause->concerned == 'supplier') {

            $supplier = AccountingSupplier::find($requests['supplier_id']);
            if ($clause->type == 'revenue') {
                //من  المورد  للخزينه رصيد الخزينة  بيزيدالايراااد
                // فى  حاله  المرتجعات
                $safe->update([
                    'amount' => $safe->amount + $requests['amount']
                ]);
                $supplier->update([
                    'amount' => $supplier->amount + $requests['amount']
                ]);
            } elseif ($clause->type == 'expenses') {
                // من المورد للخزنه  بيقلل رصيد الخزنه والرصيد للمورد كمان هيقل
                //فى حاله  انشاء  مشترى
                if ($requests['amount'] <= $safe->amount) {
                    $safe->update([
                        'amount' => $safe->amount - $requests['amount']
                    ]);
                }
                if ($requests['amount'] <= $supplier->amount) {

                    $supplier->update([
                        'amount' => $supplier->amount - $requests['amount']
                    ]);
                }
            }
//            ------------------------general---------------------------
        }elseif($clause->concerned == 'general'){


            if ($clause->type == 'revenue') {

            $safe->update([
                'amount' => $safe->amount + $requests['amount']
            ]);

        } elseif ($clause->type == 'expenses') {
                // من  بيقلل رصيد الخزنه والرصيد  كمان هيقل
                //فى حاله  انشاء  مشترى
                if ($requests['amount'] <= $safe->amount) {
                    $safe->update([
                        'amount' => $safe->amount - $requests['amount']
                    ]);
                }

            }

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
}
