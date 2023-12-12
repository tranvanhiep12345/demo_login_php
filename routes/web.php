<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;

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
Route::get('/', function () {
    return view('welcome');
});
//Route::controller(RegisterController::class)->group(function() {
//    Route::get('/register', 'register')->name('register');
//    Route::post('/store', 'store')->name('store');
//});
//Route::controller(LoginController::class)->group(function() {
//    Route::get('/login', 'login')->name('login');
////    Route::post('/authenticate', 'authenticate')->name('authenticate');
//    Route::get('/dashboard', 'dashboard')->name('dashboard');
//    Route::get('/home', [PermissionController::class, 'index'])->name('home');
//    Route::get('/role', [RoleController::class, 'index'])->name('role');
//    Route::post('/logout', 'logout')->name('logout');
//});
