<?php

Route::group(['middleware' => ['bindings']], function () {
    Route::get('/login', 'LoginController@showLoginForm')->name('login.show');
    // 登录
    Route::post('/login', 'LoginController@login')->name('login');
    // 首页
    Route::get('/', 'IndexController@index');

    // 栏目下的数据
    Route::get('/articles/columns/{type}', 'ArticlesController@column')->name('articles.column.show');

    // 详情
    Route::get('/articles/show/{article}', 'ArticlesController@show')->name('articles.show');

    // 点赞 | 取消点赞
    Route::post('/articles/{article}/give', 'ArticlesController@give')->name('articles.give');

    // 收藏
    Route::get('/articles/{article}/collection', 'ArticlesController@collection')->name('articles.collection');

    // 标签
    Route::get('/tags/{tag}', 'ArticlesController@collection')->name('tags.show');
    Route::middleware(['auth:web', 'bindings'])->group(function () {
        // 退出登录
        Route::post('/logout', 'LoginController@logout')->name('logout');
    });
});
