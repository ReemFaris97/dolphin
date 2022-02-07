<?php

namespace App\Http\Controllers\Api\Supplier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponses;
class ReportsController extends Controller
{
    use ApiResponses;
    public function index()
    {
        $data = [
            "count_of_staff" => auth()
                ->user()
                ->supplier_staff->count(),
            "count_of_bills" => auth()
                ->user()
                ->supplierBills->count(),
            "total_of_paid_money" => auth()
                ->user()
                ->supplierTotalPaidMoney(),
            "total_of_receivables" => auth()
                ->user()
                ->TotalOfSupplierReceivables(),
        ];

        return $this->apiResponse($data);
    }
}
