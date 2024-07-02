<?php

use Illuminate\Support\Facades\Route;
use Modules\Account\app\Http\Controllers\Api\Web\Guest\Auth\LoginController;


Route::group([

    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout']);
    Route::post('refresh', [LoginController::class, 'refresh']);
    Route::post('me', [LoginController::class, 'me']);

});
