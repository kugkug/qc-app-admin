<?php

namespace App\Providers;

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
    public function boot(): void {
        $system_config = config('system');

        view()->composer('*', function($view) use ($system_config) {
            $view->with([
                'app_name' => $system_config['app_name'],
                'app_title' => $system_config['app_title'],
                'app_favicon' => $system_config['app_favicon'],
            ]);
        });
    }
}