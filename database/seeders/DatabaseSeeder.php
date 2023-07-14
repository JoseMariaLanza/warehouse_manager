<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // Role::factory()->create();
        // Rermission::factory()->create();
        // $this->call([
        //     RoleTableSeeder::class,
        //     PermissionTableSeeder::class
        // ]);
        $this->call([
            UserTableSeeder::class
        ]);
        $this->call([
            StockTableSeeder::class
        ]);
        $this->call([
            RolePermissionSeeder::class
        ]);
    }

    // public function setConnection($name)
    // {
    //     $connection = Config::get('database.default');
    //     if (in_array($name, Config::get('database.connections'))) {
    //         Config::set('default', $name);
    //     }
    // }
}
