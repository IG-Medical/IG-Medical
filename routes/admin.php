<?php
Route::group(['middleware' => ['un.auth']], function () {

    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
        Route::get('/', 'DashboardController@index')->name('index');
    });


    Route::group(['prefix' => 'mailing-lists', 'namespace' => 'MailingList', 'as' => 'mailing_list.'], function () {
        Route::get('/', 'MailingListController@index')->name('index');
        Route::get('/data', 'MailingListController@data')->name('data');
    });
    
    Route::group(['prefix' => 'navbar-items', 'as' => 'navbar-items.'], function () {
        Route::get('/', 'NavbarItemController@index')->name('index');
        Route::post('/', 'NavbarItemController@store')->name('store');
        Route::put('/{navbarItem}', 'NavbarItemController@update')->name('update');
        Route::delete('/{navbarItem}', 'NavbarItemController@destroy')->name('destroy');
        Route::post('/reorder', 'NavbarItemController@reorder')->name('reorder');
    });

    Route::group(['prefix' => 'banners', 'as' => 'banners.'], function () {
        Route::get('/', 'BannerController@index')->name('index');
        Route::get('/create', 'BannerController@create')->name('create');
        Route::post('/', 'BannerController@store')->name('store');
        Route::get('/{banner}/edit', 'BannerController@edit')->name('edit');
        Route::put('/{banner}', 'BannerController@update')->name('update');
        Route::delete('/{banner}', 'BannerController@destroy')->name('destroy');
    });

    Route::prefix('dev')->group(function () {
        Route::get('clear-all', 'ClearCacheController@clearAll')->name('clear_all');
        Route::get('clear-cache', 'ClearCacheController@clearCache')->name('clear_cache');
        Route::get('clear-view', 'ClearCacheController@clearView')->name('clear_view');
        Route::get('clear-route', 'ClearCacheController@clearRoute')->name('clear_route');
        Route::get('clear-config', 'ClearCacheController@clearConfig')->name('clear_config');
        Route::get('clear-compiled', 'ClearCacheController@clearCompiled')->name('clear_compiled');
    });
});

