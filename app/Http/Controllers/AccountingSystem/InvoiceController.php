<?php

namespace App\Http\Controllers\AccountingSystem;

use App\DataTables\AccountingSaleCurrentDataTable;
use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingSale;

class InvoiceController extends Controller
{
    public function index(AccountingSaleCurrentDataTable $dataTable)
    {
        return $dataTable->render('AccountingSystem.sales.index');
    }
}
