<?php

namespace App\Http\Controllers\Distributor;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Store;
use App\Models\StoreCategory;
use App\Traits\Supplier\ProductsOperations;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class ProductsController extends Controller
{
    use Viewable;
    use ProductsOperations;
    private $viewable='distributor.products.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all()->reverse();
        return $this->toIndex(compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = StoreCategory::pluck('name','id');
        return $this->toCreate(compact('categories'));
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
            'name'=>"required|string|max:191",
            'store_id'=>'required|numeric|exists:stores,id',
            'quantity_per_unit'=>'required|numeric',
            'min_quantity'=>'required|numeric|lt:max_quantity',
            'max_quantity'=>'required|numeric|gt:min_quantity',
            'price'=>'required|numeric',
            'bar_code'=>'required|string|unique:products,bar_code',
            'expired_at'=>'required|date|after_or_equal:today',
            'image'=>'required|image',
            'images'=>'required|array',
        ];

        $this->validate($request,$rules);
        $inputs = $request->all();
       // dd($inputs);
        $inputs['expired_at'] = Carbon::parse($request->expired_at);
        $inputs['image'] =  saveImage($request->image, 'products');



        $product=Product::create($inputs);

        foreach ($request->images as $image)
        {
            $product->images()->create(['image'=>saveImage($image,'users')]);
        }

         //  multipleUploader($request,$product);

        toast('تم الإضافة بنجاح','success','top-right');
        return redirect()->route('distributor.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return $this->toShow(compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = StoreCategory::all();
        $stores = Store::where('store_category_id',$product->store->category_id)->get();
        return $this->toEdit(compact('product','categories','stores'));

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
        $product = Product::find($id);

        $rules = [
            'name'=>"required|string|max:191",
            'store_id'=>'required|numeric|exists:stores,id',
            'quantity_per_unit'=>'required|numeric',
            'min_quantity'=>'required|numeric|lt:max_quantity',
            'max_quantity'=>'required|numeric|gt:min_quantity',
            'price'=>'required|numeric',
            'bar_code'=>'required|string|unique:products,bar_code,'.$product->id,
            'expired_at'=>'required|date|after_or_equal:today',
            'image'=>'sometimes|image',
        ];
        $this->validate($request,$rules);
        $inputs = $request->all();
        $inputs['expired_at'] = Carbon::parse($request->expired_at);
        if($request->has('image') && $request->image !=null){
            $inputs['image'] =  saveImage($request->image, 'products');
        }

        $product->update($inputs);

        if($request->has('images') && $request->images !=null) {
            $product->images()->delete();
            foreach ($request->images as $image) {
                $product->images()->create(['image' => saveImage($image, 'users')]);
            }
        }

        toast('تم التعديل بنجاح','success','top-right');
        return redirect()->route('distributor.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        toast('تم الحذف بنجاح','success','top-right');
        return redirect()->route('distributor.products.index');
    }

    public function addQuantityForm($id){
        $product = Product::findOrFail($id);
        $users= User::whereIsDistributor(1)->get();
        return view('distributor.products.add_quantity',compact('product','users'));
    }


    public function storeProductQuantity(Request $request,$id){
        $product = Product::find($id);

        $rules = [
            'quantity'=>"required|numeric",
            'type'=>'required|in:in,out',
            'user_id'=>'sometimes|exists:users,id',
        ];
        $this->validate($request,$rules);

        $quantityAfterAdding = $product->quantity() + $request->quantity;

        if($quantityAfterAdding > $product->max_quantity){
            toast('الكمية اكبر من المسموح بها في المخزن','error','top-right');
            return back();
        }

        $product->quantities()->create($request->all());
        toast('تم إضافة الكمية بنجاح','success','top-right');
        return redirect()->back();
    }








}
