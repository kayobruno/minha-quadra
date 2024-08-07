<?php

declare(strict_types=1);

namespace App\Providers;

use App\Contracts\BookingRepository;
use App\Contracts\CourtRepository;
use App\Contracts\CustomerRepository;
use App\Contracts\LoggerInterface;
use App\Contracts\MerchantRepository;
use App\Contracts\OrderRepository;
use App\Contracts\ProductRepository;
use App\Contracts\SupplierRepository;
use App\Repositories\BookingEloquentRepository;
use App\Repositories\CourtEloquentRepository;
use App\Repositories\CustomerEloquentRepository;
use App\Repositories\MerchantEloquentRepository;
use App\Repositories\OrderEloquentRepository;
use App\Repositories\ProductEloquentRepository;
use App\Repositories\SupplierEloquentRepository;
use App\Services\Logs\ElasticSearchClientWrapper;
use App\Services\Logs\ElasticSearchLoggerService;
use Elastic\Elasticsearch\ClientBuilder;
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
        $this->app->bind(CourtRepository::class, CourtEloquentRepository::class);
        $this->app->bind(MerchantRepository::class, MerchantEloquentRepository::class);
        $this->app->bind(OrderRepository::class, OrderEloquentRepository::class);
        $this->app->bind(ProductRepository::class, ProductEloquentRepository::class);
        $this->app->bind(SupplierRepository::class, SupplierEloquentRepository::class);

        $this->app->singleton(LoggerInterface::class, function ($app) {
            $hosts = config('services.elasticsearch.hosts');
            $client = ClientBuilder::create()->setHosts($hosts)->build();
            $wrapper = new ElasticSearchClientWrapper($client);

            return new ElasticSearchLoggerService($wrapper);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
