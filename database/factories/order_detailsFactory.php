<?php

namespace Database\Factories;
use App\Models\order_details;
use App\Models\orders;
use App\Models\products;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\order_details>
 */
class order_detailsFactory extends Factory
{
    protected $model = order_details::class;

    public function definition(): array
    {
        return [
            'order_id' => orders::factory(),
            'product_id' => products::factory(),
            'price' => $this->faker->numberBetween(1000, 10000),
            'quantity' => $this->faker->numberBetween(1, 5),
        ];
    }
}
