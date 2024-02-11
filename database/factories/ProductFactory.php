<?php

namespace Database\Factories;

use App\Enums\Status;
use App\Models\Product;
use App\Models\Merchant;
use App\Enums\ProductType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = [ProductType::Product, ProductType::Service];
        $type = $types[rand(0, 1)];

        return [
            'merchant_id' => Merchant::factory(),
            'name' => fake()->name(),
            'description' => fake()->text(),
            'price' => fake()->randomNumber(),
            'image' => fake()->imageUrl(),
            'type' => $type->value,
            'stock' => rand(0, 99),
            'status' => Status::Active,
        ];
    }
}
