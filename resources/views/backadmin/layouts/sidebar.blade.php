<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header bg-primary">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="{{ route('backadmin.dashboard') }}" style="width: 50%!important; margin-top:0px">
                    <img src="{{asset('images/inrasff.png')}}" style="width: 100%!important">
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
            
            @can('view news_categories')
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

            @can('view contact_us')
            <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'backadmin.contactus') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('backadmin.contactus.index') }}"><i data-feather="inbox"></i><span class="menu-title text-truncate" data-i18n="contactus">Hubungi Kami</span></a>
            </li>
            @endcan

            @can('view gallery')
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