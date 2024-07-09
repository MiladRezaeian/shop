<?php

namespace Modules;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Modules\Account\app\Providers\Traits\DatabaseSeeders;

class BaseModuleProvider extends ServiceProvider
{
    use DatabaseSeeders;

    public function register()
    {
        $moduleName = Str::betweenFirst(get_class($this), '\\', '\\');
        $moduleNameLowercase = strtolower($moduleName);
        $moduleBasePath = __DIR__ . '/' . $moduleName;

        if(! $this->app->routesAreCached()) {
            $this->defineRoute($moduleBasePath);
        }

        $this->loadMigrationsFrom($moduleBasePath . '/database/migrations');
        $this->mergeConfigFrom($moduleBasePath . "/config/$moduleNameLowercase.php", $moduleNameLowercase);
        $this->loadTranslationsFrom($moduleBasePath . '/resources/lang', $moduleNameLowercase);
        $this->registerDatabaseSeeders();
    }

    public function boot()
    {
//        $moduleName = Str::betweenFirst(get_class($this), '\\', '\\');
//        $moduleNameLowercase = strtolower($moduleName);
//        $moduleBasePath = __DIR__ . '/' . $moduleName;


//        app(Factory::class)->load($moduleBasePath . '/database/factories');
    }

    private function defineRoute(string $moduleBasePath): void
    {
        $this->loadRoutesFrom($moduleBasePath . '/routes/api/web/customer/v1.php');
        $this->loadRoutesFrom($moduleBasePath . '/routes/api/web/guest/v1.php');
        $this->loadRoutesFrom($moduleBasePath . '/routes/api/web/panel/v1.php');
    }

    private function registerDatabaseSeeders()
    {
        DatabaseSeeder::addSeeders($this->defineSeeders());
    }

}
