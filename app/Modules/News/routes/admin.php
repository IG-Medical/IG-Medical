<?php

use News\Providers\AppServiceProvider;

Route::group(['middleware' => ['un.auth']], function () {
    Route::prefix(AppServiceProvider::$moduleNamePrefix)
        ->as(AppServiceProvider::$moduleNamespace . '.')->group(function () {
            Route::get('/', 'NewsController@index')->name('index');
            Route::get('/create', 'NewsController@create')->name('create');
            Route::post('/store', 'NewsController@store')->name('store');
            Route::get('data', 'NewsController@data')->name('data');
            Route::get('{id}/edit', 'NewsController@edit')->name('edit');
            Route::delete('{id}/delete', 'NewsController@destroy')->name('delete');
        });

});

