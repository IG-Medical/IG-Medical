<?php

use Slider\Providers\AppServiceProvider;

Route::group(['middleware' => ['un.auth']], function () {
    Route::prefix(AppServiceProvider::$moduleNamePrefix)
        ->as(AppServiceProvider::$moduleNamespace . '.')->group(function () {
            Route::get('/', 'SliderController@index')->name('index');
            Route::get('create', 'SliderController@create')->name('create');
            Route::get('/data', 'SliderController@data')->name('data');
            Route::post('/store', 'SliderController@store')->name('store');
            Route::get('{id}/edit', 'SliderController@edit')->name('edit');
            Route::delete('{id}/delete', 'SliderController@destroy')->name('destroy');
        });
});

