<?php

use Category\Providers\AppServiceProvider;

Route::group(['middleware' => ['un.auth']], function () {
    Route::prefix(AppServiceProvider::$moduleNamePrefix)
        ->as(AppServiceProvider::$moduleNamespace . '.')->group(function () {
            Route::get('/', 'CategoryController@index')->name('index');
            Route::get('/data', 'CategoryController@data')->name('data');
            Route::post('/store', 'CategoryController@store')->name('store');
            Route::get('{id}/edit', 'CategoryController@edit')->name('edit');
            Route::delete('{id}/delete', 'CategoryController@destroy')->name('destroy');
            Route::get('{id}/get', 'CategoryController@getCategoryByID');
        });
});

