<?php

use Testimonial\Providers\AppServiceProvider;

Route::group(['middleware' => ['un.auth']], function () {
    Route::prefix(AppServiceProvider::$moduleNamePrefix)
        ->as(AppServiceProvider::$moduleNamespace . '.')->group(function () {
            Route::get('/', 'TestimonialController@index')->name('index');
            Route::get('create', 'TestimonialController@create')->name('create');
            Route::get('/data', 'TestimonialController@data')->name('data');
            Route::post('/store', 'TestimonialController@store')->name('store');
            Route::get('{id}/edit', 'TestimonialController@edit')->name('edit');
            Route::delete('{id}/delete', 'TestimonialController@destroy')->name('destroy');
        });
});

