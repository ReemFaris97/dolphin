<?php

Route::get('/home', function () {


    return view('AccountingSystem.AccountingCompanies.home');
})->name('home');


Route::middleware('company')->group(function () {
    Route::resource('branches', 'BranchController');
    Route::resource('shifts', 'ShiftController');

    Route::resource('stores', 'StoreController');
    Route::resource('categories', 'CategoryController');

    Route::resource('faces', 'FaceController');
    Route::resource('columns', 'ColumnController');
    Route::resource('cells', 'CellController');

    Route::resource('clauses', 'ClauseController');

    Route::resource('products', 'ProductController');
    Route::resource('transactions', 'TranscationController');

    Route::post('/logout', 'CompanyAuth\LoginController@logout')->name('logout');


});
