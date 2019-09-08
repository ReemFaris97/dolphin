<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::post('auth/register/{role}','AuthController@register');


Route::group(['middleware' => ['jwt.auth']], function () {

    Route::resource('/products','ProductsController');
    Route::post('/stores/{id}','ProductsController@getAllStores');
    Route::get('stores/categories','ProductsController@getStoresCategories');

    Route::get('/inventory','InventoryController@index');

});
