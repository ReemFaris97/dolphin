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
    Route::get('/store-active/{id}', 'StoreController@active')->name('stores.is_active');
    Route::get('/store-dis_active/{id}', 'StoreController@dis_active')->name('stores.dis_active');
    Route::get('/store-active-product/{id}', 'StoreController@active_product')->name('stores.is_active_product');
    Route::get('/store-dis_active-product/{id}', 'StoreController@dis_active_product')->name('stores.dis_active_product');


        Route::get('/product-details/{id}', 'StoreController@show_product_details')->name('stores.show_product_details');

    Route::post('/destroy_product/{id}', 'StoreController@destroy_product')->name('stores.destroy_product');

    Route::get('/products_entry_form', 'StoreController@products_entry_form')->name('stores.products_entry_form');
    Route::post('/bond_store', 'StoreController@bond_store')->name('stores.bond_store');
    Route::get('/keepers_store/{id}', 'StoreController@getkeepers')->name('keepers_store');

    Route::get('/bonds', 'StoreController@bonds_index')->name('stores.bonds_index');
    Route::get('/bond-show/{id}', 'StoreController@bond_show')->name('stores.show_bond');

    Route::get('/products_exchange_form', 'StoreController@products_exchange_form')->name('stores.products_exchange_form');
    Route::post('/products_exchange_store', 'StoreController@products_exchange_store')->name('stores.products_exchange_store');
    Route::get('/store-product/{id}', 'StoreController@store_product')->name('stores.product');
    Route::post('/store-products-copy/{id}', 'StoreController@store_products_copy')->name('store_products_copy.store');
  /////////////////settlementتسوي  الارصده  للبداية/////////////////
    Route::post('/settlement', 'StoreController@settlements_store')->name('stores_settle.filter_settlements');
    Route::get('/settlements', 'StoreController@settlements')->name('stores.settlements');
    Route::get('/settlements-index', 'StoreController@settlements_index')->name('stores.settlements_index');

    Route::get('/product-settlement/{id}', 'products_storeProductController@settlement')->name('products.settlements');
    Route::any('/settlements_store', 'ProductController@settlements_store')->name('products_settlement.store');
///////////////////////////inventory  للمخازن  الجرد وتسوية الجرد
    Route::get('/inventory', 'StoreInventroyController@inventory')->name('stores.inventory');
    Route::post('/inventory', 'StoreInventroyController@inventory_store')->name('stores.filter_inventory');
    Route::post('/inventory-bond', 'StoreInventroyController@inventory_bond')->name('inventory_bond.store');

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
    Route::get('/inventories', 'StoreInventroyController@inventories')->name('stores.inventories');
    Route::get('/show-inventory/{id}', 'StoreInventroyController@show_inventory')->name('stores.show_inventory');
    Route::get('/inventories_band', 'StoreInventroyController@inventories_band')->name('stores.inventories_band');
    Route::get('/show-inventory_band/{id}', 'StoreInventroyController@show_inventory_band')->name('stores.show_inventory_band');

 //تحويل الاصناف  من  مستودع  الى  اخر/////////////////////////////////////
    Route::get('/transaction', 'StoreTransactionController@transaction_form')->name('stores.transaction');
    Route::post('transactions', 'StoreTransactionController@transactions')->name('stores.transactions');
    Route::get('/products_store/{id}', 'StoreController@getproducts')->name('products_store');
    Route::get('/products_settlement/{id}', 'StoreController@getproducts_')->name('products_settlement');

    Route::post('transaction/{id}', 'StoreTransactionController@transaction')->name('products.transaction');
    Route::get('/productsingle', 'StoreTransactionController@productsingle');
    Route::get('/productsettlement', 'StoreTransactionController@productsettlement');
    Route::get('/productdamage', 'StoreTransactionController@productdamage');

    Route::get('/requests', 'StoreTransactionController@requests')->name('stores.requests');
    Route::get('/request/{id}', 'StoreTransactionController@request')->name('stores.request');
    Route::get('/accept_request/{id}', 'StoreTransactionController@accept_request')->name('stores.accept_request');
    Route::post('/refused_request/{id}', 'StoreTransactionController@refused_request')->name('stores.refused_request');
    Route::get('/requests-all', 'StoreTransactionController@requests_all')->name('stores.requests_all');
    Route::get('/request-detail/{id}', 'StoreTransactionController@request_detail')->name('stores.request_detail');
//////////////////التالف///////////////////
    Route::get('/damages', 'StoreTransactionController@damaged_index')->name('stores.damaged_index');
    Route::get('/damages-create', 'StoreTransactionController@damaged_create')->name('stores.damaged_create');
    Route::post('/damages-store', 'StoreTransactionController@damaged_store')->name('stores.damaged_store');
    Route::get('/damages-show/{id}', 'StoreTransactionController@damaged_show')->name('stores.show_damaged_products');

    ///////////////تقاير المخازن

    Route::get('/balances-report', 'StoreController@first_balances')->name('stores.first_balances_report');

    ////////////////////////////طباعة الباركود
    Route::get('/product-barcode/{id}', 'ProductController@barcode')->name('products.barcode');
    Route::get('/sell_login', 'SellPointController@sell_login')->name('sells_points.login');
    Route::get('/sell_point', 'SellPointController@sell_point')->name('sells_points.sells_point');

    // Route::get('/sell_point', 'SellPointController@sell_point')->name('sells_points.sells_point');
    Route::get('/notification/{id}', 'OfferController@notification')->name('offers.notification');
    Route::get('/permiums', 'ClientController@permiums')->name('clients.permiums');
    Route::post('/permium_store', 'ClientController@permium_store')->name('clients.permiums_store');

    Route::get('/offer_copy', 'ClientController@offer_copy')->name('clients.offers_copy');
    Route::post('/offers_copy', 'ClientController@copy')->name('clients.copy');

    Route::resource('session', 'SessionController');

    Route::resource('sales', 'SaleController');
    Route::resource('clients', 'ClientController');
    Route::resource('categories', 'CategoryController');
    Route::resource('industrials', 'IndustrialController');
    Route::resource('safes', 'SafeController');
    Route::resource('devices', 'DeviceController');
    Route::get('/company_devices/{id}', 'SafeController@company_devices');
    Route::get('/branch_devices/{id}', 'SafeController@branch_devices');


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

