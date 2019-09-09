<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('admin.login');
});

Route::get('/check',function(){
    if(auth()->check()){
        if(auth()->user()->is_distributor == 1){
            return redirect('/distributor/home');
        }

    elseif(auth()->user()->is_supplier == 1) {
        return redirect('/supplier/home');
    }
    else{
            return redirect('/admin');
        }
    }else{
        Auth::logout();
    }
});

Route::get('/home', 'HomeController@index')->name('home');


