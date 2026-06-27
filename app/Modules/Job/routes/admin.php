<?php

Route::group(['middleware' => ['un.auth']], function () {

    Route::prefix('jobs')->as('job.')->group(function () {
//        Route::get('/export', 'JobExportController@export')->name('export');

        Route::get('/', 'JobController@index')->name('index');
        Route::get('/create', 'JobController@create')->name('create');
        Route::post('/store', 'JobController@store')->name('store');
        Route::get('data', 'JobController@data')->name('data');
        Route::get('{id}/edit', 'JobController@edit')->name('edit');
        Route::get('{id}/view', 'JobController@view')->name('view');
        Route::delete('{id}/delete', 'JobController@destroy')->name('delete');


        Route::prefix('categories')->as('category.')->group(function () {
            Route::get('/', 'CategoryJobController@index')->name('index');
            Route::get('/all', 'CategoryJobController@all')->name('all');
            Route::get('/data', 'CategoryJobController@data')->name('data');
            Route::get('/create', 'CategoryJobController@create')->name('create');
            Route::post('/store', 'CategoryJobController@store')->name('store');
            Route::get('{id}/edit', 'CategoryJobController@edit')->name('edit');
            Route::delete('{id}/delete', 'CategoryJobController@destroy')->name('delete');
        });

        Route::prefix('applications')->as('application.')->group(function () {
            Route::get('/data', 'CareerApplicationController@data')->name('data');
            Route::get('/{id}/details', 'CareerApplicationController@details')->name('details');
        });
    });
});

