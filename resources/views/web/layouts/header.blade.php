<!doctype html>
<html lang="en" class="layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-skin="default"
    data-assets-path="./assets/" data-template="horizontal-menu-template" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="robots" content="noindex" />
    <title>Booking Managment System</title>
    <meta name="description" content="" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
        rel="stylesheet" />


    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/iconify-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <!-- <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script> -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
    @routes
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('head')

</head>



<body>

    <!-- Layout wrapper -->

    <!-- <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu"> -->
    <div class="layout-wrapper layout-navbar-full layout-without-menu">
        <div class="layout-container block-auto">
            <!-- Navbar -->
            <nav class="layout-navbar navbar navbar-expand-xl align-items-center" id="layout-navbar">
                <div class="container-xxl">
                    <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-6">
                        <a href="{{route('user.dashboard')}}" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <span class="text-primary">
                                    <svg width="30" height="24" viewBox="0 0 250 196" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.3002 1.25469L56.655 28.6432C59.0349 30.1128 60.4839 32.711 60.4839 35.5089V160.63C60.4839 163.468 58.9941 166.097 56.5603 167.553L12.2055 194.107C8.3836 196.395 3.43136 195.15 1.14435 191.327C0.395485 190.075 0 188.643 0 187.184V8.12039C0 3.66447 3.61061 0.0522461 8.06452 0.0522461C9.56056 0.0522461 11.0271 0.468577 12.3002 1.25469Z"
                                            fill="currentColor" />
                                        <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0 65.2656L60.4839 99.9629V133.979L0 65.2656Z" fill="black" />
                                        <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0 65.2656L60.4839 99.0795V119.859L0 65.2656Z" fill="black" />

                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M237.71 1.22393L193.355 28.5207C190.97 29.9889 189.516 32.5905 189.516 35.3927V160.631C189.516 163.469 191.006 166.098 193.44 167.555L237.794 194.108C241.616 196.396 246.569 195.151 248.856 191.328C249.605 190.076 250 188.644 250 187.185V8.09597C250 3.64006 246.389 0.027832 241.935 0.027832C240.444 0.027832 238.981 0.441882 237.71 1.22393Z"
                                            fill="currentColor" />

                                        <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M250 65.2656L189.516 99.8897V135.006L250 65.2656Z" fill="black" />

                                        <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M250 65.2656L189.516 99.0497V120.886L250 65.2656Z" fill="black" />

                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z"
                                            fill="currentColor" />

                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z"
                                            fill="white" fill-opacity="0.15" />

                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z"
                                            fill="currentColor" />

                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z"
                                            fill="white" fill-opacity="0.3" />
                                    </svg>
                                </span>
                            </span>
                        </a>
                        
                        <form method="GET" action="{{ route('booking.index') }}" class="search-header">
                               @csrf 
                            <div class="searchbox-table position-relative">
                              <input id="search-table" type="text" name="search" value="{{ request('search') }}"
                                class="form-control" placeholder="Search by PNR, name, email, status, etc.">
                              <span class="clear-icon" id="clear-search"> <a href="{{ route('booking.index') }}">&times;</a></span>
                          </div>
                        </form>

                        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
                            <i class="icon-base ri ri-close-line icon-sm"></i>
                        </a>
                    </div>
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                            <i class="icon-base ri ri-menu-line icon-md"></i>
                        </a>
                    </div>
                    <div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">
                        <ul class="navbar-nav flex-row align-items-center ms-md-auto">
                            <li
                                class="menu-item {{ Str::startsWith(Route::currentRouteName(), 'teams') ? 'active' : '' }}">
                                <a href="" class="menu-link menu-toggle">
                                    <i class="menu-icon icon-base ri ri-article-line"></i>
                                    <div data-i18n="Masters">Masters</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                        <a href="{{route('emails.index')}}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-tv-2-line"></i>
                                            <div data-i18n="Emails">Emails</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="{{route('teams.index')}}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-tv-2-line"></i>
                                            <div data-i18n="Teams">Teams</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="{{route('campaign.index')}}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-tv-2-line"></i>
                                            <div data-i18n="Campaign">Campaign</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="{{route('call-types.index')}}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-tv-2-line"></i>
                                            <div data-i18n="CallType">CallType</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Reports -->
                            <li class="menu-item">
                                <a href="javascript:void(0)" class="menu-link menu-toggle">
                                    <i class="menu-icon icon-base ri ri-article-line"></i>
                                    <div data-i18n="Reports">Reports</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                        <a href="{{route('marketing')}}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-tv-2-line"></i>
                                            <div data-i18n="Marketing">Marketing</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="{{route('call_queue')}}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-tv-2-line"></i>
                                            <div data-i18n="Call Queue">Call Queue</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="{{route('agents')}}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-tv-2-line"></i>
                                            <div data-i18n="Agent">Agents</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="{{route('score')}}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-tv-2-line"></i>
                                            <div data-i18n="Score">Score</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- Layouts -->
                            <li class="menu-item">
                                <a href="javascript:void(0)" class="menu-link menu-toggle">
                                    <i class="menu-icon icon-base ri ri-layout-2-line"></i>
                                    <div data-i18n="Booking">Booking</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                        <a href="{{route('booking.index')}}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-layout-4-line"></i>
                                            <div data-i18n="Booking">Booking</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="{{route('booking.add')}}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-layout-top-line"></i>
                                            <div data-i18n="Create Booking">Create Booking</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="{{route('booking.search')}}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-layout-left-line"></i>
                                            <div data-i18n="Find Booking">Find Booking</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="layouts-container.html" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-layout-top-2-line"></i>
                                            <div data-i18n="Online Booking">Online Booking</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li
                                class="menu-item mrt-less {{ Str::startsWith(Route::currentRouteName(), 'call-logs') ? 'active' : '' }}">
                                <a href="{{route('call-logs.index')}}" class="menu-link">
                                    <i class="menu-icon icon-base ri ri-table-line"></i>
                                    <div>Call Logs</div>
                                </a>
                            </li>
                            <li
                                class="menu-item mrt-less {{ Str::startsWith(Route::currentRouteName(), 'follow-up') ? 'active' : '' }}">
                                <a href="{{route('follow-up.index')}}" class="menu-link">
                                    <i class="menu-icon icon-base ri ri-table-line"></i>
                                    <div>Follow Up</div>
                                </a>
                            </li>
                            <li
                                class="menu-item mrt-less {{ Str::startsWith(Route::currentRouteName(), 'users') ? 'active' : '' }}">
                                <a href="{{route('users')}}" class="menu-link">
                                    <i class="menu-icon icon-base ri ri-user-line"></i>
                                    <div>Users</div>
                                </a>
                            </li>
                           

                            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">

                                <a class="nav-link dropdown-toggle hide-arrow btn btn-icon btn-text-secondary rounded-pill"
                                    href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                                    aria-expanded="false">

                                    <span class="position-relative">

                                        <i class="icon-base ri ri-notification-2-line icon-22px"></i>
                                        <span
                                            class="badge rounded-pill bg-danger badge-dot badge-notifications border"></span>

                                    </span>

                                </a>

                                <ul class="dropdown-menu dropdown-menu-end p-0">

                                    <li class="dropdown-menu-header border-bottom">

                                        <div class="dropdown-header d-flex align-items-center py-3">
                                            <h6 class="mb-0 me-auto">Notification</h6>

                                            <div class="d-flex align-items-center h6 mb-0">

                                                <span class="badge bg-label-primary rounded-pill me-2">8 New</span>

                                                <a href="javascript:void(0)" class="dropdown-notifications-all p-2"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Mark all as read">

                                                    <i class="icon-base ri ri-mail-open-line text-heading"></i>

                                                </a>

                                            </div>

                                        </div>

                                    </li>

                                    <li class="dropdown-notifications-list scrollable-container">

                                        <ul class="list-group list-group-flush">

                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item">

                                                <div class="d-flex">

                                                    <div class="flex-shrink-0 me-3">

                                                        <div class="avatar">

                                                            <img src="{{ asset('assets/img/avatars/1.png') }}" alt="alt"
                                                                class="rounded-circle" />


                                                        </div>

                                                    </div>

                                                    <div class="flex-grow-1">

                                                        <h6 class="small mb-50">Congratulation Lettie 🎉</h6>

                                                        <small class="mb-1 d-block text-body">Won the monthly best
                                                            seller gold badge</small>

                                                        <small class="text-body-secondary">1h ago</small>

                                                    </div>

                                                    <div class="flex-shrink-0 dropdown-notifications-actions">

                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read">

                                                            <span class="badge badge-dot"></span></a>

                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive">

                                                            <span class="icon-base ri ri-close-line"></span></a>

                                                    </div>

                                                </div>

                                            </li>



                                        </ul>

                                    </li>

                                    <li class="border-top">

                                        <div class="d-grid p-4">

                                            <a class="btn btn-primary btn-sm d-flex h-px-34" href="javascript:void(0);">

                                                <small class="align-middle">View all notifications</small>

                                            </a>

                                        </div>

                                    </li>

                                </ul>

                            </li>

                            <!--/ Notification -->



                            <!-- User -->

                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <div class="header-dropdown">
                                    @php
                                        $name = Auth::check() ? Auth::user()->name : '';
                                        $initials = collect(explode(' ', $name))->map(fn($word) => strtoupper(substr($word, 0, 2)))->join('');
                                    @endphp

                                    <a class="user-dropdown d-flex align-items-center" href="javascript:void(0);">
                                        <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center" style="width: 30px; height: 30px;">
                                            <span style="font-size: 14px; font-weight: bold;">{{ $initials }}</span>
                                        </div>
                                        <h5 class="user-name ms-2">
                                            @if (Auth::check())
                                               
                                            @endif
                                        </h5>
                                    </a>

                                    <ul class="list-unstyled drophead-menu" style="display: none;">
                                        <li class="mb-3 bg-warning"> Hi, {{ Auth::user()->name }}</li>
                                        <li class="mb-3">
                                            <a class="dropdown-item" href="{{ route('profile') }}">
                                                <i class="icon-base ri ri-user-3-line icon-22px me-2"></i>
                                                <span class="align-middle">My Profile</span>
                                            </a>
                                        </li>

                                        <li class="mb-3">
                                            <a class="dropdown-item" href="{{ route('settings') }}">
                                                <i class="icon-base ri ri-settings-4-line icon-22px me-2"></i>
                                                <span class="align-middle">Settings</span>
                                            </a>
                                        </li>
                                       
                                        <li>
                                            <div class="d-grid">
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                </form>
                                                <a class="btn btn-danger d-flex" href="#"
                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    <small class="align-middle">Logout</small>
                                                    <i class="icon-base ri ri-logout-box-r-line ms-2 icon-16px"></i>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!--/ User -->
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- / Navbar -->

            <!-- Layout container -->

            <!-- <div class="layout-page">

                

                <div class="content-wrapper">

                   
                    @if(Auth::user()->role == 'admin')
                    @include('web.layouts.admin-menu')
                    @elseif(Auth::user()->role == 'agent')
                    @include('web.layouts.agent-menu')
                    @endif
                   



                </div>
            </div> -->