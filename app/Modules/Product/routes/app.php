<?php
Route::group(['prefix' => 'products', 'as' => 'product.'], function () {
    Route::get('/', 'ProductsController@showProductsPage')->name('showProductsPage');
    Route::get('/{category}', 'ProductsController@productsByCategory')->name('category');
    Route::get('details/{slug?}', 'ProductsController@details')->name('details');
});

Route::get('/operating-room', 'ProductsController@showOperatingRoomPage')->name('product.showOperatingRoomPage');

Route::group(['prefix' => 'customized', 'as' => 'customized.'], function () {

    Route::get('/', 'CustomizedProductsController@index')->name('index');
    Route::post('/store', 'CustomizedProductsController@store')->name('store');
});
Route::group(['prefix' => 'download-pdf-product'], function () {
    Route::post('/store', 'DownloadPDFProductsController@store')->name('store');
});


