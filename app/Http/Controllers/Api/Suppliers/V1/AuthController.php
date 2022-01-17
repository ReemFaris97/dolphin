<?php

namespace App\Http\Controllers\Api\Suppliers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Suppliers\UserResource;
use App\Models\AccountingSystem\AccountingSupplier;
use App\Models\Supplier\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $inputs = $request->validate([
            'name' => 'required|string',
            'company_name' => 'required|string',
            'commercial_number' => 'required|string',
            'phone' => 'required|phone:sa,eg|unique:suppliers_users',
            'email' => 'required|email:dns|unique:suppliers_users',
            'password' => 'required',
            'commercial_image' => 'required|image',
            'licence_image' => 'required|image',
//            'image' => 'required|image',
//            'address' => 'required|string',
//            'lat' => 'required|numeric|max:90|min:-90',
//            'lng' => 'required|numeric|max:180|min:-90',
            'landline' => 'required|string',
            'fcm_token_android' => 'required_without:fcm_token_ios',
            'fcm_token_ios' => 'required_without:fcm_token_android',
            'companies'=>'required|array',
            'companies.*'=>'required|exists:accounting_companies,id',
        ]);
        $supplier =AccountingSupplier::firstOrCreate(['name'=>$request['company_name']],[
            'company_name' => $request['company_name'],
            'commercial_number'=>$request['commercial_number'],
            'tax_number'=>$request['tax_number'],
            'license_image'=>$request['license_image'],
            'commercial_image'=>$request['commercial_image']
        ]);
        $inputs['supplier_id']=$supplier->id;
        $inputs['permissions']=['*'];
        $user = User::create($inputs);
        $user->companies()->attach($request['companies']);
        $user->token = \JWTAuth::fromUser($user);
        activity()
            ->causedBy($user)
            ->log('تسجيل جديد');

        return \responder::success(new UserResource($user));
    }

    public function login(Request $request)
    {
        $inputs = $request->validate([
            'phone' => 'required|phone:sa,eg',
            'password' => 'required',

            'fcm_token_android' => 'required_without:fcm_token_ios',
            'fcm_token_ios' => 'required_without:fcm_token_android',
        ]);

        if(!\Auth::attempt($request->only(['phone','password']))){
            return \responder::error('خطا في بيانات الدخول !');
        }
        $user=auth()->user();
        $user->update($request->only('fcm_token_android','fcm_token_ios'));
        $user->token=\JWTAuth::fromUser($user);
        activity()
            ->causedBy($user)
            ->log('تسجيل دخول');
        return \responder::success(new UserResource($user));

    }

    public function profile()
    {
        $user = auth()->user();
        $user->token = \JWTAuth::fromUser($user);
        return \responder::success(new UserResource($user));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $inputs = $request->validate([
            'name' => 'sometimes|string',
            'company_name' => 'sometimes|string',
            'commercial_number' => 'sometimes|string',
            'phone' => 'sometimes|phone:sa,eg|unique:suppliers_users,phone,' . $user->id,
            'email' => 'sometimes|email:dns|unique:suppliers_users,email,' . $user->id,
            'password' => 'sometimes',
            'commercial_image' => 'sometimes|image',
            'licence_image' => 'sometimes|image',
            'image' => 'sometimes|image',
            'address' => 'sometimes|string',
            'lat' => 'sometimes|numeric|max:90|min:-90',
            'lng' => 'sometimes|numeric|max:180|min:-90',
            'landline' => 'sometimes|string',
        ]);
        $user->update($inputs);
        $user->token = \JWTAuth::fromUser($user);
        activity()
            ->causedBy($user)
            ->log('تعديل الملف الشخصي');
        return \responder::success(new UserResource($user));
    }

    public function forgetPassword(Request $request)
    {
        $request->validate([
            'phone' => 'required|exists:suppliers_users,phone',
        ]);
        $user = User::where('phone', $request->phone)->first();
        $user->update([
            'reset_code' => 1234,
            'reset_at' => now()->toDateTimeString()
        ]);
        activity()
            ->causedBy($user)
            ->log('طلب استعادة كلمة السر');
        return \responder::success(__('reset code sent successfully !'));
    }

    public function checkCode(Request $request)
    {
        $request->validate([
            'phone' => 'required|exists:suppliers_users,phone',
            'code' => 'required'
        ]);
        $user = User::where('phone', $request->phone)->where('reset_code', $request->code)->exists();

        return \responder::success($user);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'phone' => 'required|exists:suppliers_users,phone',
            'code' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('phone', $request->phone)->where('reset_code', $request->code)->first();
        if (!$user) return \responder::error(__('wrong reset code '));

        $user->update([
            'password' => $request->password,
            'reset_code' => Str::random(15)
        ]);
        $user->token = \JWTAuth::fromUser($user);
        activity()
            ->causedBy($user)
            ->log('استعاد كلمة السر بنجاح');
        return \responder::success(new UserResource($user));
    }
}
