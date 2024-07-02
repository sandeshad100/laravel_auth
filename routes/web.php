<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\TestUser;
use App\Http\Middleware\ValidUser;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('register', 'register')->name('register');
Route::post('registerSave', [UserController::class, 'register'])->name('registerSave');
Route::view('login', 'login')->name('login');
Route::post('loginMatch', [UserController::class, 'login'])->name('loginMatch');

//middleware groups
Route::middleware([ValidUser::class.':admin', TestUser::class])->group(function () {
    Route::get('dashboard', [UserController::class, 'dashboardPage'])->name('dashboard');
});

//   Route::get('dashboard', [UserController::class, 'dashboardPage'])->name('dashboard')->middleware([ValidUser::class, TestUser::class]);

Route::get('logout', [UserController::class, 'logout'])->name('logout');
Route::get('guest', [UserController::class, 'guestPage'])->name('guest');
