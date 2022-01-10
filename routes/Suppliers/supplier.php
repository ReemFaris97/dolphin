<?php
namespace App\Http\Controllers\Api\Suppliers\V1;


use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'],function (){
    Route::post('register',[AuthController::class,'register']);
    Route::post('login',[AuthController::class,'login']);
    Route::get('profile',[AuthController::class,'profile'])->middleware('auth:supplier');
    Route::put('profile',[AuthController::class,'update'])->middleware('auth:supplier');
    Route::post('forget-password',[AuthController::class,'forgetPassword']);
    Route::post('forget-password/check',[AuthController::class,'checkCode']);
    Route::post('forget-password/reset',[AuthController::class,'resetPassword']);
});

Route::group(['middleware' => 'auth:supplier'],function (){

    Route::apiResources([
        'invoices'=> InvoiceController::class,
        'products'=>ProductController::class,
        'banks'=>BankController::class,
        'invoice-items'=>InvoiceItemController::class,
        'users'=>UserController::class
    ]);
    Route::get('list/products', [ProductController::class, 'list']);
    Route::get('my-products', [ProductController::class, 'myProducts']);


});
