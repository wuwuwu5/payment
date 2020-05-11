<?php

namespace App\Modules\Admin\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class GeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the provided services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register the provided services.
     */
    public function register()
    {
        $generators = [
            'command.make.module_controller' => \App\Modules\Admin\Console\Generators\MakeControllerCommand::class,
            'command.make.module_model' => \App\Modules\Admin\Console\Generators\MakeModelCommand::class,
            'generate:hot_article' => \App\Modules\Admin\Console\Commands\GenerateHotArticle::class,
            'load:article_info' => \App\Modules\Admin\Console\Commands\LoadArticleInfo::class,
        ];

        foreach ($generators as $slug => $class) {
            $this->app->singleton($slug, function ($app) use ($slug, $class) {
                return $app[$class];
            });

            $this->commands($slug);
        }
    }
}
