@php
    $pageData = $seo['page'];
    $hubData = $seo['hub_config'];
@endphp

<x-marketing-layout :seo="$seo" :show-breadcrumbs="true">
    <main class="max seo-page-main">
        <header class="seo-hero">
            <h1>{{ $pageData['h1'] ?? $pageData['title'] }}</h1>
            <p>{{ $pageData['description'] ?? '' }}</p>
        </header>

        <div class="seo-content-block">
            <h2>Why this matters for your job search</h2>
            <p>
                Recruiters spend seconds on first impressions. A clear structure, role-specific keywords,
                and a live portfolio link help you stand out — especially when paired with a PDF export that stays in sync.
            </p>
        </div>

        <div class="seo-content-block">
            <h2>What to include</h2>
            <ul>
                <li>A strong headline aligned to your target role</li>
                <li>Quantified impact in experience bullets (%, $, time saved)</li>
                <li>Projects or case studies with links recruiters can open quickly</li>
                <li>Skills that match the job description — without keyword stuffing</li>
            </ul>
        </div>

        <div class="seo-content-block">
            <h2>Build it on Resumizo</h2>
            <p>
                Pick a template from our
                <a href="{{ url('/resume-templates') }}">resume templates</a>,
                paste your experience, and publish a live link plus PDF in minutes.
            </p>
            <p style="margin-top: 20px;">
                <a href="{{ route('register') }}" class="btn btn-primary">Create free portfolio</a>
                <a href="{{ url('/'.$hub) }}" class="btn btn-outline" style="margin-left: 12px;">More {{ $hubData['h1'] ?? 'guides' }}</a>
            </p>
        </div>

        @if($related->isNotEmpty())
            <section class="related-articles" aria-labelledby="related-seo">
                <h2 id="related-seo">Related guides</h2>
                <div class="seo-grid">
                    @foreach($related as $relatedSlug => $relatedPage)
                        <article class="seo-card">
                            <h3 style="margin:0 0 8px;font-size:1rem;">
                                <a href="{{ url('/'.$hub.'/'.$relatedSlug) }}">{{ $relatedPage['h1'] ?? $relatedPage['title'] }}</a>
                            </h3>
                            <p>{{ Str::limit($relatedPage['description'] ?? '', 100) }}</p>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif

        @include('seo.partials.internal-links', ['currentHub' => $hub])
    </main>
</x-marketing-layout>
