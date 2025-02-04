<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $repositoryClassName = $this->getRepositoryClassName($name);
        $namespace = $this->getNamespace($name);
        $modelName = $this->getModelName($repositoryClassName);

        $repositoryPath = $this->getRepositoryPath($name);

        if (File::exists($repositoryPath)) {
            $this->error("Repository class {$repositoryClassName} already exists.");
            return Command::FAILURE;
        }

        if (!File::isDirectory(dirname($repositoryPath))) {
            File::makeDirectory(dirname($repositoryPath), 0755, true);
        }

        $stub = $this->generateStub($namespace, $repositoryClassName, $modelName);

        File::put($repositoryPath, $stub);

        $this->info("Repository class {$repositoryClassName} created successfully.");
        return Command::SUCCESS;
    }

    /**
     * Get the repository class name from the input.
     *
     * @param string $name
     * @return string
     */
    protected function getRepositoryClassName($name)
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
        return $namespace !== '.' ? 'App\\Repositories\\' . $namespace : 'App\\Repositories';
    }

    /**
     * Get the model name from the repository class name.
     *
     * @param string $repositoryClassName
     * @return string
     */
    protected function getModelName($repositoryClassName)
    {
        return str_replace('Repository', '', $repositoryClassName);
    }

    /**
     * Get the repository file path.
     *
     * @param string $name
     * @return string
     */
    protected function getRepositoryPath($name)
    {
        $repositoryClassName = $this->getRepositoryClassName($name);
        $namespace = dirname(str_replace('/', '\\', $name));
        $directory = $namespace !== '.' ? app_path('Repositories/' . str_replace('\\', '/', $namespace)) : app_path('Repositories');
        return $directory . '/' . $repositoryClassName . '.php';
    }

    /**
     * Generate the repository stub.
     *
     * @param string $namespace
     * @param string $repositoryClassName
     * @param string $modelName
     * @return string
     */
    protected function generateStub($namespace, $repositoryClassName, $modelName)
    {
        return <<<PHP
        <?php

        namespace {$namespace};

        use App\Models\\{$modelName};
        use Prettus\Repository\Eloquent\BaseRepository;

        class {$repositoryClassName} extends BaseRepository
        {
            protected \$model;

            public function __construct()
            {
                \$this->model = new {$modelName}();
            }

            /**
             * Specify the model class name.
             *
             * @return string
             */
            public function model()
            {
                return \$this->model;
            }
        }
        PHP;
    }
}