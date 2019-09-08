<?php

namespace App\Http\Controllers\Api\Supplier;

use App\Http\Resources\Supplier\InventoryResource;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponses;

class InventoryController extends Controller
{

    use ApiResponses;

    public function index(){
        $products = Product::paginate($this->paginateNumber);
        return $this->apiResponse(new InventoryResource($products));
    }
}
