<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - Portfolio</title>

    <link rel="icon" type="image/png" href="resumizo-logo-white.png" />
    <style>
        :root {
            --bg: #f5f5fb;
            --bg-soft: #eef1f9;
            --bg-deep: #050816;
            --primary: #4f46e5;
            --primary-soft: rgba(79, 70, 229, 0.08);
            --accent: #f97316;
            --accent-soft: rgba(249, 115, 22, 0.09);
            --card-bg: #ffffff;
            --card-border: #e5e7eb;
            --radius-lg: 22px;
            --radius-md: 18px;
            --shadow-soft: 0 18px 40px rgba(15, 23, 42, 0.12);
            --text-main: #111827;
            --text-muted: #6b7280;
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
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "SF Pro Text", "Segoe UI", Roboto, sans-serif;
            background:
                radial-gradient(circle at 0 0, rgba(79, 70, 229, 0.12), transparent 55%),
                radial-gradient(circle at 100% 0, rgba(249, 115, 22, 0.12), transparent 55%),
                linear-gradient(to bottom, #f9fafb, #e5e7f5);
            color: var(--text-main);
            min-height: 100vh;
        }

        .page {
            max-width: 1240px;
            margin: 0 auto;
            padding: 24px 16px 60px;
        }

        /* ============ LAYOUT ============ */

        .layout {
            display: grid;
            grid-template-columns: minmax(0, 290px) minmax(0, 1fr);
            gap: 26px;
        }

        @media (max-width: 880px) {
            .layout {
                grid-template-columns: minmax(0, 1fr);
            }
        }

        /* ============ SIDEBAR ============ */

        .sidebar {
            position: sticky;
            top: 16px;
            align-self: flex-start;
            background: var(--card-bg);
            border-radius: 24px;
            border: 1px solid var(--card-border);
            box-shadow: var(--shadow-soft);
            padding: 20px 18px 18px;
        }

        .sidebar-header {
            display: flex;
            gap: 14px;
            margin-bottom: 14px;
        }

        .sidebar-avatar {
            width: 70px;
            height: 70px;
            border-radius: 20px;
            overflow: hidden;
            background: radial-gradient(circle at 20% 0, #e5e7eb, #9ca3af);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: 800;
            color: #111827;
            border: 2px solid #e5e7eb;
        }

        .sidebar-name {
            font-size: 19px;
            font-weight: 700;
        }

        .sidebar-role {
            font-size: 13px;
            color: var(--text-muted);
            margin-top: 4px;
        }

        .sidebar-location {
            font-size: 12px;
            color: #9ca3af;
            margin-top: 6px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .sidebar-divider {
            height: 1px;
            background: #e5e7eb;
            margin: 14px 0;
        }

        .sidebar-nav-title {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.18em;
            color: #9ca3af;
            margin-bottom: 8px;
        }

        .sidebar-nav {
            list-style: none;
            display: grid;
            gap: 6px;
            margin-bottom: 14px;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 7px 9px;
            border-radius: 999px;
            text-decoration: none;
            font-size: 13px;
            color: var(--text-muted);
            transition: background 0.15s ease, color 0.15s ease, transform 0.12s ease;
        }

        .sidebar-nav a span.dot {
            width: 6px;
            height: 6px;
            border-radius: 999px;
            background: #e5e7eb;
        }

        .sidebar-nav a:hover {
            background: var(--primary-soft);
            color: var(--primary);
            transform: translateX(2px);
        }

        .sidebar-nav a:hover span.dot {
            background: var(--primary);
        }

        .sidebar-tagline {
            font-size: 12px;
            color: var(--text-muted);
            background: #f9fafb;
            border-radius: 16px;
            padding: 10px 10px;
            border: 1px dashed #e5e7eb;
            margin-bottom: 10px;
        }

        .sidebar-contact {
            display: grid;
            gap: 8px;
            font-size: 12px;
        }

        .sidebar-contact-item {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--text-muted);
        }

        .sidebar-contact-item a {
            color: var(--primary);
            text-decoration: none;
        }

        .sidebar-contact-item a:hover {
            text-decoration: underline;
        }

        .sidebar-button {
            margin-top: 10px;
        }

        .btn-sidebar {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            width: 100%;
            padding: 9px 12px;
            border-radius: 999px;
            border: none;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            background: linear-gradient(to right, #4f46e5, #f97316);
            color: #fff;
            box-shadow: 0 12px 26px rgba(79, 70, 229, 0.55);
            text-decoration: none;
        }

        .btn-sidebar span.icon {
            font-size: 16px;
        }

        .sidebar-footer {
            margin-top: 12px;
            font-size: 11px;
            color: #9ca3af;
        }

        /* ============ MAIN ============ */

        .main {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        /* HERO / INTRO */

        .hero-card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            border: 1px solid var(--card-border);
            box-shadow: var(--shadow-soft);
            padding: 22px 22px 20px;
            position: relative;
            overflow: hidden;
        }

        .hero-card::before {
            content: "";
            position: absolute;
            inset: -40%;
            background:
                radial-gradient(circle at 0 0, rgba(79, 70, 229, 0.08), transparent 55%),
                radial-gradient(circle at 100% 0, rgba(249, 115, 22, 0.12), transparent 55%);
            opacity: 1;
        }

        .hero-inner {
            position: relative;
            z-index: 1;
        }

        .hero-pill-row {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 16px;
        }

        .hero-pill {
            font-size: 11px;
            padding: 6px 10px;
            border-radius: 999px;
            border: 1px solid #e5e7eb;
            background: #f9fafb;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #4b5563;
        }

        .hero-title {
            font-size: 26px;
            line-height: 1.2;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .hero-title span {
            background: linear-gradient(120deg, #4f46e5, #f97316);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .hero-tagline {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 16px;
        }

        .hero-meta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 18px;
            margin-bottom: 14px;
        }

        .hero-meta-item {
            font-size: 12px;
            color: var(--text-muted);
        }

        .hero-meta-label {
            text-transform: uppercase;
            letter-spacing: 0.14em;
            font-size: 10px;
            color: #9ca3af;
            margin-bottom: 3px;
        }

        .hero-meta-value {
            font-size: 13px;
            font-weight: 500;
            color: #111827;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 8px;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 999px;
            background: var(--primary);
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-primary span.icon {
            font-size: 16px;
        }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 999px;
            border: 1px solid #d1d5db;
            background: #fff;
            color: #374151;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
        }

        /* SECTION HEADERS */

        .section {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            border: 1px solid var(--card-border);
            box-shadow: var(--shadow-soft);
            padding: 20px 18px 18px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 10px;
            margin-bottom: 14px;
        }

        .section-title-block {
            display: flex;
            flex-direction: column;
        }

        .section-kicker {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.16em;
            color: #9ca3af;
            margin-bottom: 3px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
        }

        .section-subtitle {
            font-size: 12px;
            color: var(--text-muted);
            max-width: 280px;
            text-align: right;
        }

        /* GRID HELPERS */

        .grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
        }

        .grid-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .grid-1 {
            grid-template-columns: minmax(0, 1fr);
        }

        @media (max-width: 880px) {
            .grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .grid {
                grid-template-columns: minmax(0, 1fr);
            }

            .section-subtitle {
                text-align: left;
            }
        }

        .card {
            border-radius: var(--radius-md);
            border: 1px solid var(--card-border);
            background: #ffffff;
            padding: 14px 13px;
        }

        /* SKILLS */

        .skill-title {
            font-size: 14px;
            font-weight: 600;
        }

        .skill-level {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: #9ca3af;
            margin-top: 4px;
        }

        .skill-bar {
            margin-top: 8px;
            height: 7px;
            border-radius: 999px;
            background: #f3f4f6;
            overflow: hidden;
        }

        .skill-bar-fill {
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(to right, #4f46e5, #f97316);
        }

        .skill-desc {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 6px;
        }

        /* PROJECTS – GRID */

        .projects-strip {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
            padding-bottom: 0;
            overflow: visible;
        }

        @media (max-width: 1024px) {
            .projects-strip {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .projects-strip {
                grid-template-columns: minmax(0, 1fr);
            }
        }

        .project-slide {
            width: 100%;
            max-width: none;
            border-radius: var(--radius-md);
            border: 1px solid var(--card-border);
            background: #ffffff;
            padding: 14px 13px;
            box-shadow: 0 14px 30px rgba(15, 23, 42, 0.12);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .project-title {
            font-size: 15px;
            font-weight: 600;
        }

        .project-description {
            font-size: 13px;
            color: var(--text-muted);
            margin-top: 6px;
        }

        .project-meta {
            font-size: 11px;
            color: #9ca3af;
            margin-top: 8px;
        }

        .project-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 10px;
            font-size: 13px;
            color: var(--primary);
            text-decoration: none;
        }

        .project-link span.icon {
            font-size: 15px;
        }

        .project-has-image {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            color: #6b7280;
            background: #f3f4ff;
            padding: 4px 8px;
            border-radius: 999px;
            margin-top: 8px;
        }

        /* TIMELINE (experience / education) */

        .timeline {
            position: relative;
            padding-left: 16px;
        }

        .timeline::before {
            content: "";
            position: absolute;
            left: 5px;
            top: 2px;
            bottom: 4px;
            width: 1px;
            background: linear-gradient(to bottom, #d1d5db, transparent);
        }

        .timeline-item {
            position: relative;
            padding-left: 10px;
            margin-bottom: 14px;
        }

        .timeline-dot {
            position: absolute;
            left: 0;
            top: 4px;
            width: 9px;
            height: 9px;
            border-radius: 999px;
            border: 2px solid var(--primary);
            background: #ffffff;
        }

        .timeline-role {
            font-size: 14px;
            font-weight: 600;
        }

        .timeline-place {
            font-size: 13px;
            color: #374151;
        }

        .timeline-date {
            font-size: 11px;
            color: #9ca3af;
            margin-top: 2px;
        }

        .timeline-desc {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 6px;
        }

        /* GOALS */

        .goals-list {
            list-style: none;
            display: grid;
            gap: 8px;
        }

        .goal-item {
            font-size: 13px;
            color: #374151;
            padding: 8px 10px;
            border-radius: 16px;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            display: flex;
            gap: 8px;
            align-items: flex-start;
        }

        .goal-item span.icon {
            margin-top: 2px;
        }

        /* CONTACT / FOOTER */

        .contact-body {
            font-size: 13px;
            color: var(--text-muted);
        }

        .contact-body p + p {
            margin-top: 8px;
        }

        .contact-pill-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 12px;
        }

        .contact-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 10px;
            border-radius: 999px;
            background: #f3f4ff;
            font-size: 12px;
            color: #374151;
        }

        .contact-pill a {
            color: inherit;
            text-decoration: none;
        }

        .contact-pill a:hover {
            text-decoration: underline;
        }

        .footer-note {
            margin-top: 12px;
            font-size: 11px;
            color: #9ca3af;
            text-align: right;
        }
    </style>
</head>
<body>
<div class="page">

    <div class="layout">
        <!-- ========== SIDEBAR ========== -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-avatar">
                    @if(isset($user->profile) && $user->profile->profile_image)
                        <img src="{{ asset('storage/'.$user->profile->profile_image) }}" alt="{{ $user->name }}" style="width:100%;height:100%;object-fit:cover;">
                    @else
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    @endif
                </div>
                <div>
                    <div class="sidebar-name">{{ $user->name }}</div>
                    <div class="sidebar-role">
                        {{ $user->profile->tagline ?? 'Creative Developer & Designer' }}
                    </div>
                    @if(isset($user->profile) && $user->profile->location)
                        <div class="sidebar-location">
                            <span>📍</span><span>{{ $user->profile->location }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="sidebar-tagline">
                {{ $user->profile->about_short ?? 'Blending design, code, and product thinking to create clean, usable experiences.' }}
            </div>

            <div class="sidebar-divider"></div>

            <div class="sidebar-nav-title">Navigate</div>
            <ul class="sidebar-nav">
                @if(isset($user->profile) && ($user->profile->about_title || $user->profile->about_long || $user->profile->about_short))
                    <li><a href="#about"><span>About</span><span class="dot"></span></a></li>
                @endif
                @if(isset($user->skills) && $user->skills->count())
                    <li><a href="#skills"><span>Skills</span><span class="dot"></span></a></li>
                @endif
                @if(isset($user->projects) && $user->projects->count())
                    <li><a href="#projects"><span>Projects</span><span class="dot"></span></a></li>
                @endif
                @if(isset($user->experiences) && $user->experiences->count())
                    <li><a href="#experience"><span>Experience</span><span class="dot"></span></a></li>
                @endif
                @if(isset($user->educations) && $user->educations->count())
                    <li><a href="#education"><span>Education</span><span class="dot"></span></a></li>
                @endif
                @if(isset($user->goals) && $user->goals->count())
                    <li><a href="#goals"><span>Goals</span><span class="dot"></span></a></li>
                @endif
                <li><a href="#contact"><span>Contact</span><span class="dot"></span></a></li>
            </ul>

            <div class="sidebar-contact">
                @if(isset($user->profile) && $user->profile->contact_email)
                    <div class="sidebar-contact-item">
                        <span>✉️</span>
                        <a href="mailto:{{ $user->profile->contact_email }}">
                            {{ $user->profile->contact_email }}
                        </a>
                    </div>
                @endif
                @if(isset($user->profile) && $user->profile->social_github)
                    <div class="sidebar-contact-item">
                        <span>🐙</span>
                        <a href="{{ $user->profile->social_github }}" target="_blank">GitHub</a>
                    </div>
                @endif
                @if(isset($user->profile) && $user->profile->social_linkedin)
                    <div class="sidebar-contact-item">
                        <span>💼</span>
                        <a href="{{ $user->profile->social_linkedin }}" target="_blank">LinkedIn</a>
                    </div>
                @endif
            </div>

            @if(isset($user->profile) && $user->profile->contact_email)
                <div class="sidebar-button">
                    <a href="#contact" class="btn-sidebar">
                        <span class="icon">✨</span>
                        <span>Let’s collaborate</span>
                    </a>
                </div>
            @endif

            <div class="sidebar-footer">
                SuperPortfolioTwo · A clean, scrollable portfolio layout.
            </div>
        </aside>

        <!-- ========== MAIN CONTENT ========== -->
        <main class="main">
            <!-- HERO -->
            <section class="hero-card" id="top">
                <div class="hero-inner">
                    <div class="hero-pill-row">
                        <div class="hero-pill">
                            <span>🟢</span>
                            <span>Open to new opportunities</span>
                        </div>
                        @if(isset($user->experiences) && $user->experiences->count())
                            <div class="hero-pill">
                                <span>💼</span>
                                <span>{{ $user->experiences->count() }}+ roles</span>
                            </div>
                        @endif
                    </div>

                    <h1 class="hero-title">
                        I help build <span>clear, fast, and thoughtful</span> digital experiences.
                    </h1>

                    <p class="hero-tagline">
                        {{ $user->profile->about_short ?? 'From the first idea to a shipped product, I work across design and development to create interfaces that feel simple and intentional.' }}
                    </p>

                    <div class="hero-meta-row">
                        <div class="hero-meta-item">
                            <div class="hero-meta-label">Name</div>
                            <div class="hero-meta-value">{{ $user->name }}</div>
                        </div>

                        @if(isset($user->skills) && $user->skills->count())
                            <div class="hero-meta-item">
                                <div class="hero-meta-label">Core skills</div>
                                <div class="hero-meta-value">
                                    {{ $user->skills->take(3)->pluck('name')->implode(' · ') }}
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="hero-actions">
                        @if(isset($user->profile) && $user->profile->contact_email)
                            <a href="#contact" class="btn-primary">
                                <span>Work with me</span>
                                <span class="icon">→</span>
                            </a>
                        @endif

                        @if(isset($user->projects) && $user->projects->count())
                            <a href="#projects" class="btn-ghost">
                                <span>See selected projects</span>
                            </a>
                        @endif

                        <a href="{{ route('portfolio.pdf', ['id' => $user->id, 'username' => $user->username]) }}"
                           class="btn-ghost" target="_blank">
                            <span>📄 Download CV</span>
                        </a>
                    </div>
                </div>
            </section>

            <!-- ABOUT -->
            @if(isset($user->profile) && ($user->profile->about_title || $user->profile->about_long || $user->profile->about_short))
                <section class="section" id="about">
                    <div class="section-header">
                        <div class="section-title-block">
                            <div class="section-kicker">About</div>
                            <h2 class="section-title">{{ $user->profile->about_title ?? 'A bit about me' }}</h2>
                        </div>
                        <div class="section-subtitle">
                            How I think, what I care about, and how I like to work.
                        </div>
                    </div>

                    <div style="font-size: 13px; color: var(--text-muted); line-height: 1.7;">
                        {{ $user->profile->about_long ?? $user->profile->about_short }}
                    </div>
                </section>
            @endif

            <!-- SKILLS -->
            @if(isset($user->skills) && $user->skills->count())
                <section class="section" id="skills">
                    <div class="section-header">
                        <div class="section-title-block">
                            <div class="section-kicker">Skills</div>
                            <h2 class="section-title">Toolbox</h2>
                        </div>
                        <div class="section-subtitle">
                            Technologies and skills I use regularly to ship work.
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
                                    <div class="skill-desc">
                                        {{ $skill->description }}
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            <!-- PROJECTS (slider) -->
            @if(isset($user->projects) && $user->projects->count())
                <section class="section" id="projects">
                    <div class="section-header">
                        <div class="section-title-block">
                            <div class="section-kicker">Projects</div>
                            <h2 class="section-title">Selected work</h2>
                        </div>
                        <div class="section-subtitle">
                            Scroll sideways to explore recent projects and collaborations.
                        </div>
                    </div>

                    <div class="projects-strip">
                        @foreach($user->projects as $project)
                            <article class="project-slide">
                                <div class="project-title">{{ $project->title }}</div>

                                @if($project->short_description)
                                    <div class="project-description">
                                        {{ $project->short_description }}
                                    </div>
                                @endif

                                @if($project->project_image)
                                    <div class="project-has-image">
                                        <span>🖼</span> <span>Includes visuals</span>
                                    </div>
                                @endif

                                @if($project->tech_stack ?? false)
                                    <div class="project-meta">
                                        {{ $project->tech_stack }}
                                    </div>
                                @endif

                                @if($project->project_url)
                                    <a href="{{ $project->project_url }}" target="_blank" class="project-link">
                                        <span>Open project</span>
                                        <span class="icon">↗</span>
                                    </a>
                                @endif
                            </article>
                        @endforeach
                    </div>
                </section>
            @endif

            <!-- EXPERIENCE -->
            @if(isset($user->experiences) && $user->experiences->count())
                <section class="section" id="experience">
                    <div class="section-header">
                        <div class="section-title-block">
                            <div class="section-kicker">Experience</div>
                            <h2 class="section-title">Where I’ve contributed</h2>
                        </div>
                        <div class="section-subtitle">
                            Roles that shaped how I approach product, design, and engineering.
                        </div>
                    </div>

                    <div class="timeline">
                        @foreach($user->experiences->sortByDesc('start_date') as $exp)
                            <div class="timeline-item">
                                <div class="timeline-dot"></div>
                                <div class="timeline-role">{{ $exp->role_title }}</div>
                                <div class="timeline-place">
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
                </section>
            @endif

            <!-- EDUCATION -->
            @if(isset($user->educations) && $user->educations->count())
                <section class="section" id="education">
                    <div class="section-header">
                        <div class="section-title-block">
                            <div class="section-kicker">Education</div>
                            <h2 class="section-title">Learning path</h2>
                        </div>
                        <div class="section-subtitle">
                            Academic background that supports my work in tech.
                        </div>
                    </div>

                    <div class="timeline">
                        @foreach($user->educations->sortByDesc('start_date') as $edu)
                            <div class="timeline-item">
                                <div class="timeline-dot"></div>
                                <div class="timeline-role">
                                    {{ $edu->degree ?? 'Education' }}
                                    @if($edu->field_of_study) – {{ $edu->field_of_study }} @endif
                                </div>
                                <div class="timeline-place">
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
                </section>
            @endif

            <!-- GOALS -->
            @if(isset($user->goals) && $user->goals->count())
                <section class="section" id="goals">
                    <div class="section-header">
                        <div class="section-title-block">
                            <div class="section-kicker">Goals</div>
                            <h2 class="section-title">What’s next</h2>
                        </div>
                        <div class="section-subtitle">
                            Areas I want to grow in and problems I’m excited to solve.
                        </div>
                    </div>

                    <ul class="goals-list">
                        @foreach($user->goals as $goal)
                            <li class="goal-item">
                                <span class="icon">🎯</span>
                                <span>{{ $goal->goal_text }}</span>
                            </li>
                        @endforeach
                    </ul>
                </section>
            @endif

            <!-- CONTACT -->
            <section class="section" id="contact">
                <div class="section-header">
                    <div class="section-title-block">
                        <div class="section-kicker">Contact</div>
                        <h2 class="section-title">Let’s build something</h2>
                    </div>
                    <div class="section-subtitle">
                        A short message is enough to start a conversation.
                    </div>
                </div>

                <div class="contact-body">
                    @if(isset($user->profile) && $user->profile->about_short)
                        <p>{{ $user->profile->about_short }}</p>
                    @else
                        <p>
                            Whether it’s a new product, a redesign, or help refining an existing experience,
                            I’d love to hear what you’re working on and see how I can help.
                        </p>
                    @endif

                    <div class="contact-pill-row">
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
                </div>

                <div class="footer-note">
                    © {{ now()->year }} {{ $user->name }} · SuperPortfolioTwo.
                </div>
            </section>
        </main>
    </div>
</div>
</body>
</html>
