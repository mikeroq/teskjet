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
    .js('resources/js/app.js', 'public/js/laravel.app.js')
    .js('resources/js/oneui/app.js', 'public/js/oneui.app.js')

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

