<?php

namespace App\Http\Controllers\Api\Distributor;

use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingSetting;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use ApiResponses;
    public function getVersion()
    {
        return $this->apiResponse(
            AccountingSetting::find(83)->value
        );
    }
    public function setVersion($version)
    {
        $verison= AccountingSetting::find(83)->fill(['value' => $version]);
        $verison->save();
        return $this->apiResponse(
            $verison->value,
        );
    }
}
