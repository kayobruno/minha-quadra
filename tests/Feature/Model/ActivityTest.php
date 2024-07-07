<?php

declare(strict_types=1);

use App\Enums\ActivityType;
use App\Models\Activity;
use App\Models\Order;
use App\Models\User;

afterEach(function () {
    User::truncate();
    Order::truncate();
    Activity::truncate();
});

it('can create an activity', function () {
    $user = User::factory()->create();
    $order = Order::factory()->create();

    $activity = Activity::factory()->create([
        'user_id' => $user->id,
        'order_id' => $order->id,
        'type' => ActivityType::AddItem,
    ]);

    expect($activity)->toBeInstanceOf(Activity::class);
    expect($activity->type)->toBe(ActivityType::AddItem);
    expect($activity->user->id)->toBe($user->id);
    expect($activity->order->id)->toBe($order->id);
});
