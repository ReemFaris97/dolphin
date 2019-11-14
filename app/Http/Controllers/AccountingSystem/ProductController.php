<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchFace;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingColumnCell;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingFaceColumn;
use App\Models\AccountingSystem\AccountingIndustrial;
use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingProductCategory;
use App\Models\AccountingSystem\AccountingProductComponent;
use App\Models\AccountingSystem\AccountingProductDiscount;
use App\Models\AccountingSystem\AccountingProductMainUnit;
use App\Models\AccountingSystem\AccountingProductOffer;
use App\Models\AccountingSystem\AccountingProductStore;
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
        $industrials=AccountingIndustrial::pluck('name','id')->toArray();
        $unit=AccountingProductMainUnit::pluck('main_unit')->toArray();
        $branches=AccountingBranch::pluck('name','id')->toArray();
        $categories=AccountingProductCategory::pluck('ar_name','id')->toArray();
        $products=AccountingProduct::pluck('name','id')->toArray();
        $units=collect($unit)->toJson();
        //dd($units);
        return $this->toCreate(compact('branches','categories','products','industrials','units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //  dd($request->all());
        $rules = [


            'description'=>'nullable|string',
            'category_id'=>'nullable|numeric|exists:accounting_product_categories,id',
            'bar_code'=>'nullable|string',
            'product_selling_price'=>'required',
            'product_purchasing_price'=>'required',
            'min_quantity'=>'required|string|numeric',
            'max_quantity'=>'required|string|numeric',
            'expired_at'=>'nullable|string|date',
            'size'=>'nullable|string',
            'color'=>'nullable|string',
            'height'=>'nullable|string',
            'image'=>'nullable|sometimes|image',
            'width'=>'nullable|string',
            'num_days_recession'=>'nullable|string',

        ];
        $this->validate($request,$rules);

        $inputs = $request->except('name','image','bar_code','main_unit_present','purchasing_price','selling_price','component_names','qtys','main_units');
        $inputs['name']=$inputs['name_product'];
        $inputs['selling_price']=$inputs['product_selling_price'];
        $inputs['purchasing_price']=$inputs['product_purchasing_price'];

        if ($request->hasFile('image')) {
            $inputs['image'] = saveImage($request->image, 'photos');
        }
       $product= AccountingProduct::create($inputs);

       if (isset($inputs['store_id']))
       {
           AccountingProductStore::create([
               'store_id'=>$inputs['store_id'] ,
               'product_id'=>$product->id,
           ]);
       }
        $product->name=$inputs['name_product'];



        if (isset($request['main_unit'])){
            $main_unit=AccountingProductMainUnit::where('main_unit',$request['main_unit'])->first();
            if (!isset($main_unit))
            {
                AccountingProductMainUnit::create([
                 'main_unit'=>  $request['main_unit']
                ]);
            }

        }


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


/////////////////////////////////////offers _products

        if (isset($inputs['offers']))
        {
            $offers=$inputs['offers'];
            foreach ($offers as $offer)
               // dd($offer);
            AccountingProductOffer::create([
                'child_product_id'=>$offer ,
                'parent_product_id'=>$product->id,
            ]);
        }


        ////////////////////discounts Arrays////////////////////////////////
        if (isset($request['discount_type'])){

            if($request['discount_type']=='percent'){

                AccountingProductDiscount::create([
                    'product_id'=>$product->id,
                    'discount_type'=>'percent',
                    'percent'=>$request['percent'],
                ]);
            }else
            {

                $basic_quantity= collect($request['basic_quantity']);
                $gift_quantity= collect($request['gift_quantity']);
                $qtys_discount= $basic_quantity->zip($gift_quantity);

                foreach ($qtys_discount as $discount)

                {
                    AccountingProductDiscount::create([
                        'quantity'=>$discount['0'],
                        'gift_quantity'=> $discount['1'],
                        'product_id'=>$product->id,
                        'discount_type'=>'quantity',
                    ]);

                }
            }

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
        $branches=AccountingBranch::pluck('name','id')->toArray();
        $categories=AccountingProductCategory::pluck('ar_name','id')->toArray();
        $product=AccountingProduct::find($id);
        $products=AccountingProduct::all();
        $storeproduct=AccountingProductStore::where('product_id',$id)->first();
        $store=AccountingStore::find(optional($storeproduct)->store_id??1);
        $cells=AccountingColumnCell::all();
        return $this->toShow(compact('branches','categories','product','store','cells'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branches=AccountingBranch::pluck('name','id')->toArray();
        $industrials=AccountingIndustrial::pluck('name','id')->toArray();
        $unit=AccountingProductMainUnit::pluck('main_unit','id')->toArray();
        $units=collect($unit)->toJson();
        $categories=AccountingProductCategory::pluck('ar_name','id')->toArray();
        $product=AccountingProduct::find($id);
        $products=AccountingProduct::all();
        $cells=AccountingColumnCell::all();
        $columns=AccountingFaceColumn::all();
        $faces=AccountingBranchFace::all();
        $is_edit = 1;
        $storeproduct=AccountingProductStore::where('product_id',$id)->first();
        $store=AccountingStore::find(optional($storeproduct)->store_id??1);
        $stores=AccountingStore::all();

        return $this->toEdit(compact('industrials','face','branches','categories','id','product','products','is_edit','cells','columns','faces','store','stores','units'));


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


            'description'=>'nullable|string',
            'category_id'=>'nullable|numeric|exists:accounting_product_categories,id',
            'bar_code'=>'nullable|string',
            'main_unit'=>'required|string',
            'selling_price'=>'sometimes',
            'purchasing_price'=>'sometimes',
            'min_quantity'=>'required|string|numeric',
            'max_quantity'=>'required|string|numeric',
            'expired_at'=>'nullable|string|date',
            'size'=>'nullable|string',
            'color'=>'nullable|string',
            'height'=>'nullable|string',
            'image'=>'nullable|sometimes|image',
            'width'=>'nullable|string',
            'num_days_recession'=>'nullable|string',


        ];


        $this->validate($request,$rules);
        $requests = $request->all();

        $inputs = $request->except('name','image','bar_code','main_unit_present','purchasing_price','selling_price','component_names','qtys','main_units');
        $inputs['name']=$inputs['name_product'];
        $inputs['selling_price']=$inputs['product_selling_price'];
        $inputs['purchasing_price']=$inputs['product_purchasing_price'];

        if ($request->hasFile('image')) {
            $inputs['image'] = saveImage($request->image, 'photos');
        }
        $product->update($inputs);

        if (isset($inputs['store_id']))
        {
            AccountingProductStore::create([
                'store_id'=>$inputs['store_id'] ,
                'product_id'=>$product->id,
            ]);
        }
        $product->name=$inputs['name_product'];
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

    public function getfaces($id)
    {


        return faces($id);
    }



    public function getcolums($id)
    {


        return colums($id);
    }


    public function getcells($id)
    {


        return cells($id);
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


    public function getStoresbycompany($id)

    {
        $stores=[];

        $stores_company=AccountingStore::where('model_type','App\Models\AccountingSystem\AccountingCompany')->where('model_id',$id)->get();

//        return $stores;
        return response()->json([
            'status'=>true,
            'data'=>view('AccountingSystem.products.getAjaxStores')->with('stores',$stores_company)->render()
        ]);
    }
}
