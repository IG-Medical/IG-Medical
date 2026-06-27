<?php

use Contact\Providers\AppServiceProvider;

Route::group(['middleware' => ['un.auth']], function () {
    Route::prefix(AppServiceProvider::$moduleNamePrefix)
        ->as(AppServiceProvider::$moduleNamespace . '.')->group(function () {
            Route::get('/', 'ContactUSController@index')->name('index');
            Route::get('/data', 'ContactUSController@data')->name('data');
            Route::put('{id}/archive', 'ContactUSController@archive')->name('archive');
        });
});

