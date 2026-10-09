<x-guest-layout>

    <div class="auth-header">
        <h1>Verify Email</h1>
        <p>
            We sent a 6-digit OTP to
            <strong>{{ $user->email }}</strong>
        </p>
    </div>

    <form method="POST" action="{{ route('otp.verify', $user) }}" class="auth-form">
        @csrf

        <div class="auth-field">
            <label for="otp">OTP Code</label>
            <input
                id="otp"
                name="otp"
                type="text"
                inputmode="numeric"
                pattern="[0-9]*"
                maxlength="6"
                class="auth-input"
                style="text-align: center; letter-spacing: 0.35em; font-size: 1.25rem; font-weight: 600;"
                autofocus
                required
                autocomplete="one-time-code"
            >
            @if ($errors->has('otp'))
                <ul class="auth-error">
                    @foreach ($errors->get('otp') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="auth-actions">
            <button type="submit" class="btn btn-primary auth-submit">
                Verify OTP
            </button>
        </div>
    </form>

    <div class="auth-actions" style="margin-top: 8px;">
        <form method="POST" action="{{ route('otp.resend', $user) }}">
            @csrf
            <button
                id="resendBtn"
                type="submit"
                class="btn btn-outline auth-submit auth-resend-btn"
                disabled
            >
                Resend OTP in <span id="timer">60</span> seconds
            </button>
        </form>
    </div>

    <script>
        let time = 60;
        const timerEl = document.getElementById('timer');
        const resendBtn = document.getElementById('resendBtn');

        const countdown = setInterval(function () {
            time--;
            timerEl.textContent = time;

            if (time <= 0) {
                clearInterval(countdown);
                resendBtn.disabled = false;
                resendBtn.textContent = 'Resend OTP';
            }
        }, 1000);
    </script>

</x-guest-layout>
