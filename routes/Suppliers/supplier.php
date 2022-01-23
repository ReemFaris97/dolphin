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
Route::get('purchase-invoices/{purchase}',[PurchaseController::class,'show'])->name('purchase.show');
Route::get('purchase-return-invoices/{purchase-return}',[PurchaseReturnController::class,'show'])->name('purchase-return.show');

Route::group(['middleware' => 'auth:supplier'],function (){

    Route::apiResources([
        'invoices'=> InvoiceController::class,
        'products'=>ProductController::class,
        'banks'=>BankController::class,
        'invoice-items'=>InvoiceItemController::class,
        'users'=>UserController::class,
        'chats'=>ChatController::class
    ]);
    Route::get('list/products', [ProductController::class, 'list']);
    Route::get('my-products', [ProductController::class, 'myProducts']);

    Route::get('purchase-invoices',[PurchaseController::class,'index']);
    Route::get('purchase-return-invoices',[PurchaseReturnController::class,'index']);
    Route::get('home',HomeController::class );
    Route::get('notifications',NotificationController::class );
    Route::get('spinners',SpinnersController::class );
    Route::get('logs',LogController::class);
});
