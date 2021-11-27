<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingClient;
use App\Models\AccountingSystem\AccountingDevice;
use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingProductCategory;
use App\Models\AccountingSystem\AccountingProductStore;
use App\Models\AccountingSystem\AccountingProductSubUnit;
use App\Models\AccountingSystem\AccountingSession;
use App\Models\AccountingSystem\AccountingStore;
use App\Models\AccountingSystem\AccountingUserPermission;
use App\Models\User;
use App\Traits\Viewable;
use Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SellPointController extends Controller
{
    use Viewable;
//    private $viewable = 'AccountingSystem.sells_points.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sell_point(Request $request, $id)
    {
        $categories=AccountingProductCategory::all();
//        dd(Cookie::get('session'));
        $session=AccountingSession::find(Cookie::get('session'))??AccountingSession::latest()->first();
        $clients=AccountingClient::pluck('name', 'id')->toArray();
        $userstores = AccountingUserPermission::where('user_id', auth()->user()->id)
            ->where('model_type', 'App\Models\AccountingSystem\AccountingStore')->pluck('model_id', 'id')->toArray();
        $stores=AccountingStore::whereIn('id', $userstores)->pluck('ar_name', 'id')->toArray();
        if ($userstores) {
//            $store_product=AccountingProductStore::whereIn('store_id', $userstores)->pluck('product_id', 'id')->toArray();
//            $products=AccountingProduct::whereIn('id', $store_product)->get();
        } else {
            $products=[];
        }

        return  view('AccountingSystem.sell_points.sell_point', compact('categories', 'clients', 'session', 'stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductAjex(Request $request, $id)
    {
        if ($request->id) {
            $products= AccountingProduct::query()
                ->when($request->search, function ($b) use ($request) {
                    return $b->where(function ($q) use ($request) {
                        $q->where('name', 'LIKE', '%' . $request->search . '%')->orWhere('en_name', 'LIKE', '%' . $request->search . '%')->orWhere('description', 'LIKE', '%' . $request->search . '%')->orWhere('bar_code', 'like', '%' . $request->search . '%');
                    });
                })->orwhereHas('barcodes', fn ($b) => $b->where('barcode', 'like', "%$request->search%"))
                ->orwhereHas('sub_units', fn ($b) => $b->where('bar_code', 'like', "%$request->search%"))
                ->where('store_id', $id)
                ->paginate(20);

            return response()->json([
                'status'=>true,
                'has_more' => $products->hasMorePages(),
                'data'=> $products,
//                    'attributes' => view('AccountingSystem.sell_points.product-optionss', ['products' => $products])->render()
            ]);
        }
    }

    public function selectedProduct(AccountingProduct $product)
    {
        $producttax = \App\Models\AccountingSystem\AccountingProductTax::where('product_id', $product->id)->first();
        $units = \App\Models\AccountingSystem\AccountingProductSubUnit::where('product_id', $product->id)->get();
        $subunits = collect($units);

        $allunits = json_encode($subunits, JSON_UNESCAPED_UNICODE);
        $mainunits = json_encode(collect([['id' => 'main-' . $product->id, 'name' => $product->main_unit, 'purchasing_price' => $product->purchasing_price, 'product_id' => $product->id, 'bar_code' => $product->bar_code, 'main_unit_present' => 1, 'selling_price' => $product->selling_price, 'created_at' => $product->created_at, 'updated_at' => $product->updated_at, 'quantity' => $product->quantity]]), JSON_UNESCAPED_UNICODE);
        $merged = array_merge(json_decode($mainunits), json_decode($allunits));
        $lastPrice = \App\Models\AccountingSystem\AccountingPurchaseItem::where('product_id', $product->id)
            ->latest()
            ->first();
        return response()->json([
            'id'=>$product->id,
            'main_unit'=>$product->main_unit,
            'name'=>$product->name,
            'price'=>$product->selling_price,
            'bar_code'=>$product->bar_code,
            'link'=>route('accounting.products.show', $product->id),
            'price_has_tax'=>isset($producttax) ? $producttax->price_has_tax : '0',
            'total_taxes'=>isset($producttax) ? $product->total_taxes : '0',
            'subunits'=> json_encode($merged),
            'total_discounts'=>$product->total_discounts

        ]);
    }

    public function pro_search($q)
    {
        $products=AccountingProduct::where('name', 'LIKE', '%'.$q.'%')->get();
        // $products_a=AccountingProduct::where('category_id',$id)->pluck('id','id')->toArray();

        return response()->json([
            'status'=>true,
            'data'=>view('AccountingSystem.sell_points.sell')->with('products', $products)->render()
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sell_login()
    {
        $users = User::where('is_saler', 1)->pluck('name', 'id')->toArray();
        $devices = AccountingDevice::where('available', 1)->pluck('name', 'id')->toArray();
        $userstores = AccountingUserPermission::where('user_id', auth()->user()->id)
            ->where('model_type', 'App\Models\AccountingSystem\AccountingStore')->pluck('model_id', 'id')->toArray();
        $stores = AccountingStore::whereIn('id', $userstores)->pluck('ar_name', 'id')->toArray();

        return view('AccountingSystem.sell_points.login', compact('users', 'devices', 'stores'));
    }

    /**
     *
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }


    public function barcode_search(Request $request, $q)
    {
        $store_product=AccountingProductStore::where('store_id', $request['store_id'])->pluck('product_id', 'id')->toArray();
        $products=AccountingProduct::ofBarcode($q)
        ->with('sub_units')
        /* ->whereIn('id', $store_product) */
        ->get();
        $products->transform(function ($product) use ($q) {
            $sub_unit=  $product->sub_units->filter(function ($subunit) use ($q) {
                return  Str::contains($subunit->bar_code, $q);
            })->first();
            if ($sub_unit!=null) {
                $product->unit=$sub_unit->id;
                $product->selling_price=$sub_unit->selling_price;
            } /* else {
                $product->main_unit='main-'.$product->id;
            } */
            return $product;
        });
        $selectd_unit_id=optional($products->first())->main_unit??0;

        return response()->json([
            'status'=>true,
            'data'=>view('AccountingSystem.sell_points.barcodeProducts', compact('products', 'selectd_unit_id'))->render()
        ]);
    }
}
