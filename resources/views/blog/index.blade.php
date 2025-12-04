<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="{{ asset('resumizo-logo-white.png') }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Preconnect for performance --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">

    <!-- Primary Meta Tags -->
    <title>Blog - Portfolio Builder | Resumizo</title>
    <meta name="title" content="Blog - Portfolio Builder | Resumizo">
    <meta name="description"
          content="Read latest insights, tutorials, and news from Resumizo – the ultimate portfolio builder. Learn how to showcase your work professionally and attract clients.">
    <meta name="keywords"
          content="portfolio builder blog, portfolio tips, freelancer blog, designer portfolio, online portfolio, resumizo">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Blog - Portfolio Builder | Resumizo">
    <meta property="og:description"
          content="Read latest insights, tutorials, and news from Resumizo – the ultimate portfolio builder. Learn how to showcase your work professionally and attract clients.">
    <meta property="og:image" content="{{ asset('images/og-blog.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="Blog - Portfolio Builder | Resumizo">
    <meta property="twitter:description"
          content="Read latest insights, tutorials, and news from Resumizo – the ultimate portfolio builder. Learn how to showcase your work professionally and attract clients.">
    <meta property="twitter:image" content="{{ asset('images/og-blog.jpg') }}">

    <!-- Favicon / Apple Touch -->
    <link rel="apple-touch-icon" href="{{ asset('resumizo-logo-white.png') }}">


    <!-- Structured Data / JSON-LD for Google -->
    <script type="application/ld+json">
        @php
            $jsonLd = [
                "@context" => "https://schema.org",
                "@type" => "Blog",
                "name" => "Resumizo Blog",
                "url" => url('/'),
                "description" => "Insights, tutorials, and news from Resumizo – the ultimate portfolio builder.",
                "publisher" => [
                    "@type" => "Organization",
                    "name" => "Resumizo",
                    "logo" => [
                        "@type" => "ImageObject",
                        "url" => asset('resumizo-logo-white.png')
                    ]
                ],
                "blogPost" => $blogs->map(function($blog) {
                    return [
                        "@type" => "BlogPosting",
                        "headline" => $blog->title,
                        "image" => $blog->image ? asset('storage/' . $blog->image) : asset('path-to-default-blog-image.jpg'),
                        "author" => [
                            "@type" => "Person",
                            "name" => $blog->author->name ?? 'Resumizo Team'
                        ],
                        "publisher" => [
                            "@type" => "Organization",
                            "name" => "Resumizo",
                            "logo" => [
                                "@type" => "ImageObject",
                                "url" => asset('resumizo-logo-white.png')
                            ]
                        ],
                        "datePublished" => $blog->published_at->toIso8601String(),
                        "dateModified" => $blog->updated_at->toIso8601String(),
                        "description" => $blog->excerpt ?? Str::limit(strip_tags($blog->content), 160)
                    ];
                })->toArray()
            ];
        @endphp

        {!! json_encode($jsonLd, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) !!}
    </script>

    @vite(['resources/js/app.js'])
    <style>
        :root {
            --bg: #050914;
            --card: rgba(8, 12, 26, 0.9);
            --text: #f3f6ff;
            --text-muted: rgba(243, 246, 255, 0.7);
            --accent: #5d6bff;
            --accent-2: #9c5bff;
            --accent-3: #31c9ff;
            --radius: 28px;
            --shadow: 0 32px 70px rgba(2, 6, 23, 0.55);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: radial-gradient(circle at 15% -20%, rgba(134, 118, 255, 0.4), transparent 45%),
            radial-gradient(circle at 85% -10%, rgba(49, 201, 255, 0.35), transparent 45%),
            #030711;
            color: var(--text);
            min-height: 100vh;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .page {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .max {
            max-width: 1180px;
            margin: 0 auto;
            padding: 0 24px;
        }

        header.nav {
            position: sticky;
            top: 0;
            z-index: 40;
            backdrop-filter: blur(14px);
            background: rgba(3, 7, 17, 0.85);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .nav-content {
            height: 74px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .logo-mark {
            width: 46px;
            height: 46px;
            border-radius: 16px;
            background: linear-gradient(140deg, var(--accent), var(--accent-2), var(--accent-3));
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .logo img {
            height: 200px;
            width: 200px;
            display: block;
        }

        .logo-copy span {
            display: block;
            font-size: 12px;
            color: var(--text-muted);
        }

        .nav-links {
            display: flex;
            gap: 28px;
            font-size: 14px;
            color: var(--text-muted);
        }

        .nav-actions {
            display: flex;
            gap: 12px;
        }

        .btn {
            border: none;
            border-radius: 999px;
            padding: 12px 24px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s ease;
        }

        .btn-outline {
            border: 1px solid rgba(255, 255, 255, 0.15);
            background: transparent;
            color: var(--text);
        }

        .btn-primary {
            background: linear-gradient(130deg, var(--accent), var(--accent-2));
            color: #fff;
            box-shadow: 0 15px 40px rgba(93, 107, 255, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
        }

        /* BLOG STYLES */
        .blog-header {
            padding: 80px 0 40px;
            text-align: center;
        }

        .blog-title {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .blog-sub {
            color: var(--text-muted);
            font-size: 18px;
            max-width: 600px;
            margin: 0 auto;
        }

        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 32px;
            padding: 40px 0 80px;
        }

        .blog-card {
            background: rgba(10, 14, 36, 0.6);
            border-radius: 24px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.06);
            transition: transform .25s ease, box-shadow .25s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .blog-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            border-color: rgba(255, 255, 255, 0.1);
        }

        .blog-img {
            height: 220px;
            background: #1a1f35;
            position: relative;
            overflow: hidden;
        }

        .blog-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .blog-card:hover .blog-img img {
            transform: scale(1.05);
        }

        .blog-content {
            padding: 28px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .blog-date {
            font-size: 13px;
            color: var(--accent-3);
            margin-bottom: 12px;
            font-weight: 500;
            letter-spacing: 0.02em;
        }

        .blog-heading {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 12px;
            line-height: 1.3;
        }

        .blog-excerpt {
            color: var(--text-muted);
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 24px;
            flex: 1;
        }

        .blog-link {
            color: var(--text);
            font-weight: 600;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .blog-link:hover {
            color: var(--accent-3);
        }

        footer { border-top: 1px solid rgba(255,255,255,0.08); padding: 40px 0; margin-top: auto; color: var(--text-muted); }
        .footer-content { display: flex; flex-direction: column; align-items: center; gap: 12px; text-align: center; }
        .footer-content p { margin: 0; }
        .footer-links { display: flex; align-items: center; gap: 12px; font-size: 14px; }
        .footer-links a { color: var(--text-muted); text-decoration: none; transition: color 0.2s; }
        .footer-links a:hover { color: var(--accent-3); }
        .footer-links .separator { color: rgba(255,255,255,0.3); }
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding: 40px 0;
            margin-top: auto;
            text-align: center;
            color: var(--text-muted);
        }
    </style>
</head>
<body>
<div class="page">
    <header class="nav">
        <div class="max nav-content">
            <div class="logo">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('resumizo-logo-white.png') }}"
                         alt="Resumizo Logo"
                         class="h-10 w-auto">
                </a>
            </div>
            <div class="nav-links">
                <a href="{{ url('/') }}#hero">How it works</a>
                <a href="{{ url('/') }}#themes">Themes</a>
                <a href="{{ url('/') }}#about">About</a>
                <a href="{{ url('/') }}#why">Why us</a>
                <a href="{{ route('blog.index') }}">Blog</a>
            </div>
            <div class="nav-actions">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-outline">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline">Log in</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Sign up free</a>
                @endauth
            </div>
        </div>
    </header>

    <main class="max">
        <div class="blog-header">
            <h1 class="blog-title">Latest Updates</h1>
            <p class="blog-sub">Insights, tutorials, and news from the Portfolio Builder team.</p>
        </div>

        <div class="blog-grid">
            @forelse($blogs as $blog)
                <article class="blog-card">
                    <a href="{{ route('blog.show', $blog->slug) }}" class="blog-img">
                        @if($blog->image)
                            <img src="{{ asset('storage/' . $blog->image) }}" 
                                 alt="{{ $blog->title }} - Blog post cover image" 
                                 loading="lazy"
                                 width="400"
                                 height="220">
                        @else
                            <div
                                style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; color:rgba(255,255,255,0.1); font-size:40px;">
                                PB
                            </div>
                        @endif
                    </a>
                    <div class="blog-content">
                        <div class="blog-date">{{ $blog->published_at->format('M d, Y') }}</div>
                        <h2 class="blog-heading">
                            <a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a>
                        </h2>
                        <p class="blog-excerpt">{{ Str::limit($blog->excerpt ?? strip_tags($blog->content), 120) }}</p>
                        <a href="{{ route('blog.show', $blog->slug) }}" class="blog-link">Read Article
                            <span>→</span></a>
                    </div>
                </article>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 60px; color: var(--text-muted);">
                    <p style="font-size: 18px;">No posts found yet.</p>
                </div>
            @endforelse
        </div>
    </main>

    <footer>
        <div class="max">
            <div class="footer-content">
                <p>&copy; 2025 Resumizo. All rights reserved.</p>
                <div class="footer-links">
                    <a href="{{ route('privacy') }}">Privacy Policy</a>
                    <span class="separator">•</span>
                    <a href="{{ route('terms') }}">Terms & Conditions</a>
                </div>
            </div>
        </div>
    </footer>
</div>
</body>
</html>
