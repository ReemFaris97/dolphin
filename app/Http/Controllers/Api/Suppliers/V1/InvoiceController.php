<?php

namespace App\Http\Controllers\Api\Suppliers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseCollection;
use App\Http\Resources\Suppliers\InvoiceResource;
use App\Models\Supplier\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return  \responder::success(new BaseCollection(auth()->user()->supplier->invoices()->withSum('items','total')->latest()->paginate(10), InvoiceResource::class));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->validate([
            'items' => 'required|array',
            'items.*.accounting_product_id' => 'required|exists:accounting_products,id',
            'items.*.quantity' => 'required|int|gte:1',
            'items.*.unit' => 'required|string',
            'items.*.expire_at' => 'nullable|sometimes|date|after:today',
            'items.*.price'=>'required|numeric|gte:1'
        ]);
        $user = auth()->user();
        $supplier=$user->supplier;
        $invoice=$supplier->invoices()->Create();
        $invoice->items()->createMany($inputs['items']);
        $invoice->items_sum_total=$invoice->items()->sum('total');
        return  \responder::success(new InvoiceResource($invoice));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
        $inputs = $request->validate([
            'items' => 'required|array',
            'items.*.accounting_product_id' => 'required|exists:accounting_products,id',
            'items.*.quantity' => 'required|int|gte:1',
            'items.*.unit' => 'required|string',
            'items.*.expire_at' => 'nullable|sometimes|date|after:today',
            'items.*.price' => 'required|numeric|gte:1'
        ]);
        $invoice->items()->createMany($inputs['items']);
        return \responder::success(new InvoiceResource($invoice));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return \responder::success('تم الحذف بنجاح !');
    }
}
