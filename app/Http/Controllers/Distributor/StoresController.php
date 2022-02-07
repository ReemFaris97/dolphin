<?php

namespace App\Http\Controllers\Distributor;

use App\Models\Product;
use App\Models\ProductQuantity;
use App\Models\Store;
use App\Models\StoreCategory;
use App\Traits\Distributor\StoreTransferRequestOperation;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;
use Illuminate\Validation\Rule;

class StoresController extends Controller
{
    use Viewable, StoreTransferRequestOperation;

    private $viewable = "distributor.stores.";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $stores = Store::with("distributor", "category")
            ->get()
            ->reverse();
        return $this->toIndex(compact("stores"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $store_categories = StoreCategory::pluck("name", "id");

        $distributor = User::query()
            ->available()
            ->distributor()
            ->pluck("name", "id");

        return $this->toCreate(compact("store_categories", "distributor"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $rules = [
            "name.*" => "required|string|max:191",
            "store_category_id" =>
                "required|numeric|exists:store_categories,id",
            "for_distributor" => "required|boolean",
            "distributor_id" =>
                "required_if:for_distributor,==,1|nullable|exists:users,id",
            "note" => "nullable|string",
        ];
        $this->validate($request, $rules);
        Store::create($request->all());
        toast("تم الإضافة بنجاح", "success", "top-right");
        return redirect()->route("distributor.stores.index");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        return $this->toShow([
            "store" => Store::with([
                "totalQuantities" => function ($q) {
                    $q->with("product");
                },
            ])->findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $store = Store::findOrFail($id);
        $store_categories = StoreCategory::pluck("name", "id");
        $distributor = User::query()
            ->available()
            ->distributor()
            ->pluck("name", "id");

        return $this->toEdit(
            compact("store", "store_categories", "distributor")
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $store = Store::findOrFail($id);

        $rules = [
            "name.*" => "required|string|max:191",
            "store_category_id" =>
                "required|numeric|exists:store_categories,id",
            "distributor_id" =>
                "required_if:for_distributor,==,1|nullable|exists:users,id",
            "note" => "nullable|string",
            "for_distributor" => "required|boolean",
        ];
        $this->validate($request, $rules);
        $store->update($request->all());
        toast("تم التعديل بنجاح", "success", "top-right");
        return redirect()->route("distributor.stores.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $store = Store::find($id);
        if ($store->products->count() > 0) {
            toast("لا يمكن حذف مستودع به اصناف", "error", "top-right");
            return back();
        } else {
            $store->delete();
            toast("تم الحذف بنجاح", "success", "top-right");
            return back();
        }
    }

    public function changeStatus($id)
    {
        $item = Store::find($id);
        //        dd($item);
        if ($item->is_active == 1) {
            $item->update(["is_active" => 0]);
            toast("تم إلغاء التفعيل بنجاح", "success", "top-right");
            return redirect()->route("distributor.stores.index");
        } else {
            $item->update(["is_active" => 1]);
            toast("تم  التفعيل بنجاح", "success", "top-right");
            return redirect()->route("distributor.stores.index");
        }
    }

    public function addProductForm($store_id = null)
    {
        return view("distributor.stores.addProducts", [
            "store_id" => $store_id,
            "users" => User::query()
                ->distributor()
                ->pluck("name", "id"),
            "products" => Product::query()->get([
                "name",
                "id",
                "quantity_per_unit",
            ]),
            "stores" => Store::where("for_distributor", 0)
                ->where("for_damaged", 0)
                ->pluck("name", "id"),
        ]);
    }

    public function addProduct(Request $request, $store_id = null)
    {
        $this->validate($request, [
            // "from.store_id" => 'required|integer|exists:stores,id',
            // "to.user_id" => 'required|integer|exists:users,id',
            "to.store_id" => "required|integer|exists:stores,id",
            "products.*.product_id" => "required|integer|exists:products,id",
            "products.*.quantity" => "required|integer",
        ]);

        $request->merge([
            "sender_store_id" => $request->from["store_id"] ?? null,
            "distributor_id" => $request->to["user_id"] ?? null,
            "distributor_store_id" => $request->to["store_id"] ?? null,
            "is_confirmed" => 0,
        ]);
        $this->AddStoreTransferRequest($request);

        toast("تم  الاضافه بنجاح", "success", "top-right");

        return redirect()->route("distributor.stores.index");
    }

    public function moveProductForm($store_id = null)
    {
        $store = Store::find($store_id) ?? new Store();

        $products = optional($store)->totalQuantities ?? [];
        if ($store->for_distributor) {
            $stores = Store::where("for_damaged", 0)
                ->where("is_active", 1)
                ->where("distributor_id", $store->distributor_id)
                ->pluck("name", "id");
        } else {
            $stores = Store::where("for_damaged", 0)
                ->where("is_active", 1)
                ->where("for_distributor", 0)
                ->pluck("name", "id");
        }
        return view("distributor.stores.MoveProducts", [
            "store" => $store,
            "stores" => $stores,
            "products" => $products,
            "users" => User::query()
                ->available()
                ->distributor()
                ->pluck("name", "id"),
        ]);
    }

    public function moveProduct(Request $request, $store_id = null)
    {
        $this->validate($request, [
            "for_distributor" => "required|boolean",
            "from.user_id" =>
                "nullable|required_if:for_distributor,==,1|integer|exists:users,id",
            "from.store_id" => [
                "required",
                "integer",
                Rule::exists("stores", "id")->where("for_damaged", 0),
            ],
            "to.user_id" => "required|integer|exists:users,id",
            "to.store_id" => [
                "required",
                "integer",
                Rule::exists("stores", "id")->where("for_damaged", 0),
            ],
            "products.*.product_id" => "required|integer|exists:products,id",
            "products.*.quantity" => "required|integer",
        ]);

        $request->merge([
            "sender_id" => $request->from["user_id"] ?? null,
            "sender_store_id" => $request->from["store_id"],
            "distributor_id" => $request->to["user_id"],
            "distributor_store_id" => $request->to["store_id"],
            "is_confirmed" => 0,
        ]);
        $this->AddStoreTransferRequest($request);

        toast("تم  النقل بنجاح", "success", "top-right");

        return redirect()->route("distributor.stores.index");
    }

    public function damageProductForm($store_id = null)
    {
        $store = Store::find($store_id) ?? new Store();

        if ($store->for_distributor == 1) {
            $stores = Store::where("is_active", 1)
                ->where("distributor_id", $store->distributor_id)
                ->where("for_damaged", 0)
                ->pluck("name", "id");
        } else {
            $stores = Store::where("for_damaged", 0)
                ->where("is_active", 1)
                ->where("for_distributor", 0)
                ->pluck("name", "id");
        }
        /*,
         Rule::exists('stores','id')->where('for_damaged',0)*/
        return view("distributor.stores.DamageProducts", [
            "users" => User::query()
                ->distributor()
                ->pluck("name", "id"),
            "store" => $store,
            "products" => optional($store)->totalQuantities ?? [],
            "user_stores" => $stores,
        ]);
    }

    public function damageProduct(Request $request, $store_id = null)
    {
        $this->validate($request, [
            "for_distributor" => "required|boolean",
            "user_id" =>
                "nullable|required_if:for_distributor,==,1|integer|exists:users,id",
            "store_id" => [
                "required",
                "integer",
                Rule::exists("stores", "id")->where("for_damaged", 0),
            ],
            "products.*.product_id" => "required|integer|exists:products,id",
            "products.*.quantity" => "required|integer",
        ]);
        $data = [
            "user_id" => $request->user_id,
            "type" => "damaged",
            "store_id" => $request->store_id,
        ];
        $damage_store =
            Store::ofDistributor($request->user_id)
                ->where("for_damaged", 1)
                ->first() ?? User::find($request->user_id)->createDamageStore();

        $requests = $request->except("image");
        if ($request->hasFile("image")) {
            $requests["image"] = saveImage($request->image, "users");
        }
        \DB::beginTransaction();
        foreach ($request->products ?? [] as $product) {
            ProductQuantity::create(
                [
                    "product_id" => $product["product_id"],
                    "quantity" => $product["quantity"],
                    "image" => $requests["image"],
                ] + $data
            );
            ProductQuantity::create(
                [
                    "product_id" => $product["product_id"],
                    "quantity" => $product["quantity"],
                    "image" => $requests["image"],
                    "store_id" => $damage_store->id,
                    "type" => "in",
                ] + $data
            );
        }
        \DB::commit();
        toast("تم  تسجيل التالف بنجاح", "success", "top-right");
        return redirect()->route("distributor.stores.index");
    }
}
