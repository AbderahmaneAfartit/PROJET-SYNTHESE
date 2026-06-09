<x-layouts.app title="Sign Up | Freelance-Job">
    @php
        $selectedJobs = collect(old('jobs', []))->filter()->values()->all();
        $isTravailleur = old('travailleur');
    @endphp

    <div class="login-page signup-page">
        <div class="login-blob login-blob-1"></div>
        <div class="login-blob login-blob-2"></div>
        <div class="global-grid-overlay" style="opacity: 0.4"></div>

        <div class="login-split-container signup-split-container">
            <div class="reveal-left login-info-side active" data-reveal>
                <div class="info-content">
                    <a href="{{ route('home') }}" class="login-logo-small">
                        Freelance<span>-Job</span>
                    </a>
                    <h2 class="info-title">Create your <span class="text-gold">workspace</span>.</h2>
                    <p class="info-paragraph">
                        Register as a client, or check travailleur to add jobs immediately and become a ManJobs account.
                    </p>
                    <ul class="info-features">
                        <li><span class="feature-dot"></span> Roles: admin, client, ManJobs</li>
                        <li><span class="feature-dot"></span> Jobs linked to the account</li>
                        <li><span class="feature-dot"></span> Laravel powered signup</li>
                    </ul>
                </div>
                <div class="info-footer">
                    <p>Already have an account?</p>
                    <a href="{{ route('login') }}" class="btn-signup-link">
                        Sign in <span>→</span>
                    </a>
                </div>
            </div>

            <div class="reveal-right login-form-side active" data-reveal>
                <div class="login-card-compact signup-card">
                    <div class="card-header">
                        <h3 class="login-main-title">Sign Up</h3>
                    </div>

                    {{-- <form class="login-form" method="POST" action="{{ route('signup.store') }}"> --}}
                        @csrf
                        <div class="form-group">
                            <label for="name">Full name</label>
                            <div class="input-wrapper">
                                <span class="input-icon">U</span>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    placeholder="Your full name"
                                    value="{{ old('name') }}"
                                    required
                                />
                            </div>
                            @error('name')
                                <div class="login-error">{{ $message }}</div>
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
                                    value="{{ old('email') }}"
                                    required
                                />
                            </div>
                            @error('email')
                                <div class="login-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="signup-password">Password</label>
                            <div class="input-wrapper">
                                <span class="input-icon">•</span>
                                <input
                                    type="password"
                                    id="signup-password"
                                    name="password"
                                    placeholder="Minimum 8 characters"
                                    required
                                />
                            </div>
                            @error('password')
                                <div class="login-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="confirm-password">Confirm password</label>
                            <div class="input-wrapper">
                                <span class="input-icon">•</span>
                                <input
                                    type="password"
                                    id="confirm-password"
                                    name="password_confirmation"
                                    placeholder="Repeat password"
                                    required
                                />
                            </div>
                        </div>

                        <label class="checkbox-container signup-checkbox">
                            <input
                                type="checkbox"
                                name="travailleur"
                                value="1"
                                @checked($isTravailleur)
                                data-travailleur-toggle
                            />
                            <span class="checkmark"></span>
                            travailleur
                        </label>

                        <div class="signup-jobs" data-jobs-panel @if (! $isTravailleur) style="display: none;" @endif>
                            <div class="signup-jobs-header">
                                <span>Jobs to add</span>
                            </div>

                            <div class="signup-job-row">
                                {{-- <select data-job-select aria-label="Choose job">
                                    <option value="">Choose a job...</option>
                                    @foreach ($availableJobs as $job)
                                        <option value="{{ $job }}">{{ $job }}</option>
                                    @endforeach
                                    <option value="__custom__">Job not listed</option>
                                </select> --}}
                                <button type="button" data-job-add aria-label="Add job">+</button>
                            </div>

                            <div class="signup-custom-job" data-custom-job-wrap style="display: none;">
                                <input type="text" placeholder="Write the job title" data-custom-job-input />
                            </div>

                            <div class="signup-selected-jobs" data-selected-jobs></div>
                            {{-- <div data-hidden-jobs>
                                @foreach ($selectedJobs as $job)
                                    <input type="hidden" name="jobs[]" value="{{ $job }}">
                                @endforeach
                            </div>

                            @error('jobs.0')
                                <div class="login-error">{{ $message }}</div>
                            @enderror
                        </div> --}}

                        <script type="application/json" id="signup-jobs-data">
                            @json($selectedJobs)
                        </script>

                        @if ($errors->has('form'))
                            <div class="login-error">{{ $errors->first('form') }}</div>
                        @endif

                        <button type="submit" class="login-submit-btn">Create Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
