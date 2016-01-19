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

elixir.config.sourcemaps = false;//not create file *.map
elixir(function(mix) {
    // mix.sass('app.scss');
    //mix.scripts(['app.js','control.js'],'vendor.js');
    //mix.scripts('tools/geolocation.js','public/js/tools/geolocation.js');

    var vendorCssDir = 'resources/assets/css/vendor';
    var vendorJsDir = 'resources/assets/js/vendor';
    var bowerDir = 'public/vendor';

    mix.copy(bowerDir + '/bootstrap/css/bootstrap.min.css', vendorCssDir);
    mix.copy(bowerDir + '/flatty/main.css', vendorCssDir);
    mix.copy(bowerDir + '/jquery-ui/jquery-ui.min.css', vendorCssDir);

    mix.copy(bowerDir + '/jquery/js/jquery-1.min.js', vendorJsDir);
    mix.copy(bowerDir + '/jquery-ui/jquery-ui.min.js', vendorJsDir);

    mix.styles([
    	'vendor/bootstrap.min.css',
    	'vendor/main.css',
    	'vendor/jquery-ui.min.css'
    	],'public/css/frontend.css');


    mix.scripts([
    	'vendor/jquery-1.min.js',
    	'vendor/jquery-ui.min.js'
    	],'public/js/frontend.js')

});
