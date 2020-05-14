<?php

namespace App\Modules\Article\Providers;

use App\Modules\Article\Models\Article;
use App\Modules\Article\Observers\ArticleObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        Article::observe(ArticleObserver::class);
    }
}
