<?php

namespace App\Modules\Article\Console\Commands;

use App\Modules\Article\Jobs\SyncArticleInfoToCache;
use App\Modules\Article\Models\Article;
use App\Modules\Traits\ArticleTrait;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class LoadArticleInfo extends Command
{
    use ArticleTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:article_info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '加载缓存数据';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Article::query()->chunk(1000, function ($articles) {
            foreach ($articles as $article) {
                SyncArticleInfoToCache::dispatch($article)->onConnection('redis')->onQueue('sync_article');
            }
        });
    }
}
