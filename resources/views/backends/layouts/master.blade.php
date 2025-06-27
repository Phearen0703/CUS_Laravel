<!DOCTYPE html>
<html lang="en" dir="ltr" data-startbar="light" data-bs-theme="light">

<!-- Mirrored from mannatthemes.com/rizz/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 09 May 2025 08:17:55 GMT -->
<head>
    
    <meta charset="utf-8" />
            <title>@yield('title')</title>
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
            <meta content="" name="author" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />

            <!-- App favicon -->
            <link rel="shortcut icon" href="{{asset('UI/assets/images/favicon.ico')}}" />
    <link rel="stylesheet" href="{{asset('UI/assets/libs/jsvectormap/css/jsvectormap.min.css')}}" type="text/css" />

     <!-- App css -->
     <link href="{{ asset('UI/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{asset('UI/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
     <link href="{{asset('UI/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
     @stack('css')

</head>

<body>

    <!-- Top Bar Start -->
        @include('backends.layouts.topbar')
    <!-- Top Bar End -->

    <!-- leftbar-tab-menu -->
        @include('backends.layouts.sidebar')

    <!-- end leftbar-tab-menu-->

    <div class="page-wrapper">

        <!-- Page Content-->
        <div class="page-content">
            <div class="container-xxl">
                
                @yield('content');
     
            </div><!-- container -->

            <!--Start Footer-->
            
            @include('backends.layouts.footer')

            <!--end footer-->
        </div>
        <!-- end page content -->
    </div>
    <!-- end page-wrapper -->

    <!-- Javascript  -->
    <!-- vendor js -->
    
    <script src="{{asset("UI/assets/libs/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
    <script src="{{asset("UI/assets/libs/simplebar/simplebar.min.js")}}"></script>

    <script src="{{asset("UI/assets/libs/apexcharts/apexcharts.min.js")}}"></script>
    <script src="{{asset("UI/assets/data/stock-prices.js")}}"></script>
    <script src="{{asset("UI/assets/libs/jsvectormap/js/jsvectormap.min.js")}}"></script>
    <script src="{{asset("UI/assets/libs/jsvectormap/maps/world.js")}}"></script>
    <script src="{{asset("UI/assets/js/pages/index.init.js")}}"></script>
    <script src="{{asset("UI/assets/js/app.js")}}"></script>
    @stack('js')
</body>
<!--end body-->


<!-- Mirrored from mannatthemes.com/rizz/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 09 May 2025 08:18:36 GMT -->
</html>