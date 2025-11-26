<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $user->name }} - Portfolio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-main: #f5f5f7;
            --bg-card: #ffffff;
            --accent: #f24e1e; /* primary red/orange */
            --accent-dark: #c22f10;
            --text-main: #111827;
            --text-muted: #6b7280;
            --border-soft: #e5e7eb;
            --shadow-soft: 0 18px 40px rgba(15,23,42,0.12);
            --radius-lg: 18px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont,
            "Segoe UI", sans-serif;
            background: radial-gradient(circle at top, #ffffff 0, #f5f5f7 50%, #e5e7eb 100%);
            color: var(--text-main);
            line-height: 1.6;
        }

        a { color: inherit; text-decoration: none; }

        .container {
            max-width: 1120px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        section { padding: 5rem 0; }

        /******** NAV ********/
        .nav {
            position: sticky;
            top: 0;
            z-index: 30;
            background: rgba(255,255,255,0.96);
            backdrop-filter: blur(18px);
            border-bottom: 1px solid rgba(229,231,235,0.9);
        }

        .nav-inner {
            max-width: 1120px;
            margin: 0 auto;
            padding: 0.9rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: .65rem;
        }

        .nav-logo-mark {
            width: 32px;
            height: 32px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--accent), #ff7a3c);
            color: #fff;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 18px rgba(242,78,30,0.45);
        }

        .nav-logo-text {
            font-weight: 600;
            font-size: .95rem;
            letter-spacing: .06em;
            text-transform: uppercase;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            font-size: .85rem;
        }

        .nav-link {
            color: var(--text-muted);
            position: relative;
            padding-bottom: 2px;
        }

        .nav-link::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 0;
            height: 2px;
            border-radius: 999px;
            background: var(--accent);
            transition: width .18s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--text-main);
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        .nav-cta {
            padding: 0.55rem 1.1rem;
            border-radius: 999px;
            border: 1px solid var(--accent);
            color: #fff;
            background: var(--accent);
            font-size: .8rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: .35rem;
        }

        .nav-cta:hover {
            background: var(--accent-dark);
            border-color: var(--accent-dark);
        }

        @media (max-width: 768px) {
            .nav-links { display: none; }
        }

        /******** HERO ********/
        .hero {
            padding-top: 4rem;
            padding-bottom: 4rem;
        }

        .hero-inner {
            display: grid;
            grid-template-columns: minmax(0, 1.4fr) minmax(0, 1.1fr);
            gap: 3rem;
            align-items: center;
        }

        @media (max-width: 900px) {
            .hero-inner { grid-template-columns: minmax(0,1fr); }
        }

        .hero-eyebrow {
            font-size: .75rem;
            text-transform: uppercase;
            letter-spacing: .16em;
            color: var(--accent);
            margin-bottom: .6rem;
            font-weight: 600;
        }

        .hero-name {
            font-size: clamp(2.2rem, 4vw, 3rem);
            font-weight: 700;
            line-height: 1.05;
            margin-bottom: .5rem;
        }

        .hero-role {
            font-size: 1rem;
            color: var(--text-muted);
            margin-bottom: 1.2rem;
        }

        .hero-summary {
            font-size: .95rem;
            color: var(--text-muted);
            max-width: 32rem;
            margin-bottom: 1.8rem;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: .75rem;
            align-items: center;
            margin-bottom: 1.4rem;
        }

        .btn-primary {
            padding: .85rem 1.5rem;
            border-radius: 999px;
            border: none;
            background: var(--accent);
            color: #fff;
            font-weight: 600;
            font-size: .9rem;
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            box-shadow: 0 14px 28px rgba(242,78,30,0.45);
        }

        .btn-primary:hover {
            background: var(--accent-dark);
        }

        .btn-outline {
            padding: .82rem 1.4rem;
            border-radius: 999px;
            border: 1px solid var(--border-soft);
            background: #fff;
            font-size: .9rem;
            color: var(--text-main);
            display: inline-flex;
            align-items: center;
            gap: .35rem;
        }

        .btn-outline:hover {
            border-color: var(--accent);
            color: var(--accent-dark);
        }

        .hero-meta {
            display: flex;
            flex-wrap: wrap;
            gap: .9rem;
            font-size: .8rem;
            color: var(--text-muted);
        }

        .hero-meta-item {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
        }

        .hero-right {
            display: flex;
            justify-content: flex-end;
        }

        @media (max-width: 900px) {
            .hero-right { justify-content: center; }
        }

        .hero-card {
            width: min(340px, 100%);
            border-radius: 30px;
            background: var(--bg-card);
            box-shadow: var(--shadow-soft);
            padding: 1.6rem 1.6rem 1.4rem;
            border: 1px solid #f3f4f6;
        }

        .hero-photo-wrapper {
            position: relative;
            width: 190px;
            height: 190px;
            border-radius: 999px;
            margin: 0 auto 1rem;
            background: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .hero-photo-inner {
            width: 168px;
            height: 168px;
            border-radius: 999px;
            background: #fff;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 700;
            color: var(--accent);
        }

        .hero-photo-inner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-card-name {
            text-align: center;
            font-size: 1.05rem;
            font-weight: 600;
        }

        .hero-card-role {
            text-align: center;
            font-size: .8rem;
            color: var(--text-muted);
            margin-bottom: .8rem;
        }

        .hero-card-divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #fca5a5, transparent);
            margin: .6rem 0 .9rem;
        }

        .hero-pill {
            font-size: .75rem;
            padding: .35rem .7rem;
            border-radius: 999px;
            border: 1px solid #fee2e2;
            background: #fef2f2;
            color: var(--accent-dark);
            text-align: center;
            margin-bottom: .7rem;
        }

        .hero-social {
            display: flex;
            justify-content: center;
            gap: .5rem;
            flex-wrap: wrap;
        }

        .hero-social a {
            width: 30px;
            height: 30px;
            border-radius: 999px;
            border: 1px solid var(--border-soft);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .72rem;
            color: var(--text-muted);
        }

        .hero-social a:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        /******** SECTIONS ********/
        .section-header {
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            gap: 1rem;
        }

        .section-title {
            font-size: 1.4rem;
            font-weight: 600;
        }

        .section-sub {
            font-size: .9rem;
            color: var(--text-muted);
            max-width: 28rem;
        }

        .two-col {
            display: grid;
            grid-template-columns: minmax(0, 1.4fr) minmax(0, 1.1fr);
            gap: 2.5rem;
        }

        @media (max-width: 900px) {
            .two-col { grid-template-columns: minmax(0,1fr); }
        }

        /* ABOUT */
        .about-text p + p { margin-top: 1rem; font-size: .95rem; }
        .about-text { font-size: .95rem; color: var(--text-muted); }

        .stat-card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-soft);
            padding: 1.1rem 1.2rem;
            box-shadow: 0 10px 22px rgba(15,23,42,0.08);
            font-size: .9rem;
        }

        .stat-label { font-size: .78rem; text-transform: uppercase; letter-spacing: .1em; color: var(--text-muted); margin-bottom: .3rem; }
        .stat-value { font-size: 1.1rem; font-weight: 600; }

        /* SKILLS */
        .skills-list {
            display: grid;
            gap: .75rem;
        }

        .skill-item {
            background: #f9fafb;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            padding: .75rem .9rem;
        }

        .skill-top {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: .3rem;
        }

        .skill-name { font-size: .9rem; font-weight: 500; }
        .skill-level { font-size: .75rem; color: var(--text-muted); }

        .skill-bar {
            width: 100%;
            height: 6px;
            border-radius: 999px;
            background: #e5e7eb;
            overflow: hidden;
        }

        .skill-fill {
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(to right, #fecaca, var(--accent));
            width: 0;
        }

        .skill-tags {
            display: flex;
            flex-wrap: wrap;
            gap: .4rem;
        }

        .skill-tag {
            font-size: .78rem;
            padding: .25rem .6rem;
            border-radius: 999px;
            border: 1px solid #e5e7eb;
            background: #fff;
            color: var(--text-muted);
        }

        /* EXPERIENCE & EDUCATION */
        .timeline {
            display: grid;
            grid-template-columns: minmax(0,1fr);
            gap: 1rem;
        }

        .timeline-item {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-soft);
            padding: 1rem 1.1rem;
            box-shadow: 0 10px 22px rgba(15,23,42,0.05);
            font-size: .9rem;
        }

        .timeline-role { font-weight: 600; font-size: .95rem; }
        .timeline-place { font-size: .83rem; color: var(--text-muted); margin-bottom: .15rem; }
        .timeline-meta { font-size: .78rem; color: var(--text-muted); margin-bottom: .45rem; }
        .timeline-desc { font-size: .85rem; color: var(--text-muted); }

        /* PROJECTS */
        .project-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr);
            gap: 1.2rem;
        }

        .project-card {
            display: grid;
            grid-template-columns: minmax(0,1.2fr) minmax(0,1.1fr);
            gap: 1rem;
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-soft);
            box-shadow: 0 16px 34px rgba(15,23,42,0.08);
            overflow: hidden;
        }

        .project-media {
            background: #fee2e2;
            min-height: 150px;
        }

        .project-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .project-body {
            padding: .95rem 1.1rem;
            font-size: .9rem;
        }

        .project-title { font-weight: 600; margin-bottom: .25rem; }
        .project-desc { color: var(--text-muted); margin-bottom: .45rem; }
        .project-link { font-size: .82rem; color: var(--accent-dark); }

        .project-link:hover { text-decoration: underline; }

        @media (max-width: 900px) {
            .project-card { grid-template-columns: minmax(0,1fr); }
        }

        /* CONTACT */
        .contact-card {
            background: var(--bg-card);
            border-radius: 24px;
            padding: 1.4rem 1.5rem;
            border: 1px solid var(--border-soft);
            box-shadow: var(--shadow-soft);
            display: grid;
            grid-template-columns: minmax(0,1.1fr) minmax(0,1.1fr);
            gap: 1.8rem;
            font-size: .9rem;
        }

        @media (max-width: 900px) {
            .contact-card { grid-template-columns: minmax(0,1fr); }
        }

        .contact-line { margin-bottom: .35rem; color: var(--text-muted); }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            padding: .6rem .75rem;
            font-size: .85rem;
            margin-bottom: .6rem;
        }

        .contact-form textarea { resize: vertical; min-height: 90px; }

        .contact-form button {
            width: 100%;
        }

        /* FOOTER */
        .footer {
            padding: 1.4rem 1.5rem 2rem;
            font-size: .78rem;
            color: var(--text-muted);
            text-align: center;
        }
    </style>
</head>
<body>

@php
    $profile     = optional($user->profile);
    $hasAbout    = $profile->about_short || $profile->about_long || $profile->about_title;
    $hasSkills   = $user->skills->count() ?? 0;
    $hasProjects = $user->projects->count() ?? 0;
    $hasGoals    = $user->goals->count() ?? 0;
    $hasExp      = method_exists($user, 'experiences') && $user->experiences->count();
    $hasEdu      = method_exists($user, 'educations') && $user->educations->count();
    $hasContact  = $profile->contact_email || $profile->location;
    $hasSocial   = $profile->social_facebook || $profile->social_linkedin || $profile->social_github
                   || $profile->social_instagram || $profile->social_twitter;
@endphp

<header class="nav">
    <div class="nav-inner">
        <div class="nav-logo">
            <div class="nav-logo-mark">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div class="nav-logo-text">
                {{ $user->name }}
            </div>
        </div>

        <nav class="nav-links">
            <a href="#hero" class="nav-link active">Home</a>
            @if($hasAbout)<a href="#about" class="nav-link">About</a>@endif
            @if($hasExp || $hasEdu)<a href="#experience" class="nav-link">Experience</a>@endif
            @if($hasSkills)<a href="#skills" class="nav-link">Skills</a>@endif
            @if($hasProjects)<a href="#projects" class="nav-link">Projects</a>@endif
            @if($hasContact)
                <a href="#contact" class="nav-cta">Contact</a>
            @endif
        </nav>
    </div>
</header>

<main>
    <!-- HERO -->
    <section id="hero" class="hero">
        <div class="container">
            <div class="hero-inner">
                <div class="hero-left">
                    <div class="hero-eyebrow">Software Professional</div>
                    <h1 class="hero-name">{{ $user->name }}</h1>

                    @if($profile->tagline)
                        <p class="hero-role">{{ $profile->tagline }}</p>
                    @endif

                    @if($profile->about_short)
                        <p class="hero-summary">{{ $profile->about_short }}</p>
                    @endif

                    <div class="hero-actions">
                        @if($hasProjects)
                            <a href="#projects" class="btn-primary">
                                View portfolio →
                            </a>
                        @endif

                        {{-- CV / PDF BUTTON --}}
                        <a href="{{ route('portfolio.pdf', ['id' => $user->id, 'username' => $user->username]) }}"
                           class="btn-outline" target="_blank">
                            Download CV
                        </a>
                    </div>

                    <div class="hero-meta">
                        @if($profile->location)
                            <div class="hero-meta-item">
                                <span>📍</span><span>{{ $profile->location }}</span>
                            </div>
                        @endif
                        @if($profile->contact_email)
                            <div class="hero-meta-item">
                                <span>✉️</span><span>{{ $profile->contact_email }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="hero-right">
                    <div class="hero-card">
                        <div class="hero-photo-wrapper">
                            <div class="hero-photo-inner">
                                @if($profile->profile_image)
                                    <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="{{ $user->name }}">
                                @else
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                @endif
                            </div>
                        </div>

                        <div class="hero-card-name">{{ $user->name }}</div>
                        <div class="hero-card-role">
                            {{ $profile->tagline ?: 'Product-focused developer' }}
                        </div>

                        <div class="hero-card-divider"></div>

                        <div class="hero-pill">
                            Open to freelance & remote roles
                        </div>

                        @if($hasSocial)
                            <div class="hero-social">
                                @if($profile->social_linkedin)
                                    <a href="{{ $profile->social_linkedin }}" target="_blank">in</a>
                                @endif
                                @if($profile->social_github)
                                    <a href="{{ $profile->social_github }}" target="_blank">GH</a>
                                @endif
                                @if($profile->social_twitter)
                                    <a href="{{ $profile->social_twitter }}" target="_blank">X</a>
                                @endif
                                @if($profile->social_instagram)
                                    <a href="{{ $profile->social_instagram }}" target="_blank">IG</a>
                                @endif
                                @if($profile->social_facebook)
                                    <a href="{{ $profile->social_facebook }}" target="_blank">f</a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($hasAbout)
        <!-- ABOUT -->
        <section id="about">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">{{ $profile->about_title ?? 'About Me' }}</h2>
                    <p class="section-sub">A quick snapshot of who I am and how I work.</p>
                </div>

                <div class="two-col">
                    <div class="about-text">
                        @if($profile->about_short)
                            <p>{{ $profile->about_short }}</p>
                        @endif
                        @if($profile->about_long)
                            <p>{{ $profile->about_long }}</p>
                        @endif
                    </div>

                    <div class="stats">
                        <div class="stat-card">
                            <div class="stat-label">Focus</div>
                            <div class="stat-value">
                                {{ $profile->tagline ?: 'Building clean and reliable digital products' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if($hasExp || $hasEdu)
        <!-- EXPERIENCE / EDUCATION -->
        <section id="experience">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Experience & Education</h2>
                    <p class="section-sub">Professional background and academic journey.</p>
                </div>

                <div class="two-col">
                    @if($hasExp)
                        <div>
                            <h3 style="font-size:.95rem; font-weight:600; margin-bottom:.5rem;">Experience</h3>
                            <div class="timeline">
                                @foreach($user->experiences as $exp)
                                    <div class="timeline-item">
                                        <div class="timeline-role">{{ $exp->title }}</div>
                                        <div class="timeline-place">{{ $exp->company }}</div>
                                        <div class="timeline-meta">
                                            {{ $exp->start_date }} – {{ $exp->end_date ?? 'Present' }}
                                        </div>
                                        @if($exp->description)
                                            <div class="timeline-desc">{{ $exp->description }}</div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($hasEdu)
                        <div>
                            <h3 style="font-size:.95rem; font-weight:600; margin-bottom:.5rem;">Education</h3>
                            <div class="timeline">
                                @foreach($user->educations as $edu)
                                    <div class="timeline-item">
                                        <div class="timeline-role">{{ $edu->degree }}</div>
                                        <div class="timeline-place">{{ $edu->institution }}</div>
                                        <div class="timeline-meta">
                                            {{ $edu->start_year }} – {{ $edu->end_year ?? 'Present' }}
                                        </div>
                                        @if($edu->description)
                                            <div class="timeline-desc">{{ $edu->description }}</div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif

    @if($hasSkills)
        <!-- SKILLS -->
        <section id="skills">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Skills</h2>
                    <p class="section-sub">The tools and technologies I work with day-to-day.</p>
                </div>

                <div class="two-col">
                    <div class="skills-list">
                        @foreach($user->skills as $skill)
                            @php
                                $percent = 60;
                                if ($skill->level === 'Beginner') $percent = 40;
                                if ($skill->level === 'Intermediate') $percent = 70;
                                if ($skill->level === 'Expert') $percent = 95;
                            @endphp
                            <div class="skill-item">
                                <div class="skill-top">
                                    <div class="skill-name">{{ $skill->name }}</div>
                                    @if($skill->level)
                                        <div class="skill-level">{{ $skill->level }}</div>
                                    @endif
                                </div>
                                <div class="skill-bar">
                                    <div class="skill-fill" style="width: {{ $percent }}%;"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div>
                        <p class="section-sub" style="margin-bottom:.8rem;">
                            A quick overview of my stack. Let’s choose the right tools for your project together.
                        </p>
                        <div class="skill-tags">
                            @foreach($user->skills as $skill)
                                <span class="skill-tag">{{ $skill->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if($hasProjects)
        <!-- PROJECTS -->
        <section id="projects">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Selected Projects</h2>
                    <p class="section-sub">Recent work that shows how I approach design and engineering.</p>
                </div>

                <div class="project-grid">
                    @foreach($user->projects as $project)
                        <article class="project-card">
                            <div class="project-media">
                                @if($project->project_image)
                                    <img src="{{ asset('storage/' . $project->project_image) }}" alt="{{ $project->title }}">
                                @endif
                            </div>
                            <div class="project-body">
                                <h3 class="project-title">{{ $project->title }}</h3>
                                @if($project->short_description)
                                    <p class="project-desc">{{ $project->short_description }}</p>
                                @endif
                                @if($project->project_url)
                                    <a href="{{ $project->project_url }}" target="_blank" class="project-link">
                                        View live project →
                                    </a>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($hasContact)
        <!-- CONTACT -->
        <section id="contact">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Let’s work together</h2>
                    <p class="section-sub">
                        Share a few details about your idea, and I’ll follow up with next steps.
                    </p>
                </div>

                <div class="contact-card">
                    <div>
                        @if($profile->contact_email)
                            <p class="contact-line"><strong>Email:</strong> {{ $profile->contact_email }}</p>
                        @endif
                        @if($profile->location)
                            <p class="contact-line"><strong>Location:</strong> {{ $profile->location }}</p>
                        @endif>
                        <p class="contact-line" style="margin-top:.6rem;">
                            I’m happy to discuss freelance work, collaborations, or full-time roles.
                        </p>
                    </div>

                    <!-- Dummy front-end form; hook it up if you want -->
                    <form class="contact-form" onsubmit="return false;">
                        <input type="text" placeholder="Your name">
                        <input type="email" placeholder="Your email">
                        <textarea placeholder="Project details, timeline, or questions"></textarea>
                        <button class="btn-primary" type="submit">Send message</button>
                    </form>
                </div>
            </div>
        </section>
    @endif
</main>

<footer class="footer">
    © {{ date('Y') }} {{ $user->name }} — Portfolio generated with Portfolio Builder.
</footer>

</body>
</html>
