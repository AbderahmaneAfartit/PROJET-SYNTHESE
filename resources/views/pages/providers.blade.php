<x-layouts.app title="Providers | Freelance-Job">
    <main class="contact-page">
        <section class="services-section">
            <div class="services-container">
                <div class="services-header">
                    <span class="services-eyebrow">Artisans</span>
                    <h1 class="services-title">Providers</h1>
                    <p class="services-subtitle">
                        Discover registered ManJobs providers and the services linked to their accounts.
                    </p>
                </div>

                <div class="services-grid">
                    @forelse ($providers as $provider)
                        <div class="service-card">
                            <div class="service-icon-wrap" style="background: #10b98118; border: 1px solid #10b98130;">
                                <span class="service-icon">👤</span>
                            </div>
                            <h3 class="service-card-title">{{ $provider->name }}</h3>
                            <p class="service-card-desc">{{ $provider->email }}</p>
                            <span class="service-card-count">{{ $provider->role }}</span>
                            @if ($provider->clientJobs->isNotEmpty())
                                <div style="margin-top: 18px; display: flex; flex-wrap: wrap; gap: 8px;">
                                    @foreach ($provider->clientJobs as $job)
                                        <span class="hero-pill">{{ $job->title }}</span>
                                    @endforeach
                                </div>
                            @endif
                            <div class="service-card-bar" style="opacity: 1;"></div>
                        </div>
                    @empty
                        <div class="service-card">
                            <h3 class="service-card-title">No providers available yet</h3>
                            <p class="service-card-desc">Create a travailleur account to make this page live.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </main>
</x-layouts.app>
