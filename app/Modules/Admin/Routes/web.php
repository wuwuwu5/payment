<?php

Route::group(['middleware' => ['bindings']], function () {
    // 首页
    Route::get('/', 'IndexController@index');
    // 详情
    Route::get('/articles/show/{article}', 'ArticlesController@show');
});
