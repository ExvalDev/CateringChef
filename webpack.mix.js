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
mix.js('resources/js/functions.js', 'public/js')
mix.js('resources/js/search.js', 'public/js')
mix.js('resources/js/supplierCustomer.js', 'public/js')
mix.js('resources/js/toastr.js', 'public/js')
mix.js('resources/js/tables.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .sass('resources/sass/style_auth.scss', 'public/css')
   .sass('resources/sass/style_tables.scss', 'public/css')
   .sass('resources/sass/style_menu.scss', 'public/css')
mix.copyDirectory('resources/php', 'public/php');
mix.copyDirectory('resources/img', 'public/img');
mix.copy('resources/js/menuDnD.js', 'public/js');
