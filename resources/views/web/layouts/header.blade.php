<!DOCTYPE html>
<html lang="en" class="layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-skin="default"
    data-assets-path="./assets/" data-template="horizontal-menu-template" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="robots" content="noindex" />
    <meta name="csrf-token" content="{{csrf_token()}}" />
    <title>Booking Management System</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest"> 
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/iconify-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <style>
    :root {
        --primaryColor: #1c316d;
        --primaryLight: #3a4ca4;
        --accentColor: #3dc7ff;
        --textDark: #2c3e50;
        --textLight: #6c757d;
        --borderLight: #e9ecef;
        --bgLight: #f8f9fa;
        --successColor: #28a745;
        --warningColor: #ffc107;
        --dangerColor: #dc3545;
    }

    #loader-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(28, 49, 109, 0.95);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .loader__container {
        display: flex;
        flex-direction: column;
        align-items: center;
        perspective: 1000px;
    }

    .loader__cube {
        width: 60px;
        height: 60px;
        position: relative;
        transform-style: preserve-3d;
        animation: cube-rotate 2s infinite ease-in-out;
        margin-bottom: 24px;
    }

    .loader__cube-face {
        position: absolute;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, var(--primaryColor), var(--primaryLight));
        border: 2px solid rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        font-weight: bold;
        color: white;
        opacity: 0.9;
    }

    .loader__cube-face--front {
        transform: translateZ(30px);
    }

    .loader__cube-face--back {
        transform: rotateY(180deg) translateZ(30px);
    }

    .loader__cube-face--right {
        transform: rotateY(90deg) translateZ(30px);
    }

    .loader__cube-face--left {
        transform: rotateY(-90deg) translateZ(30px);
    }

    .loader__cube-face--top {
        transform: rotateX(90deg) translateZ(30px);
    }

    .loader__cube-face--bottom {
        transform: rotateX(-90deg) translateZ(30px);
    }

    .loader__text {
        color: white;
        font-size: 1.2rem;
        font-weight: 600;
        letter-spacing: 1px;
        text-align: center;
    }

    .loader__progress {
        width: 200px;
        height: 4px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 4px;
        margin-top: 16px;
        overflow: hidden;
    }

    .loader__progress-bar {
        height: 100%;
        width: 0%;
        background: var(--accentColor);
        border-radius: 4px;
        animation: progress-load 2s infinite ease-in-out;
    }

    @keyframes cube-rotate {

        0%,
        100% {
            transform: rotateX(0) rotateY(0);
        }

        25% {
            transform: rotateX(30deg) rotateY(45deg);
        }

        50% {
            transform: rotateX(60deg) rotateY(90deg);
        }

        75% {
            transform: rotateX(30deg) rotateY(135deg);
        }
    }

    @keyframes progress-load {
        0% {
            width: 0%;
        }

        50% {
            width: 70%;
        }

        100% {
            width: 100%;
        }
    }

    /* Header */
    .headerModern {
        background: #ffffff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        border-bottom: 1px solid var(--borderLight);
        font-family: 'Inter', sans-serif;
        position: relative;
        z-index: 1000;
    }

    .headerModern__container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 1rem;
        max-width: 100%;
        margin: 0 auto;
    }

    .headerModern__brand {
        display: flex;
        align-items: center;
        padding: 0.5rem 0;
        flex-shrink: 0;
    }

    .headerModern__brandLink {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: var(--primaryColor);
        font-weight: 600;
        font-size: 1.25rem;
    }

    .headerModern__brandIcon {
        background: var(--primaryColor);
        color: white;
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
        font-size: 1.2rem;
    }

    .headerModern__greeting {
        font-weight: 500;
        color: var(--textDark);
        margin-left: 12px;
        font-size: 1rem;
    }

    .headerModern__nav {
        display: flex;
        align-items: center;
        flex-grow: 1;
        justify-content: center;
        overflow: visible;
    }

    .headerModern__navList {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
        gap: 0.25rem;
    }

    .headerModern__navItem {
        position: relative;
    }

    .headerModern__navLink {
        display: flex;
        align-items: center;
        padding: 0.6rem 0.8rem;
        border-radius: 6px;
        color: var(--textDark);
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        white-space: nowrap;
        position: relative;
        overflow: hidden;
    }

    .headerModern__navLink::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(28, 49, 109, 0.1), transparent);
        transition: left 0.5s ease;
    }

    .headerModern__navLink:hover::before {
        left: 100%;
    }

    .headerModern__navLink:hover {
        background-color: var(--bgLight);
        color: var(--primaryColor);
        transform: translateY(-1px);
    }

    .headerModern__navLink--active {
        background-color: rgba(28, 49, 109, 0.1);
        color: var(--primaryColor);
    }

    .headerModern__navLink--active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 20px;
        height: 3px;
        background: var(--primaryColor);
        border-radius: 3px 3px 0 0;
    }

    .headerModern__navIcon {
        margin-right: 6px;
        font-size: 1.1rem;
        color: var(--textLight);
        transition: all 0.3s ease;
        width: 18px;
        text-align: center;
    }

    .headerModern__navLink:hover .headerModern__navIcon,
    .headerModern__navLink--active .headerModern__navIcon {
        color: var(--primaryColor);
        transform: scale(1.1);
    }

    .headerModern__dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        min-width: 200px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        padding: 0.4rem 0;
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid var(--borderLight);
    }

    .headerModern__navItem:hover .headerModern__dropdown {
        opacity: 1;
        visibility: visible;
        transform: translateY(5px);
    }

    .headerModern__dropdownItem {
        margin: 0;
    }

    .headerModern__dropdownLink {
        display: flex;
        align-items: center;
        padding: 0.6rem 1rem;
        color: var(--textDark);
        text-decoration: none;
        transition: all 0.2s ease;
        font-size: 0.85rem;
        position: relative;
        overflow: hidden;
    }

    .headerModern__dropdownLink::before {
        content: '';
        position: absolute;
        left: -100%;
        top: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(28, 49, 109, 0.05), transparent);
        transition: left 0.4s ease;
    }

    .headerModern__dropdownLink:hover::before {
        left: 100%;
    }

    .headerModern__dropdownLink:hover {
        background-color: var(--bgLight);
        color: var(--primaryColor);
        padding-left: 1.2rem;
    }

    .headerModern__dropdownLink--active {
        background-color: rgba(28, 49, 109, 0.08);
        color: var(--primaryColor);
    }

    .headerModern__dropdownIcon {
        margin-right: 8px;
        font-size: 1rem;
        color: var(--textLight);
        width: 16px;
        text-align: center;
        transition: all 0.2s ease;
    }

    .headerModern__dropdownLink:hover .headerModern__dropdownIcon {
        color: var(--primaryColor);
        transform: translateX(2px);
    }

    .headerModern__actions {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-shrink: 0;
    }

    .headerModern__notification {
        position: relative;
    }

    .headerModern__notificationBtn {
        background: none;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--textDark);
        transition: all 0.3s ease;
        position: relative;
        cursor: pointer;
    }

    .headerModern__notificationBtn:hover {
        background-color: var(--bgLight);
        color: var(--primaryColor);
        transform: translateY(-1px);
    }

    .headerModern__notificationBadge {
        position: absolute;
        top: 6px;
        right: 6px;
        width: 8px;
        height: 8px;
        background: var(--dangerColor);
        border-radius: 50%;
        border: 2px solid white;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
            opacity: 1;
        }

        50% {
            transform: scale(1.2);
            opacity: 0.7;
        }

        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    .headerModern__notificationDropdown {
        position: absolute;
        top: 100%;
        right: 0;
        width: 320px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        z-index: 1000;
        margin-top: 8px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid var(--borderLight);
    }

    .headerModern__notification:hover .headerModern__notificationDropdown {
        opacity: 1;
        visibility: visible;
        transform: translateY(5px);
    }

    .headerModern__notificationHeader {
        padding: 1rem;
        border-bottom: 1px solid var(--borderLight);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .headerModern__notificationTitle {
        font-weight: 600;
        color: var(--textDark);
        margin: 0;
    }

    .headerModern__notificationBadgeCount {
        background: var(--primaryColor);
        color: white;
        padding: 0.25rem 0.5rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .headerModern__notificationList {
        max-height: 300px;
        overflow-y: auto;
        padding: 0.5rem 0;
    }

    .headerModern__notificationItem {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid var(--borderLight);
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .headerModern__notificationItem:hover {
        background-color: var(--bgLight);
    }

    .headerModern__notificationItem:last-child {
        border-bottom: none;
    }

    .headerModern__notificationText {
        font-size: 0.85rem;
        color: var(--textDark);
        margin-bottom: 0.25rem;
    }

    .headerModern__notificationTime {
        font-size: 0.75rem;
        color: var(--textLight);
    }

    .headerModern__user {
        position: relative;
    }

    .headerModern__userBtn {
        display: flex;
        align-items: center;
        background: none;
        border: none;
        padding: 0.5rem;
        border-radius: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .headerModern__userBtn:hover {
        background-color: var(--bgLight);
        transform: translateY(-1px);
    }

    .headerModern__userAvatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: var(--primaryColor);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .headerModern__userBtn:hover .headerModern__userAvatar {
        transform: scale(1.05);
    }

    .headerModern__userMenu {
        position: absolute;
        top: 100%;
        right: 0;
        min-width: 200px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        padding: 1rem;
        z-index: 1000;
        margin-top: 8px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid var(--borderLight);
    }

    .headerModern__user:hover .headerModern__userMenu {
        opacity: 1;
        visibility: visible;
        transform: translateY(5px);
    }

    .headerModern__userName {
        font-weight: 600;
        color: var(--primaryColor);
        font-size: 0.95rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid var(--borderLight);
        margin-bottom: 0.75rem;
    }

    .headerModern__userItem {
        margin-bottom: 0.4rem;
    }

    .headerModern__userLink {
        display: flex;
        align-items: center;
        padding: 0.6rem 0.5rem;
        color: var(--textDark);
        text-decoration: none;
        border-radius: 6px;
        transition: all 0.2s ease;
        font-size: 0.9rem;
    }

    .headerModern__userLink:hover {
        background-color: var(--bgLight);
        color: var(--primaryColor);
        padding-left: 0.75rem;
    }

    .headerModern__userIcon {
        margin-right: 8px;
        font-size: 1rem;
        width: 16px;
        text-align: center;
    }

    .headerModern__logoutBtn {
        width: 100%;
        background: var(--primaryColor);
        color: white;
        border: none;
        border-radius: 6px;
        padding: 0.75rem;
        font-weight: 500;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 0.5rem;
        cursor: pointer;
    }

    .headerModern__logoutBtn:hover {
        background: var(--primaryLight);
        color: white;
        transform: translateY(-1px);
    }

    .headerModern__logoutIcon {
        margin-left: 6px;
    }

    /* Mobile menu toggle */
    .headerModern__menuToggle {
        display: none;
        background: none;
        border: none;
        font-size: 1.5rem;
        color: var(--textDark);
        padding: 0.5rem;
        cursor: pointer;
    }

    /* Responsive styles */
    @media (max-width: 1199.98px) {
        .headerModern__navList {
            gap: 0.15rem;
        }

        .headerModern__navLink {
            padding: 0.5rem 0.6rem;
            font-size: 0.85rem;
        }

        .headerModern__navIcon {
            margin-right: 4px;
            font-size: 1rem;
        }
    }

    @media (max-width: 991.98px) {
        .headerModern__container {
            flex-wrap: wrap;
            position: relative;
        }

        .headerModern__nav {
            order: 3;
            width: 100%;
            margin-top: 1rem;
            justify-content: flex-start;
            overflow-x: auto;
            display: none;
        }

        .headerModern__nav--open {
            display: flex;
        }

        .headerModern__menuToggle {
            display: block;
        }

        .headerModern__brand {
            flex-grow: 1;
        }

        .headerModern__notificationDropdown {
            right: -50px;
        }

        .headerModern__userMenu {
            right: -20px;
        }
    }

    @media (max-width: 767.98px) {
        .headerModern__greeting {
            display: none;
        }

        .headerModern__notificationDropdown {
            width: 280px;
            right: -80px;
        }
    }

    /* Fix for layout shifting */
    body {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }

    .layout-page {
        width: 100%;
        margin: 0;
        padding: 0;
    }

    .content-wrapper {
        width: 100%;
        margin: 0;
        padding: 0;
    }



    /* ===== Mega Menu Layout (TravelaDesk Header) ===== */
    .headerModern__megaMenu {
        position: absolute;
        top: 100%;
        left: 0;
        width: 500px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        display: flex;
        justify-content: space-between;
        padding: 1rem 1.5rem;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid var(--borderLight);
        z-index: 1000;
    }

    .headerModern__navItem:hover .headerModern__megaMenu {
        opacity: 1;
        visibility: visible;
        transform: translateY(5px);
    }

    .headerModern__megaColumn {
        display: flex;
        flex-direction: column;
        gap: 0.2rem;
        width: 48%;
    }

    .headerModern__megaColumn .headerModern__dropdownItem {
        margin: 0;
    }

    .headerModern__megaColumn .headerModern__dropdownLink {
        padding: 0.55rem 0.75rem;
        border-radius: 6px;
        transition: all 0.2s ease;
    }
    </style>
    @routes
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
    // Set user role and department for admin notifications
    window.userRole = '{{ Auth::user()->role ?? "" }}';
    window.userDepartment = '{{ Auth::user()->departments ?? "" }}';

    // Mobile menu functionality
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.querySelector('.headerModern__menuToggle');
        const nav = document.querySelector('.headerModern__nav');

        if (menuToggle && nav) {
            menuToggle.addEventListener('click', function() {
                nav.classList.toggle('headerModern__nav--open');
            });
        }

        // Hide loader when page is fully loaded
        window.addEventListener('load', function() {
            setTimeout(function() {
                const loader = document.getElementById('loader-overlay');
                if (loader) {
                    loader.style.display = 'none';
                }
            }, 1500);
        });
    });
    </script>
    @yield('head')
</head>

<body>
    <!--  Loader -->
    <div id="loader-overlay">
        <div class="loader__container">
            <div class="loader__cube">
                <div class="loader__cube-face loader__cube-face--front">B</div>
                <div class="loader__cube-face loader__cube-face--back">M</div>
                <div class="loader__cube-face loader__cube-face--right">S</div>
                <div class="loader__cube-face loader__cube-face--left"></div>
                <div class="loader__cube-face loader__cube-face--top"></div>
                <div class="loader__cube-face loader__cube-face--bottom"></div>
            </div>
            <div class="loader__text">Loading Booking System</div>
            <div class="loader__progress">
                <div class="loader__progress-bar"></div>
            </div>
        </div>
    </div>

    <!--  Header -->
    <header class="headerModern container-xxl">
        <div class="headerModern__container">
            <!-- Brand Section -->
            <div class="headerModern__brand">
                <a href="{{ auth()->user()->role_id == 3 && auth()->user()->department_id == 1 ? route('admin.dashboard') : (auth()->user()->role_id == 2 && auth()->user()->department_id == 2 ? route('admin.teamleader-dashboard') : route('user.dashboard')) }}"
                    class="headerModern__brandLink">
                    <div class="headerModern__brandIcon">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <span class="headerModern__greeting">Hi, {{ Auth::user()->pseudo }}</span>
                </a>
            </div>

            <!-- Mobile Menu Toggle -->
            <button class="headerModern__menuToggle">
                <i class="bi bi-list"></i>
            </button>

            <!-- Navigation -->
            <nav class="headerModern__nav">
                <ul class="headerModern__navList">
                    <!-- Masters Menu -->
                    @if(Auth::user()->department_id == 1)
                    <li
                        class="headerModern__navItem {{ Str::startsWith(Route::currentRouteName(), ['teams', 'emails', 'campaign', 'call-types']) ? 'headerModern__navLink--active' : '' }}">
                        <a href="javascript:void(0)" class="headerModern__navLink">
                            <i class="headerModern__navIcon bi bi-gear-fill"></i>
                            <span>Masters</span>
                        </a>

                        <!-- Mega Menu -->
                        <div class="headerModern__megaMenu">
                            <div class="headerModern__megaColumn">
                                <div
                                    class="headerModern__dropdownItem {{ Route::currentRouteName() == 'lob.index' ? 'headerModern__dropdownLink--active' : '' }}">
                                    <a href="{{ route('lobs.index') }}" class="headerModern__dropdownLink">
                                        <i class="headerModern__dropdownIcon bi bi-telephone"></i>
                                        <span>LOB</span>
                                    </a>
                                </div>

                                <!-- <div
                                    class="headerModern__dropdownItem {{ Route::currentRouteName() == 'teams.index' ? 'headerModern__dropdownLink--active' : '' }}">
                                    <a href="{{ route('teams.index') }}" class="headerModern__dropdownLink">
                                        <i class="headerModern__dropdownIcon bi bi-people-fill"></i>
                                        <span>Teams</span>
                                    </a>
                                </div> -->

                                <div
                                    class="headerModern__dropdownItem {{ Route::currentRouteName() == 'departments.index' ? 'headerModern__dropdownLink--active' : '' }}">
                                    <a href="{{ route('departments.index') }}" class="headerModern__dropdownLink">
                                        <i class="headerModern__dropdownIcon bi bi-building"></i>
                                        <span>Departments</span>
                                    </a>
                                </div>

                                <div
                                    class="headerModern__dropdownItem {{ Route::currentRouteName() == 'roles.index' ? 'headerModern__dropdownLink--active' : '' }}">
                                    <a href="{{ route('roles.index') }}" class="headerModern__dropdownLink">
                                        <i class="headerModern__dropdownIcon bi bi-person-badge"></i>
                                        <span>Roles</span>
                                    </a>
                                </div>

                                <div
                                    class="headerModern__dropdownItem {{ Route::currentRouteName() == 'campaign.index' ? 'headerModern__dropdownLink--active' : '' }}">
                                    <a href="{{ route('campaign.index') }}" class="headerModern__dropdownLink">
                                        <i class="headerModern__dropdownIcon bi bi-megaphone"></i>
                                        <span>Campaign</span>
                                    </a>
                                </div>
                                <div
                                    class="headerModern__dropdownItem {{ Route::currentRouteName() == 'merchants.index' ? 'headerModern__dropdownLink--active' : '' }}">
                                    <a href="{{ route('merchants.index') }}" class="headerModern__dropdownLink">
                                        <i class="headerModern__dropdownIcon bi bi-shop"></i>
                                        <span>Merchants</span>
                                    </a>

                                </div>

                                <div
                                    class="headerModern__dropdownItem {{ Route::currentRouteName() == 'airlines.index' ? 'headerModern__dropdownLink--active' : '' }}">
                                    <a href="{{ route('airlines.index') }}" class="headerModern__dropdownLink">
                                        <i class="headerModern__dropdownIcon bi bi-airplane"></i>
                                        <span>Airlines</span>
                                    </a>
                                </div>


                            </div>

                            <div class="headerModern__megaColumn">
                                <div
                                    class="headerModern__dropdownItem {{ Route::currentRouteName() == 'call-types.index' ? 'headerModern__dropdownLink--active' : '' }}">
                                    <a href="{{ route('call-types.index') }}" class="headerModern__dropdownLink">
                                        <i class="headerModern__dropdownIcon bi bi-telephone-outbound"></i>
                                        <span>Call Type</span>
                                    </a>
                                </div>

                                <div
                                    class="headerModern__dropdownItem {{ Route::currentRouteName() == 'booking-status.index' ? 'headerModern__dropdownLink--active' : '' }}">
                                    <a href="{{ route('booking-status.index') }}" class="headerModern__dropdownLink">
                                        <i class="headerModern__dropdownIcon bi bi-calendar-check"></i>
                                        <span>Booking Status</span>
                                    </a>
                                </div>

                                <div
                                    class="headerModern__dropdownItem {{ Route::currentRouteName() == 'payment-status.index' ? 'headerModern__dropdownLink--active' : '' }}">
                                    <a href="{{ route('payment-status.index') }}" class="headerModern__dropdownLink">
                                        <i class="headerModern__dropdownIcon bi bi-currency-dollar"></i>
                                        <span>Payment Status</span>
                                    </a>
                                </div>

                                <!-- <div
                                    class="headerModern__dropdownItem {{ Route::currentRouteName() == 'quality-feedback.index' ? 'headerModern__dropdownLink--active' : '' }}">
                                    <a href="{{ route('quality-feedback.index') }}" class="headerModern__dropdownLink">
                                        <i class="headerModern__dropdownIcon bi bi-chat-square-text"></i>
                                        <span>Quality Feedback</span>
                                    </a>
                                </div> -->

                                <div
                                    class="headerModern__dropdownItem {{ Route::currentRouteName() == 'emails.index' ? 'headerModern__dropdownLink--active' : '' }}">
                                    <a href="{{ route('emails.index') }}" class="headerModern__dropdownLink">
                                        <i class="headerModern__dropdownIcon bi bi-envelope"></i>
                                        <span>Emails</span>
                                    </a>
                                </div>




                                <div
                                    class="headerModern__dropdownItem {{ Route::currentRouteName() == 'allowed-ips.index' ? 'headerModern__dropdownLink--active' : '' }}">
                                    <a href="{{ route('allowed-ips.index') }}" class="headerModern__dropdownLink">
                                        <i class="headerModern__dropdownIcon bi bi-hdd-network"></i>
                                        <span>IP Access</span>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </li>

                    @endif

                    <!-- Reports Menu -->
                    <li
                        class="headerModern__navItem {{ Str::startsWith(Route::currentRouteName(), ['marketing', 'call_queue', 'agents', 'score']) ? 'headerModern__navLink--active' : '' }}">
                        <a href="javascript:void(0)" class="headerModern__navLink">
                            <i class="headerModern__navIcon bi bi-graph-up"></i>
                            <span>Analytics</span>
                        </a>
                        <div class="headerModern__dropdown">
                            <div
                                class="headerModern__dropdownItem {{ Route::currentRouteName() == 'score.details' ? 'headerModern__dropdownLink--active' : '' }}">
                                <a href="{{ route('score.details') }}" class="headerModern__dropdownLink">
                                    <i class="headerModern__dropdownIcon bi bi-star-fill"></i>
                                    <span>My Score</span>
                                </a>
                            </div>
                            <div
                                class="headerModern__dropdownItem {{ Route::currentRouteName() == 'reports.campaign-calls' ? 'headerModern__dropdownLink--active' : '' }}">
                                <a href="{{ route('reports.campaign-calls') }}" class="headerModern__dropdownLink">
                                    <i class="headerModern__dropdownIcon bi bi-telephone"></i>
                                    <span>Campaign Calls</span>
                                </a>
                            </div>
                            <div
                                class="headerModern__dropdownItem {{ Route::currentRouteName() == 'reports.revenue' ? 'headerModern__dropdownLink--active' : '' }}">
                                <a href="{{ route('reports.revenue') }}" class="headerModern__dropdownLink">
                                    <i class="headerModern__dropdownIcon bi bi-cash-coin"></i>
                                    <span>Revenue Report</span>
                                </a>
                            </div>
                            <div
                                class="headerModern__dropdownItem {{ Route::currentRouteName() == 'reports.team' ? 'headerModern__dropdownLink--active' : '' }}">
                                <a href="{{ route('reports.team') }}" class="headerModern__dropdownLink">
                                    <i class="headerModern__dropdownIcon bi bi-people"></i>
                                    <span>Team Reports</span>
                                </a>
                            </div>
                            <div
                                class="headerModern__dropdownItem {{ Route::currentRouteName() == 'reports.unit' ? 'headerModern__dropdownLink--active' : '' }}">
                                <a href="{{ route('reports.unit') }}" class="headerModern__dropdownLink">
                                    <i class="headerModern__dropdownIcon bi bi-building"></i>
                                    <span>Unit Reports</span>
                                </a>
                            </div>
                            <div
                                class="headerModern__dropdownItem {{ Route::currentRouteName() == 'reports.company' ? 'headerModern__dropdownLink--active' : '' }}">
                                <a href="{{ route('reports.company') }}" class="headerModern__dropdownLink">
                                    <i class="headerModern__dropdownIcon bi bi-building-fill"></i>
                                    <span>Company Reports</span>
                                </a>
                            </div>
                        </div>
                    </li>

                    <!-- Booking Menu -->
                    <li
                        class="headerModern__navItem {{ Str::startsWith(Route::currentRouteName(), ['booking']) ? 'headerModern__navLink--active' : '' }}">
                        <a href="javascript:void(0)" class="headerModern__navLink">
                            <i class="headerModern__navIcon bi bi-calendar-event"></i>
                            <span>Booking</span>
                        </a>
                        <div class="headerModern__dropdown">
                            <div
                                class="headerModern__dropdownItem {{ Route::currentRouteName() == 'booking.index' ? 'headerModern__dropdownLink--active' : '' }}">
                                <a href="{{ route('booking.index') }}" class="headerModern__dropdownLink">
                                    <i class="headerModern__dropdownIcon bi bi-calendar"></i>
                                    <span>Booking</span>
                                </a>
                            </div>
                            <div
                                class="headerModern__dropdownItem {{ Route::currentRouteName() == 'booking.search' ? 'headerModern__dropdownLink--active' : '' }}">
                                <a href="{{ route('booking.search') }}" class="headerModern__dropdownLink">
                                    <i class="headerModern__dropdownIcon bi bi-search"></i>
                                    <span>Find Booking</span>
                                </a>
                            </div>
                            <div
                                class="headerModern__dropdownItem {{ Route::currentRouteName() == 'booking.online-booking.index' ? 'headerModern__dropdownLink--active' : '' }}">
                                <a href="{{ route('booking.online-booking.index') }}"
                                    class="headerModern__dropdownLink">
                                    <i class="headerModern__dropdownIcon bi bi-globe"></i>
                                    <span>Online Booking</span>
                                </a>
                            </div>
                        </div>
                    </li>

                    <!-- Call Logs -->
                    <li
                        class="headerModern__navItem {{ Str::startsWith(Route::currentRouteName(), 'call-logs') ? 'headerModern__navLink--active' : '' }}">
                        <a href="{{ route('call-logs.index') }}" class="headerModern__navLink">
                            <i class="headerModern__navIcon bi bi-clock-history"></i>
                            <span>Call Logs</span>
                        </a>
                    </li>

                    <!-- Follow Up -->
                    <li
                        class="headerModern__navItem {{ Str::startsWith(Route::currentRouteName(), 'follow-up') ? 'headerModern__navLink--active' : '' }}">
                        <a href="{{ route('follow-up.index') }}" class="headerModern__navLink">
                            <i class="headerModern__navIcon bi bi-arrow-repeat"></i>
                            <span>Follow Up</span>
                        </a>
                    </li>

                    <!-- Users -->
                    @if(Auth::user()->department_id == 1)
                    <li
                        class="headerModern__navItem {{ Str::startsWith(Route::currentRouteName(), 'users') ? 'headerModern__navLink--active' : '' }}">
                        <a href="{{ route('users') }}" class="headerModern__navLink">
                            <i class="headerModern__navIcon bi bi-people-fill"></i>
                            <span>Users</span>
                        </a>
                    </li>
                    @endif


                </ul>
            </nav>

            <!-- Actions Section -->
            <div class="headerModern__actions">
                <!-- Notifications -->
                <div class="headerModern__notification">
                    <button class="headerModern__notificationBtn">
                        <i class="bi bi-bell"></i>
                        <span class="headerModern__notificationBadge"></span>
                    </button>
                    <div class="headerModern__notificationDropdown">
                        <div class="headerModern__notificationHeader">
                            <h6 class="headerModern__notificationTitle">Notifications</h6>
                            <span class="headerModern__notificationBadgeCount">8 New</span>
                        </div>
                        <div class="headerModern__notificationList">
                            <div class="headerModern__notificationItem">
                                <div class="headerModern__notificationText">
                                    <strong>New booking received</strong> from John Doe
                                </div>
                                <div class="headerModern__notificationTime">2 minutes ago</div>
                            </div>
                            <div class="headerModern__notificationItem">
                                <div class="headerModern__notificationText">
                                    <strong>Payment completed</strong> for booking #12345
                                </div>
                                <div class="headerModern__notificationTime">1 hour ago</div>
                            </div>
                            <div class="headerModern__notificationItem">
                                <div class="headerModern__notificationText">
                                    <strong>New user registered</strong> - Sarah Johnson
                                </div>
                                <div class="headerModern__notificationTime">3 hours ago</div>
                            </div>
                            <div class="headerModern__notificationItem">
                                <div class="headerModern__notificationText">
                                    <strong>System backup</strong> completed successfully
                                </div>
                                <div class="headerModern__notificationTime">5 hours ago</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Menu -->
                <div class="headerModern__user">
                    <button class="headerModern__userBtn">
                        <div class="headerModern__userAvatar">
                            @php
                            $name = Auth::check() ? Auth::user()->pseudo : '';
                            $initials = collect(explode(' ', $name))->map(fn($word) => strtoupper(substr(
                            $word,
                            0,
                            1
                            )))->join('');
                            @endphp
                            {{ $initials }}
                        </div>
                    </button>
                    <div class="headerModern__userMenu">
                        <div class="headerModern__userName">Hi, {{ Auth::user()->pseudo }}</div>
                        <div class="headerModern__userItem">
                            <a href="{{ route('profile') }}" class="headerModern__userLink">
                                <i class="headerModern__userIcon bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </div>
                        <div class="headerModern__userItem">
                            <a href="{{ route('settings') }}" class="headerModern__userLink">
                                <i class="headerModern__userIcon bi bi-gear"></i>
                                <span>Settings</span>
                            </a>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <button class="headerModern__logoutBtn"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span>Logout</span>
                            <i class="headerModern__logoutIcon bi bi-box-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Layout container -->
    <div class="layout-page">
        <div class="content-wrapper">
            <!-- Your page content here -->
        </div>
    </div>