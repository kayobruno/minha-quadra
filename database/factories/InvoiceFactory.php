<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\InvoiceType;
use App\Models\Merchant;
use App\Models\Supplier;
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
        $randomNumber = (string) fake()->numberBetween(10, 500);

        return [
            'merchant_id' => Merchant::factory(),
            'supplier_id' => Supplier::factory(),
            'type' => InvoiceType::Issuing,
            'serie' => $randomNumber,
            'number' => $randomNumber,
        ];
    }
}
