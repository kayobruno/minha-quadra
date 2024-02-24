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
        $defaultBusinessHours = [
            'friday' => [
              'open' => '08:00',
              'close' => '23:00',
            ],
            'monday' => [
              'open' => '08:00',
              'close' => '23:00',
            ],
            'sunday' => [
              'open' => '10:00',
              'close' => '20:00',
            ],
            'tuesday' => [
              'open' => '08:00',
              'close' => '23:00',
            ],
            'saturday' => [
              'open' => '09:00',
              'close' => '22:00',
            ],
            'thursday' => [
              'open' => '08:00',
              'close' => '23:00',
            ],
            'wednesday' => [
              'open' => '08:00',
              'close' => '23:00',
            ],
        ];

        return [
            'trade_name' => fake()->name(),
            'document' => fake()->randomNumber(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'logo' => fake()->imageUrl(),
            'business_hours' => $defaultBusinessHours,
            'status' => Status::Active,
        ];
    }
}
