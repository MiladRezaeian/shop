<?php

namespace Modules;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class BaseModuleProvider extends ServiceProvider
{

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

    protected function defineRoute(string $moduleBasePath): void {}

    private function registerDatabaseSeeders()
    {
        if (property_exists($this, "seedersList")) {
            DatabaseSeeder::addSeeders($this->seedersList);
        }
    }

}
