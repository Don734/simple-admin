<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest'], 'namespace' => 'Auth'], function () {
    Route::get('/login', 'AuthController@login')->name('login');
    Route::post('/login', 'AuthController@loginProcess')->name('login.process');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', 'PageController@dashboard')->name('dashboard');
    Route::get('/profile', 'PageController@profile')->name('profile');
    Route::get('/settings', 'PageController@settings')->name('settings');

    Route::get('users/data', 'UserController@data')->name('users.data');

    Route::post('/profile/{user}', 'UserController@profileUpdate')->name('profile.update');
    Route::post('/users/{user}/update-pass', 'UserController@userUpdatePassword')->name('users.update_pass');

    Route::resource('users', 'UserController');
});
