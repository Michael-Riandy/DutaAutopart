<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\UserAddress;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserAddress>
 */
class UserAddressFactory extends Factory
{
    protected $model = UserAddress::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
        ];
    }
}
