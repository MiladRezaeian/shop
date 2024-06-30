<?php

namespace App\Console\Commands\Generators;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GenerateModule extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:module {name} {--v=1} {--noHttp}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'for create module directory';


    private string $modulePath;
    private string $moduleName;
    private string $version;
    private bool $noHttp;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->modulePath = base_path() . DIRECTORY_SEPARATOR . 'modules';
    }

    public function handle()
    {
        $this->setProperties();

        $this->createModuleDirectory();

        $directoryLists = $this->getDirectoryLists();

        $modulePath = $this->modulePath . DIRECTORY_SEPARATOR . Str::ucfirst($this->moduleName);

        $this->createDirectories($modulePath, $directoryLists);

        $this->generateFiles($modulePath);

    }

    public function setProperties(): void
    {
        $this->moduleName = (string)$this->argument('name');
        $this->version = (string)$this->option('v');
        $this->noHttp = $this->option('noHttp') ?: false;
    }

    public function createDirectories(string $parentPath, array $directories = [])
    {

        if (!File::exists($parentPath)) {
            File::makeDirectory($parentPath, 0777);
        }

        foreach ($directories as $key => $directory) {
            if (is_array($directory)) {
                $subDirectory = $parentPath . DIRECTORY_SEPARATOR . $key;
                $this->createDirectories($subDirectory, $directory);
            } elseif (is_string($directory)) {
                $subDirectory = $parentPath . DIRECTORY_SEPARATOR . $directory;
                File::makeDirectory($subDirectory, 0777);
            }

        }

    }

    public function getDirectoryLists(): array
    {
        $directoryLists = [
            'Config',
            'Contract',
            'Database' => ['Migrations', 'Factories', 'Seeders'],
            'resources' => [
                'lang' => ['fa']
            ],
            'exceptions',
            'facades',
            'Models',
            'Repositories',
            'Services'
        ];

        if (!$this->noHttp) {
            $directoryLists['Http'] = [
                'Controllers' => [
                    'API' => [
                        'Web' => [
                            'Customer' => ['V' . $this->version]
                        ]
                    ],
                ],
                'Requests' => [
                    'API' => [
                        'Web' => [
                            'Customer' => ['V' . $this->version]
                        ]
                    ],
                ],
                'Transformers' => [
                    'API' => [
                        'Web' => [
                            'Customer' => ['V' . $this->version]
                        ]
                    ],
                ],
            ];
        }

        return $directoryLists;
    }

    public function generateFiles(string $modulePath): void
    {
        $dummyModuleProviderContent = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'Stubs' . DIRECTORY_SEPARATOR . 'dummy.module.provider.stub');
        $moduleProviderContent = str_replace('dummy', Str::ucfirst($this->moduleName), $dummyModuleProviderContent);

        file_put_contents($modulePath . DIRECTORY_SEPARATOR . Str::ucfirst($this->moduleName) . 'ModuleProvider.php', $moduleProviderContent);
        file_put_contents($modulePath . DIRECTORY_SEPARATOR . 'readme.md', '');

        $dummyConfigFile = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'Stubs' . DIRECTORY_SEPARATOR . 'dummy.config.file.stub');
        file_put_contents($modulePath . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . Str::lower($this->moduleName) . '.php', $dummyConfigFile);
    }


    public function createModuleDirectory(): void
    {
        if (!File::exists($this->modulePath)) {
            File::makeDirectory($this->modulePath);
        }
    }
}
