<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="{{ route('backadmin.dashboard') }}">
                    <span class="brand-logo">
                        <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                            <defs>
                                <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                    <stop stop-color="#000000" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                </lineargradient>
                                <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                    <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                </lineargradient>
                            </defs>
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                    <g id="Group" transform="translate(400.000000, 178.000000)">
                                        <path class="text-primary" id="Path" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill:currentColor"></path>
                                        <path id="Path1" d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#linearGradient-1)" opacity="0.2"></path>
                                        <polygon id="Path-2" fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                                        <polygon id="Path-21" fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                                        <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </span>
                    <h2 class="brand-text">{{ config('app.name') }}</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                    <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                    <i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            
            <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'backadmin.dashboard') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('backadmin.dashboard') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Home">Dashboard</span></a>
            </li>
            @can('view data')
            <li class=" navigation-header"><span data-i18n="Data &amp; Data">Data</span><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg></li>
            @endcan
            
            @can('view notification')
            <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'backadmin.notifications') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('backadmin.notifications.index') }}"><i data-feather="bell"></i><span class="menu-title text-truncate" data-i18n="bell">Informasi Awal</span></a>
            </li>
            @endcan
            
            @can('view bussiness_process')
            <li class=" navigation-header"><span data-i18n="Proses Bisnis &amp; Data">Proses Bisnis</span><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg></li>
            @endcan

            @can('view all downstream')
            <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'backadmin.downstreams') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('backadmin.downstreams.index') }}"><i data-feather="download-cloud"></i><span class="menu-title text-truncate" data-i18n="download-cloud">Down Stream</span></a>
            </li>
            @endcan

            @can('view all upstream')
            <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'backadmin.upstreams') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('backadmin.upstreams.index') }}"><i data-feather="upload-cloud"></i><span class="menu-title text-truncate" data-i18n="upload-cloud">Up Stream</span></a>
            </li>
            @endcan

            @can('view front_end')
            <li class=" navigation-header"><span data-i18n="Front End &amp; Data">Front End</span><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg></li>
            @endcan 
            
            @can('view categories')
            <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'backadmin.categories') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('backadmin.categories.index') }}"><i data-feather="inbox"></i><span class="menu-title text-truncate" data-i18n="Category">Kategori Berita</span></a>
            </li>
            @endcan
            
            @can('view news')
            <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'backadmin.news') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('backadmin.news.index') }}"><i data-feather="file-text"></i><span class="menu-title text-truncate" data-i18n="News">Berita</span></a>
            </li>
            @endcan

            @can('view faq')
            <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'backadmin.faq') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('backadmin.faq.index') }}"><i data-feather="help-circle"></i><span class="menu-title text-truncate" data-i18n="faq">FAQ</span></a>
            </li>
            @endcan

            @can('view kementrian')
            <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'backadmin.kementrian') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('backadmin.kementrian.index') }}"><i data-feather="command"></i><span class="menu-title text-truncate" data-i18n="kementrian">Kementerian</span></a>
            </li>
            @endcan

            @can('view contactus')
            <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'backadmin.contactus') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('backadmin.contactus.index') }}"><i data-feather="inbox"></i><span class="menu-title text-truncate" data-i18n="contactus">Hubungi Kami</span></a>
            </li>
            @endcan

            @can('view galleries')
            <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'backadmin.galleries') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('backadmin.galleries.index') }}"><i data-feather="image"></i><span class="menu-title text-truncate" data-i18n="galleries">Galeri</span></a>
            </li>
            @endcan

            @can('view slider')
            <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'backadmin.sliders') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('backadmin.sliders.index') }}"><i data-feather="play"></i><span class="menu-title text-truncate" data-i18n="Slider">Slider</span></a>
            </li>
            @endcan

            @can('view master_data')
            <li class=" navigation-header"><span data-i18n="Master Data &amp; Data">Master Data</span><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg></li>
            @endcan

            @can('view user')
            <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'backadmin.users') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('backadmin.users.index') }}"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="Slider">Pengguna</span></a>
            </li>
            @endcan

            @can('view institution')
            <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'backadmin.institutions') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('backadmin.institutions.index') }}"><i data-feather="sidebar"></i><span class="menu-title text-truncate" data-i18n="Slider">Lembaga</span></a>
            </li>
            @endcan
        </ul>
    </div>
</div>
<!-- END: Main Menu-->