<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Pengaturan;

class AppServiceProvider extends ServiceProvider
{
    protected static $pengaturan = null;
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
        Paginator::useBootstrap();

        // Share pengaturan data to all views
        View::composer('*', function ($view) {
            if (self::$pengaturan === null) {
                self::$pengaturan = Pengaturan::first();
            }

            $view->with('pengaturan', self::$pengaturan);
        });
    }
}
