<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Pluralizer;
use Illuminate\Filesystem\Filesystem;


class MakeFacadeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:facade {app} {module} {layer} {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make an facade class';

    /**
     * Filesystem instance
     * @var Filesystem
     */
    protected $files;

    /**
     * Create a new command instance.
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $path = $this->getSourceFilePath();

        $this->makeDirectory(dirname($path));

        $contents = $this->getSourceFile();

        if (!$this->files->exists($path)) {
            $this->files->put($path, $contents);
            $this->info("File : {$path} created");
        } else {
            $this->info("File : {$path} already exits");
        }
        return 0;
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
     * Return the stub file path
     *
     * @return string
     */
    public function getStubPath()
    {
        return __DIR__ . '/../../../stubs/facade.stub';
    }

    /**
     * Map the stub variables present in stub to its value
     *
     * @return array
     */
    public function getStubVariables()
    {
        return [
            // 'NAMESPACE'         => $this->argument('namespace'), // The namespace should be builded in NewModuleCommand??
            // // at the same time, the new app namespace should be builded in the MakeNewAppCommand??
            'NAMESPACE'         => ucwords($this->argument('app')) . '\\' . ucwords($this->argument('module')),
            'LAYER_NAME'        => ucwords($this->argument('layer')),
            'CLASS_NAME'        => $this->getSingularClassName($this->argument('name')),
            'FACADE_ACCESSOR'   => strtolower($this->getSingularClassName($this->argument('name'))),
        ];
    }

    /**
     * Get the stub path and the stub variables
     *
     * @return bool|mixed|string
     */
    public function getSourceFile()
    {
        return $this->getStubContents($this->getStubPath(), $this->getStubVariables());
    }


    /**
     * Replace the stub variables(key) with the desire value
     *
     * @param $stub
     * @param array $stubVariables
     * @return bool|mixed|string
     */
    public function getStubContents($stub, $stubVariables = [])
    {
        $contents = file_get_contents($stub);

        foreach ($stubVariables as $search => $replace) {
            $contents = str_replace('{{ ' . $search . ' }}', $replace, $contents);
        }

        return $contents;
    }

    /**
     * Get the full path of generate class
     *
     * @return string
     */
    public function getSourceFilePath()
    {
        $appName = ucwords($this->argument('app'));
        $moduleName = ucwords($this->argument('module'));
        $layerName = ucwords($this->argument('layer'));

        return base_path($appName . '\\' . $moduleName . '\\' . $layerName)
            . '\\' . 'Facades' . '\\' . $this->getSingularClassName($this->argument('name')) . '.php';
    }

    /**
     * Build the directory for the class if necessary.
     *
     * @param  string  $path
     * @return string
     */
    protected function makeDirectory($path)
    {
        if (!$this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 7777, true, true);
        }

        return $path;
    }
}