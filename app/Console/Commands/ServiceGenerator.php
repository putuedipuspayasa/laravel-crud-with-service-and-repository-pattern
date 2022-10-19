<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ServiceGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name : Name of service}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Making service for design pattern';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    protected function getStub()
    {
        return file_get_contents(resource_path('stubs/Service.stub'));
    }

    public function generateService($name)
    {
        $fileName = basename($name);
        $serviceTemplate = str_replace([
                '{{serviceName}}',
                '{{variableName}}'
            ],
            [
                $fileName,
                lcfirst(str_replace('Service', '', $fileName)),
                str_replace('Service', '', $fileName)
            ],
            $this->getStub('Service')
        );

        $path   = app_path('/Services');
        if (!file_exists($path)) {
            mkdir($path, $mode = 0755, true);
        }


        file_exists($path . "/{$name}.php") ?
            $this->info($fileName . ' is already exist!') :
            file_put_contents(
                $path . "/" . $name . ".php",
                $serviceTemplate
            );
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');

        $this->generateService($name);
        $this->info($this->argument('name') . ' has created successfully!');
    }

}
