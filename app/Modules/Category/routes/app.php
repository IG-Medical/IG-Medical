<?php

Route::prefix('categories')->as('category.')->namespace('Category')->group(function () {
    Route::get('/', 'CategoryController@index')->name('index');
    Route::get('/all', 'CategoryController@all')->name('all');
});
