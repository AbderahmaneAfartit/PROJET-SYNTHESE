<x-layouts.app title="Ajouter un Post | Freelance-Job">
    <div class="ajout-post-page">
        <div class="ajout-bg-blob ajout-bg-blob-1"></div>
        <div class="ajout-bg-blob ajout-bg-blob-2"></div>

        <a href="{{ route('posts') }}" class="ajout-back-link">
            <svg viewBox="0 0 20 20" fill="none" width="16" height="16">
                <path d="M15 10H5M5 10l5-5M5 10l5 5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Retour aux Posts
        </a>

        <section class="ajout-hero">
            <span class="ajout-eyebrow">Nouveau Post</span>
            <h1 class="ajout-h1">
                Partagez votre <br />
                <span class="ajout-h1-gold">Réalisation</span>
            </h1>
            <p class="ajout-hero-sub">
                Montrez vos talents à la communauté. Ajoutez un titre, une description et une image de votre projet.
            </p>
        </section>

        <div class="ajout-form-container">
            @if (session('success'))
                <div class="ajout-success-alert">
                    <svg viewBox="0 0 20 20" fill="none" width="20" height="20">
                        <circle cx="10" cy="10" r="9" stroke="currentColor" stroke-width="1.5"/>
                        <path d="M6 10l3 3 5-6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger" style="margin-bottom: 20px;" role="alert">
                    <strong>Veuillez corriger les erreurs ci-dessous.</strong>
                    <ul class="mb-0 mt-2 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="ajout-form-card">
                <form method="POST" action="{{ route('posts.submit') }}" enctype="multipart/form-data" novalidate>
                    @csrf

                    <div class="ajout-field">
                        <label class="ajout-label" for="title">
                            Titre du post <span class="required">*</span>
                        </label>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            class="ajout-input @error('title') is-invalid @enderror"
                            placeholder="Ex: Installation électrique moderne"
                            value="{{ old('title') }}"
                            required
                        />
                        @error('title')
                            <span class="ajout-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="ajout-field">
                        <label class="ajout-label" for="service_display">
                            Service / Catégorie
                        </label>
                        @php $userService = auth()->user()->service; @endphp
                        <input
                            type="text"
                            id="service_display"
                            class="ajout-input"
                            value="{{ $userService ? $userService->name : 'Aucun service associé' }}"
                            disabled
                        />
                        {{-- Hidden field to submit the actual service_id --}}
                        @if($userService)
                            <input type="hidden" name="service_id" value="{{ $userService->id }}" />
                        @endif
                        @error('service_id')
                            <span class="ajout-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="ajout-field">
                        <label class="ajout-label" for="description">
                            Description <span class="required">*</span>
                        </label>
                        <textarea
                            id="description"
                            name="description"
                            class="ajout-textarea @error('description') is-invalid @enderror"
                            placeholder="Décrivez votre réalisation, les techniques utilisées, la durée du projet..."
                            rows="5"
                            required
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <span class="ajout-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="ajout-field">
                        <label class="ajout-label">
                            Image du projet
                        </label>
                        <div class="ajout-file-wrapper">
                            <label class="ajout-file-label" for="image">
                                <span class="ajout-file-icon">📸</span>
                                <span class="ajout-file-text">
                                    <strong>Cliquez pour choisir</strong> ou glissez votre image ici
                                </span>
                                <span class="ajout-file-text" style="font-size: 0.78rem; opacity: 0.7;">
                                    PNG, JPG, WEBP (max 10 Mo)
                                </span>
                            </label>
                            <input
                                type="file"
                                id="image"
                                name="image"
                                class="ajout-file-input"
                                accept="image/*"
                            />
                            <div class="ajout-file-preview" id="image-preview">
                                <img src="" alt="Aperçu" id="preview-img" />
                            </div>
                        </div>
                        @error('image')
                            <span class="ajout-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="ajout-submit-btn">
                        <svg viewBox="0 0 20 20" fill="none">
                            <path d="M17 3L3 10l5 2m9-9l-6 14-3-5m9-9l-9 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Publier le Post
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fileInput = document.getElementById('image');
            const previewContainer = document.getElementById('image-preview');
            const previewImg = document.getElementById('preview-img');

            if (fileInput) {
                fileInput.addEventListener('change', function () {
                    const file = this.files[0];
                    if (file && file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            previewImg.src = e.target.result;
                            previewContainer.classList.add('has-file');
                        };
                        reader.readAsDataURL(file);
                    } else {
                        previewContainer.classList.remove('has-file');
                        previewImg.src = '';
                    }
                });
            }
        });
    </script>
</x-layouts.app>
