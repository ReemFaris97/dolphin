<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBank;
use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchFace;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingDelegate;
use App\Models\AccountingSystem\AccountingDelegateProduct;
use App\Models\AccountingSystem\AccountingMoneyClause;
use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingProductCategory;
use App\Models\AccountingSystem\AccountingPurchase;
use App\Models\AccountingSystem\AccountingSafe;
use App\Models\AccountingSystem\AccountingSupplier;
use App\Models\AccountingSystem\AccountingSupplierCompany;
use App\Models\AccountingSystem\AccountingSupplierProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class SupplierController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.suppliers.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers =AccountingSupplier::all()->reverse();
        return $this->toIndex(compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $products=AccountingProduct::pluck('name','id')->toArray();
        $banks=AccountingBank::pluck('name','id')->toArray();
        $companies=AccountingCompany::pluck('name','id')->toArray();
        $branches=AccountingBranch::pluck('name','id')->toArray();
        return $this->toCreate(compact('products','banks','companies','branches'));
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
            'phone'=>'required|numeric|unique:users,phone',
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string|max:191',
            'image'=>'nullable|sometimes|image',


        ];
        $this->validate($request,$rules);
        $requests = $request->all();


        $requests['password']=bcrypt($requests['password']);
//   dd($requests);
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'photos');
        }

        if (getsetting('automatic_supplier')==1){
            $requests['account_id']=getsetting('accounting_id_supplier');
        }
        $supplier=AccountingSupplier::create($requests);
            if (isset($requests['company_id'])) {
                foreach ($requests['company_id'] as $company) {
                    AccountingSupplierCompany::create([
                        'company_id' => $company,
                        'supplier_id' => $supplier->id
                    ]);

                }
            }

        alert()->success('تم اضافة   المورد  بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.suppliers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier =AccountingSupplier::findOrFail($id);
        $clauses_revenue= AccountingMoneyClause::where('concerned','supplier')->where('supplier_id',$id)->where('type','revenue')->get()->reverse();
        $clauses_revenue_sum = AccountingMoneyClause::where('concerned','supplier')->where('supplier_id',$id)->where('type','revenue')->sum('amount');

        $clauses_expenses = AccountingMoneyClause::where('concerned','supplier')->where('supplier_id',$id)->where('type','expenses')->get()->reverse();
        $clauses_expenses_sum = AccountingMoneyClause::where('concerned','supplier')->where('supplier_id',$id)->where('type','expenses')->sum('amount');

        $purchases=AccountingPurchase::where('supplier_id',$id)->get();
        $purchases_sum=AccountingPurchase::where('supplier_id',$id)->sum('total');
        return view('AccountingSystem.suppliers.show',compact('clauses_revenue','supplier','purchases','clauses_revenue_sum','clauses_expenses','clauses_expenses_sum','purchases_sum'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier =AccountingSupplier::findOrFail($id);
        $products=AccountingProduct::pluck('name','id')->toArray();

        $banks=AccountingBank::pluck('name','id')->toArray();
        $companies=AccountingCompany::pluck('name','id')->toArray();
        $branches=AccountingBranch::pluck('name','id')->toArray();


        return $this->toEdit(compact('supplier','products','banks','companies','branches'));


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
        $supplier =AccountingSupplier::findOrFail($id);

        $rules = [

            'name'=>'required|string|max:191',

        ];
        $this->validate($request,$rules);
        $requests = $request->all();
        $supplier->update($requests);
        alert()->success('تم  تعديل  المورد  بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.suppliers.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier =AccountingSupplier::findOrFail($id);

        $supplier->delete();
        alert()->success('تم حذف  المورد بنجاح !')->autoclose(5000);
            return back();


    }


    public  function active($id){

        $supplier= AccountingSupplier::find($id);
        $supplier->update([
            'is_active'=>'1'
        ]);
        alert()->success('تم تفعيل  المورد بنجاح !')->autoclose(5000);
        return back();
    }

    public  function dis_active($id){

        $supplier= AccountingSupplier::find($id);
        $supplier->update([
            'is_active'=>'0'
        ]);

        alert()->success('تم الغاءتفعيل  المورد بنجاح !')->autoclose(5000);
        return back();
    }

    public  function purchase_order(){
        $categories=AccountingProductCategory::pluck('ar_name','id')->toArray();
        $suppliers=AccountingSupplier::pluck('name','id')->toArray();
        $safes=AccountingSafe::pluck('name','id')->toArray();
        return  view('AccountingSystem.suppliers.purchase_order',compact('categories','suppliers','safes'));
    }
}
