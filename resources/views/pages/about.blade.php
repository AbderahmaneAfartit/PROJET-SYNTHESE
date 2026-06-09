<x-layouts.app title="About | Freelance-Job">
    <div class="about-page">
        <div class="about-bg-blob about-bg-blob-1"></div>
        <div class="about-bg-blob about-bg-blob-2"></div>

        <section class="about-hero">
            <div class="about-section about-hero-inner is-visible">
                <span class="about-eyebrow">Who We Are</span>
                <h1 class="about-h1">
                    The platform that connects <br />
                    <span class="about-h1-gold">talent with opportunity</span>
                </h1>
                <p class="about-hero-sub">Ana</p>
                <div class="about-hero-cta-row">
                    {{-- <a href="{{ route('sign') }}" class="about-btn-primary text-decoration-none">Get Started Free</a> --}}
                    <a href="#about-process" class="about-btn-ghost text-decoration-none">How It Works ↓</a>
                </div>
            </div>

            <div class="about-section about-professions-grid is-visible" style="transition-delay: 150ms;">
                @foreach ($professions as $index => $profession)
                    <div class="about-profession-card" style="animation-delay: {{ $index * 0.05 }}s">
                        <div class="prof-card-icon">{{ $profession['icon'] }}</div>
                        <h3 class="prof-card-name">{{ $profession['name'] }}</h3>
                        <div class="prof-card-dot"></div>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="about-mission-section">
            <div class="about-section about-mission-grid is-visible">
                <div class="about-mission-left">
                    <span class="about-eyebrow">Our Mission</span>
                    <h2 class="about-h2">
                        Making skilled work <br />accessible to everyone
                    </h2>
                    <p class="about-body-text">
                        We believe that geography, bureaucracy, and lack of connections shouldn't
                        stop talented people from finding great opportunities — or stop clients from
                        getting quality work done.
                    </p>
                    <p class="about-body-text">
                        Freelance-Job was built to dissolve those barriers. From a local plumber
                        fixing your sink to a developer building your app — we make the connection
                        seamless, safe, and fast.
                    </p>
                    <div class="mission-highlight">
                        <span class="mission-quote">"</span>
                        <p>Every skilled professional deserves a stage. Every client deserves the best talent.</p>
                    </div>
                </div>

                <div class="about-mission-right">
                    <div class="mission-visual">
                        <div class="mission-ring mission-ring-outer"></div>
                        <div class="mission-ring mission-ring-mid"></div>
                        <div class="mission-center-node">
                            <span class="mission-center-icon">🌐</span>
                            <span class="mission-center-label">Freelance-Job</span>
                        </div>
                        @foreach (['Client', 'Freelancer', 'Project', 'Payment'] as $index => $label)
                            <div
                                class="mission-orbit-node"
                                style="transform: rotate({{ $index * 90 }}deg) translateY(-80px);"
                            >
                                <div class="orbit-node-inner" style="transform: rotate(-{{ $index * 90 }}deg);">
                                    {{ ['👤', '💼', '📋', '💳'][$index] }}
                                    <span>{{ $label }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="about-stats-section">
            <div class="about-stats-inner">
                @foreach ($stats as $stat)
                    <div class="stat-card">
                        <div class="stat-value">
                            <span>{{ number_format($stat['value']) }}{{ $stat['suffix'] }}</span>
                        </div>
                        <div class="stat-label">{{ $stat['label'] }}</div>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="about-trust-section">
            <div class="about-section is-visible">
                <div class="about-section-head">
                    <span class="about-eyebrow">Why Trust Us</span>
                    <h2 class="about-h2">Built on safety & transparency</h2>
                    <p class="about-section-sub">
                        Six pillars that make Freelance-Job the safest place to hire and get hired.
                    </p>
                </div>
                <div class="trust-grid">
                    @foreach ($trusts as $index => $trust)
                        <div
                            class="trust-card"
                            style="animation-delay: {{ $index * 0.08 }}s; --trust-color: {{ $trust['color'] }};"
                        >
                            <div class="trust-icon-wrap" style="background: {{ $trust['color'] }}18; border: 1px solid {{ $trust['color'] }}30;">
                                <span class="trust-icon">{{ $trust['icon'] }}</span>
                            </div>
                            <h3 class="trust-title">{{ $trust['title'] }}</h3>
                            <p class="trust-desc">{{ $trust['desc'] }}</p>
                            <div class="trust-bar" style="background: linear-gradient(90deg, {{ $trust['color'] }}60, transparent)"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="about-hiw-section" id="about-process">
            <div class="about-section is-visible">
                <div class="about-section-head">
                    <span class="about-eyebrow">The Process</span>
                    <h2 class="about-h2">Four steps to get it done</h2>
                </div>
                <div class="hiw-timeline">
                    @foreach ($steps as $index => $step)
                        <div class="hiw-item">
                            <div class="hiw-num-col">
                                <div class="hiw-num">{{ $step['num'] }}</div>
                                @if ($index < count($steps) - 1)
                                    <div class="hiw-line"></div>
                                @endif
                            </div>
                            <div class="hiw-content">
                                <h3 class="hiw-title">{{ $step['title'] }}</h3>
                                <p class="hiw-desc">{{ $step['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="about-values-section">
            <div class="about-section is-visible">
                <div class="about-section-head">
                    <span class="about-eyebrow">Our Core Values</span>
                    <h2 class="about-h2">What drives us every day</h2>
                </div>
                <div class="values-grid">
                    @foreach ($teamValues as $index => $value)
                        <div class="value-card" style="animation-delay: {{ $index * 0.1 }}s;">
                            <div class="value-icon">{{ $value['icon'] }}</div>
                            <h3 class="value-title">{{ $value['title'] }}</h3>
                            <p class="value-desc">{{ $value['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="about-cta-section">
            <div class="about-section about-cta-inner is-visible">
                <h2 class="about-cta-title">Ready to get started?</h2>
                <p class="about-cta-sub">Join 85,000+ clients who trust Freelance-Job to get quality work done.</p>
                <div class="about-hero-cta-row justify-content-center">
                    <a href="{{ route('sign') }}" class="about-btn-primary text-decoration-none">Post a Job Free</a>
                    <a href="{{ route('providers') }}" class="about-btn-ghost text-decoration-none">Browse Freelancers →</a>
                </div>
            </div>
        </section>
    </div>
</x-layouts.app>
