<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="resumizo-logo-white.png" />
    <title>{{ $user->name }} - Portfolio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --accent-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --dark-gradient: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            --purple-primary: #667eea;
            --purple-dark: #5568d3;
            --purple-light: #8b9aff;
            --pink-accent: #f5576c;
            --teal-accent: #00f2fe;
            --white: #FFFFFF;
            --gray-50: #FAFAFA;
            --gray-100: #F5F5F5;
            --gray-200: #E5E5E5;
            --gray-600: #525252;
            --gray-700: #404040;
            --gray-800: #262626;
            --gray-900: #1a1a1a;
            --shadow-sm: 0 2px 4px rgba(102, 126, 234, 0.1);
            --shadow-md: 0 4px 12px rgba(102, 126, 234, 0.15);
            --shadow-lg: 0 10px 30px rgba(102, 126, 234, 0.2);
            --shadow-xl: 0 20px 50px rgba(102, 126, 234, 0.25);
            --shadow-glow: 0 0 30px rgba(102, 126, 234, 0.4);
        }

        * { 
            margin: 0; 
            padding: 0; 
            box-sizing: border-box; 
        }

        body {
            font-family: "Poppins", system-ui, -apple-system, sans-serif;
            background: var(--white);
            color: var(--gray-900);
            line-height: 1.7;
            overflow-x: hidden;
        }

        a { 
            color: inherit; 
            text-decoration: none; 
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        section { 
            padding: 6rem 0; 
        }

        /******** NAVIGATION ********/
        .nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(102, 126, 234, 0.1);
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
        }

        .nav.scrolled {
            box-shadow: var(--shadow-md);
        }

        .nav-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1.3rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            font-weight: 800;
            font-size: 1.3rem;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.02em;
        }

        .nav-logo-mark {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: var(--primary-gradient);
            color: var(--white);
            font-weight: 900;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-glow);
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }

        .nav-logo:hover .nav-logo-mark {
            transform: rotate(5deg) scale(1.05);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2.5rem;
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
            background: var(--primary-gradient);
            transition: width 0.3s ease;
            border-radius: 2px;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--purple-primary);
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        .nav-cta {
            padding: 0.75rem 1.8rem;
            border-radius: 12px;
            background: var(--primary-gradient);
            color: var(--white);
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: var(--shadow-lg);
            transition: all 0.3s ease;
        }

        .nav-cta:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-xl);
        }

        @media (max-width: 768px) {
            .nav-links { display: none; }
            .nav-inner { padding: 1rem 1.5rem; }
        }

        /******** HERO SECTION ********/
        .hero {
            padding-top: 9rem;
            padding-bottom: 7rem;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: "";
            position: absolute;
            top: -30%;
            right: -10%;
            width: 700px;
            height: 700px;
            background: radial-gradient(circle, rgba(102, 126, 234, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 20s ease-in-out infinite;
        }

        .hero::after {
            content: "";
            position: absolute;
            bottom: -20%;
            left: -5%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(245, 87, 108, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 25s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(30px, -30px) rotate(5deg); }
        }

        .hero-inner {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 5rem;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        @media (max-width: 968px) {
            .hero-inner { 
                grid-template-columns: 1fr; 
                gap: 3rem;
                text-align: center;
            }
        }

        .hero-left {
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-eyebrow {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--purple-primary);
            text-transform: uppercase;
            letter-spacing: 0.15em;
            margin-bottom: 1rem;
            display: inline-block;
            padding: 0.5rem 1rem;
            background: rgba(102, 126, 234, 0.1);
            border-radius: 50px;
        }

        .hero-name {
            font-size: 4rem;
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            color: var(--gray-900);
            font-family: "Playfair Display", serif;
        }

        .hero-name .accent {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-role {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--purple-primary);
            margin-bottom: 1rem;
        }

        .hero-summary {
            font-size: 1.1rem;
            color: var(--gray-700);
            margin-bottom: 2rem;
            line-height: 1.8;
        }

        .hero-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn-primary {
            padding: 1rem 2rem;
            border-radius: 12px;
            background: var(--primary-gradient);
            color: var(--white);
            font-weight: 600;
            font-size: 1rem;
            box-shadow: var(--shadow-lg);
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-xl);
        }

        .btn-outline {
            padding: 1rem 2rem;
            border-radius: 12px;
            border: 2px solid var(--purple-primary);
            color: var(--purple-primary);
            font-weight: 600;
            font-size: 1rem;
            background: transparent;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-outline:hover {
            background: var(--primary-gradient);
            color: var(--white);
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
        }

        .hero-meta {
            display: flex;
            gap: 2rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .hero-meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--gray-700);
            font-size: 0.95rem;
        }

        .hero-right {
            position: relative;
            animation: fadeInRight 0.8s ease-out 0.2s both;
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .hero-card {
            background: var(--white);
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow: var(--shadow-xl);
            border: 1px solid rgba(102, 126, 234, 0.1);
            position: relative;
            overflow: hidden;
        }

        .hero-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: var(--primary-gradient);
        }

        .hero-photo-wrapper {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .hero-photo-inner {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            margin: 0 auto;
            background: var(--primary-gradient);
            padding: 5px;
            box-shadow: var(--shadow-glow);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            font-weight: 900;
            color: var(--white);
            overflow: hidden;
        }

        .hero-photo-inner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .hero-card-name {
            font-size: 1.8rem;
            font-weight: 800;
            text-align: center;
            margin-bottom: 0.5rem;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-card-role {
            text-align: center;
            color: var(--gray-600);
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }

        .hero-card-divider {
            height: 2px;
            background: var(--primary-gradient);
            margin: 1.5rem 0;
            border-radius: 2px;
        }

        /******** ABOUT SECTION ********/
        .about {
            background: var(--white);
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-eyebrow {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--purple-primary);
            text-transform: uppercase;
            letter-spacing: 0.15em;
            margin-bottom: 1rem;
        }

        .section-title {
            font-size: 3rem;
            font-weight: 900;
            margin-bottom: 1rem;
            font-family: "Playfair Display", serif;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: var(--gray-600);
            max-width: 600px;
            margin: 0 auto;
        }

        .about-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        @media (max-width: 968px) {
            .about-content {
                grid-template-columns: 1fr;
            }
        }

        .about-text {
            font-size: 1.1rem;
            line-height: 1.9;
            color: var(--gray-700);
        }

        .about-text p {
            margin-bottom: 1.5rem;
        }

        .about-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
        }

        .stat-item {
            text-align: center;
            padding: 2rem;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
            border-radius: 16px;
            border: 1px solid rgba(102, 126, 234, 0.1);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 900;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 0.95rem;
            color: var(--gray-600);
            font-weight: 500;
        }

        /******** EXPERIENCE SECTION ********/
        .experience {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }

        .timeline {
            position: relative;
            padding-left: 3rem;
        }

        .timeline::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: var(--primary-gradient);
            border-radius: 2px;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 3rem;
            padding-left: 2rem;
        }

        .timeline-item::before {
            content: "";
            position: absolute;
            left: -2.5rem;
            top: 0.5rem;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: var(--primary-gradient);
            border: 3px solid var(--white);
            box-shadow: var(--shadow-md);
        }

        .timeline-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.5rem;
            flex-wrap: wrap;
        }

        .timeline-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 0.25rem;
        }

        .timeline-company {
            font-size: 1.1rem;
            color: var(--purple-primary);
            font-weight: 600;
        }

        .timeline-date {
            font-size: 0.9rem;
            color: var(--gray-600);
            padding: 0.4rem 1rem;
            background: rgba(102, 126, 234, 0.1);
            border-radius: 20px;
        }

        .timeline-description {
            font-size: 1rem;
            color: var(--gray-700);
            line-height: 1.8;
            margin-top: 0.5rem;
        }

        /******** SKILLS SECTION ********/
        .skills {
            background: var(--white);
        }

        .skills-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .skill-card {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
            padding: 2rem;
            border-radius: 16px;
            border: 1px solid rgba(102, 126, 234, 0.1);
            transition: all 0.3s ease;
        }

        .skill-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            border-color: var(--purple-primary);
        }

        .skill-name {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 0.5rem;
        }

        .skill-level {
            font-size: 0.9rem;
            color: var(--purple-primary);
            font-weight: 600;
        }

        /******** PROJECTS SECTION ********/
        .projects {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }

        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2.5rem;
        }

        @media (max-width: 768px) {
            .projects-grid {
                grid-template-columns: 1fr;
            }
        }

        .project-card {
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
            border: 1px solid rgba(102, 126, 234, 0.1);
        }

        .project-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
        }

        .project-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
            background: var(--primary-gradient);
        }

        .project-content {
            padding: 2rem;
        }

        .project-title {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            color: var(--gray-900);
        }

        .project-description {
            font-size: 1rem;
            color: var(--gray-700);
            line-height: 1.7;
            margin-bottom: 1rem;
        }

        .project-link {
            font-size: 0.95rem;
            color: var(--purple-primary);
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .project-link:hover {
            gap: 0.75rem;
        }

        /******** CONTACT SECTION ********/
        .contact {
            background: var(--white);
        }

        .contact-card {
            background: var(--white);
            border-radius: 24px;
            padding: 3.5rem;
            box-shadow: var(--shadow-xl);
            border: 2px solid rgba(102, 126, 234, 0.1);
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
        }

        @media (max-width: 968px) {
            .contact-card {
                grid-template-columns: 1fr;
                padding: 2.5rem;
            }
        }

        .contact-info h3 {
            font-size: 1.8rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .contact-line {
            margin-bottom: 1.25rem;
            color: var(--gray-700);
            font-size: 1.05rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .contact-line strong {
            color: var(--purple-primary);
            font-weight: 700;
            min-width: 100px;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            border-radius: 12px;
            border: 2px solid rgba(102, 126, 234, 0.2);
            padding: 1rem 1.25rem;
            font-size: 1rem;
            margin-bottom: 1.25rem;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        .contact-form input:focus,
        .contact-form textarea:focus {
            outline: none;
            border-color: var(--purple-primary);
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .contact-form textarea {
            resize: vertical;
            min-height: 140px;
        }

        .contact-form button {
            width: 100%;
            padding: 1rem 2rem;
            border-radius: 12px;
            background: var(--primary-gradient);
            color: var(--white);
            font-weight: 600;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            box-shadow: var(--shadow-lg);
            transition: all 0.3s ease;
        }

        .contact-form button:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-xl);
        }

        /******** FOOTER ********/
        .footer {
            padding: 3rem 2rem;
            font-size: 0.9rem;
            color: var(--gray-600);
            text-align: center;
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: var(--white);
        }

        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Scroll animations */
        @media (prefers-reduced-motion: no-preference) {
            .fade-in {
                opacity: 0;
                transform: translateY(30px);
                transition: opacity 0.6s ease, transform 0.6s ease;
            }
            .fade-in.visible {
                opacity: 1;
                transform: translateY(0);
            }
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

<header class="nav" id="navbar">
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

                        @if($hasSocial)
                            <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
                                @if($profile->social_linkedin)
                                    <a href="{{ $profile->social_linkedin }}" target="_blank" style="color: var(--purple-primary); font-size: 1.5rem;">🔗</a>
                                @endif
                                @if($profile->social_github)
                                    <a href="{{ $profile->social_github }}" target="_blank" style="color: var(--purple-primary); font-size: 1.5rem;">💻</a>
                                @endif
                                @if($profile->social_twitter)
                                    <a href="{{ $profile->social_twitter }}" target="_blank" style="color: var(--purple-primary); font-size: 1.5rem;">🐦</a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ABOUT -->
    @if($hasAbout)
        <section id="about" class="about fade-in">
            <div class="container">
                <div class="section-header">
                    <div class="section-eyebrow">Get to Know Me</div>
                    <h2 class="section-title">About Me</h2>
                    <p class="section-subtitle">Discover my journey, passion, and what drives me</p>
                </div>

                <div class="about-content">
                    <div class="about-text">
                        @if($profile->about_short)
                            <p>{{ $profile->about_short }}</p>
                        @endif
                        @if($profile->about_long)
                            <p>{{ $profile->about_long }}</p>
                        @endif
                    </div>

                    <div class="about-stats">
                        @if($hasProjects)
                            <div class="stat-item">
                                <div class="stat-number">{{ $user->projects->count() }}+</div>
                                <div class="stat-label">Projects</div>
                            </div>
                        @endif
                        @if($hasSkills)
                            <div class="stat-item">
                                <div class="stat-number">{{ $user->skills->count() }}+</div>
                                <div class="stat-label">Skills</div>
                            </div>
                        @endif
                        @if($hasExp)
                            <div class="stat-item">
                                <div class="stat-number">{{ $user->experiences->count() }}+</div>
                                <div class="stat-label">Experiences</div>
                            </div>
                        @endif
                        @if($hasEdu)
                            <div class="stat-item">
                                <div class="stat-number">{{ $user->educations->count() }}+</div>
                                <div class="stat-label">Education</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- EXPERIENCE & EDUCATION -->
    @if($hasExp || $hasEdu)
        <section id="experience" class="experience fade-in">
            <div class="container">
                <div class="section-header">
                    <div class="section-eyebrow">My Journey</div>
                    <h2 class="section-title">Experience & Education</h2>
                    <p class="section-subtitle">A timeline of my professional and academic achievements</p>
                </div>

                <div class="timeline">
                    @if($hasExp)
                        @foreach($user->experiences as $exp)
                            <div class="timeline-item">
                                <div class="timeline-header">
                                    <div>
                                        <div class="timeline-title">{{ $exp->title }}</div>
                                        <div class="timeline-company">{{ $exp->company }}</div>
                                    </div>
                                    <div class="timeline-date">
                                        {{ $exp->start_date }} – {{ $exp->end_date ?? 'Present' }}
                                    </div>
                                </div>
                                @if($exp->description)
                                    <div class="timeline-description">{{ $exp->description }}</div>
                                @endif
                            </div>
                        @endforeach
                    @endif

                    @if($hasEdu)
                        @foreach($user->educations as $edu)
                            <div class="timeline-item">
                                <div class="timeline-header">
                                    <div>
                                        <div class="timeline-title">{{ $edu->degree }}</div>
                                        <div class="timeline-company">{{ $edu->institution }}</div>
                                    </div>
                                    <div class="timeline-date">
                                        {{ $edu->start_year }} – {{ $edu->end_year ?? 'Present' }}
                                    </div>
                                </div>
                                @if($edu->description)
                                    <div class="timeline-description">{{ $edu->description }}</div>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
    @endif

    <!-- SKILLS -->
    @if($hasSkills)
        <section id="skills" class="skills fade-in">
            <div class="container">
                <div class="section-header">
                    <div class="section-eyebrow">What I Do</div>
                    <h2 class="section-title">Skills & Expertise</h2>
                    <p class="section-subtitle">Technologies and tools I work with</p>
                </div>

                <div class="skills-grid">
                    @foreach($user->skills as $skill)
                        <div class="skill-card">
                            <div class="skill-name">{{ $skill->name }}</div>
                            @if($skill->level)
                                <div class="skill-level">{{ $skill->level }}</div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- PROJECTS -->
    @if($hasProjects)
        <section id="projects" class="projects fade-in">
            <div class="container">
                <div class="section-header">
                    <div class="section-eyebrow">My Work</div>
                    <h2 class="section-title">Featured Projects</h2>
                    <p class="section-subtitle">A showcase of my best work and achievements</p>
                </div>

                <div class="projects-grid">
                    @foreach($user->projects as $project)
                        <div class="project-card">
                            @if($project->project_image)
                                <img src="{{ asset('storage/' . $project->project_image) }}" 
                                     alt="{{ $project->title }}" 
                                     class="project-image">
                            @else
                                <div class="project-image" style="display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem; font-weight: 900;">
                                    {{ strtoupper(substr($project->title, 0, 1)) }}
                                </div>
                            @endif
                            <div class="project-content">
                                <h3 class="project-title">{{ $project->title }}</h3>
                                @if($project->short_description)
                                    <p class="project-description">{{ $project->short_description }}</p>
                                @endif
                                @if($project->project_url)
                                    <a href="{{ $project->project_url }}" target="_blank" class="project-link">
                                        View Project →
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- CONTACT -->
    @if($hasContact)
        <section id="contact" class="contact fade-in">
            <div class="container">
                <div class="section-header">
                    <div class="section-eyebrow">Get In Touch</div>
                    <h2 class="section-title">Contact Me</h2>
                    <p class="section-subtitle">Let's work together on your next project</p>
                </div>

                <div class="contact-card">
                    <div class="contact-info">
                        <h3>Let's Connect</h3>
                        @if($profile->contact_email)
                            <div class="contact-line">
                                <strong>Email:</strong>
                                <span>{{ $profile->contact_email }}</span>
                            </div>
                        @endif
                        @if($profile->contact_phone)
                            <div class="contact-line">
                                <strong>Phone:</strong>
                                <span>{{ $profile->contact_phone }}</span>
                            </div>
                        @endif
                        @if($profile->location)
                            <div class="contact-line">
                                <strong>Location:</strong>
                                <span>{{ $profile->location }}</span>
                            </div>
                        @endif
                        @if($hasSocial)
                            <div style="margin-top: 2rem;">
                                @if($profile->social_linkedin)
                                    <div class="contact-line">
                                        <strong>LinkedIn:</strong>
                                        <a href="{{ $profile->social_linkedin }}" target="_blank">{{ $profile->social_linkedin }}</a>
                                    </div>
                                @endif
                                @if($profile->social_github)
                                    <div class="contact-line">
                                        <strong>GitHub:</strong>
                                        <a href="{{ $profile->social_github }}" target="_blank">{{ $profile->social_github }}</a>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="contact-form">
                        <h3 style="font-size: 1.8rem; font-weight: 800; margin-bottom: 1.5rem; background: var(--primary-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Send a Message</h3>
                        <form>
                            <input type="text" placeholder="Your Name" required>
                            <input type="email" placeholder="Your Email" required>
                            <textarea placeholder="Your Message" required></textarea>
                            <button type="submit">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @endif
</main>

<footer class="footer">
    <div class="container">
        <p>&copy; {{ date('Y') }} {{ $user->name }}. All rights reserved.</p>
    </div>
</footer>

<script>
    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Active nav link on scroll
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link');

    window.addEventListener('scroll', function() {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (pageYOffset >= sectionTop - 200) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === '#' + current) {
                link.classList.add('active');
            }
        });
    });

    // Fade in on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.fade-in').forEach(el => {
        observer.observe(el);
    });
</script>

</body>
</html>

