<x-layouts.app title="Sign Up | Freelance-Job">
    @php
        $hasSignupPost = \Illuminate\Support\Facades\Route::has('signup.store');
        $signupAction = $hasSignupPost ? route('signup.store') : route('sign');
        $signupMethod = $hasSignupPost ? 'POST' : 'GET';
        $selectedJobs = collect(old('jobs', request('jobs', [])))->filter()->values();
        $isTravailleur = old('travailleur') || request()->boolean('travailleur');
        $suggestedJobs = $availableJobs ?? [
            'Laravel backend developer',
            'React landing page',
            'Logo redesign',
            'WordPress website setup',
            'SEO content writer',
        ];
    @endphp

    <div class="login-page signup-page">
        <div class="login-blob login-blob-1"></div>
        <div class="login-blob login-blob-2"></div>

        <div class="login-split-container signup-split-container">
            <div class="login-info-side reveal-left active">
                <div class="info-content">
                    <a href="{{ route('home') }}" class="login-logo-small">
                        Freelance<span>-Job</span>
                    </a>
                    <h2 class="info-title">Create your <span class="text-gold">workspace</span>.</h2>
                    <p class="info-paragraph">
                        Register as a client, or choose the worker option to list the jobs connected to your account.
                    </p>
                    <ul class="info-features">
                        <li><span class="feature-dot"></span> Client and ManJobs accounts</li>
                        <li><span class="feature-dot"></span> Job titles linked to worker profiles</li>
                        <li><span class="feature-dot"></span> Built for Laravel authentication</li>
                    </ul>
                </div>

                <div class="info-footer">
                    <p>Already have an account?</p>
                    <a href="{{ route('login') }}" class="btn-signup-link">
                        Sign in
                    </a>
                </div>
            </div>

            <div class="login-form-side reveal-right active">
                <div class="login-card-compact signup-card">
                    <div class="card-header">
                        <h3 class="login-main-title">Sign Up</h3>
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
                            <strong>Please fix the highlighted fields.</strong>
                            <ul class="mb-0 mt-2 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="login-form signup-form" method="{{ $signupMethod }}" action="{{ $signupAction }}" novalidate>
                        @if ($hasSignupPost)
                            @csrf
                        @endif

                        <div class="form-group">
                            <label for="name">Full name</label>
                            <div class="input-wrapper">
                                <span class="input-icon">U</span>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    placeholder="Your full name"
                                    value="{{ old('name', request('name')) }}"
                                    class="@error('name') is-invalid @enderror"
                                    autocomplete="name"
                                    required
                                />
                            </div>
                            @error('name')
                                <div class="login-error" role="alert">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="signup-email">Email</label>
                            <div class="input-wrapper">
                                <span class="input-icon">@</span>
                                <input
                                    type="email"
                                    id="signup-email"
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
                            <label for="signup-password">Password</label>
                            <div class="input-wrapper">
                                <span class="input-icon">*</span>
                                <input
                                    type="password"
                                    id="signup-password"
                                    name="password"
                                    placeholder="Minimum 8 characters"
                                    class="@error('password') is-invalid @enderror"
                                    autocomplete="new-password"
                                    required
                                />
                            </div>
                            @error('password')
                                <div class="login-error" role="alert">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="confirm-password">Confirm password</label>
                            <div class="input-wrapper">
                                <span class="input-icon">*</span>
                                <input
                                    type="password"
                                    id="confirm-password"
                                    name="password_confirmation"
                                    placeholder="Repeat password"
                                    autocomplete="new-password"
                                    required
                                />
                            </div>
                        </div>

                        <div class="signup-worker-block">
                            <label class="checkbox-container signup-checkbox">
                                <input
                                    type="checkbox"
                                    name="travailleur"
                                    value="1"
                                    @checked($isTravailleur)
                                    class="signup-worker-toggle"
                                />
                                <span class="checkmark"></span>
                                Register as a worker
                            </label>

                            <div class="signup-jobs">
                                <div class="signup-jobs-header">
                                    <span>Jobs to add</span>
                                </div>

                                <div class="signup-suggestions">
                                    @foreach ($suggestedJobs as $job)
                                        <span>{{ $job }}</span>
                                    @endforeach
                                </div>

                                @for ($i = 0; $i < 3; $i++)
                                    <div class="form-group mb-0">
                                        <label for="job-{{ $i + 1 }}">Job {{ $i + 1 }}</label>
                                        <div class="input-wrapper">
                                            <span class="input-icon">#</span>
                                            <input
                                                type="text"
                                                id="job-{{ $i + 1 }}"
                                                name="jobs[]"
                                                placeholder="Example: Plumber"
                                                value="{{ $selectedJobs->get($i) }}"
                                                class="@error('jobs.' . $i) is-invalid @enderror"
                                            />
                                        </div>
                                        @error('jobs.' . $i)
                                            <div class="login-error" role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endfor
                            </div>
                        </div>

                        @if ($errors->has('form'))
                            <div class="login-error" role="alert">{{ $errors->first('form') }}</div>
                        @endif

                        <button type="submit" class="login-submit-btn">Create account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
