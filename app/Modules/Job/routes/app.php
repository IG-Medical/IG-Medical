<?php
Route::group(['prefix' => 'jobs'], function () {
    Route::get('/', 'JobController@index')->name('index');
    Route::get('/data', 'JobController@data')->name('data');
    Route::get('/categories/all', 'JobController@categories')->name('categories');
    Route::get('view/{id?}', 'JobController@details')->name('view'); // details
});

Route::group(['prefix' => 'applications'], function () {
    Route::post('/store', 'ApplicationController@store')->name('store');
});


