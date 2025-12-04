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
    <title>Portfolio Builder & Resume Builder - Resumizo | Create Your Resume Website</title>
    <meta name="title" content="Portfolio Builder & Resume Builder - Resumizo">
    <meta name="description" content="Create your professional portfolio and resume website effortlessly with Resumizo. Build online resumes, showcase your work, and get hired. No coding required.">

    <!-- SEO Meta Tags -->
    <meta name="keywords" content="portfolio builder, resume builder, resume website, online portfolio, professional portfolio, resumizo">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://www.resumizo.com/">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="Portfolio Builder & Resume Builder - Resumizo">
    <meta property="og:description" content="Build your professional portfolio and resume website online with Resumizo. Showcase your work, impress clients, and get hired.">
    <meta property="og:image" content="{{ asset('images/og-home.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Resumizo">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/') }}">
    <meta property="twitter:title" content="Portfolio Builder & Resume Builder - Resumizo">
    <meta property="twitter:description" content="Create your resume website and portfolio online with Resumizo. Showcase your skills, projects, and get hired.">
    <meta property="twitter:image" content="{{ asset('images/og-home.jpg') }}">

    <!-- Favicon / Apple Touch -->
    <link rel="apple-touch-icon" href="{{ asset('resumizo-logo-white.png') }}">

    <!-- Structured Data / JSON-LD for Google -->
    <script type="application/ld+json">
        @php
            $schemas = [
                "@context" => "https://schema.org",
                "@graph" => [
                    // Organization
                    [
                        "@type" => "Organization",
                        "@id" => url('/') . "/#organization",
                        "name" => "Resumizo",
                        "url" => url('/'),
                        "logo" => [
                            "@type" => "ImageObject",
                            "url" => asset('resumizo-logo-white.png')
                        ],
                        "description" => "Professional portfolio and resume builder platform",
                        "sameAs" => [
                            "https://twitter.com/resumizo",
                            "https://facebook.com/resumizo"
                        ]
                    ],
                    // WebSite
                    [
                        "@type" => "WebSite",
                        "@id" => url('/') . "/#website",
                        "url" => url('/'),
                        "name" => "Resumizo",
                        "publisher" => [
                            "@id" => url('/') . "/#organization"
                        ]
                    ],
                    // SoftwareApplication
                    [
                        "@type" => "SoftwareApplication",
                        "name" => "Resumizo Portfolio Builder",
                        "applicationCategory" => "BusinessApplication",
                        "operatingSystem" => "Web",
                        "description" => "Create professional portfolios and resumes online with no coding required. Choose from beautiful templates, customize your content, and export as PDF.",
                        "offers" => [
                            "@type" => "Offer",
                            "price" => "0",
                            "priceCurrency" => "USD"
                        ],
                        "aggregateRating" => [
                            "@type" => "AggregateRating",
                            "ratingValue" => "4.8",
                            "reviewCount" => "1250",
                            "bestRating" => "5",
                            "worstRating" => "1"
                        ]
                    ]
                ]
            ];
        @endphp

        {!! json_encode($schemas, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) !!}
    </script>
</head>



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
        .logo img {
            height: 200px;
            width: 200px;
            display: block;
        }
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
        main section { padding: 30px 0; }
        main h2 { font-size: 36px; margin-bottom: 14px; }
        main p.section-sub { color: var(--text-muted); max-width: 600px; margin-bottom: 36px; }
        /* hero */
        .hero-content { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 48px; align-items: center; }
        .hero-title { font-size: clamp(48px, 6vw, 66px); font-weight: 700; line-height: 1.05; margin-bottom: 18px; }
        .hero-title em { font-style: normal; background: linear-gradient(120deg, var(--accent-3), var(--accent-2)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .hero-sub { font-size: 18px; color: var(--text-muted); margin-bottom: 28px; max-width: 500px; }
        .hero-badges { display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 30px; }
        .badge {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 8px 16px; border-radius: 999px;
            border: 1px solid rgba(255,255,255,0.08);
            background: rgba(255,255,255,0.06); font-size: 13px;
        }
        .badge i { width: 18px; height: 18px; border-radius: 6px; background: rgba(255,255,255,0.18); display: flex; align-items: center; justify-content: center; font-size: 12px; }
        .hero-card {
            background: rgba(9,14,30,0.8); border-radius: 34px; padding: 32px;
            border: 1px solid rgba(255,255,255,0.08); backdrop-filter: blur(18px);
            box-shadow: var(--shadow);
        }
        .hero-card-preview {
            border-radius: 24px; padding: 24px; min-height: 220px;
            border: 1px solid rgba(255,255,255,0.04);
            background:
                radial-gradient(circle at 20% 20%, rgba(255,255,255,0.12), transparent 60%),
                linear-gradient(140deg, rgba(93,107,255,0.35), rgba(156,91,255,0.2));
        }
        .hero-card-stats { margin-top: 24px; display: grid; grid-template-columns: repeat(auto-fit,minmax(120px,1fr)); gap: 18px; }
        .stat { background: rgba(255,255,255,0.05); border-radius: 18px; padding: 16px; border: 1px solid rgba(255,255,255,0.08); }
        .stat span { display: block; font-size: 12px; color: var(--text-muted); letter-spacing: .1em; margin-bottom: 4px; }
        .stat strong { font-size: 22px; }
        /* steps */
        .steps { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 24px; }
        .step-card { background: var(--card); border-radius: var(--radius); padding: 28px; border: 1px solid rgba(255,255,255,0.08); box-shadow: var(--shadow); }
        .step-number { width: 46px; height: 46px; border-radius: 50%; border: 1px solid rgba(255,255,255,0.12); display: flex; align-items: center; justify-content: center; font-weight: 600; margin-bottom: 12px; }
        .step-icon { width: 56px; height: 56px; border-radius: 18px; background: rgba(93,107,255,0.16); display: flex; align-items: center; justify-content: center; font-size: 22px; margin-bottom: 16px; }
        .step-card p { color: var(--text-muted); margin: 0; }
        /* themes */
        .themes-grid { display: grid; grid-template-columns: 1fr; gap: 24px; }
        @media (min-width: 640px) {
            .themes-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (min-width: 1024px) {
            .themes-grid { grid-template-columns: repeat(3, 1fr); }
        }
        .theme-card { background: rgba(10,14,36,0.75); border-radius: 30px; padding: 26px; border: 1px solid rgba(255,255,255,0.06); transition: transform .25s ease, box-shadow .25s ease; }
        .theme-card:hover { transform: translateY(-6px); box-shadow: 0 25px 60px rgba(3,7,18,0.7); }
        .theme-preview { height: 180px; border-radius: 20px; border: 1px solid rgba(255,255,255,0.05); background: #0b132c; display: flex; align-items: center; justify-content: center; color: var(--text-muted); margin-bottom: 18px; overflow: hidden; }
        .theme-preview img { width: 100%; height: 100%; object-fit: contain; }
        .theme-actions { display: flex; gap: 12px; margin-top: 18px; }
        .pill { flex: 1; border-radius: 999px; padding: 10px 0; text-align: center; border: 1px solid rgba(255,255,255,0.15); font-weight: 400; font-size: 14px; }
        .pill.primary { border: none; background: linear-gradient(120deg, var(--accent), var(--accent-2)); color: #fff; }
        /* about */
        .about { background: radial-gradient(circle at 20% 20%, rgba(93,107,255,0.12), transparent 60%); border-radius: 42px; padding: 60px; border: 1px solid rgba(255,255,255,0.05); box-shadow: var(--shadow); }
        .about-content { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 40px; align-items: center; }
        .point { display: flex; gap: 14px; }
        .point-icon { width: 42px; height: 42px; border-radius: 16px; background: rgba(255,255,255,0.08); display: flex; align-items: center; justify-content: center; }
        .stats-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 16px; margin-top: 26px; }
        .about-card { background: rgba(8,12,24,0.8); border-radius: 26px; padding: 28px; border: 1px solid rgba(255,255,255,0.06); text-align: center; }
        /* why */
        .why-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 26px; }
        .why-card { background: var(--card); border-radius: 28px; padding: 32px; border: 1px solid rgba(255,255,255,0.05); box-shadow: var(--shadow); }
        .why-card ul { list-style: none; padding: 0; margin: 0; display: grid; gap: 12px; color: var(--text-muted); }
        /* contact */
        .contact-container { max-width: 900px; margin: 0 auto; }
        .contact-info-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 40px; }
        .contact-info-card { background: rgba(10,14,36,0.6); border-radius: 20px; padding: 24px; border: 1px solid rgba(255,255,255,0.06); text-align: center; }
        .contact-icon { font-size: 36px; margin-bottom: 12px; }
        .contact-info-card h3 { font-size: 18px; font-weight: 600; margin-bottom: 8px; color: var(--text); }
        .contact-info-card p { font-size: 14px; color: var(--text-muted); margin: 0; }
        .contact-form-wrapper { background: rgba(10,14,36,0.6); border-radius: 28px; padding: 40px; border: 1px solid rgba(255,255,255,0.06); box-shadow: var(--shadow); }
        .contact-form { display: flex; flex-direction: column; gap: 24px; }
        .form-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 24px; }
        .form-group { display: flex; flex-direction: column; gap: 8px; }
        .form-group label { font-size: 14px; font-weight: 600; color: var(--text); }
        .form-group input,
        .form-group select,
        .form-group textarea { 
            padding: 14px 18px; border-radius: 14px; border: 1px solid rgba(255,255,255,0.1);
            background: rgba(255,255,255,0.05); color: var(--text); font-size: 15px;
            font-family: inherit; transition: all 0.2s;
        }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none; border-color: var(--accent); background: rgba(255,255,255,0.08);
        }
        .form-group textarea { resize: vertical; min-height: 120px; }
        .alert { padding: 16px 20px; border-radius: 14px; margin-bottom: 24px; display: flex; align-items: flex-start; gap: 12px; }
        .alert svg { flex-shrink: 0; margin-top: 2px; }
        .alert ul { margin: 0; padding-left: 20px; }
        .alert li { margin-bottom: 4px; }
        .alert-success { background: rgba(49,201,255,0.15); border: 1px solid rgba(49,201,255,0.3); color: var(--accent-3); }
        .alert-error { background: rgba(255,91,91,0.15); border: 1px solid rgba(255,91,91,0.3); color: #ff9b9b; }
        footer { border-top: 1px solid rgba(255,255,255,0.08); padding: 40px 0; margin-top: 60px; color: var(--text-muted); }
        .footer-content { display: flex; flex-direction: column; align-items: center; gap: 12px; text-align: center; }
        .footer-content p { margin: 0; }
        .footer-links { display: flex; align-items: center; gap: 12px; font-size: 14px; }
        .footer-links a { color: var(--text-muted); text-decoration: none; transition: color 0.2s; }
        .footer-links a:hover { color: var(--accent-3); }
        .footer-links .separator { color: rgba(255,255,255,0.3); }
        @media (max-width: 640px) {
            .nav-content {
                /* flex-direction: column;  Removed to keep row layout for logo + burger */
                height: 74px; /* Restore height */
                padding: 0 24px; /* Restore padding */
            }
            .about { padding: 36px; }
            .hero-card { padding: 22px; }

            /* Mobile Menu Styles */
            .mobile-menu-btn {
                display: block;
                background: none;
                border: none;
                color: var(--text);
                cursor: pointer;
                padding: 8px;
            }
            .mobile-menu-container {
                display: none;
                position: absolute;
                top: 74px;
                left: 0;
                width: 100%;
                background: rgba(3,7,17,0.98);
                backdrop-filter: blur(20px);
                padding: 24px;
                border-bottom: 1px solid rgba(255,255,255,0.08);
                flex-direction: column;
                gap: 24px;
                box-shadow: 0 20px 40px rgba(0,0,0,0.4);
            }
            .mobile-menu-container.active {
                display: flex;
            }
            .nav-links {
                flex-direction: column;
                align-items: center;
                gap: 20px;
                font-size: 16px;
            }
            .nav-actions {
                flex-direction: column;
                width: 100%;
                gap: 16px;
            }
            .nav-actions .btn {
                width: 100%;
                text-align: center;
                justify-content: center;
            }
        }
        @media (min-width: 641px) {
            .mobile-menu-btn { display: none; }
            .mobile-menu-container {
                display: contents; /* Allows children to participate in parent flex layout */
            }
        }
    </style>
</head>
<body>
@php
    // dynamic templates count for hero stats
    $templatesCount = isset($themes) ? $themes->count() : 5;
@endphp
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

            {{-- Mobile Menu Button --}}
            <button id="mobile-menu-btn" class="mobile-menu-btn" aria-label="Toggle menu">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>

            {{-- Mobile Menu Container --}}
            <div id="mobile-menu" class="mobile-menu-container">
                <nav class="nav-links">
                    <a href="#hero">How it works</a>
                    <a href="#themes">Themes</a>
                    <a href="#about">About</a>
                    <a href="#why">Why us</a>
                    <a href="{{ route('blog.index') }}">Blog</a>
                    <a href="#contact">Contact</a>
                </nav>
                <div class="nav-actions">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-outline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline">Log in</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Sign up free</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');

            if (menuBtn && mobileMenu) {
                menuBtn.addEventListener('click', function() {
                    mobileMenu.classList.toggle('active');
                });

                // Close menu when clicking a link
                const links = mobileMenu.querySelectorAll('a');
                links.forEach(link => {
                    link.addEventListener('click', () => {
                        mobileMenu.classList.remove('active');
                    });
                });
            }
        });
    </script>

    <main>
        <section class="hero" id="hero">
            <div class="max hero-content">
                <div>
                    <p class="badge" style="background: rgba(49,201,255,0.12); border: 1px solid rgba(49,201,255,0.25); margin-bottom: 18px;">
                        <i>★</i>Build portfolio in minutes • Export as PDF
                    </p>
                    <h1 class="hero-title">
                        Create a <em>professional portfolio</em> without touching code.
                    </h1>
                    <p class="hero-sub">
                        Pick a polished template, drop in your story, and publish a web + PDF portfolio that recruiters love.
                    </p>
                    <div class="hero-badges">
                        <span class="badge"><i>∞</i>Unlimited edits</span>
                        <span class="badge"><i>⚡</i>No-code builder</span>
                        <span class="badge"><i>⬇︎</i>One-click PDF</span>
                    </div>
                    <div class="nav-actions" style="margin-top: 8px;">
                        <a href="#themes" class="btn btn-primary">Choose your theme</a>
                        <a href="{{ route('register') }}" class="btn btn-outline">Create free account</a>
                    </div>
                </div>

                <div class="hero-card">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">
                        <span style="color:var(--text-muted); font-size:14px;">Portfolio preview</span>
                        <span class="badge" style="font-size:12px;">PDF ready</span>
                    </div>
                    <div class="hero-card-preview">
                        <h4>Your Name</h4>
                        <p style="color:var(--text-muted); margin-top:6px;">Product Designer · Remote ready</p>
                        <div style="margin-top:32px; display:flex; gap:12px; flex-wrap:wrap;">
                            <span class="badge" style="background:rgba(81,108,255,0.25);">Live site</span>
                            <span class="badge" style="background:rgba(165,91,255,0.2);">PDF export</span>
                            <span class="badge" style="background:rgba(49,201,255,0.2);">Modern themes</span>
                        </div>
                    </div>
                    <div class="hero-card-stats">
                        <div class="stat">
                            <span>Users</span>
                            <strong>12K+</strong>
                        </div>
                        <div class="stat">
                            <span>Templates</span>
                            <strong>{{ str_pad($templatesCount, 2, '0', STR_PAD_LEFT) }}</strong>
                        </div>
                        <div class="stat">
                            <span>Exports</span>
                            <strong>48K</strong>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="how">
            <div class="max">
                <h2>How it works</h2>
                <p class="section-sub">Three steps and you’re portfolio-ready. Students, freshers, freelancers — anyone can launch.</p>
                <div class="steps">
                    <div class="step-card">
                        <div class="step-number">01</div>
                        <div class="step-icon">🧩</div>
                        <h3>Pick a premium template</h3>
                        <p>Choose from clean, PDF-friendly layouts that suit freshers, designers, or tech talent.</p>
                    </div>
                    <div class="step-card">
                        <div class="step-number">02</div>
                        <div class="step-icon">✏️</div>
                        <h3>Log in & drop your story</h3>
                        <p>Simple sections for about, skills, projects, goals, links — no complicated forms.</p>
                    </div>
                    <div class="step-card">
                        <div class="step-number">03</div>
                        <div class="step-icon">🚀</div>
                        <h3>Publish & export</h3>
                        <p>Share a live portfolio link and download a matching PDF whenever you update.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="themes">
            <div class="max">
                <h2>Choose your theme</h2>
                <p class="section-sub">All templates stay in sync: switch anytime, keep content intact.</p>

                @if(isset($themes) && $themes->count())
                    <div class="themes-grid">
                        @foreach($themes as $theme)
                            @php
                                $preview = $theme->preview_image;
                                if ($preview) {
                                    $isUrl = filter_var($preview, FILTER_VALIDATE_URL);
                                    $previewUrl = $isUrl ? $preview : asset('storage/' . $preview);
                                } else {
                                    $previewUrl = 'https://colorlib.com/wp/wp-content/uploads/sites/2/rezume-free-template-353x278.jpg.avif';
                                }
                            @endphp

                            <article class="theme-card">
                                <a href="{{ route('preview.theme', $theme->id) }}" target="_blank">
                                    <div class="theme-preview">
                                        <img src="{{ $previewUrl }}" 
                                             alt="{{ $theme->name }} - Professional portfolio template preview" 
                                             loading="lazy"
                                             width="400"
                                             height="300">
                                    </div>
                                </a>
                                <h4>{{ $theme->name }}</h4>
                                <span style="color:var(--text-muted); font-size:13px;">
                                    {{ $theme->description ?? 'A clean, modern portfolio layout.' }}
                                </span>

                                <div class="theme-actions">
                                    {{-- Preview button --}}
                                    <a class="pill" href="{{ route('preview.theme', $theme->id) }}" target="_blank">
                                        Preview
                                    </a>

                                    {{-- Use / Get started with this theme --}}
                                    @auth
                                        <form method="GET" action="{{ route('select.theme', $theme->id) }}" style="flex:1;">
                                            @csrf
                                            <button type="submit" class="pill primary" style="width:100%; cursor:pointer;">
                                                Use this theme
                                            </button>
                                        </form>
                                    @else
                                        <a class="pill primary" href="{{ route('select.theme', $theme->id) }}">
                                            Get started
                                        </a>
                                    @endauth
                                </div>
                            </article>
                        @endforeach
                    </div>
                @else
                    <p class="section-sub">No themes are available yet. Please check back soon — new layouts are coming.</p>
                @endif
            </div>
        </section>

        <section id="about">
            <div class="max about">
                <div class="about-content">
                    <div>
                        <h2>About Portfolio Builder</h2>
                        <p class="section-sub">Designed for people who want a polished presence without hiring designers or writing code.</p>
                        <div style="display:grid; gap:18px;">
                            <div class="point">
                                <div class="point-icon">💡</div>
                                <div>
                                    <strong>Template driven</strong>
                                    <p style="margin:6px 0 0; color:var(--text-muted);">Modern layouts optimized for PDF + responsive web.</p>
                                </div>
                            </div>
                            <div class="point">
                                <div class="point-icon">🧭</div>
                                <div>
                                    <strong>Switch anytime</strong>
                                    <p style="margin:6px 0 0; color:var(--text-muted);">Update once, publish everywhere. Theme switch keeps your content aligned.</p>
                                </div>
                            </div>
                            <div class="point">
                                <div class="point-icon">📄</div>
                                <div>
                                    <strong>Perfect for job hunts</strong>
                                    <p style="margin:6px 0 0; color:var(--text-muted);">Share a live link in emails, export PDF for HR, keep both in sync.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="about-card">
                            <h3>Ship once, reuse everywhere.</h3>
                            <p style="color:var(--text-muted); margin-bottom: 20px;">Live site, downloadable PDF, and LinkedIn-ready content.</p>
                            <div class="stats-row">
                                <div>
                                    <span style="color:var(--text-muted); font-size:12px;">Live portfolios</span>
                                    <strong style="display:block; font-size:28px;">24k</strong>
                                </div>
                                <div>
                                    <span style="color:var(--text-muted); font-size:12px;">Avg. build time</span>
                                    <strong style="display:block; font-size:28px;">12 min</strong>
                                </div>
                            </div>
                            <br>
                            <a href="{{ route('register') }}" class="btn btn-primary" style="margin-top:28px; width:100%; text-align:center;">Start your free portfolio</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="why">
            <div class="max">
                <h2>Why people like using it</h2>
                <p class="section-sub">Straightforward steps, recruiter-friendly exports, no hidden paywalls.</p>
                <div class="why-grid">
                    <div class="why-card">
                        <h3>Designed for clarity</h3>
                        <ul>
                            <li>✅ No complicated settings — just the fields recruiters expect.</li>
                            <li>✅ Modern typography & spacing tuned for both screen and PDF.</li>
                            <li>✅ Theme styles handle the polish; you focus on content.</li>
                        </ul>
                    </div>
                    <div class="why-card">
                        <h3>Built for speed</h3>
                        <ul>
                            <li>⚡ Live preview updates instantly.</li>
                            <li>⚡ One-click PDF export for every theme.</li>
                            <li>⚡ Keep everything in sync across devices.</li>
                        </ul>
                    </div>
                    <div class="why-card">
                        <h3>Ready to hire</h3>
                        <p style="color:var(--text-muted); margin-bottom: 20px;">Land interviews with a link recruiters can skim faster than a resume.</p>
                        <a href="{{ route('register') }}" class="btn btn-primary" style="width:100%;">Start your free portfolio</a>
                        <p style="color:var(--text-muted); font-size:12px; margin-top:18px;">No credit card · switch themes anytime · PDF friendly</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="contact">
            <div class="max">
                <h2>Get in Touch</h2>
                <p class="section-sub">Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
                
                <div class="contact-container">
                    <div class="contact-info-grid">
                        <div class="contact-info-card">
                            <div class="contact-icon">📧</div>
                            <h3>Email Us</h3>
                            <p>support@resumizo.com</p>
                        </div>
                        <div class="contact-info-card">
                            <div class="contact-icon">💬</div>
                            <h3>Live Chat</h3>
                            <p>Available Mon-Fri, 9am-5pm EST</p>
                        </div>
                        <div class="contact-info-card">
                            <div class="contact-icon">📚</div>
                            <h3>Help Center</h3>
                            <p>Browse our documentation</p>
                        </div>
                    </div>

                    <div class="contact-form-wrapper">
                        @if(session('success'))
                            <div class="alert alert-success">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-error">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('contact.submit') }}" method="POST" class="contact-form">
                            @csrf
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="name">Name *</label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Your full name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="your@email.com">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject *</label>
                                <select id="subject" name="subject" required>
                                    <option value="">Select a topic</option>
                                    <option value="general" {{ old('subject') == 'general' ? 'selected' : '' }}>General Inquiry</option>
                                    <option value="support" {{ old('subject') == 'support' ? 'selected' : '' }}>Technical Support</option>
                                    <option value="billing" {{ old('subject') == 'billing' ? 'selected' : '' }}>Billing Question</option>
                                    <option value="feature" {{ old('subject') == 'feature' ? 'selected' : '' }}>Feature Request</option>
                                    <option value="bug" {{ old('subject') == 'bug' ? 'selected' : '' }}>Report a Bug</option>
                                    <option value="other" {{ old('subject') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="message">Message *</label>
                                <textarea id="message" name="message" rows="5" required placeholder="How can we help you?">{{ old('message') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" style="width: 100%;">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
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
