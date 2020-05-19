<?php

namespace App\Modules\Article\Console\Commands;

use App\Modules\Article\Jobs\GatherArticleJob;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class GatherArticle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gather:articles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '采集文章';

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
        $client = new Client();

        $response = $client->request('GET', config('article.gather_url') . '?site=' . md5(config('app.url')).time());

        $data = $response->getBody()->getContents();

        $articles = json_decode($data, 1);

        if (count($articles) == 0) {
            $this->error("不存在文章");
        } else {
            foreach ($articles as $k => $article) {
                GatherArticleJob::dispatch($article)->onConnection('redis')->onQueue('gather_articles');
            }
        }
    }
}
