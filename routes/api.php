<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/register', [RegisterController::class, 'register']);

Route::controller(LoginController::class)->group(function() {
    Route::post('/login', 'login')->name('login');
});

Route::group(['middleware' => ['auth:api', 'check.jwt_version']], function () {
    Route::put('/change-password', [LoginController::class, 'changePassword']);
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::get('/homes', [PermissionController::class, 'findByUserId'])->name('home');
    Route::get('/roles', [RoleController::class, 'findByUserId'])->name('role');
});
