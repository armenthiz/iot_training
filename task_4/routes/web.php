<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['middleware' => ['web']], function () {
    // The main index route
    Route::get('/', function() { return view('welcome'); })->name('root');

    // Route for Registering User
    Route::get('signup', 'UsersController@signup')->name('signup');
    Route::post('signup', 'UsersController@signup_store')->name('signup.store');

    // Route for Signing User
    Route::get('login', 'SessionsController@login')->name('login');
    Route::post('login', 'SessionsController@login_store')->name('login.store');

    // Route for Signout User
    Route::get('logout', 'SessionsController@logout')->name('logout');

    // Route to forgot the password
    Route::get('forgot-password', 'ReminderController@create')->name('reminders.create');
    Route::post('forgot-password', 'ReminderController@store')->name('reminders.store');

    // Route to reset the password
    Route::get('reset-password/{id}/{token}', 'ReminderController@edit')->name('reminders.edit');
    Route::post('reset-password/{id}/{token}', 'ReminderController@update')->name('reminders.update');

    // Route to access sentinel middlewared 
    Route::group(['namespace' => 'Admin', 'middleware' => ['sentinel', 'sentinel.role']], function () {
        // Route to access article route
        Route::resource('articles', 'ArticlesController');

        // Route to storing excel files
        Route::post('articles/storeExcel', 'ArticlesController@storeExcel')->name('articles.storeExcel');

        // Route to export pdf or excel
        Route::get('articles/{id}/pdf', 'ArticlesController@showExportPdf')->name('articles.showExportPdf');
        Route::get('articles/{id}/excel', 'ArticlesController@showExportExcel')->name('articles.showExportExcel');

        // Route to storing comment
        Route::resource('comments', 'CommentsController', ['only' => 'store']);
    });
});
