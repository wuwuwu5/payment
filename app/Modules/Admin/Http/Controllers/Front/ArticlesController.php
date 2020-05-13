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
                'tags' => function ($q) {
                    $q->with('tag:id,name,nickname');
                },
            ])
            ->findOrFail($id);

        if ($article->is_published == 0) {
            return redirect()->to('/');
        }

        $next_article = Article::query()
            ->select('id', 'title')
            ->where('id', '<>', $article->id)
            ->inRandomOrder()
            ->first();

        return view('admin::front.article.show', compact('article', 'next_article'));
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
            $article = Article::query()->findOrFail($id);

            $this->updateArticleInfoOnRedis($article);
        }

        if (empty($article)) {
            $article = $this->getArticleInfoOnRedis($id);
        }

        $key = $this->formatRedisKey('give_articles_users', $id);

        // 获取排名
        $rank = Redis::zrank($key, auth()->user()->id);

        if ($rank !== false) {

            $score = Redis::ZSCORE($key, auth()->user()->id);

            if ((int)($score) != -1) {
                return response()->json(['code' => 0, 'msg' => '已点赞']);
            }
        }

        $like = Like::query()->searchModel(auth()->user()->id, $id, Article::class)->first();

        if (!empty($like)) {
            Redis::zadd($key, now()->timestamp, auth()->user()->id);

            return response()->json(['code' => 0, 'msg' => '已点赞']);
        }

        $day_give_users_key = $this->formatRedisKey('day_give_articles_users', today()->format('Y-m-d'));

        $fields = [
            $key,
            $day_give_users_key,
            $this->getArticleInfoOnRedisKey($id),
            auth()->user()->id,
            $this->generateMark(auth()->user()->id, $id, 0),
            $this->generateMark(auth()->user()->id, $id, 1),
            $id,
            serialize($article),
            1,
            now()->timestamp
        ];

        Redis::eval($this->giveLua(), 3, ...$fields);

        return response()->json(['code' => 200, 'msg' => '点赞成功']);
    }

    /**
     * 取消点赞
     *
     * @param $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancelGive($article)
    {
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

        if ($rank === false) {
            $like = Like::query()->searchModel(auth()->user()->id, $id, Article::class)->first();

            if (!empty($like)) {
                Redis::zadd($key, now()->timestamp, auth()->user()->id);
            } else {
                Redis::zadd($key, -1, auth()->user()->id);
            }
        }

        // 获取排名
        $rank = Redis::zrank($key, auth()->user()->id);

        if ($rank !== false && $rank >= 0) {
            $score = Redis::ZSCORE($key, auth()->user()->id);

            if ((int)($score) == -1) {
                return response()->json(['code' => 0, 'msg' => '没有点过赞']);
            }
        }

        $day_give_users_key = $this->formatRedisKey('day_give_articles_users', today()->format('Y-m-d'));

        $article['give_count'] -= 1;

        $fields = [
            $key,
            $day_give_users_key,
            $this->getArticleInfoOnRedisKey($id),
            auth()->user()->id,
            $this->generateMark(auth()->user()->id, $id, 1),
            $this->generateMark(auth()->user()->id, $id, 0),
            $id,
            serialize($article),
            0,
            0,
        ];

        Redis::eval($this->giveLua(), 3, ...$fields);

        return response()->json(['code' => 200, 'msg' => '取消点赞成功']);
    }

    /**
     * 点赞
     *
     * @return string
     */
    public function giveLua()
    {
        $script = <<<LUA
local key1 = KEYS[1]
local key2 = KEYS[2]
local key3 = KEYS[3]
local value1 = ARGV[1]
local value2 = ARGV[2]
local value3 = ARGV[3]
local value4 = ARGV[4]
local value5 = ARGV[5]
local value6 = tonumber(ARGV[6])
local value7 = tonumber(ARGV[7])
local ret = 0

if (value6 == 0) then
    ret = redis.call('ZREM', key1, value1)
    local isExists = redis.call('SISMEMBER', key2, value2)
    if (isExists == 0) then
        ret = redis.call('SADD', key2, value3)
    else    
        ret = redis.call('SREM', key2, value2)
    end
else
    ret = redis.call('ZADD', key1, value7, value1)
    ret = redis.call('SREM', key2, value2)
    ret = redis.call('SADD', key2, value3)
end

ret = redis.call('HSET', key3, value4, value5)   

return ret
LUA;

        return $script;
    }

    /**
     * 生成数据
     *
     * @param $user_id
     * @param $id
     * @param $status
     * @return mixed
     */
    public function generateMark($user_id, $id, $status)
    {
        // 判断是否今天点的赞
        return serialize(['user_id' => $user_id, 'model_type' => Article::class, 'model_id' => $id, 'status' => $status]);
    }
}
