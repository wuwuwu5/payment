<?php

namespace App\Modules\Admin\Console\Commands;

use App\Modules\Traits\ArticleTrait;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class SyncArticleLikes extends Command
{
    use ArticleTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:like_article';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '同步点赞数据';

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
        $key = $this->formatRedisKey('day_give_articles_users', now()->startOfDay()->subDay()->format('Y-m-d'));

        if (!Redis::exists($key)) {
            return;
        }

        // 游标
        $cursor = null;

        while ($cursor !== 0) {
            // 迭代获取数据
            $result = Redis::SSCAN($key, $cursor, ['match' => '*', 'count' => 1000]);

            if (count($result) > 0) {
                $cursor = $result[0];

                $data = $result[1] ?? [];

                if (count($data) > 0) {
                    $this->syncData($data);
                }
            }
        }

        Redis::del($key);
    }

    /**
     * @param $data
     */
    private function syncData($data)
    {
        $all = [];

        foreach ($data as $k => $item) {
            $all[$k] = unserialize($item);
        }

        $all = collect($all)->groupBy('status');

        // 取消了点赞的数据
        $cancel_give_data = data_get($all, 0, []);

        // 点了赞的数据
        $give_data = data_get($all, 1, []);

        try {
            DB::beginTransaction();

            if (count($cancel_give_data) > 0) {
                $this->formatData($cancel_give_data, '-');
            }

            if (count($give_data) > 0) {
                $this->formatData($give_data, '+');
            }

            DB::commit();

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
        }
    }

    /**
     * 处理数据
     *
     * @param $data
     * @param string $symbol
     * @return mixed
     */
    private function formatData($data, $symbol = '-')
    {
        $result = collect(collect($data)->groupBy('model_id')->reduce(function ($carry, $item) {
            $count = collect($item)->groupBy('user_id')->count();

            $article_id = data_get($item, '0.model_id');

            $carry[] = compact('article_id', 'count');

            return $carry;
        }, []))->chunk(100);


        $sql = 'UPDATE articles SET give_count = CASE id ';

        $ids = [];

        foreach ($result as $key => $items) {
            foreach ($items as $item) {
                $sql .= sprintf("WHEN %d THEN %s ", $item['article_id'], 'give_count ' . $symbol . ' ' . $item['count']);
                $ids[] = $item['article_id'];
                info("article_id: " . $item['article_id'] . ' ' . getArticleInfo($item['article_id'], 'give_count'));
                info("article_id: " . $item['article_id'] . ' ' . $symbol . ' ' . $item['count']);
            }
        }

        $ids = implode(', ', $ids);

        $sql .= "END WHERE id IN ($ids)";

        DB::update($sql);
    }
}
