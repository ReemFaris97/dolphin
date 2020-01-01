<?php

Route::get('/',function (){

return redirect()->route('accounting.home');
});


Route::middleware('admin')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('companies', 'CompanyController');
    Route::resource('branches', 'BranchController');
    Route::resource('shifts', 'ShiftController');
    Route::resource('users', 'UserController');
    Route::resource('stores', 'StoreController');
    Route::resource('storeKeepers', 'StoreKeeperController');
    /////////////////المخازن

    Route::get('/products_entry_form', 'StoreController@products_entry_form')->name('stores.products_entry_form');
    Route::post('/products_entry_store', 'StoreController@products_entry_store')->name('stores.products_entry_store');

    Route::get('/products_exchange_form', 'StoreController@products_exchange_form')->name('stores.products_exchange_form');
    Route::post('/products_exchange_store', 'StoreController@products_exchange_store')->name('stores.products_exchange_store');




    Route::get('/store-product/{id}', 'StoreController@store_product')->name('stores.product');
    Route::post('/store-products-copy/{id}', 'StoreController@store_products_copy')->name('store_products_copy.store');
  /////////////////settlementتسوي  الارصده  للبداية/////////////////
    Route::post('/settlement', 'StoreController@settlements_store')->name('stores_settle.filter_settlements');
    Route::get('/settlements', 'StoreController@settlements')->name('stores.settlements');
    Route::get('/product-settlement/{id}', 'ProductController@settlement')->name('products.settlements');
    Route::any('/settlements_store', 'ProductController@settlements_store')->name('products_settlement.store');
///////////////////////////inventory الجرد وتسوية الجرد
    Route::get('/inventory', 'StoreController@inventory')->name('stores.inventory');
    Route::post('/inventory', 'StoreController@inventory_store')->name('stores.filter_inventory');
    Route::post('/inventory_settlement', 'StoreController@inventory_settlement')->name('inventory_settlement.store');
    Route::post('/inventory_filter', 'StoreController@inventory_filter')->name('stores.inventory_filter');
    Route::get('/invertory_filters', 'StoreController@invertory_filters')->name('stores.invertory_filter');
    Route::get('/invertory_details/{id}', 'StoreController@invertory_details')->name('stores.inventory_details');
 //تحويل الاصناف  من  مستودع  الى  اخر/////////////////////////////////////
    Route::get('/transaction', 'StoreController@transaction_form')->name('stores.transaction');
    Route::post('transactions', 'StoreController@transactions')->name('stores.transactions');
    Route::get('/products_store/{id}', 'StoreController@getproducts')->name('products_store');
    Route::post('transaction/{id}', 'StoreController@transaction')->name('products.transaction');
    Route::get('/productsingle', 'StoreController@productsingle');
    Route::get('/requests', 'StoreController@requests')->name('stores.requests');
    Route::get('/request/{id}', 'StoreController@request')->name('stores.request');

    ////////////////////////////طباعة الباركود

    Route::get('/product-barcode/{id}', 'ProductController@barcode')->name('products.barcode');
    Route::get('/sell_point', 'SellPointController@sell_point')->name('sells_points.sells_point');
    Route::get('/notification/{id}', 'OfferController@notification')->name('offers.notification');
    Route::get('/permiums', 'ClientController@permiums')->name('clients.permiums');
    Route::post('/permium_store', 'ClientController@permium_store')->name('clients.permiums_store');

    Route::get('/offer_copy', 'ClientController@offer_copy')->name('clients.offers_copy');
    Route::post('/offers_copy', 'ClientController@copy')->name('clients.copy');

    Route::resource('sales', 'SaleController');
    Route::resource('clients', 'ClientController');
    Route::resource('categories', 'CategoryController');
    Route::resource('industrials', 'IndustrialController');

    Route::resource('faces', 'FaceController');
    Route::resource('columns', 'ColumnController');
    Route::resource('cells', 'CellController');

    Route::resource('clauses', 'ClauseController');
    Route::resource('delegates', 'DelegateController');
    Route::resource('suppliers', 'SupplierController');


    Route::resource('benods', 'BenodController');
    Route::resource('offers', 'OfferController');
    Route::post('/product','OfferController@getAjaxProductQty')->name('getAjaxProductQty');
    Route::get('/order_sale/{id}','SaleController@sale_order')->name('sales.sale_order');

    Route::resource('products', 'ProductController');
    Route::get('/company_branch/{id}', 'ProductController@getBranch')->name('company.branch');

    Route::get('/branches_store/{id}', 'ProductController@getStores');
    Route::get('/columns_face/{id}', 'ProductController@getcolums')->name('columns_face');
    Route::get('/cells_column/{id}', 'ProductController@getcells')->name('cells_column');

    Route::get('/faces_branch/{id}', 'ProductController@getfaces')->name('faces_branch');
    Route::get('/type_benods/{id}', 'BenodController@getbenods')->name('type_benods');

    Route::get('/companes_store/{id}', 'ProductController@getStoresbycompany');

    Route::post('/subunit', 'ProductController@subunit')->name('subunit');

    Route::get('/productsAjex/{id}', 'SellPointController@getProductAjex');



});

