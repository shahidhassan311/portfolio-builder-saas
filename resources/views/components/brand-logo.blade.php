<a href="{{ $href ?? url('/') }}" class="logo-link {{ $class ?? '' }}">
    <img
        src="{{ asset(config('branding.logo')) }}"
        alt="Resumizo"
        class="logo-img"
        decoding="async"
    />
</a>
