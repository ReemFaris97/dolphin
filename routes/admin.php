<?php



Auth::routes(['register' => false]);

Route::get('/', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('users', 'UserController')->except('destroy');
    Route::get('users/edit/profile','UserController@editProfile')->name('users.edit.profile');
    Route::post('users/update/profile','UserController@updateProfile')->name('users.update.profile');
    Route::patch('users/block/{user}', 'UserController@block')->name('users.block');
    Route::patch('users/distributor/{user}', 'UserController@TurnUserToDistributor')->name('users.turn.distributor');
    Route::resource('notifications-category', 'NotificationsCategory');
    Route::post('notifications/read', 'NotificationsCategory@readNotifications')->name('notification.read');
    Route::resource('tasks', 'TaskController');
    Route::post('get/clause/amount','TaskController@getAjaxClauseAmount')->name('getAjaxClauseAmount');
    Route::get('tasks/user/index', 'TaskController@userTasks')->name('tasks.user.index');
    Route::get('tasks/user/creator', 'TaskController@CreatedTasks')->name('tasks.user.creator');
    /*tasks routes*/

    Route::post('tasks/{task}/finished', 'TaskController@finishTask')->name('tasks.finish');


    /*Replace Tasks*/
    Route::get('task_user/replace','TaskController@getReplacePage')->name('tasks.get.replace');
    Route::post('task_user/replace','TaskController@postReplaceTasks')->name('tasks.post.replace');
    Route::post('task_user/get-ajax-all-tasks','TaskController@getAjaxAllTasks')->name('tasks.get.allTasks');



    Route::post('tasks/worker/{task}/finished', 'TaskController@finishWorkerTask')->name('tasks.finishWorker');
    Route::put('task_user/{task}', 'TaskController@TaskUserUpdate')->name('task_user.update');
    Route::post('tasks/{task}/rate', 'TaskController@rateTask')->name('tasks.rate');
    Route::post('tasks/{task}/note', 'TaskController@storeTaskNote')->name('task.note.store');



    Route::get('tasks-users/present', 'TaskUserController@presentTasks')->name('task-user.present');


     Route::get('tasks-users/ratable', 'TaskUserController@ratableTasks')->name('task-user.ratable');

    Route::post('tasks/{task}/image', 'TaskController@storeTaskImage')->name('task.images.store');
    Route::get('tasks/finished/today', 'TaskUserController@TasksFinishedToDay')->name('task.finished.today');


    Route::get('tasks/old/unfinished', 'TaskUserController@oldUnfinishedTask')->name('tasks.unfinished');

    /*end tasks routes*/

    /*charges routes*/
    Route::resource('charges', 'ChargeController');
    Route::get('charges/user/index', 'ChargeController@UserCharges')->name('charges.user');
    Route::get('charges/supervisor/index', 'ChargeController@superVisorCharges')->name('charges.supervisor');
    Route::get('charges/add/log/{id}', 'ChargeController@getAddLog')->name('charges.getAddLog');
    Route::get('charges/destruct/index/', 'ChargeController@getDestruct')->name('charges.destruct.index');
    Route::post('charges/post/log/{id}', 'ChargeController@AddLog')->name('charges.AddLog');
    Route::get('charges/add/notes/{id}', 'ChargeController@getAddNotes')->name('charges.getAddNotes');
    Route::post('charges/post/notes/{id}', 'ChargeController@addNotes')->name('charges.addNotes');
    Route::post('charges/destruct/{id}', 'ChargeController@destruct')->name('charges.destruct');
    Route::post('charges/confirm', 'ChargeController@confirmCharge')->name('charges.confirm');
    /*end charge routes*/


    /*start clauses routes*/
    Route::resource('clauses', 'ClausesController');
    Route::get('clauses/user/index', 'ClausesController@userClauses')->name('clauses.user.index');
    Route::get('clauses/user/index', 'ClausesController@userClauses')->name('clauses.user.index');
    Route::get('clauses/add/log/{id}', 'ClausesController@getAddLog')->name('clauses.getAddLog');
    Route::post('clauses/post/log/{id}', 'ClausesController@AddLog')->name('clauses.AddLog');
    Route::patch('clauses/block/{clause}', 'ClausesController@block')->name('clauses.block');
    Route::patch('clauses/block/{clause}', 'ClausesController@block')->name('clauses.block');
    Route::get('clauses/user/change-numbers','ClausesController@getEnterNumbersPage')->name('clauses.change.numbers');
    Route::post('clauses/user/post/change-numbers','ClausesController@postChangeNunmbers')->name('clauses.post.change.numbers');
    /*end clauses routes*/

    Route::delete('note/{id}/delete','HomeController@deleteNote')->name('notes.destroy');
    Route::delete('images/{id}/delete','HomeController@deleteImage')->name('images.destroy');
    /*start  chat routes*/
    Route::get('private', 'HomeController@private')->name('private');
    Route::get('chat-users', 'HomeController@users')->name('chat-users');
    Route::get('private-messages/{user}', 'MessageController@privateMessages')->name('privateMessages');
    Route::post('private-messages/{user}', 'MessageController@sendPrivateMessage')->name('privateMessages.store');
    /*end  chat routes*/


    /*reports routes*/
    Route::get('reports/worker', 'ReportsController@getWorkerForm')->name('workerSearchForm');
    Route::get('reports/tasks', 'ReportsController@TaskSearch')->name('TaskSearch');
    Route::get('reports/worker/details', 'ReportsController@workerReport')->name('workerReport');
    /*end reports routes*/

    /*suppliers discards routes*/
//    Route::resource('/suppliers-discards','DiscardsController');
//    Route::post('/suppliers/discards/get-products','DiscardsController@getAjaxSupplierProducts')->name('getAjaxSupplierProducts');
    /*end suppliers discards routes*/


    /*suppliers bills routes*/
//    Route::resource('/suppliers-bills','SuppliersBillsController');
    /*end suppliers bills routes*/



    /*save token*/

    Route::resource('admin-notifications', 'AdminNotificationController')->only(['index', 'create', 'store']);
    route::get('my-notification','AdminNotificationController@myNotifications')->name('my.notifications');

    Route::post('firebase/token', 'HomeController@StoreFCMToken')->name('firebase.store');


}
);
