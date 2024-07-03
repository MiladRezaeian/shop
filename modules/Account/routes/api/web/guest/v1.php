<?php

use Illuminate\Support\Facades\Route;
use Modules\Account\app\Http\Controllers\Api\Web\Guest\Auth\LoginController;
use Modules\Account\app\Http\Controllers\Api\Web\Guest\Auth\RegisterController;

Route::group([

    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout']);
    Route::post('refresh', [LoginController::class, 'refresh']);
    Route::post('me', [LoginController::class, 'me']);

    Route::post('register', [RegisterController::class, 'register'])->name('register');

});
