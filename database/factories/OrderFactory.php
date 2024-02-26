<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Models\Customer;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $total = fake()->randomFloat(min: 1, max: 99);

        return [
            'user_id' => User::factory(),
            'merchant_id' => Merchant::factory(),
            'customer_id' => Customer::factory(),
            'payment_method_id' => PaymentMethod::factory(),
            'subtotal' => $total,
            'total_amount' => $total,
            'total_discount' => 0,
            'status' => OrderStatus::Pending->value,
        ];
    }
}
