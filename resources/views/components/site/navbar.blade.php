@php
    $routeName = request()->route()?->getName();
    $homeUrl = route('home');
@endphp

<nav class="navbar navbar-expand-lg navbar-custom" id="site-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ $homeUrl }}" aria-label="Freelance-Job home">
            <img src="{{ asset('assets/logo1.png') }}" alt="Freelance-Job logo" class="logo-img" />
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#main-nav"
            aria-controls="main-nav"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="main-nav">
            <div class="navbar-nav ms-auto align-items-lg-center nav-wrapper">
                <a href="{{ route('home') }}" class="nav-link-custom {{ $routeName === 'home' ? 'active' : '' }}">
                    Home
                </a>

                <a href="{{ route('services') }}" class="nav-link-custom {{ $routeName === 'services' ? 'active' : '' }} }}">
                    Services
                </a>
                @auth
                <a href="{{ route('posts') }}" class="nav-link-custom {{ $routeName === 'posts' ? 'active' : '' }} }}">
                    Posts
                </a>
                @endauth
                <a href="{{ route('about') }}" class="nav-link-custom {{ $routeName === 'about' ? 'active' : '' }}">
                    About
                </a>

                <a href="{{ route('contact') }}" class="nav-link-custom {{ $routeName === 'contact' ? 'active' : '' }}">
                    Contact
                </a>



                @auth
                    <div class="nav-user-card">
                        @if(auth()->user()->image)
                            <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="{{ auth()->user()->name }}" class="nav-user-avatar" style="width: 34px; height: 34px; border-radius: 50%; object-fit: cover;" />
                        @else
                            <span class="nav-user-avatar" aria-hidden="true">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                        @endif
                        <span class="nav-user-meta">
                            <strong>{{ auth()->user()->name }}</strong>
                            <span>{{ auth()->user()->role }}</span>
                        </span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" aria-label="Logout">x</button>
                        </form>
                    </div>
                @else
                    <div class="d-flex align-items-center gap-2 nav-auth-actions">
                        <a href="{{ route('login') }}" class="login-btn text-decoration-none">
                            Login
                        </a>
                        <a href="{{ route('sign') }}" class="signup-btn text-decoration-none">
                            Sign Up
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
