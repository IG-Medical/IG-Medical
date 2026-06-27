<?php
Route::group(['prefix' => ADMIN_PREFIX, 'as' => ADMIN_ROUTE.'.'], function () {
    Route::get('auth', 'AdminLoginController@showLoginForm')->name('login');
    Route::post('auth', 'AdminLoginController@login')->name('do_login');
    Route::any('logout', 'AdminLoginController@logout')->name('logout');
//
//    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.do_email');
//    Route::get('password/reset', 'ResetPasswordController@showResetForm')->name('password.reset');
//    Route::post('password/reset', 'ResetPasswordController@reset')->name('password.do_reset');
});

Route::post('register', 'RegisterController@register')->name('register');
Route::post('login', 'LoginController@login')->name('do_login');
Route::any('logout', 'LoginController@logout')->name('logout');

Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.do_email');
Route::get('password/reset', 'ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'ResetPasswordController@reset')->name('password.do_reset');
