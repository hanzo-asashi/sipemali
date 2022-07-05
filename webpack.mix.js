const mix = require('laravel-mix');
const lodash = require("lodash");
const WebpackRTLPlugin = require('webpack-rtl-plugin');
let distPath = "public/";

if(process.env.APP_ENV === 'production'){
    distPath = "public_html/";
}

const folder = {
    src: "resources/", // source files
    dist: distPath, // build files
    dist_assets: distPath + "assets/" //build assets files
};
// const Modals = require('./vendor/bastinald/laravel-livewire-modals/resources/js/modals');

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

var third_party_assets = {
    css_js: [

        { "name": "flatpickr", "assets": ["./node_modules/flatpickr/dist/flatpickr.min.js", "./node_modules/flatpickr/dist/flatpickr.min.css"] },
        { "name": "@ckeditor", "assets": ["./node_modules/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"] },
        { "name": "feather-icons", "assets": ["./node_modules/feather-icons/dist/feather.min.js"] },
        { "name": "swiper", "assets": ["./node_modules/swiper/swiper-bundle.min.js", "./node_modules/swiper/swiper-bundle.min.css"] },
        { "name": "glightbox", "assets": ["./node_modules/glightbox/dist/js/glightbox.min.js", "./node_modules/glightbox/dist/css/glightbox.min.css"] },
        { "name": "nouislider", "assets": ["./node_modules/nouislider/dist/nouislider.min.js", "./node_modules/nouislider/dist/nouislider.min.css"] },
        { "name": "@curiosityx", "assets": ["./node_modules/@curiosityx/bootstrap-session-timeout/index.js"] },
        { "name": "wnumb", "assets": ["./node_modules/wnumb/wNumb.min.js"] },
        { "name": "rater-js", "assets": ["./node_modules/rater-js/index.js"] },
        { "name": "@simonwep", "assets": ["./node_modules/@simonwep/pickr/dist/pickr.min.js", "./node_modules/@simonwep/pickr/dist/pickr.es5.min.js", "./node_modules/@simonwep/pickr/dist/themes/classic.min.css", "./node_modules/@simonwep/pickr/dist/themes/monolith.min.css", "./node_modules/@simonwep/pickr/dist/themes/nano.min.css"] },
        { "name": "pristinejs", "assets": ["./node_modules/pristinejs/dist/pristine.min.js"] },
        { "name": "pace-js", "assets": ["./node_modules/pace-js/pace.min.js"] },
        { "name": "imask", "assets": ["./node_modules/imask/dist/imask.min.js"] },
        { "name": "twitter-bootstrap-wizard", "assets": ["./node_modules/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js", "./node_modules/twitter-bootstrap-wizard/prettify.js", "./node_modules/twitter-bootstrap-wizard/prettify.css"] },
        { "name": "choice-js", "assets": ["./node_modules/choices.js/public/assets/styles/choices.min.css", "./node_modules/choices.js/public/assets/scripts/choices.min.js"] },

        { "name": "jquery", "assets": ["./node_modules/jquery/dist/jquery.min.js"] },
        { "name": "bootstrap", "assets": ["./node_modules/bootstrap/dist/js/bootstrap.bundle.js"] },
        { "name": "metismenu", "assets": ["./node_modules/metismenu/dist/metisMenu.js"] },
        { "name": "simplebar", "assets": ["./node_modules/simplebar/dist/simplebar.js"] },
        { "name": "node-waves", "assets": ["./node_modules/node-waves/dist/waves.js"] },
        { "name": "chart-js", "assets": ["./node_modules/chart.js/dist/Chart.bundle.min.js"] },
        { "name": "apexcharts", "assets": ["./node_modules/apexcharts/dist/apexcharts.min.js"] },
        {
            "name": "datatables", "assets": ["./node_modules/datatables.net/js/jquery.dataTables.min.js",
                "./node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js",
                "./node_modules/datatables.net-responsive/js/dataTables.responsive.min.js",
                "./node_modules/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js",
                "./node_modules/datatables.net-buttons/js/dataTables.buttons.min.js",
                "./node_modules/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js",
                "./node_modules/datatables.net-buttons/js/buttons.html5.min.js",
                "./node_modules/datatables.net-buttons/js/buttons.flash.min.js",
                "./node_modules/datatables.net-buttons/js/buttons.print.min.js",
                "./node_modules/datatables.net-buttons/js/buttons.colVis.min.js",
                "./node_modules/datatables.net-keytable/js/dataTables.keyTable.min.js",
                "./node_modules/datatables.net-select/js/dataTables.select.min.js",
                "./node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css",
                "./node_modules/datatables.net-responsive-bs4/css/responsive.bootstrap4.css",
                "./node_modules/datatables.net-buttons-bs4/css/buttons.bootstrap4.css",
                "./node_modules/datatables.net-select-bs4/css/select.bootstrap4.css"]

        },
        { "name": "pdfmake", "assets": ["./node_modules/pdfmake/build/pdfmake.min.js", "./node_modules/pdfmake/build/vfs_fonts.js"] },
        { "name": "jszip", "assets": ["./node_modules/jszip/dist/jszip.min.js"] },
        { "name": "curiosityx", "assets": ["./node_modules/@curiosityx/bootstrap-session-timeout/index.js"] },
        { "name": "bootstrap-datepicker", "assets": ["./node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js", "./node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"] },
        { "name": "datepicker", "assets": ["./node_modules/@chenfengyuan/datepicker/dist/datepicker.min.js", "./node_modules/@chenfengyuan/datepicker/dist/datepicker.min.css"] },
        { "name": "bootstrap-timepicker", "assets": ["./node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css", "./node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"] },
        { "name": "tui-chart", "assets": ["./node_modules/tui-chart/dist/tui-chart-all.min.js", "./node_modules/tui-chart/dist/maps/usa.js", "./node_modules/tui-chart/dist/tui-chart.min.css"] },
        { "name": "tui-code-snippet", "assets": ["./node_modules/tui-code-snippet/dist/tui-code-snippet.min.js"] },
        { "name": "tui-dom", "assets": ["./node_modules/tui-dom/dist/tui-dom.min.js"] },
        { "name": "tui-time-picker", "assets": ["./node_modules/tui-time-picker/dist/tui-time-picker.min.js", "./node_modules/tui-time-picker/dist/tui-time-picker.min.css"] },
        { "name": "chance", "assets": ["./node_modules/chance/dist/chance.min.js"] },
        { "name": "gmaps", "assets": ["./node_modules/gmaps/gmaps.min.js"] },
        { "name": "leaflet", "assets": ["./node_modules/leaflet/dist/leaflet.js", "./node_modules/leaflet/dist/leaflet.css"] },
        { "name": "bootstrap-filestyle2", "assets": ["./node_modules/bootstrap-filestyle2/src/bootstrap-filestyle.min.js"] },
        { "name": "echarts", "assets": ["./node_modules/echarts/dist/echarts.min.js"] },
        { "name": "owl.carousel", "assets": ["./node_modules/owl.carousel/dist/owl.carousel.min.js", "./node_modules/owl.carousel/dist/assets/owl.carousel.min.css", "./node_modules/owl.carousel/dist/assets/owl.theme.default.min.css"] },
        { "name": "toastr", "assets": ["./node_modules/toastr/build/toastr.min.js", "./node_modules/toastr/build/toastr.min.css"] },
        { "name": "rwd-table", "assets": ["./node_modules/admin-resources/rwd-table/rwd-table.min.js", "./node_modules/admin-resources/rwd-table/rwd-table.min.css"] },
        {
            "name": "jquery-vectormap", "assets": ["./node_modules/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js",
                "./node_modules/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js",
                "./node_modules/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js",
                "./node_modules/admin-resources/jquery.vectormap/maps/jquery-jvectormap-au-mill-en.js",
                "./node_modules/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-il-chicago-mill-en.js",
                "./node_modules/admin-resources/jquery.vectormap/maps/jquery-jvectormap-in-mill-en.js",
                "./node_modules/admin-resources/jquery.vectormap/maps/jquery-jvectormap-uk-mill-en.js",
                "./node_modules/admin-resources/jquery.vectormap/maps/jquery-jvectormap-ca-lcc-en.js",
                "./node_modules/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css"]
        },
        { "name": "ion-rangeslider", "assets": ["./node_modules/ion-rangeslider/js/ion.rangeSlider.min.js", "./node_modules/ion-rangeslider/css/ion.rangeSlider.min.css"] },
        { "name": "sweetalert2", "assets": ["./node_modules/sweetalert2/dist/sweetalert2.min.js", "./node_modules/sweetalert2/dist/sweetalert2.min.css"] },
        { "name": "jquery-sparkline", "assets": ["./node_modules/jquery-sparkline/jquery.sparkline.min.js"] },
        { "name": "jquery-knob", "assets": ["./node_modules/jquery-knob/dist/jquery.knob.min.js"] },
        { "name": "moment", "assets": ["./node_modules/moment/min/moment.min.js"] },
        {
            "name": "flot-charts", "assets": ["./node_modules/flot-charts/jquery.flot.js",
                "./node_modules/flot-charts/jquery.flot.time.js",
                "./node_modules/flot-charts/jquery.flot.resize.js",
                "./node_modules/flot-charts/jquery.flot.pie.js",
                "./node_modules/flot-charts/jquery.flot.selection.js",
                "./node_modules/flot-charts/jquery.flot.stack.js",
                "./node_modules/flot-charts/jquery.flot.crosshair.js",
                "./node_modules/jquery.flot.tooltip/js/jquery.flot.tooltip.min.js",
                "./node_modules/flot-orderbars/js/jquery.flot.orderBars.js"]
        },
        { "name": "alertifyjs", "assets": ["./node_modules/alertifyjs/build/alertify.min.js", "./node_modules/alertifyjs/build/css/alertify.min.css", "node_modules/alertifyjs/build/css/themes/default.min.css"] },
        { "name": "magnific-popup", "assets": ["./node_modules/magnific-popup/dist/jquery.magnific-popup.min.js", "./node_modules/magnific-popup/dist/magnific-popup.css"] },
        { "name": "parsleyjs", "assets": ["./node_modules/parsleyjs/dist/parsley.min.js"] },
        { "name": "bootstrap-touchspin", "assets": ["./node_modules/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js", "./node_modules/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css"] },
        { "name": "bootstrap-maxlength", "assets": ["./node_modules/bootstrap-maxlength/dist/bootstrap-maxlength.min.js"] },
        { "name": "bootstrap-rating", "assets": ["./node_modules/bootstrap-rating/bootstrap-rating.min.js", "./node_modules/bootstrap-rating/bootstrap-rating.css"] },
        { "name": "dropzone", "assets": ["./node_modules/dropzone/dist/min/dropzone.min.js", "./node_modules/dropzone/dist/min/dropzone.min.css"] },
        { "name": "dragula", "assets": ["./node_modules/dragula/dist/dragula.min.js", "./node_modules/dragula/dist/dragula.min.css"] },
        { "name": "jquery-countdown", "assets": ["./node_modules/jquery-countdown/dist/jquery.countdown.min.js"] },
        { "name": "jquery.easing", "assets": ["./node_modules/jquery.easing/jquery.easing.min.js"] },
        { "name": "jquery-repeater", "assets": ["./node_modules/jquery.repeater/jquery.repeater.min.js"] },
        // { "name": "inputmask", "assets": ["./node_modules/inputmask/dist/min/jquery.inputmask.bundle.min.js"] },
        { "name": "inputmask", "assets": ["./node_modules/inputmask/bundle.js"] },
        { "name": "masonry-layout", "assets": ["./node_modules/masonry-layout/dist/masonry.pkgd.min.js"] },
        { "name": "table-edits", "assets": ["./node_modules/table-edits/build/table-edits.min.js"] },
        { "name": "flot-curvedLines", "assets": ["./node_modules/flot.curvedlines/curvedLines.js"] },
        { "name": "jquery-validation", "assets": ["./node_modules/jquery-validation/dist/jquery.validate.min.js"] },
        { "name": "spectrum-colorpicker", "assets": ["./node_modules/spectrum-colorpicker2/dist/spectrum.min.js", "./node_modules/spectrum-colorpicker2/dist/spectrum.min.css"] },
        { "name": "jquery-steps", "assets": ["./node_modules/jquery-steps/build/jquery.steps.min.js"] },
        { "name": "toastr", "assets": ["./node_modules/toastr/toastr.js","./node_modules/toastr/build/toastr.css"] },
        { "name": "tom-select", "assets": ["./node_modules/tom-select/dist/js/tom-select.complete.min.js",
                "./node_modules/tom-select/dist/css/tom-select.bootstrap5.min.css",
                "./node_modules/tom-select/dist/css/tom-select.bootstrap5.min.css.map",
            ] }
    ]
};

//copying third party assets
lodash(third_party_assets).forEach(function (assets, type) {
    if (type === "css_js") {
        lodash(assets).forEach(function (plugin) {
            var name = plugin['name'],
                assetlist = plugin['assets'],
                css = [],
                js = [];
            lodash(assetlist).forEach(function (asset) {
                var ass = asset.split(',');
                for (let i = 0; i < ass.length; ++i) {
                    if (ass[i].substr(ass[i].length - 3) === ".js") {
                        js.push(ass[i]);
                    } else {
                        css.push(ass[i]);
                    }
                }
            });
            if (js.length > 0) {
                mix.combine(js, folder.dist_assets + "/libs/" + name + "/" + name + ".min.js");
            }
            if (css.length > 0) {
                mix.combine(css, folder.dist_assets + "/libs/" + name + "/" + name + ".min.css");
            }
        });
    }
});

mix.copyDirectory("./node_modules/leaflet/dist/images", folder.dist_assets + "/libs/leaflet/images");

// var out = "./node_modules/@fullcalendar";
mix.copyDirectory('node_modules/@fullcalendar', 'public/assets/libs/@fullcalendar');

// copy all fonts
var out = folder.dist_assets + "fonts";
mix.copyDirectory(folder.src + "fonts", out);

// copy all images
var out = folder.dist_assets + "images";
mix.copyDirectory(folder.src + "images", out);

mix.sass('resources/scss/bootstrap.scss', folder.dist_assets + "css").minify(folder.dist_assets + "css/bootstrap.css");
mix.sass('resources/scss/icons.scss', folder.dist_assets + "css").options({ processCssUrls: false }).minify(folder.dist_assets + "css/icons.css");
mix.sass('resources/scss/app.scss', folder.dist_assets + "css").options({ processCssUrls: false }).minify(folder.dist_assets + "css/app.css");

// mix.webpackConfig({
//     plugins: [
//         new WebpackRTLPlugin({
//             file: '/css/[name]-rtl.css',
//         })
//     ]
// });

mix.webpackConfig({
    plugins: [
        new WebpackRTLPlugin()
    ]
});


//copying demo pages related assets
var app_pages_assets = {
    js: [
        folder.src + "js/main.js",
        folder.src + "js/pages/datatable-pages.init.js",
        folder.src + "js/pages/email-editor.init.js",
        folder.src + "js/pages/invoices-list.init.js",
        folder.src + "js/pages/pass-addon.init.js",
        folder.src + "js/pages/validation.init.js",
        folder.src + "js/pages/two-step-verification.init.js",
        folder.src + "js/pages/apexcharts.init.js",
        folder.src + "js/pages/chartjs.init.js",
        folder.src + "js/pages/echarts.init.js",
        folder.src + "js/pages/jquery-knob.init.js",
        folder.src + "js/pages/sparklines.init.js",
        folder.src + "js/pages/lightbox.init.js",
        folder.src + "js/pages/rangeslider.init.js",
        folder.src + "js/pages/rating.init.js",
        folder.src + "js/pages/session-timeout.init.js",
        folder.src + "js/pages/sweetalert.init.js",
        folder.src + "js/pages/notification.init.js",
        folder.src + "js/pages/form-advanced.init.js",
        folder.src + "js/pages/form-editor.init.js",
        folder.src + "js/pages/form-mask.init.js",
        folder.src + "js/pages/form-validation.init.js",
        folder.src + "js/pages/form-wizard.init.js",
        folder.src + "js/pages/fontawesome.init.js",
        folder.src + "js/pages/materialdesign.init.js",
        folder.src + "js/pages/dashboard.init.js",
        folder.src + "js/pages/gmaps.init.js",
        folder.src + "js/pages/leaflet-map.init.js",
        folder.src + "js/pages/vector-maps.init.js",
        folder.src + "js/pages/coming-soon.init.js",
        folder.src + "js/pages/datatables.init.js",
        folder.src + "js/pages/table-editable.int.js",
        folder.src + "js/pages/table-responsive.init.js"
    ]
}

var out = folder.dist_assets + "js/";
lodash(app_pages_assets).forEach(function (assets, type) {
    for (let i = 0; i < assets.length; ++i) {
        mix.js(assets[i], out + "pages");
    }
});

mix.combine('resources/js/app.js', folder.dist_assets + "js/app.min.js");

mix.combine('resources/css/preloader.min.css', folder.dist_assets + "css/preloader.tui-date-picker.css");

mix.combine('resources/css/main.css', folder.dist_assets + "css/main.css");

mix.combine('resources/js/pages/calendar.init.js', folder.dist_assets + "js/pages/calendar.init.js");

mix.combine('resources/js/pages/leaflet-us-states.js', folder.dist_assets + "js/pages/leaflet-us-states.js");

if (mix.inProduction()) {
    mix.version();
}
