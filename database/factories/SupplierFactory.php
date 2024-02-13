<?php

namespace Database\Factories;

use App\Enums\DocumentType;
use App\Enums\Status;
use App\Models\Merchant;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = [DocumentType::CPF, DocumentType::CNPJ];
        $type = $types[rand(0, 1)];

        return [
            'merchant_id' => Merchant::factory(),
            'name' => fake()->name(),
            'trade_name' => fake()->name(),
            'document' => fake()->randomNumber(),
            'tax_registration' => fake()->randomNumber(),
            'type' => $type->value,
            'status' => Status::Active,
        ];
    }
}
