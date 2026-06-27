<?php

use Distributor\Providers\AppServiceProvider;

Route::group(['middleware' => ['un.auth']], function () {
    Route::prefix(AppServiceProvider::$moduleNamePrefix)
        ->as(AppServiceProvider::$moduleNamespace . '.')->group(function () {
            Route::get('/', 'DistributorController@index')->name('index');
            Route::get('create', 'DistributorController@create')->name('create');
            Route::get('/data', 'DistributorController@data')->name('data');
            Route::post('/store', 'DistributorController@store')->name('store');
            Route::get('{id}/edit', 'DistributorController@edit')->name('edit');
            Route::delete('{id}/delete', 'DistributorController@destroy')->name('destroy');
        });
});

