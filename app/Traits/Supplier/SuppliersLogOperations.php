<?php

namespace App\Traits\Supplier;

use App\Models\SupplierLog;

trait SuppliersLogOperations
{
    public function RegisterLog($log)
    {
        $inputs["user_id"] = auth()->id();
        $inputs["log"] = $log;
        SupplierLog::create($inputs);
    }
}
