<?php

namespace App\Http\Controllers\Api\Supplier;

use App\Http\Resources\Supplier\OffersResource;
use App\Http\Resources\Supplier\SingleOfferResource;
use App\Models\SupplierOffer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponses;
use App\Traits\Supplier\OffersOperations;
use Illuminate\Http\Response;
use App\Traits\Supplier\SuppliersLogOperations;

class OffersController extends Controller
{
    use ApiResponses,OffersOperations ,SuppliersLogOperations;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = SupplierOffer::where('user_id',auth()->id())->orderBy('id','desc')->paginate($this->paginateNumber);

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

        $offer =  $this->RegisterOffer($request);
        $this->RegisterLog("إضافة عرض");
        return $this->apiResponse(new SingleOfferResource($offer));


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $offer = SupplierOffer::find($id);
        if(!$offer) return $this->apiResponse(null,"العرض غير متوفر");

        return $this->apiResponse(new SingleOfferResource($offer));
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
        $offer = SupplierOffer::find($id);
        if(!$offer) return $this->apiResponse(null,'العرض غير موجود');

        $request['products'] = json_decode($request->products,TRUE);
        $rules = [
            'products'=>'required|array',
            'products.*.product_id' =>'required|integer|exists:products,id',
            "products.*.quantity" => "required|integer",
            "products.*.price" => "required|integer",
        ];
        $validation = $this->apiValidation($request,$rules);

        $offer =  $this->UpdateOffer($request,$offer);
        $this->RegisterLog('تعديل عرض');
        return $this->apiResponse(new SingleOfferResource($offer));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $offer = SupplierOffer::find($id);
        if($offer){
            $offer->delete();
            $this->RegisterLog("حذف عرض");
            return $this->apiResponse('تم حذف العرض بنجاح');

        }
        else{
            return $this->apiResponse(null,"العرض غير موجود",404);
        }
    }
}
