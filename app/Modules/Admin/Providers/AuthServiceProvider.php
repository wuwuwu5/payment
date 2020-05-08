<?php

namespace App\Modules\Admin\Providers;

use App\Modules\Admin\Models\Article;
use App\Modules\Admin\Models\Slide;
use App\Modules\Admin\Policies\ArticlePolicy;
use App\Modules\Admin\Policies\SlidePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * 应用程序的策略映射。
     *
     * @var array
     */
    protected $policies = [
        Article::class => ArticlePolicy::class,
        Slide::class => SlidePolicy::class,
    ];


    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
