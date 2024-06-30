<?php

use Illuminate\Support\Facades\Route;
use Modules\Account\app\Http\Controllers\Api\Web\Panel\V1\AccountController;

/********************* public routes ******************************/
Route::prefix('api/web/customer/v1/')
    ->name('api.web.customer.v1.')
    ->as('api.web.customer.v1.')
    ->group(function () {

        //shop
        Route::prefix('account')
            ->name('account.')
            ->as('account.')
            ->group(function (): void {

                Route::get('/test', [AccountController::class, 'index'])->name('index');

            });
    });
