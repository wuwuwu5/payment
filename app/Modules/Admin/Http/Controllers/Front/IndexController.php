<?php

namespace App\Modules\Admin\Http\Controllers\Front;

use App\Http\Controllers\BaseController;
use App\Modules\Admin\Models\Article;
use App\Modules\Admin\Models\ModelHasTag;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    /**
     * 首页
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $articles = Article::query()->frontIndex()->take(20)->get();

        $tags = ModelHasTag::query()
            ->where('model_type', Article::class)
            ->select('tag_id')
            ->with(['tag' => function ($q) {
                $q
                    ->select('id', 'name', 'nickname')
                    ->withCount('tags');
            }])
            ->groupBy('tag_id')
            ->get();

        return view('admin::front.index.index', compact('articles', 'tags'));
    }
}
