@php
    $user = auth()->user();
    $planKey = $user->planKey();
    $planConfig = $user->planConfig();
    $nav = [
        ['key' => 'overview', 'label' => 'Overview', 'route' => 'dashboard', 'icon' => 'home'],
        ['key' => 'content', 'label' => 'Content', 'route' => 'dashboard.content', 'icon' => 'edit'],
        ['key' => 'templates', 'label' => 'Templates', 'route' => 'dashboard.templates', 'icon' => 'grid'],
        ['key' => 'publish', 'label' => 'Live link', 'route' => 'dashboard.publish', 'icon' => 'link'],
        ['key' => 'export', 'label' => 'PDF export', 'route' => 'dashboard.export', 'icon' => 'pdf'],
    ];
    $planSubtitle = match ($planKey) {
        'free' => '$0 forever',
        'pro' => 'All Pro features',
        'teams' => $user->organization_name ?? 'Organization',
        default => '',
    };
@endphp

<aside class="portal-app-nav" aria-label="Portal navigation">
    <div class="portal-app-nav-head">
        <span class="portal-app-nav-label">Your plan</span>
        <div class="portal-app-plan portal-app-plan--{{ $planKey }}">
            <strong>{{ $planConfig['name'] }}</strong>
            <span>{{ $planSubtitle }}</span>
        </div>
    </div>

    <nav class="portal-app-nav-links">
        <span class="portal-app-nav-section">Workspace</span>
        @foreach ($nav as $item)
            <a href="{{ route($item['route']) }}"
               class="portal-app-nav-link {{ ($active ?? '') === $item['key'] ? 'is-active' : '' }}">
                @include('layouts.partials.portal-nav-icon', ['icon' => $item['icon']])
                {{ $item['label'] }}
            </a>
        @endforeach

        @if ($user->isTeamsPlan())
            <span class="portal-app-nav-section">Teams</span>
            <a href="{{ route('dashboard.upgrade') }}#teams-features" class="portal-app-nav-link">
                @include('layouts.partials.portal-nav-icon', ['icon' => 'shield'])
                Team admin
            </a>
        @endif

        @if ($user->isFreePlan())
            <span class="portal-app-nav-section">Grow</span>
            <a href="{{ route('dashboard.upgrade') }}"
               class="portal-app-nav-link {{ ($active ?? '') === 'upgrade' ? 'is-active' : '' }}">
                @include('layouts.partials.portal-nav-icon', ['icon' => 'spark'])
                Upgrade
            </a>
        @endif

        <span class="portal-app-nav-section">Account</span>
        <a href="{{ route('profile.edit') }}"
           class="portal-app-nav-link {{ ($active ?? '') === 'account' ? 'is-active' : '' }}">
            @include('layouts.partials.portal-nav-icon', ['icon' => 'user'])
            Settings
        </a>
        @if ($user->is_admin)
            <a href="{{ route('admin.dashboard') }}" class="portal-app-nav-link">
                @include('layouts.partials.portal-nav-icon', ['icon' => 'shield'])
                Platform admin
            </a>
        @endif
    </nav>

    <div class="portal-app-nav-foot">
        @if ($user->isFreePlan())
            <a href="{{ route('dashboard.upgrade') }}" class="portal-pro-teaser">
                <span class="portal-pro-teaser-badge">Pro</span>
                <span>Custom domain & more</span>
                <strong>Upgrade →</strong>
            </a>
        @elseif ($user->isProPlan())
            <div class="portal-plan-status portal-plan-status--pro">
                <span class="portal-pro-teaser-badge">Pro</span>
                <p>Custom domain, no branding, priority PDF</p>
            </div>
        @else
            <div class="portal-plan-status portal-plan-status--teams">
                <span class="portal-pro-teaser-badge">Teams</span>
                <p>{{ $user->organization_name ?? 'Your organization' }}</p>
                <a href="{{ route('dashboard.upgrade') }}">Manage plan →</a>
            </div>
        @endif
    </div>
</aside>
