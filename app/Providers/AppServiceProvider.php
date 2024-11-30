<?php

namespace App\Providers;

use App\Models\Auth\User;
use Illuminate\Support\Facades\View;
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
        View::composer(['dashboard.product', 'dashboard.order', 'dashboard.report', 'dashboard.material'], function ($view) {
            $admin = User::where('role', 'A')->first();
            $adminName = $admin ? $admin->name : 'Administrador no encontrado';

            $view->with('adminName', $adminName);
        });
    }
}
