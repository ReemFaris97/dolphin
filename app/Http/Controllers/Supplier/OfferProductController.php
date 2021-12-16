<?php

namespace App\Http\Controllers\Supplier;

use App\Models\OfferProduct;
use App\Models\Product;
use App\Models\SupplierOffer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class OfferProductController extends Controller
{
    use Viewable;
    private $viewable = 'suppliers.offers.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = SupplierOffer::all()->reverse();
        return $this->toIndex(compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products=Product::all();
        //  $product=[];
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
            'products'=>'required|array',
            'qtys'=>'required|array',
            'prices'=>'required|array',
        ];
        $this->validate($request, $rules);

        $inputs = $request->all();
        $offer = SupplierOffer::create(['user_id'=>auth()->id()]);
        $collection = collect([$inputs]);
        $products = collect($inputs['products']);
        $qtys = collect($inputs['qtys']);
        $prices = collect($inputs['prices']);
        $merges = $products->zip($qtys, $prices);

        foreach ($merges as $merge) {
            $offerProduct= OfferProduct::create(['product_id'=>$merge['0'],'quantity'=> $merge['1'],'price'=>$merge['2'],'supplier_offer_id'=>$offer->id]);
        }



        alert()->success('تم  اضافة   بنجاح !')->autoclose(5000);

        return redirect()->route('supplier.offers.index');
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
        $supplieroffer= SupplierOffer::findOrFail($id);
        $products=Product::all();
        $supplieroffer->offer_products;
        return $this->toEdit(compact('supplieroffer', 'products'));
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
        $user = User::findOrFail($id);

        $rules = [
            'name'=>'required|string|max:191',
            'phone'=>'required|numeric|unique:users,phone,'.$user->id,
            'email'=>'required|string|unique:users,email,'.$user->id,
        ];
        $this->validate($request, $rules);
        $requests = $request->except('image', 'password');
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'users');
        }

        if ($request->password != null && !\Hash::check($request->old_password, $user->password)) {
            return back()->withInput()->withErrors(['old_password' => 'كلمه المرور القديمه غير صحيحه']);
        }
        $user->fill($requests);
//        $user->syncPermissions($request->permissions);
        $user->save();
        alert()->success('تم تعديل   بنجاح !')->autoclose(5000);

        return redirect()->route('supplier.suppliers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dd=  SupplierOffer::find($id);
        $dd->delete();
        alert()->success('تم الحذف   بنجاح !')->autoclose(5000);
        return back();
    }

    public function remove($id)
    {
        $dd=  OfferProduct::find($id);
        $dd->delete();
        alert()->success('تم الحذف   بنجاح !')->autoclose(5000);
        return back();
    }
    public function getAjaxProductQty(Request $request)
    {
        $product = Product::find($request->id);
        return response()->json([
            'data'=>$product?->qty??0
        ]);
    }
}
