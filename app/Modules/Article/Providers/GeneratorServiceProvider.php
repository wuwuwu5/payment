<?php

namespace App\Modules\Article\Providers;

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
            'load:article_info' => \App\Modules\Article\Console\Commands\LoadArticleInfo::class,
            'sync:like_article' => \App\Modules\Article\Console\Commands\SyncArticleLikes::class,
        ];

        foreach ($generators as $slug => $class) {
            $this->app->singleton($slug, function ($app) use ($slug, $class) {
                return $app[$class];
            });

            $this->commands($slug);
        }
    }
}
