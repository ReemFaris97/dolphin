<?php

Route::get('/', function () {
    return redirect()->route('distributor.home');
});

Route::middleware('distributor')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('/distributors', 'DistributorsController');
    Route::patch('distributors/block/{user}', 'DistributorsController@block')->name('distributors.block');

    Route::resource('/store_categories', 'StoreCategoriesController');
    Route::patch('store_categories/block/{store_categories}', 'StoreCategoriesController@block')->name('store_categories.block');
    Route::get('stores/product/add/{store_id?}', 'StoresController@addProductForm')->name('stores.addProduct');
    Route::post('stores/product/add/{store_id?}', 'StoresController@addProduct');

    Route::get('stores/products/move', 'StoresController@moveProductForm')->name('stores.moveProduct');
    Route::post('stores/products/move', 'StoresController@moveProduct');

    Route::get('stores/products/damage/{store_id?}', 'StoresController@damageProductForm')->name('stores.damageProduct');
    Route::post('stores/products/damage/{store_id?}', 'StoresController@damageProduct');

    Route::resource('/stores', 'StoresController');
    Route::patch('stores/change-status/{store}', 'StoresController@changeStatus')->name('stores.changeStatus');

    Route::resource('/products', 'ProductsController');
    Route::get('/products/add/quantity/{id}', 'ProductsController@addQuantityForm')->name('products.quantity.form');
    Route::post('/products/store/quantity/{id}', 'ProductsController@storeProductQuantity')->name('products.quantity.store');
    Route::resource('/transactions', 'DistributorTransactionsController');
    Route::resource('/clients', 'ClientsController');
    Route::patch('clients/block/{user}', 'ClientsController@block')->name('clients.block');

    Route::resource('/cars', 'CarsController');
    Route::patch('cars/change-status/{car}', 'CarsController@changeStatus')->name('cars.changeStatus');


    Route::get('/storeTransfer', 'StoreTransferController@index')->name('storeTransfer.index');
    Route::get('/storeTransfer/create', 'StoreTransferController@create')->name('storeTransfer.create');
    Route::post('/storeTransfer/store', 'StoreTransferController@store')->name('storeTransfer.store');
    Route::delete('storeTransfer/delete/{id}', 'StoreTransferController@delete')->name('storeTransfer.destroy');

    Route::resource('/dailyReports', 'DailyReportsController');


    Route::resource('/readers', 'ReaderController');
    Route::patch('readers/change-status/{reader}', 'ReaderController@changeStatus')->name('readers.changeStatus');


    Route::resource('/expenditureClauses', 'ExpenditureClausesController');

    Route::resource('/expenditureTypes', 'ExpenditureTypesController');
    Route::patch('expenditureTypes/change-status/{item}', 'ExpenditureTypesController@changeStatus')->name('expenditureTypes.changeStatus');

    Route::resource('/expenses', 'ExpensesController');
    Route::resource('/routes', 'DistributorRoutesController');
    Route::post('/trips/update-arrange', 'TripsController@updateArrange')->name('trips.update-arrange');
    Route::resource('/trips', 'TripsController');
    Route::resource('/bills', 'BillController');
    Route::get('/map', 'TripsController@trips')->name('trips.map');
    Route::post('/get/ajax/stores', 'AjaxDataController@getAllStoresById')->name('getAjaxStores');
    Route::post('/get/ajax/products', 'AjaxDataController@getAllProducts')->name('getAjaxProducts');
    Route::get('/get/ajax/store/products', 'AjaxDataController@getStoreProducts')->name('getAjaxstoreProducts');

    Route::post('/get/ajax/sender', 'AjaxDataController@getsender')->name('getAjaxSender');
    Route::get('/get/ajax/distributor/stores', 'AjaxDataController@getDistributorStores')->name('getDistributorStores');


    Route::get('/active_client/{id}', 'ClientsController@active')->name('client.active');
    Route::get('/disactive_client/{id}', 'ClientsController@disactive')->name('client.dis_active');
    Route::get('/activation', 'ClientsController@activation')->name('clients.activation');

});
