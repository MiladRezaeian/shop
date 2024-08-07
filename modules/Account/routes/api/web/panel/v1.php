<?php

use Illuminate\Support\Facades\Route;
use Modules\Account\app\Http\Controllers\Api\Web\Panel\V1\UserController;
use Modules\Account\app\Http\Controllers\Api\Web\Panel\V1\PermissionController;
use Modules\Account\app\Http\Controllers\Api\Web\Panel\V1\RoleController;
use Modules\Account\app\Http\Middleware\LoginRequiredMiddleware;

Route::prefix('api/web/panel/v1/')
    ->middleware(LoginRequiredMiddleware::class, 'api')
    ->name('api.web.panel.v1.')
    ->as('api.web.panel.v1.')
    ->group(function () {

        //user
        Route::prefix('users')
            ->name('users.')
            ->as('users.')
            ->group(function (): void {

                Route::post('/search', [UserController::class, 'search'])->name('search');

                Route::get('/', [UserController::class, 'index'])->name('index');
                Route::post('/', [UserController::class, 'store'])->name('store');
                Route::get('/{user}', [UserController::class, 'show'])->whereNumber('user')->name('show');
                Route::post('/{user}', [UserController::class, 'update'])->whereNumber('user')->name('update');
                Route::delete('/{user}', [UserController::class, 'destroy'])->whereNumber('user')->name('destroy');

                Route::post('/{user}/upload-image', [UserController::class, 'uploadImage'])->whereNumber('user')->name('image.upload');

            });

        //role
        Route::prefix('roles')
            ->name('roles.')
            ->as('roles.')
            ->group(function (): void {

                Route::get('/', [RoleController::class, 'index'])->name('index');
                Route::post('/', [RoleController::class, 'store'])->name('store');
                Route::get('/{role}', [RoleController::class, 'show'])->whereNumber('role')->name('show');
                Route::post('/{role}', [RoleController::class, 'update'])->whereNumber('role')->name('update');
                Route::delete('/{role}', [RoleController::class, 'destroy'])->whereNumber('role')->name('destroy');

            });

        //permission
        Route::prefix('permissions')
            ->name('permissions.')
            ->as('permissions.')
            ->group(function (): void {

                Route::get('/', [PermissionController::class, 'index'])->name('index');
                Route::post('/', [PermissionController::class, 'store'])->name('store');
                Route::get('/{permission}', [PermissionController::class, 'show'])->whereNumber('permission')->name('show');
                Route::post('/{permission}', [PermissionController::class, 'update'])->whereNumber('permission')->name('update');
                Route::delete('/{permission}', [PermissionController::class, 'destroy'])->whereNumber('permission')->name('destroy');

            });

    });
