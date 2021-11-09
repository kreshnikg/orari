const mix = require('laravel-mix');

mix.react('resources/js/app.js', 'public/js')
   .sass('resources/scss/app.scss', 'public/css')
    .setPublicPath('public');
