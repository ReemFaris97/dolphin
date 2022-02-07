<?php

namespace App\Traits\Supplier;

use App\Models\SupplierBill;
use App\Models\SupplierBillProduct;
use Carbon\Carbon;

trait BillsOperations
{
    public function CreateSupplierBill($request)
    {
        $inputs = $request->except(
            "date",
            "transfer_date",
            "transfer_number",
            "bank_name",
            "check_number",
            "check_date",
            "products",
            "qtys",
            "prices"
        );
        $inputs["user_id"] = auth()->id();
        $inputs["date"] = Carbon::parse($request->date);

        if ($request->payment_method == "bank_transfer") {
            $inputs["transfer_date"] = Carbon::parse($request->transfer_date);
            $inputs["transfer_number"] = $request->transfer_number;
        }
        if ($request->payment_method == "check") {
            $inputs["bank_name"] = $request->bank_name;
            $inputs["check_number"] = $request->check_number;
            $inputs["check_date"] = Carbon::parse($request->check_date);
        }
        $bill = SupplierBill::create($inputs);

        $data = $request->only("products", "qtys", "prices");

        $products = collect($data["products"]);
        $qtys = collect($data["qtys"]);
        $prices = collect($data["prices"]);
        $merges = $products->zip($qtys, $prices);

        foreach ($merges as $merge) {
            $billProduct = SupplierBillProduct::create([
                "product_id" => $merge["0"],
                "quantity" => $merge["1"],
                "price" => $merge["2"],
                "supplier_bill_id" => $bill->id,
            ]);
        }
    }

    public function UpdateSupplierBill($request, $bill)
    {
        $inputs = $request->except(
            "date",
            "transfer_date",
            "transfer_number",
            "bank_name",
            "check_number",
            "check_date",
            "products",
            "qtys",
            "prices"
        );
        $inputs["user_id"] = auth()->id();
        $inputs["date"] = Carbon::parse($request->date);

        if ($request->payment_method == "bank_transfer") {
            $inputs["transfer_date"] = Carbon::parse($request->transfer_date);
            $inputs["transfer_number"] = $request->transfer_number;

            $inputs["bank_name"] = null;
            $inputs["check_number"] = null;
            $inputs["check_date"] = null;
        }
        if ($request->payment_method == "check") {
            $inputs["transfer_date"] = null;
            $inputs["transfer_number"] = null;

            $inputs["bank_name"] = $request->bank_name;
            $inputs["check_number"] = $request->check_number;
            $inputs["check_date"] = Carbon::parse($request->check_date);
        }

        $bill->update($inputs);

        $data = $request->only("products", "qtys", "prices");

        $products = collect($data["products"]);
        $qtys = collect($data["qtys"]);
        $prices = collect($data["prices"]);
        $merges = $products->zip($qtys, $prices);

        $bill->products()->delete();
        foreach ($merges as $merge) {
            $billProduct = SupplierBillProduct::create([
                "product_id" => $merge["0"],
                "quantity" => $merge["1"],
                "price" => $merge["2"],
                "supplier_bill_id" => $bill->id,
            ]);
        }
    }
}
