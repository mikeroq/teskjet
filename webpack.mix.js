const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .js('resources/js/app.js', 'public/assets/js/laravel.app.js')
    .js('resources/js/oneui/app.js', 'public/assets/js/teskjet.app.js')
    .combine([
        'resources/js/plugins/easymde.min.js',
        'resources/js/plugins/highlight.min.js',
        'resources/js/plugins/tom-select.complete.min.js'
    ], 'public/assets/js/plugins.js')

    .combine([
        'resources/css/oneui.min.css',
        'resources/css/amethyst.min.css',
        'resources/css/ico.css',
        'resources/css/bootstrap-side-modals.css',
        'resources/css/plugins/sweetalert2.dark.min.css',
        'resources/css/plugins/tom-select.bootstrap5.css',
        'resources/css/plugins/atom-one-dark.min.css',
        'resources/css/plugins/easymde.min.css',
        'resources/css/custom.css'
    ], 'public/assets/css/app.css')

    /* Tools */
    .browserSync('localhost:8000')
    .disableNotifications()
    .options({
        processCssUrls: false
    });

if (mix.inProduction()) {
    mix.version();
}

// .js('resources/js/app.js', 'public/js')

