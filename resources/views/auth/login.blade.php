<x-guest-layout>
    <div class="auth-header">
        <h1>Welcome back</h1>
        <p>Log in to edit your portfolio and export your PDF.</p>
    </div>

    @if (session('status'))
        <div class="auth-status" style="margin-bottom: 20px;">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf

        <div class="auth-field">
            <label for="email">Email</label>
            <input id="email" class="auth-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="you@email.com">
            @if ($errors->has('email'))
                <ul class="auth-error">
                    @foreach ($errors->get('email') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="auth-field">
            <label for="password">Password</label>
            <input id="password" class="auth-input" type="password" name="password" required autocomplete="current-password" placeholder="••••••••">
            @if ($errors->has('password'))
                <ul class="auth-error">
                    @foreach ($errors->get('password') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="auth-field" style="margin-top: -8px;">
            <label class="auth-remember">
                <input id="remember_me" type="checkbox" name="remember">
                <span>Remember me</span>
            </label>
        </div>

        <div class="auth-actions">
            <button type="submit" class="btn btn-primary auth-submit">Log in</button>
            <p class="auth-footer-text">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="auth-forgot">Forgot password?</a>
                    <span style="color:var(--text-dim);"> · </span>
                @endif
                New here? <a href="{{ route('register') }}">Create an account</a>
            </p>
        </div>
    </form>
</x-guest-layout>
