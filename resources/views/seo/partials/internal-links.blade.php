<section class="seo-internal-links max" aria-labelledby="seo-hubs-heading">
    <h2 id="seo-hubs-heading">Explore resume & portfolio resources</h2>
    <ul>
        @foreach(config('seo.programmatic_hubs', []) as $hubKey => $hubMeta)
            @if(($currentHub ?? null) !== $hubKey)
                <li><a href="{{ url('/'.$hubKey) }}">{{ $hubMeta['h1'] ?? Str::headline($hubKey) }}</a></li>
            @endif
        @endforeach
        <li><a href="{{ route('blog.index') }}">Blog</a></li>
        <li><a href="{{ url('/') }}#themes">Templates</a></li>
        <li><a href="{{ route('register') }}">Start free</a></li>
    </ul>
</section>
