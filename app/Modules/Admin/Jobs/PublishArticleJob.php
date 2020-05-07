<?php

namespace App\Modules\Admin\Jobs;

use App\Modules\Admin\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PublishArticleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;
    /**
     * @var Article
     */
    private $article;

    /**
     * Create a new job instance.
     *
     * @param Article $article
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->article = Article::query()->find($this->article->id);

        if (empty($this->article)) {
            return;
        }

        if ($this->article->is_published == 1) {
            return;
        }

        $diff = $this->article->published_at->timestamp - now()->timestamp;

        // 当前时间小于等于发布时间
        if ($diff <= 0) {
            Article::query()->where('id', $this->article->id)->update(['is_published' => 1]);
        } else {
            // 发布时间大于当前时间 重新放回队列
            PublishArticleJob::dispatch($this->article)->delay($this->article->published_at)->onConnection('redis');
        }
    }
}
