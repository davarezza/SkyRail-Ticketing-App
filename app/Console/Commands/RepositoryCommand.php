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
        $repositoryClassName = $name;
        
        $modelName = str_replace('Repository', '', $repositoryClassName);

        $repositoryPath = app_path("Repositories/{$repositoryClassName}.php");

        if (File::exists($repositoryPath)) {
            $this->error("Repository class {$repositoryClassName} already exists.");
            return Command::FAILURE;
        }

        if (!File::isDirectory(app_path('Repositories'))) {
            File::makeDirectory(app_path('Repositories'), 0755, true);
        }

        $stub = <<<PHP
        <?php

        namespace App\Repositories;

        use Prettus\Repository\Eloquent\BaseRepository;
        use App\Models\{$modelName};

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
                return get_class(\$this->model);
            }

            /**
             * Boot up the repository, pushing criteria.
             *
             * @throws \Prettus\Repository\Exceptions\RepositoryException
             */
            public function boot()
            {
                // Add your boot logic here
            }
        }
        PHP;

        File::put($repositoryPath, $stub);

        $this->info("Repository class {$repositoryClassName} created successfully.");
        return Command::SUCCESS;
    }
}