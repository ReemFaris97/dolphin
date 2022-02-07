<?php

namespace App\Http\Controllers\Api\Suppliers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseCollection;
use App\Http\Resources\SupplyRequisitionResource;
use App\Models\SupplyRequisition;
use Illuminate\Http\Request;

class SupplyRequisitionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $user=auth()->user();
        $supplyRequisitions=SupplyRequisition::where('accounting_supplier_id',$user->supplier_id)->where('accounting_company_id',\request()->header('x-company-id'))->latest()->paginate(15);
        return \responder::success(new BaseCollection($supplyRequisitions,SupplyRequisitionResource::class));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SupplyRequisition $supplyRequisition)
    {
        $supplyRequisition->update(['approver_id'=>auth()->id(),'approved_at'=>now()]);
        return  \responder::success(new SupplyRequisitionResource($supplyRequisition));
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
