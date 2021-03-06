<?php

namespace App\Modules\Admin\Providers;

use Caffeinated\Modules\Support\ServiceProvider;
use ElfSundae\Laravel\Hashid\HashidServiceProvider;
use Illuminate\Support\Facades\Blade;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(module_path('admin', 'Resources/Lang', 'app'), 'admin');
        $this->loadViewsFrom(module_path('admin', 'Resources/Views', 'app'), 'admin');
        $this->loadMigrationsFrom(module_path('admin', 'Database/Migrations', 'app'));
        if (!$this->app->configurationIsCached()) {
            $this->loadConfigsFrom(module_path('admin', 'Config', 'app'));
        }
        $this->loadFactoriesFrom(module_path('admin', 'Database/Factories', 'app'));

        Blade::directive('cms', function ($name) {
            return "<?php echo config('copyright.'.$name)?>";
        });
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(FormGroupServiceProvider::class);
        $this->app->register(GeneratorServiceProvider::class);
        $this->app->register(ValidatorServiceProvider::class);
        $this->app->register(AuthServiceProvider::class);
        $this->app->register(HashidServiceProvider::class);
    }
}
