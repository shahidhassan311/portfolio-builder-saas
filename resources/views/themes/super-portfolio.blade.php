<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('themes.partials.seo-meta')
    <link rel="icon" type="image/png" href="{{ asset(config('branding.logo')) }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,500&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #08080a;
            --bg-elevated: #111113;
            --surface: #161618;
            --surface-hover: #1c1c1f;
            --border: rgba(255, 255, 255, 0.08);
            --border-strong: rgba(255, 255, 255, 0.14);
            --text: #f4f4f5;
            --text-muted: #a1a1aa;
            --text-dim: #71717a;
            --gold: #d4b896;
            --gold-soft: rgba(212, 184, 150, 0.15);
            --accent: #a78bfa;
            --accent-soft: rgba(167, 139, 250, 0.12);
            --radius: 14px;
            --radius-lg: 22px;
            --radius-xl: 28px;
            --shadow: 0 24px 48px rgba(0, 0, 0, 0.45);
            --font-display: "Cormorant Garamond", Georgia, serif;
            --font-body: "Outfit", system-ui, sans-serif;
            --max: 1120px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }

        body {
            font-family: var(--font-body);
            font-size: 16px;
            line-height: 1.65;
            color: var(--text);
            background: var(--bg);
            background-image:
                radial-gradient(ellipse 80% 50% at 50% -20%, rgba(167, 139, 250, 0.08), transparent),
                radial-gradient(ellipse 60% 40% at 100% 0%, rgba(212, 184, 150, 0.06), transparent);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        a { color: inherit; text-decoration: none; }

        .preview-ribbon {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            padding: 10px 20px;
            text-align: center;
            font-size: 13px;
            font-weight: 500;
            background: linear-gradient(90deg, rgba(212, 184, 150, 0.2), rgba(167, 139, 250, 0.2));
            border-bottom: 1px solid var(--border);
            backdrop-filter: blur(12px);
        }

        .preview-ribbon a {
            color: var(--gold);
            font-weight: 600;
            margin-left: 8px;
        }

        body.has-preview { padding-top: 44px; }

        .page {
            max-width: var(--max);
            margin: 0 auto;
            padding: 32px 24px 80px;
        }

        /* Nav */
        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            padding: 16px 0 40px;
            border-bottom: 1px solid var(--border);
            margin-bottom: 48px;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .nav-avatar {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            overflow: hidden;
            background: var(--surface);
            border: 1px solid var(--border-strong);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-display);
            font-size: 22px;
            font-weight: 700;
            color: var(--gold);
        }

        .nav-avatar img { width: 100%; height: 100%; object-fit: cover; }

        .nav-name {
            font-family: var(--font-display);
            font-size: 1.35rem;
            font-weight: 600;
            letter-spacing: 0.02em;
        }

        .nav-role {
            font-size: 13px;
            color: var(--text-muted);
            font-weight: 400;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 28px;
            font-size: 13px;
            font-weight: 500;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .nav-links a {
            color: var(--text-muted);
            transition: color 0.2s;
        }

        .nav-links a:hover { color: var(--gold); }

        .nav-cta {
            padding: 10px 22px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 600;
            background: var(--gold);
            color: #1a1510;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .nav-cta:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(212, 184, 150, 0.35);
        }

        /* Hero */
        .hero {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 40px;
            align-items: start;
            margin-bottom: 72px;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 20px;
        }

        .hero-eyebrow::before {
            content: "";
            width: 32px;
            height: 1px;
            background: var(--gold);
        }

        .hero-heading {
            font-family: var(--font-display);
            font-size: clamp(2.5rem, 5vw, 3.75rem);
            font-weight: 600;
            line-height: 1.1;
            letter-spacing: -0.02em;
            margin-bottom: 20px;
        }

        .hero-heading em {
            font-style: italic;
            color: var(--gold);
        }

        .hero-lead {
            font-size: 1.0625rem;
            color: var(--text-muted);
            max-width: 520px;
            margin-bottom: 32px;
            font-weight: 300;
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
            padding: 14px 26px;
            border-radius: 999px;
            background: var(--gold);
            color: #1a1510;
            font-size: 14px;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(212, 184, 150, 0.3);
        }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 13px 24px;
            border-radius: 999px;
            border: 1px solid var(--border-strong);
            color: var(--text);
            font-size: 14px;
            font-weight: 500;
            transition: border-color 0.2s, background 0.2s;
        }

        .btn-ghost:hover {
            border-color: rgba(212, 184, 150, 0.4);
            background: var(--surface);
        }

        .hero-panel {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-xl);
            padding: 28px;
            box-shadow: var(--shadow);
        }

        .hero-profile {
            display: flex;
            gap: 18px;
            align-items: center;
            margin-bottom: 24px;
            padding-bottom: 24px;
            border-bottom: 1px solid var(--border);
        }

        .hero-avatar-lg {
            width: 88px;
            height: 88px;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid var(--border-strong);
            background: var(--bg-elevated);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-display);
            font-size: 2rem;
            font-weight: 700;
            color: var(--gold);
        }

        .hero-avatar-lg img { width: 100%; height: 100%; object-fit: cover; }

        .hero-profile-name {
            font-family: var(--font-display);
            font-size: 1.5rem;
            font-weight: 600;
        }

        .hero-profile-role {
            font-size: 14px;
            color: var(--text-muted);
            margin-top: 4px;
        }

        .hero-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 24px;
        }

        .hero-stat {
            padding: 16px;
            border-radius: var(--radius);
            background: var(--bg-elevated);
            border: 1px solid var(--border);
        }

        .hero-stat-num {
            font-family: var(--font-display);
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--gold);
        }

        .hero-stat-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--text-dim);
            margin-top: 4px;
        }

        .hero-social-title {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--text-dim);
            margin-bottom: 12px;
        }

        .hero-social-links {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .hero-social-links a {
            padding: 8px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 500;
            border: 1px solid var(--border);
            color: var(--text-muted);
            transition: all 0.2s;
        }

        .hero-social-links a:hover {
            border-color: var(--gold);
            color: var(--gold);
            background: var(--gold-soft);
        }

        /* Sections */
        .section { margin-bottom: 64px; }

        .section-head {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 28px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border);
        }

        .section-kicker {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 8px;
        }

        .section-title {
            font-family: var(--font-display);
            font-size: 2rem;
            font-weight: 600;
            letter-spacing: -0.02em;
        }

        .section-sub {
            font-size: 14px;
            color: var(--text-muted);
            max-width: 280px;
            text-align: right;
            line-height: 1.5;
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 24px;
            transition: border-color 0.25s, transform 0.25s;
        }

        .card:hover {
            border-color: rgba(212, 184, 150, 0.25);
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .grid-2 { grid-template-columns: repeat(2, 1fr); }

        /* Skills */
        .skill-name {
            font-weight: 600;
            font-size: 15px;
            margin-bottom: 4px;
        }

        .skill-level {
            font-size: 11px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-dim);
            margin-bottom: 12px;
        }

        .skill-bar {
            height: 4px;
            border-radius: 999px;
            background: var(--bg-elevated);
            overflow: hidden;
        }

        .skill-bar-fill {
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(90deg, var(--gold), var(--accent));
        }

        /* Projects */
        .project-title {
            font-family: var(--font-display);
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .project-desc {
            font-size: 14px;
            color: var(--text-muted);
            line-height: 1.6;
        }

        .project-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 16px;
            font-size: 13px;
            font-weight: 600;
            color: var(--gold);
        }

        .project-link:hover { text-decoration: underline; }

        /* Timeline */
        .timeline { padding-left: 20px; position: relative; }

        .timeline::before {
            content: "";
            position: absolute;
            left: 5px;
            top: 8px;
            bottom: 8px;
            width: 1px;
            background: linear-gradient(var(--gold), transparent);
        }

        .timeline-item {
            position: relative;
            padding-left: 24px;
            margin-bottom: 24px;
        }

        .timeline-item:last-child { margin-bottom: 0; }

        .timeline-dot {
            position: absolute;
            left: 0;
            top: 6px;
            width: 11px;
            height: 11px;
            border-radius: 50%;
            background: var(--bg);
            border: 2px solid var(--gold);
        }

        .timeline-role {
            font-weight: 600;
            font-size: 15px;
        }

        .timeline-org {
            font-size: 14px;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .timeline-date {
            font-size: 12px;
            color: var(--text-dim);
            margin-top: 4px;
        }

        .timeline-desc {
            font-size: 14px;
            color: var(--text-muted);
            margin-top: 8px;
            line-height: 1.6;
        }

        /* Goals */
        .goals-list { list-style: none; display: grid; gap: 12px; }

        .goal-item {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            padding: 14px 16px;
            border-radius: var(--radius);
            background: var(--bg-elevated);
            border: 1px solid var(--border);
            font-size: 14px;
            color: var(--text-muted);
        }

        .goal-item::before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--gold);
            margin-top: 8px;
            flex-shrink: 0;
        }

        /* Contact */
        .contact-grid {
            display: grid;
            grid-template-columns: 1.4fr 1fr;
            gap: 24px;
        }

        .contact-lead {
            font-size: 15px;
            color: var(--text-muted);
            line-height: 1.75;
        }

        .contact-lead p + p { margin-top: 12px; }

        .contact-email {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 20px;
            font-size: 15px;
            font-weight: 600;
            color: var(--gold);
        }

        .contact-aside {
            padding: 24px;
            border-radius: var(--radius-lg);
            background: var(--bg-elevated);
            border: 1px dashed var(--border-strong);
            font-size: 13px;
            color: var(--text-dim);
            line-height: 1.6;
        }

        .footer-note {
            text-align: center;
            margin-top: 56px;
            padding-top: 24px;
            border-top: 1px solid var(--border);
            font-size: 12px;
            color: var(--text-dim);
            letter-spacing: 0.04em;
        }

        @media (max-width: 960px) {
            .hero, .contact-grid { grid-template-columns: 1fr; }
            .grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 720px) {
            .nav-links { display: none; }
            .section-head { flex-direction: column; align-items: flex-start; }
            .section-sub { text-align: left; }
            .grid, .grid-2 { grid-template-columns: 1fr; }
            .page { padding-inline: 18px; }
        }
    </style>
</head>
<body class="{{ !empty($isPreview) ? 'has-preview' : '' }}">

@if(!empty($isPreview))
    <div class="preview-ribbon">
        Theme preview — sample content
        <a href="{{ url('/') }}#themes">Choose this template</a>
    </div>
@endif

<div class="page">
    <header class="nav">
        <div class="nav-brand">
            <div class="nav-avatar">
                @if(isset($user->profile) && $user->profile->profile_image)
                    <img src="{{ asset('storage/'.$user->profile->profile_image) }}" alt="{{ $user->name }}">
                @else
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                @endif
            </div>
            <div>
                <div class="nav-name">{{ $user->name }}</div>
                <div class="nav-role">{{ $user->profile->tagline ?? 'Creative Developer' }}</div>
            </div>
        </div>

        <nav class="nav-links">
            <a href="#about">About</a>
            <a href="#skills">Skills</a>
            <a href="#projects">Work</a>
            @if(isset($user->experiences) && $user->experiences->count())
                <a href="#experience">Experience</a>
            @endif
            @if(isset($user->goals) && $user->goals->count())
                <a href="#goals">Goals</a>
            @endif
        </nav>

        @if(isset($user->profile) && $user->profile->contact_email)
            <a href="#contact" class="nav-cta">Contact</a>
        @endif
    </header>

    <section class="hero" id="top">
        <div>
            <div class="hero-eyebrow">Available for work</div>
            <h1 class="hero-heading">
                Crafting <em>refined</em> digital experiences with purpose.
            </h1>
            <p class="hero-lead">
                {{ $user->profile->about_short ?? 'I design and build premium web products — focused on clarity, performance, and detail that earns trust.' }}
            </p>
            <div class="hero-actions">
                @if(isset($user->profile) && $user->profile->contact_email)
                    <a href="#contact" class="btn-primary">Start a conversation</a>
                @endif
                @if(isset($user->projects) && $user->projects->count())
                    <a href="#projects" class="btn-ghost">View work</a>
                @endif
                @if(empty($isPreview) && $user->id)
                    <a href="{{ route('portfolio.pdf', ['id' => $user->id, 'username' => $user->username]) }}" class="btn-ghost" target="_blank">Download CV</a>
                @else
                    <span class="btn-ghost" style="opacity:0.5;cursor:default;">Download CV</span>
                @endif
            </div>
        </div>

        <aside class="hero-panel">
            <div class="hero-profile">
                <div class="hero-avatar-lg">
                    @if(isset($user->profile) && $user->profile->profile_image)
                        <img src="{{ asset('storage/'.$user->profile->profile_image) }}" alt="{{ $user->name }}">
                    @else
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    @endif
                </div>
                <div>
                    <div class="hero-profile-name">{{ $user->name }}</div>
                    <div class="hero-profile-role">{{ $user->profile->tagline ?? 'Full-Stack Developer' }}</div>
                    @if(isset($user->profile) && $user->profile->location)
                        <div class="hero-profile-role" style="margin-top:6px;">{{ $user->profile->location }}</div>
                    @endif
                </div>
            </div>

            <div class="hero-stats">
                <div class="hero-stat">
                    <div class="hero-stat-num">{{ isset($user->projects) ? $user->projects->count() : '5' }}</div>
                    <div class="hero-stat-label">Projects</div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-num">{{ isset($user->skills) ? $user->skills->count() : '8' }}</div>
                    <div class="hero-stat-label">Core skills</div>
                </div>
            </div>

            @if(isset($user->profile) && ($user->profile->social_github || $user->profile->social_linkedin || $user->profile->social_twitter || $user->profile->social_instagram || $user->profile->social_facebook))
                <div>
                    <div class="hero-social-title">Connect</div>
                    <div class="hero-social-links">
                        @if($user->profile->social_github)
                            <a href="{{ $user->profile->social_github }}" target="_blank" rel="noopener">GitHub</a>
                        @endif
                        @if($user->profile->social_linkedin)
                            <a href="{{ $user->profile->social_linkedin }}" target="_blank" rel="noopener">LinkedIn</a>
                        @endif
                        @if($user->profile->social_twitter)
                            <a href="{{ $user->profile->social_twitter }}" target="_blank" rel="noopener">Twitter</a>
                        @endif
                        @if($user->profile->social_instagram)
                            <a href="{{ $user->profile->social_instagram }}" target="_blank" rel="noopener">Instagram</a>
                        @endif
                        @if($user->profile->social_facebook)
                            <a href="{{ $user->profile->social_facebook }}" target="_blank" rel="noopener">Facebook</a>
                        @endif
                    </div>
                </div>
            @endif
        </aside>
    </section>

    @if(isset($user->profile) && ($user->profile->about_title || $user->profile->about_long || $user->profile->about_short))
        <section class="section" id="about">
            <div class="section-head">
                <div>
                    <div class="section-kicker">About</div>
                    <h2 class="section-title">{{ $user->profile->about_title ?? 'Philosophy' }}</h2>
                </div>
                <p class="section-sub">How I approach design, code, and collaboration.</p>
            </div>
            <div class="card">
                <p style="font-size:15px;color:var(--text-muted);line-height:1.8;">
                    {{ $user->profile->about_long ?? $user->profile->about_short }}
                </p>
            </div>
        </section>
    @endif

    @if(isset($user->skills) && $user->skills->count() > 0)
        <section class="section" id="skills">
            <div class="section-head">
                <div>
                    <div class="section-kicker">Expertise</div>
                    <h2 class="section-title">Skills & tools</h2>
                </div>
                <p class="section-sub">Technologies I use to ship polished products.</p>
            </div>
            <div class="grid">
                @foreach($user->skills as $skill)
                    @php
                        $level = strtolower($skill->level ?? '');
                        $percentage = match($level) {
                            'expert' => 95,
                            'intermediate' => 72,
                            'beginner' => 45,
                            default => 60,
                        };
                    @endphp
                    <div class="card">
                        <div class="skill-name">{{ $skill->name }}</div>
                        @if($skill->level)
                            <div class="skill-level">{{ $skill->level }}</div>
                        @endif
                        <div class="skill-bar">
                            <div class="skill-bar-fill" style="width:{{ $percentage }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    @if(isset($user->projects) && $user->projects->count() > 0)
        <section class="section" id="projects">
            <div class="section-head">
                <div>
                    <div class="section-kicker">Portfolio</div>
                    <h2 class="section-title">Selected work</h2>
                </div>
                <p class="section-sub">Projects that reflect my standards for craft.</p>
            </div>
            <div class="grid">
                @foreach($user->projects as $project)
                    <article class="card">
                        <h3 class="project-title">{{ $project->title }}</h3>
                        @if($project->short_description)
                            <p class="project-desc">{{ $project->short_description }}</p>
                        @endif
                        @if($project->project_url)
                            <a href="{{ $project->project_url }}" target="_blank" rel="noopener" class="project-link">
                                View project →
                            </a>
                        @endif
                    </article>
                @endforeach
            </div>
        </section>
    @endif

    @if(isset($user->experiences) && $user->experiences->count() > 0)
        <section class="section" id="experience">
            <div class="section-head">
                <div>
                    <div class="section-kicker">Career</div>
                    <h2 class="section-title">Experience</h2>
                </div>
                <p class="section-sub">Roles that shaped how I build.</p>
            </div>
            <div class="card">
                <div class="timeline">
                    @foreach($user->experiences->sortByDesc('start_date') as $exp)
                        <div class="timeline-item">
                            <div class="timeline-dot"></div>
                            <div class="timeline-role">{{ $exp->role_title }}</div>
                            <div class="timeline-org">
                                {{ $exp->company }}@if($exp->location) · {{ $exp->location }}@endif
                            </div>
                            <div class="timeline-date">
                                @if($exp->start_date)
                                    {{ \Illuminate\Support\Carbon::parse($exp->start_date)->format('M Y') }} –
                                    {{ $exp->is_current ? 'Present' : ($exp->end_date ? \Illuminate\Support\Carbon::parse($exp->end_date)->format('M Y') : '…') }}
                                @endif
                            </div>
                            @if($exp->description)
                                <p class="timeline-desc">{{ $exp->description }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if(isset($user->educations) && $user->educations->count() > 0)
        <section class="section" id="education">
            <div class="section-head">
                <div>
                    <div class="section-kicker">Education</div>
                    <h2 class="section-title">Academic path</h2>
                </div>
            </div>
            <div class="card">
                <div class="timeline">
                    @foreach($user->educations->sortByDesc('start_date') as $edu)
                        <div class="timeline-item">
                            <div class="timeline-dot"></div>
                            <div class="timeline-role">
                                {{ $edu->degree ?? 'Degree' }}@if($edu->field_of_study) — {{ $edu->field_of_study }}@endif
                            </div>
                            <div class="timeline-org">{{ $edu->institution }}</div>
                            @if($edu->description)
                                <p class="timeline-desc">{{ $edu->description }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if(isset($user->goals) && $user->goals->count() > 0)
        <section class="section" id="goals">
            <div class="section-head">
                <div>
                    <div class="section-kicker">Forward</div>
                    <h2 class="section-title">Goals</h2>
                </div>
            </div>
            <div class="card">
                <ul class="goals-list">
                    @foreach($user->goals as $goal)
                        <li class="goal-item">{{ $goal->goal_text }}</li>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif

    <section class="section" id="contact">
        <div class="section-head">
            <div>
                <div class="section-kicker">Contact</div>
                <h2 class="section-title">Let's collaborate</h2>
            </div>
            <p class="section-sub">Open to roles, freelance, and meaningful projects.</p>
        </div>
        <div class="contact-grid">
            <div class="card contact-lead">
                @if(isset($user->profile) && $user->profile->about_short)
                    <p>{{ $user->profile->about_short }}</p>
                @else
                    <p>I'd love to hear about what you're building. Share a brief overview and I'll respond within 48 hours.</p>
                @endif
                @if(isset($user->profile) && $user->profile->contact_email)
                    <a href="mailto:{{ $user->profile->contact_email }}" class="contact-email">{{ $user->profile->contact_email }}</a>
                @endif
            </div>
            <div class="contact-aside">
                Based in {{ $user->profile->location ?? 'your city' }}. Prefer email for first contact — calendar links and forms can be added in your dashboard.
            </div>
        </div>
        <p class="footer-note">© {{ now()->year }} {{ $user->name }}</p>
    </section>
</div>
</body>
</html>
