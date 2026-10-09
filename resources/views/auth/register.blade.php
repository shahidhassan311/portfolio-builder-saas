<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Create Account | Resumizo</title>
    @vite(['resources/css/landing.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <x-ahrefs-analytics />
</head>
<body class="marketing">

<div class="register-wrap">
    <x-brand-logo class="register-logo" />

    @php
        $draftProfessionInExtra = $draftProfessionId
            && $professions->pluck('id')->contains($draftProfessionId)
            && ! $professions->take(5)->pluck('id')->contains($draftProfessionId);
        $draftThemeInExtra = $draftThemeId
            && $themes->pluck('id')->contains($draftThemeId)
            && ! $themes->take(5)->pluck('id')->contains($draftThemeId);
    @endphp

    <form id="register-form" method="POST" action="{{ route('register') }}" class="register-shell">
        @csrf

        <div class="register-card"
             x-data="registerWizard({{ $errors->any() ? 3 : 1 }}, @js([
                 'draftUrl' => route('register.draft'),
                 'profession_id' => $draftProfessionId,
                 'theme_id' => $draftThemeId,
                 'show_all_professions' => (bool) $draftProfessionInExtra,
                 'show_all_themes' => (bool) $draftThemeInExtra,
             ]))">

            <input type="hidden" name="profession_id" x-model="selectedProfession">
            <input type="hidden" name="theme_id" x-model="selectedTheme">

            <div class="register-card-top">
                <span class="register-step-badge">Step <span x-text="step"></span> of 3</span>
            </div>

            <div class="register-stepper" aria-hidden="true">
                <div class="register-step"
                     :class="step > 1 ? 'is-complete' : (step === 1 ? 'is-active' : 'is-todo')">
                    <div class="register-step-dot">
                        <i class="fas fa-check register-step-check" x-show="step > 1" x-cloak></i>
                        <span x-show="step <= 1">1</span>
                    </div>
                    <span class="register-step-label">Profession</span>
                </div>
                <div class="register-step-connector" :class="step > 1 ? 'is-done' : ''"></div>
                <div class="register-step"
                     :class="step > 2 ? 'is-complete' : (step === 2 ? 'is-active' : 'is-todo')">
                    <div class="register-step-dot">
                        <i class="fas fa-check register-step-check" x-show="step > 2" x-cloak></i>
                        <span x-show="step <= 2">2</span>
                    </div>
                    <span class="register-step-label">Template</span>
                </div>
                <div class="register-step-connector" :class="step > 2 ? 'is-done' : ''"></div>
                <div class="register-step" :class="step >= 3 ? 'is-active' : 'is-todo'">
                    <div class="register-step-dot"><span>3</span></div>
                    <span class="register-step-label">Account</span>
                </div>
            </div>

            {{-- Step 1 --}}
            <div x-show="step === 1" x-transition.opacity.duration.200ms>

                <div class="register-head">
                    <h1>Select your profession</h1>
                    <p>We use this to recommend templates and portfolio sections for your field.</p>
                </div>

                <div class="register-grid">
                    @foreach ($professions->take(5) as $profession)
                        <div class="register-choice"
                             :class="selectedProfession == '{{ $profession->id }}' ? 'is-selected' : ''"
                             @click="selectProfession('{{ $profession->id }}')">
                            <div class="register-choice-icon">
                                <i class="fas fa-{{ $profession->fontAwesomeIconClass() }}"></i>
                            </div>
                            <div class="register-choice-title">{{ $profession->name }}</div>
                        </div>
                    @endforeach

                    @if ($professions->count() > 4)
                        <div class="register-choice"
                             :class="showAllProfessions ? 'is-selected' : ''"
                             @click="showAllProfessions = !showAllProfessions">
                            <div class="register-choice-icon">
                                <i class="fas" :class="showAllProfessions ? 'fa-chevron-up' : 'fa-ellipsis-h'"></i>
                            </div>
                            <div class="register-choice-title">View all professions</div>
                        </div>
                    @endif

                    @foreach ($professions->skip(5) as $profession)
                        <div class="register-choice"
                             x-show="showAllProfessions"
                             :class="selectedProfession == '{{ $profession->id }}' ? 'is-selected' : ''"
                             @click="selectProfession('{{ $profession->id }}')">
                            <div class="register-choice-icon">
                                <i class="fas fa-{{ $profession->fontAwesomeIconClass() }}"></i>
                            </div>
                            <div class="register-choice-title">{{ $profession->name }}</div>
                        </div>
                    @endforeach
                </div>

                @error('profession_id')
                    <span class="register-field-error">{{ $message }}</span>
                @enderror
            </div>

            {{-- Step 2 --}}
            @php
                $templateCategories = $themes->pluck('category')->filter()->unique()->values();
            @endphp

            <div x-show="step === 2" x-transition.opacity.duration.200ms>

                <div class="register-head">
                    <h1>Select a template</h1>
                    <p>Choose a starting design. You can change templates anytime from your dashboard.</p>
                </div>

                @if ($templateCategories->count())
                    <div class="register-pills">
                        <button type="button" class="register-pill"
                                :class="activeCategory === 'All' ? 'is-active' : ''"
                                @click="activeCategory = 'All'; showAllThemes = false">All</button>
                        @foreach ($templateCategories as $category)
                            <button type="button" class="register-pill"
                                    :class="activeCategory === '{{ $category }}' ? 'is-active' : ''"
                                    @click="activeCategory = '{{ $category }}'; showAllThemes = false">{{ $category }}</button>
                        @endforeach
                    </div>
                @endif

                <div class="register-grid register-grid--templates">
                    @foreach ($themes->take(5) as $theme)
                        <article class="register-template"
                                 :class="selectedTheme == '{{ $theme->id }}' ? 'is-selected' : ''"
                                 x-show="activeCategory === 'All' || activeCategory === '{{ $theme->category ?? '' }}'"
                                 @click="selectTheme('{{ $theme->id }}')">
                            <div class="register-template-preview">
                                <x-theme-preview-thumb :theme="$theme" :compact="true" />
                                <span class="register-check" x-show="selectedTheme == '{{ $theme->id }}'" x-cloak>
                                    <i class="fas fa-check"></i>
                                </span>
                            </div>
                            <div class="register-template-footer">
                                <h4>{{ $theme->name }}</h4>
                                <a href="{{ route('preview.theme', $theme->id) }}" target="_blank" @click.stop
                                   class="register-preview-link" title="Preview full template">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach

                    @if ($themes->count() > 4)
                        <div class="register-template register-other-card"
                             :class="showAllThemes ? 'is-selected' : ''"
                             x-show="activeCategory === 'All'"
                             @click="showAllThemes = !showAllThemes">
                            <div class="register-choice-icon">
                                <i class="fas" :class="showAllThemes ? 'fa-chevron-up' : 'fa-ellipsis-h'"></i>
                            </div>
                            <span class="register-choice-title">View all templates</span>
                        </div>
                    @endif

                    @foreach ($themes->skip(5) as $theme)
                        <article class="register-template"
                                 :class="selectedTheme == '{{ $theme->id }}' ? 'is-selected' : ''"
                                 x-show="showAllThemes && (activeCategory === 'All' || activeCategory === '{{ $theme->category ?? '' }}')"
                                 @click="selectTheme('{{ $theme->id }}')">
                            <div class="register-template-preview">
                                <x-theme-preview-thumb :theme="$theme" :compact="true" />
                                <span class="register-check" x-show="selectedTheme == '{{ $theme->id }}'" x-cloak>
                                    <i class="fas fa-check"></i>
                                </span>
                            </div>
                            <div class="register-template-footer">
                                <h4>{{ $theme->name }}</h4>
                                <a href="{{ route('preview.theme', $theme->id) }}" target="_blank" @click.stop
                                   class="register-preview-link" title="Preview full template">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                @error('theme_id')
                    <span class="register-field-error">{{ $message }}</span>
                @enderror

            </div>

            {{-- Step 3 --}}
            <div x-show="step === 3" x-transition.opacity.duration.200ms>
                <div class="register-head">
                    <h1>Account details</h1>
                    <p>Enter your information below. We will send a verification code to your email.</p>
                </div>

                <div class="register-form-grid register-form-grid--2">
                    <div class="register-field">
                        <label for="name"><i class="fas fa-user"></i> Full name</label>
                        <input id="name" class="register-input" name="name" value="{{ $draftName }}"
                               placeholder="Your full name" required autocomplete="name"
                               @change="saveAccountDraft()">
                        @error('name') <span class="register-field-error">{{ $message }}</span> @enderror
                    </div>
                    <div class="register-field">
                        <label for="username"><i class="fas fa-at"></i> Username</label>
                        <input id="username" class="register-input" name="username" value="{{ $draftUsername }}"
                               placeholder="yourname" required autocomplete="username"
                               @change="saveAccountDraft()">
                        @error('username') <span class="register-field-error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="register-field" style="margin-top:16px;">
                    <label for="email"><i class="fas fa-envelope"></i> Email</label>
                    <input id="email" class="register-input" type="email" name="email" value="{{ $draftEmail }}"
                           placeholder="you@email.com" required autocomplete="email"
                           @change="saveAccountDraft()">
                    @error('email') <span class="register-field-error">{{ $message }}</span> @enderror
                </div>

                <div class="register-form-grid register-form-grid--2" style="margin-top:16px;">
                    <div class="register-field">
                        <label for="password"><i class="fas fa-lock"></i> Password</label>
                        <input id="password" class="register-input" type="password" name="password"
                               placeholder="Create a password" required autocomplete="new-password">
                        @error('password') <span class="register-field-error">{{ $message }}</span> @enderror
                    </div>
                    <div class="register-field">
                        <label for="password_confirmation"><i class="fas fa-check-circle"></i> Confirm</label>
                        <input id="password_confirmation" class="register-input" type="password"
                               name="password_confirmation" placeholder="Repeat password" required autocomplete="new-password">
                    </div>
                </div>

                <div class="register-trust">
                    <i class="fas fa-shield-alt"></i>
                    <span>Your account and portfolio data are protected using industry-standard security practices.</span>
                </div>

                <p class="register-footer-text">
                    By creating an account, you agree to our
                    <a href="{{ route('terms') }}">Terms</a> and
                    <a href="{{ route('privacy') }}">Privacy Policy</a>.
                </p>
                <p class="register-footer-text">
                    Already have an account? <a href="{{ route('login') }}">Log in</a>
                </p>
            </div>

            <p class="register-step-hint" x-show="stepMessage" x-text="stepMessage" x-cloak></p>

            <div class="register-actions">
                <button type="button" class="register-btn register-btn--ghost" x-show="step > 1" @click="back()">
                    <i class="fas fa-arrow-left"></i> Back
                </button>

                <div class="register-actions-primary">
                    <button type="button" class="register-btn register-btn--primary" x-show="step < 3" @click="next()">
                        Continue <i class="fas fa-arrow-right"></i>
                    </button>
                    <button type="submit" class="register-btn register-btn--success" x-show="step === 3" x-cloak>
                        <i class="fas fa-user-plus"></i> Create account
                    </button>
                </div>
            </div>
        </div>

        <p class="register-home-link">
            <a href="{{ url('/') }}"><i class="fas fa-arrow-left"></i> Return to homepage</a>
        </p>
    </form>
</div>

<x-toast-stack />

<script>
function registerWizard(initialStep = 1, config = {}) {
    return {
        step: initialStep,
        stepMessage: '',
        draftUrl: config.draftUrl || '',
        selectedProfession: config.profession_id ? String(config.profession_id) : '',
        selectedTheme: config.theme_id ? String(config.theme_id) : '',
        showAllProfessions: Boolean(config.show_all_professions),
        showAllThemes: Boolean(config.show_all_themes),
        activeCategory: 'All',

        csrfToken() {
            return document.querySelector('meta[name="csrf-token"]')?.content || '';
        },

        persistDraft(payload) {
            if (!this.draftUrl) {
                return Promise.resolve();
            }

            return fetch(this.draftUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': this.csrfToken(),
                },
                credentials: 'same-origin',
                body: JSON.stringify(payload),
            });
        },

        selectProfession(id) {
            this.selectedProfession = String(id);
            this.persistDraft({ profession_id: Number(id) });
        },

        selectTheme(id) {
            this.selectedTheme = String(id);
            this.persistDraft({ theme_id: Number(id) });
        },

        saveAccountDraft() {
            const form = this.$el.closest('form');
            if (!form) {
                return;
            }

            this.persistDraft({
                name: form.querySelector('[name=name]')?.value || '',
                username: form.querySelector('[name=username]')?.value || '',
                email: form.querySelector('[name=email]')?.value || '',
            });
        },

        next() {
            this.stepMessage = '';

            if (this.step === 1) {
                if (!this.selectedProfession) {
                    this.stepMessage = 'Please select a profession before continuing.';
                    return;
                }
                this.persistDraft({ profession_id: Number(this.selectedProfession) });
            }

            if (this.step === 2) {
                if (!this.selectedTheme) {
                    this.stepMessage = 'Please select a template before continuing.';
                    return;
                }
                this.persistDraft({ theme_id: Number(this.selectedTheme) });
            }

            if (this.step < 3) {
                this.step++;
            }
        },

        back() {
            this.stepMessage = '';
            if (this.step > 1) {
                this.step--;
            }
        },
    };
}
</script>

</body>
</html>
