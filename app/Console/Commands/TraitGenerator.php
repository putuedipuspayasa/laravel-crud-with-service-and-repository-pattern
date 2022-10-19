<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TraitGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:trait {name : Name of trait}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Making trait for design pattern';

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
        return file_get_contents(resource_path('stubs/Trait.stub'));
    }

    public function generate($name)
    {
        $fileName = basename($name);
        $template = str_replace([
                '{{traitName}}',
                '{{variableName}}'
            ],
            [
                $fileName,
                lcfirst(str_replace('Trait', '', $fileName)),
                str_replace('Trait', '', $fileName)
            ],
            $this->getStub('Trait')
        );

        $path   = app_path('/Traits');
        if (!file_exists($path)) {
            mkdir($path, $mode = 0755, true);
        }


        file_exists($path . "/{$name}.php") ?
            $this->info($fileName . ' is already exist!') :
            file_put_contents(
                $path . "/" . $name . ".php",
                $template
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

        $this->generate($name);
        $this->info($this->argument('name') . ' has created successfully!');
    }
}
