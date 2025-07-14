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
        $requirement_types = globalHelper()->getRequirementTypes();
        $business_requirement_types = globalHelper()->getBusinessRequirementTypes();

        view()->composer('*', function($view) use ($system_config, $requirement_types, $business_requirement_types) {
            $view->with([
                'app_name' => $system_config['app_name'],
                'app_title' => $system_config['app_title'],
                'app_favicon' => $system_config['app_favicon'],

                'global_requirement_types' => $requirement_types,
                'business_requirement_types' => $business_requirement_types,
            ]);
        });
    }
}