<?php

namespace Database\Factories;

use App\Enums\Status;
use App\Models\Merchant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Merchant>
 */
class MerchantFactory extends Factory
{
    protected $model = Merchant::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'trade_name' => fake()->name(),
            'document' => fake()->randomNumber(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'logo' => fake()->imageUrl(),
            'status' => Status::Active,
        ];
    }
}
