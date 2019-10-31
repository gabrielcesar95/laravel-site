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

mix
/*
*********************** Custom CSS ***********************
.styles([
    'resources/views/web/assets/css/file1.css',
    'resources/views/web/assets/css/file2.css',
], 'public/web/assets/css/vendor.css')

*/
/*
************************ Custom JS ***********************
.scripts([
    'resources/views/web/assets/css/file1.js',
    'resources/views/web/assets/css/file2.js',
], 'public/web/assets/css/custom.js')
*/
    .js('resources/views/web/assets/js/scripts.js', 'public/web/assets/js')
    .sass('resources/views/web/assets/sass/web.scss', 'public/web/assets/css')
    .styles([
        'resources/views/web/assets/css/styles.css',
    ], 'public/web/assets/css/styles.css')
    .copyDirectory('resources/views/web/assets/img', 'public/web/assets/img')
    .options({
        processCssUrls: false,
    })
    .version()
;

/* ****************************************************** */
/* ************************* ADMIN ********************** */
/* ****************************************************** */

mix
/*
*********************** Custom CSS ***********************
.styles([
    'resources/views/admin/assets/css/file1.css',
    'resources/views/admin/assets/css/file2.css',
], 'public/admin/assets/css/vendor.css')

*/
/*
************************ Custom JS ***********************
.scripts([
    'resources/views/admin/assets/css/file1.js',
    'resources/views/admin/assets/css/file2.js',
], 'public/admin/assets/css/custom.js')
*/
    .js('resources/views/admin/assets/js/scripts.js', 'public/admin/assets/js')
    .scripts([
        'resources/views/admin/assets/js/adminLTE.js',
    ], 'public/admin/assets/js/adminLTE.js')
    .sass('resources/views/admin/assets/sass/admin.scss', 'public/admin/assets/css')
    .styles([
        'resources/views/admin/assets/css/adminLTE.css',
        'resources/views/admin/assets/css/styles.css',
    ], 'public/admin/assets/css/styles.css')
    .copyDirectory('resources/views/admin/assets/css/skins', 'public/admin/assets/css/skins')
    .copyDirectory('resources/views/admin/assets/fonts', 'public/admin/assets/fonts')
    .copyDirectory('node_modules/ckeditor', 'public/admin/assets/js/ckeditor')
    .copyDirectory('node_modules/@mdi/font/fonts', 'public/admin/assets/fonts')
    .scripts([
        'resources/views/admin/assets/js/ckeditor/config.js'
    ], 'public/admin/assets/js/ckeditor/config.js')
    .options({
        processCssUrls: false,
    })
    .version()
;

mix.browserSync({
    proxy: 'localhost:8000',
    port: 8001
});
