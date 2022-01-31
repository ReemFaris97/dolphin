<?php

namespace App\Http\Controllers\Api\Suppliers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SpinnersController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        return \responder::success([
            'statistics'=>[
                'purchases'=>"100.00",
                'purchases_returns'=>'100.00',
                'credit'=>'1000.00'
            ],

            'permissions'=> [
                'bounds',
                'reports',
                'invoices',
                'users',
                'banks',
                'products',
                'offers',
                'logs',
                'supply-requisitions',
                '*'
            ]
        ]);
    }
}
