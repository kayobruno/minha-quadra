<?php

namespace Database\Factories;

use App\Models\Merchant;
use App\Models\MerchantConfig;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Merchant>
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
        return [
            'merchant_id' => Merchant::factory(),
            'config_name' => fake()->name,
            'config_value' => rand(0, 10),
        ];
    }
}
