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

    mix.copy('bower_components/mdi/fonts', 'public/fonts');

    /* Copy images */

    mix.copy('resources/assets/images', 'public/images');
    mix.copy('resources/assets/favicon.ico', 'public');
    mix.copy('bower_components/material-design-lite/src/images', 'public/images');
    mix.copy('bower_components/lightbox2/dist/images', 'public/images');

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
        'bower_components/mdi/css/materialdesignicons.min.css',
        'bower_components/c3/c3.min.css',
        'bower_components/dragula.js/dist/dragula.min.css',
        'bower_components/lightbox2/dist/css/lightbox.css',
        'resources/assets/css/paper-collapse.min.css',
        'bower_components/remodal/dist/remodal.css',
        'bower_components/remodal/dist/remodal-default-theme.css',
        'bower_components/animsition/dist/css/animsition.min.css',
        'bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css',
        'bower_components/growl/stylesheets/jquery.growl.css'
    ], 'public/css/vendor.css', './');

    /* Copying all the scripts to the public folder */

    mix.scripts([
        'bower_components/material-design-lite/material.min.js',
        'bower_components/jquery/dist/jquery.min.js',
        'bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js',
        'bower_components/chartjs/Chart.min.js',
        'bower_components/d3/d3.min.js',
        'bower_components/c3/c3.min.js',
        'bower_components/dragula.js/dist/dragula.min.js',
        'bower_components/lightbox2/dist/js/lightbox.min.js',
        'resources/assets/js/paper-collapse.min.js',
        'bower_components/remodal/dist/remodal.min.js',
        'bower_components/animsition/dist/js/jquery.animsition.min.js',
        'bower_components/perfect-scrollbar/js/min/perfect-scrollbar.jquery.min.js',
        'bower_components/growl/javascripts/jquery.growl.js'
    ],  'public/js/vendor.js', './');

    /* Livereload */
});
