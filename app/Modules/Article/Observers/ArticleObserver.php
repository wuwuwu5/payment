<?php


namespace App\Modules\Article\Observers;


use App\Modules\Article\Jobs\PublishArticleJob;
use App\Modules\Article\Models\Article;
use App\Modules\Traits\ArticleTrait;

class ArticleObserver
{
    use ArticleTrait;

    public function saving(Article $article)
    {
        if (!empty($article->published_at) && $article->isDirty('published_at')) {
            if (empty($article->published_at)) {
                $article->is_published = 0;
            } else {
                $diff = now()->timestamp - $article->published_at->timestamp;
                if ($diff >= 0) {
                    $article->is_published = 1;
                } else {
                    if ($article->is_published == 1) {
                        $article->is_published = 0;
                    }
                    // 未来时间
                    PublishArticleJob::dispatch($article)->delay($article->published_at)->onConnection('redis');
                }
            }
        }
    }

    /**
     * @param Article $article
     */
    public function deleted(Article $article)
    {
        $article->tags()->delete();
        $article->add()->delete();

        $this->deleteArticleOnRedis($article);
    }
}
