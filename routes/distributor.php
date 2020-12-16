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

    Route::get('stores/products/move/{store_id?}', 'StoresController@moveProductForm')->name('stores.moveProduct');
    Route::post('stores/products/move/{store_id?}', 'StoresController@moveProduct');

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
    Route::get('/storeTransfer/{id}', 'StoreTransferController@show')->name('storeTransfer.show');
    Route::post('/storeTransfer/store', 'StoreTransferController@store')->name('storeTransfer.store');
    Route::delete('storeTransfer/delete/{id}', 'StoreTransferController@delete')->name('storeTransfer.destroy');

    Route::resource('/dailyReports', 'DailyReportsController');


    Route::resource('/refuses', 'ReasonRefuseDistributorController');
    Route::resource('/readers', 'ReaderController');
    Route::patch('readers/change-status/{reader}', 'ReaderController@changeStatus')->name('readers.changeStatus');
    Route::resource('/client-classes', 'ClientClassController');
    Route::patch('client-classes/change-status/{client_class}', 'ClientClassController@changeStatus')->name('client-classes.changeStatus');



    Route::resource('/expenditureClauses', 'ExpenditureClausesController');

    Route::resource('/expenditureTypes', 'ExpenditureTypesController');
    Route::patch('expenditureTypes/change-status/{item}', 'ExpenditureTypesController@changeStatus')->name('expenditureTypes.changeStatus');

    Route::resource('/expenses', 'ExpensesController');
    Route::resource('/routes', 'DistributorRoutesController');
    Route::get('active_route/{id}', 'DistributorRoutesController@active')->name('routes.active');
    Route::get('disactive_route/{id}', 'DistributorRoutesController@disactive')->name('routes.dis_active');

    Route::post('/trips/update-arrange', 'TripsController@updateArrange')->name('trips.update-arrange');
    Route::post('/routes/update-arrange', 'DistributorRoutesController@updateArrange')->name('routes.update-arrange');
    Route::resource('/trips', 'TripsController');
    Route::resource('/bills', 'BillController');
    Route::get('/map', 'TripsController@trips')->name('trips.map');
    Route::post('/get/ajax/stores', 'AjaxDataController@getAllStoresById')->name('getAjaxStores');

    Route::get('/get/ajax/routes', 'AjaxDataController@getDistributorRoutes')->name('getAjaxRoutes');
    Route::get('/get/ajax/trips', 'AjaxDataController@getDistributorTripsOnRoute')->name('getAjaxTrips');
    Route::post('/get/ajax/products', 'AjaxDataController@getAllProducts')->name('getAjaxProducts');
    Route::get('/getAjaxStores/{id}', 'AjaxDataController@getAllStores')->name('getAjaxStores');
    Route::get('/getAjaxClauses/{id}', 'AjaxDataController@getAjaxClauses')->name('getAjaxClauses');

    Route::get('/get/ajax/store/products', 'AjaxDataController@getStoreProducts')->name('getAjaxstoreProducts');
    Route::post('/get/ajax/cars', 'AjaxDataController@getcars')->name('getAjaxCars');

    Route::post('/get/ajax/sender', 'AjaxDataController@getsender')->name('getAjaxSender');
    Route::get('/get/ajax/distributor/stores', 'AjaxDataController@getDistributorStores')->name('getDistributorStores');


    Route::get('/active_client/{id}', 'ClientsController@active')->name('client.active');
    Route::get('/disactive_client/{id}', 'ClientsController@disactive')->name('client.dis_active');
    Route::get('/activation', 'ClientsController@activation')->name('clients.activation');
    Route::get('/active_expenditureClause/{id}', 'ExpenditureClausesController@active')->name('expenditureClauses.active');
    Route::get('/disactive_expenditureClause/{id}', 'ExpenditureClausesController@disactive')->name('expenditureClauses.dis_active');

    Route::group(['namespace' => 'Reports', 'prefix' => 'reports', 'as' => 'reports.'], function () {
        Route::any('client_report', [ 'uses' => 'ClientController@index'])->name('clients.index');
        Route::get('bill/{id}', [ 'uses' => 'ClientController@show'])->name('clients.show');
        Route::any('sale_report', [ 'uses' => 'SaleController@index'])->name('sales.index');
        Route::get('store_movement_report', 'StoreMovementController@index')->name('store_movement.index');
        Route::get('store_movement_report/report', 'StoreMovementController@show')->name('store_movement.report');

        Route::get('distributors', 'DistributorController@index')->name('distributor.index');
        Route::get('distributors/report', 'DistributorController@show')->name('distributor.report');
        Route::get('expenses', 'ExpenseController@index')->name('expenses.index');
        Route::get('expenses/{id}', 'ExpenseController@show')->name('expenses.show');
        Route::get('routes', 'RouteController@index')->name('routes.index');
        Route::get('routes/{id}', 'RouteController@show')->name('routes.show');

        Route::get('selling-movement', 'SellingMovementController@index')->name('selling_movement.index');
        Route::get('selling-movement/report', 'SellingMovementController@show')->name('selling_movement.show');


    });
});
