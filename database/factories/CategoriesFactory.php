<?php

namespace Database\Factories;

use App\Models\categories;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\categories>
 */
class CategoriesFactory extends Factory
{
    protected $model = categories::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'slug' => Str::slug($this->faker->name),
        ];
    }
}
