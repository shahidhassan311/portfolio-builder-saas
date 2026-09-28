@php
    $user = auth()->user();
    $currentPlan = $user->planKey();
    $free = $plans['free'];
    $pro = $plans['pro'];
    $teams = $plans['teams'];
@endphp

<x-portal-layout active="upgrade" title="Plans & pricing" description="Compare Free, Pro, and Teams — your current plan is highlighted.">
    <div class="portal-pricing-grid">
        <article class="portal-pricing-card {{ $currentPlan === 'free' ? 'portal-pricing-card--current' : '' }}">
            @if ($currentPlan === 'free')
                <span class="portal-pricing-current-label">Your plan</span>
            @endif
            <h3>{{ $free['name'] }}</h3>
            <p class="portal-pricing-desc">{{ $free['tagline'] }}</p>
            <div class="portal-pricing-price">{{ $free['price'] }} <small>{{ $free['price_suffix'] }}</small></div>
            <ul class="portal-pricing-features">
                @foreach ($free['features'] as $feature)
                    <li>{{ $feature }}</li>
                @endforeach
            </ul>
            @if ($currentPlan === 'free')
                <span class="portal-btn portal-btn-ghost" style="width:100%;text-align:center;opacity:.85;">Current plan</span>
            @else
                <span class="portal-meta" style="display:block;text-align:center;">Demo: free@resumizo.test</span>
            @endif
        </article>

        <article class="portal-pricing-card portal-pricing-card--featured {{ $currentPlan === 'pro' ? 'portal-pricing-card--current' : '' }}">
            @if ($currentPlan === 'pro')
                <span class="portal-pricing-current-label">Your plan</span>
            @elseif (! empty($pro['badge']))
                <span class="portal-pricing-badge">{{ $pro['badge'] }}</span>
            @endif
            <h3>{{ $pro['name'] }}</h3>
            <p class="portal-pricing-desc">{{ $pro['tagline'] }}</p>
            <div class="portal-pricing-price {{ $currentPlan !== 'pro' ? 'portal-pricing-price--soon' : '' }}">
                {{ $currentPlan === 'pro' ? 'Active' : $pro['price'] }}
            </div>
            <ul class="portal-pricing-features">
                @foreach ($pro['features'] as $feature)
                    <li>{{ $feature }}</li>
                @endforeach
            </ul>
            @if ($currentPlan === 'pro')
                <p class="portal-pricing-status">Pro is active on this demo account.</p>
            @elseif ($onProWaitlist)
                <p class="portal-pricing-status">You’re on the waitlist — we’ll email {{ $user->email }}.</p>
            @else
                <form method="POST" action="{{ route('dashboard.waitlist') }}">
                    @csrf
                    <button type="submit" class="portal-btn portal-btn-primary" style="width:100%;">Join waitlist</button>
                </form>
                <p class="portal-meta" style="text-align:center;margin-top:10px;">Preview UI: pro@resumizo.test</p>
            @endif
        </article>

        <article class="portal-pricing-card {{ $currentPlan === 'teams' ? 'portal-pricing-card--current' : '' }}">
            @if ($currentPlan === 'teams')
                <span class="portal-pricing-current-label">Your plan</span>
            @endif
            <h3>{{ $teams['name'] }}</h3>
            <p class="portal-pricing-desc">{{ $teams['tagline'] }}</p>
            <div class="portal-pricing-price">{{ $teams['price'] }}</div>
            <ul class="portal-pricing-features">
                @foreach ($teams['features'] as $feature)
                    <li>{{ $feature }}</li>
                @endforeach
            </ul>
            @if ($currentPlan === 'teams')
                <p class="portal-pricing-status">Teams plan active{{ $user->organization_name ? ' — ' . $user->organization_name : '' }}.</p>
            @else
                <a href="{{ url('/') }}#contact" class="portal-btn portal-btn-ghost" style="width:100%;text-align:center;">Contact sales</a>
                <p class="portal-meta" style="text-align:center;margin-top:10px;">Preview UI: teams@resumizo.test</p>
            @endif
        </article>
    </div>
</x-portal-layout>
