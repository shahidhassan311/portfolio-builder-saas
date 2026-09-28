@php
    $portfolioSeo = $portfolioSeo ?? [
        'title' => ($user->name ?? 'Portfolio').' | Portfolio',
        'description' => 'Professional portfolio for '.($user->name ?? 'this user').' — built with Resumizo.',
        'robots' => (!empty($isPreview) ? 'noindex, nofollow' : 'noindex, follow'),
        'canonical' => \App\Support\Seo::canonicalUrl('/'.request()->route('id').'/'.request()->route('username')),
        'og_type' => 'profile',
        'og_image' => \App\Support\Seo::ogImageUrl(),
        'schemas' => [],
    ];
@endphp
<title>{{ $portfolioSeo['title'] }}</title>
<meta name="description" content="{{ $portfolioSeo['description'] }}">
<meta name="robots" content="{{ $portfolioSeo['robots'] }}">
<link rel="canonical" href="{{ $portfolioSeo['canonical'] }}">
<meta property="og:type" content="{{ $portfolioSeo['og_type'] }}">
<meta property="og:url" content="{{ $portfolioSeo['canonical'] }}">
<meta property="og:title" content="{{ $portfolioSeo['title'] }}">
<meta property="og:description" content="{{ $portfolioSeo['description'] }}">
<meta property="og:image" content="{{ $portfolioSeo['og_image'] }}">
<link rel="icon" type="image/png" href="{{ asset(config('branding.logo')) }}">
