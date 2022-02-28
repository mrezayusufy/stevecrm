const mix = require('laravel-mix');
require('purgeCss');
mix.js('resources/js/app.js', 'public/js')
    .sass('packages/Webkul/Admin/src/Resources/assets/sass/app.scss', 'public/css', [

    ]);
