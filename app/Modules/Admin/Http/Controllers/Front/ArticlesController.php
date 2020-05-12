<?php

namespace App\Modules\Admin\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Models\Article;
use App\Modules\Admin\Models\Like;
use App\Modules\Traits\ArticleTrait;
use ElfSundae\Laravel\Hashid\Facades\Hashid;
use Illuminate\Support\Facades\Redis;

class ArticlesController extends Controller
{
    use ArticleTrait;

    /**
     * 详情
     *
     * @param $article
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($article)
    {
        $id = Hashid::decode($article);

        $article = Article::query()
            ->with([
                'creator',
                'add',
            ])
            ->findOrFail($id);

        if ($article->is_published == 0) {
            return redirect()->to('/');
        }

        return view('admin::front.article.show', compact('article'));
    }

    /**
     * 点赞
     *
     * @param $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function give($article)
    {
        // 文章数据应该也放入redis
        $id = Hashid::decode($article);

        $article = $this->getArticleInfoOnRedis($id);

        if (empty($article)) {
            $article = Article::query()->select('id')->findOrFail($id);

            $this->updateArticleInfoOnRedis($article);
        }

        if (empty($article)) {
            $article = $this->getArticleInfoOnRedis($id);
        }

        $key = $this->formatRedisKey('give_articles_users', $id);

        // 获取排名
        $rank = Redis::zrank($key, auth()->user()->id);

        if ($rank !== false && $rank >= 0) {
            return response()->json(['code' => 0, 'msg' => '已点赞']);
        }

        $like = Like::query()->searchModel(auth()->user()->id, $id, Article::class)->first();

        if (!empty($like)) {
            Redis::zadd($key, now()->timestamp, auth()->user()->id);

            return response()->json(['code' => 0, 'msg' => '已点赞']);
        }

        $day_give_users_key = $this->formatRedisKey('day_give_articles_users', today()->format('Y-m-d'));

        Redis::sadd($day_give_users_key, serialize([
            'user_id' => auth()->user()->id,
            'model_type' => Article::class,
            'model_id' => $id,
            'status' => 1
        ]));

        $article['give_count'] += 1;

        $this->coverArticleInfoOnRedis($id, $article);

        return response()->json(['code' => 200, 'msg' => '点赞成功']);
    }


    /**
     * 组装redis—key
     *
     * @param $key
     * @param array $params
     * @return string
     */
    public function formatRedisKey($key, ...$params)
    {
        $sub = config('redis_key.' . $key);

        $last_sub = implode(':', $params);

        return $sub . ':' . $last_sub;
    }

    /**
     * 位置
     *
     * @param $id
     * @return int
     */
    public function position($id)
    {
        return $id % 10;
    }
}
