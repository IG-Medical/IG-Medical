<?php
Route::get('/news/', 'NewsController@index')->name('news.index');
Route::get('/news/data', 'NewsController@data')->name('news.data');
Route::get('/news/{slug}', 'NewsController@details')->name('news.details');
