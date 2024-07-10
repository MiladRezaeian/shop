<?php

use Illuminate\Support\Facades\Route;
use Modules\Account\app\Http\Controllers\Api\Web\Panel\V1\UserController;
use Modules\Account\app\Http\Controllers\Api\Web\Panel\V1\PermissionController;
use Modules\Account\app\Http\Controllers\Api\Web\Panel\V1\RoleController;
use Modules\Account\app\Http\Middleware\LoginRequiredMiddleware;
use Modules\Account\app\Models\User;

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

                Route::post('/search', [UserController::class, 'search'])->name('users.search');

                Route::get('/', [UserController::class, 'index'])->name('users.index');
                Route::post('/', [UserController::class, 'store'])->name('users.store');
                Route::get('/{user}', [UserController::class, 'show'])->name('users.show');
                Route::post('/{user}', [UserController::class, 'update'])->name('users.update');
                Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');


            });

        //role
        Route::prefix('roles')
            ->name('roles.')
            ->as('roles.')
            ->group(function (): void {

                Route::get('/', [RoleController::class, 'index'])->name('roles.index');
                Route::post('/', [RoleController::class, 'store'])->name('roles.store');
                Route::get('/{role}', [RoleController::class, 'show'])->name('roles.show');
                Route::post('/{role}', [RoleController::class, 'update'])->name('roles.update');
                Route::delete('/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

            });

        //permission
        Route::prefix('permissions')
            ->name('permissions.')
            ->as('permissions.')
            ->group(function (): void {

                Route::get('/', [PermissionController::class, 'index'])->name('permissions.index');
                Route::post('/', [PermissionController::class, 'store'])->name('permissions.store');
                Route::get('/{permission}', [PermissionController::class, 'show'])->name('permissions.show');
                Route::post('/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
                Route::delete('/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');

            });

    });
