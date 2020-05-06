<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Admin\Models\Article;
use App\Modules\Admin\Models\Category;
use App\Modules\Admin\Models\CategoryGroup;
use Fukuball\Jieba\JiebaAnalyse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ArticlesController extends BaseController
{
    public $model = \App\Modules\Admin\Models\Article::class;

    public $view_prefix_path = "admin::admin.";

    public $page_name = '文章';


    /**
     * 首页JSON
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexJson(Request $request)
    {
        $request = $this->formatIndexQuery($request);

        $data = $this
            ->getQuery()
            ->indexSearch()
            ->indexWith()
            ->pimp()
            ->paginate($request->input('limit', $this->limit ?? 15));

        return $this->formatPaginateResponse($data);
    }


    /**
     * list event url
     *
     * @param $data
     * @return mixed
     */
    public function setDataItemUrl($data)
    {
        foreach ($data as $item) {
            $item->edit_url = $this->getEditUrl([$item->id]);
            $item->update_url = $this->getUpdateUrl([$item->id]);
            $item->destory_url = $this->getDestroyUrl([$item->id]);
            $item->publish_url = $this->checkRoute('admin.articles.publish', [$item->id]);
        }

        return $data;
    }

    /**
     * 参数
     *
     * @param Category $category
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function column2(Category $category, Request $request)
    {
        $category->categoryGroup()->where('name', CategoryGroup::FRONT_COLUMN)->firstOrFail();

        if ($category->pid == 0) {
            $top_id = $category->id;
            $path = $category->id . '%';
        } else {
            $top_id = $category->top_id;
            $path = $category->path . ',' . $category->id . '%';
        }

        $categories = Category::query()
            ->where(compact('top_id'))
            ->where('path', 'like', $path)
            ->select('id', 'nickname as name', 'pid', 'category_group_id')
            ->get()
            ->toArray();

        $categories = generateCategoriesTree($categories);

        return $this->returnOkApi(null, $categories);
    }

    /**
     * 保存
     *
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\JsonValidatorException
     * @throws \App\Exceptions\WebValidatorException
     */
    public function store(Request $request)
    {
        $this->validateData($request);

        // 关键字
        $keywords = $request->input('keywords');

        if (!empty($keywords)) {
            $request->offsetSet('keywords', array_filter(explode(',', $keywords)));
        } else {
            // 分词
            $keywords = JiebaAnalyse::extractTags($request->input('title'), 10);
            // 赋值
            $request->offsetSet('keywords', $keywords);
        }

        // 缩略图
        $request->offsetSet('lit_pic', $request->input('cover'));
        // 创建人
        $request->offsetSet('creator_id', auth()->guard('admin')->user()->id);

        try {

            DB::beginTransaction();

            $article = Article::query()->create($request->all());

            $tags = explode(',', $request->input('tags'));

            $tags = array_map(function ($item) {
                return ['tag_id' => $item];
            }, $tags);


            $article->tags()->createMany($tags);

            DB::commit();
            return $this->returnOkApi();
        } catch (\Exception $exception) {
            DB::rollBack();
            report($exception);
            return $this->returnErrorApi();
        }
    }

    /**
     * 更新状态
     *
     * @param Article $article
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function publish(Article $article, Request $request)
    {
        $this->authorize('update', $article);

        $publish = (bool)$request->input('publish');

        if ($article->is_published == $publish) {
            return $this->returnApi(200, '更新成功');
        }

        $article->is_published = $publish;
        $article->save();

        return $this->returnApi(200, '更新成功');
    }

    /**
     * 表单验证规则
     *
     * @param Request $request
     * @return array
     */
    public function rules(Request $request): array
    {
        switch ($request->method()) {
            case 'POST':
                return [
                    'cover' => 'required|string|max:200|min:1',
                    'title' => 'required|string|min:2|max:200',
                    'short_title' => 'nullable|string|min:2|max:200',
                    'category_id' => ['required', 'integer', Rule::exists('categories', 'id')->where(function ($query) {
                        $query->whereHas('categoryGroup', function ($q) {
                            $q->where('name', CategoryGroup::ARTICLE);
                        });
                    })],
                    'keywords' => ['nullable', 'string', function ($attr, $value, $fail) {
                        if (empty($value)) {
                            return true;
                        }

                        if (count(array_filter(explode(',', $value))) > 10) {
                            return $fail('最多可添加十个关键字');
                        }

                        return true;
                    }],
                    'column_id' => ['nullable', 'integer', Rule::exists('categories', 'id')->where(function ($query) {
                        $query
                            ->whereHas('categoryGroup', function ($q) {
                                $q->where('name', CategoryGroup::FRONT_COLUMN);
                            })
                            ->where('pid', 0);
                    })],
                    'column2_id' => ['nullable', 'integer', Rule::exists('categories', 'id')->where(function ($query) {
                        $query
                            ->whereHas('categoryGroup', function ($q) {
                                $q->where('name', CategoryGroup::FRONT_COLUMN);
                            })
                            ->where('pid', \request()->input('column_id'));
                    })],
                    'tags' => 'nullable|string',
                    'not_post' => 'required|min:0|max:1|integer',
                    'published_at' => 'nullable|date',
                ];
                break;
        }
    }

    /**
     * 字段
     *
     * @return array
     */
    public function customAttributes(): array
    {
        return [
            'cover' => '封面',
            'title' => '标题',
            'short_title' => '副标题',
            'category_id' => '分类',
            'keywords' => '关键字',
            'column_id' => '主栏目',
            'column2_id' => '副栏目',
            'tags' => '标签',
            'not_post' => '评论状态',
            'published_at' => '发布时间',
        ];
    }
}
