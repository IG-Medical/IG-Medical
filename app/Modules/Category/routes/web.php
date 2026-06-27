?php

Route::namespace(buildNamespace('User'))->group(function () {

    Route::prefix(buildModulePrefix('users', 'admin'))
        ->namespace(buildModuleNamespace('projects', 'admin'))->group(function () {
            require 'admin.php';
        });

    Route::prefix(buildModulePrefix('users', 'app'))
        ->namespace('App')->group(function () {
            require 'app.php';
        });
});


