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

mix.js('resources/js/admin/app.js', 'public/js/admin')
    .js('resources/js/admin/post.js', 'public/js/admin')
    .sass('resources/sass/app.scss', 'public/css/admin')
    .postCss("resources/css/front/app.css", "public/css/front", [
        require("tailwindcss"),
    ])
    .sourceMaps();
