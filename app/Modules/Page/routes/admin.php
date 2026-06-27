<?php

use Page\Providers\AppServiceProvider;

Route::group(['middleware' => ['un.auth']], function () {
    Route::prefix(AppServiceProvider::$moduleNamePrefix)
        ->as(AppServiceProvider::$moduleNamespace . '.')->group(function () {
            Route::get('/', 'PageController@index')->name('index');
            Route::get('/create', 'PageController@create')->name('create');
            Route::post('/store', 'PageController@store')->name('store');
            Route::get('data', 'PageController@data')->name('data');
            Route::get('{id}/edit', 'PageController@edit')->name('edit');
            Route::delete('{id}/delete', 'PageController@destroy')->name('delete');
        });

});

