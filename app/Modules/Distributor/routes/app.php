<?php

Route::group(['prefix' => 'distributors', 'as' => 'distributor.'], function () {
    Route::get('/', 'DistributorController@index')->name('index');
    Route::get('/data', 'DistributorController@data')->name('data');
    Route::get('/details', 'DistributorController@details')->name('details');
});
