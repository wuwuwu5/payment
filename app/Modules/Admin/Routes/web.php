<?php

Route::group(['middleware' => ['bindings']], function () {
    // 首页
    Route::get('/', 'IndexController@index');

    // 栏目下的数据
    Route::get('/articles/columns/{type}', 'ArticlesController@column')->name('articles.column.show');

    // 详情
    Route::get('/articles/show/{article}', 'ArticlesController@show')->name('articles.show');

    // 点赞
    Route::post('/articles/{article}/give', 'ArticlesController@give')->name('articles.give');

    // 取消点赞
    Route::post('/articles/{article}/cancel_give', 'ArticlesController@cancelGive')->name('articles.cancel_give');

    // 收藏
    Route::get('/articles/{article}/collection', 'ArticlesController@collection')->name('articles.collection');

    // 标签
    Route::get('/tags/{tag}', 'ArticlesController@collection')->name('tags.show');
});
