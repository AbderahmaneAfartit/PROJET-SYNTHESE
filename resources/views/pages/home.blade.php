<x-layouts.app title="Freelance-Job">
    <main>
        <div class="reveal-zoom active">
            <div id="hero" class="hero-section">
                <video
                    src="{{ asset('assets/video.mp4') }}"
                    autoplay
                    loop
                    muted
                    playsinline
                    class="hero-video"
                ></video>

                <div class="hero-shade"></div>
                <div class="hero-bottom-glow"></div>

                <div class="hero-content">
                    <div class="hero-badge">
                        <span class="hero-badge-dot"></span>
                        Trusted by 50,000+ clients worldwide
                    </div>

                    <h1 class="hero-title">
                        Find the perfect <br />
                        <span class="hero-title-accent">freelance services</span>
                    </h1>

                    <p class="hero-subtitle">
                        Connect with top-tier professionals for any project — fast, reliable, guaranteed.
                    </p>

                    <form class="hero-search-bar" action="{{ route('services') }}" method="GET" id="hero-service-search">
                        <svg class="hero-search-icon" viewBox="0 0 20 20" fill="none">
                            <circle cx="8.5" cy="8.5" r="5.5" stroke="currentColor" stroke-width="1.8"></circle>
                            <path d="M13 13l3.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"></path>
                        </svg>
                        <input
                            type="text"
                            name="q"
                            id="hero-service-search-input"
                            placeholder="What service are you looking for?"
                            class="hero-search-input"
                        />
                        <button class="hero-search-btn" type="submit">Search</button>
                    </form>

                    <div class="hero-pills">
                        <span class="hero-pills-label">Popular:</span>
                        @foreach ($heroCategories as $category)
                            <button
                                type="button"
                                class="hero-pill"
                                data-service-search="{{ $category }}"
                            >
                                {{ $category }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="hero-stats-strip">
                    @foreach ($heroStats as $stat)
                        <div class="hero-stat">
                            <span class="hero-stat-value">{{ $stat['value'] }}</span>
                            <span class="hero-stat-label">{{ $stat['label'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="reveal active" style="transition-delay: 100ms;">
            <section id="services" class="services-section">
                <div class="services-container">
                    <div class="services-header">
                        <span class="services-eyebrow">What You Need</span>
                        <h2 class="services-title">Browse Top Categories</h2>
                        <p class="services-subtitle">
                            From design to development — skilled professionals ready to deliver.
                        </p>
                    </div>

                    <div class="services-grid">
                        @foreach ($services as $service)
                            <a
                                href="{{ route('services', ['category' => $service['filter']]) }}"
                                class="service-card service-category-link"
                            >
                                <div
                                    class="service-icon-wrap"
                                    style="background: {{ $service['color'] }}18; border: 1px solid {{ $service['color'] }}30;"
                                >
                                    <span class="service-icon">{{ $service['icon'] }}</span>
                                </div>
                                <h3 class="service-card-title">{{ $service['title'] }}</h3>
                                <p class="service-card-desc">{{ $service['description'] }}</p>
                                <span class="service-card-count">{{ $service['count'] }}</span>
                                <div
                                    class="service-card-bar"
                                    style="background: linear-gradient(90deg, {{ $service['color'] }}80, transparent);"
                                ></div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>

        <div class="reveal active" style="transition-delay: 150ms;">
            <section
                id="about-preview"
                class="about-preview-section"
                style="padding: 100px 24px; text-align: center; position: relative; z-index: 1;"
            >
                <div style="max-width: 800px; margin: 0 auto;">
                    <span class="services-eyebrow">Our Story</span>
                    <h2 class="services-title">Connecting Talent with Opportunity</h2>
                    <p class="services-subtitle" style="margin-bottom: 30px;">
                        Freelance-Job is more than just a marketplace. We are a bridge between visionaries and creators,
                        helping people build their dreams one project at a time.
                    </p>
                    <a href="{{ route('about') }}" class="login-btn text-decoration-none d-inline-block">
                        Learn More About Us
                    </a>
                </div>
            </section>
        </div>

        <div class="reveal active" style="transition-delay: 200ms;">
            <section id="howitworks" class="hiw-section">
                <div class="hiw-container">
                    <div class="hiw-header">
                        <span class="services-eyebrow">Simple Process</span>
                        <h2 class="services-title">How It Works</h2>
                        <p class="services-subtitle">
                            Get your project done in four easy steps.
                        </p>
                    </div>

                    <div class="hiw-steps">
                        @foreach ($howItWorksSteps as $index => $step)
                            <div class="hiw-step">
                                @if ($index < count($howItWorksSteps) - 1)
                                    <div class="hiw-connector"></div>
                                @endif

                                <div class="hiw-step-inner">
                                    <div class="hiw-number">{{ $step['number'] }}</div>
                                    <div class="hiw-icon-wrap">
                                        <span class="hiw-icon">{{ $step['icon'] }}</span>
                                    </div>
                                    <h3 class="hiw-step-title">{{ $step['title'] }}</h3>
                                    <p class="hiw-step-desc">{{ $step['description'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchForm = document.getElementById('hero-service-search');
            const searchInput = document.getElementById('hero-service-search-input');
            const popularButtons = document.querySelectorAll('[data-service-search]');

            popularButtons.forEach((button) => {
                button.addEventListener('click', () => {
                    searchInput.value = button.dataset.serviceSearch || '';
                    searchForm.requestSubmit();
                });
            });
        });
    </script>
</x-layouts.app>
