<?php

namespace App\Modules\Article\Jobs;

use App\Modules\Admin\Models\Category;
use App\Modules\Admin\Models\CategoryGroup;
use App\Modules\Article\Models\AddOnArticle;
use App\Modules\Article\Models\Article;
use Fukuball\Jieba\Jieba;
use Fukuball\Jieba\JiebaAnalyse;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;


class GatherArticleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;
    /**
     * @var Article
     */
    private $data;

    /**
     * Create a new job instance.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $add = AddOnArticle::query()->where('hash_url', $this->data['hash_url'])->first();

        if (!empty($add)) {
            $this->updateArticle($add);
        } else {
            $this->createArticle();
        }
    }

    /**
     * 创建
     */
    public function createArticle()
    {
        try {

            DB::beginTransaction();

            $tags = $this->tags();

            $columns = $this->columns();

            $article = Article::create([
                'creator_id' => 1,
                'category_id' => $this->category(),
                'column_id' => $columns[0] ?? 0,
                'column2_id' => $columns[1] ?? 0,
                'view_count' => rand(1, 1000),
                'give_count' => rand(1, 1000),
                'collection_count' => rand(1, 1000),
                'post_count' => rand(1, 1000),
                'title' => $this->data['title'],
                'short_title' => $this->data['title'],
                'keywords' => $this->getKeywords($this->data['title']),
                'cover' => $this->getImg(),
                'published_at' => $this->data['crawled_at'],
                'is_published' => 1,
            ]);

            $article->add()->create([
                'body' => $this->data['content'],
                'hash_url' => $this->data['hash_url'],
                'content_hash' => $this->data['content_hash'],
                'source_url' => $this->data['url'],
                'source_name' => $this->data['name'],
            ]);

            if (count($tags) > 0) {
                $article->tags()->createMany($tags);
            }

            DB::commit();

            // 将基本信息存入redis
            SyncArticleInfoToCache::dispatch($article)->onConnection('redis')->onQueue('sync_article');
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }

    /**
     * @param $add
     */
    public function updateArticle($add)
    {
        try {

            DB::beginTransaction();

            $tags = $this->tags();

            $columns = $this->columns();
            $article = $add->article;
            $article->column_id = $columns[0] ?? 0;
            $article->column2_id = $columns[1] ?? 0;
            $article->title = $this->data['title'];
            $article->short_title = $this->data['title'];
            $article->is_commend = rand(0, 1);
            $article->keywords = $this->getKeywords($this->data['title']);
            $article->category_id = $this->category();
            $article->cover = $this->getImg();
            $article->save();

            $article->tags()->delete();

            if (count($tags) > 0) {
                $article->tags()->createMany($tags);
            }

            $add->body = $this->data['content'];
            $add->content_hash = $this->data['content_hash'];
            $add->source_url = $this->data['url'];
            $add->save();

            DB::commit();

            // 更新Redis数据
            SyncArticleInfoToCache::dispatch($article, true)->onConnection('redis')->onQueue('sync_article');
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }


    /**
     * @param $string
     * @return array
     */
    public function getKeywords($string)
    {
        return [];
//        Jieba::init();
//        // 分词
//        return JiebaAnalyse::extractTags($string, 10);
    }

    /**
     * @return array
     */
    public function tags()
    {
        $tags = $this->data['tags'];

        if (empty($tags)) {
            return [];
        }

        $group = CategoryGroup::query()->where('name', CategoryGroup::TAG)->first();

        if (empty($group)) {
            return [];
        }

        $result = [];

        foreach ($tags as $tag) {
            $t = $group->categories()->where('nickname', $tag)->first();

            if (empty($t)) {
                $t = $this->createCategory($group, $tag);
            }

            $result[] = ['tag_id' => $t->id];
        }

        return $result;
    }

    /**
     * @param $group
     * @param $nickname
     * @param array $value
     * @param int $pid
     * @param string $path
     * @param int $level
     * @return mixed
     */
    public function createCategory($group, $nickname, $value = [], $pid = 0, $path = '', $level = 1)
    {
        // $name = app('pinyin')->convert($nickname);

        return $group->categories()->create([
            'name' => md5($nickname),
            'nickname' => $nickname,
            'value' => $value,
            'creator_id' => 1,
            'pid' => $pid,
            'path' => $path,
            'level' => $level
        ]);
    }


    /**
     * 获取栏目数据
     *
     * @return array
     */
    public function columns()
    {
        $columns = $this->data['column'];

        if (empty($columns)) {
            return [0, 0];
        }

        $column1 = $columns[0];

        if (empty($column1)) {
            return [0, 0];
        }

        $group = CategoryGroup::query()->where('name', CategoryGroup::FRONT_COLUMN)->first();

        if (empty($group)) {
            return [0, 0];
        }

        $id1 = $group->categories()->where('nickname', $column1)->value('id');

        if (empty($id1)) {
            $category = $this->createCategory($group, $column1, ["show" => "1", "home_top" => "0"]);
            $id1 = $category->id;
        }

        $column2 = $columns[1];

        if (empty($column2)) {
            return [$id1, 0];
        }

        $id2 = $group->categories()->where('nickname', $column2)->value('id');

        if (empty($id2)) {
            $category = $this->createCategory($group, $column2, ["show" => "1", "home_top" => "0"], $id1, $id1, 2);
            $id2 = $category->id;
        }

        return [$id1, $id2];
    }

    /**
     * @return string
     */
    public function getImg()
    {
        $img = $this->data['img'];

        if (!empty($img)) {
            return $img;
        }

        $imgpreg = "/<img(.*?)src=\"(.+?)\".*?>/";
        preg_match($imgpreg, $this->data['content'], $img);
        if (empty($img)) {
            return '';
        } else {
            return $img[2];
        }
    }

    /**
     * @return int
     */
    public function category()
    {
        if (count($this->data['category']) <= 0) {
            return 0;
        }

        $group = CategoryGroup::query()->where('name', CategoryGroup::ARTICLE)->first();

        if (empty($group)) {
            return 0;
        }

        $nickname = $this->data['category'][0];

        $id = $group->categories()->where('nickname', $nickname)->value('id');

        if (!empty($id)) {
            return $id;
        }

        $category = $this->createCategory($group, $nickname);

        return $category->id;
    }
}
