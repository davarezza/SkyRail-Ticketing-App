<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\File;

use Illuminate\Console\Command;

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
        $servicePath = app_path("Services/{$name}.php");

        if (File::exists($servicePath)) {
            $this->error("Service class {$name} already exists.");
            return Command::FAILURE;
        }

        if (!File::isDirectory(app_path('Services'))) {
            File::makeDirectory(app_path('Services'), 0755, true);
        }

        $stub = <<<PHP
        <?php

        namespace App\Services;

        class {$name}
        {
            public function __construct()
            {
                // Constructor logic here
            }
        }
        PHP;

        File::put($servicePath, $stub);

        $this->info("Service class {$name} created successfully.");
        return Command::SUCCESS;
    }
}
