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


    //frontend configuration
    /*
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
    	],'public/js/frontend.js');
    */

    //backend configuration
    /*
    mix.copy(bowerDir + '/bootstrap/css/bootstrap.min.css', vendorCssDir);
    mix.copy(bowerDir + '/select2/css/select2.min.css', vendorCssDir);
    mix.copy(bowerDir + '/bootstrap-toggle/bootstrap-toggle.min.css', vendorCssDir);

    mix.copy(bowerDir + '/jquery/js/jquery.min.js', vendorJsDir);
    mix.copy(bowerDir + '/bootstrap/js/bootstrap.min.js', vendorJsDir);
    mix.copy(bowerDir + '/select2/js/select2.min.js', vendorJsDir);
    mix.copy(bowerDir + '/bootstrap-toggle/bootstrap-toggle.min.js', vendorJsDir);

    mix.styles([
        'vendor/bootstrap.min.css',
        'vendor/select2.min.css',
        'vendor/bootstrap-toggle.min.css'
        ],'public/css/backend.css');


    mix.scripts([
        'vendor/jquery.min.js',
        'vendor/bootstrap.min.js',
        'vendor/select2.min.js',
        'vendor/bootstrap-toggle.min.js'
        ],'public/js/backend.js');
*/

});
