<!doctype html>

<html lang="en" class="layout-wide customizer-hide" dir="ltr" data-skin="default" data-assets-path="../../assets/"
    data-template="horizontal-menu-template-no-customizer" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="robots" content="noindex" />

    <title>TravelaDesk</title>

    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
        rel="stylesheet" />

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/iconify-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/form-validation.css') }}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!-- Config -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

</head>

<body>
    <!-- Content -->
    <div class="login-content">
        <div class="row m-0 h-100">
            <div class="col-md-6 h-100">
                <div class="left-login text-center p-5 d-flex align-items-center h-100">
                    <div class="w-100">
                      <div class="img-login">
                        <img src="{{ asset('assets/img/login.png') }}" alt="login">
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 h-100 pe-0">
                <div class="right-login d-flex align-items-center h-100 w-100">
                    <div class="form-logins w-100">
                        @if ($errors->has('error'))
                        <div class="alert alert-danger">
                            {{ $errors->first('error') }}
                        </div>
                        @endif

                        <div class="card-body mt-1">
                            <div class="logo-login mb-5 text-center">
                                <img width="200" src="/storage/merchants/p7I9TTbVjUWWQ8bLPfVWrnoGAL7D7HgDs2vryCOl.png" alt="login">
                            </div>
                            <h2 class="login-text text-center mb-5">Login</h2>
                            @include('web.layouts.flash')

                            <form id="formAuthentication" class="mb-5" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-floating form-floating-outline mb-5 form-control-validation">
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="Enter your email or username" autofocus />
                                    <label for="email">Email or Username</label>
                                </div>
                                <div class="mb-5">
                                    <div class="form-password-toggle form-control-validation">
                                        <div class="input-group input-group-merge">
                                            <div class="form-floating form-floating-outline">
                                                <input type="password" id="password" class="form-control"
                                                    name="password"
                                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                    aria-describedby="password" />
                                                <label for="password">Password</label>
                                            </div>
                                            <span class="input-group-text cursor-pointer"><i
                                                    class="icon-base ri ri-eye-off-line icon-20px"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-5 pb-2 d-flex justify-content-between pt-2 align-items-center">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="checkbox" id="remember-me" />
                                        <label class="form-check-label" for="remember-me"> Remember Me </label>
                                    </div>
                                    <a href="{{route('forgot-password')}}" class="float-end mb-1">
                                        <span>Forgot Password?</span>
                                    </a>
                                </div>
                                <div class="mb-5">
                                    <button class="btn btn-primary d-grid w-100" type="submit">login</button>
                                </div>
                                
                                <div class="mb-3 text-center">
                                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#agentLoginModal">
                                        Request Agent Login
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->

    <!-- Agent Login Request Modal -->
    <div class="modal fade" id="agentLoginModal" tabindex="-1" aria-labelledby="agentLoginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agentLoginModalLabel">Agent Login Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="agentLoginForm">
                        <p>Enter your email to request agent login access:</p>
                        <form id="agentRequestForm">
                            <div class="mb-3">
                                <label for="agentEmail" class="form-label">Email or Username</label>
                                <input type="text" class="form-control" id="agentEmail" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Submit Request</button>
                        </form>
                    </div>
                    <div id="agentLoginStatus" style="display: none;">
                        <div class="text-center">
                            <div class="spinner-border text-primary mb-3" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <h6>Request Submitted</h6>
                            <p>Waiting for admin approval...</p>
                            <p class="text-muted">Request expires in: <span id="countdown"></span></p>
                            <button type="button" class="btn btn-secondary" onclick="cancelRequest()">Cancel Request</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/theme.js -->

    <!-- Core JS -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/@form-validation/popular.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/auto-focus.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/pages-auth.js') }}"></script>
    @vite(['resources/js/agent-login.js'])

</body>

</html>