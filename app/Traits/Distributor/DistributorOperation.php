<?php

namespace App\Traits\Distributor;

use App\Models\DistributorTransaction;

trait DistributorOperation
{
    /**
     * Register New Clause
     *
     * @param $request
     * @return mixed
     */
    public function AddTransaction($request)
    {
        $inputs = $request->all();
        return DistributorTransaction::create($inputs);
    }
}
