<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Admin\Models\Article;
use App\Modules\Admin\Models\Category;
use App\Modules\Admin\Models\CategoryGroup;
use Fukuball\Jieba\Jieba;
use Fukuball\Jieba\JiebaAnalyse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            $item->commend_url = $this->checkRoute('admin.articles.commend', [$item->id]);
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
            Jieba::init();
            // 分词
            $keywords = JiebaAnalyse::extractTags($request->input('title'), 10);

            // 赋值
            $request->offsetSet('keywords', $keywords);
        }

        // 缩略图
        $request->offsetSet('lit_pic', $request->input('cover'));
        // 创建人
        $request->offsetSet('creator_id', auth()->guard('admin')->user()->id);
        // 发布
        if ($request->input('is_published') == 1) {
            $request->offsetSet('published_at', now()->format('Y-m-d H:i:s'));
        }

        // 副标题
        if (empty($request->input('short_title'))) {
            $request->offsetSet('short_title', $request->input('title'));
        }

        try {

            DB::beginTransaction();

            $article = Article::query()->create($request->all());

            $tags = array_filter(explode(',', $request->input('tags')));

            $tags = array_map(function ($item) {
                return ['tag_id' => $item];
            }, $tags);

            if (count($tags) > 0) {
                $article->tags()->createMany($tags);
            }

            $article->add()->create($request->only('body'));

            DB::commit();
            return $this->returnOkApi();
        } catch (\Exception $exception) {
            DB::rollBack();
            report($exception);
            return $this->returnErrorApi();
        }
    }

    /**
     * 修改
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id, Request $request)
    {
        $show = $this->getQuery()->findOrFail($id);

        $this->authorize('update', $show);

        $show->load(['tags', 'add']);

        return $this->display(null, compact('show'));
    }

    /**
     * 更新
     *
     * @param $id
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\JsonValidatorException
     * @throws \App\Exceptions\WebValidatorException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update($id, Request $request)
    {
        $this->validateData($request);

        $article = $this->getQuery()->findOrFail($id);

        $this->authorize('update', $article);

        // 关键字
        $keywords = $request->input('keywords');

        if (!empty($keywords)) {
            $request->offsetSet('keywords', array_filter(explode(',', $keywords)));
        } else {
            Jieba::init();
            // 分词
            $keywords = JiebaAnalyse::extractTags($request->input('title'), 10);
            // 赋值
            $request->offsetSet('keywords', $keywords);
        }

        // 缩略图
        $request->offsetSet('lit_pic', $request->input('cover'));

        try {

            DB::beginTransaction();

            $article->fill($request->all());
            $article->save();

            $tags = array_filter(explode(',', $request->input('tags')));

            $tags = array_map(function ($item) {
                return ['tag_id' => $item];
            }, $tags);


            $article->tags()->delete();

            if (count($tags) > 0) {
                $article->tags()->createMany($tags);
            }

            $article->add()->update($request->only('body'));

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

        $is_published = (bool)$request->input('publish');

        if ($article->is_published == $is_published) {
            return $this->returnApi(200, '更新成功');
        }

        if ($is_published) {
            $published_at = now();
        } else {
            $published_at = null;
        }

        Article::query()->where('id', $article->id)->update(compact('is_published', 'published_at'));

        return $this->returnApi(200, '更新成功');
    }

    /**
     * 更新状态
     *
     * @param Article $article
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function commend(Article $article, Request $request)
    {
        $this->authorize('update', $article);

        $commend = (bool)$request->input('commend');

        if ($article->is_commend == $commend) {
            return $this->returnApi(200, '更新成功');
        }

        $article->is_commend = $commend;
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
            case 'PUT':
                return [
                    'cover' => 'required|string|max:200|min:1',
                    'title' => 'required|string|min:2|max:200',
                    'short_title' => 'nullable|string|min:2|max:200',
                    'category_id' => ['required', 'integer', function ($attr, $value, $fail) {
                        $mark = Category::query()->where('id', $value)->where(function ($query) {
                            return $query
                                ->whereHas('categoryGroup', function ($q) {
                                    return $q->where('name', CategoryGroup::ARTICLE);
                                });
                        })->exists();

                        if (!$mark) {
                            return $fail('分类不存在!');
                        }
                    }],
                    'keywords' => ['nullable', 'string', function ($attr, $value, $fail) {
                        if (empty($value)) {
                            return true;
                        }

                        if (count(array_filter(explode(',', $value))) > 10) {
                            return $fail('最多可添加十个关键字');
                        }

                        return true;
                    }],
                    'column_id' => ['nullable', 'integer', function ($attr, $value, $fail) {
                        $mark = Category::query()
                            ->where('id', $value)
                            ->where('pid', 0)
                            ->where(function ($query) {
                                return $query
                                    ->whereHas('categoryGroup', function ($q) {
                                        return $q->where('name', CategoryGroup::FRONT_COLUMN);
                                    });
                            })
                            ->exists();

                        if (!$mark) {
                            return $fail('文章主栏目不存在!');
                        }
                    }],
                    'column2_id' => ['nullable', 'integer', function ($attr, $value, $fail) {
                        $mark = Category::query()
                            ->where('id', $value)
                            ->where('pid', \request()->input('column_id'))
                            ->where(function ($query) {
                                return $query
                                    ->whereHas('categoryGroup', function ($q) {
                                        return $q->where('name', CategoryGroup::FRONT_COLUMN);
                                    });
                            })
                            ->exists();

                        if (!$mark) {
                            return $fail('文章副栏目不存在!');
                        }
                    }],
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
