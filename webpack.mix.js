const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps()
    .js([
        //backend js
        'public/js/jquery.min.js',
        // 'public/plugins/bootstrap/bootstrap.min.js',
        'public/plugins/bootstrap/js/bootstrap.bundle.min.js',
        'public/dist/js/adminlte.min.js',
        'public/js/jquery-ui.js',
    ], 'public/js/min/backend.min.js')
    .styles([
        'public/css/jquery-ui.css',
        'public/dist/css/adminlte.min.css',
        'public/css/backend.css',
   ], 'public/css/min/backend.min.css');
