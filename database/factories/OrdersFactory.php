<?php

namespace Database\Factories;

use App\Models\orders;
use App\Models\User;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\orders>
 */
class OrdersFactory extends Factory
{
    protected $model = orders::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->name,                           
            'phone' => $this->faker->numerify('08##########'), 
            'address' => $this->faker->text(30),               
            'city' => $this->faker->city,                           
            'subtotal' => $this->faker->numberBetween(10000, 50000),
            'total' => $this->faker->numberBetween(50000, 100000),
            'status' => 'ordered',
        ];
    }
}
