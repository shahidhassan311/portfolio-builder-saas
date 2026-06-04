@php
    $user = auth()->user();
    $planKey = $user->planKey();
    $planConfig = $user->planConfig();
    $free = config('plans.free');
    $pro = config('plans.pro');
    $teams = config('plans.teams');
@endphp

<x-portal-layout
    active="overview"
    title="Overview"
    :description="'Your ' . $planConfig['name'] . ' workspace — ' . ($planConfig['tagline'] ?? '')"
>
    @if ($user->isFreePlan())
        @include('dashboard.partials.resume-import')
    @endif

    <div class="portal-progress-card">
        <div class="portal-progress-head">
            <div>
                <h2>Portfolio progress</h2>
                <p>{{ $completion['done'] }} of {{ $completion['total'] }} setup steps complete</p>
            </div>
            <div class="portal-progress-ring" style="--p: {{ $completion['percent'] }}%;">
                <span>{{ $completion['percent'] }}%</span>
            </div>
        </div>
        <div class="portal-progress-checks">
            @foreach ([
                'profile' => ['Profile', route('dashboard.content') . '#profile'],
                'about' => ['About', route('dashboard.content') . '#about'],
                'skills' => ['Skills', route('dashboard.content') . '#skills'],
                'theme' => ['Template', route('dashboard.templates')],
                'contact' => ['Contact', route('dashboard.content') . '#contact'],
            ] as $key => [$label, $url])
                <a href="{{ $url }}" class="portal-progress-check {{ ($completion['checks'][$key] ?? false) ? 'is-done' : '' }}">
                    <span class="portal-progress-dot"></span>
                    {{ $label }}
                </a>
            @endforeach
        </div>
    </div>

    @if ($user->isFreePlan())
        <h2 class="portal-section-title">Included in Free</h2>
        <div class="portal-feature-grid">
            @foreach ([
                ['templates', 'Templates', '◇', route('dashboard.templates'), $free['features']['templates']],
                ['live', 'Live link', '🔗', route('dashboard.publish'), $free['features']['live_link']],
                ['pdf', 'PDF export', '📄', route('dashboard.export'), $free['features']['pdf']],
                ['content', 'Content', '✎', route('dashboard.content'), $free['features']['edits']],
                ['theme', 'Theme switching', '🎨', route('dashboard.templates'), $free['features']['theme']],
            ] as [$key, $title, $icon, $url, $desc])
                <a href="{{ $url }}" class="portal-feature-card">
                    <span class="portal-feature-icon">{{ $icon }}</span>
                    <h3>{{ $title }}</h3>
                    <p>{{ $desc }}</p>
                    <span class="portal-feature-cta">Open →</span>
                </a>
            @endforeach
            <a href="{{ route('dashboard.content') }}" class="portal-feature-card portal-feature-card--accent">
                <span class="portal-feature-icon">↑</span>
                <h3>Import resume</h3>
                <p>Auto-fill from PDF or TXT.</p>
                <span class="portal-feature-cta">Upload above ↑</span>
            </a>
        </div>

        @if (! $onProWaitlist)
            <div class="portal-upsell-banner">
                <div>
                    <span class="portal-upsell-badge">Pro · Coming soon</span>
                    <h3>Custom domain, remove branding & priority PDF</h3>
                    <p>Join the waitlist — or log in as <code>pro@resumizo.test</code> to preview Pro UI.</p>
                </div>
                <form method="POST" action="{{ route('dashboard.waitlist') }}">
                    @csrf
                    <button type="submit" class="portal-btn portal-btn-primary">Join waitlist</button>
                </form>
            </div>
        @else
            <div class="portal-flash success">You’re on the Pro waitlist. Preview Pro UI: <strong>pro@resumizo.test</strong> / password</div>
        @endif

    @elseif ($user->isProPlan())
        <h2 class="portal-section-title">Your Pro benefits</h2>
        <div class="portal-feature-grid">
            @foreach ($pro['features'] as $feature)
                <div class="portal-feature-card portal-feature-card--static portal-feature-card--pro">
                    <span class="portal-feature-icon">✓</span>
                    <h3>{{ $feature }}</h3>
                    <p class="portal-feature-cta" style="color:var(--portal-success);">Included</p>
                </div>
            @endforeach
        </div>

        <div class="portal-action-card">
            <h3>Pro settings</h3>
            <ul class="portal-tips-list" style="list-style:none;padding:0;">
                <li><strong>Custom domain:</strong> {{ $user->custom_domain ?? 'Not set' }} — <a href="{{ route('dashboard.publish') }}">Configure</a></li>
                <li><strong>Branding:</strong> {{ $user->remove_branding ? 'Hidden on portfolio' : 'Visible' }}</li>
                <li><strong>PDF:</strong> <a href="{{ route('dashboard.export') }}">Priority export enabled</a></li>
            </ul>
        </div>

    @else
        <h2 class="portal-section-title">{{ $teams['name'] }} workspace</h2>
        @if ($user->organization_name)
            <p class="portal-meta" style="margin:-8px 0 20px;">Organization: <strong>{{ $user->organization_name }}</strong></p>
        @endif
        <div class="portal-feature-grid" id="teams-features">
            @foreach ($teams['features'] as $feature)
                <div class="portal-feature-card portal-feature-card--static portal-feature-card--teams">
                    <span class="portal-feature-icon">✓</span>
                    <h3>{{ $feature }}</h3>
                    <p class="portal-feature-cta">Teams plan</p>
                </div>
            @endforeach
        </div>

        <div class="portal-action-card">
            <h3>Team tools</h3>
            <p class="portal-meta">Bulk student accounts, shared templates, and cohort admin — contact your account manager for changes.</p>
            <div class="portal-action-buttons">
                <a href="{{ url('/') }}#contact" class="portal-btn portal-btn-primary">Contact support</a>
                <a href="{{ route('dashboard.content') }}" class="portal-btn portal-btn-ghost">Edit portfolio content</a>
            </div>
        </div>
    @endif

    @if ($user->isFreePlan())
        @push('portal-scripts')
            @include('dashboard.partials.scripts-resume-import')
        @endpush
    @endif
</x-portal-layout>
