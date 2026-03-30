<?php

use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\UserController;
use App\Livewire\Admin\Auth\Login as LoginPage;
use App\Livewire\Admin\Dashboard\Index as DashboardIndex;
use App\Livewire\Admin\Media\Index as MediaIndex;
use App\Livewire\Admin\Profile\Index as ProfileIndex;
use App\Livewire\Admin\Settings\Index as SettingsIndex;
use App\Livewire\Admin\Users\Create as UsersCreate;
use App\Livewire\Admin\Users\Edit as UsersEdit;
use App\Livewire\Admin\Users\Index as UsersIndex;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', LoginPage::class)->name('login');
    Route::post('/login', [AuthController::class, 'loginProcess'])->name('login.process');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardIndex::class)->name('dashboard');
    Route::get('/media', MediaIndex::class)->name('media.index');
    Route::get('/users', UsersIndex::class)->name('users.index');
    Route::get('/users/create', UsersCreate::class)->name('users.create');
    Route::get('/users/{user}/edit', UsersEdit::class)->name('users.edit');
    Route::get('/profile', ProfileIndex::class)->name('profile');
    Route::get('/settings', SettingsIndex::class)->name('settings');

    Route::get('users/data', [UserController::class, 'data'])->name('users.data');

    Route::post('/profile/{user}', [UserController::class, 'profileUpdate'])->name('profile.update');
    Route::post('/users/{user}/update-pass', [UserController::class, 'userUpdatePassword'])->name('users.update_pass');
    Route::post('logout', [AuthController::class, 'destroy'])->name('logout');

    Route::resource('media', MediaController::class)->except(['index'])->parameters(['media' => 'media']);
    Route::resource('users', UserController::class)->except(['index', 'create', 'edit']);
});
