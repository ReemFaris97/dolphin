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

use App\Http\Controllers\AccountingSystem\SellPointController;
use App\Models\AccountingSystem\AccountingAsset;
use App\Models\AccountingSystem\AccountingAssetDamageLog;
use App\Models\AccountingSystem\AccountingPurchaseItem;
use Carbon\Carbon;

Route::get('test-pdf', function () {
    $routetrip = \App\Models\RouteTripReport::findOrFail(297);
    //return view('distributor.bills.api',['bill'=>$routetrip])->render();
    /*   $pdf=\PDF::loadHTML();
       return $pdf->stream();*/
//    PDF::loadHTML()
//    Barryvdh\Snappy\Facades\SnappyPdf::class

//    return view('distributor.bills.api',['bill'=>$routetrip]);
    $pdf = PDF::setOptions([
            'margin-top'=>0,
            'margin-bottom'=>0,
            'margin-left'=>0,
            'margin-right'=>0,
            'page-height'=>250 + ($routetrip->products()->count() * 8),
            'page-width'=>110
        ])
        ->loadView('distributor.bills.api', ['bill' => $routetrip]);

    return $pdf->inline();
});

Route::get('test', function () {

    // $user=AccountingAccount::find(31);
    // dd($user->descendants);
    $today=Carbon::now();
    $Assets=AccountingAsset::all();
    foreach ($Assets as $asset) {
        if ($today->between($asset->damage_start_date, $asset->damage_end_date)) {
            $lastDamage=AccountingAssetDamageLog::where('asset_id', $asset->id)->latest()->first();
            AccountingAssetDamageLog::create([
                    ''
                ]);
        }
    }
});
Route::get('/', function () {
    dd(AccountingPurchaseItem::first()->addQuantity());
    return redirect()->route('admin.login');
});

Route::get('/check', function () {
    if (
        auth()->check()&&
        auth()->user()->is_saler==1
         && auth()->user()->is_accountant!=1

         && auth()->user()->is_distributor!=1
    ) {
        return  redirect()->action([SellPointController::class,'sell_login']);
    }


    return view('admin.auth.after-login');
});

//Route::get('/home', 'HomeController@index')->name('home');



Route::group(['prefix' => 'company'], function () {
    Route::get('/login', 'CompanyAuth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'CompanyAuth\LoginController@login');
    //  Route::post('/logout', 'CompanyAuth\LoginController@logout')->name('logout');

    Route::get('/register', 'CompanyAuth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'CompanyAuth\RegisterController@register');

    Route::post('/password/email', 'CompanyAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    Route::post('/password/reset', 'CompanyAuth\ResetPasswordController@reset')->name('password.email');
    Route::get('/password/reset', 'CompanyAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::get('/password/reset/{token}', 'CompanyAuth\ResetPasswordController@showResetForm');
});
 Route::get('/thebill', function () {
     return view('distributor.bill');
 });

Route::get('show-invoice/{uuid}', 'AccountingSystem\SaleController@showInvoice')->name('showInvoice');
