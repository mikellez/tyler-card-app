const mix = require('laravel-mix');

mix.js('app/app.js', 'frontend/web/app.js')
      .setPublicPath('frontend/web')
      .vue();