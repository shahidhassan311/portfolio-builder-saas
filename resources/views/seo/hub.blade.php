<x-marketing-layout :seo="$seo" :show-breadcrumbs="true">
    <main class="max seo-page-main">
        <header class="seo-hero">
            <span class="section-label">{{ Str::headline($hub) }}</span>
            <h1>{{ $seo['hub_config']['h1'] ?? Str::headline($hub) }}</h1>
            <p>{{ $seo['hub_config']['intro'] ?? '' }}</p>
        </header>

        <div class="seo-grid">
            @foreach($pages as $slug => $page)
                <article class="seo-card">
                    <h2>
                        <a href="{{ url('/'.$hub.'/'.$slug) }}">{{ $page['h1'] ?? $page['title'] }}</a>
                    </h2>
                    <p>{{ Str::limit($page['description'] ?? '', 120) }}</p>
                </article>
            @endforeach
        </div>

        @include('seo.partials.internal-links', ['currentHub' => $hub])
    </main>
</x-marketing-layout>
