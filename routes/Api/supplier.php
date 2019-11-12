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
Route::get('spinner/banks','BanksController@getBanksSpinner');

Route::group(['middleware' => ['jwt.auth']], function () {
        Route::post('update/password','ProfileController@reset_password');
        Route::resource('/products','ProductsController');
        Route::get('/products/spinner/list','ProductsController@productsList');
        Route::post('/products/search/name','ProductsController@search');

        Route::get('stores/categories','ProductsController@getStoresCategories');
        Route::get('stores/{id}','ProductsController@getAllStores');

        Route::get('/inventory','InventoryController@index');

        Route::resource('/offers','OffersController');
        Route::resource('/bills','BillsController');
        Route::resource('/discards','DiscardsController');
        Route::get('/filter/discards','DiscardsController@filteredDiscards');

        route::get('/reports/index','ReportsController@index');



    /* Employees .... */
        Route::get('/employees','EmployeesController@index');            // all emp
        Route::get('/employees/log/{id}','EmployeesController@getLog');   // emp log
        Route::post('/employees','EmployeesController@store');           // store emp
        Route::post('/employees/{id}','EmployeesController@update');      // update emp




});
