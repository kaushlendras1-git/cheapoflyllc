<!doctype html>
<html
  lang="en"
  class="layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="ltr"
  data-skin="default"
  data-assets-path="./assets/"
  data-template="horizontal-menu-template"
  data-bs-theme="light">
  <head>
    <meta charset="utf-8" />
    <meta
     name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="robots" content="noindex" />
    <title>Booking Managment System</title>
    <meta name="description" content="" />

    <!-- Favicon -->

    <link rel="icon" type="image/x-icon" href="./assets/img/favicon/favicon.ico" />



    <!-- Fonts -->

    <link rel="preconnect" href="https://fonts.googleapis.com" />

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <link

      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"

      rel="stylesheet" />


      <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/iconify-icons.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/pickr/pickr-themes.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />


<script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
<script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script>
<script src="{{ asset('assets/js/config.js') }}"></script>
@routes
@vite(['resources/css/app.css', 'resources/js/app.js'])
@yield('head')

<script src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js" defer></script>
<script>
  window.OneSignalDeferred = window.OneSignalDeferred || [];
  OneSignalDeferred.push(async function(OneSignal) {
    await OneSignal.init({
      appId: "195dc9d3-aa77-41fb-ae15-f2b52fc1d940",
      safari_web_id: "web.onesignal.auto.4eb8ce3a-dc5a-4285-aae8-d5934d20e23e",
      notifyButton: {
        enable: true,
      },
      allowLocalhostAsSecureOrigin: true,
    });
  });
</script>
</head>



  <body>

    <!-- Layout wrapper -->

    <!-- <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu"> -->
    <div class="layout-wrapper layout-navbar-full layout-without-menu">

      <div class="layout-container">

        <!-- Navbar -->



        <nav class="layout-navbar navbar navbar-expand-xl align-items-center" id="layout-navbar">
          <div class="container-xxl">
            <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-6">
              <a href="{{route('user.dashboard')}}" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                  <span class="text-primary">
                    <svg width="30" height="24" viewBox="0 0 250 196" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M12.3002 1.25469L56.655 28.6432C59.0349 30.1128 60.4839 32.711 60.4839 35.5089V160.63C60.4839 163.468 58.9941 166.097 56.5603 167.553L12.2055 194.107C8.3836 196.395 3.43136 195.15 1.14435 191.327C0.395485 190.075 0 188.643 0 187.184V8.12039C0 3.66447 3.61061 0.0522461 8.06452 0.0522461C9.56056 0.0522461 11.0271 0.468577 12.3002 1.25469Z"
                        fill="currentColor" />
                      <path
                        opacity="0.077704"
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M0 65.2656L60.4839 99.9629V133.979L0 65.2656Z"
                        fill="black" />
                      <path
                        opacity="0.077704"
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M0 65.2656L60.4839 99.0795V119.859L0 65.2656Z"
                        fill="black" />

                        <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M237.71 1.22393L193.355 28.5207C190.97 29.9889 189.516 32.5905 189.516 35.3927V160.631C189.516 163.469 191.006 166.098 193.44 167.555L237.794 194.108C241.616 196.396 246.569 195.151 248.856 191.328C249.605 190.076 250 188.644 250 187.185V8.09597C250 3.64006 246.389 0.027832 241.935 0.027832C240.444 0.027832 238.981 0.441882 237.71 1.22393Z"
                        fill="currentColor" />

                        <path
                        opacity="0.077704"
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M250 65.2656L189.516 99.8897V135.006L250 65.2656Z"
                        fill="black" />

                      <path

                        opacity="0.077704"

                        fill-rule="evenodd"

                        clip-rule="evenodd"

                        d="M250 65.2656L189.516 99.0497V120.886L250 65.2656Z"

                        fill="black" />

                      <path

                        fill-rule="evenodd"

                        clip-rule="evenodd"

                        d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z"

                        fill="currentColor" />

                      <path

                        fill-rule="evenodd"

                        clip-rule="evenodd"

                        d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z"

                        fill="white"

                        fill-opacity="0.15" />

                      <path

                        fill-rule="evenodd"

                        clip-rule="evenodd"

                        d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z"

                        fill="currentColor" />

                      <path

                        fill-rule="evenodd"

                        clip-rule="evenodd"

                        d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z"

                        fill="white"

                        fill-opacity="0.3" />

                    </svg>

                  </span>

                </span>

                <span class="app-brand-text demo menu-text fw-semibold ms-1">Booking Managment System</span>

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

                <!-- Search -->
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                      <a class="btn btn-danger d-flex" href="#"
                         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                          <small class="align-middle">Logout</small>
                          <i class="icon-base ri ri-logout-box-r-line ms-2 icon-16px"></i>
                      </a>


                <li class="nav-item navbar-search-wrapper me-sm-2 me-xl-1 mb-50">

                  <a class="nav-item nav-link search-toggler px-0" href="javascript:void(0);">

                    <span class="d-inline-block text-body-secondary fw-normal" id="autocomplete"></span>

                  </a>

                </li>

                <!-- /Search -->



                <!-- Style Switcher -->

                <li class="nav-item dropdown me-sm-2 me-xl-0">

                  <a

                    class="nav-link dropdown-toggle hide-arrow btn btn-icon btn-text-secondary rounded-pill"

                    id="nav-theme"

                    href="javascript:void(0);"

                    data-bs-toggle="dropdown">

                    <i class="icon-base ri ri-sun-line icon-22px theme-icon-active"></i>

                    <span class="d-none ms-2" id="nav-theme-text">Toggle theme</span>

                  </a>

                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="nav-theme-text">

                    <li>

                      <button

                        type="button"

                        class="dropdown-item align-items-center active"

                        data-bs-theme-value="light"

                        aria-pressed="false">

                        <span> <i class="icon-base ri ri-sun-line icon-md me-3" data-icon="sun-line"></i>Light</span>

                      </button>

                    </li>

                    <li>

                      <button

                        type="button"

                        class="dropdown-item align-items-center"

                        data-bs-theme-value="dark"

                        aria-pressed="true">

                        <span>

                          <i class="icon-base ri ri-moon-clear-line icon-md me-3" data-icon="moon-clear-line"></i

                          >Dark</span

                        >

                      </button>

                    </li>

                    <li>

                      <button

                        type="button"

                        class="dropdown-item align-items-center"

                        data-bs-theme-value="system"

                        aria-pressed="false">

                        <span>

                          <i class="icon-base ri ri-computer-line icon-md me-3" data-icon="computer-line"></i

                          >System</span

                        >

                      </button>

                    </li>

                  </ul>

                </li>

                <!-- / Style Switcher-->



                <!-- Quick links -->

                <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-sm-2 me-xl-0">

                  <a

                    class="nav-link dropdown-toggle hide-arrow btn btn-icon btn-text-secondary rounded-pill"

                    href="javascript:void(0);"

                    data-bs-toggle="dropdown"

                    data-bs-auto-close="outside"

                    aria-expanded="false">

                    <i class="icon-base ri ri-star-smile-line icon-22px"></i>

                  </a>

                  <div class="dropdown-menu dropdown-menu-end p-0">

                    <div class="dropdown-menu-header border-bottom">

                      <div class="dropdown-header d-flex align-items-center py-2 my-50">

                        <h6 class="mb-0 me-auto">Shortcuts</h6>

                        <a

                          href="javascript:void(0)"

                          class="dropdown-shortcuts-add btn btn-text-secondary rounded-pill btn-icon"

                          data-bs-toggle="tooltip"

                          data-bs-placement="top"

                          title="Add shortcuts">

                          <i class="icon-base ri ri-add-line icon-20px text-heading"></i>

                        </a>

                      </div>

                    </div>

                    <div class="dropdown-shortcuts-list scrollable-container">

                      <div class="row row-bordered overflow-visible g-0">

                        <div class="dropdown-shortcuts-item col">

                          <span class="dropdown-shortcuts-icon rounded-circle mb-3">

                            <i class="icon-base ri ri-calendar-line icon-26px text-heading"></i>

                          </span>

                          <a href="app-calendar.html" class="stretched-link">Calendar</a>

                          <small>Appointments</small>

                        </div>

                        <div class="dropdown-shortcuts-item col">

                          <span class="dropdown-shortcuts-icon rounded-circle mb-3">

                            <i class="icon-base ri ri-file-text-line icon-26px text-heading"></i>

                          </span>

                          <a href="app-invoice-list.html" class="stretched-link">Invoice App</a>

                          <small>Manage Accounts</small>

                        </div>

                      </div>

                      <div class="row row-bordered overflow-visible g-0">

                        <div class="dropdown-shortcuts-item col">

                          <span class="dropdown-shortcuts-icon rounded-circle mb-3">

                            <i class="icon-base ri ri-user-line icon-26px text-heading"></i>

                          </span>

                          <a href="app-user-list.html" class="stretched-link">User App</a>

                          <small>Manage Users</small>

                        </div>

                        <div class="dropdown-shortcuts-item col">

                          <span class="dropdown-shortcuts-icon rounded-circle mb-3">

                            <i class="icon-base ri ri-computer-line icon-26px text-heading"></i>

                          </span>

                          <a href="app-access-roles.html" class="stretched-link">Role Management</a>

                          <small>Permission</small>

                        </div>

                      </div>

                      <div class="row row-bordered overflow-visible g-0">

                        <div class="dropdown-shortcuts-item col">

                          <span class="dropdown-shortcuts-icon rounded-circle mb-3">

                            <i class="icon-base ri ri-pie-chart-2-line icon-26px text-heading"></i>

                          </span>

                          <a href="{{route('user.dashboard')}}" class="stretched-link">Dashboard</a>

                          <small>User Dashboard</small>

                        </div>

                        <div class="dropdown-shortcuts-item col">

                          <span class="dropdown-shortcuts-icon rounded-circle mb-3">

                            <i class="icon-base ri ri-settings-4-line icon-26px text-heading"></i>

                          </span>

                          <a href="pages-account-settings-account.html" class="stretched-link">Setting</a>

                          <small>Account Settings</small>

                        </div>

                      </div>

                      <div class="row row-bordered overflow-visible g-0">

                        <div class="dropdown-shortcuts-item col">

                          <span class="dropdown-shortcuts-icon rounded-circle mb-3">

                            <i class="icon-base ri ri-question-line icon-26px text-heading"></i>

                          </span>

                          <a href="pages-faq.html" class="stretched-link">FAQs</a>

                          <small>FAQs & Articles</small>

                        </div>

                        <div class="dropdown-shortcuts-item col">

                          <span class="dropdown-shortcuts-icon rounded-circle mb-3">

                            <i class="icon-base ri ri-tv-2-line icon-26px text-heading"></i>

                          </span>

                          <a href="modal-examples.html" class="stretched-link">Modals</a>

                          <small>Useful Popups</small>

                        </div>

                      </div>

                    </div>

                  </div>

                </li>

                <!-- Quick links -->



                <!-- Notification -->

                <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">

                  <a

                    class="nav-link dropdown-toggle hide-arrow btn btn-icon btn-text-secondary rounded-pill"

                    href="javascript:void(0);"

                    data-bs-toggle="dropdown"

                    data-bs-auto-close="outside"

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

                          <a

                            href="javascript:void(0)"

                            class="dropdown-notifications-all p-2"

                            data-bs-toggle="tooltip"

                            data-bs-placement="top"

                            title="Mark all as read">

                            <i class="icon-base ri ri-mail-open-line text-heading"></i>

                          </a>

                        </div>

                      </div>

                    </li>

                    <li class="dropdown-notifications-list scrollable-container">

                      <ul class="list-group list-group-flush">

                        <li class="list-group-item list-group-item-action dropdown-notifications-item">

                          <div class="d-flex">

                            <div class="flex-shrink-0 me-3">

                              <div class="avatar">

                              <img src="{{ asset('assets/img/avatars/1.png') }}" alt="alt" class="rounded-circle" />


                              </div>

                            </div>

                            <div class="flex-grow-1">

                              <h6 class="small mb-50">Congratulation Lettie 🎉</h6>

                              <small class="mb-1 d-block text-body">Won the monthly best seller gold badge</small>

                              <small class="text-body-secondary">1h ago</small>

                            </div>

                            <div class="flex-shrink-0 dropdown-notifications-actions">

                              <a href="javascript:void(0)" class="dropdown-notifications-read">

                                <span class="badge badge-dot"></span

                              ></a>

                              <a href="javascript:void(0)" class="dropdown-notifications-archive">

                                <span class="icon-base ri ri-close-line"></span

                              ></a>

                            </div>

                          </div>

                        </li>

                        <li class="list-group-item list-group-item-action dropdown-notifications-item">

                          <div class="d-flex">

                            <div class="flex-shrink-0 me-3">

                              <div class="avatar">

                                <span class="avatar-initial rounded-circle bg-label-danger">CF</span>

                              </div>

                            </div>

                            <div class="flex-grow-1">

                              <h6 class="small mb-50">Charles Franklin</h6>

                              <small class="mb-1 d-block text-body">Accepted your connection</small>

                              <small class="text-body-secondary">12hr ago</small>

                            </div>

                            <div class="flex-shrink-0 dropdown-notifications-actions">

                              <a href="javascript:void(0)" class="dropdown-notifications-read">

                                <span class="badge badge-dot"></span

                              ></a>

                              <a href="javascript:void(0)" class="dropdown-notifications-archive">

                                <span class="icon-base ri ri-close-line"></span

                              ></a>

                            </div>

                          </div>

                        </li>

                        <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">

                          <div class="d-flex">

                            <div class="flex-shrink-0 me-3">

                              <div class="avatar">

                                <img src="./assets/img/avatars/2.png" alt="alt" class="rounded-circle" />

                              </div>

                            </div>

                            <div class="flex-grow-1">

                              <h6 class="small mb-50">New Message ✉️</h6>

                              <small class="mb-1 d-block text-body">You have new message from Natalie</small>

                              <small class="text-body-secondary">1h ago</small>

                            </div>

                            <div class="flex-shrink-0 dropdown-notifications-actions">

                              <a href="javascript:void(0)" class="dropdown-notifications-read">

                                <span class="badge badge-dot"></span

                              ></a>

                              <a href="javascript:void(0)" class="dropdown-notifications-archive">

                                <span class="icon-base ri ri-close-line"></span

                              ></a>

                            </div>

                          </div>

                        </li>

                        <li class="list-group-item list-group-item-action dropdown-notifications-item">

                          <div class="d-flex">

                            <div class="flex-shrink-0 me-3">

                              <div class="avatar">

                                <span class="avatar-initial rounded-circle bg-label-success">

                                  <i class="icon-base ri ri-car-line"></i>

                                </span>

                              </div>

                            </div>

                            <div class="flex-grow-1">

                              <h6 class="small mb-50">Whoo! You have new order 🛒</h6>

                              <small class="mb-1 d-block text-body">ACME Inc. made new order $1,154</small>

                              <small class="text-body-secondary">1 day ago</small>

                            </div>

                            <div class="flex-shrink-0 dropdown-notifications-actions">

                              <a href="javascript:void(0)" class="dropdown-notifications-read">

                                <span class="badge badge-dot"></span

                              ></a>

                              <a href="javascript:void(0)" class="dropdown-notifications-archive">

                                <span class="icon-base ri ri-close-line"></span

                              ></a>

                            </div>

                          </div>

                        </li>

                        <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">

                          <div class="d-flex">

                            <div class="flex-shrink-0 me-3">

                              <div class="avatar">

                                <img src="./assets/img/avatars/9.png" alt="alt" class="rounded-circle" />

                              </div>

                            </div>

                            <div class="flex-grow-1">

                              <h6 class="small mb-50">Application has been approved 🚀</h6>

                              <small class="mb-1 d-block text-body"

                                >Your ABC project application has been approved.</small

                              >

                              <small class="text-body-secondary">2 days ago</small>

                            </div>

                            <div class="flex-shrink-0 dropdown-notifications-actions">

                              <a href="javascript:void(0)" class="dropdown-notifications-read">

                                <span class="badge badge-dot"></span

                              ></a>

                              <a href="javascript:void(0)" class="dropdown-notifications-archive">

                                <span class="icon-base ri ri-close-line"></span

                              ></a>

                            </div>

                          </div>

                        </li>

                        <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">

                          <div class="d-flex">

                            <div class="flex-shrink-0 me-3">

                              <div class="avatar">

                                <span class="avatar-initial rounded-circle bg-label-success">

                                  <i class="icon-base ri ri-pie-chart-2-line"></i>

                                </span>

                              </div>

                            </div>

                            <div class="flex-grow-1">

                              <h6 class="small mb-50">Monthly report is generated</h6>

                              <small class="mb-1 d-block text-body">July monthly financial report is generated </small>

                              <small class="text-body-secondary">3 days ago</small>

                            </div>

                            <div class="flex-shrink-0 dropdown-notifications-actions">

                              <a href="javascript:void(0)" class="dropdown-notifications-read">

                                <span class="badge badge-dot"></span

                              ></a>

                              <a href="javascript:void(0)" class="dropdown-notifications-archive">

                                <span class="icon-base ri ri-close-line"></span

                              ></a>

                            </div>

                          </div>

                        </li>

                        <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">

                          <div class="d-flex">

                            <div class="flex-shrink-0 me-3">

                              <div class="avatar">

                                <img src="./assets/img/avatars/5.png" alt="alt" class="rounded-circle" />

                              </div>

                            </div>

                            <div class="flex-grow-1">

                              <h6 class="small mb-50">Send connection request</h6>

                              <small class="mb-1 d-block text-body">Peter sent you connection request</small>

                              <small class="text-body-secondary">4 days ago</small>

                            </div>

                            <div class="flex-shrink-0 dropdown-notifications-actions">

                              <a href="javascript:void(0)" class="dropdown-notifications-read">

                                <span class="badge badge-dot"></span

                              ></a>

                              <a href="javascript:void(0)" class="dropdown-notifications-archive">

                                <span class="icon-base ri ri-close-line"></span

                              ></a>

                            </div>

                          </div>

                        </li>

                        <li class="list-group-item list-group-item-action dropdown-notifications-item">

                          <div class="d-flex">

                            <div class="flex-shrink-0 me-3">

                              <div class="avatar">

                                <img src="./assets/img/avatars/6.png" alt="alt" class="rounded-circle" />

                              </div>

                            </div>

                            <div class="flex-grow-1">

                              <h6 class="small mb-50">New message from Jane</h6>

                              <small class="mb-1 d-block text-body">Your have new message from Jane</small>

                              <small class="text-body-secondary">5 days ago</small>

                            </div>

                            <div class="flex-shrink-0 dropdown-notifications-actions">

                              <a href="javascript:void(0)" class="dropdown-notifications-read">

                                <span class="badge badge-dot"></span

                              ></a>

                              <a href="javascript:void(0)" class="dropdown-notifications-archive">

                                <span class="icon-base ri ri-close-line"></span

                              ></a>

                            </div>

                          </div>

                        </li>

                        <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">

                          <div class="d-flex">

                            <div class="flex-shrink-0 me-3">

                              <div class="avatar">

                                <span class="avatar-initial rounded-circle bg-label-warning">

                                  <i class="icon-base ri ri-error-warning-line"></i>

                                </span>

                              </div>

                            </div>

                            <div class="flex-grow-1">

                              <h6 class="small mb-50">CPU is running high</h6>

                              <small class="mb-1 d-block text-body"

                                >CPU Utilization Percent is currently at 88.63%,</small

                              >

                              <small class="text-body-secondary">5 days ago</small>

                            </div>

                            <div class="flex-shrink-0 dropdown-notifications-actions">

                              <a href="javascript:void(0)" class="dropdown-notifications-read">

                                <span class="badge badge-dot"></span

                              ></a>

                              <a href="javascript:void(0)" class="dropdown-notifications-archive">

                                <span class="icon-base ri ri-close-line"></span

                              ></a>

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

                  <a

                    class="nav-link dropdown-toggle hide-arrow p-0"

                    href="javascript:void(0);"

                    data-bs-toggle="dropdown">

                    <div class="avatar avatar-online">

                      <img src="{{ asset('assets/img/avatars/1.png') }}" alt="alt" class="rounded-circle" />


                    </div>

                  </a>

                  <ul class="dropdown-menu dropdown-menu-end mt-3 py-2">

                    <li>

                      <a class="dropdown-item" href="pages-account-settings-account.html">

                        <div class="d-flex align-items-center">

                          <div class="flex-shrink-0 me-2">

                            <div class="avatar avatar-online">

                            <img src="{{ asset('assets/img/avatars/1.png') }}" alt="alt" class="w-px-40 h-auto rounded-circle" />

                            </div>

                          </div>

                          <div class="flex-grow-1">

                            <h6 class="mb-0 small">
                                @if (Auth::check())
                                    Welcome, {{ Auth::user()->name }}
                                @endif
                            </h6>

                            <small class="text-body-secondary">Admin</small>

                          </div>

                        </div>

                      </a>

                    </li>

                    <li>

                      <div class="dropdown-divider"></div>

                    </li>

                    <li>

                      <a class="dropdown-item" href="pages-profile-user.html">

                        <i class="icon-base ri ri-user-3-line icon-22px me-2"></i>

                        <span class="align-middle">My Profile</span>

                      </a>

                    </li>

                    <li>

                      <a class="dropdown-item" href="pages-account-settings-account.html">

                        <i class="icon-base ri ri-settings-4-line icon-22px me-2"></i>

                        <span class="align-middle">Settings</span>

                      </a>

                    </li>



                    <li>

                      <div class="dropdown-divider"></div>

                    </li>



                    <li>

                      <a class="dropdown-item" href="pages-faq.html">

                        <i class="icon-base ri ri-question-line icon-22px me-2"></i>

                        <span class="align-middle">FAQ</span>

                      </a>

                    </li>

                    <li>

                      <div class="d-grid px-4 pt-2 pb-1">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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

                </li>

                <!--/ User -->
              </ul>
            </div>
          </div>
        </nav>

        <!-- / Navbar -->

        <!-- Layout container -->

        <div class="layout-page">

          <!-- Content wrapper -->

          <div class="content-wrapper">

            <!-- Menu -->
              @if(Auth::user()->role == 'admin')
                  @include('web.layouts.admin-menu')
            @elseif(Auth::user()->role == 'agent')
               @include('web.layouts.agent-menu')
            @endif
            <!-- Menu -->



              </div>
            </div>
