<?php

use Contact\Providers\AppServiceProvider;

Route::group([], function () {
    Route::prefix('contact-us')
        ->as(AppServiceProvider::$moduleNamespace . '.')->group(function () {
            Route::get('/', 'ContactUSController@index')->name('index');
            Route::post('/store', 'ContactUSController@store')->name('store');
        });
});
