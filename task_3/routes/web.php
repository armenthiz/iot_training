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

Route::group(['middleware' => 'web'], function () {
    // HomeController
    Route::group(['namespace' => 'Home'], function () {
        Route::get('/', 'HomeController@index')->name('home.index');
        Route::get('image/{id}', 'HomeController@showImage')->name('home.showImage');
    });

    // Route to forgot the password
    Route::get('forgot-password', 'ReminderController@create')->name('reminders.create');
    Route::post('forgot-password', 'ReminderController@store')->name('reminders.store');

    // Route to reset the password
    Route::get('reset-password/{id}/{token}', 'ReminderController@edit')->name('reminders.edit');
    Route::post('reset-password/{id}/{token}', 'ReminderController@update')->name('reminders.update');

    // SessionController
    Route::group(['namespace' => 'Session'], function () {
        // Login
        Route::get('login', 'SessionController@login')->name('session.login');
        Route::post('login_store', 'SessionController@login_store')->name('session.login_store');
        Route::get('logout', 'SessionController@logout')->name('session.logout');

    });

    // UsersController (registering user)
    Route::group(['namespace' => 'User'], function () {
        // Register
        Route::get('register', 'UserController@register')->name('user.register');
        Route::post('register_store', 'UserController@register_store')->name('user.register_store');        
    });

    // ImagesController
    Route::group(['middleware' => 'sentinel'], function () {
        Route::resource('images', 'ImagesController');
    });
});