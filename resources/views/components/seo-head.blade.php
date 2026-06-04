@php
    $title = $seo['title'] ?? config('seo.default_title');
    $description = $seo['description'] ?? config('seo.default_description');
    $keywords = $seo['keywords'] ?? config('seo.default_keywords');
    $robots = $seo['robots'] ?? config('seo.default_robots');
    $canonical = $seo['canonical'] ?? \App\Support\Seo::canonicalUrl(request()->path());
    $ogType = $seo['og_type'] ?? 'website';
    $ogImage = $seo['og_image'] ?? \App\Support\Seo::ogImageUrl();
    $twitterHandle = config('seo.twitter_handle');
@endphp

<title>{{ $title }}</title>
<meta name="title" content="{{ $title }}">
<meta name="description" content="{{ $description }}">
@if($keywords)
<meta name="keywords" content="{{ $keywords }}">
@endif
<meta name="robots" content="{{ $robots }}">
<link rel="canonical" href="{{ $canonical }}">

<meta property="og:locale" content="{{ config('seo.locale') }}">
<meta property="og:type" content="{{ $ogType }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:image:width" content="{{ config('seo.og_image_width') }}">
<meta property="og:image:height" content="{{ config('seo.og_image_height') }}">
<meta property="og:site_name" content="{{ config('seo.site_name') }}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="{{ $twitterHandle }}">
<meta name="twitter:url" content="{{ $canonical }}">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $ogImage }}">

@if(!empty($seo['article_published']))
<meta property="article:published_time" content="{{ $seo['article_published'] }}">
@endif
@if(!empty($seo['article_modified']))
<meta property="article:modified_time" content="{{ $seo['article_modified'] }}">
@endif
@if(!empty($seo['author']))
<meta name="author" content="{{ $seo['author'] }}">
<meta property="article:author" content="{{ $seo['author'] }}">
@endif

@if($includePerformanceHints)
<link rel="dns-prefetch" href="https://fonts.googleapis.com">
<link rel="dns-prefetch" href="https://fonts.gstatic.com">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preload" href="{{ asset(config('branding.logo')) }}" as="image" type="image/png">
@endif

<link rel="icon" type="image/png" href="{{ asset(config('branding.logo')) }}">
<link rel="apple-touch-icon" href="{{ asset(config('branding.logo')) }}">

@if($json = $schemaJson())
<script type="application/ld+json">{!! $json !!}</script>
@endif
