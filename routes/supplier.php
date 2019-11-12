<?php

Route::get('/',function (){

return redirect()->route('supplier.home');
});

Route::middleware('supplier')->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/suppliers', 'SupplierController');
    Route::post('suppliers/verify/{id}','SupplierController@verify')->name('suppliers.verify');
    Route::patch('suppliers/block/{user}', 'SupplierController@block')->name('suppliers.block');


    Route::resource('/employes', 'EmployeeController');
    Route::patch('employes/block/{user}', 'EmployeeController@block')->name('employes.block');


    Route::resource('/offers', 'OfferProductController');
    Route::patch('offer/{id}', 'OfferProductController@remove')->name('offers.remove');
    Route::post('/product','OfferProductController@getAjaxProductQty')->name('getAjaxProductQty');

    Route::resource('/banks', 'BankController');


    /*suppliers discards routes*/
    Route::resource('/suppliers-discards','DiscardsController');
    Route::post('/suppliers/discards/get-products','DiscardsController@getAjaxSupplierProducts')->name('getAjaxSupplierProducts');
    /*end suppliers discards routes*/


    /*suppliers bills routes*/
    Route::resource('/suppliers-bills','SuppliersBillsController');
    /*end suppliers bills routes*/

});

