<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/pay', 'PayController@index')->name('pay.show');
Route::post('/pay', 'PayController@pay')->name('pay.store');

Route::any('/wechat_token', 'WeChatController@token');

// 授权回调
Route::any('/oauth_callback', 'WeChatController@oauth_callback');

// 支付回调
Route::any('/notify', 'PayController@notify');

Route::name('admin.')->group(function () {
    Route::middleware(['auth:admin', 'bindings'])->group(function () {
        Route::resource('/admin/orders', 'OrdersController');
    });
});


Route::post('/post_users', 'PostUsersController@store')->name('post_users.store');
