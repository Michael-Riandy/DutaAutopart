<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\User;
use App\Models\orders;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'order_id' => orders::factory(),
            'mode' => 'cod',
            'status' => 'pending',
            'snap_token' => 'dummy-token-cod',
        ];
    }
}
