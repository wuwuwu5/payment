<?php

namespace App\Modules\Article\Console\Commands;

use App\Modules\Article\Models\Article;
use Illuminate\Console\Command;

class GenerateHotArticle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:hot_article';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成热门文章';

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
        // 从redis中获取最近一个月发布的内容
    }
}
