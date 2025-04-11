<?php

use App\Http\Controllers\Auth\Admin\AuthAdminController;
use App\Http\Controllers\Auth\Company\AuthCompanyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('admin')->group(function () {
    Route::post('register', [AuthAdminController::class, 'register']);
    Route::post('login', [AuthAdminController::class, 'login']);
});

Route::prefix('company')->group(function () {
    Route::post('/register', [AuthCompanyController::class, 'register']);
    Route::post('/login', [AuthCompanyController::class, 'login']);
});

