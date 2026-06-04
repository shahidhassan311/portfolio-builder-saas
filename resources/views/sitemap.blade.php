{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:news="http://www.google.com/schemas/sitemap-news/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">

    @foreach($staticEntries as $entry)
    <url>
        <loc>{{ $entry['loc'] }}</loc>
        @if(!empty($entry['lastmod']))
        <lastmod>{{ $entry['lastmod'] }}</lastmod>
        @endif
        <changefreq>{{ $entry['changefreq'] }}</changefreq>
        <priority>{{ $entry['priority'] }}</priority>
    </url>
    @endforeach

    @foreach($blogs as $blog)
    <url>
        <loc>{{ \App\Support\Seo::canonicalUrl('/blog/'.$blog->slug) }}</loc>
        <lastmod>{{ $blog->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    @endforeach

</urlset>
