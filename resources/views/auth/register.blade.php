<x-guest-layout>
    <div class="auth-header">
        <h1>Create your account</h1>
        <p>Start building your portfolio in minutes — free to get started.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="auth-form">
        @csrf

        <div class="auth-row">
            <div class="auth-field">
                <label for="name">Full name</label>
                <input id="name" class="auth-input" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Alex Johnson">
                @if ($errors->has('name'))
                    <ul class="auth-error">
                        @foreach ($errors->get('name') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="auth-field">
                <label for="username">Username</label>
                <input id="username" class="auth-input" type="text" name="username" value="{{ old('username') }}" required autocomplete="username" placeholder="alexj">
                <p class="auth-hint">Used in your portfolio URL (e.g. resumizo.com/alexj)</p>
                @if ($errors->has('username'))
                    <ul class="auth-error">
                        @foreach ($errors->get('username') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <div class="auth-field">
            <label for="email">Email</label>
            <input id="email" class="auth-input" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="you@email.com">
            @if ($errors->has('email'))
                <ul class="auth-error">
                    @foreach ($errors->get('email') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="auth-row">
            <div class="auth-field">
                <label for="password">Password</label>
                <input id="password" class="auth-input" type="password" name="password" required autocomplete="new-password" placeholder="••••••••">
                @if ($errors->has('password'))
                    <ul class="auth-error">
                        @foreach ($errors->get('password') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="auth-field">
                <label for="password_confirmation">Confirm password</label>
                <input id="password_confirmation" class="auth-input" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••">
                @if ($errors->has('password_confirmation'))
                    <ul class="auth-error">
                        @foreach ($errors->get('password_confirmation') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        @if(isset($themes) && $themes->count() > 0)
            <div class="auth-field">
                <label for="theme_id">Starting template <span style="font-weight:400;color:var(--text-dim);">(optional)</span></label>
                <select id="theme_id" name="theme_id" class="auth-input auth-select">
                    <option value="">Choose a template later</option>
                    @foreach($themes as $theme)
                        <option value="{{ $theme->id }}" {{ old('theme_id', $selectedTheme?->id) == $theme->id ? 'selected' : '' }}>
                            {{ $theme->name }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('theme_id'))
                    <ul class="auth-error">
                        @foreach ($errors->get('theme_id') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endif

        <div class="auth-actions">
            <button type="submit" class="btn btn-primary auth-submit">Create free account</button>
            <p class="auth-footer-text">
                Already have an account? <a href="{{ route('login') }}">Log in</a>
            </p>
        </div>
    </form>
</x-guest-layout>
