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
    public function RegisterSetting($requests)
    {
        $data = $requests;
        // dd($data);
        foreach ($data as $key => $value) {
            if ($key == '_token' || !$value) continue;
            {
            if($key=='barcode_scale'||$key=='barcode_logo'||$key=='barcode_reader'){
                AccountingSetting::where(['name' => $key])->update(['height' => $value[0],'display' => $value[1]]);
            }  elseif($key=='barcode_tekit'||$key=='barcode_page'){
                AccountingSetting::where(['name' => $key])->update(['up' => $value[0],'dawn' => $value[1],'right' => $value[2],'left' => $value[3]]);

            }else{
            AccountingSetting::where(['name' => $key])->update(['value' => $value[0]]);
            }
        }

        }
    }

}
