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
    Route::get('/products/list/{id}','ProductsController@productsList');
    Route::get('stores/categories','ProductsController@getStoresCategories');
    Route::get('stores/{id}','ProductsController@getAllStores');

    Route::get('/inventory','InventoryController@index');

    Route::resource('/offers','OffersController');

    Route::get('spinner/banks','BanksController@getBanksSpinner');


});
