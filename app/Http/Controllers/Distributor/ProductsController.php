<?php

namespace App\Http\Controllers\Distributor;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Store;
use App\Models\StoreCategory;
use App\Traits\Supplier\ProductsOperations;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ClientClass;
use App\Models\ClientClassProduct;
use App\Traits\Viewable;
use Symfony\Component\HttpKernel\Client;

class ProductsController extends Controller
{
    use Viewable;
    use ProductsOperations;

    private $viewable = "distributor.products.";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all()->reverse();
        return $this->toIndex(compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //        $categories = StoreCategory::pluck('name','id');
        $client_classes = ClientClass::active()->get(["id", "name"]);
        return $this->toCreate(compact("client_classes"));
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
            "name" => "required|string|max:191",
            //            'store_id' => 'required|numeric|exists:stores,id',
            "quantity_per_unit" => "required|numeric",
            "min_quantity" => "required|numeric|lt:max_quantity",
            "max_quantity" => "required|numeric|gt:min_quantity",
            "price" => "required|numeric",
            // 'code' => 'required|string|unique:products,code',
            "bar_code" => "required|string|unique:products,bar_code",
            "expired_at" => "required|date|after_or_equal:today",
            "image" => "required|image",
            "images" => "required|array",
        ];

        $this->validate($request, $rules);
        $inputs = $request->all();

        $inputs["expired_at"] = Carbon::parse($request->expired_at);
        $inputs["image"] = saveImage($request->image, "products");

        $product = Product::create($inputs);
        foreach ($request->images as $image) {
            $product->images()->create(["image" => saveImage($image, "users")]);
        }
        foreach ($request->client_classes as $client_class) {
            ClientClassProduct::query()->updateOrCreate(
                [
                    "product_id" => $product->id,
                    "client_class_id" => $client_class["id"],
                ],
                ["price" => $client_class["price"]]
            );
        }
        \DB::commit();

        //  multipleUploader($request,$product);

        toast("تم الإضافة بنجاح", "success", "top-right");
        return redirect()->route("distributor.products.index");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return $this->toShow(compact("product"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $product = Product::query()
            ->with("client_classes")
            ->findOrFail($id);
        $client_classes = ClientClass::active()->get(["id", "name"]);

        //        $categories = StoreCategory::all();
        //        $stores = Store::where('store_category_id', $product->store->category->id)->get();
        return $this->toEdit(
            compact("product", "client_classes" /*, 'categories', 'stores'*/)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $rules = [
            "name" => "required|string|max:191",
            //  'store_id' => 'required|numeric|exists:stores,id',
            "quantity_per_unit" => "required|numeric",
            "min_quantity" => "required|numeric|lt:max_quantity",
            "max_quantity" => "required|numeric|gt:min_quantity",
            "price" => "required|numeric",
            "bar_code" =>
                "required|string|unique:products,bar_code," . $product->id,
            "expired_at" => "required|date|after_or_equal:today",
            "image" => "sometimes|image",
        ];
        $this->validate($request, $rules);
        $inputs = $request->all();
        $inputs["expired_at"] = Carbon::parse($request->expired_at);
        if ($request->has("image") && $request->image != null) {
            $inputs["image"] = saveImage($request->image, "products");
        }
        \DB::beginTransaction();
        $product->update($inputs);

        if ($request->has("images") && $request->images != null) {
            $product->images()->delete();
            foreach ($request->images as $image) {
                $product
                    ->images()
                    ->create(["image" => saveImage($image, "users")]);
            }
        }

        foreach ($request->client_classes as $client_class) {
            ClientClassProduct::query()->updateOrCreate(
                [
                    "product_id" => $id,
                    "client_class_id" => $client_class["id"],
                ],
                ["price" => $client_class["price"]]
            );
        }
        \DB::commit();

        toast("تم التعديل بنجاح", "success", "top-right");
        return redirect()->route("distributor.products.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        toast("تم الحذف بنجاح", "success", "top-right");
        return redirect()->route("distributor.products.index");
    }

    public function addQuantityForm($id)
    {
        $product = Product::findOrFail($id);
        $users = User::Distributor()->pluck("name", "id");
        return view(
            "distributor.products.add_quantity",
            compact("product", "users")
        );
    }

    public function storeProductQuantity(Request $request, $id)
    {
        $product = Product::query()->find($id);

        $rules = [
            "quantity" => "required|numeric",
            //            'type' => 'required|in:in,out',
            "user_id" => "required|exists:users,id",
            "store_id" => "required|exists:stores,id",
        ];
        $this->validate($request, $rules);
        $store_quantity = $product
            ->quantities()
            ->where([
                "is_confirmed" => 1,
                "type" => "in",
                "store_id" => $request->store_id,
            ])
            ->sum("quantity");
        //        $quantityAfterAdding = $product->quantity() + $request->quantity;
        $quantityAfterAdding = $store_quantity + $request->quantity;
        if ($quantityAfterAdding > $product->max_quantity) {
            toast(
                "الكمية اكبر من المسموح بها في المستودع",
                "error",
                "top-right"
            );
            return back();
        }
        $requests = $request->all();
        $requests["type"] = "in";
        $requests["is_confirmed"] = 1;
        $product->quantities()->create($requests);
        toast("تم إضافة الكمية بنجاح", "success", "top-right");
        return redirect()->back();
    }
}
