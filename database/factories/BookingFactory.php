<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Court;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Merchant;
use App\Enums\BookingStatus;
use App\Enums\Sport;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statuses = BookingStatus::all();
        $status = $statuses[rand(0, 2)];

        $sports = Sport::all();
        $sport = $sports[rand(0, 2)];

        return [
            'user_id' => User::factory(),
            'merchant_id' => Merchant::factory(),
            'customer_id' => Customer::factory(),
            'court_id' => Court::factory(),
            'sport' => $sport,
            'when' => fake()->dateTimeBetween('now', '+7 days'),
            'note' => fake()->text(),
            'status' => $status,
        ];
    }
}
