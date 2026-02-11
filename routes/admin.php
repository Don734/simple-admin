<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', 'PageController@dashboard')->name('dashboard');
Route::get('/profile', 'PageController@profile')->name('profile');
Route::get('/settings', 'PageController@settings')->name('settings');

Route::post('/profile/{user}', 'UserController@profileUpdate')->name('profile.update');
Route::post('/users/{user}/update-pass', 'UserController@userUpdatePassword')->name('users.update_pass');

Route::resource('users', 'UserController');