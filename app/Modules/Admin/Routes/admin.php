<?php

Route::name('admin.')->group(function () {
    Route::get('/index', 'HomeController@index')->name('home');

    // 用户管理
    Route::resource('/users', 'UsersController');
    // 重置密码
    Route::patch('/users/{user}/password', 'UsersController@resetPassword')->name('users.reset.password');
});
