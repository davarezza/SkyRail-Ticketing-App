<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ServiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $serviceClassName = $this->getServiceClassName($name);
        $namespace = $this->getNamespace($name);
        $repositoryClassName = $this->getRepositoryClassName($serviceClassName);

        $servicePath = $this->getServicePath($name);

        if (File::exists($servicePath)) {
            $this->error("Service class {$serviceClassName} already exists.");
            return Command::FAILURE;
        }

        if (!File::isDirectory(dirname($servicePath))) {
            File::makeDirectory(dirname($servicePath), 0755, true);
        }

        $stub = $this->generateStub($namespace, $serviceClassName, $repositoryClassName);

        File::put($servicePath, $stub);

        $this->info("Service class {$serviceClassName} created successfully.");
        return Command::SUCCESS;
    }

    /**
     * Get the service class name from the input.
     *
     * @param string $name
     * @return string
     */
    protected function getServiceClassName($name)
    {
        return class_basename($name);
    }

    /**
     * Get the namespace from the input.
     *
     * @param string $name
     * @return string
     */
    protected function getNamespace($name)
    {
        $namespace = dirname(str_replace('/', '\\', $name));
        return $namespace !== '.' ? 'App\\Services\\' . $namespace : 'App\\Services';
    }

    /**
     * Get the repository class name from the service class name.
     *
     * @param string $serviceClassName
     * @return string
     */
    protected function getRepositoryClassName($serviceClassName)
    {
        return str_replace('Service', '', $serviceClassName) . 'Repository';
    }

    /**
     * Get the service file path.
     *
     * @param string $name
     * @return string
     */
    protected function getServicePath($name)
    {
        $serviceClassName = $this->getServiceClassName($name);
        $namespace = dirname(str_replace('/', '\\', $name));
        $directory = $namespace !== '.' ? app_path('Services/' . str_replace('\\', '/', $namespace)) : app_path('Services');
        return $directory . '/' . $serviceClassName . '.php';
    }

    /**
     * Generate the service stub.
     *
     * @param string $namespace
     * @param string $serviceClassName
     * @param string $repositoryClassName
     * @return string
     */
    protected function generateStub($namespace, $serviceClassName, $repositoryClassName)
    {
        return <<<PHP
        <?php

        namespace {$namespace};

        use App\Repositories\\{$repositoryClassName};
        use App\Core\BaseResponse;
        use Illuminate\Support\Facades\DB;

        class {$serviceClassName}
        {
            protected \$repository;

            public function __construct()
            {
                \$this->repository = new {$repositoryClassName}();
            }
        }
        PHP;
    }
}