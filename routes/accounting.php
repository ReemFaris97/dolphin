<?php

use App\Http\Controllers\AccountingSystem\Reports\SalesController;
use App\Http\Controllers\AccountingSystem\Reports\StoresController;
use App\Http\Controllers\AccountingSystem\Reports\SuppliersController;

Route::get('/', function () {
    return redirect()->route('accounting.home');
});

/*Route::get('fix',function (){
    $sales_items=\App\Models\AccountingSystem\AccountingSaleItem::all();
    foreach ($sales_items as $item){
        $subUnit=$item->product->sub_units->where('selling_price',$item->price)->first();
        if ($subUnit){
            $item->update(['unit_id' => $subUnit->id]);
        }

//        if ()
    }
    dd('done fixing');
});*/
Route::get('fix-invoice/{sale}', function (\App\Models\AccountingSystem\AccountingSale $sale) {
    $inputs=$sale->toArray();
    $inputs['sale_id']=$inputs['id'];
    $inputs['total']=$sale->product_total();
    $return= \App\Models\AccountingSystem\AccountingReturn::create($inputs);
    foreach ($sale->items as $item) {
        $return->items()->create($item->toArray());
    }

    dd($return, $return->items);
});
Route::middleware('admin')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('companies', 'CompanyController');
    Route::resource('branches', 'BranchController');
    Route::resource('productionLines', 'ProductionLineController');
    Route::resource('productions', 'ProductionController');
    Route::resource('product-recipes', 'ProductRecipeController');
    Route::resource('chats','ChatController');
    Route::resource('shifts', 'ShiftController');
    Route::resource('users', 'UserController');
    Route::resource('stores', 'StoreController');
    Route::resource('storeKeepers', 'StoreKeeperController');
    Route::resource('taxs', 'TaxsController');
    Route::resource('banks', 'BankController');
    Route::resource('roles', 'roleController');
    Route::resource('backups', 'BackupController');

    Route::get('/product-units/{id}', 'ProductRecipeController@getProductUnits')->name('getProductUnits');

    Route::get('/production-updateStatus/{id}', 'ProductionController@updateStatus')->name('productions.updateStatus');

    Route::get('/user_permissions/{id}', 'UserController@user_permissions')->name('user_permissions.edit');
    Route::patch('/user_permissions/{id}', 'UserController@user_permissions_update')->name('user_permissions.update');
    Route::get('getBranchesPermission/{id}', 'UserController@getBranchesPermission')->name('getBranchesPermission');
    Route::get('getStoresPermission/{id}', 'UserController@getStoresPermission')->name('getStoresPermission');
    Route::get('getStoresCampanyPermission/{id}', 'UserController@getStoresCampanyPermission')->name('getStoresCampanyPermission');
    Route::get('/get-permissions/{id}', 'UserController@permissions');

    /////////////////سندات  ادخال الاصناف فى المستودعات
    Route::get('/company_stores/{id}', 'StoreController@user_permissions');
    Route::get('/branch_stores/{id}', 'StoreController@branch_stores');
    Route::get('/store-active/{id}', 'StoreController@active')->name('stores.is_active');
    Route::get('/store-dis_active/{id}', 'StoreController@dis_active')->name('stores.dis_active');

    Route::post('/store-cost/{id}', 'StoreController@cost')->name('stores.update_cost_type');

    Route::get('/store-active-product/{id}', 'StoreController@active_product')->name('stores.is_active_product');
    Route::get('/store-dis_active-product/{id}', 'StoreController@dis_active_product')->name('stores.dis_active_product');
    Route::get('/product-details/{id}', 'StoreController@show_product_details')->name('stores.show_product_details');
    Route::post('/destroy_product/{id}', 'StoreController@destroy_product')->name('stores.destroy_product');
    Route::get('/destroy_subunit/{id}', 'ProductController@destroy_subunit')->name('products.destroy_subunit');

    Route::get('/products_entry_form', 'StoreController@products_entry_form')->name('stores.products_entry_form');
    Route::post('/bond_store', 'StoreController@bond_store')->name('stores.bond_store');
    Route::get('/keepers_store/{id}', 'StoreController@getkeepers')->name('keepers_store');
    Route::get('/stores_to/{id}', 'StoreController@stores_to')->name('stores_to');





    Route::get('/bonds', 'StoreController@bonds_index')->name('stores.bonds_index');
    Route::get('/bond-show/{id}', 'StoreController@bond_show')->name('stores.show_bond');
    Route::get('/products_exchange_form', 'StoreController@products_exchange_form')->name('stores.products_exchange_form');

    Route::get('/get-product-by-store/{id}', 'StoreController@getProductByStore')->name('stores.getProductByStore');

    Route::post('/products_exchange_store', 'StoreController@products_exchange_store')->name('stores.products_exchange_store');
    Route::get('/store-product/{id}', 'StoreController@store_product')->name('stores.product');
    Route::post('/store-products-copy/{id}', 'StoreController@store_products_copy')->name('store_products_copy.store');

    /////////////////settlementتسوي  الارصده  للبداية/////////////////
    Route::post('/settlement', 'StoreController@settlements_store')->name('stores_settle.filter_settlements');
    Route::get('/settlements', 'StoreController@settlements')->name('stores.settlements');
    Route::get('/settlements-index', 'StoreController@settlements_index')->name('stores.settlements_index');

    Route::get('/product-settlement/{id}', 'ProductController@settlement')->name('products.settlements');
    Route::any('/settlements_store', 'ProductController@settlements_store')->name('products_settlement.store');
    ///////////////////////////inventory  للمستوعات  الجرد وتسوية الجرد
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

    Route::get('my-invoices', 'InvoiceController@index')->name('invoices.current');
    //تحويل الاصناف  من  مستودع  الى  اخر/////////////////////////////////////
    Route::get('/transaction', 'StoreTransactionController@transaction_form')->name('stores.transaction');
    Route::post('transactions', 'StoreTransactionController@transactions')->name('stores.transactions');
    Route::get('/products_store/{id}', 'StoreController@getproducts')->name('products_store');
    Route::get('/products_purchase/{id}', 'PurchaseReturnController@getproducts')->name('products_purchase');

    Route::get('/products_settlement/{id}', 'StoreController@getproducts_')->name('products_settlement');


    Route::post('transaction/{id}', 'StoreTransactionController@transaction')->name('products.transaction');
    Route::get('/productsingle', 'StoreTransactionController@productsingle');
    Route::get('/productsettlement', 'StoreTransactionController@productsettlement');
    Route::get('/productdamage', 'StoreTransactionController@productdamage');
    Route::get('/productpurchase', 'PurchaseReturnController@productpurchase');
    Route::get('/store_products/{id}', 'StoreTransactionController@store_products');


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

    ///////////////تقاير المستودعات

    Route::get('/balances-report', 'StoreController@first_balances')->name('stores.first_balances_report');
    //Excel sheeeeeeeeeet
    Route::get('importView', 'ProductController@importView')->name('products.importView');
    Route::post('import', 'ProductController@import')->name('products.import');

    Route::get('importViewCategory', 'ProductController@importViewCategory')->name('products.importViewCategory');
    Route::post('importCategory', 'ProductController@importCategory')->name('products.importCategory');

    ////////////////////////////طباعة الباركود
    Route::get('/product-barcode/{id}', 'ProductController@barcode')->name('products.barcode');
    Route::get('/print-barcode-view', 'ProductController@print_barcode_view')->name('products.print_barcode_view');
    Route::post('/print/barcode', 'ProductController@print_barcode')->name('products.print_barcode');
    Route::post('/ajax/products', 'ProductController@storeAjax');
    Route::put('/ajax/products/{id}', 'ProductController@updateAjax');
    Route::get('/products-by-ajax', 'ProductController@getProductsByAjax')->name('getProductsByAjax');
    Route::get('/products-creation-by-ajax', 'ProductController@getProductsCreationByAjax')->name('getProductsCreationByAjax');

    Route::get('/products-recipes-by-ajax', 'ProductionController@getProductsCreationRecipesByAjax')->name('getProductsCreationRecipesByAjax');


    Route::get('/get-product-price/{id}', 'ProductController@getProductPrice')->name('getProductPrice');

    Route::group(['prefix' => 'ajax/products'], function () {
        Route::delete('sub-units/{subUnit}', 'Products\ProductController@deleteSubUnits');
    });
    Route::get('/sell_login', 'SellPointController@sell_login')->name('sells_points.login');
    Route::get('/sell_point/{id}', 'SellPointController@sell_point')->name('sells_points.sells_point');

    Route::get('/notification/{id}', 'OfferController@notification')->name('offers.notification');
    Route::get('/permiums', 'ClientController@permiums')->name('clients.permiums');
    Route::post('/permium_store', 'ClientController@permium_store')->name('clients.permiums_store');
    Route::get('/offer_copy', 'ClientController@offer_copy')->name('clients.offers_copy');
    Route::post('/offers_copy', 'ClientController@copy')->name('clients.copy');
    Route::get('sessions_close', 'SessionController@sessions_close')->name('sessions.sessions_close');

    Route::resource('sessions', 'SessionController');
    Route::resource('sales', 'SaleController');
    Route::resource('clients', 'ClientController');
    Route::resource('categories', 'CategoryController');
    Route::resource('industrials', 'IndustrialController');
    Route::resource('safes', 'SafeController');
    Route::resource('devices', 'DeviceController');
    Route::resource('settings', 'SettingController');
    Route::resource('fiscalYears', 'FiscalYearController');
    Route::resource('fiscalPeriods', 'FiscalPeriodController');
    Route::resource('costCenters', 'CostCenterController');
    Route::resource('jobTitles', 'JobTitleController');
    Route::resource('assets', 'AssetController');
    Route::resource('custodies', 'CustodyController');
    Route::post('add_amount/{id}', 'CustodyController@add_amount')->name('custodies.add_amount');
    Route::post('decreased_amount/{id}', 'CustodyController@decreased_amount')->name('custodies.decreased_amount');

    Route::get('active/{id}', 'CostCenterController@active')->name('costCenters.active');
    Route::get('dis-active/{id}', 'CostCenterController@dis_active')->name('costCenters.dis_active');
    Route::get('active-title/{id}', 'JobTitleController@active')->name('jobTitles.active');
    Route::get('dis-active-title/{id}', 'JobTitleController@dis_active')->name('jobTitles.dis_active');
    Route::get('pay-salaries', 'SalaryController@index')->name('users.pay_salaries');
    Route::get('user_salaries', 'SalaryController@salaries')->name('users.salaries_paid');
    Route::get('/userSalary', 'SalaryController@userSalary');
    Route::get('/titleSalary', 'SalaryController@titleSalary');
    Route::get('/checks', 'ClauseController@checks')->name('clauses.checks');

    Route::post('pay', 'SalaryController@pay')->name('users.pay');

    Route::post('/store_returns', 'SaleController@store_returns')->name('sales.store_returns');

    Route::get('/returns/{id}', 'SaleController@returns')->name('sales.returns');
    Route::delete('/remove_Sale/{id}', 'SaleController@remove_Sale');

    Route::get('/returns_Sale/{id}', 'SaleController@returns_Sale');
    Route::get('/sale_details/{id}', 'SaleController@sale_details');

    Route::get('/index_returns', 'SaleController@index_returns')->name('sales.index_returns');
    Route::Delete('/destroy_return/{id}', 'SaleController@destroy_return')->name('sales.destroy_return');
    Route::get('/show_return/{id}', 'SaleController@show_return')->name('sales.show_return');

    Route::get('/returns_purchases', 'PurchaseController@returns')->name('purchases.returns');
    Route::post('/store_returns_purchases', 'PurchaseController@store_returns')->name('purchases.store_returns');


    Route::post('/sale_end/{id}', 'SaleController@sale_end')->name('sales.end');
    Route::get('/close/{id}', 'SessionController@close')->name('sessions.close');


    Route::get('/end_session/{id}', 'SaleController@end_session')->name('sales.end_session');

    Route::get('/company_devices/{id}', 'SafeController@company_devices');
    Route::get('/branch_devices/{id}', 'SafeController@branch_devices');
    Route::post('transactionsafe_store/{id}', 'SafeController@transactionsafe_store')->name('transactionsafe_store');

    Route::get('print-a4-bill/{bill}', 'SaleController@showBill');

    Route::resource('faces', 'FaceController');
    Route::resource('columns', 'ColumnController');
    Route::resource('cells', 'CellController');

    Route::resource('clauses', 'ClauseController');
    Route::resource('suppliers_sadad', 'SupplierSadadController');
    Route::get('/getBalance/{id}', 'SupplierSadadController@getBalance');
    Route::get('/getClient/{id}', 'ClientController@getClient');

    Route::get('/getNewBalance/{amount}', 'SupplierSadadController@getNewBalance');

    Route::resource('delegates', 'DelegateController');
    Route::resource('suppliers', 'SupplierController');
    Route::get('/supplier-active/{id}', 'SupplierController@active')->name('suppliers.is_active');
    Route::get('/supplier-dis_active/{id}', 'SupplierController@dis_active')->name('suppliers.dis_active');
    Route::get('/purchase_order', 'SupplierController@purchase_order')->name('suppliers.purchase_order');

    Route::resource('benods', 'BenodController');
    Route::resource('offers', 'OfferController');

    Route::resource('puchaseReturns', 'PurchaseReturnController');

    Route::post('/product', 'OfferController@getAjaxProductQty')->name('getAjaxProductQty');
    Route::get('/order_sale/{id}', 'SaleController@sale_order')->name('sales.sale_order');

    Route::resource('products', 'ProductController');
    Route::get('/company_branch/{id}', 'ProductController@getBranch')->name('company.branch');
    Route::get('/company_branch_without_all/{id}', 'ProductController@branches_only')->name('company.branches_only');
    Route::get('/branches_store/{id}', 'ProductController@getStores');
    Route::get('/columns_face/{id}', 'ProductController@getcolums')->name('columns_face');
    Route::get('/cells_column/{id}', 'ProductController@getcells')->name('cells_column');

    Route::get('/faces_branch/{id}', 'ProductController@getfaces')->name('faces_branch');
    Route::get('/type_benods/{id}', 'BenodController@getbenods')->name('type_benods');

    Route::get('/companes_store/{id}', 'ProductController@getStoresbycompany');

    Route::post('/subunit', 'ProductController@subunit')->name('subunit');

    Route::get('/productsAjex/{id?}', 'SellPointController@getProductAjex')->name('ajaxProducts');
    Route::get('/products-single-product/{product}', 'SellPointController@selectedProduct')->name('single-product-ajax');

    Route::get('/pro_search/{name}', 'SellPointController@pro_search');
    Route::get('/barcode_search/{name}', 'BuyPointController@barcode_search');
    Route::get('/barcode_search_sale/{name}', 'SellPointController@barcode_search');
    Route::get('/confirm_user', 'SaleController@confirm_user');


    Route::post('/confirm', 'SessionController@confirm')->name('sessions.confirm');

    ////purchases
    Route::get('/buy_point', 'BuyPointController@buy_point')->name('buy_point.buy_point');
    Route::get('/productsAjexPurchase', 'BuyPointController@getProductAjex');
    Route::get('/purchase/products-single-product/{product}', 'BuyPointController@selectedProduct')->name('purchase.single-product-ajax');

    Route::get('purchases/{id}/print', 'PurchaseController@print')->name('purchases.print');
    Route::resource('purchases', 'PurchaseController');
    Route::get('/productReturnPurchase', 'PurchaseReturnController@product');
    Route::get('/backup', 'SettingController@backup')->name('backup');

    Route::resource('templates', 'TemplateController');

    Route::group(['prefix' => 'reports', 'namespace' => 'Reports', 'as' => 'reports.'], function () {
        Route::any('damaged-products', [StoresController::class,'damages'])->name('damaged-products');
        Route::any('inventory-products', [ StoresController::class,'inventory'])->name('inventory-products');
        Route::any('deficiency-products', [ StoresController::class,'deficiency'])->name('deficiency-products');
        Route::any('transaction-products', [ StoresController::class,'transactions'])->name('transaction-products');
        Route::any('expiration-products', [ StoresController::class,'expirations'])->name('expiration-products');
        Route::any('stagnant-products', [ StoresController::class,'stagnants'])->name('stagnant-products');
        Route::any('movements-products', [ StoresController::class,'movements'])->name('movements-products');
        Route::get('general-movements', [ StoresController::class,'generalMovements'])->name('general-movements');


        Route::group(['prefix' => 'suppliers', 'as' => 'suppliers.'], function () {
            Route::any('purchases', ['as' => 'purchases', 'uses' => 'SuppliersController@purchases']);
            Route::any('purchases-all', ['as' => 'purchases-all', 'uses' => 'SuppliersController@purchasesAll']);

            Route::any('purchases-returns', ['as' => 'purchases-returns', 'uses' => 'SuppliersController@purchasesReturns']);
            Route::any('purchases-returns-all', ['as' => 'purchases-returns-all', 'uses' => 'SuppliersController@purchasesReturnsAll']);

            Route::any('account-statement', ['as' => 'account-statement', 'uses' => 'SuppliersController@accountStatement']);
        });

        Route::group(['prefix' => 'purchases'], function () {
            Route::any('/', ['as' => 'purchases', 'uses' => 'PurchasesController@index']);
            Route::any('details', ['as' => 'purchase_details', 'uses' => 'PurchasesController@details']);
            Route::any('days', ['as' => 'purchases_day', 'uses' => 'PurchasesController@byDay']);
            Route::any('returns', ['as' => 'purchases_returns', 'uses' => 'PurchasesController@returnsPeriod']);
            Route::any('returns-details', ['as' => 'purchase_returns_details', 'uses' => 'PurchasesController@returnDetails']);
            Route::any('returns-days', ['as' => 'purchases_returns_day', 'uses' => 'PurchasesController@returnsDay']);
        });
        Route::group(['prefix' => 'sales'], function () {
            Route::any('period', ['as' => 'sales_period', 'uses' => 'SalesController@index']);
            Route::any('details', ['as' => 'sale_details', 'uses' => 'SalesController@details']);
            Route::any('days', ['as' => 'sales_day', 'uses' => 'SalesController@byDay']);
            Route::any('returns', ['as' => 'sales_returns', 'uses' => 'SalesController@returnsPeriod']);
            Route::any('returns-details', ['as' => 'sales_returns_details', 'uses' => 'SalesController@returnDetails']);
            Route::any('returns-days', ['as' => 'sales_returns_day', 'uses' => 'SalesController@returnsDay']);

            Route::any('daily-earnings', ['as' => 'daily_earnings', 'uses' => 'SalesController@daily_earnings']);
            Route::any('period-earnings', [SalesController::class,'period_earnings'])->name('period_earnings');
            Route::match(['get','post'], 'sessions', [SalesController::class,'sessionDetails'])->name('sessions_report');
            Route::get('improved-sales', [SalesController::class,'improvedSales'])->name('improvedSales');
            Route::get('return-improved-sales', [SalesController::class,'improvedReturnSales'])->name('returnimprovedSales');
        });
    });


    Route::group(['prefix' => 'ajax'], function () {
        Route::get('branches/{id}', 'HomeController@getBranches');
        Route::get('production-lines/{id}', 'HomeController@getProductionLines');
        Route::get('stores/{id}', 'HomeController@getStores');
        Route::get('categories/{id}', 'HomeController@getCategories');

        Route::get('stores-form-company/{id}', 'HomeController@getStoresCompany');
        Route::get('products-store/{id}', 'HomeController@getProductStore');
        Route::get('products-store-branch/{id}', 'HomeController@getProductStoreBranch');

        Route::get('users-by-branches/{branch_id}', 'HomeController@getUsersByBranch');
        Route::get('products/{id}', 'HomeController@getProducts');
        Route::get('sessions/{id}', 'HomeController@getSessions');
        Route::get('suppliers/{id}', 'HomeController@getSuppliers');


        Route::get('company/{company}/branches', "AjaxController@getcompanyBranches");
        Route::get('branch/{branch}/stores', "AjaxController@getBranchStores");
        Route::get('branch/{branch}/faces', "AjaxController@getBranchFaces");
        Route::get('face/{face}/columns', "AjaxController@getFaceColumns");
        Route::get('column/{column}/cells', "AjaxController@getColumnCells");
    });


    Route::group(['prefix' => 'ChartsAccounts'], function () {
        Route::resource('ChartsAccounts', 'AccountController');
        Route::any('trial-balance', 'AccountController@trial_balance')->name('ChartsAccounts.trial_balance');

        Route::resource('AccountSettings', 'AccountSettingController');
        Route::get('active/{id}', 'AccountController@active')->name('ChartsAccounts.active');
        Route::get('dis-active/{id}', 'AccountController@dis_active')->name('ChartsAccounts.dis_active');
    });
    Route::resource('currencies', 'CurrencyController');
    Route::resource('payments', 'PaymentController');

    Route::group(['prefix' => 'entries'], function () {
        Route::resource('entries', 'EntryController');
        Route::get('filter', ['as' => 'entries.filter', 'uses' => 'EntryController@filter']);
        Route::get('posting/{id}', ['as' => 'entries.posting', 'uses' => 'EntryController@posting']);
        Route::get('toAccounts/{id}', ['as' => 'entries.toAccounts', 'uses' => 'EntryController@toaccounts']);
    });
    Route::get('/destroy_account/{id}', ['as'=>'entries.destroy_account', 'uses' => 'EntryController@destroy_account']);

    //////////////////////////////////----employees_resources----////
    Route::group(['prefix'=>'documents/{type}','as'=>'documents.'], function () {
        Route::get('/{id}/edit', 'DocumentController@edit')->name('edit-real');
        Route::put('/{id}', 'DocumentController@update')->name('put');
        Route::get('/{id}/delete', 'DocumentController@destroy')->name('delete');
        Route::resource('/', 'DocumentController');
    });

    Route::resource('allowances', 'AllowanceController');
    Route::resource('holidays', 'HolidayController');
    Route::resource('holidays-requests', 'UserHolidaysRequestController');
    Route::get('holidays-requests/get-user-data/{id}', 'UserHolidaysRequestController@getUserData');
    Route::resource('bonus-discount', 'BonusDiscountController');
    Route::resource('attendances', 'AttendanceController');
    Route::resource('debts', 'DebtController');
    Route::resource('salaries', 'SalariesController');
    Route::post('debts-{id}', 'DebtController@payDebt')->name('payDebt');

    Route::resource('suppliers-products', 'Suppliers\\SupplierProductController');
    Route::resource('suppliers-banks', 'Suppliers\\BankController');
});


Route::get('empty', function () {
    return view('AccountingSystem.empty');
});
