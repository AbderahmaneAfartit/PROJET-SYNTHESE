<x-layouts.app title="Login | Freelance-Job">
    <div class="login-page">
        <div class="login-blob login-blob-1"></div>
        <div class="login-blob login-blob-2"></div>
        <div class="global-grid-overlay" style="opacity: 0.4"></div>

        <div class="login-split-container">
            <div class="reveal-left login-info-side active" data-reveal>
                <div class="info-content">
                    <a href="{{ route('home') }}" class="login-logo-small">
                        Freelance<span>-Job</span>
                    </a>
                    <h2 class="info-title">The future of <span class="text-gold">skilled work</span> is here.</h2>
                    <p class="info-paragraph">
                        Join our exclusive network of elite professionals and visionary clients.
                        Whether you're looking to build your next big project or offer your unique expertise,
                        everything you need is just one login away.
                    </p>
                    <ul class="info-features">
                        <li><span class="feature-dot"></span> Secure Escrow Payments</li>
                        <li><span class="feature-dot"></span> 24/7 Priority Support</li>
                        <li><span class="feature-dot"></span> Verified Professional Network</li>
                    </ul>
                </div>
                <div class="info-footer">
                    <p>New to the platform?</p>
                    <a href="{{ route('sign') }}" class="btn-signup-link">
                        Create an account <span>→</span>
                    </a>
                </div>
            </div>

            <div class="reveal-right login-form-side active" data-reveal>
                <div class="login-card-compact">
                    <div class="card-header">
                        <h3 class="login-main-title">Login</h3>
                    </div>

                    <form class="login-form">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <div class="input-wrapper">
                                <span class="input-icon">@</span>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    placeholder="you@example.com"
                                    value="{{ old('email') }}"
                                    required
                                />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="label-row">
                                <label for="password">Password</label>
                            </div>
                            <div class="input-wrapper">
                                <span class="input-icon">•</span>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="••••••••"
                                    required
                                    data-password-input
                                />
                                <button
                                    type="button"
                                    class="password-toggle"
                                    data-password-toggle
                                    aria-label="Toggle password visibility"
                                >
                                    <span data-password-toggle-icon>👁</span>
                                </button>
                            </div>
                        </div>

                        <div class="form-actions">
                            <label class="checkbox-container">
                                <input type="checkbox" name="remember" value="1" @checked(old('remember')) />
                                <span class="checkmark"></span>
                                Keep me logged in
                            </label>
                            <a href="#" class="forgot-link">Forgot?</a>
                        </div>

                        @if ($errors->has('form'))
                            <div class="login-error" role="alert">
                                {{ $errors->first('form') }}
                            </div>
                        @endif

                        @if ($errors->has('email'))
                            <div class="login-error">{{ $errors->first('email') }}</div>
                        @endif

                        @if ($errors->has('password'))
                            <div class="login-error">{{ $errors->first('password') }}</div>
                        @endif

                        <button type="submit" class="login-submit-btn">
                            Sign In Account
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
