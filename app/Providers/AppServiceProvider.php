<?php

namespace App\Providers;

use App\Models\QCategory;
use App\Observers\QcategoryObserver;
use Illuminate\Support\ServiceProvider;

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
        QCategory::observe(QcategoryObserver::class);
    }
}
