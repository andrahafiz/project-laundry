<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feedback>
 */
class FeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'customer_name' => fake()->name(),
            'nohp_customer' =>  fake()->phoneNumber(),
            'user_id' => User::factory()->create()->id,
            'transactions_id' =>  Transaction::factory()->create()->id,
            'description' => fake()->paragraph(1),
        ];
    }
}
