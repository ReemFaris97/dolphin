<?php

namespace App\Http\Controllers\AccountingSystem\Reports;

use App\Models\AccountingSystem\AccountingDamageProduct;
use App\Models\AccountingSystem\AccountingInventoryProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
;

class StoresController extends Controller
{
    
    public function damages()
   	{
   		$damages = AccountingDamageProduct::all()->reverse();
   		return view('AccountingSystem.reports.stores.damagedProducts', compact('damages'));
   	}

    public function inventory()
    {
        $inventories = AccountingInventoryProduct::all()->reverse();
        return view('AccountingSystem.reports.stores.inventoryProducts', compact('inventories'));
    }
}
