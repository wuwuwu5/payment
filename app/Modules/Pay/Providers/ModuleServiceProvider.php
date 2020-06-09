<?php

namespace App\Modules\Pay\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(module_path('pay', 'Resources/Lang', 'app'), 'pay');
        $this->loadViewsFrom(module_path('pay', 'Resources/Views', 'app'), 'pay');
        $this->loadMigrationsFrom(module_path('pay', 'Database/Migrations', 'app'));
        if(!$this->app->configurationIsCached()) {
            $this->loadConfigsFrom(module_path('pay', 'Config', 'app'));
        }
        $this->loadFactoriesFrom(module_path('pay', 'Database/Factories', 'app'));
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
