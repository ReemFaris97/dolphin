<?php

namespace App\Http\Controllers\Api\Supplier;

use App\Http\Resources\Supplier\BillsResource;
use App\Http\Resources\Supplier\SingleBillResource;
use App\Models\SupplierBill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponses;

class BillsController extends Controller
{
    use ApiResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills = SupplierBill::where("supplier_id", auth()->id())
            ->orderByDesc("created_at")
            ->paginate($this->paginateNumber);
        return $this->apiResponse(new BillsResource($bills));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bill = SupplierBill::find($id);
        if (!$bill) {
            return $this->apiResponse(
                null,
                "الفاتورة غير متوفرة حالياً",
                false
            );
        }
        return $this->apiResponse(new SingleBillResource($bill));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
