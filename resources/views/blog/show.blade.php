<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="{{ asset('resumizo-logo-white.png') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Preconnect for performance --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">

    <!-- Primary Meta Tags -->
    <title>{{ $blog->title }} - Portfolio Builder | Resumizo</title>
    <meta name="title" content="{{ $blog->title }} - Portfolio Builder | Resumizo">
    <meta name="description" content="{{ Str::limit(strip_tags($blog->excerpt ?? $blog->content), 160) }}">
    <meta name="keywords" content="portfolio builder blog, {{ $blog->tags ?? '' }}, online portfolio, freelancer portfolio, resumizo">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $blog->title }} - Portfolio Builder | Resumizo">
    <meta property="og:description" content="{{ Str::limit(strip_tags($blog->excerpt ?? $blog->content), 160) }}">
    <meta property="og:image" content="{{ $blog->image ? asset('storage/' . $blog->image) : asset('images/og-blog.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Resumizo">
    <meta property="article:published_time" content="{{ $blog->published_at->toIso8601String() }}">
    <meta property="article:modified_time" content="{{ $blog->updated_at->toIso8601String() }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $blog->title }} - Portfolio Builder | Resumizo">
    <meta property="twitter:description" content="{{ Str::limit(strip_tags($blog->excerpt ?? $blog->content), 160) }}">
    <meta property="twitter:image" content="{{ $blog->image ? asset('storage/' . $blog->image) : asset('images/og-blog.jpg') }}">

    <!-- Favicon / Apple Touch -->
    <link rel="apple-touch-icon" href="{{ asset('resumizo-logo-white.png') }}">

    <!-- Structured Data / JSON-LD for Google -->
    <script type="application/ld+json">
        @php
            $jsonLd = [
                "@context" => "https://schema.org",
                "@type" => "BlogPosting",
                "headline" => $blog->title,
                "image" => [
                    "@type" => "ImageObject",
                    "url" => $blog->image ? asset('storage/' . $blog->image) : asset('images/og-blog.jpg'),
                    "width" => 1200,
                    "height" => 630
                ],
                "author" => [
                    "@type" => "Person",
                    "name" => $blog->user->name ?? 'Resumizo Team'
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
                "description" => Str::limit(strip_tags($blog->excerpt ?? $blog->content), 160),
                "articleBody" => strip_tags($blog->content),
                "wordCount" => str_word_count(strip_tags($blog->content)),
                "mainEntityOfPage" => [
                    "@type" => "WebPage",
                    "@id" => url()->current()
                ]
            ];
        @endphp

        {!! json_encode($jsonLd, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) !!}
    </script>


    @vite(['resources/js/app.js'])
    <style>
        :root {
            --bg: #050914;
            --card: rgba(8,12,26,0.9);
            --text: #f3f6ff;
            --text-muted: rgba(243,246,255,0.7);
            --accent: #5d6bff;
            --accent-2: #9c5bff;
            --accent-3: #31c9ff;
            --radius: 28px;
            --shadow: 0 32px 70px rgba(2,6,23,0.55);
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background:
                radial-gradient(circle at 15% -20%, rgba(134,118,255,0.4), transparent 45%),
                radial-gradient(circle at 85% -10%, rgba(49,201,255,0.35), transparent 45%),
                #030711;
            color: var(--text);
            min-height: 100vh;
        }
        a { color: inherit; text-decoration: none; }
        .page { min-height: 100vh; display: flex; flex-direction: column; }
        .max { max-width: 1180px; margin: 0 auto; padding: 0 24px; }
        header.nav {
            position: sticky; top: 0; z-index: 40;
            backdrop-filter: blur(14px);
            background: rgba(3,7,17,0.85);
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .nav-content { height: 74px; display: flex; align-items: center; justify-content: space-between; }
        .logo { display: flex; align-items: center; gap: 14px; }
        .logo-mark {
            width: 46px; height: 46px; border-radius: 16px;
            background: linear-gradient(140deg, var(--accent), var(--accent-2), var(--accent-3));
            display: flex; align-items: center; justify-content: center;
            font-weight: 700;
        }
        .logo img { height: 200px; width: 200px; display: block; }
        .logo-copy span { display: block; font-size: 12px; color: var(--text-muted); }
        .nav-links { display: flex; gap: 28px; font-size: 14px; color: var(--text-muted); }
        .nav-actions { display: flex; gap: 12px; }
        .btn {
            border: none; border-radius: 999px;
            padding: 12px 24px; font-size: 14px;
            font-weight: 600; cursor: pointer; transition: all .2s ease;
        }
        .btn-outline { border: 1px solid rgba(255,255,255,0.15); background: transparent; color: var(--text); }
        .btn-primary {
            background: linear-gradient(130deg, var(--accent), var(--accent-2));
            color: #fff; box-shadow: 0 15px 40px rgba(93,107,255,0.4);
        }
        .btn-primary:hover { transform: translateY(-2px); }

        /* ARTICLE STYLES */
        .article-container { max-width: 800px; margin: 0 auto; padding: 60px 24px; }
        .article-header { text-align: center; margin-bottom: 40px; }
        .article-meta { color: var(--accent-3); font-size: 14px; font-weight: 500; margin-bottom: 16px; letter-spacing: 0.05em; text-transform: uppercase; }
        .article-title { font-size: clamp(32px, 5vw, 48px); font-weight: 700; line-height: 1.1; margin-bottom: 24px; }
        .article-img { width: 100%; border-radius: 24px; margin-bottom: 40px; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 20px 50px rgba(0,0,0,0.3); }

        .article-content { font-size: 18px; line-height: 1.8; color: rgba(243,246,255,0.85); }
        .article-content p { margin-bottom: 24px; }
        .article-content h2 { font-size: 28px; color: #fff; margin: 48px 0 20px; }
        .article-content h3 { font-size: 22px; color: #fff; margin: 32px 0 16px; }
        .article-content ul, .article-content ol { margin-bottom: 24px; padding-left: 24px; }
        .article-content li { margin-bottom: 8px; }

        .back-link { display: inline-flex; align-items: center; gap: 8px; color: var(--text-muted); margin-top: 60px; font-weight: 500; transition: color .2s; }
        .back-link:hover { color: var(--accent-3); }

        footer { border-top: 1px solid rgba(255,255,255,0.08); padding: 40px 0; margin-top: auto; color: var(--text-muted); }
        .footer-content { display: flex; flex-direction: column; align-items: center; gap: 12px; text-align: center; }
        .footer-content p { margin: 0; }
        .footer-links { display: flex; align-items: center; gap: 12px; font-size: 14px; }
        .footer-links a { color: var(--text-muted); text-decoration: none; transition: color 0.2s; }
        .footer-links a:hover { color: var(--accent-3); }
        .footer-links .separator { color: rgba(255,255,255,0.3); }
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

        <main class="article-container">
            <header class="article-header">
                <div class="article-meta">
                    {{ $blog->published_at->format('F d, Y') }}
                </div>
                <h1 class="article-title">{{ $blog->title }}</h1>
            </header>

            @if($blog->image)
                <img src="{{ asset('storage/' . $blog->image) }}" 
                     alt="{{ $blog->title }} - Featured image" 
                     class="article-img"
                     loading="eager"
                     width="800"
                     height="450">
            @endif

            <div class="article-content">
                {!! $blog->content !!}
            </div>

            <style>
                /* Rich Text Styles for CKEditor Content */
                .article-content h1, .article-content h2, .article-content h3, .article-content h4 {
                    color: #fff;
                    margin-top: 2em;
                    margin-bottom: 0.75em;
                    font-weight: 700;
                    line-height: 1.3;
                }
                .article-content h2 { font-size: 1.75rem; }
                .article-content h3 { font-size: 1.5rem; }
                .article-content p { margin-bottom: 1.5em; line-height: 1.8; }
                .article-content ul, .article-content ol {
                    margin-bottom: 1.5em;
                    padding-left: 1.5em;
                    color: rgba(243,246,255,0.9);
                }
                .article-content ul { list-style-type: disc; }
                .article-content ol { list-style-type: decimal; }
                .article-content li { margin-bottom: 0.5em; }
                .article-content blockquote {
                    border-left: 4px solid var(--accent);
                    padding-left: 1em;
                    margin-left: 0;
                    margin-bottom: 1.5em;
                    font-style: italic;
                    color: var(--text-muted);
                }
                .article-content a { color: var(--accent-3); text-decoration: underline; }
                .article-content img {
                    max-width: 100%;
                    height: auto;
                    border-radius: 12px;
                    margin: 2em 0;
                }
            </style>

            <a href="{{ route('blog.index') }}" class="back-link">← Back to Blog</a>
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
