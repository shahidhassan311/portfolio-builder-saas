<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - Portfolio</title>


    <link rel="icon" type="image/png" href="resumizo-logo-white.png" />
    <style>
        :root {
            --primary: #667eea;
            --primary-dark: #4c51bf;
            --primary-soft: #e0e7ff;
            --bg-soft: #f9fafb;
            --text-main: #111827;
            --text-muted: #6b7280;
            --card-bg: #ffffff;
            --shadow-soft: 0 18px 45px rgba(15, 23, 42, 0.18);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            line-height: 1.6;
            color: var(--text-main);
            background: radial-gradient(circle at 0% 0%, rgba(102, 126, 234, 0.18), transparent 55%),
                        radial-gradient(circle at 100% 0%, rgba(118, 75, 162, 0.18), transparent 55%),
                        #0f172a;
        }

        .page-wrapper {
            min-height: 100vh;
            background:
                radial-gradient(circle at 10% 20%, rgba(148, 163, 255, 0.25), transparent 60%),
                radial-gradient(circle at 90% 10%, rgba(129, 140, 248, 0.15), transparent 55%);
        }

        .hero {
            background: radial-gradient(circle at 0% 0%, rgba(129, 140, 248, 0.3), transparent 55%),
                        linear-gradient(135deg, #1e293b 0%, #020617 65%);
            color: white;
            padding: 96px 24px 88px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before,
        .hero::after {
            content: "";
            position: absolute;
            inset: 0;
            pointer-events: none;
        }

        .hero::before {
            background:
                radial-gradient(circle at 15% 20%, rgba(129, 140, 248, 0.22), transparent 55%),
                radial-gradient(circle at 85% 0%, rgba(129, 140, 248, 0.35), transparent 45%);
            opacity: 0.9;
        }

        .hero::after {
            background-image: radial-gradient(circle at 0 0, rgba(255, 255, 255, 0.04) 0, transparent 50%),
                              radial-gradient(circle at 100% 0, rgba(255, 255, 255, 0.04) 0, transparent 50%);
            mix-blend-mode: soft-light;
        }

        .hero-inner {
            position: relative;
            max-width: 1120px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: minmax(0, 1.4fr) minmax(0, 1fr);
            gap: 56px;
            align-items: center;
            z-index: 1;
        }

        .hero-main {
            text-align: left;
            animation: slideInUp 0.8s ease-out;
        }

        .hero-pill {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.24em;
            padding: 8px 18px;
            border-radius: 999px;
            background: rgba(15, 23, 42, 0.7);
            border: 1px solid rgba(148, 163, 255, 0.6);
            color: #e5e7eb;
        }

        .hero-name {
            font-size: clamp(36px, 5.6vw, 62px);
            font-weight: 800;
            margin: 20px 0 10px;
            letter-spacing: -0.04em;
        }

        .hero-name span {
            background: linear-gradient(120deg, #a5b4fc, #f9a8d4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-tagline {
            font-size: 20px;
            margin-bottom: 20px;
            color: #c7d2fe;
        }

        .hero-description {
            font-size: 17px;
            margin-bottom: 32px;
            color: #e5e7eb;
            max-width: 540px;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            align-items: center;
        }

        .cta-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 14px 30px;
            border-radius: 999px;
            text-decoration: none;
            font-weight: 600;
            letter-spacing: 0.08em;
            font-size: 13px;
            border: 1px solid transparent;
            transition: transform 0.28s ease, box-shadow 0.28s ease, background 0.28s ease, border-color 0.28s ease, color 0.28s ease;
            cursor: pointer;
        }

        .cta-primary {
            background: linear-gradient(120deg, var(--primary), #a855f7);
            color: #0b1120;
            box-shadow: 0 18px 45px rgba(55, 48, 163, 0.55);
        }

        .cta-secondary {
            background: transparent;
            border-color: rgba(165, 180, 252, 0.8);
            color: #e5e7eb;
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 22px 60px rgba(15, 23, 42, 0.7);
        }

        .hero-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 18px;
            margin-top: 26px;
            font-size: 14px;
            color: #cbd5f5;
        }

        .hero-meta span {
            opacity: 0.9;
        }

        .hero-side {
            justify-self: center;
            animation: slideInRight 0.9s ease-out;
        }

        .hero-card {
            width: 320px;
            max-width: 100%;
            border-radius: 28px;
            background: radial-gradient(circle at 0% 0%, rgba(129, 140, 248, 0.3), transparent 55%),
                        rgba(15, 23, 42, 0.96);
            border: 1px solid rgba(148, 163, 255, 0.5);
            box-shadow: var(--shadow-soft);
            padding: 26px 24px 24px;
            position: relative;
            overflow: hidden;
        }

        .hero-card::after {
            content: "";
            position: absolute;
            inset: 0;
            background-image: linear-gradient(120deg, rgba(129, 140, 248, 0.08), transparent);
            mix-blend-mode: screen;
            opacity: 0.65;
            pointer-events: none;
        }

        .hero-avatar {
            width: 140px;
            height: 140px;
            border-radius: 999px;
            border: 4px solid rgba(191, 219, 254, 0.9);
            margin: 0 auto 18px;
            object-fit: cover;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.9);
        }

        .hero-avatar-fallback {
            width: 140px;
            height: 140px;
            border-radius: 999px;
            border: 4px solid rgba(191, 219, 254, 0.9);
            margin: 0 auto 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 52px;
            font-weight: 700;
            background: radial-gradient(circle at 15% 0, #a5b4fc, #4f46e5);
            color: #e5e7eb;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.9);
        }

        .hero-card-name {
            text-align: center;
            font-weight: 700;
            font-size: 20px;
            color: #e5e7eb;
        }

        .hero-card-role {
            text-align: center;
            font-size: 13px;
            color: #c7d2fe;
            margin-top: 4px;
            margin-bottom: 14px;
        }

        .hero-card-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(148, 163, 255, 0.85), transparent);
            margin: 10px 0 14px;
        }

        .hero-badges {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 10px;
        }

        .hero-badge {
            flex: 1;
            border-radius: 16px;
            border: 1px solid rgba(148, 163, 255, 0.5);
            background: rgba(15, 23, 42, 0.7);
            padding: 8px 10px;
            text-align: center;
        }

        .hero-badge strong {
            display: block;
            font-size: 18px;
            color: #e5e7eb;
        }

        .hero-badge span {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.16em;
            color: #c7d2fe;
        }

        .hero-social {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            justify-content: center;
            margin-top: 8px;
        }

        .hero-social a {
            width: 34px;
            height: 34px;
            border-radius: 999px;
            border: 1px solid rgba(165, 180, 252, 0.9);
            font-size: 13px;
            color: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            background: rgba(15, 23, 42, 0.7);
            transition: transform 0.25s ease, box-shadow 0.25s ease, background 0.25s ease, color 0.25s ease;
        }

        .hero-social a:hover {
            transform: translateY(-2px) scale(1.04);
            background: #e5e7eb;
            color: #111827;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.8);
        }

        .section {
            padding: 70px 24px;
            max-width: 1120px;
            margin: 0 auto;
        }

        .section.alt {
            background: var(--bg-soft);
            border-radius: 36px 36px 0 0;
            margin-top: -32px;
            position: relative;
            z-index: 2;
        }

        .section-title {
            font-size: 30px;
            font-weight: 700;
            margin-bottom: 12px;
            text-align: center;
            color: var(--text-main);
            letter-spacing: -0.03em;
        }

        .section-sub {
            text-align: center;
            max-width: 620px;
            margin: 0 auto 40px;
            font-size: 15px;
            color: var(--text-muted);
        }

        .about-text {
            font-size: 17px;
            line-height: 1.8;
            max-width: 800px;
            margin: 0 auto;
            color: var(--text-muted);
        }

        .two-col {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
            gap: 28px;
            align-items: flex-start;
        }

        .card {
            background: var(--card-bg);
            border-radius: 20px;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.12);
            padding: 24px 24px 22px;
        }

        .card-header {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-main);
        }

        .card-chip {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: var(--primary-dark);
            background: var(--primary-soft);
            padding: 4px 12px;
            border-radius: 999px;
        }

        .timeline {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .timeline-item {
            position: relative;
            padding-left: 26px;
        }

        .timeline-item::before {
            content: "";
            position: absolute;
            left: 8px;
            top: 4px;
            width: 10px;
            height: 10px;
            border-radius: 999px;
            background: var(--primary);
            box-shadow: 0 0 0 5px rgba(129, 140, 248, 0.28);
        }

        .timeline-item::after {
            content: "";
            position: absolute;
            left: 12px;
            top: 18px;
            bottom: -14px;
            width: 2px;
            background: linear-gradient(to bottom, rgba(148, 163, 255, 0.6), transparent);
        }

        .timeline-item:last-child::after {
            display: none;
        }

        .timeline-title {
            font-size: 15px;
            font-weight: 600;
            color: var(--text-main);
        }

        .timeline-meta {
            font-size: 13px;
            color: var(--primary-dark);
            margin-top: 2px;
        }

        .timeline-dates {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.16em;
            color: var(--text-muted);
            margin-top: 4px;
        }

        .timeline-body {
            font-size: 13px;
            color: var(--text-muted);
            margin-top: 6px;
        }

        .skills-container {
            display: flex;
            flex-direction: column;
            gap: 14px;
            max-width: 800px;
            margin: 0 auto;
        }

        .skill-item {
            background: var(--card-bg);
            padding: 16px 18px 14px;
            border-radius: 16px;
            box-shadow: 0 14px 30px rgba(15, 23, 42, 0.08);
            border: 1px solid rgba(148, 163, 255, 0.4);
        }

        .skill-name {
            font-weight: 600;
            font-size: 15px;
            margin-bottom: 6px;
            display: flex;
            justify-content: space-between;
            align-items: baseline;
        }

        .skill-name span {
            font-size: 12px;
            color: var(--primary-dark);
        }

        .skill-bar {
            background: #e5e7eb;
            height: 9px;
            border-radius: 999px;
            overflow: hidden;
        }

        .skill-level {
            background: linear-gradient(90deg, var(--primary), #a855f7);
            height: 100%;
            width: 0;
            border-radius: inherit;
            box-shadow: 0 0 0 1px rgba(129, 140, 248, 0.3);
            transition: width 0.9s ease-out;
        }

        .projects-container {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 24px;
            max-width: 1120px;
            margin: 0 auto;
        }

        @media (max-width: 1024px) {
            .projects-container {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .projects-container {
                grid-template-columns: minmax(0, 1fr);
            }
        }

        .project-card {
            background: var(--card-bg);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.16);
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .project-image {
            width: 100%;
            height: 210px;
            object-fit: cover;
        }

        .project-content {
            padding: 22px 24px 20px;
        }

        .project-title {
            font-size: 19px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-main);
        }

        .project-description {
            color: var(--text-muted);
            margin-bottom: 12px;
            font-size: 14px;
        }

        .project-link {
            color: var(--primary-dark);
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .goals-list {
            list-style: none;
            max-width: 800px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .goals-list li {
            background: var(--card-bg);
            padding: 16px 18px 14px;
            border-radius: 16px;
            border-left: 4px solid var(--primary);
            color: var(--text-muted);
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.09);
            font-size: 14px;
        }

        .footer {
            background: #020617;
            color: #e5e7eb;
            padding: 40px 24px 36px;
            text-align: center;
            border-top: 1px solid rgba(148, 163, 255, 0.3);
            margin-top: 40px;
        }

        .social-links {
            display: flex;
            gap: 18px;
            justify-content: center;
            margin-top: 16px;
            flex-wrap: wrap;
        }

        .social-links a {
            color: #e5e7eb;
            text-decoration: none;
            font-size: 14px;
            letter-spacing: 0.16em;
            text-transform: uppercase;
        }

        .fade-in-section {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.7s ease-out, transform 0.7s ease-out;
        }

        .fade-in-section.visible {
            opacity: 1;
            transform: translateY(0);
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(40px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @media (max-width: 900px) {
            .hero-inner {
                grid-template-columns: minmax(0, 1fr);
                text-align: center;
            }

            .hero-main {
                text-align: center;
            }

            .hero-actions,
            .hero-meta {
                justify-content: center;
            }

            .hero-description {
                margin-left: auto;
                margin-right: auto;
            }

            .hero-side {
                order: -1;
            }
        }

        @media (max-width: 768px) {
            .section {
                padding-inline: 18px;
            }

            .project-card {
                grid-template-columns: minmax(0, 1fr);
            }
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <div class="hero" id="hero">
            <div class="hero-inner">
                <div class="hero-main">
                    <div class="hero-pill">Personal Portfolio</div>
                    <h1 class="hero-name">
                        Hi, I'm <span>{{ $user->name }}</span>
                    </h1>
                    @if(isset($user->profile) && $user->profile->tagline)
                        <p class="hero-tagline">{{ $user->profile->tagline }}</p>
                    @endif
                    @if(isset($user->profile) && $user->profile->about_short)
                        <p class="hero-description">{{ $user->profile->about_short }}</p>
                    @endif

                    <div class="hero-actions">
                        @if(isset($user->profile) && ($user->profile->contact_email || $user->profile->location))
                            <a href="#contact" class="cta-button cta-primary">
                                <span>Contact Me</span>
                            </a>
                        @endif
                        <a href="{{ route('portfolio.pdf', ['id' => $user->id, 'username' => $user->username]) }}"
                           class="cta-button cta-secondary"
                           target="_blank">
                            <span>📄 Download CV</span>
                        </a>
                    </div>

                    <div class="hero-meta">
                        @if(isset($user->profile) && $user->profile->location)
                            <span>📍 {{ $user->profile->location }}</span>
                        @endif
                        @if(isset($user->profile) && $user->profile->contact_email)
                            <span>✉️ {{ $user->profile->contact_email }}</span>
                        @endif
                    </div>
                </div>

                <div class="hero-side">
                    <div class="hero-card">
                        @if(isset($user->profile) && $user->profile->profile_image)
                            <img src="{{ asset('storage/' . $user->profile->profile_image) }}" alt="{{ $user->name }}" class="hero-avatar">
                        @else
                            <div class="hero-avatar-fallback">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif

                        <div class="hero-card-name">{{ $user->name }}</div>
                        <div class="hero-card-role">
                            {{ isset($user->profile) && $user->profile->tagline ? $user->profile->tagline : 'Creative Professional' }}
                        </div>

                        <div class="hero-card-divider"></div>

                        @php
                            $expCount = isset($user->experiences) ? $user->experiences->count() : 0;
                            $projCount = isset($user->projects) ? $user->projects->count() : 0;
                            $skillCount = isset($user->skills) ? $user->skills->count() : 0;
                        @endphp
                        <div class="hero-badges">
                            <div class="hero-badge">
                                <strong>{{ $expCount }}</strong>
                                <span>Experience</span>
                            </div>
                            <div class="hero-badge">
                                <strong>{{ $projCount }}</strong>
                                <span>Projects</span>
                            </div>
                            <div class="hero-badge">
                                <strong>{{ $skillCount }}</strong>
                                <span>Skills</span>
                            </div>
                        </div>

                        @if(isset($user->profile) && (
                            $user->profile->social_linkedin ||
                            $user->profile->social_github   ||
                            $user->profile->social_twitter  ||
                            $user->profile->social_instagram||
                            $user->profile->social_facebook
                        ))
                            <div class="hero-social">
                                @if($user->profile->social_linkedin)
                                    <a href="{{ $user->profile->social_linkedin }}" target="_blank">in</a>
                                @endif
                                @if($user->profile->social_github)
                                    <a href="{{ $user->profile->social_github }}" target="_blank">GH</a>
                                @endif
                                @if($user->profile->social_twitter)
                                    <a href="{{ $user->profile->social_twitter }}" target="_blank">X</a>
                                @endif
                                @if($user->profile->social_instagram)
                                    <a href="{{ $user->profile->social_instagram }}" target="_blank">IG</a>
                                @endif
                                @if($user->profile->social_facebook)
                                    <a href="{{ $user->profile->social_facebook }}" target="_blank">f</a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    @php
        $hasAbout = isset($user->profile) && ($user->profile->about_title || $user->profile->about_short || $user->profile->about_long);
        $hasSkills = isset($user->skills) && $user->skills->count() > 0;
        $hasProjects = isset($user->projects) && $user->projects->count() > 0;
        $hasGoals = isset($user->goals) && $user->goals->count() > 0;
        $hasExperience = isset($user->experiences) && $user->experiences->count() > 0;
        $hasEducation = isset($user->educations) && $user->educations->count() > 0;
    @endphp

    @if($hasAbout)
        <div class="section section alt fade-in-section" id="about">
            <h2 class="section-title">{{ $user->profile->about_title ?? 'About Me' }}</h2>
            <p class="section-sub">A quick snapshot of who I am, how I work, and what I love building.</p>
            <div class="about-text">
                @if($user->profile->about_short)
                    <p>{{ $user->profile->about_short }}</p>
                @endif
                @if($user->profile->about_long)
                    <p style="margin-top: 18px;">{{ $user->profile->about_long }}</p>
                @endif
            </div>
        </div>
    @endif

    @if($hasExperience || $hasEducation)
        <div class="section fade-in-section" id="experience">
            <h2 class="section-title">Journey</h2>
            <p class="section-sub">Where I've been investing my time — professionally and academically.</p>

            <div class="two-col">
                @if($hasExperience)
                    <div class="card">
                        <div class="card-header">
                            <p class="card-title">Experience</p>
                            <span class="card-chip">Professional</span>
                        </div>
                        <div class="timeline">
                            @foreach($user->experiences as $exp)
                                <div class="timeline-item">
                                    <div class="timeline-title">
                                        {{ $exp->title ?? $exp->role_title ?? 'Experience' }}
                                    </div>
                                    <div class="timeline-meta">
                                        {{ $exp->company }}
                                        @if(!empty($exp->location))
                                            · {{ $exp->location }}
                                        @endif
                                    </div>
                                    <div class="timeline-dates">
                                        @if($exp->start_date)
                                            {{ \Carbon\Carbon::parse($exp->start_date)->format('M Y') }}
                                        @endif
                                        @if($exp->end_date)
                                            – {{ \Carbon\Carbon::parse($exp->end_date)->format('M Y') }}
                                        @elseif(!empty($exp->is_current))
                                            – Present
                                        @endif
                                    </div>
                                    @if(!empty($exp->description))
                                        <div class="timeline-body">{{ $exp->description }}</div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($hasEducation)
                    <div class="card">
                        <div class="card-header">
                            <p class="card-title">Education</p>
                            <span class="card-chip">Academic</span>
                        </div>
                        <div class="timeline">
                            @foreach($user->educations as $edu)
                                <div class="timeline-item">
                                    <div class="timeline-title">
                                        {{ $edu->degree ?? 'Education' }}
                                    </div>
                                    <div class="timeline-meta">
                                        {{ $edu->institution }}
                                        @if(!empty($edu->field_of_study))
                                            · {{ $edu->field_of_study }}
                                        @endif
                                    </div>
                                    <div class="timeline-dates">
                                        @if($edu->start_date)
                                            {{ \Carbon\Carbon::parse($edu->start_date)->format('Y') }}
                                        @endif
                                        @if($edu->end_date)
                                            – {{ \Carbon\Carbon::parse($edu->end_date)->format('Y') }}
                                        @elseif(!empty($edu->is_current))
                                            – Present
                                        @endif
                                    </div>
                                    @if(!empty($edu->description))
                                        <div class="timeline-body">{{ $edu->description }}</div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif

    @if($hasSkills)
        <div class="section fade-in-section" id="skills">
            <h2 class="section-title">Skills</h2>
            <p class="section-sub">A mix of tools, technologies, and disciplines I use to ship work.</p>
            <div class="skills-container">
                @foreach($user->skills as $skill)
                    @php
                        $percent = 60;
                        if ($skill->level === 'Beginner') $percent = 40;
                        if ($skill->level === 'Intermediate') $percent = 75;
                        if ($skill->level === 'Expert') $percent = 95;
                    @endphp
                    <div class="skill-item">
                        <div class="skill-name">
                            <span>{{ $skill->name }}</span>
                            @if($skill->level)
                                <span>{{ $skill->level }}</span>
                            @endif
                        </div>
                        <div class="skill-bar">
                            <div class="skill-level" data-skill-width="{{ $percent }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if($hasProjects)
        <div class="section fade-in-section" id="projects">
            <h2 class="section-title">Projects</h2>
            <p class="section-sub">Selected work that reflects how I think about design, code, and impact.</p>
            <div class="projects-container">
                @foreach($user->projects as $project)
                    <div class="project-card">
                        @if($project->project_image)
                            <img src="{{ asset('storage/' . $project->project_image) }}" alt="{{ $project->title }}" class="project-image">
                        @else
                            <div style="background: var(--primary-soft); display:flex; align-items:center; justify-content:center; color: var(--primary-dark); font-weight: 700; font-size: 24px;">
                                {{ strtoupper(substr($project->title, 0, 1)) }}
                            </div>
                        @endif
                        <div class="project-content">
                            <h3 class="project-title">{{ $project->title }}</h3>
                            @if($project->short_description)
                                <p class="project-description">{{ $project->short_description }}</p>
                            @endif
                            @if($project->project_url)
                                <a href="{{ $project->project_url }}" target="_blank" class="project-link">View Project →</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if($hasGoals)
        <div class="section fade-in-section" id="goals">
            <h2 class="section-title">Goals</h2>
            <p class="section-sub">What I'm currently learning and where I want to grow next.</p>
            <ul class="goals-list">
                @foreach($user->goals as $goal)
                    <li>{{ $goal->goal_text }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="footer" id="contact">
        @if(isset($user->profile) && ($user->profile->contact_email || $user->profile->location))
            <div>
                @if($user->profile->contact_email)
                    <p>📧 {{ $user->profile->contact_email }}</p>
                @endif
                @if($user->profile->location)
                    <p>📍 {{ $user->profile->location }}</p>
                @endif
            </div>
        @endif
        @if(isset($user->profile) && (
            $user->profile->social_facebook ||
            $user->profile->social_linkedin ||
            $user->profile->social_github   ||
            $user->profile->social_instagram||
            $user->profile->social_twitter
        ))
            <div class="social-links">
                @if($user->profile->social_facebook)
                    <a href="{{ $user->profile->social_facebook }}" target="_blank">Facebook</a>
                @endif
                @if($user->profile->social_linkedin)
                    <a href="{{ $user->profile->social_linkedin }}" target="_blank">LinkedIn</a>
                @endif
                @if($user->profile->social_github)
                    <a href="{{ $user->profile->social_github }}" target="_blank">GitHub</a>
                @endif
                @if($user->profile->social_instagram)
                    <a href="{{ $user->profile->social_instagram }}" target="_blank">Instagram</a>
                @endif
                @if($user->profile->social_twitter)
                    <a href="{{ $user->profile->social_twitter }}" target="_blank">Twitter</a>
                @endif
            </div>
        @endif
    </div>
    </div>

    <script>
        // Fade-in on scroll
        const sections = document.querySelectorAll('.fade-in-section');
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');

                        // Animate skill bars when skills section appears
                        if (entry.target.id === 'skills') {
                            entry.target.querySelectorAll('.skill-level').forEach(bar => {
                                const width = bar.getAttribute('data-skill-width');
                                bar.style.width = width;
                            });
                        }
                    }
                });
            },
            { threshold: 0.2 }
        );

        sections.forEach(section => observer.observe(section));
    </script>
</body>
</html>

