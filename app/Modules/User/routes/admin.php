<?php
Route::group(['middleware' => ['un.auth','is_admin']], function () {

    Route::group(['prefix' => 'my-profile', 'namespace' => 'MyProfile', 'as' => 'my_profile.'], function () {
        Route::get('/', 'MyProfileAdminController@index')->name('index');
        Route::post('/store', 'MyProfileAdminController@store')->name('basic_info.update');
        Route::post('/change-password', 'ChangePasswordController@update')->name('change_password.update');
    });


    Route::group(['prefix' => 'admins', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
        Route::get('/', 'AdminController@index')->name('index');
        Route::get('create', 'AdminController@create')->name('create');
        Route::post('/store', 'AdminController@store')->name('store');
        Route::get('/data', 'AdminController@data')->name('route');
        Route::get('{id}/edit', 'AdminController@edit')->name('edit');
        Route::delete('{id}/delete', 'AdminController@destroy')->name('destroy');
    });

    Route::group(['prefix' => 'permissions', 'namespace' => 'Permission', 'as' => 'permission.'], function () {
        Route::get('/', 'PermissionController@index')->name('index');
        Route::get('/all', 'PermissionController@all')->name('all');
    });


    Route::group(['prefix' => 'roles', 'namespace' => 'Role', 'as' => 'role.'], function () {
        Route::get('/', 'RoleController@index')->name('index');
        Route::get('create', 'RoleController@create')->name('create');
        Route::post('/store', 'RoleController@store')->name('store');
        Route::get('/data', 'RoleController@data')->name('route');
        Route::get('/all', 'RoleController@all')->name('all');
        Route::get('{id}/edit', 'RoleController@edit')->name('edit');
        Route::delete('{id}/delete', 'RoleController@destroy')->name('destroy');
    });
});

