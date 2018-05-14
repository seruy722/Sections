let mix = require('laravel-mix');

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

mix.styles([
	'resources/assets/front/css/bootstrap.min.css',
	'resources/assets/front/css/custom.css',
	'resources/assets/front/css/style.css'
],'public/css/front.css');

mix.copy('resources/assets/front/img', 'public/images');
