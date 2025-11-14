<!doctype html>
<html lang="en" class="layout-wide customizer-hide" dir="ltr" data-skin="default" data-bs-theme="light">
<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="robots" content="noindex" />

    <title>TravelaDesk | Login</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest"> 
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <!-- Icons & Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/iconify-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/form-validation.css') }}" />

    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <style>
    body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, var(--primary), #002b5b);
        min-height: 100vh;
        overflow-x: hidden;
    }

    .login-content {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        overflow: hidden;
    }

    .left-login {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(6px);
        border-right: 1px solid rgba(255, 255, 255, 0.15);
    }

    .right-login {
        background: #fff;
        border-radius: 0 16px 16px 0;
        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.2);
    }

    .form-logins {
        max-width: 420px;
        margin: 0 auto;
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #ddd;
        padding: 0.8rem 1rem;
        box-shadow: none !important;
    }

    .btn-primary {
        background: var(--primary);
        border: none;
        font-weight: 600;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: #004aad;
        transform: translateY(-2px);
    }

    .login-text {
        font-weight: 700;
        color: var(--primary);
    }

    .btn-outline-warning {
        border-radius: 10px;
        font-weight: 500;
    }

    .logo-login img {
        max-width: 180px;
        border-radius: 12px;
    }

    /* Password Input fix */
    .form-password-toggle .input-group {
        border-radius: 10px;
        overflow: hidden;
    }

    .form-password-toggle .input-group .form-control {
        border: 1px solid #ddd !important;
        border-right: none !important;
        box-shadow: none !important;
        padding-right: 3rem !important;
    }

    .form-password-toggle .input-group-text {
        background: transparent !important;
        border: 1px solid #ddd !important;
        border-left: none !important;
        border-radius: 0 10px 10px 0 !important;
        cursor: pointer;
        color: #666;
    }

    .form-password-toggle .input-group-text:hover {
        color: var(--primary);
    }

    /* Match label floating animation to email input */
    .form-floating-outline label {
        color: #666 !important;
    }

    .form-floating-outline .form-control:focus+label,
    .form-floating-outline .form-control:not(:placeholder-shown)+label {
        color: var(--primary) !important;
    }

    /* Agent Login Modal Premium Style */
    .lob-modal-premium .modal-content {
        border-radius: 14px;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
    }

    .lob-modal-premium .modal-header {
        background-color: var(--primary);
        color: #fff;
        border-radius: 14px 14px 0 0;
    }

    .lob-modal-premium .btn-close-white {
        filter: invert(1);
        opacity: 1;
    }

    .lob-modal-premium .modal-body {
        padding: 2rem;
    }
    </style>
</head>

<body>
    <!-- Login Page -->
    <div class="login-content">
        <div class="row m-0 h-100 w-100">
            <!-- Left Side -->
            <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center">
                <div class="left-login text-center p-5">
                    <img src="{{ asset('assets/img/login.png') }}" alt="login" class="img-fluid rounded-3 shadow-sm"
                        style="max-width: 380px;">
                </div>
            </div>

            <!-- Right Side -->
            <div class="col-md-6 pe-0">
                <div class="right-login d-flex align-items-center h-100 p-5">
                    <div class="form-logins w-100">

                        @if ($errors->has('error'))
                        <div class="alert alert-danger rounded-3 shadow-sm">
                            {{ $errors->first('error') }}
                        </div>
                        @endif

                        <div class="text-center mb-4">
                            <div class="logo-login mb-4">
                                <img src="https://traveladesk.com/storage/merchants/p7I9TTbVjUWWQ8bLPfVWrnoGAL7D7HgDs2vryCOl.png"
                                    alt="logo">
                            </div>
                            <h2 class="login-text mb-2">Welcome Back</h2>
                            <p class="text-muted mb-4">Sign in to continue to TravelaDesk</p>
                        </div>

                        @include('web.layouts.flash')

                        <!-- Login Form -->
                        <form id="formAuthentication" method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-floating form-floating-outline ">
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Enter your pseudo" autofocus />
                                <label for="email">Pseudo</label>
                            </div>
                            <div class="form-floating form-floating-outline ">
                                <input type="password" id="password" class="form-control" name="password"
                                    placeholder="Enter your password" aria-describedby="password" />
                                <label for="password">Password</label>

                                <span class="input-group-text cursor-pointer" style="    position: absolute;
    top: 0px;
    right: 0px;
    border: none;" id="togglePassword">
                                    <i class="icon-base ri ri-eye-off-line icon-20px"></i>
                                </span>
                            </div>



                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-me" />
                                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                                </div>
                                <!-- <a href="{{ route('forgot-password') }}" class="text-primary small fw-semibold">
                                    Forgot Password?
                                </a> -->
                            </div>

                            <button
                                class="btn btn-primary w-100 py-2 mb-3 d-flex align-items-center justify-content-center gap-2"
                                type="submit">
                                <i class="ri-login-circle-line"></i>
                                Login
                            </button>

                            <div class="text-center">
                                <button type="button"
                                    class="btn btn-outline-warning w-100 d-flex align-items-center justify-content-center gap-2"
                                    data-bs-toggle="modal" data-bs-target="#agentLoginModal">
                                    <i class="ri-login-circle-line"></i>
                                    Request Agent Login
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Agent Login Request Modal -->
    <div class="modal fade lob-modal-premium" id="agentLoginModal" tabindex="-1" aria-labelledby="agentLoginModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header text-white border-0">
                    <h5 class="modal-title fw-semibold d-flex align-items-center gap-2" id="agentLoginModalLabel">
                        <span class="iconify fs-4" data-icon="mdi:account-key-outline"></span>
                        Agent Login Request
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="agentLoginForm">
                        <p class="text-muted">Enter your email to request agent login access:</p>
                        <form id="agentRequestForm">
                            <!-- <div class="mb-3">
                                <label for="agentEmail" class="form-label">Email or Username</label>
                                <input type="text" class="form-control input-style" id="agentEmail" required>
                            </div> -->
                            <div class="form-floating form-floating-outline ">
                                <input type="text" class="form-control" id="agentEmail"
                                    placeholder="Enter your pseudo" autofocus />
                                <label for="agentEmail">Pseudo</label>
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
                            <button type="button" class="btn btn-secondary" onclick="cancelRequest()">Cancel
                                Request</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core JS -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/pages-auth.js') }}"></script>
    @vite(['resources/js/agent-login.js'])

    <script>
    // Password Toggle (kept exactly same functionality)
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const icon = togglePassword.querySelector('i');

        togglePassword.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            icon.classList.toggle('ri-eye-line');
            icon.classList.toggle('ri-eye-off-line');
        });
    });
    </script>
</body>

</html> 