<?php

namespace App\Http\Controllers\Api\Supplier;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Traits\ApiResponses;

class ProfileController extends Controller
{
    use ApiResponses;

    public function reset_password(Request $request){

        $rules = [
            'old_password'      =>'required|string',
            'password'   =>'required|string|max:191',
        ];
        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response)return $validation;
        $user = User::find(auth()->id());

        if(!\Hash::check($request->old_password,$user->password)){
            return $this->apiResponse("","كلمة المرور القديمة غير صحيحة",false);
        }
        else{
            $user->password  = \Hash::make($request->password);
            $user->save();
            return $this->apiResponse("","تم تغيير كلمة المرور بنجاح");
        }


    }
}
