<?php

namespace App\Http\Controllers\AccountingSystem\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingProductTax;
use App\Models\AccountingSystem\AccountingPurchase;
use App\Models\AccountingSystem\AccountingPurchaseItem;

class PurchasesController extends Controller
{
    
    public function index()
   	{
   		$purchases = AccountingPurchase::all()->reverse();
   		return view('AccountingSystem.reports.purchases', compact('purchases'));
   	}
}
