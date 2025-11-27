<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="resumizo-logo-white.png" />
    <title>{{ $user->name }} - Portfolio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --red-primary: #DC2626;
            --red-dark: #B91C1C;
            --red-light: #EF4444;
            --red-accent: #FEE2E2;
            --white: #FFFFFF;
            --gray-50: #FAFAFA;
            --gray-100: #F5F5F5;
            --gray-200: #E5E5E5;
            --gray-600: #525252;
            --gray-700: #404040;
            --gray-800: #262626;
            --gray-900: #171717;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            --shadow-red: 0 10px 30px -5px rgba(220, 38, 38, 0.3);
        }

        * { 
            margin: 0; 
            padding: 0; 
            box-sizing: border-box; 
        }

        body {
            font-family: "Inter", system-ui, -apple-system, sans-serif;
            background: var(--white);
            color: var(--gray-900);
            line-height: 1.7;
            overflow-x: hidden;
        }

        a { 
            color: inherit; 
            text-decoration: none; 
            transition: all 0.3s ease;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        section { 
            padding: 5rem 0; 
        }

        /******** NAVIGATION ********/
        .nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border-bottom: 2px solid var(--red-primary);
            box-shadow: var(--shadow-md);
        }

        .nav-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1.2rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 800;
            font-size: 1.25rem;
            color: var(--red-primary);
            letter-spacing: -0.02em;
        }

        .nav-logo-mark {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--red-primary), var(--red-light));
            color: var(--white);
            font-weight: 900;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-red);
            font-size: 1.1rem;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
            font-size: 0.95rem;
            font-weight: 500;
        }

        .nav-link {
            color: var(--gray-700);
            position: relative;
            padding: 0.5rem 0;
        }

        .nav-link::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 0;
            height: 3px;
            background: var(--red-primary);
            transition: width 0.3s ease;
            border-radius: 2px;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--red-primary);
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        .nav-cta {
            padding: 0.7rem 1.5rem;
            border-radius: 8px;
            background: var(--red-primary);
            color: var(--white);
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: var(--shadow-red);
        }

        .nav-cta:hover {
            background: var(--red-dark);
            transform: translateY(-2px);
            box-shadow: 0 15px 35px -5px rgba(220, 38, 38, 0.4);
        }

        @media (max-width: 768px) {
            .nav-links { display: none; }
            .nav-inner { padding: 1rem 1.5rem; }
        }

        /******** HERO SECTION ********/
        .hero {
            padding-top: 8rem;
            padding-bottom: 6rem;
            background: linear-gradient(135deg, var(--white) 0%, var(--gray-50) 100%);
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: "";
            position: absolute;
            top: -50%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, var(--red-accent) 0%, transparent 70%);
            opacity: 0.5;
            border-radius: 50%;
        }

        .hero-inner {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 4rem;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        @media (max-width: 968px) {
            .hero-inner { 
                grid-template-columns: 1fr; 
                gap: 3rem;
            }
        }

        .hero-left {
            z-index: 2;
        }

        .hero-eyebrow {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: var(--red-primary);
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .hero-name {
            font-family: "Playfair Display", serif;
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 1rem;
            color: var(--gray-900);
            letter-spacing: -0.03em;
        }

        .hero-name .accent {
            color: var(--red-primary);
        }

        .hero-role {
            font-size: 1.35rem;
            color: var(--gray-600);
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .hero-summary {
            font-size: 1.05rem;
            color: var(--gray-700);
            max-width: 36rem;
            margin-bottom: 2rem;
            line-height: 1.8;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
            margin-bottom: 2rem;
        }

        .btn-primary {
            padding: 1rem 2rem;
            border-radius: 10px;
            border: none;
            background: var(--red-primary);
            color: var(--white);
            font-weight: 600;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: var(--shadow-red);
            cursor: pointer;
        }

        .btn-primary:hover {
            background: var(--red-dark);
            transform: translateY(-2px);
            box-shadow: 0 15px 35px -5px rgba(220, 38, 38, 0.4);
        }

        .btn-outline {
            padding: 1rem 2rem;
            border-radius: 10px;
            border: 2px solid var(--red-primary);
            background: transparent;
            font-size: 1rem;
            color: var(--red-primary);
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-outline:hover {
            background: var(--red-primary);
            color: var(--white);
            transform: translateY(-2px);
        }

        .hero-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            font-size: 0.95rem;
            color: var(--gray-600);
        }

        .hero-meta-item {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .hero-meta-item span:first-child {
            font-size: 1.2rem;
        }

        .hero-right {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        @media (max-width: 968px) {
            .hero-right { 
                justify-content: center; 
            }
        }

        .hero-card {
            width: min(380px, 100%);
            border-radius: 24px;
            background: var(--white);
            box-shadow: var(--shadow-xl);
            padding: 2rem;
            border: 3px solid var(--red-primary);
            position: relative;
            overflow: hidden;
        }

        .hero-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--red-primary), var(--red-light));
        }

        .hero-photo-wrapper {
            position: relative;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            background: linear-gradient(135deg, var(--red-primary), var(--red-light));
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            box-shadow: var(--shadow-red);
            border: 5px solid var(--white);
        }

        .hero-photo-inner {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: var(--white);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            font-weight: 900;
            color: var(--red-primary);
        }

        .hero-photo-inner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-card-name {
            text-align: center;
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--gray-900);
            margin-bottom: 0.5rem;
        }

        .hero-card-role {
            text-align: center;
            font-size: 0.95rem;
            color: var(--gray-600);
            margin-bottom: 1.2rem;
        }

        .hero-card-divider {
            height: 2px;
            background: linear-gradient(to right, transparent, var(--red-primary), transparent);
            margin: 1rem 0;
        }

        .hero-pill {
            font-size: 0.85rem;
            padding: 0.6rem 1rem;
            border-radius: 50px;
            border: 2px solid var(--red-accent);
            background: var(--red-accent);
            color: var(--red-dark);
            text-align: center;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .hero-social {
            display: flex;
            justify-content: center;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .hero-social a {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid var(--red-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            color: var(--red-primary);
            font-weight: 600;
        }

        .hero-social a:hover {
            background: var(--red-primary);
            color: var(--white);
            transform: translateY(-3px);
        }

        /******** SECTIONS ********/
        .section-header {
            margin-bottom: 3rem;
            text-align: center;
        }

        .section-eyebrow {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: var(--red-primary);
            margin-bottom: 0.75rem;
            font-weight: 700;
        }

        .section-title {
            font-family: "Playfair Display", serif;
            font-size: clamp(2rem, 4vw, 2.75rem);
            font-weight: 900;
            color: var(--gray-900);
            margin-bottom: 1rem;
            letter-spacing: -0.02em;
        }

        .section-sub {
            font-size: 1.1rem;
            color: var(--gray-600);
            max-width: 36rem;
            margin: 0 auto;
        }

        .two-col {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 3rem;
        }

        @media (max-width: 968px) {
            .two-col { 
                grid-template-columns: 1fr; 
            }
        }

        /* ABOUT */
        .about-text {
            font-size: 1.05rem;
            color: var(--gray-700);
            line-height: 1.9;
        }

        .about-text p + p { 
            margin-top: 1.5rem; 
        }

        .stat-card {
            background: var(--white);
            border-radius: 16px;
            border: 2px solid var(--red-primary);
            padding: 1.5rem;
            box-shadow: var(--shadow-lg);
            margin-bottom: 1rem;
        }

        .stat-label { 
            font-size: 0.8rem; 
            text-transform: uppercase; 
            letter-spacing: 0.15em; 
            color: var(--red-primary); 
            margin-bottom: 0.5rem; 
            font-weight: 700;
        }

        .stat-value { 
            font-size: 1.3rem; 
            font-weight: 700; 
            color: var(--gray-900);
        }

        /* SKILLS */
        .skills-list {
            display: grid;
            gap: 1rem;
        }

        .skill-item {
            background: var(--white);
            border-radius: 12px;
            border: 2px solid var(--gray-200);
            padding: 1rem 1.2rem;
            transition: all 0.3s ease;
        }

        .skill-item:hover {
            border-color: var(--red-primary);
            box-shadow: var(--shadow-md);
        }

        .skill-top {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 0.5rem;
        }

        .skill-name { 
            font-size: 1rem; 
            font-weight: 600; 
            color: var(--gray-900);
        }

        .skill-level { 
            font-size: 0.85rem; 
            color: var(--red-primary);
            font-weight: 600;
        }

        .skill-bar {
            width: 100%;
            height: 8px;
            border-radius: 50px;
            background: var(--gray-200);
            overflow: hidden;
        }

        .skill-fill {
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(90deg, var(--red-primary), var(--red-light));
            width: 0;
            transition: width 1s ease;
        }

        .skill-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .skill-tag {
            font-size: 0.85rem;
            padding: 0.4rem 0.9rem;
            border-radius: 50px;
            border: 2px solid var(--red-primary);
            background: var(--white);
            color: var(--red-primary);
            font-weight: 500;
        }

        .skill-tag:hover {
            background: var(--red-primary);
            color: var(--white);
        }

        /* EXPERIENCE & EDUCATION */
        .timeline {
            display: grid;
            gap: 1.5rem;
        }

        .timeline-item {
            background: var(--white);
            border-radius: 16px;
            border-left: 4px solid var(--red-primary);
            padding: 1.5rem;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
        }

        .timeline-item:hover {
            box-shadow: var(--shadow-lg);
            transform: translateX(5px);
        }

        .timeline-role { 
            font-weight: 700; 
            font-size: 1.1rem; 
            color: var(--gray-900);
            margin-bottom: 0.25rem;
        }

        .timeline-place { 
            font-size: 0.95rem; 
            color: var(--red-primary);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .timeline-meta { 
            font-size: 0.85rem; 
            color: var(--gray-600); 
            margin-bottom: 0.75rem;
        }

        .timeline-desc { 
            font-size: 0.95rem; 
            color: var(--gray-700);
            line-height: 1.7;
        }

        /* PROJECTS */
        .project-grid {
            display: grid;
            gap: 2rem;
        }

        .project-card {
            display: grid;
            grid-template-columns: 1.3fr 1fr;
            gap: 0;
            background: var(--white);
            border-radius: 20px;
            border: 2px solid var(--gray-200);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .project-card:hover {
            border-color: var(--red-primary);
            box-shadow: var(--shadow-xl);
            transform: translateY(-5px);
        }

        .project-media {
            background: var(--red-accent);
            min-height: 200px;
            position: relative;
            overflow: hidden;
        }

        .project-media::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(220, 38, 38, 0.1), transparent);
        }

        .project-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .project-body {
            padding: 2rem;
            font-size: 1rem;
        }

        .project-title { 
            font-weight: 700; 
            font-size: 1.3rem;
            margin-bottom: 0.75rem;
            color: var(--gray-900);
        }

        .project-desc { 
            color: var(--gray-600); 
            margin-bottom: 1rem;
            line-height: 1.7;
        }

        .project-link { 
            font-size: 0.95rem; 
            color: var(--red-primary);
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .project-link:hover { 
            text-decoration: underline;
            gap: 0.75rem;
        }

        @media (max-width: 968px) {
            .project-card { 
                grid-template-columns: 1fr; 
            }
        }

        /* CONTACT */
        .contact-card {
            background: var(--white);
            border-radius: 24px;
            padding: 3rem;
            border: 3px solid var(--red-primary);
            box-shadow: var(--shadow-xl);
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
        }

        @media (max-width: 968px) {
            .contact-card { 
                grid-template-columns: 1fr; 
                padding: 2rem;
            }
        }

        .contact-line { 
            margin-bottom: 0.75rem; 
            color: var(--gray-700);
            font-size: 1rem;
        }

        .contact-line strong {
            color: var(--red-primary);
            font-weight: 700;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            border-radius: 10px;
            border: 2px solid var(--gray-200);
            padding: 0.85rem 1rem;
            font-size: 0.95rem;
            margin-bottom: 1rem;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        .contact-form input:focus,
        .contact-form textarea:focus {
            outline: none;
            border-color: var(--red-primary);
            box-shadow: 0 0 0 3px var(--red-accent);
        }

        .contact-form textarea { 
            resize: vertical; 
            min-height: 120px; 
        }

        .contact-form button {
            width: 100%;
        }

        /* FOOTER */
        .footer {
            padding: 3rem 2rem;
            font-size: 0.9rem;
            color: var(--gray-600);
            text-align: center;
            background: var(--gray-50);
            border-top: 2px solid var(--red-primary);
        }

        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
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
            <div>{{ $user->name }}</div>
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
                    <div class="hero-eyebrow">Welcome to My Portfolio</div>
                    <h1 class="hero-name">
                        I'm <span class="accent">{{ $user->name }}</span>
                    </h1>

                    @if($profile->tagline)
                        <p class="hero-role">{{ $profile->tagline }}</p>
                    @endif

                    @if($profile->about_short)
                        <p class="hero-summary">{{ $profile->about_short }}</p>
                    @endif

                    <div class="hero-actions">
                        @if($hasProjects)
                            <a href="#projects" class="btn-primary">
                                View My Work →
                            </a>
                        @endif

                        {{-- CV / PDF BUTTON --}}
                        <a href="{{ route('portfolio.pdf', ['id' => $user->id, 'username' => $user->username]) }}"
                           class="btn-outline" target="_blank">
                            📄 Download CV
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
                            {{ $profile->tagline ?: 'Creative Professional' }}
                        </div>

                        <div class="hero-card-divider"></div>

                        <div class="hero-pill">
                            ✨ Available for Opportunities
                        </div>

                        @if($hasSocial)
                            <div class="hero-social">
                                @if($profile->social_linkedin)
                                    <a href="{{ $profile->social_linkedin }}" target="_blank" title="LinkedIn">in</a>
                                @endif
                                @if($profile->social_github)
                                    <a href="{{ $profile->social_github }}" target="_blank" title="GitHub">GH</a>
                                @endif
                                @if($profile->social_twitter)
                                    <a href="{{ $profile->social_twitter }}" target="_blank" title="Twitter">X</a>
                                @endif
                                @if($profile->social_instagram)
                                    <a href="{{ $profile->social_instagram }}" target="_blank" title="Instagram">IG</a>
                                @endif
                                @if($profile->social_facebook)
                                    <a href="{{ $profile->social_facebook }}" target="_blank" title="Facebook">f</a>
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
                    <div class="section-eyebrow">Get to Know Me</div>
                    <h2 class="section-title">{{ $profile->about_title ?? 'About Me' }}</h2>
                    <p class="section-sub">Discover my journey, passion, and what drives me in my work.</p>
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
                            <div class="stat-label">Focus Area</div>
                            <div class="stat-value">
                                {{ $profile->tagline ?: 'Excellence in Every Project' }}
                            </div>
                        </div>
                        @if($hasSkills)
                            <div class="stat-card">
                                <div class="stat-label">Skills</div>
                                <div class="stat-value">{{ $user->skills->count() }}+ Technologies</div>
                            </div>
                        @endif
                        @if($hasProjects)
                            <div class="stat-card">
                                <div class="stat-label">Projects</div>
                                <div class="stat-value">{{ $user->projects->count() }}+ Completed</div>
                            </div>
                        @endif
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
                    <div class="section-eyebrow">My Journey</div>
                    <h2 class="section-title">Experience & Education</h2>
                    <p class="section-sub">Professional background and academic achievements.</p>
                </div>

                <div class="two-col">
                    @if($hasExp)
                        <div>
                            <h3 style="font-size:1.2rem; font-weight:700; margin-bottom:1rem; color:var(--red-primary);">💼 Experience</h3>
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
                            <h3 style="font-size:1.2rem; font-weight:700; margin-bottom:1rem; color:var(--red-primary);">🎓 Education</h3>
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
                    <div class="section-eyebrow">What I Do</div>
                    <h2 class="section-title">Skills & Expertise</h2>
                    <p class="section-sub">Technologies and tools I work with to bring ideas to life.</p>
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
                        <p class="section-sub" style="margin-bottom:1.5rem; text-align:left;">
                            A comprehensive overview of my technical stack. I'm always learning and expanding my skill set.
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
                    <div class="section-eyebrow">My Work</div>
                    <h2 class="section-title">Featured Projects</h2>
                    <p class="section-sub">A showcase of my recent work and creative solutions.</p>
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
                                        View Project →
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
                    <div class="section-eyebrow">Let's Connect</div>
                    <h2 class="section-title">Get In Touch</h2>
                    <p class="section-sub">
                        Have a project in mind? Let's discuss how we can work together.
                    </p>
                </div>

                <div class="contact-card">
                    <div>
                        @if($profile->contact_email)
                            <p class="contact-line"><strong>Email:</strong> {{ $profile->contact_email }}</p>
                        @endif
                        @if($profile->location)
                            <p class="contact-line"><strong>Location:</strong> {{ $profile->location }}</p>
                        @endif
                        <p class="contact-line" style="margin-top:1.5rem; line-height:1.8;">
                            I'm open to discussing new opportunities, collaborations, freelance projects, or full-time positions. Let's create something amazing together!
                        </p>
                    </div>

                    <form class="contact-form" onsubmit="return false;">
                        <input type="text" placeholder="Your name" required>
                        <input type="email" placeholder="Your email" required>
                        <textarea placeholder="Tell me about your project or opportunity..." required></textarea>
                        <button class="btn-primary" type="submit">Send Message</button>
                    </form>
                </div>
            </div>
        </section>
    @endif
</main>

<footer class="footer">
    <div class="container">
        © {{ date('Y') }} {{ $user->name }} — Portfolio created with Portfolio Builder
    </div>
</footer>

<script>
    // Animate skill bars on scroll
    const observerOptions = {
        threshold: 0.5,
        rootMargin: '0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const skillFill = entry.target.querySelector('.skill-fill');
                if (skillFill) {
                    const width = skillFill.style.width;
                    skillFill.style.width = '0%';
                    setTimeout(() => {
                        skillFill.style.width = width;
                    }, 100);
                }
            }
        });
    }, observerOptions);

    document.querySelectorAll('.skill-item').forEach(item => {
        observer.observe(item);
    });

    // Smooth navigation
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>

</body>
</html>

