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
    .sass('resources/sass/app.scss', 'public/css');



mix.styles([
    'resources/css/argon.css',
    'resources/css/nucleo.css',
    'resources/css/loader.css'

], 'public/css/all.css');


mix.scripts([
    'resources/js/myJS/jquery.min.js',
    'resources/js/myJS/bootstrap.bundle.min.js',
    'resources/js/myJS/lodash.js',
    'resources/js/myJS/moment.js',
    'resources/js/myJS/numeral.js',
    'resources/js/myJS/Chart.min.js',
    'resources/js/myJS/Chart.extension.js',
    'resources/js/myJS/argon.js',
    'resources/js/myJS/countryChart.js',
    'resources/js/myJS/liveArgon.js'

],'public/js/all.js');


// LIVE INTERFACE

mix.styles([
    'resources/css/argon.css',
    'resources/css/nucleo.css',
    'resources/css/loader.css',
    'resources/css/live.css'

], 'public/css/live.css');


mix.scripts([
    'resources/js/myJS/jquery.min.js',
    'resources/js/myJS/bootstrap.bundle.min.js',
    'resources/js/myJS/lodash.js',
    'resources/js/myJS/moment.js',
    'resources/js/myJS/numeral.js',
    'resources/js/myJS/Chart.min.js',
    'resources/js/myJS/Chart.extension.js',
    'resources/js/myJS/liveArgon.js',
    'resources/js/myJS/live.js'

],'public/js/live.js');



if (mix.inProduction()) {
    mix.version();
}
