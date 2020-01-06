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
    /////////////////سندات  ادخال المنتجات فى المخازن

    Route::get('/company_stores/{id}', 'StoreController@company_stores');
    Route::get('/branch_stores/{id}', 'StoreController@branch_stores');

    Route::get('/products_entry_form', 'StoreController@products_entry_form')->name('stores.products_entry_form');
    Route::post('/bond_store', 'StoreController@bond_store')->name('stores.bond_store');
    Route::get('/keepers_store/{id}', 'StoreController@getkeepers')->name('keepers_store');



    Route::get('/products_exchange_form', 'StoreController@products_exchange_form')->name('stores.products_exchange_form');
    Route::post('/products_exchange_store', 'StoreController@products_exchange_store')->name('stores.products_exchange_store');




    Route::get('/store-product/{id}', 'StoreController@store_product')->name('stores.product');
    Route::post('/store-products-copy/{id}', 'StoreController@store_products_copy')->name('store_products_copy.store');
  /////////////////settlementتسوي  الارصده  للبداية/////////////////
    Route::post('/settlement', 'StoreController@settlements_store')->name('stores_settle.filter_settlements');
    Route::get('/settlements', 'StoreController@settlements')->name('stores.settlements');
    Route::get('/product-settlement/{id}', 'ProductController@settlement')->name('products.settlements');
    Route::any('/settlements_store', 'ProductController@settlements_store')->name('products_settlement.store');
///////////////////////////inventory  للمخازن  الجرد وتسوية الجرد
    Route::get('/inventory', 'StoreInventroyController@inventory')->name('stores.inventory');
    Route::post('/inventory', 'StoreInventroyController@inventory_store')->name('stores.filter_inventory');
    Route::post('/inventory_settlement', 'StoreInventroyController@inventory_settlement')->name('inventory_settlement.store');
    Route::post('/inventory_filter', 'StoreInventroyController@inventory_filter')->name('stores.inventory_filter');
    Route::get('/invertory_filters', 'StoreInventroyController@invertory_filters')->name('stores.invertory_filter');
    Route::get('/invertory_details/{id}', 'StoreInventroyController@invertory_details')->name('stores.inventory_details');
    Route::get('/inventory_result/{id}', 'StoreInventroyController@inventory_result')->name('stores.inventory_result');
    Route::post('/balances-filter', 'StoreController@balances_filter')->name('stores.balances_filter');

///////////////////////////inventory  للاصناف  الجرد وتسوية الجرد
    Route::get('/inventory-product', 'StoreInventroyController@inventory_product')->name('stores.inventory_product');
    Route::post('/inventory-product', 'StoreInventroyController@inventory_store_product')->name('stores.filter_inventory_product');
    Route::post('/inventory-settlement-product', 'StoreInventroyController@inventory_settlement_product')->name('inventory_settlement.store_product');
    Route::post('/inventory-filter-product', 'StoreInventroyController@inventory_filter_product')->name('stores.inventory_filter_product');
    Route::get('/invertory-filters-product', 'StoreInventroyController@invertory_filters_product')->name('stores.invertory_filter_product');
    Route::get('/invertory-details-product/{id}', 'StoreInventroyController@invertory_details_product')->name('stores.inventory_details_product');

 //تحويل الاصناف  من  مستودع  الى  اخر/////////////////////////////////////
    Route::get('/transaction', 'StoreTransactionController@transaction_form')->name('stores.transaction');
    Route::post('transactions', 'StoreTransactionController@transactions')->name('stores.transactions');
    Route::get('/products_store/{id}', 'StoreController@getproducts')->name('products_store');
    Route::post('transaction/{id}', 'StoreTransactionController@transaction')->name('products.transaction');
    Route::get('/productsingle', 'StoreTransactionController@productsingle');
    Route::get('/requests', 'StoreTransactionController@requests')->name('stores.requests');
    Route::get('/request/{id}', 'StoreTransactionController@request')->name('stores.request');
    Route::get('/accept_request/{id}', 'StoreTransactionController@accept_request')->name('stores.accept_request');
    Route::post('/refused_request/{id}', 'StoreTransactionController@refused_request')->name('stores.refused_request');
   ///////////////تقاير المخازن
    Route::get('/balances-report', 'StoreController@first_balances')->name('stores.first_balances_report');




    ////////////////////////////طباعة الباركود
    ///
    ///

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
    Route::resource('safes', 'SafeController');

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

