<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingColumnCell;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingFaceColumn;
use App\Models\AccountingSystem\AccountingInventory;
use App\Models\AccountingSystem\AccountingInventoryProduct;
use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingProductStore;
use App\Models\AccountingSystem\AccountingStore;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class StoreInventroyController extends Controller
{
    //////////////////////////جرد المستودعات /////////////////////
    public function inventory()
    {
        $stores = AccountingStore::pluck("ar_name", "id")->toArray();
        $products = [];
        return view(
            "AccountingSystem.stores.inventory",
            compact("stores", "products")
        );
    }

    public function inventories()
    {
        $inventories = AccountingInventory::all();
        return view(
            "AccountingSystem.stores.inventories",
            compact("inventories")
        );
    }

    public function show_inventory($id)
    {
        $inventory = AccountingInventory::findOrFail($id);
        $inventory_products = AccountingInventoryProduct::where(
            "inventory_id",
            $id
        )
            ->where("status", 1)
            ->get();
        return view(
            "AccountingSystem.stores.show_inventory",
            compact("inventory", "inventory_products")
        );
    }

    public function inventories_band()
    {
        $inventories = AccountingInventory::all();
        return view(
            "AccountingSystem.stores.inventories_band",
            compact("inventories")
        );
    }

    public function show_inventory_band($id)
    {
        $inventory = AccountingInventory::findOrFail($id);
        $inventory_products = AccountingInventoryProduct::where(
            "inventory_id",
            $id
        )
            ->where("status", 1)
            ->get();
        return view(
            "AccountingSystem.stores.show_inventory_band",
            compact("inventory", "inventory_products")
        );
    }

    public function inventory_store(Request $request)
    {
        $store_id = $request["store_id"];
        $stores = AccountingStore::pluck("ar_name", "id")->toArray();
        //    dd($request->all());
        $product_store = AccountingProductStore::where("store_id", $store_id)
            ->pluck("product_id")
            ->toArray();
        //   dd($product_store);
        $products = AccountingProduct::whereIn("id", $product_store)->get();
        $inventory = AccountingInventory::create([
            "cost_type" => $request["cost_type"],
            "date" => $request["date"],
            "store_id" => $store_id,
            "user_id" => \Auth::user()->id,
        ]);

        if (isset($products)) {
            foreach ($products as $product) {
                $inventory_product = AccountingInventoryProduct::create([
                    "inventory_id" => $inventory->id,
                    "product_id" => $product->id,
                    "quantity" => $product->quantity,
                ]);
            }
        }

        alert()
            ->success("تم  حفظ جرد المستودع بنجاح !")
            ->autoclose(5000);

        return view(
            "AccountingSystem.stores.inventory",
            compact("stores", "products", "inventory")
        );
    }
    public function inventory_settlement(Request $request)
    {
        $inputs = $request->all();
        $rules = [
            "Real_quantity" => "required",
        ];

        $inventory_product = AccountingInventoryProduct::where(
            "inventory_id",
            $inputs["inventory_id"]
        )
            ->where("product_id", $inputs["product_id"])
            ->first();

        $inventory_product->update([
            "Real_quantity" => $inputs["Real_quantity"],
            "status" => 1,
            "updated_at" => Carbon::now()->format("Y-m-d"),
        ]);
    }

    public function invertory_filters()
    {
        $stores = AccountingStore::pluck("ar_name", "id")->toArray();
        $inventories = [];

        return view(
            "AccountingSystem.stores.invertory_filter",
            compact("stores", "inventories")
        );
    }

    public function inventory_filter(Request $request)
    {
        $inputs = $request->all();
        $stores = AccountingStore::pluck("ar_name", "id")->toArray();

        $inventories = AccountingInventory::where(
            "store_id",
            $inputs["store_id"]
        )
            ->wheredate("created_at", $inputs["date"])
            ->get();

        return view(
            "AccountingSystem.stores.invertory_filter",
            compact("stores", "inventories")
        );
    }
    public function invertory_details($id)
    {
        $inventory_products = AccountingInventoryProduct::where(
            "inventory_id",
            $id
        )->get();
        $inventory = AccountingInventory::find($id);
        return view(
            "AccountingSystem.stores.invertory_details",
            compact("inventory_products", "inventory")
        );
    }

    public function inventory_result($id)
    {
        $inventory_products = AccountingInventoryProduct::where(
            "inventory_id",
            $id
        )->get();
        $inventory = AccountingInventory::find($id);
        return view(
            "AccountingSystem.stores.invertory_details",
            compact("inventory_products", "inventory")
        );
    }

    public function inventory_bond(Request $request)
    {
        $inputs = $request->all();
        $inventory = AccountingInventory::find($inputs["inventory_id"]);
        $inventory->update([
            "bond_num" => $inputs["bond_num"],
            "description" => $inputs["description"],
        ]);
        $inventory_products = AccountingInventoryProduct::where(
            "inventory_id",
            $inventory->id
        )
            ->where("status", 1)
            ->get();

        alert()
            ->success("تم  حفظ سند جرد المستودع بنجاح !")
            ->autoclose(5000);
        return view(
            "AccountingSystem.stores.show_inventory_band",
            compact("inventory", "inventory_products")
        );
    }

    //////////////////////////جرد الاصناف/////////////////////

    public function inventory_product()
    {
        $stores = AccountingStore::pluck("ar_name", "id")->toArray();
        $products = AccountingProduct::pluck("name", "id")->toArray();

        return view(
            "AccountingSystem.stores.inventory_product",
            compact("stores", "products")
        );
    }

    public function inventory_store_product(Request $request)
    {
        $inputs = $request->all();
        $rules = [
            "date" => "required",
        ];
        $message = [
            "date.required" => "التاريخ مطلوب ",
        ];
        $this->validate($request, $rules, $message);

        $products = AccountingProduct::pluck("name", "id")->toArray();

        $product = AccountingProduct::find($inputs["product_id"]);
        $inventory = AccountingInventory::create([
            "date" => $request["date"],
            "user_id" => \Auth::user()->id,
        ]);

        $stores_quantity = AccountingProductStore::where(
            "product_id",
            $inputs["product_id"]
        )->sum("quantity");
        if (isset($product)) {
            $inventory_product = AccountingInventoryProduct::create([
                "inventory_id" => $inventory->id,
                "product_id" => $product->id,
                "quantity" => $product->quantity,
            ]);
        }
        alert()
            ->success("تم  حفظ جرد الصنف بنجاح !")
            ->autoclose(5000);

        return view(
            "AccountingSystem.stores.inventory_product",
            compact("products", "inventory", "product", "stores_quantity")
        );
    }
    public function inventory_settlement_product(Request $request)
    {
        $inputs = $request->all();
        //dd($inputs);
        $inventory_product = AccountingInventoryProduct::where(
            "inventory_id",
            $inputs["inventory_id"]
        )
            ->where("product_id", $inputs["product_id"])
            ->first();
        $inventory_product->update([
            "Real_quantity" => $inputs["Real_quantity"],
            "status" => 1,
            "updated_at" => Carbon::now()->format("Y-m-d"),
        ]);
    }

    public function invertory_filters_product()
    {
        $stores = AccountingStore::pluck("ar_name", "id")->toArray();
        $inventories = [];

        return view(
            "AccountingSystem.stores.invertory_filter_product",
            compact("stores", "inventories")
        );
    }

    public function inventory_filter_product(Request $request)
    {
        $inputs = $request->all();
        $stores = AccountingStore::pluck("ar_name", "id")->toArray();

        $inventories = AccountingInventory::where(
            "store_id",
            $inputs["store_id"]
        )
            ->wheredate("created_at", $inputs["date"])
            ->get();

        return view(
            "AccountingSystem.stores.invertory_filte_productr",
            compact("stores", "inventories")
        );
    }
    public function invertory_details_product($id)
    {
        $inventory_products = AccountingInventoryProduct::where(
            "inventory_id",
            $id
        )->get();
        $inventory = AccountingInventory::find($id);
        return view(
            "AccountingSystem.stores.invertory_details_product",
            compact("inventory_products", "inventory")
        );
    }
}
