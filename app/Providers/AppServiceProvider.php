<?php

declare(strict_types=1);

namespace App\Providers;

use App\Contracts\BookingRepository;
use App\Contracts\CustomerRepository;
use App\Repositories\BookingEloquentRepository;
use App\Repositories\CustomerEloquentRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CustomerRepository::class, CustomerEloquentRepository::class);
        $this->app->bind(BookingRepository::class, BookingEloquentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
