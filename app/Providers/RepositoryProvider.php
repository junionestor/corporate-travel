<?php

namespace App\Providers;

use App\Repositories\Contracts\TravelOrderRepositoryInterface;
use App\Repositories\Eloquent\TravelOrderRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            TravelOrderRepositoryInterface::class,
            TravelOrderRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
