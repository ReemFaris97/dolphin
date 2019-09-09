<?php

use Illuminate\Http\Request;

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



    Route::group(['prefix'=>'auth'],function () {
        Route::post('/register','AuthController@register');
        Route::post('login/{role?}', 'AuthController@Login');
        Route::post('activate', 'AuthController@phone_activation')->middleware('jwt.auth');
        Route::post('reset', 'AuthController@reset_password');
        Route::post('forget', 'AuthController@forget_password');


    });


Route::group(['middleware' => ['jwt.auth']], function () {

    Route::group(['prefix' => 'user'], function () {
        Route::get('logout','AuthController@Logout');
        Route::group(['prefix' => 'update'], function () {
            Route::post('profile', 'AuthController@UpdateProfile');
        });
    });

    Route::group(['prefix' => 'notifications'], function () {
        Route::get('/','NotificationController@getAllNotificationsByCategory');
//        Route::get('/','NotificationController@getNotificationsCategories');

    });

    Route::get('/chat_search','SearchController@chatSearch');
    Route::get('/task_search','SearchController@taskSearch');



    Route::group(['prefix' => 'chats'], function () {
        Route::get('/','MessageController@inbox');
        Route::get('/{user_id}','MessageController@messages');
        Route::post('/{user_id}','MessageController@sendMessage');
    });

    Route::group(['prefix' => 'spinner'], function () {
        Route::get('/workers','SpinnerController@getAllWorkers');
        Route::get('/tasks','SpinnerController@getAllTasks');
        Route::get('/clauses','SpinnerController@getAllClauses');
        Route::get('/notifications_categories','SpinnerController@getAllNotificationsCategories');
    });
    Route::delete('/images/{id}','TaskController@deleteImage');
    Route::delete('/notes/{id}','TaskController@deleteNote');

    Route::resource('charges','ChargeController');
    Route::post('charges_log/{charge_id}','ChargeController@addLog');
    Route::post('charges_notes/{charge_id}','ChargeController@addNotes');
    Route::post('charges_confirm/{charge_id}','ChargeController@confirmCharge');
    Route::get('assigned_tasks','ChargeController@assignedCharges');
    Route::get('notes/{id}','ChargeController@getNotes');
    Route::get('logs/{id}','ChargeController@getLogs');

    Route::resource('clauses','ClauseController');

    Route::resource('tasks','TaskController');
    Route::get('finish_task/{id}','TaskController@finish');
    Route::get('complete_task/{id}','TaskController@workerFinish');
    Route::get('home','TaskController@home');
    Route::get('home/to_finish','TaskController@homeToFinish');
    Route::post('rate_task/{id}','TaskController@rate');
    Route::post('add_task_notes/{id}','TaskController@addNotes');
    Route::post('rate_attachment/{id}','TaskController@addAttachment');
    Route::post('reassign_task','TaskController@reAssignTasks');
    Route::post('report','TaskController@Report');
});
