<!doctype html>
<html lang="en" class="layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-skin="default"
    data-assets-path="./assets/" data-template="horizontal-menu-template" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="robots" content="noindex" />
    <meta name="csrf-token" content="{{csrf_token()}}"/>
    <title>Booking Managment System</title>
    <meta name="description" content="" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/iconify-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <!-- <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script> -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <style>
        #loader-overlay {
            position: fixed;
            top: 0; left: 0;
            width: 100vw; height: 100vh;
            background: rgba(0,0,0,0.5);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .loader {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .spinner {
            width: 48px; height: 48px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #3dc7ff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 16px;
        }
        .loading-text {
            color: #fff;
            font-size: 1.2rem;
            font-weight: bold;
            letter-spacing: 1px;
        }
        @keyframes spin {
            100% { transform: rotate(360deg); }
        }
        


    </style>
    @routes
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        // Set user role and department for admin notifications
        window.userRole = '{{ Auth::user()->role ?? "" }}';
        window.userDepartment = '{{ Auth::user()->departments ?? "" }}';
        

    </script>
    @yield('head')
</head>
<body>

    <div id="loader-overlay">
        <div class="loader">
            <div class="spinner"></div>
            <span class="loading-text">Loading, please wait...</span>
        </div>
    </div>
    <!-- Layout wrapper -->

    <!-- <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu"> -->
    <div class="layout-wrapper layout-navbar-full layout-without-menu">
        <div class="layout-container block-auto">
            <!-- Navbar -->
            <nav class="layout-navbar navbar navbar-expand-xl align-items-center" id="layout-navbar">
                <div class="container-xxl">
                    <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-6">
                    
                     @if(auth()->user()->is_lob == 1)
                        <a href="{{route('lob.dashboard')}}" class="app-brand-link gap-2">
                    @elseif(auth()->user()->role_id == 3 && auth()->user()->department_id == 1)
                        <a href="{{route('admin.dashboard')}}" class="app-brand-link gap-2">
                    @elseif(auth()->user()->role_id == 2 && auth()->user()->department_id == 2)
                        <a href="{{route('admin.teamleader-dashboard')}}" class="app-brand-link gap-2">
                    @else        
                    <a href="{{route('user.dashboard')}}" class="app-brand-link gap-2">
                    @endif
                            <span class="app-brand-logo demo">
                                <span class="text-primary d-flex align-items-center">
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
                                    <h5 class="mb-0 ms-4">Hi, {{ Auth::user()->name }}</h5>

                                   @if(Auth::user()->id == 8)                                    
                                        <img src="{{ asset('paul.gif') }}" alt="US Flag" class="ms-3" style="width:150px;" /> 
                                        <img src="https://www.fightersgeneration.com/news2021/char5/feng-tekken7-story-paul.gif" alt="US Flag" class="ms-3" style="width:200px;" /> 
                                    @elseif(Auth::user()->id == 6)                                    
                                        <img src="data:image/jpeg;base64,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" alt="US Flag" class="ms-3" style="width:100px;" />
                                    @elseif(Auth::user()->id == 3)                                    
                                        <img src="data:image/jpeg;base64,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" alt="US Flag" class="ms-3" style="width:100px;" />
                                     @elseif(Auth::user()->id == 13)                                    
                                        <img src="https://i.pinimg.com/originals/c4/98/cd/c498cd159982c57514fdc1b593e3108a.gif" alt="US Flag" class="ms-3" style="width:100px;" />
                                    @endif




                                    

                                </span>
                            </span>
                        </a>
                        
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
                        @if(Auth::user()->department_id == 1)
                                                   <!-- Masters -->

                           <li class="menu-item {{ Str::startsWith(Route::currentRouteName(), ['teams', 'emails', 'campaign', 'call-types']) ? 'active' : '' }}">
                                <a href="javascript:void(0)" class="menu-link menu-toggle {{ Str::startsWith(Route::currentRouteName(), ['teams', 'emails', 'campaign', 'call-types']) ? 'active' : '' }}">
                                    <i class="menu-icon icon-base ri ri-tv-2-line"></i>
                                    <div data-i18n="Masters">Masters</div>
                                </a>
                                <ul class="menu-sub">

                                  <li class="menu-item {{ Route::currentRouteName() == 'lob.index' ? 'active' : '' }}">
                                        <a href="{{ route('lobs.index') }}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-phone-line"></i>
                                            <div data-i18n="LOB">LOB</div>
                                        </a>
                                   </li>

                                  <li class="menu-item {{ Route::currentRouteName() == 'teams.index' ? 'active' : '' }}">
                                        <a href="{{ route('teams.index') }}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-team-line"></i>
                                            <div data-i18n="Teams">Teams</div>
                                        </a>
                                    </li>

                                     <!--li class="menu-item {{ Route::currentRouteName() == 'units.index' ? 'active' : '' }}">
                                        <a href="{{ route('units.index') }}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-team-line"></i>
                                            <div data-i18n="Unit">Unit</div>
                                        </a>
                                    </li-->

                                    
                                    <li class="menu-item {{ Route::currentRouteName() == 'departments.index' ? 'active' : '' }}">
                                        <a href="{{ route('departments.index') }}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-mail-line"></i>
                                            <div data-i18n="Departments">Departments</div>
                                        </a>
                                    </li>

                                      <li class="menu-item {{ Route::currentRouteName() == 'roles.index' ? 'active' : '' }}">
                                        <a href="{{ route('roles.index') }}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-mail-line"></i>
                                            <div data-i18n="Roles">Roles</div>
                                        </a>
                                    </li>

                                      
                                   

                                  
                                    <li class="menu-item {{ Route::currentRouteName() == 'campaign.index' ? 'active' : '' }}">
                                        <a href="{{ route('campaign.index') }}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-megaphone-line"></i>
                                            <div data-i18n="Campaign">Campaign</div>
                                        </a>
                                    </li>
                                    <li class="menu-item {{ Route::currentRouteName() == 'call-types.index' ? 'active' : '' }}">
                                        <a href="{{ route('call-types.index') }}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-phone-line"></i>
                                            <div data-i18n="CallType">CallType</div>
                                        </a>
                                    </li>
                                    <li class="menu-item {{ Route::currentRouteName() == 'booking-status.index' ? 'active' : '' }}">
                                        <a href="{{ route('booking-status.index') }}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-phone-line"></i>
                                            <div data-i18n="Booking Status">Booking Status</div>
                                        </a>
                                    </li>

                                    <li class="menu-item {{ Route::currentRouteName() == 'payment-status.index' ? 'active' : '' }}">
                                        <a href="{{ route('payment-status.index') }}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-phone-line"></i>
                                            <div data-i18n="Payment Status">Payment Status</div>
                                        </a>
                                    </li>

                                    <li class="menu-item {{ Route::currentRouteName() == 'quality-feedback.index' ? 'active' : '' }}">
                                        <a href="{{ route('quality-feedback.index') }}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-phone-line"></i>
                                            <div data-i18n="Quality Feedback">Quality Feedback</div>
                                        </a>
                                    </li>

                                  

                                     <li class="menu-item {{ Route::currentRouteName() == 'emails.index' ? 'active' : '' }}">
                                        <a href="{{ route('emails.index') }}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-mail-line"></i>
                                            <div data-i18n="Emails">Emails</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif    
                       
                            <!-- Reports -->
                            <li class="menu-item {{ Str::startsWith(Route::currentRouteName(), ['marketing', 'call_queue', 'agents', 'score']) ? 'active' : '' }}">
                                <a href="{{ route('lob.profit-loss') }}" class="menu-link menu-toggle {{ Str::startsWith(Route::currentRouteName(), ['marketing', 'call_queue', 'agents', 'score']) ? 'active' : '' }}">
                                    <i class="menu-icon icon-base ri ri-article-line"></i>
                                    <div data-i18n="Analytics">Analytics</div>
                                </a>

                                

                            <ul class="menu-sub">
                                    <!-- <li class="menu-item {{ Route::currentRouteName() == 'marketing' ? 'active' : '' }}">
                                        <a href="{{ route('marketing') }}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-advertisement-line"></i>
                                            <div data-i18n="Marketing">Marketing</div>
                                        </a>
                                    </li>
                                    <li class="menu-item {{ Route::currentRouteName() == 'call_queue' ? 'active' : '' }}">
                                        <a href="{{ route('call_queue') }}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-group-line"></i>
                                            <div data-i18n="Call Queue">Call Queue</div>
                                        </a>
                                    </li> -->
                                    <li class="menu-item {{ Route::currentRouteName() == 'score.details' ? 'active' : '' }}">
                                        <a href="{{ route('score.details') }}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-user-2-line"></i>
                                            <div data-i18n="My Score">My Score</div>
                                        </a>
                                    </li>

                                    <!-- <li class="menu-item {{ Route::currentRouteName() == 'score' ? 'active' : '' }}">
                                        <a href="{{ route('score') }}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-star-line ri-2x"></i>
                                            <div data-i18n="Team Score">Team Score</div>
                                        </a>
                                    </li>
                                    
                                    <li class="menu-item {{ Route::currentRouteName() == 'reports.campaign-calls' ? 'active' : '' }}">
                                        <a href="{{ route('reports.campaign-calls') }}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-phone-line"></i>
                                            <div data-i18n="Campaign Calls">Campaign Calls</div>
                                        </a>
                                    </li>
                                    <li class="menu-item {{ Route::currentRouteName() == 'reports.revenue' ? 'active' : '' }}">
                                        <a href="{{ route('reports.revenue') }}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-money-dollar-circle-line"></i>
                                            <div data-i18n="Revenue Report">Revenue Report</div>
                                        </a>
                                    </li>
                                    <li class="menu-item {{ Route::currentRouteName() == 'reports.team' ? 'active' : '' }}">
                                        <a href="{{ route('reports.team') }}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-team-line"></i>
                                            <div data-i18n="Team Reports">Team Reports</div>
                                        </a>
                                    </li-->
                                  
                                    

                                    <li class="menu-item {{ Route::currentRouteName() == 'reports.unit' ? 'active' : '' }}">
                                        <a href="{{ route('reports.unit') }}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-building-line"></i>
                                            <div data-i18n="Unit Reports">Unit Reports</div>
                                        </a>
                                    </li>
                                  
                                     <li class="menu-item {{ Route::currentRouteName() == 'lob.products' ? 'active' : '' }}">
                                        <a href="{{ route('lob.products') }}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-team-line"></i>
                                            <div data-i18n="Product Performance">Product Performance</div>
                                        </a>
                                    </li>
                                     <li class="menu-item {{ Route::currentRouteName() == 'lob.campaigns' ? 'active' : '' }}">
                                        <a href="{{ route('lob.campaigns') }}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-phone-line"></i>
                                            <div data-i18n="Campaigns Reports">Campaigns Reports</div>
                                        </a>
                                    </li>
                                     <li class="menu-item {{ Route::currentRouteName() == 'lob.booking' ? 'active' : '' }}">
                                        <a href="{{ route('lob.booking-reports') }}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-building-4-line"></i>
                                            <div data-i18n="Company Reports">Booking Reports</div>
                                        </a>
                                    </li>
                                      <li class="menu-item {{ Route::currentRouteName() == 'lob.profit-loss' ? 'active' : '' }}">
                                        <a href="{{ route('lob.profit-loss') }}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-money-dollar-circle-line"></i>
                                            <div data-i18n="P&L Report ">P&L Report </div>
                                        </a>
                                    </li>



                                </ul>

                                
                            </li>


                     
                      


                            <!-- Booking -->
                            <li class="menu-item {{ Str::startsWith(Route::currentRouteName(), ['booking']) ? 'active' : '' }}">
                                <a href="javascript:void(0)" class="menu-link menu-toggle {{ Str::startsWith(Route::currentRouteName(), ['booking']) ? 'active' : '' }}">
                                    <i class="menu-icon icon-base ri ri-layout-2-line"></i>
                                    <div data-i18n="Booking">Booking</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item {{ Route::currentRouteName() == 'booking.index' ? 'active' : '' }}">
                                        <a href="{{ route('booking.index') }}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-calendar-line"></i>
                                            <div data-i18n="Today's Bookings">Today's Bookings</div>
                                        </a>
                                    </li>
                                    <li class="menu-item {{ Route::currentRouteName() == 'booking.search' ? 'active' : '' }}">
                                        <a href="{{ route('booking.search') }}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-calendar-check-line"></i>
                                            <div data-i18n="Booking Search">Booking Search</div>
                                        </a>
                                    </li>

                                     <li class="menu-item {{ Route::currentRouteName() == 'booking.online-booking.index' ? 'active' : '' }}">
                                        <a href="{{ route('booking.online-booking.index') }}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-calendar-check-line"></i>
                                            <div data-i18n="Online Booking">Online Booking</div>
                                        </a>
                                    </li>

                                </ul>
                            </li>

                            <!-- Call Logs -->
                            <li class="menu-item mrt-less {{ Str::startsWith(Route::currentRouteName(), 'call-logs') ? 'active' : '' }}">
                                <a href="{{ route('call-logs.index') }}" class="menu-link">
                                    <i class="menu-icon icon-base ri ri-table-line"></i>
                                    <div>Call Logs</div>
                                </a>
                            </li>

                            <!-- Follow Up -->
                            <li class="menu-item mrt-less {{ Str::startsWith(Route::currentRouteName(), 'follow-up') ? 'active' : '' }}">
                                <a href="{{ route('follow-up.index') }}" class="menu-link">
                                    <i class="menu-icon icon-base ri ri-user-community-line"></i>
                                    <div>Follow Ups</div>
                                </a>
                            </li>

                           @if(Auth::user()->department_id == 1)
                            <!-- Users -->
                            <li class="menu-item mrt-less {{ Str::startsWith(Route::currentRouteName(), 'users') ? 'active' : '' }}">
                                <a href="{{ route('users') }}" class="menu-link">
                                    <i class="menu-icon icon-base ri ri-user-line"></i>
                                    <div>Users</div>
                                </a>
                            </li>

                            <!-- RingCentral -->
                            <li class="menu-item {{ Str::startsWith(Route::currentRouteName(), 'ringcentral') ? 'active' : '' }}">
                                <a href="javascript:void(0)" class="menu-link menu-toggle {{ Str::startsWith(Route::currentRouteName(), 'ringcentral') ? 'active' : '' }}">
                                    <i class="menu-icon icon-base ri ri-phone-line"></i>
                                    <div data-i18n="RingCentral">RingCentral</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item {{ Route::currentRouteName() == 'ringcentral.settings' ? 'active' : '' }}">
                                        <a href="{{ route('ringcentral.settings') }}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-settings-3-line"></i>
                                            <div data-i18n="Settings">Settings</div>
                                        </a>
                                    </li>
                                    <li class="menu-item {{ Route::currentRouteName() == 'ringcentral.test' ? 'active' : '' }}">
                                        <a href="{{ route('ringcentral.test') }}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-test-tube-line"></i>
                                            <div data-i18n="Test">Test Integration</div>
                                        </a>
                                    </li>
                                    <li class="menu-item {{ Route::currentRouteName() == 'ringcentral.demo' ? 'active' : '' }}">
                                        <a href="{{ route('ringcentral.demo') }}" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-play-circle-line"></i>
                                            <div data-i18n="Demo">Demo & Examples</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="https://youtu.be/dQw4w9WgXcQ" target="_blank" class="menu-link">
                                            <i class="menu-icon icon-base ri ri-youtube-line"></i>
                                            <div data-i18n="Tutorial">Video Tutorial</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                         @endif



                            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                                <a class="nav-link dropdown-toggle hide-arrow btn btn-icon btn-text-secondary rounded-pill"
                                    href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                                    aria-expanded="false">
                                    <span class="position-relative">
                                        <i class="icon-base ri ri-notification-2-line icon-22px"></i>
                                        <span class="badge rounded-pill bg-danger badge-dot badge-notifications border"></span>
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
                                                        <a href="javascript:void(0)" class="dropdown-notifications-read">
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
                                        $initials = collect(explode(',', $name))->map(fn($word) => strtoupper(substr($word, 0, 2)))->join('');
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
                                        <li class="mb-4 username_user"> Hi, {{ Auth::user()->name }}</li>
                                        <li class="mb-4">
                                            <a class="dropdown-item" href="{{ route('profile') }}">
                                                <i class="icon-base ri ri-user-3-line icon-22px me-2"></i>
                                                <span class="align-middle">My Profile</span>
                                            </a>
                                        </li>

                                        <li class="mb-4">
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
            <div class="layout-page">
                <div class="content-wrapper">
