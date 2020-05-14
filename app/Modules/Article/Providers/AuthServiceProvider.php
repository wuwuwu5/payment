<?php

namespace App\Modules\Article\Providers;

use App\Modules\Article\Models\Article;
use App\Modules\Article\Policies\ArticlePolicy;
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
