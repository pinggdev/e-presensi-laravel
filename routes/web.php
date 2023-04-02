<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/', [DashboardController::class, 'index']);
Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {
    Route::resource('users', UserController::class);
});

Route::group(['middleware' => ['auth']], function () {
    Route::resource('presences', PresenceController::class);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
