<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'PageController@home')->name('home');