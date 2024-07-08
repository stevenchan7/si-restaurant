<?php

namespace App\Providers;
use App\Models\Inventory;
use App\Observers\InventoryObserver;
use Illuminate\Support\Facades\View;
// use App\Observers\IngredientObserver;
use Illuminate\Support\ServiceProvider;
use App\View\Composers\NotificationComposer;
use Illuminate\Support\Facades\Log;

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
        Log::info('AppServiceProvider booted');
        Inventory::observe(InventoryObserver::class);
        View::composer('components.layouts.admin-layout', NotificationComposer::class);
    }
}
