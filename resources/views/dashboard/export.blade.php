@php $user = auth()->user(); @endphp
<x-portal-layout active="export" title="PDF export" description="{{ config('plans.free.features.pdf') }} — download a resume-style PDF from your portfolio.">
    @if (! $user->active_theme_id)
        <div class="portal-flash error">
            Choose a template first — <a href="{{ route('dashboard.templates') }}" style="text-decoration:underline;">Browse templates</a>
        </div>
    @endif

    @if ($user->isProPlan())
        <div class="portal-flash success">Priority PDF export is enabled on your Pro plan.</div>
    @endif

    <div class="portal-action-card portal-action-card--center">
        <div class="portal-export-icon" aria-hidden="true">📄</div>
        <h2>Download your portfolio PDF</h2>
        <p class="portal-meta">
            @if ($user->isProPlan())
                Pro: high-quality, print-optimized PDF from your current template.
            @else
                Generated from your current template. Unlimited downloads on Free.
            @endif
        </p>
        <div class="portal-action-buttons" style="justify-content:center;">
            <a href="{{ $pdfUrl }}" class="portal-btn portal-btn-primary" {{ $user->active_theme_id ? '' : 'aria-disabled=true tabindex=-1 style=opacity:.5;pointer-events:none' }}>
                {{ $user->isProPlan() ? 'Download priority PDF' : 'Download PDF' }}
            </a>
            <a href="{{ $portfolioUrl }}" target="_blank" class="portal-btn portal-btn-ghost">Preview site first</a>
        </div>
    </div>

    @if ($user->isFreePlan())
        <div class="portal-compare-plans">
            <div class="portal-compare-col">
                <h4>Free (you)</h4>
                <ul>
                    <li>PDF export</li>
                    <li>All templates</li>
                    <li>Unlimited downloads</li>
                </ul>
            </div>
            <div class="portal-compare-col portal-compare-col--pro">
                <span class="portal-upsell-badge">Pro</span>
                <h4>Priority PDF quality</h4>
                <ul>
                    <li>Sharper typography & layout</li>
                    <li>Print-optimized exports</li>
                </ul>
                <form method="POST" action="{{ route('dashboard.waitlist') }}" style="margin-top:16px;">
                    @csrf
                    <button type="submit" class="portal-btn portal-btn-ghost">Join Pro waitlist</button>
                </form>
            </div>
        </div>
    @endif
</x-portal-layout>
