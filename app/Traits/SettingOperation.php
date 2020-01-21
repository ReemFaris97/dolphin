<?php

namespace App\Traits;

use App\Models\AccountingSystem\AccountingSetting;
use App\Setting;
use Illuminate\Http\Request;

trait SettingOperation
{

    /**
     * Update Existing Setting
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function RegisterSetting(Request $request)
    {
        $data = $request->all();
        foreach ($data as $key => $value) {
            if ($key == '_token' || !$value) continue;
            {
            AccountingSetting::where(['name' => $key])->update(['value' => $value[0]]);
            }

        }
    }

}
