<?php
namespace App\Http\Controllers\Api\Suppliers\V1;


use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'],function (){
    Route::post('register',[AuthController::class,'register']);
    Route::post('login',[AuthController::class,'login']);
});

Route::group(['middleware' => 'auth:supplier'],function (){
   Route::apiResource('products',ProductController::class);
   Route::get('list/products', [ProductController::class, 'list']);
    Route::apiResource('invoices', InvoiceController::class);
});
