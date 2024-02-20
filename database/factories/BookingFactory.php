<?php

namespace Database\Factories;

use App\Enums\Sport;
use App\Models\User;
use App\Models\Court;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Merchant;
use App\Enums\BookingStatus;
use Illuminate\Support\Carbon;
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
        $status = $statuses[rand(0, 5)];

        $sports = Sport::all();
        $sport = $sports[rand(0, 2)];

        $startDatetime = fake()->dateTimeBetween('now', '+5 days');
        $totalHours = rand(1, 3);

        return [
            'user_id' => User::factory(),
            'merchant_id' => Merchant::factory(),
            'customer_id' => Customer::factory(),
            'court_id' => Court::factory(),
            'sport' => $sport,
            'start_datetime' => $startDatetime,
            'end_datetime' => (Carbon::parse($startDatetime))->addHours($totalHours),
            'total_hours' => $totalHours,
            'note' => fake()->text(),
            'status' => $status,
        ];
    }
}
