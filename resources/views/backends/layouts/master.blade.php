<!DOCTYPE html>
<html lang="en" dir="ltr" data-startbar="light" data-bs-theme="light">

<!-- Mirrored from mannatthemes.com/rizz/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 09 May 2025 08:17:55 GMT -->

<head>

    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta http-eqbackendsv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('backends/assets/images/favicon.ico')}}" />
    <link rel="stylesheet" href="{{asset('backends/assets/libs/jsvectormap/css/jsvectormap.min.css')}}"
        type="text/css" />

    <!-- App css -->
    <link href="{{ asset('backends/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backends/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backends/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    @stack('css')
    <style>
        .alert-error {
            background-color: #ff8f87; /* red */
            color: white;
            padding: 20px;
            border-radius: 4px;
        }
    </style>

</head>

<body>

    <!-- Top Bar Start -->
    <div class="topbar d-print-none">
        <div class="container-xxl">
            <nav class="topbar-custom d-flex justify-content-between" id="topbar-custom">


                <ul class="topbar-item list-unstyled d-inline-flex align-items-center mb-0">
                    <li>
                        <button class="nav-link mobile-menu-btn nav-icon" id="togglemenu">
                            <i class="iconoir-menu-scale"></i>
                        </button>
                    </li>
                    <li class="mx-3 welcome-text">
                        <h3 class="mb-0 fw-bold text-truncate">Good Morning, {{userAuth()->name}}!</h3>
                        <!-- <h6 class="mb-0 fw-normal text-muted text-truncate fs-14">Here's your overview this week.</h6> -->
                    </li>
                </ul>
                <ul class="topbar-item list-unstyled d-inline-flex align-items-center mb-0">                    
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="{{asset('backends/assets/images/flags/us_flag.jpg')}}" alt="" class="thumb-sm rounded-circle">
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#"><img src="{{asset('backends/assets/images/flags/us_flag.jpg')}}" alt=""
                                    height="15" class="me-2">English</a>
                            <a class="dropdown-item" href="#"><img src="{{asset('backends/assets/images/flags/spain_flag.jpg')}}" alt=""
                                    height="15" class="me-2">Spanish</a>
                            <a class="dropdown-item" href="#"><img src="{{asset('backends/assets/images/flags/germany_flag.jpg')}}" alt=""
                                    height="15" class="me-2">German</a>
                            <a class="dropdown-item" href="#"><img src="{{asset('backends/assets/images/flags/french_flag.jpg')}}" alt=""
                                    height="15" class="me-2">French</a>
                        </div>
                    </li><!--end topbar-language-->

                    <li class="topbar-item">
                        <a class="nav-link nav-icon" href="javascript:void(0);" id="light-dark-mode">
                            <i class="icofont-moon dark-mode"></i>
                            <i class="icofont-sun light-mode"></i>
                        </a>
                    </li>


                    <li class="dropdown topbar-item">
                        <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="{{asset(userAuth()->photo)}}" alt="" class="thumb-lg rounded-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end py-0">
                            <div class="d-flex align-items-center dropdown-item py-2 bg-secondary-subtle">
                                <div class="flex-shrink-0">
                                    <img src="{{asset(userAuth()->photo)}}" alt="" class="thumb-md rounded-circle">
                                </div>
                                <div class="flex-grow-1 ms-2 text-truncate align-self-center">
                                    <h6 class="my-0 fw-medium text-dark fs-13">{{userAuth()->name}}</h6>
                                    <small class="text-muted mb-0">{{userAuth()->role}}</small>
                                </div><!--end media-body-->
                            </div>
                            <div class="dropdown-divider mt-0"></div>
                            <small class="text-muted px-2 pb-1 d-block">Account</small>
                            <a class="dropdown-item" href="pages-profile.html"><i
                                    class="las la-user fs-18 me-1 align-text-bottom"></i> Profile</a>
                            <a class="dropdown-item" href="pages-faq.html"><i
                                    class="las la-wallet fs-18 me-1 align-text-bottom"></i> Earning</a>
                            <small class="text-muted px-2 py-1 d-block">Settings</small>
                            <a class="dropdown-item" href="pages-profile.html"><i
                                    class="las la-cog fs-18 me-1 align-text-bottom"></i>Account Settings</a>
                            <a class="dropdown-item" href="pages-profile.html"><i
                                    class="las la-lock fs-18 me-1 align-text-bottom"></i> Security</a>
                            <a class="dropdown-item" href="pages-faq.html"><i
                                    class="las la-question-circle fs-18 me-1 align-text-bottom"></i> Help Center</a>
                            <div class="dropdown-divider mb-0"></div>
                            <a href="#" class="dropdown-item text-danger" 
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="las la-power-off fs-18 me-1 align-text-bottom"></i> Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                        </div>
                    </li>
                </ul><!--end topbar-nav-->
            </nav>
            <!-- end navbar-->
        </div>
    </div>
    <!-- Top Bar End -->
    <!-- leftbar-tab-menu -->
    <div class="startbar d-print-none">
        <!--start brand-->
        <div class="brand">
            <a href="index.html" class="logo">
                <span>
                    <img src="{{asset('backends/assets/images/logo-sm.png')}}" alt="logo-small" class="logo-sm">
                </span>
                <span class="">
                    <img src="{{asset('backends/assets/images/logo-light.png')}}" alt="logo-large" class="logo-lg logo-light">
                    <img src="{{asset('backends/assets/images/logo-dark.png')}}" alt="logo-large" class="logo-lg logo-dark">
                </span>
            </a>
        </div>
        <!--end brand-->
        <!--start startbar-menu-->
        <div class="startbar-menu">
            <div class="startbar-collapse" id="startbarCollapse" data-simplebar>
                <div class="d-flex align-items-start flex-column w-100">
                    <!-- Navigation -->
                    <ul class="navbar-nav mb-auto w-100">
                        <li class="menu-label pt-0 mt-0">
                            <!-- <small class="label-border">
                                <div class="border_left hidden-xs"></div>
                                <div class="border_right"></div>
                            </small> -->
                            <span>Main Menu</span>
                        </li>
                        @if (auth()->user()->role_id == 1)
                            <li class="nav-item">
                            <a class="nav-link" href="{{route('permissions.index')}}" id="sidebarDashboards">
                                <i class="fa-solid fa-user-check menu-icon"></i>
                                <span>Permission</span>
                            </a>
 
                        </li><!--end nav-item-->
                        
                        @endif
                       @if (checkPermission('key_dashboard', 'view'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.home')}}" id="sidebarDashboards">
                                <i class="fa-solid fa-house menu-icon"></i>
                                <span>Dashboard</span>
                            </a>
                        </li><!--end nav-item-->
                       
                       @endif
        

                        <li class="nav-item">
                            <a class="nav-link" href="#sidebarManagement" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarManagement">
                                <i class="fa-solid fa-list-check menu-icon"></i>
                                <span>Management</span>
                            </a>
                            <div class="collapse " id="sidebarManagement">
                                <ul class="nav flex-column">
                                    <li class="nav-item">

                                        @if (checkPermission('key_user', 'view'))
                                            <a href="{{route('categorys.index')}}" class="nav-link"><span>Category</span></a>
                                        @endif
                                        
                                        @if (checkPermission('key_book', 'view'))
                                            <a href="{{route('books.index')}}" class="nav-link"><span>Books</span></a>
                                        
                                        @endif
                                        
                                    </li><!--end nav-item-->
                                    
                                </ul><!--end nav-->
                            </div><!--end startbarUsers-->
                        </li><!--end nav-item-->


                        <li class="nav-item">
                            <a class="nav-link" href="#sidebarOperation" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarOperation">
                                <i class="fa-brands fa-windows menu-icon"></i>
                                <span>Operations</span>
                            </a>
                            <div class="collapse " id="sidebarOperation">
                                <ul class="nav flex-column">
                                    <li class="nav-item">

                                        @if (checkPermission('key_user', 'view'))
                                            <a href="{{route('users.index')}}" class="nav-link"><span>User</span></a>
                                        @endif
                                        
                                        @if (checkPermission('key_role', 'view'))
                                            <a href="{{route('roles.index')}}" class="nav-link"><span>Roles</span></a>
                                        
                                        @endif
                                        
                                    </li><!--end nav-item-->
                                    
                                </ul><!--end nav-->
                            </div><!--end startbarUsers-->
                        </li><!--end nav-item-->

                        <li class="nav-item">
                            <a class="nav-link" href="#sidebarUsers" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarUsers">
                                <i class="iconoir-view-grid menu-icon"></i>
                                <span>Setting</span>
                            </a>
                            <div class="collapse " id="sidebarUsers">
                                <ul class="nav flex-column">
                                    <li class="nav-item">

                                        @if (checkPermission('key_user', 'view'))
                                            <a href="{{route('users.index')}}" class="nav-link"><span>User</span></a>
                                        @endif
                                        
                                        @if (checkPermission('key_role', 'view'))
                                            <a href="{{route('roles.index')}}" class="nav-link"><span>Roles</span></a>
                                        
                                        @endif
                                        
                                    </li><!--end nav-item-->
                                    
                                </ul><!--end nav-->
                            </div><!--end startbarUsers-->
                        </li><!--end nav-item-->

                    </ul><!--end navbar-nav--->
                </div>
            </div><!--end startbar-collapse-->
        </div><!--end startbar-menu-->
    </div><!--end startbar-->
    <div class="startbar-overlay d-print-none"></div>
    <!-- end leftbar-tab-menu-->

    <div class="page-wrapper">

        <!-- Page Content-->
        <div class="page-content">
            <div class="container-xxl">
                
                @yield('content')
  
            </div><!-- container -->

            <!--end Rightbar/offcanvas-->
            <!--end Rightbar-->
            <!--Start Footer-->

            <footer class="footer text-center text-sm-start d-print-none">
                <div class="container-xxl">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-0 rounded-bottom-0">
                                <div class="card-body">
                                    <p class="text-muted mb-0">
                                        ©
                                        <script> document.write(new Date().getFullYear()) </script>
                                        Library
                                        <span class="text-muted d-none d-sm-inline-block float-end">
                                            Crafted with
                                            <i class="iconoir-heart text-danger"></i>
                                            by Phearen</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

            <!--end footer-->
        </div>
    </div>
    <!-- end page-wrapper -->

    <!-- Javascript  -->
    <!-- vendor js -->

    <script src="{{asset("backends/assets/libs/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
    <script src="{{asset("backends/assets/libs/simplebar/simplebar.min.js")}}"></script>

    <script src="{{asset("backends/assets/libs/apexcharts/apexcharts.min.js")}}"></script>
    <script src="{{asset("backends/assets/data/stock-prices.js")}}"></script>
    <script src="{{asset("backends/assets/libs/jsvectormap/js/jsvectormap.min.js")}}"></script>
    <script src="{{asset("backends/assets/libs/jsvectormap/maps/world.js")}}"></script>
    <script src="{{asset("backends/assets/js/pages/index.init.js")}}"></script>
    <script src="{{asset("backends/assets/js/app.js")}}"></script>

    
    @stack('js')
</body>
<!--end body-->


<!-- Mirrored from mannatthemes.com/rizz/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 09 May 2025 08:18:36 GMT -->

</html>