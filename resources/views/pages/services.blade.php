<x-layouts.app title="Services | Freelance-Job">
    <div class="services-page">
        <div class="services-bg-blob services-bg-blob-1"></div>
        <div class="services-bg-blob services-bg-blob-2"></div>

        <section class="services-hero">
            <div class="services-hero-inner">
                <span class="services-eyebrow">Expertise</span>
                <h1 class="services-h1">
                    Explore our <br />
                    <span class="services-h1-gold">Professional Services</span>
                </h1>
                <p class="services-hero-sub">
                    Find top-tier professionals categorised by their skills. Filter by categories to find exactly what you need.
                </p>
            </div>
        </section>

        @php
            $categories = $services->pluck('category')->unique()->values();
        @endphp

        <!-- Filter Buttons -->
        <div class="services-filter-container">
            <button class="filter-btn active" data-filter="all">All</button>
            @foreach ($categories as $category)
                <button class="filter-btn" data-filter="{{ Str::slug($category) }}">{{ $category }}</button>
            @endforeach
        </div>

        <!-- Services Grid -->
        <div class="services-grid-wrapper">
            <div class="services-grid">
                @forelse ($services as $service)
                    @php
                        $categorySlug = Str::slug($service->category);
                        
                        // Map local seeder filenames to high quality stock images for visual excellence
                        $imageUrl = match($service->image) {
                            'web.jpg' => 'https://images.unsplash.com/photo-1547658719-da2b81169b7b?auto=format&fit=crop&w=600&q=80',
                            'design.jpg' => 'https://images.unsplash.com/photo-1561070791-26c113006238?auto=format&fit=crop&w=600&q=80',
                            'meca.jpg' => 'https://images.unsplash.com/photo-1486006920555-c77dce18193b?auto=format&fit=crop&w=600&q=80',
                            'plomberie.jpg' => 'https://images.unsplash.com/photo-1581094288338-2314dddb7ecc?auto=format&fit=crop&w=600&q=80',
                            'elec.jpg' => 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?auto=format&fit=crop&w=600&q=80',
                            default => $service->image ? (str_starts_with($service->image, 'http') ? $service->image : asset('storage/' . $service->image)) : 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=600&q=80',
                        };
                    @endphp

                    <div class="service-card fade-in" data-category="{{ $categorySlug }}">
                        <div class="service-card-img-wrapper">
                            <img src="{{ $imageUrl }}" alt="{{ $service->name }}" class="service-card-img" />
                            <span class="service-card-category">{{ $service->category }}</span>
                        </div>

                        <div class="service-card-body">
                            <h3 class="service-card-title">{{ $service->name }}</h3>
                            <p class="service-card-desc">{{ $service->description }}</p>

                            <div class="service-works-section">
                                <h4 class="service-works-title">Related Works</h4>
                                <div class="service-works-list">
                                    @forelse ($service->posts as $post)
                                        <div class="service-work-item">
                                            @if ($post->user && $post->user->image)
                                                <img src="{{ asset('storage/' . $post->user->image) }}" alt="{{ $post->user->name }}" class="service-work-avatar" />
                                            @else
                                                <div class="service-work-avatar-placeholder">
                                                    {{ strtoupper(substr($post->user ? $post->user->name : 'W', 0, 1)) }}
                                                </div>
                                            @endif
                                            <div class="service-work-details">
                                                <span class="service-work-name">{{ $post->title }}</span>
                                                <span class="service-work-author">by {{ $post->user ? $post->user->name : 'Unknown' }}</span>
                                            </div>
                                        </div>
                                    @empty
                                        <span class="service-works-empty">No works listed under this service yet.</span>
                                    @endforelse
                                </div>
                            </div>

                            <div class="service-card-bar"></div>
                        </div>
                    </div>
                @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 40px;">
                        <p class="services-hero-sub">No services found.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- JS Category Filter Logic -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.filter-btn');
            const cards = document.querySelectorAll('.service-card');

            buttons.forEach(btn => {
                btn.addEventListener('click', () => {
                    // Remove active class from all buttons
                    buttons.forEach(b => b.classList.remove('active'));
                    // Add active class to clicked button
                    btn.classList.add('active');

                    const filter = btn.getAttribute('data-filter');

                    cards.forEach(card => {
                        const category = card.getAttribute('data-category');
                        if (filter === 'all' || category === filter) {
                            card.classList.remove('fade-out');
                            card.classList.add('fade-in');
                        } else {
                            card.classList.remove('fade-in');
                            card.classList.add('fade-out');
                        }
                    });
                });
            });
        });
    </script>
</x-layouts.app>
