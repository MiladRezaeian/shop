<?php

namespace Modules\Account\app\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use Modules\Account\app\Contracts\Repositories\PermissionRepositoryInterface;
use Modules\Account\app\Contracts\Repositories\RoleRepositoryInterface;
use Modules\Account\app\Contracts\Repositories\UserRepositoryInterface;
use Modules\Account\app\Contracts\Services\UserServiceInterface;
use Modules\Account\app\Contracts\Services\PermissionServiceInterface;
use Modules\Account\app\Contracts\Services\RegisterServiceInterface;
use Modules\Account\app\Contracts\Services\RoleServiceInterface;
use Modules\Account\app\Http\Resources\UserResource;
use Modules\Account\app\Models\Permission;
use Modules\Account\app\Models\User;
use Modules\Account\app\Repositories\PermissionRepository;
use Modules\Account\app\Repositories\RoleRepository;
use Modules\Account\app\Repositories\UserRepository;
use Modules\Account\app\Services\PermissionService;
use Modules\Account\app\Services\RoleService;
use Modules\Account\app\Services\UserService;
use Modules\Account\database\seeders\PermissionRoleSeeder;
use Modules\Account\database\seeders\PermissionSeeder;
use Modules\Account\database\seeders\PermissionUserSeeder;
use Modules\Account\database\seeders\RoleSeeder;
use Modules\Account\database\seeders\RoleUserSeeder;
use Modules\Account\database\seeders\UserSeeder;
use Modules\BaseModuleProvider;
use Modules\Traits\DatabaseSeeders;

class AccountModuleProvider extends BaseModuleProvider
{

    use DatabaseSeeders;

    protected $seedersList = [
        UserSeeder::class,
        RoleSeeder::class,
        PermissionSeeder::class,
        PermissionUserSeeder::class,
        RoleUserSeeder::class,
        PermissionRoleSeeder::class,
    ];

    public function register()
    {
        parent::register();

        $this->registerServiceBindings();
        $this->registerRepositoryBindings();
    }

    public function boot()
    {
        parent::boot();

        $this->defineModelBindings();

        $this->definePermissions();
    }

    private function registerServiceBindings()
    {
        App::bind(UserServiceInterface::class, UserService::class);
        App::bind(RoleServiceInterface::class, RoleService::class);
        App::bind(PermissionServiceInterface::class, PermissionService::class);
    }

    private function registerRepositoryBindings()
    {
        App::bind(UserRepositoryInterface::class, UserRepository::class);
        App::bind(RoleRepositoryInterface::class, RoleRepository::class);
        App::bind(PermissionRepositoryInterface::class, PermissionRepository::class);
    }

    private function defineModelBindings()
    {
        Route::model('user', User::class);
    }

    private function definePermissions()
    {
        Permission::all()->map(function ($permission) {
            Gate::define($permission->name, function ($user) use ($permission) {
                return $user->hasPermission($permission);
            });
        });
    }

    protected function defineRoute(string $moduleBasePath): void
    {
        $this->loadRoutesFrom($moduleBasePath . '/routes/api/web/customer/v1.php');
        $this->loadRoutesFrom($moduleBasePath . '/routes/api/web/guest/v1.php');
        $this->loadRoutesFrom($moduleBasePath . '/routes/api/web/panel/v1.php');
    }

}
