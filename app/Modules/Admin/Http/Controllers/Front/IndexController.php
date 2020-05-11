<?php

namespace App\Modules\Admin\Http\Controllers\Front;

use App\Http\Controllers\BaseController;
use App\Modules\Admin\Models\Article;
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

        return view('admin::front.index.index', compact('articles'));
    }
}
