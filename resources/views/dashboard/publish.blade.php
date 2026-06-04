@php $user = auth()->user(); @endphp
<x-portal-layout active="publish" title="Live portfolio" description="{{ config('plans.free.features.live_link') }} — share this URL with recruiters and clients.">
    @if ($user->isProPlan() && $user->custom_domain)
        <div class="portal-action-card portal-action-card--pro">
            <span class="portal-upsell-badge">Pro</span>
            <h3>Custom domain</h3>
            <div class="portal-copy-row">
                <input type="text" readonly value="https://{{ $user->custom_domain }}">
            </div>
            <p class="portal-meta">Visitors can use your branded domain. Default link still works below.</p>
        </div>
    @endif

    <div class="portal-action-card">
        <label class="portal-field">
            <span>Your live portfolio URL</span>
            <div class="portal-copy-row">
                <input type="text" id="portfolio-url" readonly value="{{ $portfolioUrl }}">
                <button type="button" class="portal-btn portal-btn-primary" id="copy-portfolio-url">Copy link</button>
            </div>
        </label>
        @if ($user->remove_branding)
            <p class="portal-meta" style="margin-top:12px;color:#047857;">✓ Resumizo branding removed on your live site (Pro).</p>
        @endif
        <div class="portal-action-buttons">
            <a href="{{ $portfolioUrl }}" target="_blank" rel="noopener" class="portal-btn portal-btn-primary">Open live site</a>
            <a href="{{ route('dashboard.export') }}" class="portal-btn portal-btn-ghost">Export PDF</a>
            <a href="{{ route('dashboard.content') }}#contact" class="portal-btn portal-btn-ghost">Edit contact info</a>
        </div>
    </div>

    <div class="portal-tips-card">
        <h3>Publishing tips</h3>
        <ul class="portal-tips-list">
            <li>Pick a template under <a href="{{ route('dashboard.templates') }}">Templates</a> before sharing your link.</li>
            <li>Update <a href="{{ route('dashboard.content') }}#contact">Contact</a> so visitors can reach you.</li>
            @if ($user->isFreePlan())
                <li>Pro adds a <strong>custom domain</strong> and removes Resumizo branding — try <code>pro@resumizo.test</code>.</li>
            @endif
        </ul>
    </div>
</x-portal-layout>

@push('portal-scripts')
<script>
document.getElementById('copy-portfolio-url')?.addEventListener('click', () => {
    const input = document.getElementById('portfolio-url');
    if (!input) return;
    navigator.clipboard.writeText(input.value).then(() => {
        const btn = document.getElementById('copy-portfolio-url');
        const prev = btn.textContent;
        btn.textContent = 'Copied!';
        setTimeout(() => { btn.textContent = prev; }, 2000);
    });
});
</script>
@endpush
