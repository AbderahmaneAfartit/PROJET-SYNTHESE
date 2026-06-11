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
            $activeCategory = request('category', 'all');
            $searchQuery = request('q', '');
        @endphp

        <div class="services-search-wrap">
            <form class="services-search-bar" id="services-search-form">
                <svg class="services-search-icon" viewBox="0 0 20 20" fill="none">
                    <circle cx="8.5" cy="8.5" r="5.5" stroke="currentColor" stroke-width="1.8"></circle>
                    <path d="M13 13l3.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"></path>
                </svg>
                <input
                    type="search"
                    class="services-search-input"
                    id="services-search-input"
                    value="{{ $searchQuery }}"
                    placeholder="Search by service, category, or keyword"
                    autocomplete="off"
                />
            </form>
        </div>

        <!-- Filter Buttons -->
        <div class="services-filter-container">
            <button class="filter-btn {{ $activeCategory === 'all' ? 'active' : '' }}" data-filter="all">All</button>
            @foreach ($categories as $category)
                @php
                    $categorySlug = Str::slug($category);
                @endphp
                <button
                    class="filter-btn {{ $activeCategory === $categorySlug ? 'active' : '' }}"
                    data-filter="{{ $categorySlug }}"
                >
                    {{ $category }}
                </button>
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

                    <div
                        class="service-card fade-in"
                        data-category="{{ $categorySlug }}"
                        data-search="{{ Str::lower($service->name . ' ' . $service->category . ' ' . $service->description) }}"
                    >
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

            <div class="services-no-results" id="services-no-results" hidden>
                <h3>No services match your search.</h3>
                <p>Try another keyword or choose a different category.</p>
            </div>
        </div>
    </div>

    <!-- JS Category Filter Logic -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.filter-btn');
            const cards = document.querySelectorAll('.service-card');
            const searchForm = document.getElementById('services-search-form');
            const searchInput = document.getElementById('services-search-input');
            const noResults = document.getElementById('services-no-results');
            const params = new URLSearchParams(window.location.search);
            let activeFilter = params.get('category') || 'all';

            const normalize = (value) => (value || '').toString().trim().toLowerCase();

            function updateUrl() {
                const nextParams = new URLSearchParams();
                const query = searchInput.value.trim();

                if (query) {
                    nextParams.set('q', query);
                }

                if (activeFilter !== 'all') {
                    nextParams.set('category', activeFilter);
                }

                const nextUrl = nextParams.toString()
                    ? `${window.location.pathname}?${nextParams.toString()}`
                    : window.location.pathname;

                window.history.replaceState({}, '', nextUrl);
            }

            function applyFilters() {
                const query = normalize(searchInput.value);
                let visibleCount = 0;

                buttons.forEach((button) => {
                    button.classList.toggle('active', button.getAttribute('data-filter') === activeFilter);
                });

                cards.forEach(card => {
                    const category = card.getAttribute('data-category');
                    const searchText = normalize(card.getAttribute('data-search'));
                    const matchesCategory = activeFilter === 'all' || category === activeFilter;
                    const matchesSearch = query === '' || searchText.includes(query);

                    if (matchesCategory && matchesSearch) {
                        card.classList.remove('fade-out');
                        card.classList.add('fade-in');
                        visibleCount++;
                    } else {
                        card.classList.remove('fade-in');
                        card.classList.add('fade-out');
                    }
                });

                if (noResults) {
                    noResults.hidden = visibleCount > 0;
                }

                updateUrl();
            }

            if (!document.querySelector(`.filter-btn[data-filter="${activeFilter}"]`)) {
                activeFilter = 'all';
            }

            buttons.forEach(btn => {
                btn.addEventListener('click', () => {
                    activeFilter = btn.getAttribute('data-filter');
                    applyFilters();
                });
            });

            searchInput.addEventListener('input', applyFilters);

            searchForm.addEventListener('submit', (event) => {
                event.preventDefault();
                applyFilters();
            });

            applyFilters();
        });
    </script>
</x-layouts.app>
