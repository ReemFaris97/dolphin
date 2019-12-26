<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchFace;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingDelegate;
use App\Models\AccountingSystem\AccountingDelegateProduct;
use App\Models\AccountingSystem\AccountingProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class DelegateController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.delegates.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $delegates =AccountingDelegate::all()->reverse();
        return $this->toIndex(compact('delegates'));
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

        $delegate=AccountingDelegate::create($requests);
        foreach ($requests['product_id'] as $product_id){
                AccountingDelegateProduct::create([
                    'product_id'=>$product_id,
                    'delegate_id'=>$delegate->id
                ]);

        }


        alert()->success('تم اضافة   المندوب  بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.delegates.index');
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
        $delegate =AccountingDelegate::findOrFail($id);
        $products=AccountingProduct::pluck('name','id')->toArray();


        return $this->toEdit(compact('delegate','products'));


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
        $delegate =AccountingDelegate::findOrFail($id);

        $rules = [

            'name'=>'required|string|max:191',

        ];
        $this->validate($request,$rules);
        $requests = $request->all();
        $delegate->update($requests);
        alert()->success('تم  تعديل  المندوب  بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.delegates.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delegate =AccountingDelegate::findOrFail($id);
        $delegate->delete();
        alert()->success('تم حذف  المندوب بنجاح !')->autoclose(5000);
            return back();


    }
}
