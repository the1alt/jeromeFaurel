var elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

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

elixir(function(mix){
   mix.browserSync({
        proxy: 'localhost:8000'
   });
    // Mixing CSS Files
    mix.styles('./public/skin/default_skin/css/theme.css', 'public/dist/theme.min.css');

    mix.styles('./public/css/main.css', 'public/dist/main.min.css');


    mix.styles([
      './public/admin-tools/admin-forms/css/admin-forms.css',
      './public/vendor/plugins/summernote/summernote.css',
    ], 'public/dist/forms.min.css');

    mix.styles([
        './public/vendor/plugins/datatables/media/css/dataTables.bootstrap.css',
        './public/vendor/plugins/datatables/extensions/Editor/css/dataTables.editor.css',
        './public/vendor/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css'
      ], 'public/dist/index.min.css');

    mix.styles('./public/vendor/plugins/magnific/magnific-popup.css', 'public/dist/magnific-popup.min.css');


    // Mixing JS Files
    mix.scripts([
        './public/vendor/jquery/jquery-1.11.1.min.js',
        './public/vendor/jquery/jquery_ui/jquery-ui.min.js',
        './public/js/utility/utility.js', './public/js/demo/demo.js',
        './public/js/main.js'
      ], 'public/dist/main.min.js');

    mix.scripts('./public/js/custom/custom.js', 'public/dist/custom.min.js' );

    mix.scripts('./public/vendor/plugins/summernote/summernote.min.js', 'public/dist/summernote.min.js' );

    mix.scripts([
        './public/vendor/plugins/datatables/media/js/jquery.dataTables.js',
        './public/vendor/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js',
        './public/vendor/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js',
        './public/vendor/plugins/datatables/media/js/dataTables.bootstrap.js'
      ], 'public/dist/index.min.js' );

    mix.scripts([
        './public/vendor/plugins/magnific/jquery.magnific-popup.js',
        './vendor/bower/masonry/dist/masonry.pkgd.min.js'
      ], 'public/dist/detail.min.js');



});
