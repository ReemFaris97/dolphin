<?php

Route::get('/',function (){

return redirect()->route('accounting.home');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('accounting')->group(function () {


});

