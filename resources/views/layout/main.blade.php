<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from coderthemes.com/ubold/layouts/material/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 30 Dec 2020 18:59:50 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Rental Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Dan Mlayah" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="https://coderthemes.com/ubold/layouts/assets/images/favicon.ico">


    
    <!-- App css -->
    <link href="{{ asset('assets/css/bootstrap-material.min.css') }}" rel="stylesheet" type="text/css"
        id="bs-default-stylesheet" />
    <link href="{{ asset('assets/css/app-material.min.css') }}" rel="stylesheet" type="text/css"
        id="app-default-stylesheet" />

    {{-- <link href="{{ asset('assets/css/bootstrap-material-dark.min.css') }}" rel="stylesheet" type="text/css" --}}
    {{-- id="bs-dark-stylesheet" /> --}}
    {{-- <link href="{{ asset('assets/css/app-material-dark.min.css') }}" rel="stylesheet" type="text/css" --}}
    {{-- id="app-dark-stylesheet" /> --}}

    <!-- icons -->
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />

    @stack('header-css')

    @livewireStyles

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>
</head>

<body
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": false}'>


    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        @include('admin.includes.header')
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        @include('admin.includes.sidebar')
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                @yield('content')

                <!-- container -->

            </div>
            <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> &copy; Jawad
                        </div>
                        <div class="col-md-6">
                            <div class="text-md-right footer-links d-none d-sm-block">
                                <a href="javascript:void(0);">About Us</a>
                                <a href="javascript:void(0);">Help</a>
                                <a href="javascript:void(0);">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <!-- Vendor js -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>


    <!-- App js-->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>

    <script>
    //     // Wait for window load
	// $(window).load(function() {
	// 	// Animate loader off screen
	// 	$(".se-pre-con").fadeOut("slow");;
	// });

    </script>
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"> </script>
    
    <x-livewire-alert::scripts />

    @stack('footer-scripts')


</body>


</html>