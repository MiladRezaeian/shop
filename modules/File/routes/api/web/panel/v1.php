<?php

use Illuminate\Support\Facades\Route;
use Modules\Account\app\Http\Middleware\LoginRequiredMiddleware;
use Modules\File\app\Http\Controllers\Api\Web\Panel\V1\FileController;

Route::prefix('api/web/panel/v1/')
    ->middleware(LoginRequiredMiddleware::class, 'api')
    ->name('api.web.panel.v1.')
    ->as('api.web.panel.v1.')
    ->group(function () {

        //file
        Route::prefix('files')
            ->name('files.')
            ->as('files.')
            ->group(function (): void {

                Route::post('/', [FileController::class, 'store'])->name('store');
                Route::get('/{file}', [FileController::class, 'show'])->name('show');

            });

    });
