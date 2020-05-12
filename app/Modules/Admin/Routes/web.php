<?php

Route::group(['middleware' => ['bindings']], function () {
    // 首页
    Route::get('/', 'IndexController@index');
    // 详情
    Route::get('/articles/show/{article}', 'ArticlesController@show');

    // 栏目下的数据
    Route::get('/articles/columns/{type}', 'ArticlesController@column')->name('articles.column.show');

    // 点赞
    Route::get('/articles/{article}/give', 'ArticlesController@give')->name('articles.give');
    // 收藏
    Route::get('/articles/{article}/collection', 'ArticlesController@collection')->name('articles.collection');
});
