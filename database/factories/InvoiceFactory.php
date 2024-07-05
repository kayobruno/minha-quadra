<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\InvoiceType;
use App\Models\Merchant;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomNumber = fake()->randomNumber(20);

        return [
            'serie' => $randomNumber,
            'number' => $randomNumber,
            'type' => InvoiceType::Issuing,
            'merchant_id' => Merchant::factory(),
        ];
    }
}
