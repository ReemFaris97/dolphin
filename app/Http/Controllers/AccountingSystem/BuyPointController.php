<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingProductCategory;
use App\Models\AccountingSystem\AccountingProductStore;
use App\Models\AccountingSystem\AccountingProductSubUnit;
use App\Models\AccountingSystem\AccountingSafe;
use App\Models\AccountingSystem\AccountingStore;
use App\Models\AccountingSystem\AccountingSupplier;
use App\Models\AccountingSystem\AccountingUserPermission;
use DB;
use Illuminate\Http\Request;

class BuyPointController extends Controller
{
    // use Viewable;
    //    private $viewable = 'AccountingSystem.sells_points.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function buy_point()
    {
        $categories = AccountingProductCategory::pluck('ar_name', 'id')->toArray();
        $suppliers = AccountingSupplier::pluck('name', 'id')->toArray();
        $safes = AccountingSafe::pluck('name', 'id')->toArray();
        // $products=AccountingProduct::all();
        $userstores = AccountingUserPermission::where('user_id', auth()->user()->id)->where('model_type', 'App\Models\AccountingSystem\AccountingStore')->pluck('model_id', 'id')->toArray();
        $stores = AccountingStore::whereIn('id', $userstores)->pluck('ar_name', 'id')->toArray();

        $products = [];


        return view('AccountingSystem.buy_points.buy_point', compact('categories', 'suppliers', 'safes', 'products', 'stores'));
    }

    public function getProductAjex(Request $request)
    {
        $products =AccountingProduct::query()
                 ->when($request->search, function ($b) use ($request) {
                     return $b->where(function ($q) use ($request) {
                         $q->where('name', 'LIKE', '%' . $request->search . '%')->orWhere('en_name', 'LIKE', '%' . $request->search . '%')->orWhere('description', 'LIKE', '%' . $request->search . '%')->orWhere('bar_code', 'like', '%' . $request->search . '%');
                     });
                 })->orwhereHas('barcodes', fn ($b) => $b->where('barcode', 'like', "%$request->search%"))
                 ->orwhereHas('sub_units', fn ($b) => $b->where('bar_code', 'like', "%$request->search%"))

            ->when(\request('store_id'), function ($q) {
                $q->where('store_id', \request('store_id'));
            })

            ->paginate(20);

        return response()->json([
            'status' => true,
            'has_more' => $products->hasMorePages(),
            'data' => $products,
//                'attributes' => view('AccountingSystem.sell_points.product-optionss', ['products' => $products])->render()
        ]);
    }

    public function selectedProduct(AccountingProduct $product)
    {
        $producttax = \App\Models\AccountingSystem\AccountingProductTax::where('product_id', $product->id)->first();
        $units = \App\Models\AccountingSystem\AccountingProductSubUnit::where('product_id', $product->id)->get();
        $subunits = collect($units);
        $allunits = json_encode($subunits, JSON_UNESCAPED_UNICODE);
        $mainunits = json_encode(collect([['id' => 'main-' . $product->id, 'name' => $product->main_unit,
            'purchasing_price' => $product->purchasing_price,
            'product_id' => $product->id,
            'bar_code' => $product->bar_code,
            'main_unit_present' => 1,
            'selling_price' => $product->selling_price,
            'created_at' => $product->created_at,
            'updated_at' => $product->updated_at,
            'quantity' => $product->quantity,
        ]]), JSON_UNESCAPED_UNICODE);
        $merged = array_merge(json_decode($mainunits), json_decode($allunits));
        $lastPrice = \App\Models\AccountingSystem\AccountingPurchaseItem::where('product_id', $product->id)->latest()->first();

        $sumQuantity = \App\Models\AccountingSystem\AccountingPurchaseItem::where('product_id', $product->id)->sum('quantity');
        $arrPrice = DB::table('accounting_purchases_items')->where('product_id', $product->id)
            ->selectRaw('SUM(price_after_tax * quantity) as total')
            ->pluck('total');
        $total = 0;
        foreach ($arrPrice as $price) {
            $total += $price;
        }
        if ($sumQuantity != 0) {
            $average = $total / $sumQuantity;
        } else {
            $average = 0;
        }

        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->purchasing_price,
            'bar_code' => $product->bar_code,
            'link' => route('accounting.products.show', $product->id),
            'main_unit' => $product->main_unit,
            'price_has_tax' => isset($producttax) ? $producttax->price_has_tax : '0',
            'total_taxes' => isset($producttax) ? $product->total_taxes : '0',
            'subunits' => json_encode($merged),
            'total_discounts' => $product->total_discounts,
            'last_price' => $lastPrice->price_after_tax ?? 0,
            'average' => ($average) ?? 0,
            'product_expiration' => ($product->type == 'product_expiration') ? '1' : '0'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /* public  function getProductAjex(Request $request)
     {
         $store_product = AccountingProductStore::where('store_id', $request['id'])->pluck('product_id', 'id')->toArray();
         $products = AccountingProduct::whereIn('id', $store_product)->get();
         //dd($products);

         return response()->json([
             'status' => true,
             'data' => view('AccountingSystem.buy_points.products')->with('products', $products)->render()
         ]);
     }*/

    public function pro_search($q)
    {
        $products = AccountingProduct::where('name', 'LIKE', '%' . $q . '%')->get();

        return response()->json([
            'status' => true,
            'data' => view('AccountingSystem.buy_points.sell')->with('products', $products)->render()
        ]);
    }

    public function barcode_search(Request $request, $q)
    {
        $store_product = AccountingProductStore::where('store_id', $request['store_id'])->pluck('product_id', 'id')->toArray();
$q=       str_replace(' ', '', $q);
        $products = AccountingProduct::ofBarcode($q)->get();
        $selectd_unit_id = optional(AccountingProductSubUnit::query()->ofBarcode($q)->first())->id??'main-'.optional($products->first())->id;

        return response()->json([
                'status' => true,
                'data' => view('AccountingSystem.buy_points.barcodeProducts', compact('products', 'selectd_unit_id'))->render()
            ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     *
     * Display the specified resource.
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
}
