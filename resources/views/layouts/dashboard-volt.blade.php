<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Primary Meta Tags -->
    <title>Risk Management Information Systems</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="Risk Management Information Systems">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href={{ asset('img/favicon/apple-touch-icon.png') }}>
    <link rel="icon" type="image/png" sizes="32x32" href={{ asset('img/favicon/favicon-32x32.png') }}>
    <link rel="icon" type="image/png" sizes="16x16" href={{ asset('img/favicon/favicon-16x16.png') }}>
    <link rel="manifest" href={{ asset('img/favicon/site.webmanifest') }}>
    <link rel="mask-icon" href="{{ asset('img/favicon/safari-pinned-tab.svg') }}" color="#ffffff">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <!-- Sweet Alert -->
    <link type="text/css" href="{{ asset('sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">

    <!-- Font Awesome ICON -->
    <script src="https://kit.fontawesome.com/091b217840.js" crossorigin="anonymous"></script>

    <!-- Volt CSS -->
    <link type="text/css" href="{{ asset('css/volt.css') }}" rel="stylesheet">

    <!-- My CSS -->
    <link type="text/css" href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->
    @yield('styles')
</head>

<body>
    <nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none">
        <a class="navbar-brand me-lg-5" href="/">
            <img class="navbar-brand-dark" src="{{ asset('img/light.svg') }}" alt="Risk Management logo" />
        </a>
        <div class="d-flex align-items-center">
            <button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
        <div class="sidebar-inner px-4 pt-3">
            <div
                class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
                <div class="d-flex align-items-center">
                    <div class="avatar-lg me-4">
                        <img src="{{ isset($userImage) ? $userImage : '' }} "
                            class="card-img-top rounded-circle border-white" alt="Bonnie Green">
                    </div>
                    <div class="d-block">
                        <h2 class="h6 mb-0">{{ $userGlobal->name }}</h2>
                        <div class="">{{ $userGlobal->email }}</div>
                    </div>
                </div>
                <div class="collapse-close d-md-none">
                    <a href="#sidebarMenu" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
                        aria-controls="sidebarMenu" aria-expanded="true" aria-label="Toggle navigation">
                        <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!--SIDEBAR NAV-->
            <ul class="nav flex-column pt-3 pt-md-0">
                <li class="nav-item">
                    <a href="/" class="nav-link d-flex align-items-center">
                        <span class="sidebar-icon">
                            <img src="{{ asset('img/light.svg') }}" height="20" width="20" alt="SIG Logo">
                        </span>
                        <span class="mt-1 ms-1 sidebar-text fw-bold">Risk Management</span>
                    </a>
                </li>

                <!--SIDEBAR MENU-->
                @if (Auth::user()->getRoleNames()[0] == 'admin')
                    <li class="nav-item {{ Request::routeIs(['admin', 'admin.roles']) ? 'active' : '' }}">
                        <a href="{{ route('admin.roles') }}" class="nav-link d-flex align-items-center">
                            <span class="sidebar-icon">
                                <i class="fa-solid fa-user-tie"></i>
                            </span>
                            <span class="ms-2 sidebar-text">Kelola Jabatan</span>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::routeIs(['admin.users']) ? 'active' : '' }}">
                        <a href="{{ route('admin.users') }}" class="nav-link d-flex align-items-center">
                            <span class="sidebar-icon">
                                <i class="fa-solid fa-users"></i>
                            </span>
                            <span class="ms-2 sidebar-text">Kelola User</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->getRoleNames()[0] == 'risk_owner')
                    <li class="nav-item {{ Request::routeIs(['risk.owner.dashboard']) ? 'active' : '' }}">
                        <a href="{{ route('risk.owner.dashboard') }}" class="nav-link d-flex align-items-center">
                            <span class="sidebar-icon">
                                <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                                    <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                                </svg>
                            </span>
                            <span class="ms-2 sidebar-text">Dashboard</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->getRoleNames()[0] == 'risk_owner')
                    <li class="nav-item {{ Request::routeIs(['risk.owner.analyze']) ? 'active' : '' }}">
                        <a href="{{ route('risk.owner.analyze') }}" class="nav-link d-flex align-items-center">
                            <span class="sidebar-icon">
                                <svg class="icon icon-xs me-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512">
                                    <path
                                        d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                                </svg>
                            </span>
                            <span class="ms-2 sidebar-text">Analsis Risiko</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->getRoleNames()[0] == 'risk_owner')
                    <li class="nav-item {{ Request::routeIs(['risk.owner.evaluate']) ? 'active' : '' }}">
                        <a href="{{ route('risk.owner.evaluate') }}" class="nav-link d-flex align-items-center">
                            <span class="sidebar-icon">
                                <svg class="icon icon-xs me-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M448 160l-128 0 0-32 128 0 0 32zM48 64C21.5 64 0 85.5 0 112l0 64c0 26.5 21.5 48 48 48l416 0c26.5 0 48-21.5 48-48l0-64c0-26.5-21.5-48-48-48L48 64zM448 352l0 32-256 0 0-32 256 0zM48 288c-26.5 0-48 21.5-48 48l0 64c0 26.5 21.5 48 48 48l416 0c26.5 0 48-21.5 48-48l0-64c0-26.5-21.5-48-48-48L48 288z" />
                                </svg>
                            </span>
                            <span class="ms-2 sidebar-text">Evaluasi Risiko</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->getRoleNames()[0] == 'risk_owner')
                    <li class="nav-item {{ Request::routeIs(['risk.owner.manage']) ? 'active' : '' }}">
                        <a href="{{ route('risk.owner.manage') }}" class="nav-link d-flex align-items-center">
                            <span class="sidebar-icon">
                                <svg class="icon icon-xs me-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 384 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M192 0c-41.8 0-77.4 26.7-90.5 64L64 64C28.7 64 0 92.7 0 128L0 448c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64l-37.5 0C269.4 26.7 233.8 0 192 0zm0 64a32 32 0 1 1 0 64 32 32 0 1 1 0-64zM305 273L177 401c-9.4 9.4-24.6 9.4-33.9 0L79 337c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L271 239c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z" />
                                </svg>
                            </span>
                            <span class="ms-2 sidebar-text">Kelola Mitigasi</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->getRoleNames()[0] == 'operator')
                    <li class="nav-item {{ Request::routeIs(['operator.asset.categories']) ? 'active' : '' }}">
                        <a href="{{ route('operator.asset.categories') }}"
                            class="nav-link d-flex align-items-center">
                            <span class="sidebar-icon">
                                <i class="fa-solid fa-layer-group"></i>
                            </span>
                            <span class="ms-2 sidebar-text">Kategori Aset</span>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::routeIs(['operator.assets']) ? 'active' : '' }}">
                        <a href="{{ route('operator.assets') }}" class="nav-link d-flex align-items-center">
                            <span class="sidebar-icon">
                                <i class="fa-solid fa-list"></i>
                            </span>
                            <span class="ms-2 sidebar-text">Aset Kritis</span>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::routeIs(['operator.security.requirements']) ? 'active' : '' }}">
                        <a href="{{ route('operator.security.requirements') }}"
                            class="nav-link d-flex align-items-center">
                            <span class="sidebar-icon">
                                <i class="fa-brands fa-expeditedssl"></i>
                            </span>
                            <span class="ms-2 sidebar-text">Persyaratan Keamanan</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->getRoleNames()[0] == 'kepala_upt')
                    <li class="nav-item {{ Request::routeIs(['kepala.upt.risk.profile']) ? 'active' : '' }}">
                        <a href="{{ route('kepala.upt.risk.profile') }}" class="nav-link d-flex align-items-center">
                            <span class="sidebar-icon">
                                <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                                    <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                                </svg>
                            </span>
                            <span class="ms-2 sidebar-text">Dashboard</span>
                        </a>
                    </li>
                @endif
                <li role="separator" class="dropdown-divider mt-4 mb-3 border-gray-700"></li>
            </ul>
            <!--HEADER NAV-->
        </div>
    </nav>

    <main class="content">

        <!--HEADER NAV-->
        <nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
            <div class="container-fluid px-0">
                <div class="d-flex justify-content-end w-100" id="navbarSupportedContent">
                    <!-- Navbar links -->
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle pt-1 px-0 d-flex" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path
                                        d="M233.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L256 173.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z" />
                                </svg> --}}
                                <div class="media d-flex align-items-center">
                                    <img class="avatar rounded-circle" alt="Image placeholder"
                                        src="{{ isset($userImage) ? $userImage : '' }} }}">
                                    <div class="media-body ms-2 text-dark align-items-center d-none d-xl-block">
                                        <div class="mb-0 font-small fw-bold text-gray-900">{{ $userGlobal->name }}
                                        </div>
                                        <div class="mb-0 font-small text-gray-900">{{ $userGlobal->email }}</div>
                                    </div>
                                </div>
                            </a>
                            @if (Route::has('logout'))
                                <div class="dropdown-menu dashboard-dropdown dropdown-menu-end mt-2 py-1">
                                    <form action="{{ route('logout') ?? '#' }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item d-flex align-items-center">
                                            <svg class="dropdown-icon text-danger me-2" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                                </path>
                                            </svg>
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--HEADER NAV-->

        <!--DISPLAY CONTENT-->
        <div class="row">
            @yield('content')
        </div>
        <!--DISPLAY CONTENT-->
        <footer class="mx-2">
            <div class="row bg-white rounded shadow p-3 mb-4 mt-4">
                <div class="col-12 col-md-8 mb-md-0">
                    <p class="mb-0 text-center text-lg-start text-nowrap">© 2024-<span class="current-year"></span>
                        Project
                        Manajemen Risiko</p>
                </div>
                <div class="col-12 col-md-4 text-center text-lg-start">
                    <!-- List -->
                    <ul class="list-inline list-group-flush list-group-borderless text-md-end mb-0">
                        <li class="list-inline-item px-0 px-sm-2">
                            <a href="#"><i class="fa-brands fa-github"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
    </main>


    <!-- Core -->
    <script src="{{ asset('vendor/@popperjs/core/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Charts -->
    <script src="{{ asset('vendor/chartist/chartist.min.js') }}"></script>
    <script src="{{ asset('vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min.js') }}"></script>

    <!-- Sweet Alerts 2 -->
    <script src="{{ asset('sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

    @stack('scripts')
    <!-- Volt JS -->
    <script src="{{ asset('js/volt.js') }}"></script>
</body>

</html>
