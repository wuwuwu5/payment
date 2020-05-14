<?php

Route::name('admin.')->group(function () {

    Route::middleware(['auth:admin', 'bindings'])->group(function () {
        // 文章
        Route::resource('/articles', 'ArticlesController');
        {
            // 发布
            Route::patch('/articles/{article}/publish', 'ArticlesController@publish')->name('articles.publish');
            // 推荐
            Route::patch('/articles/{article}/commend', 'ArticlesController@commend')->name('articles.commend');

            // 获取子类 todo 更换成updatePatch
            Route::get('/articles/{category}/children', 'ArticlesController@column2')->name('articles.column2');
        }
    });
});
