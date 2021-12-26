<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/get_tax', 'StoreController@getTax');
Route::get('/version', 'SettingController@getVersion');
Route::post('/version/{version}', 'SettingController@setVersion');
Route::get('/bills/print_bill/{id}', 'RouteController@print_bill');
Route::get('bills/last-bill', 'RouteController@lastBill')->middleware('jwt.auth');


Route::group(['middleware' => ['jwt.auth']], function () {
    Route::resource('transactions', 'TransactionController');
    Route::get('wallet', 'TransactionController@getWallet');
    Route::get('notifications', 'NotificationController@index');
    Route::resource('stores', 'StoreController');
    Route::resource('expenses', 'ExpenseController');
    Route::post('damage', 'RouteController@AddDamage');
    Route::get('routes/{id}/cash', 'RouteController@TripCashes');
    Route::resource('routes', 'RouteController');
    Route::post('make_inventory/{type}', 'RouteController@makeInventory');
    Route::post('make_bill', 'RouteController@attachProducts');
    Route::post('attach_images', 'RouteController@attachImages');
    Route::get('current_trips', 'RouteController@currentTrips');
    Route::post('add_client/{route_id}', 'RouteController@AddClientToRoute');
    Route::get('products_report', 'DailyReportController@productReport');
    Route::resource('daily_reports', 'DailyReportController')->only('store');
    Route::resource('bank_deposits', 'BankDepositsController');
    Route::get('cars', 'StoreController@cars');
    Route::get('transfer_requests', 'StoreController@pendingTransferRequests');
    Route::get('transfer_requests/{id}', 'StoreController@AcceptTransferRequest');
    Route::get('/reports', 'DailyReportController@reports');

    Route::group(['prefix' => 'spinner'], function () {
        Route::get('/distributors', 'SpinnerController@getAllDistributors');
        Route::get('/banks', 'SpinnerController@getAllBanks');
        Route::get('/distributors_transactions', 'SpinnerController@getReceivedMoneyTransactions');
        Route::get('/distributors_reasons', 'SpinnerController@getAllDistributorsRefuseReason');
        Route::get('/readers', 'SpinnerController@getAllReaders');
        Route::post('/product_by_code', 'SpinnerController@getProductByBarCode');
        Route::get('/products/{store_id?}', 'SpinnerController@getProductsByStore');
        Route::get('/stores', 'SpinnerController@getAllStores');
        Route::get('/routes', 'SpinnerController@getDistributorRoutes');
        Route::get(
            '/stores/{distributor_id}',
            'SpinnerController@getStoresByDistributorId'
        );
        Route::get('/expenditure_clauses/{id}', 'SpinnerController@getExpenditureClauses');
        Route::get('/expenditure_types', 'SpinnerController@getExpenditureTypes');
        Route::get('/client-classes', 'SpinnerController@getClientClasses');
        Route::get('/settings', 'SpinnerController@getSetting');
    });
});
