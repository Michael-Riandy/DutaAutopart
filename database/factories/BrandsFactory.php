<?php

namespace Database\Factories;
use App\Models\brands;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\brands>
 */
class BrandsFactory extends Factory
{
    protected $model = brands::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'slug' => Str::slug($this->faker->name),
        ];
    }
}
