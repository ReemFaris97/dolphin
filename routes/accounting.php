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
    Route::get('/store-product/{id}', 'StoreController@store_product')->name('stores.product');
    Route::post('/store-products-copy/{id}', 'StoreController@store_products_copy')->name('store_products_copy.store');
    Route::post('/settlement', 'StoreController@settlements_store')->name('stores_settle.filter_settlements');
    Route::get('/settlements', 'StoreController@settlements')->name('stores.settlements');



    Route::get('/product-settlement/{id}', 'ProductController@settlement')->name('products.settlements');
    Route::any('/settlements_store', 'ProductController@settlements_store')->name('products_settlement.store');


    Route::resource('categories', 'CategoryController');
    Route::resource('industrials', 'IndustrialController');

    Route::resource('faces', 'FaceController');
    Route::resource('columns', 'ColumnController');
    Route::resource('cells', 'CellController');

    Route::resource('clauses', 'ClauseController');
    Route::resource('benods', 'BenodController');

    Route::resource('products', 'ProductController');
    Route::get('/company_branch/{id}', 'ProductController@getBranch')->name('company.branch');

    Route::get('/branches_store/{id}', 'ProductController@getStores');
    Route::get('/columns_face/{id}', 'ProductController@getcolums')->name('columns_face');
    Route::get('/cells_column/{id}', 'ProductController@getcells')->name('cells_column');

    Route::get('/faces_branch/{id}', 'ProductController@getfaces')->name('faces_branch');
    Route::get('/type_benods/{id}', 'BenodController@getbenods')->name('type_benods');

    Route::get('/companes_store/{id}', 'ProductController@getStoresbycompany');

    Route::post('/subunit', 'ProductController@subunit')->name('subunit');


});

