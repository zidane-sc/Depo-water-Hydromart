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

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css');


 
 
 
 

mix.scripts([
    'public/backend/lib/jquery/jquery.min.js',
    'public/backend/lib/bootstrap/js/bootstrap.bundle.min.js',
    'public/backend/lib/perfect-scrollbar/perfect-scrollbar.min.js',
    // 'public/backend/lib/moment/min/moment.min.js',
    // 'public/backend/lib/peity/jquery.peity.min.js',
    'public/backend/lib/echarts/echarts.min.js',
    'public/backend/lib/chart.js/Chart.min.js',
    'public/backend/lib/select2/js/select2.full.min.js',
    'public/backend/lib/datatables.net/js/jquery.dataTables.min.js',
    'public/backend/lib/datatables.net-dt/js/dataTables.dataTables.min.js',
    'public/backend/lib/datatables.net-responsive/js/dataTables.responsive.min.js',
    'public/backend/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js',
    'public/backend/lib/jquery.maskedinput/jquery.maskedinput.js',
    'public/backend/lib/bootstrap-tagsinput/bootstrap-tagsinput.min.js',
    'public/backend/lib/jquery-confirm/js/jquery-confirm.js',
    'public/backend/js/notify.min.js',
    'public/backend/js/toastr.min.js',
    'public/backend/js/socket.io.js',
    'public/backend/js/bracket.js',
    'public/backend/js/marquee.js',
    'public/backend/js/bootstrap-datepicker.js',
    'public/backend/js/ResizeSensor.js',
    'public/backend/js/axios.min.js',
    'public/backend/js/progressbar-index.js',
    'public/backend/js/bootstrap-select.min.js',
    'public/backend/js/custom.js',
], 'public/js/app.js')
    .styles([
        'public/backend/lib/select2/css/select2.min.css',
        'public/backend/lib/jquery-confirm/css/jquery-confirm.css',
        'public/backend/css/toastr.min.css',
        'public/backend/css/marquee.css',
        'public/backend/css/bootstrap-datepicker3.min.css',
        'public/backend/css/animate.css',
        'public/backend/css/bootstrap-select.min.css',
        'public/backend/css/nprogress.css',
    ], 'public/css/app.css');


 

  


      
       
  
 