<?php
Route::group(['middleware' => ['un.auth']], function () {

    Route::group(['prefix' => 'settings', 'namespace' => 'Setting'], function () {
        Route::group(['as' => 'setting.'], function () {
            Route::get('{page}', 'SettingController@index')->name('index');
            Route::post('/store', 'SettingController@store')->name('store');
        });
    });

    Route::group(['prefix' => 'appearance', 'namespace' => 'Appearance', 'as' => 'appearance.'], function () {
        Route::get('{page}', 'AppearanceController@index')->name('index');
        Route::post('/store', 'AppearanceController@store')->name('store');
    });


//    Route::group(['prefix' => 'jobs-selection', 'as' => 'jobs_selection.'], function () {
//        Route::post('store', 'JobSelectionController@store')->name('store');
//    });
});

