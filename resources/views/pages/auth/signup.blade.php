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

                    <form class="login-form signup-form" method="POST" action="{{ $signupAction }}" enctype="multipart/form-data" novalidate>
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
                            <label for="contact">Contact</label>
                            <div class="input-wrapper">
                                <span class="input-icon">C</span>
                                <input
                                    type="text"
                                    id="contact"
                                    name="contact"
                                    placeholder="Your contact information"
                                    value="{{ old('contact') }}"
                                    class="@error('contact') is-invalid @enderror"
                                />
                            </div>
                            @error('contact')
                                <div class="login-error" role="alert">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image">Profile Photo</label>
                            <div class="d-flex align-items-center gap-3">
                                <input
                                    type="file"
                                    id="image"
                                    name="image"
                                    class="form-control @error('image') is-invalid @enderror"
                                    accept="image/*"
                                />
                                <div id="image-preview" style="width: 50px; height: 50px; border-radius: 50%; border: 1px solid #ccc; display: none; overflow: hidden;">
                                    <img src="#" alt="Preview" style="width: 100%; height: 100%; object-fit: cover;" />
                                </div>
                            </div>
                            @error('image')
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
                                <div class="form-group mb-0">
                                    <label for="post_id">Select Job Post</label>
                                    <select name="post_id" id="post_id" class="form-control">
                                        <option value="">Select a job post</option>
                                        @foreach ($posts as $post)
                                            <option value="{{ $post->id }}">{{ $post->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('post_id')
                                    <div class="login-error" role="alert">{{ $message }}</div>
                                @enderror

                                <div class="form-group mb-0" style="margin-top: 12px;">
                                    <label for="service_id">Your Service / Domain <span style="color: var(--gold, #c9a84c);">*</span></label>
                                    <select name="service_id" id="service_id" class="form-control @error('service_id') is-invalid @enderror">
                                        <option value="">Select your service...</option>
                                        @foreach (\App\Models\Service::all() as $service)
                                            <option value="{{ $service->id }}" @selected(old('service_id') == $service->id)>
                                                {{ $service->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('service_id')
                                    <div class="login-error" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        @if ($errors->has('form'))
                            <div class="login-error" role="alert">{{ $errors->first('form') }}</div>
                        @endif

                        <button type="submit" class="login-submit-btn">Create account</button>
                    </form>

                    <script>
                        document.getElementById('image').addEventListener('change', function(e) {
                            const preview = document.getElementById('image-preview');
                            const reader = new FileReader();
                            reader.onload = function() {
                                preview.querySelector('img').src = reader.result;
                                preview.style.display = 'block';
                            }
                            reader.readAsDataURL(e.target.files[0]);
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
