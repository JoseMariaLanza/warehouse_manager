<?php

namespace Database\Seeders\customers;

use App\Models\Customers\User;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ya que customers no perteneco a 'core' y tiene una conexión definida,
        // se especifica la conexión a usar (customers) para que cree los
        // registros en la DB customers_db
        User::factory()->connection('customers')->count(1)->create();
    }
}
