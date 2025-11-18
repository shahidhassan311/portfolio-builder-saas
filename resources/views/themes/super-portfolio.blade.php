<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} – Portfolio</title>

    <style>
        :root {
            --bg-gradient: radial-gradient(circle at top left, #4f46e5, #a855f7, #ec4899);
            --card-bg: rgba(17, 24, 39, 0.8);
            --card-border: rgba(255, 255, 255, 0.1);
            --accent: #a855f7;
            --accent-soft: rgba(168, 85, 247, 0.2);
            --text-main: #f9fafb;
            --text-muted: #9ca3af;
            --shadow-soft: 0 20px 40px rgba(15, 23, 42, 0.7);
            --radius-lg: 24px;
            --radius-md: 18px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "SF Pro Text", "Segoe UI", Roboto, system-ui, sans-serif;
            color: var(--text-main);
            background: #020617;
            background-image:
                radial-gradient(circle at 10% 20%, rgba(248, 113, 113, 0.15) 0, transparent 50%),
                radial-gradient(circle at 90% 10%, rgba(52, 211, 153, 0.18) 0, transparent 55%),
                radial-gradient(circle at 50% 100%, rgba(59, 130, 246, 0.2) 0, transparent 55%);
            min-height: 100vh;
        }

        /* Floating gradient glow behind everything */
        .page-glow {
            position: fixed;
            inset: 0;
            background: radial-gradient(circle at top, rgba(129, 140, 248, 0.18), transparent 60%);
            mix-blend-mode: screen;
            opacity: 0.9;
            pointer-events: none;
            z-index: -2;
        }

        .noise-overlay {
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 160 160' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='4' stitchTiles='noStitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.09'/%3E%3C/svg%3E");
            mix-blend-mode: soft-light;
            pointer-events: none;
            z-index: -1;
        }

        .page {
            max-width: 1200px;
            margin: 0 auto;
            padding: 24px 16px 80px;
        }

        /* ================= NAVBAR ================= */

        .nav {
            position: sticky;
            top: 0;
            z-index: 30;
            backdrop-filter: blur(18px);
            background: linear-gradient(to right, rgba(15,23,42,0.90), rgba(15,23,42,0.75));
            border: 1px solid rgba(148, 163, 184, 0.3);
            border-radius: 999px;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 32px;
            box-shadow: 0 15px 40px rgba(15,23,42,0.7);
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-avatar {
            width: 40px;
            height: 40px;
            border-radius: 999px;
            border: 2px solid rgba(248, 250, 252, 0.6);
            overflow: hidden;
            background: radial-gradient(circle at 30% 0, #e5e7eb, #4b5563);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 18px;
        }

        .nav-name {
            font-weight: 600;
            font-size: 18px;
        }

        .nav-role {
            font-size: 13px;
            color: var(--text-muted);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 18px;
            font-size: 14px;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-muted);
            position: relative;
            padding-bottom: 4px;
        }

        .nav-links a::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(to right, #a855f7, #ec4899);
            border-radius: 999px;
            transition: width 0.25s ease;
        }

        .nav-links a:hover {
            color: #e5e7eb;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .nav-cta {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: linear-gradient(to right, #6366f1, #ec4899);
            border-radius: 999px;
            color: white;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 10px 30px rgba(129, 140, 248, 0.45);
            transform: translateY(0);
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }

        .nav-cta:hover {
            transform: translateY(-1px);
            box-shadow: 0 12px 32px rgba(129, 140, 248, 0.7);
        }

        .nav-cta span {
            font-size: 18px;
        }

        /* ================= HERO ================= */

        .hero {
            display: grid;
            grid-template-columns: minmax(0, 3fr) minmax(0, 2.2fr);
            gap: 32px;
            margin-bottom: 40px;
        }

        .hero-card {
            background: radial-gradient(circle at top left, rgba(129, 140, 248, 0.45), rgba(15, 23, 42, 0.95));
            border-radius: var(--radius-lg);
            padding: 32px 28px;
            border: 1px solid rgba(148, 163, 184, 0.35);
            box-shadow: var(--shadow-soft);
            position: relative;
            overflow: hidden;
        }

        .hero-card::before {
            content: "";
            position: absolute;
            inset: -120px;
            background: conic-gradient(from 210deg, rgba(129, 140, 248, 0.35), transparent, rgba(244, 114, 182, 0.4), transparent);
            opacity: 0.4;
            mix-blend-mode: screen;
        }

        .hero-inner {
            position: relative;
            z-index: 2;
        }

        .hero-pill-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 18px;
        }

        .hero-pill {
            font-size: 12px;
            padding: 6px 12px;
            border-radius: 999px;
            border: 1px solid rgba(148, 163, 184, 0.5);
            background: rgba(15, 23, 42, 0.7);
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--text-muted);
        }

        .hero-heading {
            font-size: 34px;
            line-height: 1.15;
            font-weight: 800;
            letter-spacing: 0.01em;
            margin-bottom: 16px;
        }

        .hero-heading span {
            background: linear-gradient(to right, #e879f9, #38bdf8);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .hero-tagline {
            font-size: 16px;
            color: var(--text-muted);
            margin-bottom: 24px;
        }

        .hero-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 28px;
            margin-bottom: 28px;
        }

        .hero-meta-item {
            font-size: 13px;
            color: var(--text-muted);
        }

        .hero-meta-label {
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-size: 11px;
            color: #6b7280;
            margin-bottom: 4px;
        }

        .hero-meta-value {
            font-size: 14px;
            color: #e5e7eb;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 999px;
            border: none;
            background: linear-gradient(to right, #6366f1, #ec4899);
            color: white;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            box-shadow: 0 12px 30px rgba(79, 70, 229, 0.6);
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 16px 36px rgba(79, 70, 229, 0.9);
        }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 999px;
            border: 1px solid rgba(148, 163, 184, 0.7);
            background: rgba(15, 23, 42, 0.85);
            color: #e5e7eb;
            font-weight: 500;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.15s ease, border-color 0.15s ease;
        }

        .btn-ghost:hover {
            background: rgba(15, 23, 42, 1);
            border-color: rgba(209, 213, 219, 0.9);
        }

        .hero-aside {
            background: rgba(15, 23, 42, 0.92);
            border-radius: var(--radius-lg);
            padding: 24px 22px;
            border: 1px solid rgba(148, 163, 184, 0.3);
            box-shadow: var(--shadow-soft);
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .hero-profile {
            display: flex;
            gap: 18px;
            align-items: center;
            margin-bottom: 12px;
        }

        .hero-avatar-lg {
            width: 82px;
            height: 82px;
            border-radius: 24px;
            overflow: hidden;
            border: 2px solid rgba(248, 250, 252, 0.7);
            background: radial-gradient(circle at 20% 0, #e5e7eb, #111827);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: 800;
        }

        .hero-profile-text {
            flex: 1;
        }

        .hero-profile-name {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .hero-profile-role {
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 6px;
        }

        .hero-profile-location {
            font-size: 12px;
            color: #9ca3af;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .hero-stats {
            display: flex;
            gap: 16px;
            margin-top: 10px;
            flex-wrap: wrap;
        }

        .hero-stat {
            flex: 1;
            min-width: 110px;
            padding: 10px 12px;
            border-radius: 16px;
            background: radial-gradient(circle at top left, rgba(96, 165, 250, 0.2), rgba(15, 23, 42, 0.95));
            border: 1px solid rgba(148, 163, 184, 0.4);
            font-size: 12px;
        }

        .hero-stat-number {
            font-size: 18px;
            font-weight: 700;
        }

        .hero-stat-label {
            color: var(--text-muted);
            margin-top: 2px;
        }

        .hero-social {
            border-radius: 18px;
            padding: 14px 12px;
            background: rgba(15, 23, 42, 0.95);
            border: 1px dashed rgba(148, 163, 184, 0.6);
            font-size: 13px;
        }

        .hero-social-title {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.14em;
            color: #6b7280;
            margin-bottom: 8px;
        }

        .hero-social-links {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .hero-social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 11px;
            border-radius: 999px;
            background: rgba(15, 23, 42, 0.85);
            border: 1px solid rgba(148, 163, 184, 0.6);
            color: #e5e7eb;
            font-size: 12px;
            text-decoration: none;
            gap: 6px;
        }

        .hero-social-links a span.emoji {
            font-size: 14px;
        }

        .hero-social-links a:hover {
            border-color: rgba(249, 250, 251, 0.9);
            background: rgba(15, 23, 42, 1);
        }

        /* ================= SECTIONS ================= */

        .section {
            margin-top: 40px;
        }

        .section-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .section-kicker {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.14em;
            color: #9ca3af;
            margin-bottom: 4px;
        }

        .section-title {
            font-size: 22px;
            font-weight: 700;
        }

        .section-subtitle {
            font-size: 13px;
            color: var(--text-muted);
        }

        /* Cards grid (skills, projects) */

        .grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .grid-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .grid-1 {
            grid-template-columns: minmax(0, 1fr);
        }

        .card {
            background: var(--card-bg);
            border-radius: var(--radius-md);
            border: 1px solid var(--card-border);
            padding: 18px 16px;
            box-shadow: 0 16px 40px rgba(15,23,42,0.75);
            position: relative;
            overflow: hidden;
            transition: transform 0.18s ease, box-shadow 0.18s ease, border-color 0.18s ease;
        }

        .card::before {
            content: "";
            position: absolute;
            inset: -40px;
            background: radial-gradient(circle at top, rgba(129, 140, 248, 0.18), transparent 60%);
            opacity: 0;
            transition: opacity 0.18s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 24px 60px rgba(15,23,42,0.95);
            border-color: rgba(209, 213, 219, 0.9);
        }

        .card:hover::before {
            opacity: 1;
        }

        /* Skills */

        .skill-title {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .skill-level {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--text-muted);
            margin-bottom: 10px;
        }

        .skill-bar {
            position: relative;
            height: 8px;
            border-radius: 999px;
            background: rgba(15, 23, 42, 0.9);
            overflow: hidden;
            margin-bottom: 6px;
        }

        .skill-bar-fill {
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(to right, #6366f1, #a855f7, #ec4899);
            transform-origin: left;
            transform: scaleX(1);
        }

        .skill-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-top: 6px;
        }

        .skill-tag {
            font-size: 11px;
            padding: 4px 8px;
            border-radius: 999px;
            background: rgba(15, 23, 42, 0.9);
            border: 1px solid rgba(148, 163, 184, 0.5);
            color: var(--text-muted);
        }

        /* Projects */

        .project-card {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .project-title {
            font-size: 16px;
            font-weight: 600;
        }

        .project-description {
            font-size: 13px;
            color: var(--text-muted);
        }

        .project-meta {
            font-size: 12px;
            color: #9ca3af;
            margin-top: 4px;
        }

        .project-link {
            margin-top: 10px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #e5e7eb;
            text-decoration: none;
        }

        .project-link span {
            font-size: 16px;
            transform: translateY(1px);
        }

        .project-image-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 9px;
            border-radius: 999px;
            font-size: 11px;
            background: rgba(15, 23, 42, 0.9);
            border: 1px solid rgba(148, 163, 184, 0.7);
            color: var(--text-muted);
            margin-top: 6px;
        }

        /* Timeline (experience / education) */

        .timeline {
            position: relative;
            padding-left: 18px;
        }

        .timeline::before {
            content: "";
            position: absolute;
            left: 6px;
            top: 0;
            bottom: 0;
            width: 1px;
            background: linear-gradient(to bottom, rgba(148, 163, 184, 0.6), transparent 80%);
        }

        .timeline-item {
            position: relative;
            padding-left: 12px;
            margin-bottom: 18px;
        }

        .timeline-dot {
            position: absolute;
            left: -1px;
            top: 4px;
            width: 10px;
            height: 10px;
            border-radius: 999px;
            background: #0f172a;
            border: 2px solid #a855f7;
            box-shadow: 0 0 0 5px rgba(168, 85, 247, 0.15);
        }

        .timeline-role {
            font-size: 14px;
            font-weight: 600;
        }

        .timeline-company {
            font-size: 13px;
            color: #e5e7eb;
        }

        .timeline-date {
            font-size: 11px;
            color: #9ca3af;
            margin-top: 2px;
        }

        .timeline-desc {
            font-size: 13px;
            color: var(--text-muted);
            margin-top: 6px;
        }

        /* Goals */

        .goals-list {
            list-style: none;
            display: grid;
            gap: 10px;
        }

        .goal-item {
            font-size: 13px;
            color: #e5e7eb;
            padding: 10px 12px;
            border-radius: 14px;
            background: rgba(15,23,42,0.95);
            border: 1px solid rgba(148,163,184,0.7);
            display: flex;
            gap: 8px;
        }

        .goal-item span {
            margin-top: 2px;
        }

        /* Contact / Footer */

        .contact-card {
            margin-top: 24px;
            display: grid;
            grid-template-columns: minmax(0, 3fr) minmax(0, 2fr);
            gap: 18px;
        }

        .contact-main {
            background: var(--card-bg);
            border-radius: var(--radius-md);
            border: 1px solid var(--card-border);
            padding: 18px 16px;
            box-shadow: var(--shadow-soft);
            font-size: 14px;
            color: var(--text-muted);
        }

        .contact-main p + p {
            margin-top: 10px;
        }

        .contact-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 12px;
            font-size: 13px;
        }

        .contact-pill a {
            color: #e5e7eb;
            text-decoration: none;
        }

        .contact-side {
            font-size: 12px;
            color: #9ca3af;
            padding: 12px 10px;
        }

        .footer-note {
            text-align: center;
            margin-top: 40px;
            font-size: 11px;
            color: #6b7280;
        }

        /* ================= RESPONSIVE ================= */

        @media (max-width: 960px) {
            .hero {
                grid-template-columns: minmax(0, 1fr);
            }

            .contact-card {
                grid-template-columns: minmax(0, 1fr);
            }

            .grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 720px) {
            .nav {
                flex-wrap: wrap;
                gap: 10px;
                border-radius: 18px;
            }

            .nav-links {
                display: none;
            }

            .hero-heading {
                font-size: 26px;
            }

            .page {
                padding-inline: 14px;
            }

            .grid {
                grid-template-columns: minmax(0, 1fr);
            }
        }
    </style>
</head>
<body>

<div class="page-glow"></div>
<div class="noise-overlay"></div>

<div class="page">

    <!-- ================= NAVBAR ================= -->
    <header class="nav">
        <div class="nav-left">
            <div class="nav-avatar">
                @if(isset($user->profile) && $user->profile->profile_image)
                    <img src="{{ asset('storage/'.$user->profile->profile_image) }}" alt="{{ $user->name }}" style="width:100%;height:100%;object-fit:cover;">
                @else
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                @endif
            </div>
            <div>
                <div class="nav-name">{{ $user->name }}</div>
                <div class="nav-role">
                    {{ $user->profile->tagline ?? 'Creative Developer & Designer' }}
                </div>
            </div>
        </div>

        <nav class="nav-links">
            <a href="#about">About</a>
            <a href="#skills">Skills</a>
            <a href="#projects">Projects</a>
            @if(isset($user->experiences) && $user->experiences->count())
                <a href="#experience">Experience</a>
            @endif
            @if(isset($user->educations) && $user->educations->count())
                <a href="#education">Education</a>
            @endif
            @if(isset($user->goals) && $user->goals->count())
                <a href="#goals">Goals</a>
            @endif
        </nav>

        @if(isset($user->profile) && $user->profile->contact_email)
            <a href="#contact" class="nav-cta">
                <span>✉️</span> Contact
            </a>
        @endif
    </header>

    <!-- ================= HERO ================= -->
    <section class="hero" id="top">
        <div class="hero-card">
            <div class="hero-inner">
                <div class="hero-pill-row">
                    <div class="hero-pill">
                        <span>✨</span>
                        <span>Open for opportunities</span>
                    </div>
                    @if(isset($user->profile) && $user->profile->location)
                        <div class="hero-pill">
                            <span>📍</span>
                            <span>{{ $user->profile->location }}</span>
                        </div>
                    @endif
                </div>

                <h1 class="hero-heading">
                    I craft <span>digital experiences</span> that feel fast, clean, and unforgettable.
                </h1>

                <p class="hero-tagline">
                    {{ $user->profile->about_short ?? 'I design and build modern web experiences, focusing on performance, clarity, and detail that makes products stand out.' }}
                </p>

                <div class="hero-meta">
                    <div class="hero-meta-item">
                        <div class="hero-meta-label">Name</div>
                        <div class="hero-meta-value">{{ $user->name }}</div>
                    </div>

                    @if(isset($user->skills) && $user->skills->count())
                        <div class="hero-meta-item">
                            <div class="hero-meta-label">Core Stack</div>
                            <div class="hero-meta-value">
                                {{ $user->skills->take(3)->pluck('name')->implode(' · ') }}
                            </div>
                        </div>
                    @endif
                </div>

                <div class="hero-actions">
                    @if(isset($user->profile) && $user->profile->contact_email)
                        <a href="#contact" class="btn-primary">
                            <span>Let’s work together</span>
                            <span>→</span>
                        </a>
                    @endif

                    @if(isset($user->projects) && $user->projects->count())
                        <a href="#projects" class="btn-ghost">
                            <span>View selected projects</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <aside class="hero-aside">
            <div class="hero-profile">
                <div class="hero-avatar-lg">
                    @if(isset($user->profile) && $user->profile->profile_image)
                        <img src="{{ asset('storage/'.$user->profile->profile_image) }}" alt="{{ $user->name }}" style="width:100%;height:100%;object-fit:cover;">
                    @else
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    @endif
                </div>
                <div class="hero-profile-text">
                    <div class="hero-profile-name">{{ $user->name }}</div>
                    <div class="hero-profile-role">
                        {{ $user->profile->tagline ?? 'Full-Stack Developer' }}
                    </div>
                    @if(isset($user->profile) && $user->profile->location)
                        <div class="hero-profile-location">
                            <span>📍</span>
                            <span>{{ $user->profile->location }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="hero-stats">
                <div class="hero-stat">
                    <div class="hero-stat-number">
                        {{ isset($user->projects) ? str_pad($user->projects->count(), 2, '0', STR_PAD_LEFT) : '05' }}+
                    </div>
                    <div class="hero-stat-label">Projects shipped</div>
                </div>
                @if(isset($user->experiences) && $user->experiences->count())
                    <div class="hero-stat">
                        <div class="hero-stat-number">
                            {{ $user->experiences->count() }}+
                        </div>
                        <div class="hero-stat-label">Companies collaborated</div>
                    </div>
                @endif
            </div>

            @if(
                isset($user->profile)
                && (
                    $user->profile->social_github
                    || $user->profile->social_linkedin
                    || $user->profile->social_twitter
                    || $user->profile->social_instagram
                    || $user->profile->social_facebook
                )
            )
                <div class="hero-social">
                    <div class="hero-social-title">Connect</div>
                    <div class="hero-social-links">
                        @if($user->profile->social_github)
                            <a href="{{ $user->profile->social_github }}" target="_blank">
                                <span class="emoji">🐙</span> GitHub
                            </a>
                        @endif
                        @if($user->profile->social_linkedin)
                            <a href="{{ $user->profile->social_linkedin }}" target="_blank">
                                <span class="emoji">💼</span> LinkedIn
                            </a>
                        @endif
                        @if($user->profile->social_twitter)
                            <a href="{{ $user->profile->social_twitter }}" target="_blank">
                                <span class="emoji">🐦</span> Twitter
                            </a>
                        @endif
                        @if($user->profile->social_instagram)
                            <a href="{{ $user->profile->social_instagram }}" target="_blank">
                                <span class="emoji">📸</span> Instagram
                            </a>
                        @endif
                        @if($user->profile->social_facebook)
                            <a href="{{ $user->profile->social_facebook }}" target="_blank">
                                <span class="emoji">📘</span> Facebook
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        </aside>
    </section>

    <!-- ================= ABOUT ================= -->
    @if(isset($user->profile) && ($user->profile->about_title || $user->profile->about_long || $user->profile->about_short))
        <section class="section" id="about">
            <div class="section-header">
                <div>
                    <div class="section-kicker">About</div>
                    <h2 class="section-title">{{ $user->profile->about_title ?? 'Who I am' }}</h2>
                </div>
                <div class="section-subtitle">
                    A quick snapshot of how I think and build.
                </div>
            </div>

            <div class="card">
                <p style="font-size: 14px; color: var(--text-muted); line-height: 1.8;">
                    {{ $user->profile->about_long ?? $user->profile->about_short }}
                </p>
            </div>
        </section>
    @endif

    <!-- ================= SKILLS ================= -->
    @if(isset($user->skills) && $user->skills->count() > 0)
        <section class="section" id="skills">
            <div class="section-header">
                <div>
                    <div class="section-kicker">Skills</div>
                    <h2 class="section-title">What I work with</h2>
                </div>
                <div class="section-subtitle">
                    A blend of tools and languages I use to ship real products.
                </div>
            </div>

            <div class="grid">
                @foreach($user->skills as $skill)
                    @php
                        $level = strtolower($skill->level ?? '');
                        $percentage = 60;
                        if ($level === 'expert') $percentage = 95;
                        elseif ($level === 'intermediate') $percentage = 75;
                        elseif ($level === 'beginner') $percentage = 50;
                    @endphp
                    <div class="card">
                        <div class="skill-title">{{ $skill->name }}</div>
                        @if($skill->level)
                            <div class="skill-level">{{ strtoupper($skill->level) }}</div>
                        @endif
                        <div class="skill-bar">
                            <div class="skill-bar-fill" style="width: {{ $percentage }}%;"></div>
                        </div>
                        @if(!empty($skill->description))
                            <p style="font-size: 12px; color: var(--text-muted); margin-top: 6px;">
                                {{ $skill->description }}
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    <!-- ================= PROJECTS ================= -->
    @if(isset($user->projects) && $user->projects->count() > 0)
        <section class="section" id="projects">
            <div class="section-header">
                <div>
                    <div class="section-kicker">Projects</div>
                    <h2 class="section-title">Selected work</h2>
                </div>
                <div class="section-subtitle">
                    A few things I’ve built or collaborated on recently.
                </div>
            </div>

            <div class="grid grid-2">
                @foreach($user->projects as $project)
                    <article class="card project-card">
                        <div>
                            <div class="project-title">{{ $project->title }}</div>
                            @if($project->short_description)
                                <p class="project-description">{{ $project->short_description }}</p>
                            @endif>
                            @if($project->project_image)
                                <div class="project-image-chip">
                                    <span>🖼</span> Includes visuals
                                </div>
                            @endif
                            @if($project->project_url)
                                <a href="{{ $project->project_url }}" target="_blank" class="project-link">
                                    <span>Launch project</span>
                                    <span>↗</span>
                                </a>
                            @endif
                        </div>
                        @if($project->tech_stack ?? false)
                            <div class="project-meta">
                                {{ $project->tech_stack }}
                            </div>
                        @endif
                    </article>
                @endforeach
            </div>
        </section>
    @endif

    <!-- ================= EXPERIENCE ================= -->
    @if(isset($user->experiences) && $user->experiences->count() > 0)
        <section class="section" id="experience">
            <div class="section-header">
                <div>
                    <div class="section-kicker">Experience</div>
                    <h2 class="section-title">Where I’ve worked</h2>
                </div>
                <div class="section-subtitle">
                    Roles and collaborations that shaped my craft.
                </div>
            </div>

            <div class="card">
                <div class="timeline">
                    @foreach($user->experiences->sortByDesc('start_date') as $exp)
                        <div class="timeline-item">
                            <div class="timeline-dot"></div>
                            <div class="timeline-role">{{ $exp->role_title }}</div>
                            <div class="timeline-company">
                                {{ $exp->company }}
                                @if($exp->location) · {{ $exp->location }} @endif
                            </div>
                            <div class="timeline-date">
                                @if($exp->start_date)
                                    {{ \Illuminate\Support\Carbon::parse($exp->start_date)->format('M Y') }}
                                    –
                                    @if($exp->is_current)
                                        Present
                                    @elseif($exp->end_date)
                                        {{ \Illuminate\Support\Carbon::parse($exp->end_date)->format('M Y') }}
                                    @else
                                        …
                                    @endif
                                @endif
                            </div>
                            @if($exp->description)
                                <div class="timeline-desc">{{ $exp->description }}</div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- ================= EDUCATION ================= -->
    @if(isset($user->educations) && $user->educations->count() > 0)
        <section class="section" id="education">
            <div class="section-header">
                <div>
                    <div class="section-kicker">Education</div>
                    <h2 class="section-title">Learning journey</h2>
                </div>
                <div class="section-subtitle">
                    Formal education that supports my technical background.
                </div>
            </div>

            <div class="card">
                <div class="timeline">
                    @foreach($user->educations->sortByDesc('start_date') as $edu)
                        <div class="timeline-item">
                            <div class="timeline-dot"></div>
                            <div class="timeline-role">
                                {{ $edu->degree ?? 'Education' }}
                                @if($edu->field_of_study) – {{ $edu->field_of_study }} @endif
                            </div>
                            <div class="timeline-company">
                                {{ $edu->institution }}
                                @if($edu->location) · {{ $edu->location }} @endif
                            </div>
                            <div class="timeline-date">
                                @if($edu->start_date)
                                    {{ \Illuminate\Support\Carbon::parse($edu->start_date)->format('Y') }}
                                    –
                                    @if($edu->is_current)
                                        Present
                                    @elseif($edu->end_date)
                                        {{ \Illuminate\Support\Carbon::parse($edu->end_date)->format('Y') }}
                                    @else
                                        …
                                    @endif
                                @endif
                            </div>
                            @if($edu->description)
                                <div class="timeline-desc">{{ $edu->description }}</div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- ================= GOALS ================= -->
    @if(isset($user->goals) && $user->goals->count() > 0)
        <section class="section" id="goals">
            <div class="section-header">
                <div>
                    <div class="section-kicker">Goals</div>
                    <h2 class="section-title">What I’m aiming for</h2>
                </div>
                <div class="section-subtitle">
                    A look at what I want to build and learn next.
                </div>
            </div>

            <div class="card">
                <ul class="goals-list">
                    @foreach($user->goals as $goal)
                        <li class="goal-item">
                            <span>🎯</span>
                            <span>{{ $goal->goal_text }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif

    <!-- ================= CONTACT ================= -->
    <section class="section" id="contact">
        <div class="section-header">
            <div>
                <div class="section-kicker">Contact</div>
                <h2 class="section-title">Let’s build something</h2>
            </div>
            <div class="section-subtitle">
                A short message is all it takes to start.
            </div>
        </div>

        <div class="contact-card">
            <div class="contact-main">
                @if(isset($user->profile) && $user->profile->about_short)
                    <p>{{ $user->profile->about_short }}</p>
                @else
                    <p>
                        I’m always open to discussing new projects, collaborations, or just talking about design, code,
                        and ideas. Tell me what you’re working on and how I can help.
                    </p>
                @endif

                @if(isset($user->profile) && $user->profile->contact_email)
                    <div class="contact-pill">
                        <span>✉️</span>
                        <a href="mailto:{{ $user->profile->contact_email }}">{{ $user->profile->contact_email }}</a>
                    </div>
                @endif

                @if(isset($user->profile) && $user->profile->location)
                    <div class="contact-pill">
                        <span>📍</span>
                        <span>{{ $user->profile->location }}</span>
                    </div>
                @endif
            </div>

            <div class="contact-side">
                Tip: you can add a real contact form here in Laravel (name, email, message) and send it to your inbox
                or store as leads in your database.
            </div>
        </div>

        <div class="footer-note">
            © {{ now()->year }} {{ $user->name }} · Designed with care.
        </div>
    </section>
</div>

</body>
</html>
