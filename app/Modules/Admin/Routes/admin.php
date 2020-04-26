<?php

Route::name('admin.')->group(function () {
    // 登录页面
    Route::get('/login', 'LoginController@showLoginForm')->name('login.show');
    // 登录
    Route::post('/login', 'LoginController@login')->name('login');
    // 验证码
    Route::get('/captcha', 'LoginController@captcha')->name('captcha');

    Route::middleware(['auth:admin'])->group(function () {
        // 首页
        Route::get('/index', 'HomeController@index')->name('home');

        // 用户管理
        Route::resource('/users', 'UsersController');

        // 重置密码
        Route::patch('/users/{user}/password', 'UsersController@resetPassword')->name('users.reset.password');

        // 权限
        Route::resource('/permissions', 'PermissionsController');

        // 角色
        Route::resource('/roles', 'RolesController');
    });

});
