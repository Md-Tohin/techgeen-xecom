<!DOCTYPE html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-bordered"
    data-assets-path="/assets/backend/" data-template="vertical-menu-template-bordered" data-style="light">
<!-- Mirrored from demos.pixinvent.com/vuexy-html-admin-template/html/vertical-menu-template-bordered/auth-login-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 03 Jul 2024 14:04:35 GMT -->

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login Basic - Pages | Vuexy - Bootstrap Admin Template</title>

    <meta name="description" content="Start your development with a Dashboard for Bootstrap 5" />
    <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5" />
    <!-- Canonical SEO -->
    <link rel="canonical" href="https://1.envato.market/vuexy_admin" />

    <!-- ? PROD Only: Google Tag Manager (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                "gtm.start": new Date().getTime(),
                event: "gtm.js"
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != "dataLayer" ? "&l=" + l : "";
            j.async = true;
            j.src =
                "../../../../www.googletagmanager.com/gtm5445.html?id=" + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, "script", "dataLayer", "GTM-5J3LMKC");
    </script>
    <!-- End Google Tag Manager -->

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon"
        href="https://demos.pixinvent.com/vuexy-html-admin-template/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;ampdisplay=swap"
        rel="stylesheet" />

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
    <!-- Vendor -->
    <link rel="stylesheet" href="/assets/backend/vendor/libs/%40form-validation/form-validation.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="/assets/backend/vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="/assets/backend/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="/assets/backend/vendor/js/template-customizer.js"></script>

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/assets/backend/js/config.js"></script>
</head>

<body>
    <!-- ?PROD Only: Google Tag Manager (noscript) (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5J3LMKC" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-6">
                <!-- Login -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center mb-6">
                            <a href="{{ url('/') }}" class="app-brand-link">
                                <span class="app-brand-logo demo">
                                    <svg width="32" height="22" viewBox="0 0 32 22" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                                            fill="#7367F0" />
                                        <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                                            fill="#161616" />
                                        <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                                            fill="#161616" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                                            fill="#7367F0" />
                                    </svg>
                                </span>
                                <span class="app-brand-text demo text-heading fw-bold">Vuexy</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-1">Welcome to Vuexy! 👋</h4>
                        <p class="mb-6">
                            Please sign-in to your account and start the adventure
                        </p>

                        <form id="formAuthentication" class="mb-4" action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="mb-6">
                                <label for="email" class="form-label">Email or Username</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}"
                                    placeholder="Enter your email or username" autofocus />
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-6 form-password-toggle">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="my-8">
                                <div class="d-flex justify-content-between">
                                    <div class="form-check mb-0 ms-2">
                                        <input class="form-check-input" type="checkbox" id="remember-me" />
                                        <label class="form-check-label" for="remember-me">
                                            Remember Me
                                        </label>
                                    </div>
                                    <a href="auth-forgot-password-basic.html">
                                        <p class="mb-0">Forgot Password?</p>
                                    </a>
                                </div>
                            </div>
                            <div class="mb-6">
                                <button class="btn btn-primary d-grid w-100" type="submit">
                                    Login
                                </button>
                            </div>
                        </form>

                        <p class="text-center">
                            <span>New on our platform?</span>
                            <a href="auth-register-basic.html">
                                <span>Create an account</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>

    <!-- / Content -->

    <div class="buy-now">
        <a href="https://1.envato.market/vuexy_admin" target="_blank" class="btn btn-danger btn-buy-now">Buy Now</a>
    </div>

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
    <script src="/assets/backend/vendor/libs/%40form-validation/popular.js"></script>
    <script src="/assets/backend/vendor/libs/%40form-validation/bootstrap5.js"></script>
    <script src="/assets/backend/vendor/libs/%40form-validation/auto-focus.js"></script>

    <!-- Main JS -->
    <script src="/assets/backend/js/main.js"></script>

    <!-- Page JS -->
    <script src="/assets/backend/js/pages-auth.js"></script>
</body>

<!-- Mirrored from demos.pixinvent.com/vuexy-html-admin-template/html/vertical-menu-template-bordered/auth-login-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 03 Jul 2024 14:04:36 GMT -->

</html>

<!-- beautify ignore:end -->
