<?php

namespace Modules;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class BaseModuleProvider extends ServiceProvider
{
    public function register()
    {
        $moduleName = Str::betweenFirst(get_class($this), '\\', '\\');
        $moduleNameLowercase = strtolower($moduleName);
        $moduleBasePath = __DIR__ . '/' . $moduleName;

        $this->loadRoutesFrom($moduleBasePath . '/routes/api/web/customer/v1.php');
        $this->loadRoutesFrom($moduleBasePath . '/routes/api/web/guest/v1.php');
        $this->loadRoutesFrom($moduleBasePath . '/routes/api/web/panel/v1.php');

        $this->loadMigrationsFrom($moduleBasePath . '/database/migrations');
        $this->mergeConfigFrom($moduleBasePath . "/config/$moduleNameLowercase.php", $moduleNameLowercase);
        $this->loadTranslationsFrom($moduleBasePath . '/resources/lang', $moduleNameLowercase);
    }
}
