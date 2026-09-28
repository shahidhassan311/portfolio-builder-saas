
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Resumizo - Create Account</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
            * { font-family: 'Inter', sans-serif; box-sizing: border-box; }
            body { background: #f7f8fc; }

            /* Body pattern - like the reference image */
            body {
                background-color: #F8FAFC;
                background-image:
                    linear-gradient(rgba(108, 92, 231, 0.06) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(108, 92, 231, 0.06) 1px, transparent 1px);
                background-size: 40px 40px;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 1rem;
            }

            .step-dot { transition: all .25s ease; }
            .step-dot.is-done { background:#6C5CE7; color:#fff; }
            .step-dot.is-active { background:#6C5CE7; color:#fff; box-shadow:0 0 0 6px rgba(108,92,231,.12); }
            .step-dot.is-todo { background:#fff; color:#94a3b8; border:2px solid #e2e8f0; }
            .step-line { background:#e2e8f0; }
            .step-line.is-done { background:#6C5CE7; }

            .prof-card, .tpl-card { transition: all .2s ease; }
            .prof-card:hover, .tpl-card:hover { transform: translateY(-2px); box-shadow:0 10px 24px -8px rgba(0,0,0,.06); }
            .prof-card.is-active { border-color:#6C5CE7 !important; background:#f8f6ff; }
            .prof-card.is-active .prof-icon { background:#6C5CE7; color:#fff; }

            .tpl-card.is-active { border-color:#6C5CE7 !important; box-shadow:0 10px 28px -8px rgba(108,92,231,.18); }

            .cat-pill.is-active { background:#6C5CE7; color:#fff; border-color:#6C5CE7; }

            ::placeholder { color:#94a3b8; }
            input:focus { outline:none; }

            .w-full{
                width: 40%;
            }
        </style>
    </head>
    <body class="min-h-screen flex items-center justify-center p-4 sm:p-6">

    <!-- ===== FORM WRAPPER ADDED ===== -->
    <form method="POST" action="{{ route('register') }}" class="w-[40%] max-w-3xl">
        @csrf

        <div class="bg-white rounded-3xl shadow-[0_25px_60px_-12px_rgba(0,0,0,0.08)] p-6 sm:p-10 relative"
            x-data="wizard({{ $errors->any() ? 3 : 1 }})">

            <!-- ===== HEADER ===== -->
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-400 via-purple-400 to-pink-400 flex items-center justify-center">
                        <i class="fas fa-puzzle-piece text-white text-xs"></i>
                    </div>
                    <span class="text-lg font-extrabold text-slate-900">Resumizo</span>
                </div>
                <span class="text-sm font-semibold text-[#6C5CE7]">Step <span x-text="step"></span> of 3</span>
            </div>

            <!-- ===== ERROR SUMMARY ===== -->
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-2xl px-5 py-4 mb-6 text-red-800">
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm before:content-['•_'] before:text-red-500 before:font-bold">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- ===== STEP INDICATOR ===== -->
            <div class="flex items-center mb-10">
                <div class="flex flex-col items-center gap-2 w-20">
                    <div class="step-dot w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold"
                        :class="step > 1 ? 'is-done' : (step === 1 ? 'is-active' : 'is-todo')">
                        <i class="fas fa-check text-xs" x-show="step > 1"></i>
                        <span x-show="step <= 1">1</span>
                    </div>
                    <span class="text-xs font-medium" :class="step >= 1 ? 'text-slate-900 font-semibold' : 'text-slate-400'">Profession</span>
                </div>

                <div class="flex-1 h-[2px] step-line -mt-6" :class="step > 1 ? 'is-done' : ''"></div>

                <div class="flex flex-col items-center gap-2 w-20">
                    <div class="step-dot w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold"
                        :class="step > 2 ? 'is-done' : (step === 2 ? 'is-active' : 'is-todo')">
                        <i class="fas fa-check text-xs" x-show="step > 2"></i>
                        <span x-show="step <= 2">2</span>
                    </div>
                    <span class="text-xs font-medium" :class="step >= 2 ? 'text-slate-900 font-semibold' : 'text-slate-400'">Template</span>
                </div>

                <div class="flex-1 h-[2px] step-line -mt-6" :class="step > 2 ? 'is-done' : ''"></div>

                <div class="flex flex-col items-center gap-2 w-20">
                    <div class="step-dot w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold"
                        :class="step >= 3 ? 'is-active' : 'is-todo'">
                        <span>3</span>
                    </div>
                    <span class="text-xs font-medium" :class="step >= 3 ? 'text-slate-900 font-semibold' : 'text-slate-400'">Account</span>
                </div>
            </div>

            <!-- ============================================================ -->
            <!-- ===== STEP 1: PROFESSION (dynamic $professions collection) === -->
            <!-- ============================================================ -->
            <div x-show="step === 1" x-transition.duration.200ms
                x-data="{ selectedProfession: '{{ old('profession_id') }}', showAll: false }">

                <input type="hidden" name="profession_id" x-model="selectedProfession">

                <div class="text-center mb-6">
                    <h1 class="text-2xl sm:text-[28px] font-bold text-slate-900 tracking-tight mb-1">
                        What's your profession?
                    </h1>
                    <p class="text-slate-500 text-sm">
                        This helps us personalize your experience
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-3 max-h-[380px] overflow-y-auto pr-2">

                    {{-- Visible initially: first 4 professions --}}
                    @foreach($professions->take(5) as $profession)
                        <div class="prof-card relative border-2 border-slate-200 rounded-2xl p-4 text-center cursor-pointer"
                            :class="selectedProfession == '{{ $profession->id }}' ? 'is-active' : ''"
                            @click="selectedProfession = '{{ $profession->id }}'">

                            <div class="prof-icon w-12 h-12 mx-auto mb-2 rounded-xl bg-slate-100 flex items-center justify-center text-slate-600 transition">
        @svg('lucide-' . $profession->icon, 'w-6 h-6')
    </div>

                            <div class="text-sm font-medium text-slate-900">
                                {{ $profession->name }}
                            </div>
                        </div>
                    @endforeach

                    {{-- Other button --}}
                    @if($professions->count() > 4)
                        <div class="prof-card relative border-2 border-slate-200 rounded-2xl p-4 text-center cursor-pointer"
                            :class="showAll ? 'is-active' : ''"
                            @click="showAll = !showAll">

                            <div class="prof-icon w-12 h-12 mx-auto mb-2 rounded-xl bg-slate-100 flex items-center justify-center text-slate-600 text-lg transition">
                                <i class="fas" :class="showAll ? 'fa-chevron-up' : 'fa-ellipsis'"></i>
                            </div>

                            <div class="text-sm font-medium text-slate-900">
                                Other
                            </div>
                        </div>
                    @endif

                    {{-- Remaining professions --}}
                    @foreach($professions->skip(5) as $profession)
                        <div class="prof-card relative border-2 border-slate-200 rounded-2xl p-4 text-center cursor-pointer"
                            :class="selectedProfession == '{{ $profession->id }}' ? 'is-active' : ''"
                            x-show="showAll"
                            @click="selectedProfession = '{{ $profession->id }}'">

                            <div class="prof-icon w-12 h-12 mx-auto mb-2 rounded-xl bg-slate-100 flex items-center justify-center text-slate-600 text-lg transition">
                                <i class="fas fa-{{ $profession->icon ?? 'briefcase' }}"></i>
                            </div>

                            <div class="text-sm font-medium text-slate-900">
                                {{ $profession->name }}
                            </div>
                        </div>
                    @endforeach

                </div>

                @error('profession_id')
                    <small class="block mt-3 text-red-500 text-sm">{{ $message }}</small>
                @enderror

            </div>

            <!-- ============================================================ -->
            <!-- ===== STEP 2: TEMPLATE (dynamic $themes collection) ========= -->
            <!-- ============================================================ -->
            @php
                $templateCategories = $themes->pluck('category')->filter()->unique()->values();
            @endphp

            <div x-show="step === 2" x-transition.duration.200ms
                x-data="{
                    selectedTheme: '{{ old('theme_id') }}',
                    activeCategory: 'All',
                    showAll: false
                }">

                <input type="hidden" name="theme_id" x-model="selectedTheme">

                <div class="text-center mb-5">
                    <h1 class="text-2xl sm:text-[28px] font-bold text-slate-900 tracking-tight mb-1">
                        Choose your template
                    </h1>
                    <p class="text-slate-500 text-sm">
                        You can change it anytime later
                    </p>
                </div>

                {{-- Categories --}}
                @if($templateCategories->count())
                    <div class="flex flex-wrap justify-center gap-2 mb-6">
                        <button type="button"
                                class="cat-pill px-4 py-2 rounded-full text-sm font-medium border border-slate-200 text-slate-600"
                                :class="activeCategory === 'All' ? 'is-active' : ''"
                                @click="activeCategory = 'All'; showAll = false">
                            All
                        </button>

                        @foreach($templateCategories as $category)
                            <button type="button"
                                    class="cat-pill px-4 py-2 rounded-full text-sm font-medium border border-slate-200 text-slate-600"
                                    :class="activeCategory === '{{ $category }}' ? 'is-active' : ''"
                                    @click="activeCategory = '{{ $category }}'; showAll = false">
                                {{ $category }}
                            </button>
                        @endforeach
                    </div>
                @endif

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">

                    {{-- First 4 Themes --}}
                    @foreach($themes->take(5) as $theme)
                        <article class="tpl-card relative border-2 border-slate-200 rounded-2xl overflow-hidden cursor-pointer"
                                :class="selectedTheme == '{{ $theme->id }}' ? 'is-active' : ''"
                                x-show="activeCategory === 'All' || activeCategory === '{{ $theme->category ?? '' }}'"
                                @click="selectedTheme = '{{ $theme->id }}'">

                            <div class="h-32 sm:h-36 bg-slate-100 flex items-center justify-center relative overflow-hidden">
                                @if($theme->preview_image)
                                    <img src="{{ asset('storage/'.$theme->preview_image) }}"
                                        alt="{{ $theme->name }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <span class="text-sm font-semibold text-slate-400 uppercase tracking-wide">
                                        {{ $theme->name }}
                                    </span>
                                @endif

                                <span class="absolute top-2 right-2 w-6 h-6 rounded-full bg-[#6C5CE7] text-white flex items-center justify-center text-[11px]"
                                    x-show="selectedTheme == '{{ $theme->id }}'">
                                    <i class="fas fa-check"></i>
                                </span>
                            </div>

                            <div class="p-3 flex items-center justify-between">
                                <h4 class="text-sm font-semibold text-slate-900">{{ $theme->name }}</h4>

                                <a href="{{ route('preview.theme', $theme->id) }}"
                                target="_blank"
                                @click.stop
                                class="text-xs font-medium text-slate-500 hover:text-[#6C5CE7]">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach

                    {{-- Other Card --}}
                    @if($themes->count() > 4)
                        <div class="tpl-card border-2 border-slate-200 rounded-2xl h-48 flex flex-col items-center justify-center cursor-pointer"
                            :class="showAll ? 'is-active' : ''"
                            x-show="activeCategory === 'All'"
                            @click="showAll = !showAll">

                            <div class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center mb-3">
                                <i class="fas text-slate-600"
                                :class="showAll ? 'fa-chevron-up' : 'fa-ellipsis'"></i>
                            </div>

                            <span class="text-sm font-semibold text-slate-700">
                                Other
                            </span>
                        </div>
                    @endif

                    {{-- Remaining Themes --}}
                    @foreach($themes->skip(5) as $theme)
                        <article class="tpl-card relative border-2 border-slate-200 rounded-2xl overflow-hidden cursor-pointer"
                                :class="selectedTheme == '{{ $theme->id }}' ? 'is-active' : ''"
                                x-show="showAll && (activeCategory === 'All' || activeCategory === '{{ $theme->category ?? '' }}')"
                                @click="selectedTheme = '{{ $theme->id }}'">

                            <div class="h-32 sm:h-36 bg-slate-100 flex items-center justify-center relative overflow-hidden">
                                @if($theme->preview_image)
                                    <img src="{{ asset('storage/'.$theme->preview_image) }}"
                                        alt="{{ $theme->name }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <span class="text-sm font-semibold text-slate-400 uppercase tracking-wide">
                                        {{ $theme->name }}
                                    </span>
                                @endif

                                <span class="absolute top-2 right-2 w-6 h-6 rounded-full bg-[#6C5CE7] text-white flex items-center justify-center text-[11px]"
                                    x-show="selectedTheme == '{{ $theme->id }}'">
                                    <i class="fas fa-check"></i>
                                </span>
                            </div>

                            <div class="p-3 flex items-center justify-between">
                                <h4 class="text-sm font-semibold text-slate-900">{{ $theme->name }}</h4>

                                <a href="{{ route('preview.theme', $theme->id) }}"
                                target="_blank"
                                @click.stop
                                class="text-xs font-medium text-slate-500 hover:text-[#6C5CE7]">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach

                </div>

                @error('theme_id')
                    <small class="block mt-3 text-red-500 text-sm">{{ $message }}</small>
                @enderror

                <div class="flex items-center gap-2 justify-center mt-6 bg-[#f8f6ff] text-[#6C5CE7] text-sm font-medium rounded-xl py-3 px-4">
                    <i class="fas fa-wand-magic-sparkles"></i>
                    <span>Don't worry! You can switch templates anytime.</span>
                </div>

            </div>

            <!-- ============================================================ -->
            <!-- ===== STEP 3: ACCOUNT ======================================= -->
            <!-- ============================================================ -->
            <div x-show="step === 3" x-transition.duration.200ms>

                <div class="text-center mb-6">
                    <h1 class="text-2xl sm:text-[28px] font-bold text-slate-900 tracking-tight mb-1">Create your account</h1>
                    <p class="text-slate-500 text-sm">Let's get your account setup</p>
                </div>

                <div class="grid sm:grid-cols-2 gap-5 mb-1">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1"><i class="fas fa-user mr-1"></i> Full Name</label>
                        <input class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 bg-slate-50 text-sm text-slate-900 focus:border-[#6C5CE7] focus:bg-white focus:shadow-[0_0_0_4px_rgba(108,92,231,0.08)] transition"
                            name="name" placeholder="Enter your full name" value="{{ old('name') }}" required>
                        @error('name') <small class="block mt-1 text-red-500 text-xs">{{ $message }}</small> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1"><i class="fas fa-at mr-1"></i> Username</label>
                        <input class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 bg-slate-50 text-sm text-slate-900 focus:border-[#6C5CE7] focus:bg-white focus:shadow-[0_0_0_4px_rgba(108,92,231,0.08)] transition"
                            name="username" placeholder="Choose username" value="{{ old('username') }}" required>
                        @error('username') <small class="block mt-1 text-red-500 text-xs">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="mb-1 mt-4">
                    <label class="block text-sm font-medium text-slate-700 mb-1"><i class="fas fa-envelope mr-1"></i> Email</label>
                    <input class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 bg-slate-50 text-sm text-slate-900 focus:border-[#6C5CE7] focus:bg-white focus:shadow-[0_0_0_4px_rgba(108,92,231,0.08)] transition"
                        type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required>
                    @error('email') <small class="block mt-1 text-red-500 text-xs">{{ $message }}</small> @enderror
                </div>

                <div class="grid sm:grid-cols-2 gap-5 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1"><i class="fas fa-lock mr-1"></i> Password</label>
                        <input class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 bg-slate-50 text-sm text-slate-900 focus:border-[#6C5CE7] focus:bg-white focus:shadow-[0_0_0_4px_rgba(108,92,231,0.08)] transition"
                            type="password" name="password" placeholder="Create password" required>
                        @error('password') <small class="block mt-1 text-red-500 text-xs">{{ $message }}</small> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1"><i class="fas fa-check-circle mr-1"></i> Confirm Password</label>
                        <input class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 bg-slate-50 text-sm text-slate-900 focus:border-[#6C5CE7] focus:bg-white focus:shadow-[0_0_0_4px_rgba(108,92,231,0.08)] transition"
                            type="password" name="password_confirmation" placeholder="Confirm password" required>
                    </div>
                </div>

                <div class="flex items-center gap-3 bg-slate-100 rounded-2xl px-5 py-3.5 mt-5 text-sm text-slate-600">
                    <i class="fas fa-shield-alt text-[#6C5CE7] text-lg"></i>
                    <span>Your data is safe with us — we use industry-standard security to protect your information.</span>
                </div>

                <p class="text-center text-sm text-slate-500 mt-4">
                    By creating an account, you agree to our
                    <a href="#" class="text-[#6C5CE7] font-medium hover:underline">Terms of Service</a> and
                    <a href="#" class="text-[#6C5CE7] font-medium hover:underline">Privacy Policy</a>
                </p>

                <p class="text-center text-sm text-slate-600 mt-3">
                    Already have an account? <a href="#" class="text-[#6C5CE7] font-semibold hover:underline">Log in</a>
                </p>
            </div>

            <!-- ============================================================ -->
            <!-- ===== WIZARD ACTIONS (Back / Continue / Submit) ============= -->
            <!-- ============================================================ -->
            <div class="flex items-center justify-between gap-4 mt-10 pt-6 border-t border-slate-100">
                <button type="button" x-show="step > 1" @click="back()"
                        class="px-7 py-3 rounded-xl font-semibold text-sm bg-slate-100 text-slate-600 hover:bg-slate-200 transition inline-flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Back
                </button>

                <div class="ml-auto flex gap-3">
                    <button type="button" x-show="step < 3" @click="next()"
                            class="px-9 py-3 rounded-xl font-semibold text-sm bg-[#6C5CE7] text-white hover:bg-[#5a4bd1] hover:-translate-y-0.5 transition inline-flex items-center gap-2">
                        Continue <i class="fas fa-arrow-right"></i>
                    </button>

                    <button type="submit" x-show="step === 3"
                            class="px-9 py-3 rounded-xl font-semibold text-sm bg-[#2dd4bf] text-slate-900 hover:bg-[#14b8a6] hover:-translate-y-0.5 transition inline-flex items-center gap-2">
                        <i class="fas fa-user-plus"></i> Create Account
                    </button>
                </div>
            </div>
            <div class="text-center mt-5">
    <a href="{{ url('/') }}"
       class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-[#6C5CE7] transition">
        <i class="fas fa-arrow-left"></i>
        Back to Home
    </a>
</div>
        </div>
    </form>
    <!-- ===== END OF FORM ===== -->

    <!-- ===== ALPINE.JS WIZARD LOGIC (unchanged) ===== -->
    <script>
    function wizard(initialStep = 1) {
        return {
            step: initialStep,
            next() { if (this.step < 3) this.step++; },
            back() { if (this.step > 1) this.step--; }
        }
    }
    </script>

    </body>
    </html>
