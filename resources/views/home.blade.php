{{--<!DOCTYPE html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--    <title>Portfolio Builder - Create Your Portfolio</title>--}}

{{--    --}}{{-- keep your vite if you want, but design works with only this CSS too --}}
{{--    @vite(['resources/js/app.js'])--}}

{{--    <style>--}}
{{--        :root {--}}
{{--            --primary: #4f46e5;--}}
{{--            --primary-dark: #4338ca;--}}
{{--            --accent: #06b6d4;--}}
{{--            --bg: #f4f5fb;--}}
{{--            --text-main: #111827;--}}
{{--            --text-muted: #6b7280;--}}
{{--            --card-bg: #ffffff;--}}
{{--            --radius-lg: 18px;--}}
{{--            --shadow-soft: 0 18px 40px rgba(15, 23, 42, 0.08);--}}
{{--        }--}}

{{--        * {--}}
{{--            box-sizing: border-box;--}}
{{--        }--}}

{{--        body {--}}
{{--            margin: 0;--}}
{{--            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;--}}
{{--            background: var(--bg);--}}
{{--            color: var(--text-main);--}}
{{--        }--}}

{{--        a {--}}
{{--            text-decoration: none;--}}
{{--            color: inherit;--}}
{{--        }--}}

{{--        .page {--}}
{{--            min-height: 100vh;--}}
{{--            display: flex;--}}
{{--            flex-direction: column;--}}
{{--        }--}}

{{--        /* NAVBAR */--}}
{{--        .navbar {--}}
{{--            position: sticky;--}}
{{--            top: 0;--}}
{{--            z-index: 50;--}}
{{--            background: rgba(255, 255, 255, 0.92);--}}
{{--            backdrop-filter: blur(10px);--}}
{{--            border-bottom: 1px solid #e5e7eb;--}}
{{--        }--}}

{{--        .navbar-inner {--}}
{{--            max-width: 1120px;--}}
{{--            margin: 0 auto;--}}
{{--            padding: 0 16px;--}}
{{--            height: 64px;--}}
{{--            display: flex;--}}
{{--            align-items: center;--}}
{{--            justify-content: space-between;--}}
{{--        }--}}

{{--        .brand {--}}
{{--            display: flex;--}}
{{--            align-items: center;--}}
{{--            gap: 10px;--}}
{{--        }--}}

{{--        .brand-logo {--}}
{{--            width: 34px;--}}
{{--            height: 34px;--}}
{{--            border-radius: 12px;--}}
{{--            background: linear-gradient(135deg, #4f46e5, #a855f7, #06b6d4);--}}
{{--            display: flex;--}}
{{--            align-items: center;--}}
{{--            justify-content: center;--}}
{{--            color: #fff;--}}
{{--            font-weight: 800;--}}
{{--            font-size: 16px;--}}
{{--        }--}}

{{--        .brand-text-title {--}}
{{--            font-size: 18px;--}}
{{--            font-weight: 700;--}}
{{--        }--}}

{{--        .brand-text-sub {--}}
{{--            font-size: 11px;--}}
{{--            color: var(--text-muted);--}}
{{--        }--}}

{{--        .nav-links {--}}
{{--            display: flex;--}}
{{--            align-items: center;--}}
{{--            gap: 18px;--}}
{{--            font-size: 14px;--}}
{{--        }--}}

{{--        .nav-link {--}}
{{--            color: #374151;--}}
{{--        }--}}

{{--        .nav-link:hover {--}}
{{--            color: var(--primary);--}}
{{--        }--}}

{{--        .btn-pill {--}}
{{--            padding: 8px 16px;--}}
{{--            border-radius: 999px;--}}
{{--            font-size: 13px;--}}
{{--            border: none;--}}
{{--            cursor: pointer;--}}
{{--            display: inline-flex;--}}
{{--            align-items: center;--}}
{{--            justify-content: center;--}}
{{--            gap: 6px;--}}
{{--            font-weight: 500;--}}
{{--        }--}}

{{--        .btn-outline {--}}
{{--            border: 1px solid #d1d5db;--}}
{{--            background: #ffffff;--}}
{{--            color: #374151;--}}
{{--        }--}}

{{--        .btn-outline:hover {--}}
{{--            background: #f3f4f6;--}}
{{--        }--}}

{{--        .btn-primary {--}}
{{--            background: var(--primary);--}}
{{--            color: #ffffff;--}}
{{--            box-shadow: 0 10px 25px rgba(79, 70, 229, 0.35);--}}
{{--        }--}}

{{--        .btn-primary:hover {--}}
{{--            background: var(--primary-dark);--}}
{{--        }--}}

{{--        /* HERO */--}}
{{--        .hero {--}}
{{--            background: radial-gradient(circle at top left, #a855f7 0, transparent 55%),--}}
{{--            radial-gradient(circle at top right, #06b6d4 0, transparent 55%),--}}
{{--            radial-gradient(circle at bottom, #4f46e5 0, transparent 60%),--}}
{{--            #111827;--}}
{{--            color: #fff;--}}
{{--            padding: 48px 16px 60px;--}}
{{--        }--}}

{{--        .hero-inner {--}}
{{--            max-width: 1120px;--}}
{{--            margin: 0 auto;--}}
{{--            display: grid;--}}
{{--            grid-template-columns: minmax(0, 1.1fr) minmax(0, 1fr);--}}
{{--            gap: 40px;--}}
{{--            align-items: center;--}}
{{--        }--}}

{{--        @media (max-width: 900px) {--}}
{{--            .hero-inner {--}}
{{--                grid-template-columns: minmax(0, 1fr);--}}
{{--            }--}}
{{--        }--}}

{{--        .hero-tag {--}}
{{--            display: inline-flex;--}}
{{--            align-items: center;--}}
{{--            gap: 8px;--}}
{{--            padding: 4px 10px;--}}
{{--            border-radius: 999px;--}}
{{--            border: 1px solid rgba(255, 255, 255, 0.3);--}}
{{--            background: rgba(15, 23, 42, 0.45);--}}
{{--            font-size: 11px;--}}
{{--            margin-bottom: 14px;--}}
{{--        }--}}

{{--        .hero-title {--}}
{{--            font-size: clamp(26px, 4vw, 36px);--}}
{{--            line-height: 1.15;--}}
{{--            font-weight: 800;--}}
{{--            margin-bottom: 10px;--}}
{{--        }--}}

{{--        .hero-sub {--}}
{{--            font-size: 14px;--}}
{{--            color: #e5e7eb;--}}
{{--            max-width: 450px;--}}
{{--            margin-bottom: 18px;--}}
{{--        }--}}

{{--        .hero-sub strong {--}}
{{--            font-weight: 700;--}}
{{--        }--}}

{{--        .hero-steps {--}}
{{--            display: flex;--}}
{{--            flex-wrap: wrap;--}}
{{--            gap: 10px 18px;--}}
{{--            font-size: 12px;--}}
{{--            color: #e5e7eb;--}}
{{--            margin-top: 18px;--}}
{{--        }--}}

{{--        .hero-steps span {--}}
{{--            display: inline-flex;--}}
{{--            align-items: center;--}}
{{--            gap: 6px;--}}
{{--        }--}}

{{--        .hero-steps strong {--}}
{{--            color: #fff;--}}
{{--        }--}}

{{--        .hero-actions {--}}
{{--            display: flex;--}}
{{--            flex-wrap: wrap;--}}
{{--            gap: 10px;--}}
{{--            margin-top: 10px;--}}
{{--        }--}}

{{--        /* HERO PREVIEW */--}}
{{--        .hero-preview-card {--}}
{{--            background: #f9fafb;--}}
{{--            border-radius: 22px;--}}
{{--            padding: 16px;--}}
{{--            box-shadow: var(--shadow-soft);--}}
{{--            border: 1px solid #e5e7eb;--}}
{{--        }--}}

{{--        .browser-dots {--}}
{{--            display: flex;--}}
{{--            gap: 6px;--}}
{{--            margin-bottom: 10px;--}}
{{--        }--}}

{{--        .browser-dot {--}}
{{--            width: 9px;--}}
{{--            height: 9px;--}}
{{--            border-radius: 999px;--}}
{{--        }--}}

{{--        .browser-dot.red { background: #f97373; }--}}
{{--        .browser-dot.amber { background: #fbbf24; }--}}
{{--        .browser-dot.green { background: #34d399; }--}}

{{--        .preview-banner {--}}
{{--            height: 150px;--}}
{{--            border-radius: 16px;--}}
{{--            background: linear-gradient(135deg, #4f46e5, #a855f7, #06b6d4);--}}
{{--            display: flex;--}}
{{--            align-items: center;--}}
{{--            justify-content: center;--}}
{{--            color: #f9fafb;--}}
{{--            font-weight: 700;--}}
{{--            font-size: 16px;--}}
{{--            margin-bottom: 10px;--}}
{{--        }--}}

{{--        .preview-body {--}}
{{--            padding: 8px 2px 0;--}}
{{--        }--}}

{{--        .preview-user {--}}
{{--            display: flex;--}}
{{--            align-items: center;--}}
{{--            gap: 10px;--}}
{{--            margin-bottom: 6px;--}}
{{--        }--}}

{{--        .preview-avatar {--}}
{{--            width: 34px;--}}
{{--            height: 34px;--}}
{{--            border-radius: 999px;--}}
{{--            background: linear-gradient(135deg, #06b6d4, #4f46e5);--}}
{{--        }--}}

{{--        .preview-user-name {--}}
{{--            font-size: 14px;--}}
{{--            font-weight: 600;--}}
{{--        }--}}

{{--        .preview-user-role {--}}
{{--            font-size: 11px;--}}
{{--            color: #6b7280;--}}
{{--        }--}}

{{--        .preview-text {--}}
{{--            font-size: 11px;--}}
{{--            color: #4b5563;--}}
{{--            margin-top: 4px;--}}
{{--        }--}}

{{--        .preview-badges {--}}
{{--            display: grid;--}}
{{--            grid-template-columns: repeat(3, minmax(0, 1fr));--}}
{{--            gap: 8px;--}}
{{--            margin-top: 10px;--}}
{{--        }--}}

{{--        .preview-badge {--}}
{{--            padding: 8px;--}}
{{--            border-radius: 10px;--}}
{{--            font-size: 10px;--}}
{{--            line-height: 1.3;--}}
{{--        }--}}

{{--        .badge-blue {--}}
{{--            background: #e0e7ff;--}}
{{--            color: #1d4ed8;--}}
{{--        }--}}
{{--        .badge-purple {--}}
{{--            background: #f3e8ff;--}}
{{--            color: #7c3aed;--}}
{{--        }--}}
{{--        .badge-green {--}}
{{--            background: #dcfce7;--}}
{{--            color: #15803d;--}}
{{--        }--}}

{{--        /* SECTIONS */--}}
{{--        .section {--}}
{{--            padding: 40px 16px;--}}
{{--        }--}}

{{--        .section-inner {--}}
{{--            max-width: 1120px;--}}
{{--            margin: 0 auto;--}}
{{--        }--}}

{{--        .section-header {--}}
{{--            text-align: center;--}}
{{--            margin-bottom: 28px;--}}
{{--        }--}}

{{--        .section-title {--}}
{{--            font-size: 24px;--}}
{{--            font-weight: 700;--}}
{{--            margin-bottom: 6px;--}}
{{--        }--}}

{{--        .section-sub {--}}
{{--            font-size: 14px;--}}
{{--            color: var(--text-muted);--}}
{{--        }--}}

{{--        /* HOW IT WORKS */--}}
{{--        .steps-grid {--}}
{{--            display: grid;--}}
{{--            grid-template-columns: repeat(3, minmax(0, 1fr));--}}
{{--            gap: 18px;--}}
{{--        }--}}

{{--        @media (max-width: 800px) {--}}
{{--            .steps-grid {--}}
{{--                grid-template-columns: minmax(0, 1fr);--}}
{{--            }--}}
{{--        }--}}

{{--        .step-card {--}}
{{--            background: var(--card-bg);--}}
{{--            border-radius: var(--radius-lg);--}}
{{--            padding: 16px 18px;--}}
{{--            box-shadow: 0 10px 28px rgba(15, 23, 42, 0.04);--}}
{{--            border: 1px solid #e5e7eb;--}}
{{--        }--}}

{{--        .step-number {--}}
{{--            width: 32px;--}}
{{--            height: 32px;--}}
{{--            border-radius: 12px;--}}
{{--            background: #eef2ff;--}}
{{--            color: #4f46e5;--}}
{{--            display: flex;--}}
{{--            align-items: center;--}}
{{--            justify-content: center;--}}
{{--            font-weight: 700;--}}
{{--            margin-bottom: 10px;--}}
{{--        }--}}

{{--        .step-title {--}}
{{--            font-size: 15px;--}}
{{--            font-weight: 600;--}}
{{--            margin-bottom: 6px;--}}
{{--        }--}}

{{--        .step-text {--}}
{{--            font-size: 13px;--}}
{{--            color: var(--text-muted);--}}
{{--        }--}}

{{--        /* THEMES GRID */--}}
{{--        .themes-header {--}}
{{--            display: flex;--}}
{{--            flex-wrap: wrap;--}}
{{--            justify-content: space-between;--}}
{{--            align-items: flex-end;--}}
{{--            gap: 10px;--}}
{{--            margin-bottom: 22px;--}}
{{--        }--}}

{{--        .themes-note {--}}
{{--            font-size: 12px;--}}
{{--            color: var(--text-muted);--}}
{{--        }--}}

{{--        .themes-grid {--}}
{{--            display: grid;--}}
{{--            grid-template-columns: repeat(3, minmax(0, 1fr));--}}
{{--            gap: 20px;--}}
{{--        }--}}

{{--        @media (max-width: 1000px) {--}}
{{--            .themes-grid {--}}
{{--                grid-template-columns: repeat(2, minmax(0, 1fr));--}}
{{--            }--}}
{{--        }--}}

{{--        @media (max-width: 640px) {--}}
{{--            .themes-grid {--}}
{{--                grid-template-columns: minmax(0, 1fr);--}}
{{--            }--}}
{{--        }--}}

{{--        .theme-card {--}}
{{--            background: var(--card-bg);--}}
{{--            border-radius: 18px;--}}
{{--            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.06);--}}
{{--            border: 1px solid #e5e7eb;--}}
{{--            overflow: hidden;--}}
{{--            display: flex;--}}
{{--            flex-direction: column;--}}
{{--            transition: transform 0.16s ease, box-shadow 0.16s ease, border-color 0.16s ease;--}}
{{--        }--}}

{{--        .theme-card:hover {--}}
{{--            transform: translateY(-4px);--}}
{{--            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.12);--}}
{{--            border-color: rgba(79, 70, 229, 0.7);--}}
{{--        }--}}

{{--        .theme-thumb {--}}
{{--            position: relative;--}}
{{--            height: 210px;--}}
{{--            background: #e5e7eb;--}}
{{--            overflow: hidden;--}}
{{--        }--}}

{{--        .theme-thumb img {--}}
{{--            width: 100%;--}}
{{--            height: 100%;--}}
{{--            object-fit: cover;--}}
{{--            display: block;--}}
{{--            transition: transform 0.4s ease;--}}
{{--        }--}}

{{--        .theme-card:hover .theme-thumb img {--}}
{{--            transform: scale(1.05);--}}
{{--        }--}}

{{--        .theme-thumb-badge-bar {--}}
{{--            position: absolute;--}}
{{--            bottom: 10px;--}}
{{--            left: 10px;--}}
{{--            right: 10px;--}}
{{--            display: flex;--}}
{{--            justify-content: space-between;--}}
{{--            gap: 6px;--}}
{{--            font-size: 10px;--}}
{{--        }--}}

{{--        .theme-badge {--}}
{{--            padding: 4px 8px;--}}
{{--            border-radius: 999px;--}}
{{--            background: rgba(17, 24, 39, 0.45);--}}
{{--            color: #e5e7eb;--}}
{{--            backdrop-filter: blur(4px);--}}
{{--            border: 1px solid rgba(229, 231, 235, 0.4);--}}
{{--            white-space: nowrap;--}}
{{--        }--}}

{{--        .theme-badge-green {--}}
{{--            background: rgba(16, 185, 129, 0.85);--}}
{{--            color: #ecfdf3;--}}
{{--            border: none;--}}
{{--        }--}}

{{--        .theme-body {--}}
{{--            padding: 14px 14px 12px;--}}
{{--            display: flex;--}}
{{--            flex-direction: column;--}}
{{--            flex: 1;--}}
{{--        }--}}

{{--        .theme-title {--}}
{{--            font-size: 16px;--}}
{{--            font-weight: 600;--}}
{{--            margin-bottom: 4px;--}}
{{--        }--}}

{{--        .theme-desc {--}}
{{--            font-size: 13px;--}}
{{--            color: var(--text-muted);--}}
{{--            margin-bottom: 10px;--}}
{{--            min-height: 38px;--}}
{{--        }--}}

{{--        .theme-actions {--}}
{{--            margin-top: auto;--}}
{{--            display: flex;--}}
{{--            gap: 8px;--}}
{{--        }--}}

{{--        .btn-small {--}}
{{--            padding: 8px 10px;--}}
{{--            font-size: 12px;--}}
{{--            border-radius: 10px;--}}
{{--            border: 1px solid #d1d5db;--}}
{{--            background: #ffffff;--}}
{{--            cursor: pointer;--}}
{{--            width: 100%;--}}
{{--            text-align: center;--}}
{{--        }--}}

{{--        .btn-small:hover {--}}
{{--            background: #f3f4f6;--}}
{{--        }--}}

{{--        .btn-small-primary {--}}
{{--            background: var(--primary);--}}
{{--            color: #ffffff;--}}
{{--            border-color: transparent;--}}
{{--        }--}}

{{--        .btn-small-primary:hover {--}}
{{--            background: var(--primary-dark);--}}
{{--        }--}}

{{--        /* ABOUT */--}}
{{--        .about-grid {--}}
{{--            display: grid;--}}
{{--            grid-template-columns: minmax(0, 1.2fr) minmax(0, 1fr);--}}
{{--            gap: 26px;--}}
{{--            align-items: flex-start;--}}
{{--        }--}}

{{--        @media (max-width: 900px) {--}}
{{--            .about-grid {--}}
{{--                grid-template-columns: minmax(0, 1fr);--}}
{{--            }--}}
{{--        }--}}

{{--        .about-text p {--}}
{{--            font-size: 14px;--}}
{{--            color: #4b5563;--}}
{{--            margin-bottom: 10px;--}}
{{--        }--}}

{{--        .about-highlights {--}}
{{--            display: grid;--}}
{{--            grid-template-columns: repeat(3, minmax(0, 1fr));--}}
{{--            gap: 10px;--}}
{{--            margin-top: 12px;--}}
{{--        }--}}

{{--        @media (max-width: 640px) {--}}
{{--            .about-highlights {--}}
{{--                grid-template-columns: minmax(0, 1fr);--}}
{{--            }--}}
{{--        }--}}

{{--        .about-card {--}}
{{--            background: #ffffff;--}}
{{--            border-radius: 14px;--}}
{{--            border: 1px solid #e5e7eb;--}}
{{--            padding: 10px 12px;--}}
{{--        }--}}

{{--        .about-card-title {--}}
{{--            font-size: 13px;--}}
{{--            font-weight: 600;--}}
{{--            margin-bottom: 4px;--}}
{{--        }--}}

{{--        .about-card-text {--}}
{{--            font-size: 12px;--}}
{{--            color: var(--text-muted);--}}
{{--        }--}}

{{--        .about-side {--}}
{{--            background: #ffffff;--}}
{{--            border-radius: 18px;--}}
{{--            padding: 14px 16px;--}}
{{--            border: 1px solid #e5e7eb;--}}
{{--            box-shadow: 0 14px 32px rgba(15, 23, 42, 0.06);--}}
{{--        }--}}

{{--        .about-side-title {--}}
{{--            font-size: 15px;--}}
{{--            font-weight: 600;--}}
{{--            margin-bottom: 8px;--}}
{{--        }--}}

{{--        .about-list {--}}
{{--            list-style: none;--}}
{{--            padding: 0;--}}
{{--            margin: 0 0 10px;--}}
{{--        }--}}

{{--        .about-list li {--}}
{{--            font-size: 13px;--}}
{{--            color: #4b5563;--}}
{{--            display: flex;--}}
{{--            gap: 8px;--}}
{{--            margin-bottom: 6px;--}}
{{--        }--}}

{{--        .about-dot {--}}
{{--            width: 5px;--}}
{{--            height: 5px;--}}
{{--            border-radius: 999px;--}}
{{--            background: var(--primary);--}}
{{--            margin-top: 6px;--}}
{{--        }--}}

{{--        /* FOOTER */--}}
{{--        .footer {--}}
{{--            border-top: 1px solid #e5e7eb;--}}
{{--            background: #ffffff;--}}
{{--            padding: 12px 16px;--}}
{{--            font-size: 12px;--}}
{{--            color: var(--text-muted);--}}
{{--        }--}}

{{--        .footer-inner {--}}
{{--            max-width: 1120px;--}}
{{--            margin: 0 auto;--}}
{{--            display: flex;--}}
{{--            flex-wrap: wrap;--}}
{{--            justify-content: space-between;--}}
{{--            gap: 8px;--}}
{{--        }--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body>--}}
{{--<div class="page">--}}
{{--    <!-- NAVBAR -->--}}
{{--    <header class="navbar">--}}
{{--        <div class="navbar-inner">--}}
{{--            <div class="brand">--}}
{{--                <div class="brand-logo">PB</div>--}}
{{--                <div>--}}
{{--                    <div class="brand-text-title">Portfolio Builder</div>--}}
{{--                    <div class="brand-text-sub">Free online portfolio website</div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <nav class="nav-links">--}}
{{--                <a href="#how-it-works" class="nav-link">How it works</a>--}}
{{--                <a href="#themes" class="nav-link">Themes</a>--}}
{{--                <a href="#about" class="nav-link">About</a>--}}

{{--                @auth--}}
{{--                    <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>--}}
{{--                    @if(auth()->user()->is_admin)--}}
{{--                        <a href="{{ route('admin.dashboard') }}" class="nav-link">Admin</a>--}}
{{--                    @endif--}}
{{--                    <form method="POST" action="{{ route('logout') }}">--}}
{{--                        @csrf--}}
{{--                        <button type="submit" class="btn-pill btn-outline">Logout</button>--}}
{{--                    </form>--}}
{{--                @else--}}
{{--                    <a href="{{ route('login') }}" class="nav-link">Login</a>--}}
{{--                    <a href="{{ route('register') }}" class="btn-pill btn-primary">Sign up free</a>--}}
{{--                @endauth--}}
{{--            </nav>--}}
{{--        </div>--}}
{{--    </header>--}}

{{--    <!-- HERO -->--}}
{{--    <section class="hero">--}}
{{--        <div class="hero-inner">--}}
{{--            <div>--}}
{{--                <div class="hero-tag">--}}
{{--                    <span>Free portfolio website</span>--}}
{{--                    <span>•</span>--}}
{{--                    <span>Template based</span>--}}
{{--                    <span>•</span>--}}
{{--                    <span>Export as PDF</span>--}}
{{--                </div>--}}

{{--                <h1 class="hero-title">--}}
{{--                    Build your professional portfolio<br>--}}
{{--                    in just a few simple steps.--}}
{{--                </h1>--}}

{{--                <p class="hero-sub">--}}
{{--                    Hum user ko <strong>bilkul free</strong> me portfolio website bana ke dete hain –--}}
{{--                    apni marzi ka template choose karo, login karo aur apna data daalo.--}}
{{--                    Agar chaho to apne template ko <strong>PDF ke roop me export</strong> bhi kar sakte ho.--}}
{{--                </p>--}}

{{--                <div class="hero-actions">--}}
{{--                    <a href="#themes" class="btn-pill btn-primary">--}}
{{--                        Choose your theme--}}
{{--                    </a>--}}

{{--                    @guest--}}
{{--                        <a href="{{ route('register') }}" class="btn-pill btn-outline">--}}
{{--                            Create free account--}}
{{--                        </a>--}}
{{--                    @endguest--}}
{{--                </div>--}}

{{--                <div class="hero-steps">--}}
{{--                    <span><strong>1.</strong> Theme select karo</span>--}}
{{--                    <span><strong>2.</strong> Login + apna data fill karo</span>--}}
{{--                    <span><strong>3.</strong> Live portfolio + PDF export</span>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div>--}}
{{--                <div class="hero-preview-card">--}}
{{--                    <div class="browser-dots">--}}
{{--                        <div class="browser-dot red"></div>--}}
{{--                        <div class="browser-dot amber"></div>--}}
{{--                        <div class="browser-dot green"></div>--}}
{{--                    </div>--}}

{{--                    <div class="preview-banner">--}}
{{--                        Live Portfolio Preview--}}
{{--                    </div>--}}

{{--                    <div class="preview-body">--}}
{{--                        <div class="preview-user">--}}
{{--                            <div class="preview-avatar"></div>--}}
{{--                            <div>--}}
{{--                                <div class="preview-user-name">Your Name</div>--}}
{{--                                <div class="preview-user-role">Web Developer • Designer</div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <p class="preview-text">--}}
{{--                            A clean, modern portfolio automatically generated from your details —--}}
{{--                            perfect for sharing with HR, clients, and friends.--}}
{{--                        </p>--}}

{{--                        <div class="preview-badges">--}}
{{--                            <div class="preview-badge badge-blue">--}}
{{--                                No coding needed<br>Just fill a form--}}
{{--                            </div>--}}
{{--                            <div class="preview-badge badge-purple">--}}
{{--                                Multiple templates<br>Switch any time--}}
{{--                            </div>--}}
{{--                            <div class="preview-badge badge-green">--}}
{{--                                Export as PDF<br>One click ready--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

{{--    <!-- HOW IT WORKS -->--}}
{{--    <section id="how-it-works" class="section">--}}
{{--        <div class="section-inner">--}}
{{--            <div class="section-header">--}}
{{--                <h2 class="section-title">How it works</h2>--}}
{{--                <p class="section-sub">--}}
{{--                    3 simple steps – student ho, fresher ho ya freelancer, koi bhi apna portfolio bana sakta hai.--}}
{{--                </p>--}}
{{--            </div>--}}

{{--            <div class="steps-grid">--}}
{{--                <div class="step-card">--}}
{{--                    <div class="step-number">1</div>--}}
{{--                    <div class="step-title">Choose your template</div>--}}
{{--                    <div class="step-text">--}}
{{--                        Different portfolio designs – bas jo pasand aaye wo select karo. Clean, modern and responsive.--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="step-card">--}}
{{--                    <div class="step-number">2</div>--}}
{{--                    <div class="step-title">Login & add your data</div>--}}
{{--                    <div class="step-text">--}}
{{--                        Free account banayo, apna naam, skills, projects, experience aur links simple form me daalo.--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="step-card">--}}
{{--                    <div class="step-number">3</div>--}}
{{--                    <div class="step-title">Publish & export as PDF</div>--}}
{{--                    <div class="step-text">--}}
{{--                        Aapko ek live portfolio URL milta hai, saath hi aap chaho to usko PDF me convert karke share bhi kar sakte ho.--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

{{--    <!-- THEMES -->--}}
{{--    <section id="themes" class="section" style="background:#f9fafb;">--}}
{{--        <div class="section-inner">--}}
{{--            <div class="themes-header">--}}
{{--                <div>--}}
{{--                    <h2 class="section-title">Choose your theme</h2>--}}
{{--                    <p class="section-sub">--}}
{{--                        Professional looking templates – sab free, sab responsive, sab PDF-friendly.--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--                <div class="themes-note">--}}
{{--                    100% free • Switch templates anytime • Perfect for CV & HR--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="themes-grid">--}}
{{--                @forelse($themes as $theme)--}}
{{--                    @php--}}
{{--                        $preview = $theme->preview_image;--}}
{{--                        if ($preview) {--}}
{{--                            $isUrl = filter_var($preview, FILTER_VALIDATE_URL);--}}
{{--                            $previewUrl = $isUrl ? $preview : asset('storage/' . $preview);--}}
{{--                        } else {--}}
{{--                            $previewUrl = 'https://colorlib.com/wp/wp-content/uploads/sites/2/rezume-free-template-353x278.jpg.avif';--}}
{{--                        }--}}
{{--                    @endphp--}}

{{--                    <article class="theme-card">--}}
{{--                        <div class="theme-thumb">--}}
{{--                            <img src="{{ $previewUrl }}" alt="{{ $theme->name }}">--}}
{{--                            <div class="theme-thumb-badge-bar">--}}
{{--                                <span class="theme-badge">Live preview available</span>--}}
{{--                                <span class="theme-badge theme-badge-green">PDF ready</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="theme-body">--}}
{{--                            <h3 class="theme-title">{{ $theme->name }}</h3>--}}
{{--                            <p class="theme-desc">--}}
{{--                                {{ $theme->description ?? 'A beautiful portfolio theme for modern professionals.' }}--}}
{{--                            </p>--}}

{{--                            <div class="theme-actions">--}}
{{--                                <a href="{{ route('preview.theme', $theme->id) }}" target="_blank" class="btn-small">--}}
{{--                                    Preview--}}
{{--                                </a>--}}

{{--                                @auth--}}
{{--                                    <form method="GET" action="{{ route('select.theme', $theme->id) }}" style="flex:1;">--}}
{{--                                        @csrf--}}
{{--                                        <button type="submit" class="btn-small btn-small-primary">--}}
{{--                                            Use this theme--}}
{{--                                        </button>--}}
{{--                                    </form>--}}
{{--                                @else--}}
{{--                                    <a href="{{ route('select.theme', $theme->id) }}" class="btn-small btn-small-primary">--}}
{{--                                        Get started--}}
{{--                                    </a>--}}
{{--                                @endauth--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </article>--}}
{{--                @empty--}}
{{--                    <div style="grid-column:1/-1;text-align:center;padding:40px 0;">--}}
{{--                        <p style="color:#6b7280;font-size:14px;">No themes available yet.</p>--}}
{{--                        <p style="color:#9ca3af;font-size:13px;">We’re adding new templates soon. Please check back later.</p>--}}
{{--                    </div>--}}
{{--                @endforelse--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

{{--    <!-- ABOUT -->--}}
{{--    <section id="about" class="section">--}}
{{--        <div class="section-inner">--}}
{{--            <div class="section-header" style="text-align:left;margin-bottom:18px;">--}}
{{--                <h2 class="section-title">About Portfolio Builder</h2>--}}
{{--            </div>--}}

{{--            <div class="about-grid">--}}
{{--                <div class="about-text">--}}
{{--                    <p>--}}
{{--                        Portfolio Builder un logon ke liye banaya gaya hai jo apna portfolio khud banana chahte hain--}}
{{--                        lekin coding, designing ya heavy tools se pareshaan nahi hona chahte.--}}
{{--                    </p>--}}
{{--                    <p>--}}
{{--                        Ham user ko <strong>completely free</strong> portfolio website dete hain. Aap sirf:--}}
{{--                    </p>--}}
{{--                    <p>--}}
{{--                        <strong>1)</strong> apni marzi ka template select karte ho,--}}
{{--                        <strong>2)</strong> login karke apna data fill karte ho,--}}
{{--                        <strong>3)</strong> system aap ke liye automatic professional portfolio ready kar deta hai.--}}
{{--                    </p>--}}
{{--                    <p>--}}
{{--                        Aur sabse bada plus point – aap apne portfolio ko <strong>“Export as PDF”</strong> karke--}}
{{--                        HR, email ya print ke liye easily share kar sakte ho.--}}
{{--                    </p>--}}

{{--                    <div class="about-highlights">--}}
{{--                        <div class="about-card">--}}
{{--                            <div class="about-card-title">Free forever</div>--}}
{{--                            <div class="about-card-text">--}}
{{--                                Koi hidden charges nahi. Jab chaho login karo, update karo, share karo.--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="about-card">--}}
{{--                            <div class="about-card-title">Template based</div>--}}
{{--                            <div class="about-card-text">--}}
{{--                                Multiple templates, different styles – portfolio kabhi boring nahi lagta.--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="about-card">--}}
{{--                            <div class="about-card-title">PDF export</div>--}}
{{--                            <div class="about-card-text">--}}
{{--                                One click me shareable PDF ready, perfect for CV ke saath attach karne ke liye.--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <aside class="about-side">--}}
{{--                    <div class="about-side-title">Why users love it</div>--}}
{{--                    <ul class="about-list">--}}
{{--                        <li>--}}
{{--                            <span class="about-dot"></span>--}}
{{--                            <span>No complicated dashboard – sirf simple forms, bas fill & save.</span>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <span class="about-dot"></span>--}}
{{--                            <span>Mobile, tablet, laptop – har jagah clean aur readable layout.</span>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <span class="about-dot"></span>--}}
{{--                            <span>Portfolio update karte hi naya PDF generate kar sakte ho.</span>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <span class="about-dot"></span>--}}
{{--                            <span>Job applications, LinkedIn, freelancing gigs – sab ke liye ek hi link kaafi.</span>--}}
{{--                        </li>--}}
{{--                    </ul>--}}

{{--                    @guest--}}
{{--                        <a href="{{ route('register') }}" class="btn-pill btn-primary" style="width:100%;justify-content:center;">--}}
{{--                            Start your free portfolio--}}
{{--                        </a>--}}
{{--                    @endguest--}}
{{--                </aside>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

{{--    <!-- FOOTER -->--}}
{{--    <footer class="footer">--}}
{{--        <div class="footer-inner">--}}
{{--            <span>&copy; {{ date('Y') }} Portfolio Builder.</span>--}}
{{--            <span>Build your portfolio, your way — free, simple, and PDF ready.</span>--}}
{{--        </div>--}}
{{--    </footer>--}}
{{--</div>--}}
{{--</body>--}}
{{--</html>--}}




















<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portfolio Builder - Create Your Portfolio</title>


    @vite(['resources/js/app.js'])

    <style>
        :root {
            --primary: #6366f1;
            --primary-soft: rgba(99,102,241,0.12);
            --primary-dark: #4f46e5;
            --accent: #22d3ee;
            --bg-deep: #020617;
            --bg-soft: #020617;
            --card-bg: rgba(15,23,42,0.9);
            --card-border: rgba(148,163,184,0.45);
            --text-main: #e5e7eb;
            --text-muted: #9ca3af;
            --radius-lg: 20px;
            --shadow-strong: 0 26px 60px rgba(15,23,42,0.9);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background:
                radial-gradient(circle at top left, rgba(56,189,248,0.15), transparent 55%),
                radial-gradient(circle at top right, rgba(129,140,248,0.16), transparent 55%),
                radial-gradient(circle at bottom, rgba(236,72,153,0.18), transparent 55%),
                var(--bg-deep);
            color: var(--text-main);
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .page {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* NAVBAR */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 50;
            border-bottom: 1px solid rgba(148,163,184,0.25);
            background: linear-gradient(to bottom, rgba(15,23,42,0.95), rgba(15,23,42,0.8));
            backdrop-filter: blur(14px);
        }

        .navbar-inner {
            max-width: 1160px;
            margin: 0 auto;
            padding: 10px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-orb {
            width: 38px;
            height: 38px;
            border-radius: 999px;
            background:
                conic-gradient(from 180deg, #22d3ee, #6366f1, #a855f7, #ec4899, #22d3ee);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 22px rgba(56,189,248,0.8);
        }

        .brand-orb-inner {
            width: 28px;
            height: 28px;
            border-radius: inherit;
            background: radial-gradient(circle at 30% 20%, #e5e7eb, #020617);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #e5e7eb;
            font-size: 14px;
            font-weight: 800;
        }

        .brand-text-main {
            display: flex;
            flex-direction: column;
        }

        .brand-title {
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        .brand-sub {
            font-size: 11px;
            color: var(--text-muted);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 18px;
            font-size: 13px;
        }

        .nav-link {
            color: var(--text-muted);
            padding: 6px 0;
        }

        .nav-link:hover {
            color: #e5e7eb;
        }

        .btn-pill {
            padding: 8px 16px;
            border-radius: 999px;
            font-size: 13px;
            border: 1px solid transparent;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-weight: 500;
            white-space: nowrap;
        }

        .btn-outline {
            border-color: rgba(148,163,184,0.6);
            background: rgba(15,23,42,0.8);
            color: #e5e7eb;
        }

        .btn-outline:hover {
            background: rgba(15,23,42,1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #6366f1, #22d3ee);
            color: #0f172a;
            box-shadow: 0 14px 40px rgba(59,130,246,0.65);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #4f46e5, #06b6d4);
        }

        /* HERO */
        .hero {
            padding: 42px 16px 40px;
        }

        .hero-inner {
            max-width: 1160px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: minmax(0, 1.15fr) minmax(0, 1fr);
            gap: 42px;
            align-items: center;
        }

        @media (max-width: 960px) {
            .hero-inner {
                grid-template-columns: minmax(0, 1fr);
            }
        }

        .hero-kicker {
            display: inline-flex;
            padding: 4px 10px;
            border-radius: 999px;
            border: 1px solid rgba(148,163,184,0.45);
            background: rgba(15,23,42,0.85);
            font-size: 11px;
            color: #cbd5f5;
            gap: 8px;
            margin-bottom: 10px;
        }

        .hero-kicker span:nth-child(1) {
            color: #22d3ee;
        }

        .hero-title {
            font-size: clamp(28px, 4vw, 38px);
            line-height: 1.1;
            font-weight: 800;
            letter-spacing: 0.01em;
            margin-bottom: 10px;
        }

        .hero-title span.gradient {
            background: linear-gradient(120deg, #22d3ee, #a855f7, #6366f1);
            -webkit-background-clip: text;
            color: transparent;
        }

        .hero-sub {
            font-size: 14px;
            color: var(--text-muted);
            max-width: 480px;
            margin-bottom: 18px;
        }

        .hero-sub strong {
            color: #e5e7eb;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 14px;
        }

        .hero-note {
            font-size: 11px;
            color: #9ca3af;
        }

        .hero-steps-row {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 16px;
        }

        .hero-step-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 10px;
            border-radius: 999px;
            background: rgba(15,23,42,0.85);
            border: 1px solid rgba(148,163,184,0.5);
            font-size: 11px;
        }

        .hero-step-number {
            width: 18px;
            height: 18px;
            border-radius: 999px;
            background: rgba(37,99,235,0.35);
            border: 1px solid rgba(129,140,248,0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            color: #e5e7eb;
        }

        /* HERO RIGHT – GLASS PANEL */
        .hero-panel-wrap {
            position: relative;
        }

        .hero-orb-bg {
            position: absolute;
            inset: -40px -60px;
            pointer-events: none;
            opacity: 0.35;
            background:
                radial-gradient(circle at 20% 0%, rgba(56,189,248,0.6), transparent 60%),
                radial-gradient(circle at 100% 30%, rgba(129,140,248,0.55), transparent 60%),
                radial-gradient(circle at 0% 80%, rgba(248,113,113,0.45), transparent 55%);
            filter: blur(2px);
        }

        .hero-panel {
            position: relative;
            background: radial-gradient(circle at top left, rgba(15,23,42,0.96), rgba(15,23,42,0.96));
            border-radius: 26px;
            padding: 16px 16px 18px;
            border: 1px solid rgba(148,163,184,0.55);
            box-shadow: var(--shadow-strong);
            overflow: hidden;
        }

        .hero-panel-topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .panel-dots {
            display: flex;
            gap: 6px;
        }

        .panel-dot {
            width: 8px;
            height: 8px;
            border-radius: 999px;
        }
        .panel-dot.red { background:#f97373; }
        .panel-dot.amber { background:#fbbf24; }
        .panel-dot.green { background:#22c55e; }

        .panel-label {
            font-size: 11px;
            color: #9ca3af;
        }

        .panel-main {
            border-radius: 17px;
            overflow: hidden;
            background: radial-gradient(circle at top left, #6366f1, #0f172a);
            height: 150px;
            display: grid;
            grid-template-columns: 1.3fr 1fr;
        }

        @media (max-width: 400px) {
            .panel-main {
                grid-template-columns: minmax(0, 1fr);
                height: auto;
            }
        }

        .panel-main-left {
            padding: 14px 15px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 6px;
        }

        .panel-main-title {
            font-size: 15px;
            font-weight: 600;
        }

        .panel-main-sub {
            font-size: 11px;
            color: #e5e7eb;
        }

        .panel-tagline {
            font-size: 10px;
            color: #c4b5fd;
        }

        .panel-main-right {
            padding: 12px 12px;
            background:
                radial-gradient(circle at 30% 0%, rgba(244,244,245,0.7), transparent 55%),
                radial-gradient(circle at 80% 80%, rgba(59,130,246,0.7), transparent 60%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .panel-avatar-ring {
            width: 62px;
            height: 62px;
            border-radius: 999px;
            padding: 3px;
            background: conic-gradient(#22d3ee, #6366f1, #a855f7, #22d3ee);
            display:flex;
            align-items:center;
            justify-content:center;
        }

        .panel-avatar {
            width: 100%;
            height: 100%;
            border-radius: inherit;
            background: radial-gradient(circle at 30% 20%, #e5e7eb, #111827);
        }

        .panel-body {
            padding: 10px 4px 0;
        }

        .panel-user-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 6px;
        }

        .panel-user-info-name {
            font-size: 13px;
            font-weight: 600;
        }

        .panel-user-info-role {
            font-size: 11px;
            color: #9ca3af;
        }

        .panel-text {
            font-size: 11px;
            color: #9ca3af;
        }

        .panel-chips {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 8px;
            margin-top: 10px;
        }

        .panel-chip {
            border-radius: 999px;
            border: 1px solid rgba(148,163,184,0.55);
            background: rgba(15,23,42,0.95);
            padding: 6px 8px;
            font-size: 10px;
            color: #e5e7eb;
            text-align: center;
            line-height: 1.3;
        }

        .panel-chip span {
            display: block;
            font-size: 9px;
            color: #9ca3af;
        }

        /* SECTIONS */
        .section {
            padding: 36px 16px;
        }

        .section-inner {
            max-width: 1160px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 26px;
        }

        .section-title {
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        .section-title span {
            background: linear-gradient(120deg, #22d3ee, #6366f1);
            -webkit-background-clip: text;
            color: transparent;
        }

        .section-sub {
            font-size: 13px;
            color: var(--text-muted);
            max-width: 520px;
            margin: 6px auto 0;
        }

        /* HOW IT WORKS */
        .hiw-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        @media (max-width: 840px) {
            .hiw-grid {
                grid-template-columns: minmax(0, 1fr);
            }
        }

        .hiw-card {
            border-radius: var(--radius-lg);
            border: 1px solid rgba(148,163,184,0.5);
            background: radial-gradient(circle at top left, rgba(15,23,42,0.98), rgba(15,23,42,0.96));
            padding: 16px 16px 14px;
            box-shadow: 0 16px 40px rgba(15,23,42,0.6);
            position: relative;
            overflow: hidden;
        }

        .hiw-card::before {
            content: "";
            position: absolute;
            inset: -30%;
            opacity: 0;
            background: radial-gradient(circle at top, rgba(56,189,248,0.25), transparent 55%);
            transition: opacity 0.25s ease;
        }

        .hiw-card:hover::before {
            opacity: 1;
        }

        .hiw-number {
            width: 26px;
            height: 26px;
            border-radius: 999px;
            border: 1px solid rgba(129,140,248,0.8);
            background: rgba(15,23,42,0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: #c7d2fe;
            margin-bottom: 8px;
        }

        .hiw-title {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .hiw-text {
            font-size: 12px;
            color: var(--text-muted);
        }

        .hiw-footnote {
            font-size: 11px;
            color: #64748b;
            margin-top: 8px;
        }

        /* THEMES – ONLY IF DATA */
        .themes-shell {
            border-radius: 28px;
            border: 1px solid rgba(148,163,184,0.55);
            background: radial-gradient(circle at top left, rgba(15,23,42,0.98), rgba(15,23,42,0.95));
            padding: 18px 18px 20px;
            box-shadow: 0 26px 60px rgba(15,23,42,0.9);
            position: relative;
            overflow: hidden;
        }

        .themes-shell::before {
            content: "";
            position: absolute;
            inset: -40%;
            pointer-events: none;
            opacity: 0.4;
            background:
                radial-gradient(circle at 0% 0%, rgba(56,189,248,0.4), transparent 60%),
                radial-gradient(circle at 100% 50%, rgba(129,140,248,0.4), transparent 60%);
            mix-blend-mode: screen;
        }

        .themes-header-row {
            position: relative;
            z-index: 1;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-end;
            gap: 10px;
            margin-bottom: 18px;
        }

        .themes-title-block {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .themes-title {
            font-size: 18px;
            font-weight: 600;
        }

        .themes-sub {
            font-size: 12px;
            color: #9ca3af;
        }

        .themes-tagline {
            font-size: 11px;
            color: #a5b4fc;
        }

        .themes-note {
            font-size: 11px;
            color: #9ca3af;
            text-align: right;
        }

        .themes-grid {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        @media (max-width: 1000px) {
            .themes-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .themes-grid {
                grid-template-columns: minmax(0, 1fr);
            }
        }

        .theme-card {
            background: rgba(15,23,42,0.92);
            border-radius: 20px;
            border: 1px solid rgba(148,163,184,0.6);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: 0 16px 45px rgba(15,23,42,0.7);
            transform: translateY(0);
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        }

        .theme-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 24px 70px rgba(15,23,42,0.95);
            border-color: rgba(129,140,248,0.9);
        }

        .theme-thumb {
            position: relative;
            height: 200px;
            background: #020617;
            overflow: hidden;
        }

        .theme-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transform: scale(1.03);
            transition: transform 0.4s ease;
        }

        .theme-card:hover .theme-thumb img {
            transform: scale(1.1);
        }

        .theme-overlay-bar {
            position: absolute;
            left: 10px;
            right: 10px;
            bottom: 10px;
            display: flex;
            justify-content: space-between;
            gap: 8px;
            font-size: 10px;
        }

        .theme-pill {
            padding: 4px 8px;
            border-radius: 999px;
            background: rgba(15,23,42,0.85);
            backdrop-filter: blur(6px);
            border: 1px solid rgba(148,163,184,0.9);
            color: #e5e7eb;
            white-space: nowrap;
        }

        .theme-pill-highlight {
            background: linear-gradient(135deg, #22c55e, #4ade80);
            color: #052e16;
            border: none;
        }

        .theme-body {
            padding: 12px 13px 13px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .theme-name-row {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            gap: 6px;
        }

        .theme-name {
            font-size: 14px;
            font-weight: 600;
        }

        .theme-tag {
            font-size: 10px;
            color: #a5b4fc;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .theme-desc {
            font-size: 12px;
            color: var(--text-muted);
            min-height: 34px;
        }

        .theme-actions {
            display: flex;
            gap: 8px;
            margin-top: 6px;
        }

        .btn-tiny {
            padding: 7px 0;
            border-radius: 999px;
            border: 1px solid rgba(148,163,184,0.7);
            background: rgba(15,23,42,0.96);
            color: #e5e7eb;
            font-size: 11px;
            cursor: pointer;
            flex: 1;
            text-align: center;
        }

        .btn-tiny:hover {
            background: rgba(15,23,42,1);
        }

        .btn-tiny-primary {
            border-color: transparent;
            background: linear-gradient(135deg, #6366f1, #22d3ee);
            color: #020617;
            font-weight: 500;
        }

        .btn-tiny-primary:hover {
            background: linear-gradient(135deg, #4f46e5, #06b6d4);
        }

        /* ABOUT */
        .about-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.2fr) minmax(0, 1fr);
            gap: 24px;
            align-items: flex-start;
        }

        @media (max-width: 960px) {
            .about-grid {
                grid-template-columns: minmax(0, 1fr);
            }
        }

        .about-text p {
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 8px;
        }

        .about-text strong {
            color: #e5e7eb;
        }

        .about-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 10px;
        }

        .about-chip {
            font-size: 11px;
            padding: 5px 9px;
            border-radius: 999px;
            border: 1px solid rgba(148,163,184,0.6);
            background: rgba(15,23,42,0.9);
            color: #cbd5f5;
        }

        .about-highlights {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
            margin-top: 12px;
        }

        @media (max-width: 640px) {
            .about-highlights {
                grid-template-columns: minmax(0, 1fr);
            }
        }

        .about-card {
            border-radius: 14px;
            border: 1px solid rgba(148,163,184,0.5);
            background: rgba(15,23,42,0.95);
            padding: 10px 12px;
        }

        .about-card-title {
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .about-card-text {
            font-size: 11px;
            color: var(--text-muted);
        }

        .about-side {
            border-radius: 20px;
            border: 1px solid rgba(148,163,184,0.6);
            background: radial-gradient(circle at top left, rgba(15,23,42,0.98), rgba(15,23,42,0.96));
            padding: 14px 14px 16px;
            box-shadow: 0 20px 55px rgba(15,23,42,0.85);
        }

        .about-side-title {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .about-list {
            list-style: none;
            padding: 0;
            margin: 0 0 12px;
        }

        .about-list li {
            display: flex;
            gap: 8px;
            font-size: 12px;
            color: var(--text-muted);
            margin-bottom: 6px;
        }

        .about-dot {
            width: 5px;
            height: 5px;
            border-radius: 999px;
            background: #6366f1;
            margin-top: 6px;
        }

        /* FOOTER */
        .footer {
            border-top: 1px solid rgba(148,163,184,0.35);
            background: rgba(15,23,42,0.98);
            padding: 12px 16px;
            font-size: 11px;
            color: var(--text-muted);
        }

        .footer-inner {
            max-width: 1160px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 8px;
        }
    </style>
</head>
<body>
<div class="page">
    <!-- NAVBAR -->
    <header class="navbar">
        <div class="navbar-inner">
            <div class="brand">
                <div class="brand-orb">
                    <div class="brand-orb-inner">PB</div>
                </div>


                <div class="brand-text-main">
                    <span class="brand-title">Portfolio Builder</span>
                    <span class="brand-sub">Free portfolio • PDF ready</span>
                </div>
            </div>

            <nav class="nav-links">
                <a href="#how-it-works" class="nav-link">How it works</a>
                <a href="#themes" class="nav-link">Themes</a>
                <a href="#about" class="nav-link">About</a>

                @auth
                    <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">Admin</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-pill btn-outline">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                    <a href="{{ route('register') }}" class="btn-pill btn-primary">Sign up free</a>
                @endauth
            </nav>
        </div>
    </header>

    <!-- HERO -->
    <section class="hero">
        <div class="hero-inner">
            <div>
                <div class="hero-kicker">
                    <span>New</span>
                    <span>•</span>
                    <span>Build portfolio in minutes</span>
                    <span>•</span>
                    <span>Export as PDF</span>
                </div>

                <h1 class="hero-title">
                    Create a <span class="gradient">professional portfolio</span><br>
                    without touching any code.
                </h1>

                <p class="hero-sub">
                    Hum user ko <strong>bilkul free</strong> portfolio website banā kar dete hain –
                    bas apni marzi ka template choose karo, login karo aur apna data daalo.
                    Agar chaho to apni site ko <strong>clean PDF</strong> me export karke HR ya clients ko bhej sakte ho.
                </p>

                <div class="hero-actions">
                    <a href="#themes" class="btn-pill btn-primary">
                        Choose your theme
                    </a>
                    @guest
                        <a href="{{ route('register') }}" class="btn-pill btn-outline">
                            Create free account
                        </a>
                    @endguest>
                </div>
                <div class="hero-note">
                    No payment, no ads inside your portfolio – sirf clean professional look.
                </div>

                <div class="hero-steps-row">
                    <div class="hero-step-chip">
                        <div class="hero-step-number">1</div>
                        <span>Theme select karo</span>
                    </div>
                    <div class="hero-step-chip">
                        <div class="hero-step-number">2</div>
                        <span>Login + apna data fill karo</span>
                    </div>
                    <div class="hero-step-chip">
                        <div class="hero-step-number">3</div>
                        <span>Live portfolio &amp; PDF export</span>
                    </div>
                </div>
            </div>

            <div class="hero-panel-wrap">
                <div class="hero-orb-bg"></div>

                <div class="hero-panel">
                    <div class="hero-panel-topbar">
                        <div class="panel-dots">
                            <div class="panel-dot red"></div>
                            <div class="panel-dot amber"></div>
                            <div class="panel-dot green"></div>
                        </div>
                        <div class="panel-label">Portfolio preview</div>
                    </div>

                    <div class="panel-main">
                        <div class="panel-main-left">
                            <div class="panel-main-title">Your Name</div>
                            <div class="panel-main-sub">Web Developer • Designer • Creator</div>
                            <div class="panel-tagline">
                                One link + one PDF – sab jagah same clean impression.
                            </div>
                        </div>
                        <div class="panel-main-right">
                            <div class="panel-avatar-ring">
                                <div class="panel-avatar"></div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="panel-user-row">
                            <div style="width:28px;height:28px;border-radius:999px;background:#020617;border:1px solid rgba(148,163,184,0.6);"></div>
                            <div>
                                <div class="panel-user-info-name">Your Name</div>
                                <div class="panel-user-info-role">Full-Stack Developer</div>
                            </div>
                        </div>
                        <p class="panel-text">
                            “Ek baar data fill karo – portfolio site + PDF dono ham sambhalte hain.
                            Aap sirf link share karo aur job / clients handle karo.”
                        </p>

                        <div class="panel-chips">
                            <div class="panel-chip">
                                No coding
                                <span>Sirf form fill karo</span>
                            </div>
                            <div class="panel-chip">
                                Modern designs
                                <span>Templates change anytime</span>
                            </div>
                            <div class="panel-chip">
                                PDF export
                                <span>Perfect for HR & email</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- HOW IT WORKS -->
    <section id="how-it-works" class="section">
        <div class="section-inner">
            <div class="section-header">
                <h2 class="section-title">How it <span>works</span></h2>
                <p class="section-sub">
                    3-step process – student ho, fresher ho ya freelancer, koi bhi apna portfolio khud bana sakta hai.
                </p>
            </div>

            <div class="hiw-grid">
                <div class="hiw-card">
                    <div class="hiw-number">1</div>
                    <div class="hiw-title">Pick a template you like</div>
                    <div class="hiw-text">
                        Ready-made portfolio templates – minimal, creative, classic.
                        Jo style aapke vibe ke saath match kare, bas woh choose karo.
                    </div>
                    <div class="hiw-footnote">
                        Template baad me bhi change ho sakta hai.
                    </div>
                </div>
                <div class="hiw-card">
                    <div class="hiw-number">2</div>
                    <div class="hiw-title">Login & fill your details</div>
                    <div class="hiw-text">
                        Simple forms – name, about, skills, projects, links.
                        Koi complex dashboard nahi, bas straight-forward fields.
                    </div>
                    <div class="hiw-footnote">
                        Kabhi bhi login karke update kar sakte ho.
                    </div>
                </div>
                <div class="hiw-card">
                    <div class="hiw-number">3</div>
                    <div class="hiw-title">Publish site & export as PDF</div>
                    <div class="hiw-text">
                        Live portfolio URL + ek neat PDF version milta hai, jo CV ke saath attach karne ke liye perfect hai.
                    </div>
                    <div class="hiw-footnote">
                        One click PDF export – hamesha latest version.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- THEMES (ONLY IF THERE IS DATA) -->
    @if(isset($themes) && $themes->count())
        <section id="themes" class="section">
            <div class="section-inner">
                <div class="themes-shell">
                    <div class="themes-header-row">
                        <div class="themes-title-block">
                            <div class="themes-title">Choose your theme</div>
                            <div class="themes-sub">
                                Sab templates responsive, polished aur PDF-friendly design ke saath aate hain.
                            </div>
                            <div class="themes-tagline">
                                Ek click me preview, ek click me select.
                            </div>
                        </div>
                        <div class="themes-note">
                            100% free • Unlimited edits • Theme switch anytime
                        </div>
                    </div>

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
                                <div class="theme-thumb">
                                    <img src="{{ $previewUrl }}" alt="{{ $theme->name }}">
                                    <div class="theme-overlay-bar">
                                        <div class="theme-pill">Live preview</div>
                                        <div class="theme-pill theme-pill-highlight">PDF friendly</div>
                                    </div>
                                </div>
                                <div class="theme-body">
                                    <div class="theme-name-row">
                                        <div class="theme-name">{{ $theme->name }}</div>
                                        <div class="theme-tag">Portfolio theme</div>
                                    </div>
                                    <p class="theme-desc">
                                        {{ $theme->description ?? 'A beautiful portfolio layout designed for modern students and professionals.' }}
                                    </p>
                                    <div class="theme-actions" style="display:flex; justify-content:space-between; gap:10px;">

                                        <!-- Left button (always Preview) -->
                                        <a href="{{ route('preview.theme', $theme->id) }}"
                                           target="_blank"
                                           class="btn-tiny">
                                            Preview
                                        </a>

                                        <!-- Right button (same design for both auth + guest) -->
                                        @auth
                                            <form method="GET" action="{{ route('select.theme', $theme->id) }}">
                                                @csrf
                                                <button type="submit" class="btn-tiny ">
                                                    Use this theme
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('select.theme', $theme->id) }}"
                                               class="btn-tiny btn-tiny-primary">
                                                Get started
                                            </a>
                                        @endauth

                                    </div>

                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- ABOUT -->
    <section id="about" class="section">
        <div class="section-inner">
            <div class="section-header" style="text-align:left;margin-bottom:18px;">
                <h2 class="section-title">About <span>Portfolio Builder</span></h2>
            </div>

            <div class="about-grid">
                <div class="about-text">
                    <p>
                        Portfolio Builder un logon ke liye hai jo apna portfolio professional banana chahte hain,
                        lekin developer hire karne ya Figma, HTML, CSS seekhne ka time nahi hai.
                    </p>
                    <p>
                        Ham aapko <strong>completely free</strong> me portfolio website dete hain. Aap sirf:
                        <strong>template choose</strong> karte ho, <strong>login karke data fill</strong> karte ho,
                        baaki hamara system automatically ek clean portfolio bana deta hai.
                    </p>
                    <p>
                        Aur jab bhi aapko CV bhejna ho, job ke liye apply karna ho ya LinkedIn pe profile strong dikhani ho,
                        aap same portfolio ka <strong>live link</strong> bhi share kar sakte ho
                        aur <strong>downloadable PDF</strong> bhi.
                    </p>

                    <div class="about-chips">
                        <div class="about-chip">Free forever</div>
                        <div class="about-chip">No coding</div>
                        <div class="about-chip">PDF export</div>
                        <div class="about-chip">Theme switch anytime</div>
                        <div class="about-chip">Mobile friendly</div>
                    </div>

                    <div class="about-highlights">
                        <div class="about-card">
                            <div class="about-card-title">Free forever</div>
                            <div class="about-card-text">
                                Koi hidden payment nahi. Jab chaho login karo, profile update karo, aur naya PDF nikal lo.
                            </div>
                        </div>
                        <div class="about-card">
                            <div class="about-card-title">Template driven</div>
                            <div class="about-card-text">
                                Alag-alag layouts aapko ek hi content se multiple looks try karne ka option dete hain.
                            </div>
                        </div>
                        <div class="about-card">
                            <div class="about-card-title">Perfect for job hunt</div>
                            <div class="about-card-text">
                                HR ko ek clean link ya PDF bhejo – portfolio se pehle se strong impression banta hai.
                            </div>
                        </div>
                    </div>
                </div>

                <aside class="about-side">
                    <div class="about-side-title">Why people like using it</div>
                    <ul class="about-list">
                        <li>
                            <span class="about-dot"></span>
                            <span>No complicated settings – sirf straightforward steps, beginner friendly.</span>
                        </li>
                        <li>
                            <span class="about-dot"></span>
                            <span>Har device pe readable typography aur clean spacing.</span>
                        </li>
                        <li>
                            <span class="about-dot"></span>
                            <span>Portfolio update karte hi naya PDF bana sakte ho – CV ke saath hamesha fresh info.</span>
                        </li>
                        <li>
                            <span class="about-dot"></span>
                            <span>Freelancing gigs, internships, full-time jobs – ek hi link sab ke kaam aa jata hai.</span>
                        </li>
                    </ul>

                    @guest
                        <a href="{{ route('register') }}" class="btn-pill btn-primary" style="width:100%;justify-content:center;margin-top:4px;">
                            Start your free portfolio
                        </a>
                    @endguest
                </aside>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-inner">
            <span>&copy; {{ date('Y') }} Portfolio Builder.</span>
            <span>Build once, share everywhere — web + PDF, always free.</span>
        </div>
    </footer>
</div>
</body>
</html>
