<?php

Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/about-us', 'HomeController@showAboutUsPage')->name('home.about_us');
Route::get('/certifications', 'HomeController@showCertificationsPage')->name('home.certification');
Route::post('/subscribe-email', 'HomeController@subscribeEmail')->name('home.subscribeEmail');
