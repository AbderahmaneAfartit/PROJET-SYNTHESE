<x-layouts.app title="Posts | Freelance-Job">
    <div class="posts-page">
        <div class="posts-bg-blob posts-bg-blob-1"></div>
        <div class="posts-bg-blob posts-bg-blob-2"></div>

        <section class="posts-hero">
            <span class="posts-eyebrow">Communauté</span>
            <h1 class="posts-h1">
                Découvrez les <br />
                <span class="posts-h1-gold">Réalisations de nos Artisans</span>
            </h1>
            <p class="posts-hero-sub">
                Parcourez les derniers projets partagés par nos professionnels qualifiés. Inspirez-vous et trouvez le talent qu'il vous faut.
            </p>
        </section>

        @auth
            @if(in_array(auth()->user()->role, ['admin', 'manjob']))
                <div class="posts-action-bar">
                    <a href="{{ route('posts.create') }}" class="btn-add-post">
                        <svg viewBox="0 0 20 20" fill="none">
                            <path d="M10 4v12M4 10h12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                        Ajouter Post
                    </a>
                </div>
            @endif
        @endauth

        <div class="posts-feed">
            @forelse ($posts as $index => $post)
                <article class="post-card" style="animation-delay: {{ $index * 0.08 }}s">
                    {{-- Post Header --}}
                    <div class="post-card-header">
                        @if ($post->user && $post->user->image)
                            <img
                                src="{{ asset('storage/' . $post->user->image) }}"
                                alt="{{ $post->user->name }}"
                                class="post-avatar"
                            />
                        @else
                            <div class="post-avatar-placeholder">
                                {{ strtoupper(substr($post->user ? $post->user->name : 'U', 0, 1)) }}
                            </div>
                        @endif

                        <div class="post-meta">
                            <span class="post-author-name">{{ $post->user ? $post->user->name : 'Utilisateur' }}</span>
                            @if($post->user)
                                <span class="post-author-role">{{ $post->user->role }}</span>
                            @endif
                            @if($post->service)
                                <span class="post-service-badge">{{ $post->service->name }}</span>
                            @endif
                        </div>

                        <div class="post-time">
                            <span class="post-time-dot"></span>
                            {{ $post->created_at->diffForHumans() }}
                        </div>
                    </div>

                    {{-- Post Body --}}
                    <div class="post-card-body">
                        <h2 class="post-title">{{ $post->title }}</h2>
                        <p class="post-description">{{ $post->description }}</p>
                    </div>

                    {{-- Post Image --}}
                    @if ($post->image)
                        <img
                            src="{{ asset('storage/' . $post->image) }}"
                            alt="{{ $post->title }}"
                            class="post-card-image"
                        />
                    @endif

                </article>
            @empty
                <div class="posts-empty">
                    <div class="posts-empty-icon">📝</div>
                    <h3 class="posts-empty-title">Aucun post pour le moment</h3>
                    <p class="posts-empty-sub">Soyez le premier à partager un projet avec la communauté !</p>
                </div>
            @endforelse
        </div>
    </div>
</x-layouts.app>
