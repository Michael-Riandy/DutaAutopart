<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use App\Models\Products;

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
        Gate::define('admin', function(User $user){
            return $user->user_type === 'admin';
        });

        Gate::define('owner', function(User $user){
            return $user->user_type === 'owner';
        });

        View::composer('*', function ($view) {
            $lowStockProducts = Products::where('quantity', '<', 5)->get();
            $view->with('lowStockProducts', $lowStockProducts);
        });
    }
}
