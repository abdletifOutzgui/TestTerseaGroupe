<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use App\Models\{Appel, Ticket};
use App\Observers\{AppelObserve, TicketObserve};

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);

        Appel::observe(AppelObserve::class);
        Tickte::observe(TicketObserve::class);
    }
}
