<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingClient;
use App\Models\AccountingSystem\AccountingDevice;
use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingProductCategory;
use App\Models\AccountingSystem\AccountingProductSubUnit;
use App\Models\AccountingSystem\AccountingSale;
use App\Models\AccountingSystem\AccountingSession;
use App\Models\AccountingSystem\AccountingStore;
use App\Models\AccountingSystem\AccountingUserPermission;
use App\Traits\Viewable;
use Cookie;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

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
        $categories = AccountingProductCategory::all();
        //        dd(Cookie::get('session'));
        $session =
            AccountingSession::find(Cookie::get("session")) ??
            AccountingSession::latest()->first();
        $clients = AccountingClient::pluck("name", "id")->toArray();
        $userstores = AccountingUserPermission::where(
            "user_id",
            auth()->user()->id
        )
            ->where("model_type", "App\Models\AccountingSystem\AccountingStore")
            ->pluck("model_id", "id")
            ->toArray();
        $stores = AccountingStore::whereIn("id", $userstores)
            ->pluck("ar_name", "id")
            ->toArray();
        if ($userstores) {
            //            $store_product=AccountingProductStore::whereIn('store_id', $userstores)->pluck('product_id', 'id')->toArray();
            //            $products=AccountingProduct::whereIn('id', $store_product)->get();
        } else {
            $products = [];
        }

        return view(
            "AccountingSystem.sell_points.sell_point",
            compact("categories", "clients", "session", "stores")
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductAjex(Request $request, $id = null)
    {
        $products = AccountingProduct::query()
            ->when($request->search, function ($b) use ($request) {
                $b->where(function ($q) use ($request) {
                    $q->where("name", "LIKE", "%" . $request->search . "%")
                        ->orWhere(
                            "en_name",
                            "LIKE",
                            "%" . $request->search . "%"
                        )
                        ->orWhere(
                            "description",
                            "LIKE",
                            "%" . $request->search . "%"
                        )
                        ->orWhere(
                            "bar_code",
                            "like",
                            "%" . $request->search . "%"
                        )
                        ->orwhereHas(
                            "barcodes",
                            fn($b) => $b->where(
                                "barcode",
                                "like",
                                "%$request->search%"
                            )
                        )
                        ->orwhereHas(
                            "sub_units",
                            fn($b) => $b->where(
                                "bar_code",
                                "like",
                                "%$request->search%"
                            )
                        );
                });
            })
            ->when(
                $request->has("supplier_id") and $request->supplier_id,
                function ($q) {
                    $q->whereHas("suppliers", function ($q) {
                        $q->where(
                            "accounting_suppliers.id",
                            \request("supplier_id")
                        );
                    });
                }
            )
            ->paginate(20);

        return response()->json([
            "status" => true,
            "has_more" => $products->hasMorePages(),
            "data" => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSaleAjax(Request $request, $id = null)
    {
        $sales = AccountingSale::query()
            ->when(
                $request->search,
                fn($q) => $q->where("id", $request->search)
            )
            ->select(["id", DB::raw("id as name")])
            ->paginate(20);
        return response()->json([
            "status" => true,
            "has_more" => $sales->hasMorePages(),
            "data" => $sales,
        ]);
    }

    public function selectedProduct(AccountingProduct $product)
    {
        $producttax = \App\Models\AccountingSystem\AccountingProductTax::where(
            "product_id",
            $product->id
        )->first();
        $units = \App\Models\AccountingSystem\AccountingProductSubUnit::where(
            "product_id",
            $product->id
        )->get();
        $subunits = collect($units);
        $allunits = json_encode($subunits, JSON_UNESCAPED_UNICODE);
        $mainunits = json_encode(
            collect([
                [
                    "id" => "main-" . $product->id,
                    "name" => $product->main_unit,
                    "purchasing_price" => $product->purchasing_price,
                    "product_id" => $product->id,
                    "bar_code" => $product->bar_code,
                    "main_unit_present" => 1,
                    "selling_price" => $product->selling_price,
                    "created_at" => $product->created_at,
                    "updated_at" => $product->updated_at,
                    "quantity" => $product->quantity,
                ],
            ]),
            JSON_UNESCAPED_UNICODE
        );
        $merged = array_merge(json_decode($mainunits), json_decode($allunits));
        $lastPrice = \App\Models\AccountingSystem\AccountingPurchaseItem::where(
            "product_id",
            $product->id
        )
            ->latest()
            ->first();
        return response()->json([
            "id" => $product->id,
            "main_unit" => $product->main_unit,
            "name" => $product->name,
            "price" => $product->selling_price,
            "bar_code" => $product->bar_code,
            "link" => route("accounting.products.show", $product->id),
            "price_has_tax" => isset($producttax)
                ? $producttax->price_has_tax
                : "0",
            "total_taxes" => isset($producttax) ? $product->total_taxes : "0",
            "subunits" => json_encode($merged),
            "total_discounts" => $product->total_discounts,
        ]);
    }

    public function pro_search($q)
    {
        $products = AccountingProduct::where(
            "name",
            "LIKE",
            "%" . $q . "%"
        )->get();
        // $products_a=AccountingProduct::where('category_id',$id)->pluck('id','id')->toArray();

        return response()->json([
            "status" => true,
            "data" => view("AccountingSystem.sell_points.sell")
                ->with("products", $products)
                ->render(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function sell_login()
    {
        //        $users = User::where('is_saler', 1)->pluck('name', 'id')->toArray();
        //        $devices = AccountingDevice::where('available', 1)->pluck('name', 'id')->toArray();
        //        $userstores = AccountingUserPermission::where('user_id', auth()->user()->id)
        //            ->where('model_type', AccountingStore::class)
        //            ->pluck('model_id', 'id')->toArray();
        //        $stores = AccountingStore::whereIn('id', $userstores)->pluck('ar_name', 'id')->toArray();
        //////////////////////////////////////////////////////////

        if (Cookie::get("session") != null) {
            return redirect(
                route("accounting.invoices.current", Cookie::get("session"))
            );
        }
        $shift_id =
            optional(
                AccountingBranchShift::whereTime("from", "<=", now())
                    ->whereTime("to", ">=", now())
                    ->first()
            )->id ?? AccountingBranchShift::first()->id;
        $device_id =
            optional(AccountingDevice::where("available", 1)->first())->id ??
            AccountingDevice::latest()->first()->id;
        $store_id =
            optional(
                AccountingStore::where("user_id", auth()->user()->id)->first()
            )->id ?? AccountingStore::first()->store_id;

        $params = new FormRequest([
            "shift_id" => $shift_id,
            "device_id" => $device_id,
            "store_id" => $store_id,
        ]);

        return App::make(SessionController::class)->store($params);
        //  return app(SessionController::class)->action('store', $params);

        //  return view('AccountingSystem.sell_points.login', compact('users', 'devices', 'stores'));
    }

    public function barcode_search(Request $request, $q)
    {
        $quantity = 1;
        $product = AccountingProduct::query()
            ->ofBarcode($q)
            ->with(["sub_units" => fn($query) => $query->ofBarcode($q)])
            ->withCount(["sub_units" => fn($query) => $query->ofBarcode($q)])
            ->orderBy("sub_units_count", "asc")
            ->first();
        if (!$product) {
            if (str_starts_with($q, getsetting("weight_code"))) {
                $barcode = substr($q, 2);
                $pos = getsetting("code_number");
                $q = substr($barcode, 0, $pos);
                $quantity = substr($barcode, $pos);

                $kilo = substr($quantity, 0, 2);
                $grams = substr($quantity, 2);
                $quantity = (int) $kilo * 1000 + $grams / 10;
                $product = AccountingProduct::query()
                    ->ofBarcode($q)
                    ->with(["sub_units" => fn($query) => $query->ofBarcode($q)])
                    ->withCount([
                        "sub_units" => fn($query) => $query->ofBarcode($q),
                    ])
                    ->orderBy("sub_units_count", "asc")
                    ->first();
            }
        }

        if (!$product) {
            return response()->json([
                "status" => false,
                "message" => "bar code not found",
            ]);
        }

        $selected_sub_unit = AccountingProductSubUnit::query()
            ->ofBarcode($q)
            ->first();

        $producttax = \App\Models\AccountingSystem\AccountingProductTax::where(
            "product_id",
            $product->id
        )->first();
        $units = \App\Models\AccountingSystem\AccountingProductSubUnit::where(
            "product_id",
            $product->id
        )
            ->when($selected_sub_unit, function ($q) use ($selected_sub_unit) {
                $q->where("id", "!=", $selected_sub_unit->id);
            })
            ->get() /* ->sortBy(fn ($a) =>dd($a->sub_units),'asc') */;
        $subunits = collect($units);

        $allunits = json_encode($subunits, JSON_UNESCAPED_UNICODE);
        $mainunits = json_encode(
            collect([
                [
                    "id" => "main-" . $product->id,
                    "name" => $product->main_unit,
                    "purchasing_price" => $product->purchasing_price,
                    "product_id" => $product->id,
                    "bar_code" => $product->bar_code,
                    "main_unit_present" => 1,
                    "selling_price" => $product->selling_price,
                    "created_at" => $product->created_at,
                    "updated_at" => $product->updated_at,
                    "quantity" => $product->quantity,
                ],
            ]),
            JSON_UNESCAPED_UNICODE
        );

        if ($selected_sub_unit) {
            $merged = array_merge(
                [$selected_sub_unit],
                json_decode($mainunits),
                json_decode($allunits)
            );
        } else {
            $merged = array_merge(
                json_decode($mainunits),
                json_decode($allunits)
            );
        }
        // $lastPrice = \App\Models\AccountingSystem\AccountingPurchaseItem::where('product_id', $product->id)
        //     ->latest()
        //     ->first();
        return response()->json([
            "status" => true,
            "id" => $product->id,
            "quantity" => $quantity,
            "main_unit" =>
                /* optional($selected_sub_unit)->id ?? */ $product->main_unit,
            "name" => $product->name,
            "price" =>
                optional($selected_sub_unit)->selling_price ??
                $product->selling_price,
            "selected_sub_unit" => $selected_sub_unit->id ?? "--",
            "bar_code" => $q,
            "link" => route("accounting.products.show", $product->id),
            "price_has_tax" => isset($producttax)
                ? $producttax->price_has_tax
                : "0",
            "total_taxes" => isset($producttax) ? $product->total_taxes : "0",
            "subunits" => json_encode($merged),
            "total_discounts" => $product->total_discounts,
        ]);
    }
}
