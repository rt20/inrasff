<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Inrasff">
    <meta name="keywords" content="bpom inrasff">
    <meta name="author" content="PENTACODE">
    <title>Login | {{ config('app.name') }}</title>
    <link rel="apple-touch-icon" href="{{ asset('backadmin/theme/images/ico/apple-icon-120.png') }}">
    {{-- <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backadmin/theme/images/ico/favicon.ico') }}"> --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backadmin/theme/images/ico/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backadmin/theme/vendors/css/extensions/toastr.min.css') }}">
    @yield('vendor-css')
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/css/themes/semi-dark-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backadmin/theme/css/pages/page-auth.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app/css/style.css') }}">
    <!-- END: Custom CSS-->
</head>
<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-v1 px-2">
                    <div class="auth-inner py-2">
                        <!-- Login v1 -->
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="javascript:void(0);" class="brand-logo mb-2 bg-primary py-1">
                                    <img src="{{asset('images/inrasff.png')}}">
                                    {{-- <h2 class="brand-text text-primary ml-1">{{ config('app.name') }}</h2> --}}
                                </a>
                                @error('username')
                                    <div class="alert alert-danger">
                                        <div class="alert-body text-center">
                                            {{ $errors->first('username') }}
                                        </div>
                                    </div>
                                @enderror
                                
                                {{-- <h4 class="text-center mb-2 text-primary"></h4> --}}
                                <form action="{{ route('backadmin.auth.login') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="f_username" name="username" placeholder="username" aria-describedby="username" tabindex="1" autofocus />
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input type="password" class="form-control form-control-merge" id="password" name="password" tabindex="2" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                                            <div class="input-group-append">
                                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! NoCaptcha::display() !!}
                                    </div>
                                    @if($errors->has('g-recaptcha-response'))
                                        <span style="margin-bottom: 20px;" role="alert">
                                            <strong style="color:red;">{{ $errors->first('g-recaptcha-response') }}</strong>
                                        </span>
                                    @endif

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="remember" tabindex="3" />
                                            <label class="custom-control-label" for="remember"> Ingat Saya </label>
                                        </div>
                                    </div>

                                    <button class="btn btn-gradient-primary btn-block mb-1" tabindex="4">Login</button>
                                </form>

                            </div>
                        </div>
                        <!-- /Login v1 -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('backadmin/theme/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('backadmin/theme/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('backadmin/theme/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->
    
    <!-- BEGIN: Page JS-->
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
    {!! NoCaptcha::renderJs() !!}
</body>
</html>