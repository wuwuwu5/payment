<?php

namespace App\Modules\Admin\Providers;

use App\Modules\Admin\Models\Article;
use App\Modules\Admin\Observers\ArticleObserver;
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
