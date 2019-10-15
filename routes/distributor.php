<?php

Route::get('/',function (){
return redirect()->route('distributor.home');
});

Route::middleware('distributor')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('/distributors', 'DistributorsController');
    Route::patch('distributors/block/{user}', 'DistributorsController@block')->name('distributors.block');

    Route::resource('/store_categories', 'StoreCategoriesController');
    Route::resource('/stores', 'StoresController');
    Route::resource('/products', 'ProductsController');
    Route::get('/products/add/quantity/{id}','ProductsController@addQuantityForm')->name('products.quantity.form');
    Route::post('/products/store/quantity/{id}','ProductsController@storeProductQuantity')->name('products.quantity.store');
    Route::resource('/transactions','DistributorTransactionsController');
    Route::resource('/clients','ClientsController');
    Route::patch('clients/block/{user}', 'ClientsController@block')->name('clients.block');

    Route::resource('/cars','CarsController');


    Route::get('/storeTransfer','StoreTransferController@index')->name('storeTransfer.index');
    Route::get('/storeTransfer/create','StoreTransferController@create')->name('storeTransfer.create');
    Route::post('/storeTransfer/store','StoreTransferController@store')->name('storeTransfer.store');
    Route::delete('storeTransfer/delete/{id}','StoreTransferController@delete')->name('storeTransfer.destroy');

    Route::resource('/dailyReports','DailyReportsController');




    Route::resource('/readers', 'ReaderController');
    Route::resource('/expenditureClauses', 'ExpenditureClausesController');
    Route::resource('/expenditureTypes', 'ExpenditureTypesController');
    Route::resource('/expenses', 'ExpensesController');
    Route::resource('/routes', 'DistributorRoutesController');
    Route::resource('/trips', 'TripsController');
    Route::get('/map', 'TripsController@trips')->name('trips.map');
    Route::post('/get/ajax/stores', 'AjaxDataController@getAllStoresById')->name('getAjaxStores');
    Route::post('/get/ajax/products', 'AjaxDataController@getAllProducts')->name('getAjaxProducts');

    Route::post('/get/ajax/sender', 'AjaxDataController@getsender')->name('getAjaxSender');


    Route::get('/active_client/{id}', 'ClientsController@active')->name('client.active');
    Route::get('/disactive_client/{id}', 'ClientsController@disactive')->name('client.dis_active');
    Route::get('/activation', 'ClientsController@activation')->name('clients.activation');

});
