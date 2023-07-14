<?php

namespace Database\Factories\Customers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'purchased_plan' => 'Mid',
            'modules' => 'Shifts|Warehouse',
            'is_active' => true,
            'expiration_date' => Carbon::create('2022-03-12'),
            'alternative_email' => 'lanza.josemaria@gmail.com',
            'erp_user' => null,
            'erp_code' => null,
        ];
    }
}
