<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class CustomMigrateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'migrate:all {r?} {runSeeder?}';
    protected $signature = 'migrate:module {dir=all} {--options=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This custom command run migrations in directories separated by folder
    and accept one argument and options (r, s and rs, other value will be ignored)';

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
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->warn($this->description);
        $this->warn('DIR DEFAULT ARGUMENT VALUE=all
        ' . 'DIR CURRENT ARGUMENT VALUE=' . $this->argument('dir'));
        $this->warn('Options:
        --options=r run migrate:fresh
        --options=s run seeders
        --options=rs run migrate:fresh --seed');

        $initialDefaultConnection = 'core';

        $dirs = scandir('database/migrations');
        unset($dirs[0]);
        unset($dirs[1]);

        foreach ($dirs as $key => $name) {
            if (str_contains($name, '.php')) {
                unset($dirs[$key]);
            }
        }

        $dirs = array_values($dirs);

        if ($this->argument('dir') != 'all') {
            $validate = $this->option('options') == 'r' || $this->option('options') == 'rs';
            $command = $validate ? 'migrate:fresh' : 'migrate';

            $appName = $this->argument('dir');
            Config::set('database.default', $appName);

            $connectionNames = array_map(function () use ($appName) {
                return in_array($appName, Config::get('database.connections'));
            }, Config::get('database.connections'));

            if (!key_exists($appName, $connectionNames)) {
                $flags = $this->setFlags($initialDefaultConnection, $appName);
                $command = 'migrate';
            } else {
                $flags = $this->setFlags($appName, $appName);
            }

            $this->info('Running migration for "' . $appName . '"');
            $this->call(
                $command,
                $flags
            );

            $this->runSeeders($appName);
        } else {
            foreach ($dirs as $key => $name) {
                $validate = $this->option('options') == 'r' || $this->option('options') == 'rs';
                $command = $validate ? 'migrate:fresh' : 'migrate';

                Config::set('database.default', $name);
                $connectionName = array_map(function () use ($name) {
                    return in_array($name, Config::get('database.connections'));
                }, Config::get('database.connections'));

                if (!key_exists($name, $connectionName)) {
                    $flags = $this->setFlags($initialDefaultConnection, $name);
                    $command = 'migrate';
                } else {
                    $flags = $this->setFlags($name, $name);
                }

                $this->info('Running migration for "' . $name . '"');
                $this->call(
                    $command,
                    $flags
                );

                $this->runSeeders($name);
                Config::set('database.default', 'core');
            }
        }
    }

    public function setFlags($dbName, $migrationName)
    {
        // if ($dbName == null) {
        //     dump('ON FLAG IF');
        //     return array(
        //         '--path' => 'database\\migrations\\' . $migrationName,
        //     );
        // }
        return array(
            '--database' => $dbName,
            '--path' => 'database\\migrations\\' . $migrationName,
        );
    }

    public function runSeeders($name)
    {
        if ($this->option('options') == 's' || $this->option('options') == 'rs') {
            $path = base_path('database\\seeders\\' . $name);
            $seederClasses = scandir($path);
            unset($seederClasses[0]);
            unset($seederClasses[1]);
            $seederClasses = array_values($seederClasses);

            foreach ($seederClasses as $key => $className) {
                if (basename($className, '.php') == 'DatabaseSeeder') {
                    $this->call(
                        'db:seed',
                        array(
                            '--class' => 'Database\\Seeders\\' . $name . '\\' . basename($className, '.php'),
                        )
                    );
                }
            }
        }
    }
}
