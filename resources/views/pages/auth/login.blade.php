<x-layouts.app title="Login | Freelance-Job">
    @php
        $hasLoginPost = \Illuminate\Support\Facades\Route::has('login.attempt');
        $loginAction = $hasLoginPost ? route('login.attempt') : route('login');
        $loginMethod = $hasLoginPost ? 'POST' : 'GET';
    @endphp

    <div class="login-page">
        <div class="login-blob login-blob-1"></div>
        <div class="login-blob login-blob-2"></div>

        <div class="login-split-container">
            <div class="login-info-side reveal-left active">
                <div class="info-content">
                    <a href="{{ route('home') }}" class="login-logo-small">
                        Freelance<span>-Job</span>
                    </a>
                    <h2 class="info-title">The future of <span class="text-gold">skilled work</span> is here.</h2>
                    <p class="info-paragraph">
                        Join a trusted network of professionals and clients. Your next project, hire, or opportunity starts here.
                    </p>
                    <ul class="info-features">
                        <li><span class="feature-dot"></span> Secure payments</li>
                        <li><span class="feature-dot"></span> Responsive support</li>
                        <li><span class="feature-dot"></span> Verified professional network</li>
                    </ul>
                </div>

                <div class="info-footer">
                    <p>New to the platform?</p>
                    <a href="{{ route('sign') }}" class="btn-signup-link">
                        Create an account
                    </a>
                </div>
            </div>

            <div class="login-form-side reveal-right active">
                <div class="login-card-compact">
                    <div class="card-header">
                        <h3 class="login-main-title">Login</h3>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                    @endif

                    @if (session('status'))
                        <div class="alert alert-info" role="alert">{{ session('status') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <strong>Please check your login details.</strong>
                            <ul class="mb-0 mt-2 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="login-form" method="{{ $loginMethod }}" action="{{ $loginAction }}" novalidate>
                        @if ($hasLoginPost)
                            @csrf
                        @endif

                        <div class="form-group">
                            <label for="email">Email</label>
                            <div class="input-wrapper">
                                <span class="input-icon">@</span>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    placeholder="you@example.com"
                                    value="{{ old('email', request('email')) }}"
                                    class="@error('email') is-invalid @enderror"
                                    autocomplete="email"
                                    required
                                />
                            </div>
                            @error('email')
                                <div class="login-error" role="alert">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-wrapper">
                                <span class="input-icon">*</span>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="Enter your password"
                                    class="@error('password') is-invalid @enderror"
                                    autocomplete="current-password"
                                    required
                                />
                            </div>
                            @error('password')
                                <div class="login-error" role="alert">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-actions">
                            <label class="checkbox-container">
                                <input type="checkbox" name="remember" value="1" @checked(old('remember') || request()->boolean('remember')) />
                                <span class="checkmark"></span>
                                Remember me
                            </label>
                            <a href="{{ route('contact') }}" class="forgot-link">Need help?</a>
                        </div>

                        <button type="submit" class="login-submit-btn">
                            Sign in
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
