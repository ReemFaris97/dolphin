<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchFace;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingDelegate;
use App\Models\AccountingSystem\AccountingDelegateProduct;
use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingSupplier;
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

        return $this->toCreate(compact('products'));
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
        $requests = $request->all();

        $supplier=AccountingSupplier::create($requests);
        foreach ($requests['product_id'] as $product_id){
                AccountingSupplierProduct::create([
                    'product_id'=>$product_id,
                    'supplier_id'=>$supplier->id
                ]);

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
        $supplier =AccountingSupplier::findOrFail($id);
        $products=AccountingProduct::pluck('name','id')->toArray();


        return $this->toEdit(compact('supplier','products'));


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
}
