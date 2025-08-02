<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\products;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\products>
 */
class ProductsFactory extends Factory
{
    protected $model = products::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->word();
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph,
            'price' => $this->faker->numberBetween(10000, 100000),
            'quantity' => $this->faker->numberBetween(1, 100),
            'category_id' => 1, // sesuaikan jika ada relasi kategori
            'brand_id' => 1, // sesuaikan jika ada relasi brand
            'image' => 'default.jpg', // atau faker image jika ingin lebih lengkap
        ];
    }
}
