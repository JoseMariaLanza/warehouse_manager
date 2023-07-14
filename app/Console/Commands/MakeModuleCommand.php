<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Pluralizer;

class MakeModuleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {app} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ceates module structure';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Return the Singular Capitalize Name
     *
     * @param $name
     * @return string
     */
    public function getSingularClassName($name)
    {
        return ucwords(Pluralizer::singular($name));
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->createInfrastructureLayer();
        $this->createApplicationLayer();
        $this->createDomainLayer();
        return 0;
    }

    private function createInfrastructureLayer()
    {
        $app = $this->argument('app');
        $module = $this->argument('module');
        $layer = 'Infrastructure';
        $name = $this->getSingularClassName($this->argument('module'));
        $this->call('make:interface', [
            'app'       => $app,
            'module'    => $module,
            'layer'     => $layer,
            'name'      => $name
        ]);
        $this->call('make:facade', [
            'app'       => $app,
            'module'    => $module,
            'layer'     => $layer,
            'name'      => $name
        ]);
        $this->call('make:validation', [
            'app'       => $app,
            'module'    => $module,
            'layer'     => $layer,
            'name'      => $name
        ]);
    }
    private function createApplicationLayer()
    {
        $app = $this->argument('app');
        $module = $this->argument('module');
        $layer = 'Application';
        $name = $this->getSingularClassName($this->argument('module'));
        $this->call('make:usecase', [
            'app'       => $app,
            'module'    => $module,
            'layer'     => $layer,
            'name'      => $name
        ]);
    }
    private function createDomainLayer()
    {
        $app = $this->argument('app');
        $module = $this->argument('module');
        $layer = 'Domain';
        $name = $this->getSingularClassName($this->argument('module'));
        $this->call('make:service', [
            'app'       => $app,
            'module'    => $module,
            'layer'     => $layer,
            'name'      => $name
        ]);
        $this->call('make:repository', [
            'app'       => $app,
            'module'    => $module,
            'layer'     => $layer,
            'name'      => $name
        ]);
    }
}
