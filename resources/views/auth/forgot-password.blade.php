<x-guest-layout>
    <div class="auth-header">
        <h1>Reset password</h1>
        <p>Enter your email and we'll send you a link to choose a new password.</p>
    </div>

    @if (session('status'))
        <div class="auth-status" style="margin-bottom: 20px;">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="auth-form">
        @csrf

        <div class="auth-field">
            <label for="email">Email</label>
            <input id="email" class="auth-input" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="you@email.com">
            @if ($errors->has('email'))
                <ul class="auth-error">
                    @foreach ($errors->get('email') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="auth-actions">
            <button type="submit" class="btn btn-primary auth-submit">Send reset link</button>
            <p class="auth-footer-text"><a href="{{ route('login') }}">Back to log in</a></p>
        </div>
    </form>
</x-guest-layout>
