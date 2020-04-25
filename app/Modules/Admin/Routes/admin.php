<?php

Route::name('admin.')->group(function () {
    Route::get('/index', 'HomeController@index')->name('home');
    Route::resource('/users', 'UsersController');
});
