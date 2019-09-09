<?php

Route::get('/',function (){

return redirect()->route('suppliers.home');
});

Route::middleware('supplier')->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/suppliers', 'SupplierController');
    Route::patch('suppliers/block/{user}', 'SupplierController@block')->name('suppliers.block');

});

