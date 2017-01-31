const { mix } = require('laravel-mix');

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

mix.copy('resources/assets/pages/', 'public/js', false)
    .copy('resources/assets/css/', 'public/css', false)
    .copy('resources/assets/plugins/', 'public/plugins', false)
    .copy('resources/assets/images/', 'public/images', false);

mix.js('resources/assets/js/app.js', 'public/js/app.js')
    .sass('resources/assets/sass/app.scss', 'public/css');