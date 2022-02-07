<?php

namespace App\Http\Controllers\Api\Suppliers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Suppliers\InvoiceResource;
use App\Models\Supplier\InvoiceItem;
use Illuminate\Http\Request;

class InvoiceItemController extends Controller
{
    public function update(Request $request, InvoiceItem $invoiceItem)
    {
        $inputs = $request->validate([
            "price" => "sometimes|numeric",
            "unit" => "sometimes|string",
            "expired_at" => "sometimes|date",
            "quantity" => "sometimes|numeric",
            "accounting_product_id" =>
                "sometimes|exists:accounting_products,id",
        ]);
        $invoiceItem->update($inputs);

        return \responder::success(new InvoiceResource($invoiceItem->invoice));
    }

    public function destroy(Request $request, InvoiceItem $invoiceItem)
    {
        $invoice = $invoiceItem->invoice;
        if ($invoice->items()->count() == 1) {
            return \responder::error("عفوا لا يمكن حذف اخر عنصر في الفاتورة");
        }
        $invoiceItem->delete();
        //        if ($invoice)
        return \responder::success(new InvoiceResource($invoice));
    }
}
