<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="{{ asset(config('branding.logo')) }}" />
    @include('themes.partials.seo-meta')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-main: #f5f5f7;
            --bg-card: #ffffff;
            --accent: #f24e1e;
            --accent-dark: #c22f10;
            --text-main: #111827;
            --text-muted: #6b7280;
            --border-soft: #e5e7eb;
            --shadow-soft: 0 18px 40px rgba(15,23,42,0.12);
            --radius-lg: 18px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
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

        /* ─── NAV ─── */
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
            flex-wrap: wrap;
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

        /* ─── HERO ─── */
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
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: var(--accent-dark);
            transform: translateY(-2px);
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
            transition: all 0.3s ease;
        }

        .btn-outline:hover {
            border-color: var(--accent);
            color: var(--accent-dark);
            transform: translateY(-2px);
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
            transition: all 0.3s ease;
        }

        .hero-social a:hover {
            border-color: var(--accent);
            color: var(--accent);
            transform: translateY(-2px);
        }

        /* ─── SECTIONS ─── */
        .section-header {
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            gap: 1rem;
            flex-wrap: wrap;
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

        /* ─── ABOUT ─── */
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

        /* ─── SKILLS ─── */
        .skills-list {
            display: grid;
            gap: .75rem;
        }

        .skill-item {
            background: #f9fafb;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            padding: .75rem .9rem;
            transition: all 0.3s ease;
        }

        .skill-item:hover {
            transform: translateX(4px);
            border-color: var(--accent);
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
            transition: width 0.9s ease-out;
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
            transition: all 0.3s ease;
        }

        .skill-tag:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        /* ─── TIMELINE ─── */
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
            transition: all 0.3s ease;
        }

        .timeline-item:hover {
            transform: translateX(4px);
            border-color: var(--accent);
        }

        .timeline-role { font-weight: 600; font-size: .95rem; }
        .timeline-place { font-size: .83rem; color: var(--text-muted); margin-bottom: .15rem; }
        .timeline-meta { font-size: .78rem; color: var(--text-muted); margin-bottom: .45rem; }
        .timeline-desc { font-size: .85rem; color: var(--text-muted); }

        /* ─── PROJECTS ─── */
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
            transition: all 0.3s ease;
        }

        .project-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 24px 48px rgba(15,23,42,0.15);
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
        .project-link { font-size: .82rem; color: var(--accent-dark); font-weight: 500; }
        .project-link:hover { text-decoration: underline; }

        @media (max-width: 900px) {
            .project-card { grid-template-columns: minmax(0,1fr); }
        }

        /* ─── CERTIFICATIONS ─── */
        .cert-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1rem;
        }

        .cert-item {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-soft);
            padding: 1.1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.3s ease;
        }

        .cert-item:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-soft);
            border-color: var(--accent);
        }

        .cert-icon {
            font-size: 2.2rem;
            flex-shrink: 0;
        }

        .cert-image {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .cert-info { flex: 1; }
        .cert-title { font-weight: 600; font-size: .95rem; }
        .cert-org { font-size: .8rem; color: var(--text-muted); }
        .cert-date { font-size: .7rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: .1em; }
        .cert-link { font-size: .75rem; color: var(--accent-dark); }

        /* ─── SERVICES ─── */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1.2rem;
        }

        @media (max-width: 1024px) {
            .services-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }

        @media (max-width: 768px) {
            .services-grid { grid-template-columns: minmax(0, 1fr); }
        }

        .service-card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-soft);
            padding: 1.5rem 1.2rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-soft);
            border-color: var(--accent);
        }

        .service-icon { font-size: 2.5rem; margin-bottom: .6rem; }
        .service-title { font-weight: 600; font-size: 1rem; margin-bottom: .4rem; }
        .service-desc { font-size: .85rem; color: var(--text-muted); }

        /* ─── ACHIEVEMENTS ─── */
        .achievement-item {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-soft);
            padding: 1rem 1.1rem;
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            transition: all 0.3s ease;
        }

        .achievement-item:hover {
            transform: translateX(4px);
            border-color: var(--accent);
        }

        .achievement-icon { font-size: 1.8rem; flex-shrink: 0; }
        .achievement-title { font-weight: 600; font-size: .95rem; }
        .achievement-desc { font-size: .85rem; color: var(--text-muted); }
        .achievement-date { font-size: .7rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: .1em; margin-top: .2rem; }

        /* ─── VOLUNTEER ─── */
        .volunteer-item {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-soft);
            padding: 1rem 1.1rem;
            transition: all 0.3s ease;
        }

        .volunteer-item:hover {
            transform: translateX(4px);
            border-color: var(--accent);
        }

        .volunteer-org { font-weight: 600; font-size: .95rem; }
        .volunteer-role { font-size: .85rem; color: var(--text-muted); }
        .volunteer-date { font-size: .7rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: .1em; margin-top: .2rem; }

        /* ─── TESTIMONIALS ─── */
        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1.2rem;
        }

        @media (max-width: 768px) {
            .testimonial-grid { grid-template-columns: minmax(0, 1fr); }
        }

        .testimonial-card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-soft);
            padding: 1.2rem;
            transition: all 0.3s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-soft);
        }

        .testimonial-text { font-style: italic; font-size: .9rem; color: var(--text-muted); margin-bottom: .8rem; }
        .testimonial-author { font-weight: 600; font-size: .9rem; }
        .testimonial-role { font-size: .8rem; color: var(--text-muted); }
        .testimonial-rating { color: #fbbf24; font-size: 1rem; margin-top: .4rem; }

        /* ─── GALLERY ─── */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 1rem;
        }

        .gallery-item {
            border-radius: var(--radius-lg);
            overflow: hidden;
            border: 1px solid var(--border-soft);
            aspect-ratio: 1;
            transition: all 0.3s ease;
        }

        .gallery-item:hover {
            transform: scale(1.03);
            box-shadow: var(--shadow-soft);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* ─── CONTACT ─── */
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
        .contact-line strong { color: var(--text-main); }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            padding: .6rem .75rem;
            font-size: .85rem;
            margin-bottom: .6rem;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        .contact-form input:focus,
        .contact-form textarea:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(242,78,30,0.1);
        }

        .contact-form textarea { resize: vertical; min-height: 90px; }

        .contact-form button {
            width: 100%;
        }

        /* ─── FOOTER ─── */
        .footer {
            padding: 1.4rem 1.5rem 2rem;
            font-size: .78rem;
            color: var(--text-muted);
            text-align: center;
            border-top: 1px solid var(--border-soft);
            margin-top: 2rem;
        }

        .empty-state {
            text-align: center;
            color: var(--text-muted);
            padding: 1.5rem;
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            border: 1px dashed var(--border-soft);
        }
    </style>
</head>
<body>

@php
    // ─── VARIABLES ───
    $profile        = optional($user->profile);
    $experiences    = $user->experiences ?? collect();
    $educations     = $user->educations ?? collect();
    $projects       = $user->projects ?? collect();
    $skills         = $user->skills ?? collect();
    $goals          = $user->goals ?? collect();
    $certifications = $user->certifications ?? collect();
    $gallery        = $user->gallery ?? collect();
    $volunteers     = $user->volunteer ?? collect();
    $achievements   = $user->achievements ?? collect();
    $services       = $user->services ?? collect();
    $testimonials   = $user->testimonials ?? collect();

    // ─── FLAGS ───
    $hasAbout    = $profile->about_short || $profile->about_long || $profile->about_title;
    $hasSkills   = $skills->count() > 0;
    $hasProjects = $projects->count() > 0;
    $hasGoals    = $goals->count() > 0;
    $hasExp      = $experiences->count() > 0;
    $hasEdu      = $educations->count() > 0;
    $hasCerts    = $certifications->count() > 0;
    $hasGallery  = $gallery->count() > 0;
    $hasServices = $services->count() > 0;
    $hasAchievements = $achievements->count() > 0;
    $hasVolunteers = $volunteers->count() > 0;
    $hasTestimonials = $testimonials->count() > 0;
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
            @if($hasCerts)<a href="#certifications" class="nav-link">Certifications</a>@endif
            @if($hasVolunteers)<a href="#certifications" class="nav-link">Volunteers</a>@endif
            @if($hasServices)<a href="#services" class="nav-link">Services</a>@endif
            @if($hasContact)
                <a href="#contact" class="nav-cta">Contact</a>
            @endif

        </nav>
    </div>
</header>

<main>
    <!-- ─── HERO ─── -->
    <section id="hero" class="hero">
        <div class="container">
            <div class="hero-inner">
                <div class="hero-left">
                    <div class="hero-eyebrow">✨ Software Professional</div>
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

                        <a href="{{ route('portfolio.pdf', ['id' => $user->id, 'username' => $user->username]) }}"
                           class="btn-outline" target="_blank">
                            📄 Download CV
                        </a>

                        @if($profile->live_link)
                            <a href="{{ $profile->live_link }}" target="_blank" class="btn-outline">
                                🌐 Live Demo
                            </a>
                        @endif
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
                        @if($profile->contact_phone)
                            <div class="hero-meta-item">
                                <span>📱</span><span>{{ $profile->contact_phone }}</span>
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
                            🚀 Open to freelance & remote roles
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

    <!-- ─── ABOUT ─── -->
    @if($hasAbout)
    <section id="about">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">About Me</h2>
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

                <div>
                    <div class="stat-card">
                        <div class="stat-label">Focus</div>
                        <div class="stat-value">
                            {{ $profile->tagline ?: 'Building clean and reliable digital products' }}
                        </div>
                    </div>
                    @if($goals->count())
                        <div class="stat-card" style="margin-top: 1rem;">
                            <div class="stat-label">Goals</div>
                            <div class="stat-value" style="font-size:.9rem; font-weight:400;">
                                @foreach($goals as $goal)
                                    • {{ $goal->goal_text }}<br>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- ─── EXPERIENCE & EDUCATION ─── -->
    @if($hasExp || $hasEdu)
    <section id="experience" style="background: #fafafa;">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Experience & Education</h2>
                <p class="section-sub">Professional background and academic journey.</p>
            </div>

            <div class="two-col">
                @if($hasExp)
                    <div>
                        <h3 style="font-size:.95rem; font-weight:600; margin-bottom:.5rem;">💼 Experience</h3>
                        <div class="timeline">
                            @foreach($experiences as $exp)
                                <div class="timeline-item">
                                    <div class="timeline-role">{{ $exp->role_title ?? $exp->title }}</div>
                                    <div class="timeline-place">{{ $exp->company }}</div>
                                    <div class="timeline-meta">
                                        {{ optional($exp->start_date)->format('M Y') }} –
                                        {{ $exp->is_current ? 'Present' : optional($exp->end_date)->format('M Y') }}
                                        @if($exp->location) • {{ $exp->location }} @endif
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
                        <h3 style="font-size:.95rem; font-weight:600; margin-bottom:.5rem;">🎓 Education</h3>
                        <div class="timeline">
                            @foreach($educations as $edu)
                                <div class="timeline-item">
                                    <div class="timeline-role">{{ $edu->degree }}</div>
                                    <div class="timeline-place">{{ $edu->institution }}</div>
                                    <div class="timeline-meta">
                                        {{ optional($edu->start_date)->format('Y') }} –
                                        {{ $edu->is_current ? 'Present' : optional($edu->end_date)->format('Y') }}
                                        @if($edu->field_of_study) • {{ $edu->field_of_study }} @endif
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

    <!-- ─── SKILLS ─── -->
    @if($hasSkills)
    <section id="skills">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">⚡ Skills</h2>
                <p class="section-sub">The tools and technologies I work with day-to-day.</p>
            </div>

            <div class="two-col">
                <div class="skills-list">
                    @foreach($skills as $skill)
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
                                <div class="skill-fill" data-width="{{ $percent }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div>
                    <p class="section-sub" style="margin-bottom:.8rem;">
                        A quick overview of my stack. Let's choose the right tools for your project together.
                    </p>
                    <div class="skill-tags">
                        @foreach($skills as $skill)
                            <span class="skill-tag">{{ $skill->name }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- ─── CERTIFICATIONS ─── -->
    @if($hasCerts)
    <section id="certifications" style="background: #fafafa;">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">📜 Certifications</h2>
                <p class="section-sub">Professional certifications that validate my expertise.</p>
            </div>

            <div class="cert-grid">
                @foreach($certifications as $cert)
                    <div class="cert-item">
                        @if($cert->image)
                            <img src="{{ asset('storage/' . $cert->image) }}" alt="{{ $cert->title }}" class="cert-image">
                        @else
                            <div class="cert-icon">🎓</div>
                        @endif
                        <div class="cert-info">
                            <div class="cert-title">{{ $cert->title }}</div>
                            <div class="cert-org">{{ $cert->organization }}</div>
                            @if($cert->issue_date)
                                <div class="cert-date">{{ \Carbon\Carbon::parse($cert->issue_date)->format('M Y') }}</div>
                            @endif
                            @if($cert->credential_url)
                                <a href="{{ $cert->credential_url }}" target="_blank" class="cert-link">Verify →</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- ─── PROJECTS ─── -->
    @if($hasProjects)
    <section id="projects">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">🚀 Selected Projects</h2>
                <p class="section-sub">Recent work that shows how I approach design and engineering.</p>
            </div>

            <div class="project-grid">
                @foreach($projects as $project)
                    <article class="project-card">
                        <div class="project-media">
                            @if($project->project_image)
                                <img src="{{ asset('storage/' . $project->project_image) }}" alt="{{ $project->title }}">
                            @else
                                <div style="display:flex; align-items:center; justify-content:center; height:100%; color:var(--accent); font-size:3rem;">
                                    {{ strtoupper(substr($project->title, 0, 1)) }}
                                </div>
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

    <!-- ─── SERVICES ─── -->
    @if($hasServices)
    <section id="services" style="background: #fafafa;">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">💎 Services</h2>
                <p class="section-sub">What I can help you with.</p>
            </div>

            <div class="services-grid">
                @foreach($services as $service)
                    <div class="service-card">
                        @if($service->icon)
                            <div class="service-icon">{{ $service->icon }}</div>
                        @endif
                        <div class="service-title">{{ $service->title }}</div>
                        @if($service->description)
                            <div class="service-desc">{{ $service->description }}</div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- ─── ACHIEVEMENTS ─── -->
    @if($hasAchievements)
    <section id="achievements">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">🏆 Achievements</h2>
                <p class="section-sub">Milestones and recognition I've earned.</p>
            </div>

            <div style="display:grid; gap:1rem;">
                @foreach($achievements as $achievement)
                    <div class="achievement-item">
                        <div class="achievement-icon">🏆</div>
                        <div>
                            <div class="achievement-title">{{ $achievement->title }}</div>
                            @if($achievement->organization)
                                <div style="font-size:.85rem; color:var(--text-muted);">{{ $achievement->organization }}</div>
                            @endif
                            @if($achievement->description)
                                <div class="achievement-desc">{{ $achievement->description }}</div>
                            @endif
                            @if($achievement->achievement_date)
                                <div class="achievement-date">{{ \Carbon\Carbon::parse($achievement->achievement_date)->format('M Y') }}</div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- ─── VOLUNTEER ─── -->
    @if($hasVolunteers)
    <section id="volunteer" style="background: #fafafa;">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">❤️ Volunteer Work</h2>
                <p class="section-sub">Giving back to the community.</p>
            </div>

            <div style="display:grid; gap:1rem;">
                @foreach($volunteers as $item)
                    <div class="volunteer-item">
                        <div class="volunteer-org">{{ $item->organization_name }}</div>
                        <div class="volunteer-role">{{ $item->role }}</div>
                        @if($item->location)
                            <div style="font-size:.8rem; color:var(--text-muted);">📍 {{ $item->location }}</div>
                        @endif
                        @if($item->description)
                            <div style="font-size:.85rem; color:var(--text-muted); margin-top:.3rem;">{{ $item->description }}</div>
                        @endif
                        <div class="volunteer-date">
                            {{ optional($item->start_date)->format('M Y') }}
                            @if($item->end_date)
                                – {{ \Carbon\Carbon::parse($item->end_date)->format('M Y') }}
                            @elseif($item->currently_volunteering)
                                – Present
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- ─── TESTIMONIALS ─── -->
    @if($hasTestimonials)
    <section id="testimonials">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">💬 Testimonials</h2>
                <p class="section-sub">What people say about working with me.</p>
            </div>

            <div class="testimonial-grid">
                @foreach($testimonials as $testimonial)
                    <div class="testimonial-card">
                        @if($testimonial->message)
                            <div class="testimonial-text">"{{ $testimonial->message }}"</div>
                        @endif
                        <div>
                            <div class="testimonial-author">{{ $testimonial->name }}</div>
                            @if($testimonial->role || $testimonial->company)
                                <div class="testimonial-role">
                                    {{ $testimonial->role }}
                                    @if($testimonial->company) • {{ $testimonial->company }} @endif
                                </div>
                            @endif
                            @if($testimonial->rating)
                                <div class="testimonial-rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        {!! $i <= $testimonial->rating ? '★' : '☆' !!}
                                    @endfor
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- ─── GALLERY ─── -->
    @if($hasGallery)
    <section id="gallery" style="background: #fafafa;">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">📸 Gallery</h2>
                <p class="section-sub">A visual glimpse into my world.</p>
            </div>

            <div class="gallery-grid">
                @foreach($gallery as $item)
                    <div class="gallery-item">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title ?? 'Gallery' }}" loading="lazy">
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- ─── CONTACT ─── -->
    @if($hasContact)
    <section id="contact">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">🤝 Let's work together</h2>
                <p class="section-sub">
                    Share a few details about your idea, and I'll follow up with next steps.
                </p>
            </div>

            <div class="contact-card">
                <div>
                    @if($profile->contact_email)
                        <p class="contact-line"><strong>📧 Email:</strong> {{ $profile->contact_email }}</p>
                    @endif
                    @if($profile->contact_phone)
                        <p class="contact-line"><strong>📱 Phone:</strong> {{ $profile->contact_phone }}</p>
                    @endif
                    @if($profile->location)
                        <p class="contact-line"><strong>📍 Location:</strong> {{ $profile->location }}</p>
                    @endif
                    @if($profile->live_link)
                        <p class="contact-line"><strong>🌐 Website:</strong> <a href="{{ $profile->live_link }}" target="_blank" style="color:var(--accent);">{{ $profile->live_link }}</a></p>
                    @endif
                    <p class="contact-line" style="margin-top:.6rem;">
                        I'm happy to discuss freelance work, collaborations, or full-time roles.
                    </p>
                </div>

                <form class="contact-form" onsubmit="return false;">
                    <input type="text" placeholder="Your name">
                    <input type="email" placeholder="Your email">
                    <textarea placeholder="Project details, timeline, or questions"></textarea>
                    <button class="btn-primary" type="submit">Send message →</button>
                </form>
            </div>
        </div>
    </section>
    @endif
</main>

<footer class="footer">
    © {{ date('Y') }} {{ $user->name }} — Built with Portfolio Builder.
</footer>

<script>
    // Animate skill bars on scroll
    const skillsSection = document.querySelector('#skills');
    if (skillsSection) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.querySelectorAll('.skill-fill').forEach(bar => {
                        const width = bar.getAttribute('data-width');
                        setTimeout(() => {
                            bar.style.width = width;
                        }, 200);
                    });
                }
            });
        }, { threshold: 0.3 });

        observer.observe(skillsSection);
    }

    // Smooth scroll for nav links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // Nav link active state
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function() {
            document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>

</body>
</html>
