<?php

namespace Database\Factories;

use App\Models\Merchant;
use App\Models\MerchantConfig;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MerchantConfig>
 */
class MerchantConfigFactory extends Factory
{
    protected $model = MerchantConfig::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $businessHours = <<<'JSON'
            {
                "monday": {
                    "open": "08:00",
                    "close": "22:00"
                },
                "tuesday": {
                    "open": "08:00",
                    "close": "22:00"
                },
                "wednesday": {
                    "open": "08:00",
                    "close": "22:00"
                },
                "thursday": {
                    "open": "08:00",
                    "close": "22:00"
                },
                "friday": {
                    "open": "08:00",
                    "close": "22:00"
                },
                "saturday": {
                    "open": "08:00",
                    "close": "20:00"
                },
                "sunday": null
            }
        JSON;

        $minBookingTime = rand(1, 3);

        $configs = [
            ['name' => 'business_hours', 'value' => $businessHours],
            ['min_booking_time' => 'business_hours', 'value' => $minBookingTime],
        ];

        $key = rand(1, 2);

        return [
            'config_name' => $configs[$key]['name'],
            'config_value' => $configs[$key]['name'],
            'merchant_id' => Merchant::factory(),
        ];
    }
}
