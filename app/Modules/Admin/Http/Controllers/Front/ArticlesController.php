<?php

namespace App\Modules\Admin\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Models\Article;

class ArticlesController extends Controller
{
    public function show(Article $article)
    {
dd($article);
    }
}
