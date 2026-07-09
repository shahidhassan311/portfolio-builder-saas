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
                --shadow-hover: 0 32px 64px rgba(212, 184, 150, 0.08);
                --font-display: "Cormorant Garamond", Georgia, serif;
                --font-body: "Outfit", system-ui, sans-serif;
                --max: 1120px;
                --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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

            /* ─── NAV ─── */
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
                transition: var(--transition);
                position: relative;
            }

            .nav-links a::after {
                content: '';
                position: absolute;
                bottom: -4px;
                left: 0;
                width: 0;
                height: 1px;
                background: var(--gold);
                transition: var(--transition);
            }

            .nav-links a:hover {
                color: var(--gold);
            }

            .nav-links a:hover::after {
                width: 100%;
            }

            .nav-cta {
                padding: 10px 22px;
                border-radius: 999px;
                font-size: 13px;
                font-weight: 600;
                background: var(--gold);
                color: #1a1510;
                transition: var(--transition);
            }

            .nav-cta:hover {
                transform: translateY(-1px);
                box-shadow: 0 8px 24px rgba(212, 184, 150, 0.35);
            }

            @media (max-width: 720px) {
                .nav-links { display: none; }
            }

            /* ─── HERO ─── */
            .hero {
                display: grid;
                grid-template-columns: 1.2fr 0.8fr;
                gap: 40px;
                align-items: start;
                margin-bottom: 72px;
            }

            @media (max-width: 960px) {
                .hero { grid-template-columns: 1fr; }
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
                transition: var(--transition);
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
                transition: var(--transition);
            }

            .btn-ghost:hover {
                border-color: rgba(212, 184, 150, 0.4);
                background: var(--surface);
                transform: translateY(-2px);
            }

            .hero-panel {
                background: var(--surface);
                border: 1px solid var(--border);
                border-radius: var(--radius-xl);
                padding: 28px;
                box-shadow: var(--shadow);
                transition: var(--transition);
            }

            .hero-panel:hover {
                border-color: rgba(212, 184, 150, 0.2);
                box-shadow: var(--shadow-hover);
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
                transition: var(--transition);
            }

            .hero-stat:hover {
                border-color: var(--gold-soft);
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
                transition: var(--transition);
            }

            .hero-social-links a:hover {
                border-color: var(--gold);
                color: var(--gold);
                background: var(--gold-soft);
                transform: translateY(-2px);
            }

            /* ─── SECTIONS ─── */
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

            @media (max-width: 720px) {
                .section-head { flex-direction: column; align-items: flex-start; }
                .section-sub { text-align: left; }
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
                transition: var(--transition);
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

            @media (max-width: 960px) {
                .grid { grid-template-columns: repeat(2, 1fr); }
            }

            @media (max-width: 720px) {
                .grid, .grid-2 { grid-template-columns: 1fr; }
            }

            /* ─── SKILLS ─── */
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
                width: 0;
                transition: width 1.2s cubic-bezier(0.16, 1, 0.3, 1);
            }

            /* ─── PROJECTS ─── */
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
                transition: var(--transition);
            }

            .project-link:hover {
                gap: 12px;
                text-decoration: underline;
            }

            /* ─── CERTIFICATIONS ─── */
            .cert-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
                gap: 16px;
            }

            .cert-item {
                background: var(--surface);
                border: 1px solid var(--border);
                border-radius: var(--radius-lg);
                padding: 20px;
                display: flex;
                align-items: center;
                gap: 14px;
                transition: var(--transition);
            }

            .cert-item:hover {
                border-color: var(--gold-soft);
                transform: translateY(-2px);
                box-shadow: var(--shadow-hover);
            }

            .cert-icon {
                font-size: 2.2rem;
                flex-shrink: 0;
            }

            .cert-image {
                width: 50px;
                height: 50px;
                border-radius: 10px;
                object-fit: cover;
                flex-shrink: 0;
            }

            .cert-info { flex: 1; }
            .cert-title { font-weight: 600; font-size: 14px; }
            .cert-org { font-size: 12px; color: var(--text-muted); }
            .cert-date { font-size: 10px; color: var(--text-dim); text-transform: uppercase; letter-spacing: 0.08em; margin-top: 2px; }
            .cert-link { font-size: 12px; color: var(--gold); font-weight: 500; }

            /* ─── SERVICES ─── */
            .services-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 20px;
            }

            @media (max-width: 960px) {
                .services-grid { grid-template-columns: repeat(2, 1fr); }
            }

            @media (max-width: 720px) {
                .services-grid { grid-template-columns: 1fr; }
            }

            .service-card {
                background: var(--surface);
                border: 1px solid var(--border);
                border-radius: var(--radius-lg);
                padding: 24px 20px;
                text-align: center;
                transition: var(--transition);
            }

            .service-card:hover {
                border-color: var(--gold-soft);
                transform: translateY(-4px);
                box-shadow: var(--shadow-hover);
            }

            .service-icon { font-size: 2.5rem; margin-bottom: 12px; }
            .service-title { font-weight: 600; font-size: 15px; }
            .service-desc { font-size: 13px; color: var(--text-muted); margin-top: 6px; }

            /* ─── ACHIEVEMENTS ─── */
            .achievement-item {
                background: var(--surface);
                border: 1px solid var(--border);
                border-radius: var(--radius-lg);
                padding: 18px 20px;
                display: flex;
                align-items: flex-start;
                gap: 14px;
                transition: var(--transition);
            }

            .achievement-item:hover {
                border-color: var(--gold-soft);
                transform: translateX(4px);
            }

            .achievement-icon { font-size: 1.8rem; flex-shrink: 0; }
            .achievement-title { font-weight: 600; font-size: 14px; }
            .achievement-org { font-size: 12px; color: var(--text-muted); }
            .achievement-desc { font-size: 13px; color: var(--text-muted); margin-top: 4px; }
            .achievement-date { font-size: 10px; color: var(--text-dim); text-transform: uppercase; letter-spacing: 0.08em; margin-top: 4px; }

            /* ─── VOLUNTEER ─── */
            .volunteer-item {
                background: var(--surface);
                border: 1px solid var(--border);
                border-radius: var(--radius-lg);
                padding: 18px 20px;
                transition: var(--transition);
            }

            .volunteer-item:hover {
                border-color: var(--gold-soft);
                transform: translateX(4px);
            }

            .volunteer-org { font-weight: 600; font-size: 14px; }
            .volunteer-role { font-size: 13px; color: var(--text-muted); }
            .volunteer-location { font-size: 12px; color: var(--text-dim); }
            .volunteer-date { font-size: 10px; color: var(--text-dim); text-transform: uppercase; letter-spacing: 0.08em; margin-top: 4px; }

            /* ─── TESTIMONIALS ─── */
            .testimonial-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }

            @media (max-width: 720px) {
                .testimonial-grid { grid-template-columns: 1fr; }
            }

            .testimonial-card {
                background: var(--surface);
                border: 1px solid var(--border);
                border-radius: var(--radius-lg);
                padding: 22px;
                transition: var(--transition);
            }

            .testimonial-card:hover {
                border-color: var(--gold-soft);
                transform: translateY(-4px);
                box-shadow: var(--shadow-hover);
            }

            .testimonial-text {
                font-style: italic;
                font-size: 14px;
                color: var(--text-muted);
                line-height: 1.7;
                margin-bottom: 12px;
            }
            .testimonial-author { font-weight: 600; font-size: 14px; }
            .testimonial-role { font-size: 12px; color: var(--text-muted); }
            .testimonial-rating { color: #fbbf24; font-size: 14px; margin-top: 6px; }

            /* ─── GALLERY ─── */
            .gallery-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
                gap: 14px;
            }

            .gallery-item {
                border-radius: var(--radius-lg);
                overflow: hidden;
                border: 1px solid var(--border);
                aspect-ratio: 1;
                transition: var(--transition);
            }

            .gallery-item:hover {
                transform: scale(1.04);
                border-color: var(--gold-soft);
                box-shadow: var(--shadow-hover);
            }

            .gallery-item img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            /* ─── TIMELINE ─── */
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
                transition: var(--transition);
            }

            .timeline-item:hover .timeline-dot {
                background: var(--gold);
                box-shadow: 0 0 0 4px var(--gold-soft);
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

            /* ─── GOALS ─── */
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
                transition: var(--transition);
            }

            .goal-item:hover {
                border-color: var(--gold-soft);
                transform: translateX(4px);
            }

            .goal-item::before {
                content: "◆";
                color: var(--gold);
                font-size: 10px;
                margin-top: 4px;
                flex-shrink: 0;
            }

            /* ─── CONTACT ─── */
            .contact-grid {
                display: grid;
                grid-template-columns: 1.4fr 1fr;
                gap: 24px;
            }

            @media (max-width: 960px) {
                .contact-grid { grid-template-columns: 1fr; }
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
                transition: var(--transition);
            }

            .contact-email:hover {
                color: #e8d5b8;
                gap: 12px;
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

            /* ─── EMPTY STATE ─── */
            .empty-state {
                text-align: center;
                color: var(--text-dim);
                padding: 2rem;
                background: var(--bg-elevated);
                border-radius: var(--radius-lg);
                border: 1px dashed var(--border-strong);
            }
        </style>
    </head>
    <body class="{{ !empty($isPreview) ? 'has-preview' : '' }}">

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
        $hasCerts    = $certifications->count() > 0;
        $hasGallery  = $gallery->count() > 0;
        $hasServices = $services->count() > 0;
        $hasAchievements = $achievements->count() > 0;
        $hasVolunteers = $volunteers->count() > 0;
        $hasTestimonials = $testimonials->count() > 0;
        $hasExp      = $experiences->count() > 0;
        $hasEdu      = $educations->count() > 0;
        $hasContact  = $profile->contact_email || $profile->location || $profile->contact_phone;
        $hasSocial   = $profile->social_facebook || $profile->social_linkedin || $profile->social_github
                    || $profile->social_instagram || $profile->social_twitter;
    @endphp

    @if(!empty($isPreview))
        <div class="preview-ribbon">
            Theme preview — sample content
            <a href="{{ url('/') }}#themes">Choose this template</a>
        </div>
    @endif

    <div class="page">
        <!-- ─── NAV ─── -->
        <header class="nav">
            <div class="nav-brand">
                <div class="nav-avatar">
                    @if($profile && $profile->profile_image)
                        <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="{{ $user->name }}">
                    @else
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    @endif
                </div>
                <div>
                    <div class="nav-name">{{ $user->name }}</div>
                    <div class="nav-role">{{ $profile->tagline ?? 'Creative Developer' }}</div>
                </div>
            </div>

            <nav class="nav-links">
                @if($hasAbout)<a href="#about">About</a>@endif
                @if($hasSkills)<a href="#skills">Skills</a>@endif
                @if($hasCerts)<a href="#certifications">Certifications</a>@endif
                @if($hasProjects)<a href="#projects">Work</a>@endif
                @if($hasServices)<a href="#services">Services</a>@endif
                @if($hasExp)<a href="#experience">Experience</a>@endif
                @if($hasGoals)<a href="#goals">Goals</a>@endif
                @if($hasVolunteers)<a href="#goals">Volunteers</a>@endif


            </nav>

            @if($hasContact)
                <a href="#contact" class="nav-cta">Contact</a>
            @endif
        </header>

        <!-- ─── HERO ─── -->
        <section class="hero" id="top">
            <div>
                <div class="hero-eyebrow">Available for work</div>
                <h1 class="hero-heading">
                    Crafting <em>refined</em> digital experiences with purpose.
                </h1>
                <p class="hero-lead">
                    {{ $profile->about_short ?? 'I design and build premium web products — focused on clarity, performance, and detail that earns trust.' }}
                </p>
                <div class="hero-actions">
                    @if($hasContact)
                        <a href="#contact" class="btn-primary">Start a conversation</a>
                    @endif
                    @if($hasProjects)
                        <a href="#projects" class="btn-ghost">View work</a>
                    @endif
                    @if(empty($isPreview) && $user->id)
                        <a href="{{ route('portfolio.pdf', ['id' => $user->id, 'username' => $user->username]) }}" class="btn-ghost" target="_blank">Download CV</a>
                    @else
                        <span class="btn-ghost" style="opacity:0.5;cursor:default;">Download CV</span>
                    @endif
                    @if($profile && $profile->live_link)
                        <a href="{{ $profile->live_link }}" target="_blank" class="btn-ghost">Live Demo</a>
                    @endif
                </div>
            </div>

            <aside class="hero-panel">
                <div class="hero-profile">
                    <div class="hero-avatar-lg">
                        @if($profile && $profile->profile_image)
                            <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="{{ $user->name }}">
                        @else
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        @endif
                    </div>
                    <div>
                        <div class="hero-profile-name">{{ $user->name }}</div>
                        <div class="hero-profile-role">{{ $profile->tagline ?? 'Full-Stack Developer' }}</div>
                        @if($profile && $profile->location)
                            <div class="hero-profile-role" style="margin-top:6px;">{{ $profile->location }}</div>
                        @endif
                    </div>
                </div>

                <div class="hero-stats">
                    <div class="hero-stat">
                        <div class="hero-stat-num">{{ $projects->count() }}</div>
                        <div class="hero-stat-label">Projects</div>
                    </div>
                    <div class="hero-stat">
                        <div class="hero-stat-num">{{ $skills->count() }}</div>
                        <div class="hero-stat-label">Core skills</div>
                    </div>
                </div>

                @if($hasSocial)
                    <div>
                        <div class="hero-social-title">Connect</div>
                        <div class="hero-social-links">
                            @if($profile->social_github)
                                <a href="{{ $profile->social_github }}" target="_blank" rel="noopener">GitHub</a>
                            @endif
                            @if($profile->social_linkedin)
                                <a href="{{ $profile->social_linkedin }}" target="_blank" rel="noopener">LinkedIn</a>
                            @endif
                            @if($profile->social_twitter)
                                <a href="{{ $profile->social_twitter }}" target="_blank" rel="noopener">Twitter</a>
                            @endif
                            @if($profile->social_instagram)
                                <a href="{{ $profile->social_instagram }}" target="_blank" rel="noopener">Instagram</a>
                            @endif
                            @if($profile->social_facebook)
                                <a href="{{ $profile->social_facebook }}" target="_blank" rel="noopener">Facebook</a>
                            @endif
                        </div>
                    </div>
                @endif
            </aside>
        </section>

        <!-- ─── ABOUT ─── -->
        @if($hasAbout)
            <section class="section" id="about">
                <div class="section-head">
                    <div>
                        <div class="section-kicker">About</div>
                        <h2 class="section-title">{{ $profile->about_title ?? 'Philosophy' }}</h2>
                    </div>
                    <p class="section-sub">How I approach design, code, and collaboration.</p>
                </div>
                <div class="card">
                    <p style="font-size:15px;color:var(--text-muted);line-height:1.8;">
                        {{ $profile->about_long ?? $profile->about_short }}
                    </p>
                </div>
            </section>
        @endif

        <!-- ─── SKILLS ─── -->
        @if($hasSkills)
            <section class="section" id="skills">
                <div class="section-head">
                    <div>
                        <div class="section-kicker">Expertise</div>
                        <h2 class="section-title">Skills & tools</h2>
                    </div>
                    <p class="section-sub">Technologies I use to ship polished products.</p>
                </div>
                <div class="grid">
                    @foreach($skills as $skill)
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
                                <div class="skill-bar-fill" data-width="{{ $percentage }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- ─── CERTIFICATIONS ─── -->
        @if($hasCerts)
            <section class="section" id="certifications">
                <div class="section-head">
                    <div>
                        <div class="section-kicker">Credentials</div>
                        <h2 class="section-title">📜 Certifications</h2>
                    </div>
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
            </section>
        @endif

        <!-- ─── SERVICES ─── -->
        @if($hasServices)
            <section class="section" id="services">
                <div class="section-head">
                    <div>
                        <div class="section-kicker">Offerings</div>
                        <h2 class="section-title">💎 Services</h2>
                    </div>
                    <p class="section-sub">How I can help bring your ideas to life.</p>
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
            </section>
        @endif

        <!-- ─── PROJECTS ─── -->
        @if($hasProjects)
            <section class="section" id="projects">
                <div class="section-head">
                    <div>
                        <div class="section-kicker">Portfolio</div>
                        <h2 class="section-title">Selected work</h2>
                    </div>
                    <p class="section-sub">Projects that reflect my standards for craft.</p>
                </div>
                <div class="grid">
                    @foreach($projects as $project)
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

        <!-- ─── ACHIEVEMENTS ─── -->
        @if($hasAchievements)
            <section class="section" id="achievements">
                <div class="section-head">
                    <div>
                        <div class="section-kicker">Recognition</div>
                        <h2 class="section-title">🏆 Achievements</h2>
                    </div>
                    <p class="section-sub">Milestones I'm proud of.</p>
                </div>
                <div style="display:grid; gap:12px;">
                    @foreach($achievements as $achievement)
                        <div class="achievement-item">
                            <div class="achievement-icon">🏆</div>
                            <div>
                                <div class="achievement-title">{{ $achievement->title }}</div>
                                @if($achievement->organization)
                                    <div class="achievement-org">{{ $achievement->organization }}</div>
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
            </section>
        @endif

        <!-- ─── VOLUNTEER ─── -->
        @if($hasVolunteers)
            <section class="section" id="volunteer">
                <div class="section-head">
                    <div>
                        <div class="section-kicker">Community</div>
                        <h2 class="section-title">❤️ Volunteer Work</h2>
                    </div>
                    <p class="section-sub">Giving back to the community.</p>
                </div>
                <div style="display:grid; gap:12px;">
                    @foreach($volunteers as $item)
                        <div class="volunteer-item">
                            <div class="volunteer-org">{{ $item->organization_name }}</div>
                            <div class="volunteer-role">{{ $item->role }}</div>
                            @if($item->location)
                                <div class="volunteer-location">📍 {{ $item->location }}</div>
                            @endif
                            @if($item->description)
                                <div style="font-size:13px; color:var(--text-muted); margin-top:4px;">{{ $item->description }}</div>
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
            </section>
        @endif

        <!-- ─── TESTIMONIALS ─── -->
        @if($hasTestimonials)
            <section class="section" id="testimonials">
                <div class="section-head">
                    <div>
                        <div class="section-kicker">Feedback</div>
                        <h2 class="section-title">💬 Testimonials</h2>
                    </div>
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
            </section>
        @endif

        <!-- ─── GALLERY ─── -->
        @if($hasGallery)
            <section class="section" id="gallery">
                <div class="section-head">
                    <div>
                        <div class="section-kicker">Visuals</div>
                        <h2 class="section-title">📸 Gallery</h2>
                    </div>
                    <p class="section-sub">A glimpse into my creative world.</p>
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
            </section>
        @endif

        <!-- ─── EXPERIENCE ─── -->
        @if($hasExp)
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
                        @foreach($experiences->sortByDesc('start_date') as $exp)
                            <div class="timeline-item">
                                <div class="timeline-dot"></div>
                                <div class="timeline-role">{{ $exp->role_title ?? $exp->title }}</div>
                                <div class="timeline-org">
                                    {{ $exp->company }}
                                    @if($exp->location) · {{ $exp->location }} @endif
                                    @if($exp->employment_type) · {{ $exp->employment_type }} @endif
                                </div>
                                <div class="timeline-date">
                                    @if($exp->start_date)
                                        {{ \Carbon\Carbon::parse($exp->start_date)->format('M Y') }} –
                                        {{ $exp->is_current ? 'Present' : ($exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->format('M Y') : '…') }}
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

        <!-- ─── EDUCATION ─── -->
        @if($hasEdu)
            <section class="section" id="education">
                <div class="section-head">
                    <div>
                        <div class="section-kicker">Education</div>
                        <h2 class="section-title">Academic path</h2>
                    </div>
                    <p class="section-sub">Learning journey that supports my work.</p>
                </div>
                <div class="card">
                    <div class="timeline">
                        @foreach($educations->sortByDesc('start_date') as $edu)
                            <div class="timeline-item">
                                <div class="timeline-dot"></div>
                                <div class="timeline-role">
                                    {{ $edu->degree ?? 'Degree' }}
                                    @if($edu->field_of_study) — {{ $edu->field_of_study }} @endif
                                </div>
                                <div class="timeline-org">
                                    {{ $edu->institution }}
                                    @if($edu->location) · {{ $edu->location }} @endif
                                </div>
                                <div class="timeline-date">
                                    @if($edu->start_date)
                                        {{ \Carbon\Carbon::parse($edu->start_date)->format('Y') }} –
                                        {{ $edu->is_current ? 'Present' : ($edu->end_date ? \Carbon\Carbon::parse($edu->end_date)->format('Y') : '…') }}
                                    @endif
                                </div>
                                @if($edu->description)
                                    <p class="timeline-desc">{{ $edu->description }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- ─── GOALS ─── -->
        @if($hasGoals)
            <section class="section" id="goals">
                <div class="section-head">
                    <div>
                        <div class="section-kicker">Forward</div>
                        <h2 class="section-title">Goals</h2>
                    </div>
                    <p class="section-sub">What I'm working toward next.</p>
                </div>
                <div class="card">
                    <ul class="goals-list">
                        @foreach($goals as $goal)
                            <li class="goal-item">{{ $goal->goal_text }}</li>
                        @endforeach
                    </ul>
                </div>
            </section>
        @endif

        <!-- ─── CONTACT ─── -->
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
                    @if($profile && $profile->about_short)
                        <p>{{ $profile->about_short }}</p>
                    @else
                        <p>I'd love to hear about what you're building. Share a brief overview and I'll respond within 48 hours.</p>
                    @endif
                    @if($profile && $profile->contact_email)
                        <a href="mailto:{{ $profile->contact_email }}" class="contact-email">{{ $profile->contact_email }}</a>
                    @endif
                    @if($profile && $profile->contact_phone)
                        <div style="margin-top:8px; font-size:14px; color:var(--text-dim);">
                            📱 {{ $profile->contact_phone }}
                        </div>
                    @endif
                </div>
                <div class="contact-aside">
                    @if($profile && $profile->location)
                        📍 Based in {{ $profile->location }}<br>
                    @endif
                    Prefer email for first contact — calendar links and forms can be added in your dashboard.
                    @if($profile && $profile->live_link)
                        <br><br>
                        🌐 <a href="{{ $profile->live_link }}" target="_blank" style="color:var(--gold);">{{ $profile->live_link }}</a>
                    @endif
                </div>
            </div>
            <p class="footer-note">© {{ now()->year }} {{ $user->name }}</p>
        </section>
    </div>

    <script>
        // ─── ANIMATE SKILL BARS ───
        const skillSection = document.querySelector('#skills');
        if (skillSection) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.querySelectorAll('.skill-bar-fill').forEach(bar => {
                            const width = bar.getAttribute('data-width');
                            setTimeout(() => {
                                bar.style.width = width;
                            }, 200);
                        });
                    }
                });
            }, { threshold: 0.3 });

            observer.observe(skillSection);
        }

        // ─── SMOOTH SCROLL ───
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    </script>

    </body>
    </html>

