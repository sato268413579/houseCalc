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
    .js('resources/js/calc.js', 'public/js/')
    .js('resources/js/beforeMonthShow.js', 'public/js')
    // .js('resources/js/infoRegister.js', 'public/js')
    .js('resources/js/monthRegister.js', 'public/js')
    .js('resources/js/navActive.js', 'public/js')
    .js('resources/js/todayRegister.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();
mix.version();
