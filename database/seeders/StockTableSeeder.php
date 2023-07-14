<?php

namespace Database\Seeders;

use App\Models\Warehouse\Stock;
use Illuminate\Database\Seeder;

class StockTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ya que warehouse perteneco a la aplicación y no tiene una DB aparte,
        // se especifica la conexión 'core' a usar.
        // esto crea los registros en la DB smp_db
        Stock::factory()->count(10)->create();
    }
}
