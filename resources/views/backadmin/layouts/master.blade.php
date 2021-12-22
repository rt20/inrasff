<!DOCTYPE html>
<html class="loading bordered-layout" lang="en" data-layout="bordered-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Inrasff">
    <meta name="keywords" content="bpom inrasff notifikasi bpom">
    <meta name="author" content="PENTACODE">
    <title>{{ config('app.name') }} | {{ $title ?? 'Untitled' }}</title>
    <link rel="apple-touch-icon" href="{{ asset('backadmin/theme/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backadmin/theme/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backadmin/theme/vendors/css/extensions/toastr.min.css') }}">
    @yield('vendor-css')
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset(mix('css/core.css')) }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/css/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/css/components.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/css/themes/dark-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/css/themes/semi-dark-layout.min.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/css/core/menu/menu-types/vertical-menu.min.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/css/themes/bordered-layout.min.css') }}"> --}}

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/css/plugins/extensions/ext-component-toastr.min.css') }}">
    @yield('page-css')
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backadmin/app/css/style.css') }}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
                </ul>
                <ul class="nav navbar-nav">
                    <li class="nav-item d-none d-lg-block">
                        <a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>
                </ul>
            </div>
            <ul class="nav navbar-nav align-items-center ml-auto">
                <li class="nav-item dropdown dropdown-user">
                    <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none">
                            <span class="user-name font-weight-bolder">{{ auth()->user()->fullname  }}</span>
                            <span class="user-status">{{ auth()->user()->role_name_label. (auth()->user()->institution_id ? " / ".auth()->user()->institution->name : '') }}</span>
                        </div>
                        <span class="avatar">
                            <img class="round" src="{{ asset('backadmin/app/img/avatar.jpg') }}" alt="avatar" height="40" width="40">
                            {{-- <span class="avatar-status-online"></span> --}}
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                        {{-- <a class="dropdown-item" href="{{ route('backadmin.users.edit_password') }}"><i class="mr-50" data-feather="key"></i> Ubah Password</a> --}}
                        <a class="dropdown-item" href="{{ route('backadmin.users.edit_profile', auth()->user()->id) }}"><i class="mr-50" data-feather="user"></i> Edit Profile</a>
                        <a class="dropdown-item" href="{{ route('backadmin.users.change_password', auth()->user()->id) }}"><i class="mr-50" data-feather="key"></i> Edit Password</a>
                        <a class="dropdown-item" href="{{ route('backadmin.auth.logout') }}"><i class="mr-50" data-feather="power"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- END: Header-->

    @include('backadmin.layouts.sidebar')

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            @if($title != null)
            <div class="content-header row">
                <div class="content-header-left col-md-7  col-7 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">{{ $title }}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    @yield('breadcrumb')
                                    @if(isset($show_additional_breadcrumb))
                                    <li class="breadcrumb-item active {{ isset($subtitle) ? 'control-breadcumb' : ''}}">{{ $subtitle??$title }}</li>
                                    @endif
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content-header-right text-right col-md-5 col-5 d-md-block d-block d-none">
                    <div class="form-group breadcrumb-right">
                        @yield('actions')
                    </div>
                </div>
            </div>
            @endif
            <div class="content-body">
                @yield('content')
                <!--/ Kick start -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">Copyright &copy; 2021<a class="ml-25" href="{{route('home')}}" target="_blank">Indonesian Rapid Alert System for Food and Feed</a></p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->

    @stack('modal')

    <!-- BEGIN: Vendor JS-->
    {{-- <script src="{{ asset('backadmin/theme/vendors/js/vendors.min.js') }}"></script> --}}
    <script src="{{ asset(mix('vendors/js/vendors.min.js')) }}"></script>
    <script src="{{ asset('backadmin/theme/vendors/js/extensions/toastr.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    @yield('vendor-js')
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('backadmin/theme/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('backadmin/theme/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->
    
    @include('backadmin.layouts.toastr')

    <!-- BEGIN: Page JS Before-->
    @stack('page-js-before')
    <!-- END: Page JS Before-->

    <!-- BEGIN: Page JS-->
    @stack('page-js')
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
<!-- END: Body-->

</html>