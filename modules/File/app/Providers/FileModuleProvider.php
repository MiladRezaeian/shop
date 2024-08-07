<?php

namespace Modules\File\app\Providers;

use Illuminate\Support\Facades\App;


use Modules\BaseModuleProvider;
use Modules\File\app\Contracts\Repositories\FileRepositoryInterface;
use Modules\File\app\Contracts\Services\FileServiceInterface;
use Modules\File\app\Contracts\Services\StorageManagerInterface;
use Modules\File\app\Repositories\FileRepository;
use Modules\File\app\Services\FileService;
use Modules\File\app\Services\StorageManagerService;

class FileModuleProvider extends BaseModuleProvider
{

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
        App::bind(FileServiceInterface::class, FileService::class);
        App::bind(StorageManagerInterface::class, StorageManagerService::class);
    }

    private function registerRepositoryBindings()
    {
        App::bind(FileRepositoryInterface::class, FileRepository::class);
    }

    private function defineModelBindings()
    {

    }

    private function definePermissions()
    {

    }

    protected function defineRoute(string $moduleBasePath): void
    {
        $this->loadRoutesFrom($moduleBasePath . '/routes/api/web/panel/v1.php');
    }

}
