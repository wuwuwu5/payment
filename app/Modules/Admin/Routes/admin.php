<?php

Route::name('admin.')->group(function () {
    // 登录页面
    Route::get('/login', 'LoginController@showLoginForm')->name('login.show');
    // 登录
    Route::post('/login', 'LoginController@login')->name('login');
    // 验证码
    Route::get('/captcha', 'LoginController@captcha')->name('captcha');

    Route::middleware(['auth:admin', 'bindings'])->group(function () {

        // 退出登录
        Route::post('/logout', 'LoginController@logout')->name('logout');

        // 首页
        Route::get('/index', 'HomeController@index')->name('home');

        // 用户管理
        Route::resource('/users', 'UsersController');
        // 更新用户状态
        Route::patch('/users/{user}/status', 'UsersController@updateStatus')->name('users.status');

        // 重置密码
        Route::patch('/users/{user}/password', 'UsersController@resetPassword')->name('users.reset.password');

        // 权限
        Route::resource('/permissions', 'PermissionsController');

        // 角色
        Route::resource('/roles', 'RolesController');

        // 基础设置
        Route::resource('/settings', 'SettingsController');

        // upload token
        Route::get('/upload_token', 'FileUploadController@token')->name('upload.token');

        // upload
        Route::post('/upload', 'FileUploadController@store')->name('upload');

        // 分类|目录等
        Route::resource('/categories', 'CategoriesController');
        // 更新状态
        Route::patch('/categories/{category}/status', 'CategoriesController@updateStatus')->name('categories.status');

        // 图标
        Route::get('/icon', 'IconController@index')->name('icon.index');

        // 文章
        Route::resource('/articles', 'ArticlesController');
        {
            // 发布
            Route::patch('/articles/{article}/publish', 'ArticlesController@publish')->name('articles.publish');

            // 获取子类
            Route::get('/articles/{category}/children', 'ArticlesController@column2')->name('articles.column2');
        }

        // 轮播图
        Route::resource('/slides', 'SlidesController');
        {
            // 发布
            Route::patch('/slides/{slide}/publish', 'SlidesController@publish')->name('slides.publish');
        }
    });
});
