<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\DomainInfo;
use App\Observers\DomainInfoObserver;

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
        DomainInfo::observe(DomainInfoObserver::class);
    }
}
