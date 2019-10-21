<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchFace;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingProductCategory;
use App\Models\AccountingSystem\AccountingProductComponent;
use App\Models\AccountingSystem\AccountingProductSubUnit;
use App\Models\AccountingSystem\AccountingStore;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class ProductController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.products.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products =AccountingProduct::all()->reverse();
        return $this->toIndex(compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $branches=AccountingBranch::pluck('name','id')->toArray();
        $categories=AccountingProductCategory::pluck('ar_name','id')->toArray();
        $products=AccountingProduct::all();
        return $this->toCreate(compact('branches','categories','products'));
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


            'description'=>'sometimes|string',
            'category_id'=>'sometimes|numeric|exists:accounting_product_categories,id',

            'bar_code'=>'required|string',
            'main_unit'=>'required|string',
            'selling_price'=>'required',
            'purchasing_price'=>'required',
            'min_quantity'=>'required|string|numeric',
            'max_quantity'=>'required|string|numeric',
            'expired_at'=>'required|string|date',
            'size'=>'sometimes|string',
            'color'=>'sometimes|string',
            'height'=>'sometimes|string',
            'width'=>'sometimes|string',
            'num_days_recession'=>'sometimes|string',

        ];
        $this->validate($request,$rules);
        $inputs = $request->except('name','par_codes','main_unit_present','selling_price','purchasing_price','component_names','qtys','main_units');


       $product= AccountingProduct::create($inputs);
        ///////  /// / //////subunits Arrays//////////////////////////////
        $names = collect($request['name']);
        $par_codes = collect($request['par_codes']);
        $main_unit_presents= collect($request['main_unit_present']);
        $selling_price= collect($request['selling_price']);
        $purchasing_price= collect($request['purchasing_price']);
        $units = $names->zip($par_codes,$purchasing_price,$selling_price,$main_unit_presents);

        foreach ($units as $unit)

        {
            AccountingProductSubUnit::create([
                'name'=>$unit['0'],
                'bar_code'=> $unit['1'],
                'main_unit_present'=>$unit['2'],
                'selling_price'=>$unit['3'],
                'purchasing_price'=>$unit['4'],
                'product_id'=>$product->id
            ]);

        }
////////////////////components Arrays////////////////////////////////
        $component_names= collect($request['component_names']);
        $qtys= collect($request['qtys']);
        $main_units= collect($request['main_units']);
        $components= $component_names->zip($qtys,$main_units);

        foreach ($components as $component)

        {
            AccountingProductComponent::create([
                'name'=>$component['0'],
                'quantity'=> $component['1'],
                'main_unit'=>$component['2'],
                'product_id'=>$product->id
            ]);

        }


        alert()->success('تم اضافة المنتج بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.products.index');
    }


    public  function subunit(){


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
        $face =AccountingBranchFace::findOrFail($id);
        $branches=AccountingBranch::pluck('name','id')->toArray();
        $categories=AccountingProductCategory::pluck('ar_name','id')->toArray();

        return $this->toEdit(compact('face','branches','categories'));


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
        $product =AccountingProduct::findOrFail($id);

        $rules = [

            'name'=>'required|string|max:191',

            'branch_id'=>'required|numeric|exists:accounting_branches,id',
        ];
        $this->validate($request,$rules);
        $requests = $request->all();
        $product->update($requests);
        alert()->success('تم تعديل المنتج  بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.products.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product =AccountingProduct::findOrFail($id);
        $product->delete();
        alert()->success('تم حذف  المنتج بنجاح !')->autoclose(5000);
            return back();


    }
    public function getBranch($id)
    {

        //dd("sdfs");
        return branches($id);
    }

    public function getStores($branches)

    {
        $stores=[];
        $branches_ids=explode(',',$branches);
        $branch=AccountingBranch::find($branches_ids[0]);
        $company_id=$branch->company_id;
        $stores_company=AccountingStore::where('model_type','App\Models\AccountingSystem\AccountingCompany')->where('model_id',$company_id)->get();
        $collect1=collect($stores_company);


        $stores_branch =[];
       foreach($branches_ids as  $branch_id)
       {
           $store_branch=AccountingStore::where('model_type','App\Models\AccountingSystem\AccountingBranch')->where('model_id',$branch_id)->first();

           array_push($stores_branch,$store_branch);


       }
        $collect2=collect($stores_branch);

        $merged=$collect2->merge($collect1);
        $stores=$merged->all();

//        return $stores;
        return response()->json([
            'status'=>true,
            'data'=>view('AccountingSystem.products.getAjaxStores')->with('stores',$stores)->render()
        ]);
    }
}
