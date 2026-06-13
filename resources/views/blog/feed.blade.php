<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title>{{ $siteName }} Blog</title>
        <link>{{ \App\Support\Seo::canonicalUrl('/blog') }}</link>
        <description>Portfolio and resume tips from {{ $siteName }}.</description>
        <language>en-us</language>
        <atom:link href="{{ \App\Support\Seo::canonicalUrl('/blog/feed.xml') }}" rel="self" type="application/rss+xml"/>
        @foreach($blogs as $blog)
        <item>
            <title>{{ $blog->title }}</title>
            <link>{{ \App\Support\Seo::canonicalUrl('/blog/'.$blog->slug) }}</link>
            <guid isPermaLink="true">{{ \App\Support\Seo::canonicalUrl('/blog/'.$blog->slug) }}</guid>
            @if($blog->published_at)
            <pubDate>{{ $blog->published_at->toRfc2822String() }}</pubDate>
            @endif
            <description><![CDATA[{!! $blog->excerpt ?? Str::limit(strip_tags($blog->content), 300) !!}]]></description>
        </item>
        @endforeach
    </channel>
</rss>
