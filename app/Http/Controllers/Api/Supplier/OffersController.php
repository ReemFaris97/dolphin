<?php

namespace App\Http\Controllers\Api\Supplier;

use App\Http\Resources\Supplier\OffersResource;
use App\Models\SupplierOffer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponses;
use App\Traits\Supplier\OffersOperations;
use Illuminate\Http\Response;

class OffersController extends Controller
{
    use ApiResponses,OffersOperations;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = SupplierOffer::paginate($this->paginateNumber);
        return $this->apiResponse(new OffersResource($offers));
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
        $request['products'] = json_decode($request->products,TRUE);
        $rules = [
            'products'=>'required|array',
            'products.*.product_id' =>'required|integer|exists:products,id',
            "products.*.quantity" => "required|integer",
            "products.*.price" => "required|integer",
        ];
        $validation = $this->apiValidation($request,$rules);

        if ($validation instanceof Response) {
            return $validation;
        }


        $this->RegisterOffer($request);
        return "success";


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
