<?php

namespace App\Modules\Article\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Models\CategoryGroup;
use App\Modules\Article\Jobs\SyncArticleInfoToCache;
use App\Modules\Article\Models\Article;
use App\Modules\Article\Models\Like;
use App\Modules\Traits\ArticleTrait;
use ElfSundae\Laravel\Hashid\Facades\Hashid;
use Illuminate\Http\Request;
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

        // 追加访问量
        incrArticleViewCount($article->id);
        // 同步数据
        syncArticleInfoJob($article, true);

        return view('article::front.article.show', compact('article', 'next_article'));
    }

    /**
     * @param $type
     * @param Request $request
     */
    public function column($type, Request $request)
    {
        $category_group = CategoryGroup::query()
            ->where('name', CategoryGroup::FRONT_COLUMN)
            ->first();

        if (empty($category_group)) {
            return redirect()->to('/');
        }

        // 排序
        $order = $request->input('order', 'default');

        if ($type == 'all') {
            $articles = Article::query()
                ->when(!empty($order), function ($q) use ($order) {
                    switch ($order) {
                        case 'hot':
                            $q->hotIndex();
                            break;
                        default:
                            $q->frontIndex();
                            break;
                    }
                })
                ->take(20)->paginate();

            return view('article::front.article.index', compact('articles'));
        }

        // 获取栏目信息
        $current_column = $category_group->categories()->where('name', $type)->first();

        // 获取栏目级别
        $articles = Article::query()
            ->when(!empty($order), function ($q) use ($order) {
                switch ($order) {
                    case 'hot':
                        $q->hotIndex();
                        break;
                    default:
                        $q->frontIndex();
                        break;
                }
            })
            ->where(function ($q) use ($current_column) {
                $q
                    ->where('column_id', $current_column->id ?? 0)
                    ->orWhere('column2_id', $current_column->id ?? 0);
            })
            ->take(20)
            ->paginate();

        return view('article::front.article.index', compact('articles', 'current_column'));
    }


    /**
     * 点赞 | 取消点赞
     *
     * @param $article
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function give($article, Request $request)
    {
        $give = $request->input('type');

        if (!in_array($give, ['give', 'cancel_give'])) {
            return response()->json(['code' => 0, 'msg' => '请求错误']);
        }

        // 文章数据应该也放入redis
        $id = Hashid::decode($article);

        if ($id <= 0) {
            return response()->json(['code' => 0, 'msg' => '请求错误']);
        }

        $article = getArticleInfoOnCache($id);

        if (empty($article)) {
            $article = Article::query()->findOrFail($id);

            SyncArticleInfoToCache::dispatch($article, true);
        }

        if (empty($article)) {
            $article = getArticleInfoOnCache($id);
        }

        $rand_key = formatRedisKey('give_articles_users', $id);

        // 获取排名
        $rank = Redis::zrank($rand_key, auth()->user()->id);

        if ($give == 'give') {
            if ($rank !== false) {

                $score = Redis::ZSCORE($rand_key, auth()->user()->id);

                if ((int)($score) != -1) {
                    return response()->json(['code' => 0, 'msg' => '已点赞']);
                }
            }

            //此步可以直接去掉
            $like = Like::query()->searchModel(auth()->user()->id, $id, Article::class)->first();

            if (!empty($like)) {
                Redis::zadd($rand_key, now()->timestamp, auth()->user()->id);

                return response()->json(['code' => 0, 'msg' => '已点赞']);
            }
            $article['give_count'] += 1;
        } else {
            if ($rank === false) {
                //此步可以直接去掉
                $like = Like::query()->searchModel(auth()->user()->id, $id, Article::class)->first();

                if (!empty($like)) {
                    Redis::zadd($rand_key, now()->timestamp, auth()->user()->id);
                } else {
                    Redis::zadd($rand_key, -1, auth()->user()->id);
                }
            }

            // 获取排名
            $rank = Redis::zrank($rand_key, auth()->user()->id);

            if ($rank !== false && $rank >= 0) {
                $score = Redis::ZSCORE($rand_key, auth()->user()->id);

                if ((int)($score) == -1) {
                    return response()->json(['code' => 0, 'msg' => '没有点过赞']);
                }
            }

            if ($article['give_count'] >= 1) {
                $article['give_count'] -= 1;
            }
        }

        $day_give_users_key = formatRedisKey('day_give_articles_users', today()->format('Y-m-d'));

        $fields = [
            $rand_key,
            $day_give_users_key,
            getArticleInfoOnCacheKey($id),
            auth()->user()->id,
            $this->generateMark(auth()->user()->id, $id, ($give == 'give' ? 0 : 1)),
            $this->generateMark(auth()->user()->id, $id, ($give == 'give' ? 1 : 0)),
            $id,
            serialize($article),
            ($give == 'give' ? 1 : 0),
            ($give == 'give' ? now()->timestamp : 0)
        ];

        Redis::eval($this->giveLua(), 3, ...$fields);

        // 同步数据
        syncArticleInfoJob(Article::find($id), true);

        return response()->json(['code' => 200, 'msg' => ($give == 'give' ? '点赞成功' : '取消点赞成功')]);
    }


    /**
     * 点赞LUA
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
