<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr"
    data-theme="theme-bordered" data-assets-path="/assets/backend/" data-template="vertical-menu-template-bordered"
    data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>


    <meta name="description" content="Start your development with a Dashboard for Bootstrap 5" />
    <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
    <!-- Canonical SEO -->
    <link rel="canonical" href="https://1.envato.market/vuexy_admin">


    <!-- ? PROD Only: Google Tag Manager (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                '../../../../www.googletagmanager.com/gtm5445.html?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-5J3LMKC');
    </script>
    <!-- End Google Tag Manager -->

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon"
        href="https://demos.pixinvent.com/vuexy-html-admin-template/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;ampdisplay=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="/assets/backend/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="/assets/backend/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="/assets/backend/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->

    <link rel="stylesheet" href="/assets/backend/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/assets/backend/vendor/css/rtl/theme-bordered.css"
        class="template-customizer-theme-css" />

    <link rel="stylesheet" href="/assets/backend/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/assets/backend/vendor/libs/node-waves/node-waves.css" />

    <link rel="stylesheet" href="/assets/backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="/assets/backend/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="/assets/backend/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="/assets/backend/vendor/libs/datatables-bs5/datatables.bootstrap5.css">
    <link rel="stylesheet" href="/assets/backend/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css">
    <link rel="stylesheet" href="/assets/backend/vendor/libs/%40form-validation/form-validation.css" />
    <link rel="stylesheet" href="/assets/backend/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css">
    <link rel="stylesheet" href="/assets/backend/vendor/libs/select2/select2.css" />



    <!-- Page CSS -->


    <!-- Helpers -->
    <script src="/assets/backend/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="/assets/backend/vendor/js/template-customizer.js"></script>

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/assets/backend/js/config.js"></script>

    @stack('css')

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="/assets/common/toastr/toastr.min.css">

</head>

<body>


    <!-- ?PROD Only: Google Tag Manager (noscript) (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5J3LMKC" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar  ">
        <div class="layout-container">

            <!-- Menu -->
            @include('admin.inc.left-sidebar')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">

                <!-- Navbar -->
                @include('admin.inc.header')
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">

                        @yield('content')

                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    @include('admin.inc.footer')
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>

    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="/assets/backend/vendor/libs/jquery/jquery.js"></script>
    <script src="/assets/backend/vendor/libs/popper/popper.js"></script>
    <script src="/assets/backend/vendor/js/bootstrap.js"></script>
    <script src="/assets/backend/vendor/libs/node-waves/node-waves.js"></script>
    <script src="/assets/backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="/assets/backend/vendor/libs/hammer/hammer.js"></script>
    <script src="/assets/backend/vendor/libs/i18n/i18n.js"></script>
    <script src="/assets/backend/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="/assets/backend/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="/assets/backend/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="/assets/backend/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <!-- Permission Page -->
    <script src="/assets/backend/vendor/libs/select2/select2.js"></script>
    <script src="/assets/backend/vendor/libs/%40form-validation/popular.js"></script>
    <script src="/assets/backend/vendor/libs/%40form-validation/bootstrap5.js"></script>
    <script src="/assets/backend/vendor/libs/%40form-validation/auto-focus.js"></script>    

    <!-- Main JS -->
    <script src="/assets/backend/js/main.js"></script>

    <!-- Page JS -->
    <script src="/assets/backend/js/app-ecommerce-dashboard.js"></script>
    <!-- Permission Page -->
    <script src="/assets/backend/js/app-access-roles.js"></script>
    <script src="/assets/backend/js/modal-add-role.js"></script>

    <!-- Sweetalert js -->
    <script src="/assets/common/sweetalert/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.delete-record').click(function(event) {
            var form = $(this).closest("form");
            // var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Are you sure you want to delete this record?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>

    <!-- Toastr JS -->
    <script src="/assets/common/toastr/toastr.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            @if (Session::has('success'))
                toastr.success("{{ Session::get('success') }}");
            @endif
            @if (Session::has('error'))
                toastr.error("{{ Session::get('error') }}");
            @endif
        });
    </script>

    <script>
        var loadFile = (event, outputPath) => {
            var reader = new FileReader();
            reader.onload = function(){
            var output = document.getElementById(outputPath);
            output.classList.remove('d-none');
            output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        };
    </script>

    @stack('scripts')
</body>

</html>
