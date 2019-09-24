<?php

namespace App\Http\Controllers\Api\Supplier;

use App\Http\Resources\Supplier\DiscardsResources;
use App\Http\Resources\Supplier\SingleDiscardResource;
use App\Models\SupplierDiscard;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponses;
class DiscardsController extends Controller
{
    use ApiResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discards = SupplierDiscard::where('supplier_id',auth()->id())->paginate($this->paginateNumber);
        return $this->apiResponse(new DiscardsResources($discards));
    }

    public function filteredDiscards(Request $request){

        $discards = SupplierDiscard::where('supplier_id',auth()->id())->whereBetween('date',[Carbon::parse($request->from),Carbon::parse($request->to)])
            ->paginate($this->paginateNumber);
        return $this->apiResponse(new DiscardsResources($discards));
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
        $discard = SupplierDiscard::find($id);
        if(!$discard) return $this->apiResponse(null,'بيانات هذا المرتجع غير متوافرة او غير موجود',false);
        return $this->apiResponse(new SingleDiscardResource($discard));
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
