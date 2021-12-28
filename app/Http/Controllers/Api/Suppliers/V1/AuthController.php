<?php

namespace App\Http\Controllers\Api\Suppliers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Suppliers\UserResource;
use App\Models\AccountingSystem\AccountingSupplier;
use App\Models\Supplier\User;
use Illuminate\Http\Request;

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
            'image' => 'required|image',
            'address' => 'required|string',
            'lat' => 'required|numeric|max:90|min:-90',
            'lng' => 'required|numeric|max:180|min:-90',
            'landline' => 'required|string',
            'fcm_token_android' => 'required_without:fcm_token_ios',
            'fcm_token_ios' => 'required_without:fcm_token_android',
            'companies'=>'required|array',
            'companies.*'=>'required|exists:accounting_companies,id'
        ]);
        $supplier =AccountingSupplier::firstOrCreate(['name'=>$request['company_name']]);
        $inputs['supplier_id']=$supplier->id;
        $user = User::create($inputs);
        $user->companies()->attach($request['companies']);
        $user->token = \JWTAuth::fromUser($user);
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
        return  \responder::success(new UserResource($user));

    }
}
