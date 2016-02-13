var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

    /* Copy fonts */

    mix.copy('public/lib/mdi/fonts', 'public/fonts');

    /* Copy images */

    mix.copy('resources/assets/images', 'public/images');
    mix.copy('resources/assets/favicon.ico', 'public');
    mix.copy('public/lib/material-design-lite/src/images', 'public/images');
    mix.copy('public/lib/lightbox2/dist/images', 'public/images');

    /* Copying custom styles to the public folder */

    mix.sass([
        'resources/assets/sass/app-blue.scss'
    ], 'public/css/app-blue.css', './');

    mix.sass([
        'resources/assets/sass/app-green.scss'
    ], 'public/css/app-green.css', './');

      mix.sass([
        'resources/assets/sass/app-grey.scss'
    ], 'public/css/app-grey.css', './');

     mix.sass([
        'resources/assets/sass/app-red.scss'
    ], 'public/css/app-red.css', './');

     mix.sass([
        'resources/assets/sass/app-purple.scss'
    ], 'public/css/app-purple.css', './');

      mix.sass([
        'resources/assets/sass/app-cyan.scss'
    ], 'public/css/app-cyan.css', './');


    /* Copying all the styles to the public folder */

    mix.styles([
        'public/lib/mdi/css/materialdesignicons.min.css',
        'public/lib/c3/c3.min.css',
        'public/lib/dragula.js/dist/dragula.min.css',
        'public/lib/lightbox2/dist/css/lightbox.css',
        'resources/assets/css/paper-collapse.min.css',
        'public/lib/remodal/dist/remodal.css',
        'public/lib/remodal/dist/remodal-default-theme.css',
        'public/lib/animsition/dist/css/animsition.min.css',
        'public/lib/perfect-scrollbar/css/perfect-scrollbar.min.css',
        'public/lib/growl/stylesheets/jquery.growl.css'
    ], 'public/css/vendor.css', './');

    /* Copying all the scripts to the public folder */

    mix.scripts([
        'public/lib/material-design-lite/material.min.js',
        'public/lib/jquery/dist/jquery.min.js',
        'public/lib/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js',
        'public/lib/chartjs/Chart.min.js',
        'public/lib/d3/d3.min.js',
        'public/lib/c3/c3.min.js',
        'public/lib/dragula.js/dist/dragula.min.js',
        'public/lib/lightbox2/dist/js/lightbox.min.js',
        'resources/assets/js/paper-collapse.min.js',
        'public/lib/remodal/dist/remodal.min.js',
        'public/lib/animsition/dist/js/jquery.animsition.min.js',
        'public/lib/perfect-scrollbar/js/min/perfect-scrollbar.jquery.min.js',
        'public/lib/growl/javascripts/jquery.growl.js'
    ],  'public/js/vendor.js', './');

    /* Livereload */
});
