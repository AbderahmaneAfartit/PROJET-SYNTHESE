<x-layouts.app title="Contact | Freelance-Job">
    @php
        $selectedSubject = old('subject', '');
        $meta = $subjectMeta[$selectedSubject] ?? null;
    @endphp

    @if (session('contact_sent'))
        <div class="contact-page">
            <div class="contact-success">
                <div class="success-icon">
                    <svg viewBox="0 0 52 52" fill="none">
                        <circle cx="26" cy="26" r="25" stroke="var(--brand)" stroke-width="1.5" />
                        <path
                            d="M14 26l9 9 15-17"
                            stroke="var(--brand)"
                            stroke-width="2.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </div>
                <h2 class="success-title">Message envoyé !</h2>
                <p class="success-text">
                    Notre équipe vous répondra dans les 24h. Merci de nous avoir contactés.
                </p>
                <a class="contact-btn text-decoration-none" href="{{ route('contact') }}">Nouveau message</a>
            </div>
        </div>
    @else
        <div class="contact-page">
            <div class="contact-blob contact-blob-1"></div>
            <div class="contact-blob contact-blob-2"></div>

            <div class="reveal contact-hero active" data-reveal>
                <span class="contact-eyebrow">Assistance & Support</span>
                <h1 class="contact-heading">
                    On est là pour <br />
                    <span class="contact-dot">vous aider</span>
                </h1>
                <p class="contact-subheading">
                    Une question ? Un problème ? Notre équipe est disponible 24/7 pour
                    vous accompagner.
                </p>
            </div>

            <div class="contact-layout">
                <div class="reveal-left contact-info active" data-reveal>
                    <div class="info-card">
                        <div class="info-card-icon">📬</div>
                        <div>
                            <div class="info-card-title">Email direct</div>
                            <div class="info-card-val">support@freelance-job.com</div>
                        </div>
                    </div>
                    <div class="info-card" style="animation-delay: 0.1s">
                        <div class="info-card-icon">⏰</div>
                        <div>
                            <div class="info-card-title">Temps de réponse</div>
                            <div class="info-card-val">Moins de 24 heures</div>
                        </div>
                    </div>
                    <div class="info-card" style="animation-delay: 0.2s">
                        <div class="info-card-icon">🌍</div>
                        <div>
                            <div class="info-card-title">Disponibilité</div>
                            <div class="info-card-val">Lun – Ven, 9h – 18h</div>
                        </div>
                    </div>

                    <div class="info-divider"></div>

                    <div class="info-subjects-title">Sujets traités</div>
                    @foreach ($subjectMeta as $subject)
                        <div class="info-subject-tag" style="--tag-color: {{ $subject['color'] }}">
                            <span class="info-subject-dot" style="background: {{ $subject['color'] }}"></span>
                            {{ $subject['label'] }}
                        </div>
                    @endforeach
                </div>

                <div class="reveal-right contact-form-wrap active" data-reveal>
                    <form method="POST" action="{{ route('contact.send') }}" novalidate>
                        @csrf
                        <div class="field-group {{ $errors->has('name') ? 'field-error' : '' }}">
                            <label class="field-label">
                                Nom complet
                                <span class="field-required">*</span>
                            </label>
                            <div class="field-input-wrap">
                                <span class="field-prefix-icon">
                                    <svg viewBox="0 0 20 20" fill="none" width="16" height="16">
                                        <circle cx="10" cy="7" r="3.5" stroke="currentColor" stroke-width="1.5" />
                                        <path d="M3 17c0-3.314 3.134-6 7-6s7 2.686 7 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                    </svg>
                                </span>
                                <input
                                    type="text"
                                    name="name"
                                    class="field-input"
                                    placeholder="Votre nom et prénom"
                                    value="{{ old('name') }}"
                                />
                            </div>
                            @error('name')
                                <span class="field-err-msg">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field-group {{ $errors->has('email') ? 'field-error' : '' }}">
                            <label class="field-label">
                                Adresse email
                                <span class="field-required">*</span>
                            </label>
                            <div class="field-input-wrap">
                                <span class="field-prefix-icon">
                                    <svg viewBox="0 0 20 20" fill="none" width="16" height="16">
                                        <rect x="2" y="5" width="16" height="11" rx="2" stroke="currentColor" stroke-width="1.5" />
                                        <path d="M2 8l8 5 8-5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                    </svg>
                                </span>
                                <input
                                    type="email"
                                    name="email"
                                    class="field-input"
                                    placeholder="vous@exemple.com"
                                    value="{{ old('email') }}"
                                />
                            </div>
                            @error('email')
                                <span class="field-err-msg">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field-group {{ $errors->has('subject') ? 'field-error' : '' }}">
                            <label class="field-label">
                                Sujet
                                <span class="field-required">*</span>
                            </label>
                            <div class="field-input-wrap">
                                <span class="field-prefix-icon">
                                    <svg viewBox="0 0 20 20" fill="none" width="16" height="16">
                                        <path d="M4 6h12M4 10h8M4 14h6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                    </svg>
                                </span>
                                <select class="field-input field-select" name="subject" data-contact-subject>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject['value'] }}" @selected($selectedSubject === $subject['value'])>
                                            {{ $subject['label'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('subject')
                                <span class="field-err-msg">{{ $message }}</span>
                            @enderror
                        </div>

                        <div
                            class="subject-hint"
                            data-contact-hint
                            @if (! $meta) style="display: none;" @else style="--hint-color: {{ $meta['color'] }};" @endif
                        >
                            <span
                                class="subject-hint-dot"
                                data-contact-hint-dot
                                @if ($meta) style="background: {{ $meta['color'] }};" @endif
                            ></span>
                            <span data-contact-hint-text>{{ $meta['hint'] ?? '' }}</span>
                        </div>

                        <script type="application/json" id="contact-subject-meta">
                            @json($subjectMeta)
                        </script>

                        <div class="field-group {{ $errors->has('message') ? 'field-error' : '' }}">
                            <label class="field-label" style="display: flex; justify-content: space-between">
                                <span>
                                    Message <span class="field-required">*</span>
                                </span>
                                <span class="char-count"><span data-message-count>{{ mb_strlen(old('message', '')) }}</span> / 1000</span>
                            </label>
                            <textarea
                                class="field-textarea"
                                name="message"
                                placeholder="Décrivez votre situation en détail..."
                                maxlength="1000"
                                rows="6"
                                data-message-input
                            >{{ old('message') }}</textarea>
                            @error('message')
                                <span class="field-err-msg">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="contact-btn">
                            Envoyer le message
                            <svg viewBox="0 0 20 20" fill="none" width="16" height="16" style="margin-left: 8px">
                                <path d="M3 10h14M11 4l6 6-6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif
</x-layouts.app>
