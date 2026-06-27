<?php
Route::group(['namespace' => 'APIs'], function () {

    Route::group(['prefix' => 'v1', 'namespace' => 'V1'], function () {

        Route::group(['middleware' => ['auth:api']], function () {
        });
        Route::group(['prefix' => 'settings'], function () {

        });
    });
});
