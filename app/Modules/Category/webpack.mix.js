const mix = require('laravel-mix');

require('laravel-mix-merge-manifest');

mix.mergeManifest();

mix.js(__dirname + '/resources/js/app.js', 'js/app/category.js').
js(__dirname + '/resources/js/admin.js', 'js/admin/category.js');
