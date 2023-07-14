<?php

namespace Database\Seeders\warehouse;

use Database\Seeders\warehouse\StockTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            StockTableSeeder::class
        ]);
    }
}
