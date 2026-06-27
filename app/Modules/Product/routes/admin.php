<?php

use Product\Providers\AppServiceProvider;

Route::group(['middleware' => ['un.auth']], function () {
    Route::prefix(AppServiceProvider::$moduleNamePrefix)->as(AppServiceProvider::$moduleNamespace . '.')->namespace('Product')->group(function () {
        Route::get('/', 'ProductController@index')->name('index');
        Route::get('create', 'ProductController@create')->name('create');
        Route::get('/data', 'ProductController@data')->name('data');
        Route::post('/store', 'ProductController@store')->name('store');
        Route::post('/update', 'ProductController@update')->name('update');
        Route::get('{id}/edit', 'ProductController@edit')->name('edit');
        Route::delete('{id}/delete', 'ProductController@destroy')->name('destroy');
        Route::put('{id}/restore', 'ProductController@restore')->name('restore');
        Route::delete('{id}/force-delete', 'ProductController@forceDelete')->name('forceDelete');
        Route::get('{id}/get', 'ProductController@getCategoryByID');
        Route::get('accept-download-file', 'ProductController@acceptDownloadFile')->name('acceptDownloadFile');
    });

    Route::prefix('attribute-sets')->as('attribute_set.')->namespace('AttributeSets')->group(function () {
        Route::get('/', 'AttributeSetsController@index')->name('index');
        Route::get('create', 'AttributeSetsController@create')->name('create');
        Route::get('/data', 'AttributeSetsController@data')->name('data');
        Route::get('/all', 'AttributeSetsController@all')->name('all');
        Route::get('/allWithAttribute', 'AttributeSetsController@allWithAttribute')->name('allWithAttribute');
        Route::post('/store', 'AttributeSetsController@store')->name('store');
        Route::get('{id}/edit', 'AttributeSetsController@edit')->name('edit');
        Route::delete('{id}/delete', 'AttributeSetsController@destroy')->name('destroy');
    });

    Route::prefix('attributes')->as('attribute.')->namespace('Attribute')->group(function () {
        Route::get('/', 'AttributeController@index')->name('index');
        Route::get('create', 'AttributeController@create')->name('create');
        Route::get('/data', 'AttributeController@data')->name('data');
        Route::get('/all', 'AttributeController@all')->name('all');
        Route::post('/store', 'AttributeController@store')->name('store');
        Route::get('{id}/edit', 'AttributeController@edit')->name('edit');
        Route::delete('{id}/delete', 'AttributeController@destroy')->name('destroy');
    });

    Route::prefix('attribute-values')->as('attribute_value.')->namespace('AttributeValue')->group(function () {
        Route::get('/search', 'AttributeValueController@search')->name('search');
    });

//    Route::prefix('options')->as('option.')->namespace('Option')->group(function () {
//        Route::get('/', 'OptionController@index')->name('index');
//        Route::get('create', 'OptionController@create')->name('create');
//        Route::get('/data', 'OptionController@data')->name('data');
//        Route::post('/store', 'OptionController@store')->name('store');
//        Route::get('{id}/edit', 'OptionController@edit')->name('edit');
//        Route::delete('{id}/delete', 'OptionController@destroy')->name('destroy');
//        Route::get('{id}/get', 'OptionController@getCategoryByID');
//    });
});

