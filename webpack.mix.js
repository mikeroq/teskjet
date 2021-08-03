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
    .js('resources/js/dashmix/app.js', 'public/js/dashmix.app.js')
    .js('resources/js/dashmix/custom.js', 'public/js/custom.js')
    .js('resources/js/app.js', 'public/js/laravel.app.js')
    .js('resources/js/pages/tables_datatables.js', 'public/js/pages/tables_datatables.js')

    /* Tools */
    .browserSync('localhost:8000')
    .disableNotifications()
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import')
    ])
    .options({
        processCssUrls: false
    });

if (mix.inProduction()) {
    mix.version();
}

// .js('resources/js/app.js', 'public/js')

