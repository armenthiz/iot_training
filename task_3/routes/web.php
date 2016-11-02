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

    // SessionController
    Route::group(['namespace' => 'Session'], function () {
        // Login
        Route::get('login', 'SessionController@login')->name('session.login');
        Route::post('login_store', 'SessionController@login_store')->name('session.login_store');
        Route::get('logout', 'SessionController@logout')->name('session.logout');

        // Register
        Route::get('register', 'SessionController@register')->name('session.register');
        Route::post('register_store', 'SessionController@register_store')->name('session.register_store');
    });

    // ImagesController
    Route::group(['middleware' => 'sentinel'], function () {
        Route::resource('images', 'ImagesController');
    });
});