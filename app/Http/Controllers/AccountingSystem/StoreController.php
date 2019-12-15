<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingProductStore;
use App\Models\AccountingSystem\AccountingStore;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class StoreController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.stores.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores =AccountingStore::all()->reverse();
       // dd($stores);
        return $this->toIndex(compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $companies=AccountingCompany::pluck('name','id')->toArray();
        $branches=AccountingBranch::pluck('name','id')->toArray();
        return $this->toCreate(compact('companies','branches'));
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

            'ar_name'=>'required|string|max:191',
            'en_name'=>'nullable|string|max:191',
            'image'=>'nullable|sometimes|image',
            'company_id'=>'nullable|numeric|exists:accounting_companies,id',

        ];
        $this->validate($request,$rules);
        $requests = $request->except('image');
       // dd($requests);

        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'photos');
        }


        if ($requests['company_id']==NULL & $requests['branch_id']!=NULL)
        {

            $requests['model_id']= $requests['branch_id'];
               $requests[ 'model_type']='App\Models\AccountingSystem\AccountingBranch';
                


        }
        if ($requests['branch_id']==NULL & $requests['company_id']!=NULL)
        {

            $requests[ 'model_id']= $requests['company_id'];
             $requests[ 'model_type']='App\Models\AccountingSystem\AccountingCompany';

        }
//dd($requests);
       AccountingStore::create($requests);

        alert()->success('تم اضافة  الفرع بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.stores.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $store =AccountingStore::findOrFail($id);

        return $this->toShow(compact('store'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $store =AccountingStore::findOrFail($id);
        $companies=AccountingCompany::pluck('name','id')->toArray();
        $branches=AccountingBranch::pluck('name','id')->toArray();
        return $this->toEdit(compact('store','companies','branches'));
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
        $store =AccountingStore::findOrFail($id);

        $rules = [
            'ar_name'=>'required|string|max:191',
            'en_name'=>'nullable|string|max:191',
            'image'=>'nullable|sometimes|image',
            'company_id'=>'nullable|numeric|exists:accounting_companies,id',
        ];
     //   dd($request->all());
        $this->validate($request,$rules);
        $requests = $request->except('image');
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'photos');
        }


        $store->update($requests);

        if (array_key_exists('company_id',$requests)) {

            $store->update([
                'model_id' => $requests['company_id']
            ]);
        }elseif(array_key_exists('branch_id',$requests)) {


            $store->update([
                'model_id' => $requests['branch_id']
            ]);
        }
        alert()->success('تم تعديل  المخزن بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.stores.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $store =AccountingStore::findOrFail($id);
        $store->delete();
        alert()->success('تم حذف  المخزن بنجاح !')->autoclose(5000);
            return back();

    }

    public function store_product($id){
        $product_store=AccountingProductStore::where('store_id',$id)->pluck('id')->toArray();
        $products=AccountingProduct::whereIn('id',$product_store ) ->get();
        $store =AccountingStore::findOrFail($id);
        $stores=AccountingStore::where('id','!=',$id)->pluck('ar_name','id')->toArray();
    //dd($stores);

        return view('AccountingSystem.stores.product',compact('products','store','stores'));
    }

    public function store_products_copy(Request $request,$id){

    $products_id=AccountingProductStore::where('store_id',$request["store_id"])->pluck('product_id')->toArray();

//          dd($products_id);

          foreach ($products_id as $product_id){
          AccountingProductStore::create([
              'store_id'=>$id,
              'product_id'=>$product_id
          ]);

          }
        alert()->success('تم نسخ الاصناف  المخزن بنجاح !')->autoclose(5000);
        return back();
    }

    public function settlements(){

        $stores=AccountingStore::pluck('ar_name','id')->toArray();
        $products=[];
        return view('AccountingSystem.stores.settlements',compact('stores','products'));

    }
    public  function settlements_store(Request $request){
        $store_id=$request['store_id'];
        $stores=AccountingStore::pluck('ar_name','id')->toArray();
//dd($store_id);
        $product_store=AccountingProductStore::where('store_id',$store_id)->pluck('id')->toArray();
        $products=AccountingProduct::whereIn('id',$product_store ) ->get();
       // dd($products);
        return view('AccountingSystem.stores.settlements',compact('stores','products'));

    }
}
