@php
    $routeName = request()->route()?->getName();
    $homeUrl = route('home');
@endphp

<nav class="navbar navbar-expand-lg navbar-custom" id="site-navbar">
    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand" href="{{ $homeUrl }}">
            <img src="{{ asset('assets/logo1.png') }}" alt="Freelance-Job logo" class="logo-img" />
        </a>

        <!-- TOGGLER (FIXED) -->
        <button
            class="navbar-toggler bg-warning"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#main-nav"
            aria-controls="main-nav"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- MENU -->
        <div >

            <div class="nav ms-auto align-items-center nav-wrapper">
                <nav >

                
                <a href="{{ route('home')}}"
                   class="nav-link-custom {{ $routeName === 'home' ? 'active' : '' }}">
                    Home
                </a>

                <a href="{{ request()->routeIs('home') ? '#services' : $homeUrl . '#services' }}"
                   class="nav-link-custom">
                    Services
                </a>

                <a href="{{ route('about') }}"
                   class="nav-link-custom {{ $routeName === 'about' ? 'active' : '' }}">
                    About
                </a>

                <a href="{{ request()->routeIs('home') ? '#howitworks' : route('contact') }}"
                   class="nav-link-custom {{ $routeName === 'contact' ? 'active' : '' }}">
                    Contact
                </a>
                </nav>
                <!-- Search -->
                <div class="search-container">
                    <input type="text" placeholder="Search services..." class="search-input">
                </div>

                <!-- Theme -->
                <button id="theme-toggle-btn" class="theme-toggle-btn" type="button" title="Switch Theme">
                    <span class="theme-toggle-track">
                        <span class="theme-toggle-thumb" data-theme-thumb>🌙</span>
                    </span>
                    <span class="theme-toggle-label" data-theme-label>Dark</span>
                </button>

                <!-- AUTH -->

                    <div class="nav-user-card">
                    </div>
                    <a href="{{ route('login') }}" class="login-btn">
                        Login
                    </a>

            </div>
        </div>
    </div>
</nav>