<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @include('themes.partials.seo-meta')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/png" href="{{ asset(config('branding.logo')) }}" />
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-main: #0b0b10;
            --bg-card: #111827;
            --bg-soft: #1a1a2e;
            --accent: #ef4444;
            --accent-soft: rgba(239, 68, 68, 0.18);
            --accent-2: #fb923c;
            --accent-3: #f59e0b;
            --text-main: #f9fafb;
            --text-muted: #9ca3af;
            --radius-xl: 1.5rem;
            --shadow-soft: 0 28px 60px rgba(15, 23, 42, 0.85);
            --shadow-hover: 0 32px 70px rgba(239, 68, 68, 0.25);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Poppins", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: radial-gradient(circle at top, #111827 0, #020617 45%, #000 100%);
            color: var(--text-main);
            line-height: 1.6;
            scroll-behavior: smooth;
            min-height: 100vh;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        /* LAYOUT UTILITIES */
        .container {
            width: 100%;
            max-width: 1120px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        section {
            padding: 5rem 0;
        }

        /* ─── NAV ─── */
        .nav {
            position: fixed;
            inset-inline: 0;
            top: 0;
            z-index: 40;
            backdrop-filter: blur(18px);
            background: linear-gradient(to bottom, rgba(15,23,42,0.97), rgba(15,23,42,0.78));
            border-bottom: 1px solid rgba(148,163,184,0.28);
        }

        .nav-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.85rem 1.5rem;
            max-width: 1120px;
            margin: 0 auto;
        }

        .nav-brand {
            font-weight: 700;
            letter-spacing: 0.04em;
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 1.1rem;
            background: linear-gradient(120deg, #fecaca, var(--accent), #fb923c);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .nav-brand span {
            padding: 0.1rem 0.55rem;
            border-radius: 999px;
            background: rgba(15,23,42,0.7);
            border: 1px solid rgba(148,163,184,0.5);
            font-size: 0.7rem;
            text-transform: uppercase;
            color: var(--text-muted);
            font-weight: 400;
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
            align-items: center;
            font-size: 0.85rem;
            flex-wrap: wrap;
        }

        .nav-link {
            color: var(--text-muted);
            position: relative;
            padding-bottom: 0.15rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .nav-link::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -0.15rem;
            height: 2px;
            width: 0;
            border-radius: 999px;
            background: linear-gradient(90deg, #fecaca, var(--accent), #fb923c);
            transition: width .22s ease;
        }

        .nav-link:hover {
            color: var(--text-main);
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        .nav-contact-btn {
            border-radius: 999px;
            border: 1px solid rgba(148,163,184,0.6);
            padding: 0.4rem 0.9rem;
            font-size: 0.8rem;
            background: linear-gradient(to right, rgba(15,23,42,0.7), rgba(15,23,42,0.3));
            color: var(--text-main);
            transition: var(--transition);
        }

        .nav-contact-btn:hover {
            border-color: var(--accent);
            background: var(--accent-soft);
        }

        @media (max-width: 768px) {
            .nav-links { gap: 0.8rem; font-size: 0.75rem; }
            .nav-brand { font-size: 0.9rem; }
        }

        /* ─── HERO ─── */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding-top: 5.5rem;
            padding-bottom: 4rem;
            position: relative;
            overflow: hidden;
        }

        .hero-orbit-bg {
            position: absolute;
            inset: -40%;
            background:
                radial-gradient(circle at 5% 0%, rgba(239,68,68,0.28), transparent 55%),
                radial-gradient(circle at 85% 10%, rgba(248,113,113,0.32), transparent 55%),
                radial-gradient(circle at 50% 100%, rgba(127,29,29,0.35), transparent 58%);
            opacity: 0.9;
            animation: bgDrift 28s ease-in-out infinite alternate;
            pointer-events: none;
        }

        .hero-grid {
            position: absolute;
            inset: -10%;
            background-image:
                linear-gradient(rgba(148,163,184,0.08) 1px, transparent 1px),
                linear-gradient(90deg, rgba(148,163,184,0.08) 1px, transparent 1px);
            background-size: 46px 46px;
            opacity: 0.2;
            mask-image: radial-gradient(circle at top, black 0, transparent 60%);
            pointer-events: none;
        }

        .hero-inner {
            position: relative;
            display: grid;
            grid-template-columns: minmax(0, 1.4fr) minmax(0, 1.1fr);
            gap: 3rem;
            align-items: center;
            z-index: 1;
        }

        @media (max-width: 900px) {
            .hero-inner {
                grid-template-columns: minmax(0, 1fr);
            }
        }

        .hero-kicker {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.25rem 0.9rem;
            border-radius: 999px;
            border: 1px solid rgba(148,163,184,0.55);
            background: linear-gradient(to right, rgba(15,23,42,0.9), rgba(15,23,42,0.5));
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-bottom: 1.2rem;
        }

        .kicker-dot {
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: #22c55e;
            box-shadow: 0 0 14px rgba(34,197,94,0.85);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.3); opacity: 0.7; }
        }

        .hero-title {
            font-size: clamp(2.4rem, 4vw, 3.2rem);
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 0.9rem;
        }

        .hero-title span {
            background: linear-gradient(120deg, #fecaca, var(--accent), #fb923c);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .hero-tagline {
            font-size: 1.05rem;
            color: var(--text-muted);
            margin-bottom: 1rem;
        }

        .hero-description {
            font-size: 0.96rem;
            color: var(--text-muted);
            max-width: 32rem;
            margin-bottom: 1.8rem;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.9rem;
            align-items: center;
            margin-bottom: 1.6rem;
        }

        .btn-primary {
            border-radius: 999px;
            border: none;
            padding: 0.9rem 1.7rem;
            background: linear-gradient(120deg, #fecaca, var(--accent), #fb923c);
            background-size: 180% 180%;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: 0 22px 50px rgba(239,68,68,0.35);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            transition: var(--transition);
        }

        .btn-primary:hover {
            background-position: 100% 0;
            transform: translateY(-2px);
            box-shadow: 0 26px 60px rgba(239,68,68,0.5);
        }

        .btn-ghost {
            border-radius: 999px;
            border: 1px solid rgba(148,163,184,0.6);
            padding: 0.85rem 1.5rem;
            background: rgba(15,23,42,0.8);
            color: var(--text-muted);
            font-size: 0.87rem;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .btn-ghost:hover {
            border-color: var(--accent);
            color: var(--text-main);
            transform: translateY(-2px);
        }

        .hero-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .hero-meta-item {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.35rem 0.8rem;
            border-radius: 999px;
            background: rgba(15,23,42,0.8);
            border: 1px solid rgba(148,163,184,0.4);
            transition: var(--transition);
        }

        .hero-meta-item:hover {
            border-color: var(--accent);
        }

        .hero-right {
            display: flex;
            justify-content: center;
        }

        .hero-card {
            position: relative;
            width: min(340px, 100%);
            border-radius: 2rem;
            background: radial-gradient(circle at top left, rgba(248,113,113,0.24), transparent 55%), var(--bg-card);
            border: 1px solid rgba(148,163,184,0.4);
            box-shadow: var(--shadow-soft);
            padding: 1.5rem 1.5rem 1.6rem;
            overflow: hidden;
            transition: var(--transition);
        }

        .hero-card:hover {
            border-color: var(--accent);
            box-shadow: var(--shadow-hover);
        }

        .hero-avatar-ring {
            position: relative;
            width: 160px;
            height: 160px;
            margin: 0 auto 1.2rem;
            border-radius: 999px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-avatar-ring::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: inherit;
            border: 1px dashed rgba(148,163,184,0.45);
            animation: spin 26s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .hero-avatar-disk {
            position: relative;
            width: 120px;
            height: 120px;
            border-radius: 999px;
            border: 3px solid rgba(248,113,113,0.85);
            overflow: hidden;
            background:
                radial-gradient(circle at 20% 0%, rgba(248,113,113,0.28), transparent 50%),
                rgba(15,23,42,0.95);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 600;
        }

        .hero-avatar-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-float-pill {
            position: absolute;
            top: 1.1rem;
            right: 1rem;
            padding: 0.3rem 0.8rem;
            border-radius: 999px;
            background: rgba(15,23,42,0.9);
            border: 1px solid rgba(248,113,113,0.7);
            font-size: 0.7rem;
            color: var(--text-muted);
            animation: floatY 5.5s ease-in-out infinite;
        }

        .hero-float-pill-2 {
            position: absolute;
            bottom: 1.4rem;
            left: 1.1rem;
            padding: 0.35rem 0.8rem;
            border-radius: 999px;
            background: rgba(248,250,252,0.05);
            border: 1px solid rgba(148,163,184,0.5);
            font-size: 0.7rem;
            animation: floatY 6.5s ease-in-out infinite reverse;
        }

        @keyframes floatY {
            0% { transform: translateY(0); }
            50% { transform: translateY(-12px); }
            100% { transform: translateY(0); }
        }

        .hero-card-title {
            text-align: center;
            font-size: 0.95rem;
            font-weight: 500;
            margin-bottom: 0.2rem;
        }

        .hero-card-sub {
            text-align: center;
            font-size: 0.78rem;
            color: var(--text-muted);
            margin-bottom: 0.8rem;
        }

        .hero-card-divider {
            height: 1px;
            margin: 0.7rem 0 0.9rem;
            background: linear-gradient(to right, transparent, rgba(248,113,113,0.7), transparent);
        }

        .hero-social {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .hero-social a {
            width: 32px;
            height: 32px;
            border-radius: 999px;
            border: 1px solid rgba(148,163,184,0.55);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.76rem;
            color: var(--text-muted);
            transition: var(--transition);
        }

        .hero-social a:hover {
            transform: translateY(-2px);
            border-color: var(--accent);
            color: var(--accent);
            box-shadow: 0 14px 24px rgba(239,68,68,0.4);
        }

        /* ─── SECTIONS ─── */
        .section-header {
            text-align: left;
            margin-bottom: 2.5rem;
        }

        .section-kicker {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--accent-2);
            margin-bottom: 0.4rem;
        }

        .section-title {
            font-size: 1.7rem;
            font-weight: 600;
            margin-bottom: 0.55rem;
        }

        .section-subtitle {
            font-size: 0.94rem;
            color: var(--text-muted);
            max-width: 30rem;
        }

        /* ─── ABOUT ─── */
        .about-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.5fr) minmax(0, 1.1fr);
            gap: 2.5rem;
        }

        @media (max-width: 900px) {
            .about-grid {
                grid-template-columns: minmax(0, 1fr);
            }
        }

        .about-copy {
            font-size: 0.96rem;
            color: var(--text-muted);
        }

        .about-copy p + p {
            margin-top: 1.1rem;
        }

        .about-cards {
            display: grid;
            gap: 1rem;
        }

        .about-card {
            background: linear-gradient(to right, rgba(248,113,113,0.18), rgba(15,23,42,0.92));
            border-radius: 1rem;
            border: 1px solid rgba(148,163,184,0.4);
            padding: 1rem 1.2rem;
            transition: var(--transition);
        }

        .about-card:hover {
            border-color: var(--accent);
            transform: translateX(4px);
        }

        .about-card-title {
            font-size: 0.9rem;
            margin-bottom: 0.3rem;
            font-weight: 600;
        }

        .about-card-text {
            font-size: 0.84rem;
            color: var(--text-muted);
        }

        /* ─── SKILLS ─── */
        .skills-wrap {
            display: grid;
            grid-template-columns: minmax(0, 1.6fr) minmax(0, 1.1fr);
            gap: 2.5rem;
        }

        @media (max-width: 900px) {
            .skills-wrap {
                grid-template-columns: minmax(0, 1fr);
            }
        }

        .skills-list {
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
        }

        .skill-item {
            background: var(--bg-soft);
            border-radius: 1rem;
            border: 1px solid rgba(148,163,184,0.35);
            padding: 0.85rem 1rem;
            transition: var(--transition);
        }

        .skill-item:hover {
            border-color: var(--accent);
            transform: translateX(4px);
        }

        .skill-top {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 0.4rem;
        }

        .skill-name {
            font-size: 0.9rem;
            font-weight: 500;
        }

        .skill-level-label {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .skill-bar {
            width: 100%;
            height: 7px;
            background: radial-gradient(circle at top, rgba(15,23,42,0.9), rgba(15,23,42,1));
            border-radius: 999px;
            overflow: hidden;
        }

        .skill-fill {
            height: 100%;
            width: 0;
            border-radius: inherit;
            background: linear-gradient(90deg, #fecaca, #fb923c, var(--accent));
            transition: width 1.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .skills-cloud {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .skills-chip {
            padding: 0.3rem 0.7rem;
            border-radius: 999px;
            border: 1px solid rgba(148,163,184,0.4);
            font-size: 0.75rem;
            color: var(--text-muted);
            background: rgba(15,23,42,0.9);
            transition: var(--transition);
        }

        .skills-chip:hover {
            border-color: var(--accent);
            color: var(--text-main);
        }

        /* ─── PROJECTS ─── */
        .projects-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1.7rem;
        }

        @media (max-width: 1024px) {
            .projects-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .projects-grid {
                grid-template-columns: minmax(0, 1fr);
            }
        }

        .project-card {
            display: flex;
            flex-direction: column;
            background: var(--bg-soft);
            border-radius: var(--radius-xl);
            border: 1px solid rgba(148,163,184,0.4);
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(15,23,42,0.7);
            transition: var(--transition);
            height: 100%;
        }

        .project-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 26px 55px rgba(15,23,42,0.9);
            border-color: var(--accent);
        }

        .project-media {
            position: relative;
            height: 220px;
            background: radial-gradient(circle at top left, rgba(248,113,113,0.28), transparent 55%);
        }

        .project-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .project-tag {
            position: absolute;
            top: 0.75rem;
            left: 0.75rem;
            padding: 0.25rem 0.7rem;
            font-size: 0.72rem;
            border-radius: 999px;
            background: rgba(15,23,42,0.86);
            border: 1px solid rgba(248,113,113,0.75);
            color: var(--text-muted);
        }

        .project-body {
            padding: 1.4rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .project-title {
            font-size: 1.1rem;
            margin-bottom: 0.35rem;
            font-weight: 600;
        }

        .project-desc {
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-bottom: 0.7rem;
        }

        .project-link {
            font-size: 0.85rem;
            color: #fb7185;
            font-weight: 500;
            transition: var(--transition);
        }

        .project-link:hover {
            text-decoration: underline;
            color: var(--accent);
        }

        /* ─── CERTIFICATIONS ─── */
        .cert-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.2rem;
        }

        .cert-item {
            background: var(--bg-soft);
            border-radius: var(--radius-xl);
            border: 1px solid rgba(148,163,184,0.4);
            padding: 1.2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: var(--transition);
        }

        .cert-item:hover {
            transform: translateY(-4px);
            border-color: var(--accent);
            box-shadow: var(--shadow-hover);
        }

        .cert-icon {
            font-size: 2.5rem;
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
        .cert-title { font-weight: 600; font-size: 0.95rem; }
        .cert-org { font-size: 0.8rem; color: var(--text-muted); }
        .cert-date { font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.1em; }
        .cert-link { font-size: 0.75rem; color: var(--accent-2); font-weight: 500; }

        /* ─── SERVICES ─── */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1.5rem;
        }

        @media (max-width: 1024px) {
            .services-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }

        @media (max-width: 768px) {
            .services-grid { grid-template-columns: minmax(0, 1fr); }
        }

        .service-card {
            background: var(--bg-soft);
            border-radius: var(--radius-xl);
            border: 1px solid rgba(148,163,184,0.4);
            padding: 1.8rem 1.2rem;
            text-align: center;
            transition: var(--transition);
        }

        .service-card:hover {
            transform: translateY(-4px);
            border-color: var(--accent);
            box-shadow: var(--shadow-hover);
        }

        .service-icon { font-size: 2.8rem; margin-bottom: 0.6rem; }
        .service-title { font-weight: 600; font-size: 1rem; margin-bottom: 0.4rem; }
        .service-desc { font-size: 0.85rem; color: var(--text-muted); }

        /* ─── ACHIEVEMENTS ─── */
        .achievement-item {
            background: var(--bg-soft);
            border-radius: var(--radius-xl);
            border: 1px solid rgba(148,163,184,0.4);
            padding: 1rem 1.2rem;
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            transition: var(--transition);
        }

        .achievement-item:hover {
            transform: translateX(4px);
            border-color: var(--accent);
        }

        .achievement-icon { font-size: 2rem; flex-shrink: 0; }
        .achievement-title { font-weight: 600; font-size: 0.95rem; }
        .achievement-org { font-size: 0.85rem; color: var(--text-muted); }
        .achievement-desc { font-size: 0.85rem; color: var(--text-muted); margin-top: 0.2rem; }
        .achievement-date { font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.1em; margin-top: 0.2rem; }

        /* ─── VOLUNTEER ─── */
        .volunteer-item {
            background: var(--bg-soft);
            border-radius: var(--radius-xl);
            border: 1px solid rgba(148,163,184,0.4);
            padding: 1rem 1.2rem;
            transition: var(--transition);
        }

        .volunteer-item:hover {
            transform: translateX(4px);
            border-color: var(--accent);
        }

        .volunteer-org { font-weight: 600; font-size: 0.95rem; }
        .volunteer-role { font-size: 0.85rem; color: var(--text-muted); }
        .volunteer-location { font-size: 0.8rem; color: var(--text-muted); }
        .volunteer-date { font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.1em; margin-top: 0.2rem; }

        /* ─── TESTIMONIALS ─── */
        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1.5rem;
        }

        @media (max-width: 768px) {
            .testimonial-grid { grid-template-columns: minmax(0, 1fr); }
        }

        .testimonial-card {
            background: var(--bg-soft);
            border-radius: var(--radius-xl);
            border: 1px solid rgba(148,163,184,0.4);
            padding: 1.5rem;
            transition: var(--transition);
        }

        .testimonial-card:hover {
            transform: translateY(-4px);
            border-color: var(--accent);
            box-shadow: var(--shadow-hover);
        }

        .testimonial-text {
            font-style: italic;
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-bottom: 0.8rem;
        }
        .testimonial-author { font-weight: 600; font-size: 0.9rem; }
        .testimonial-role { font-size: 0.8rem; color: var(--text-muted); }
        .testimonial-rating { color: #fbbf24; font-size: 1rem; margin-top: 0.4rem; }

        /* ─── GALLERY ─── */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 1rem;
        }

        .gallery-item {
            border-radius: var(--radius-xl);
            overflow: hidden;
            border: 1px solid rgba(148,163,184,0.4);
            aspect-ratio: 1;
            transition: var(--transition);
        }

        .gallery-item:hover {
            transform: scale(1.03);
            border-color: var(--accent);
            box-shadow: var(--shadow-hover);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* ─── GOALS ─── */
        .goals-list {
            list-style: none;
            display: grid;
            gap: 0.9rem;
        }

        .goal-item {
            background: var(--bg-soft);
            border-radius: 1rem;
            border-left: 3px solid var(--accent);
            border-top: 1px solid rgba(148,163,184,0.35);
            border-right: 1px solid rgba(148,163,184,0.35);
            border-bottom: 1px solid rgba(148,163,184,0.35);
            padding: 0.9rem 1rem;
            font-size: 0.9rem;
            color: var(--text-muted);
            transition: var(--transition);
        }

        .goal-item:hover {
            transform: translateX(4px);
            border-left-color: var(--accent-2);
        }

        /* ─── CONTACT ─── */
        .contact-section {
            padding-bottom: 4rem;
        }

        .contact-card {
            background: var(--bg-soft);
            border-radius: var(--radius-xl);
            border: 1px solid rgba(148,163,184,0.4);
            padding: 1.8rem 1.6rem;
            display: grid;
            grid-template-columns: minmax(0, 1.1fr) minmax(0, 1.2fr);
            gap: 2rem;
            transition: var(--transition);
        }

        .contact-card:hover {
            border-color: var(--accent);
        }

        @media (max-width: 900px) {
            .contact-card {
                grid-template-columns: minmax(0, 1fr);
            }
        }

        .contact-info p {
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .contact-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.6rem;
            font-size: 0.9rem;
            color: var(--text-muted);
            transition: var(--transition);
        }

        .contact-row:hover {
            color: var(--text-main);
        }

        .contact-row .icon {
            width: 26px;
            height: 26px;
            border-radius: 999px;
            background: rgba(15,23,42,0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            border: 1px solid rgba(148,163,184,0.3);
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            border-radius: 0.8rem;
            border: 1px solid rgba(148,163,184,0.45);
            background: rgba(15,23,42,0.9);
            padding: 0.7rem 0.8rem;
            color: var(--text-main);
            font-size: 0.85rem;
            outline: none;
            transition: var(--transition);
            font-family: inherit;
        }

        .contact-form input:focus,
        .contact-form textarea:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(239,68,68,0.15);
        }

        .contact-form input::placeholder,
        .contact-form textarea::placeholder {
            color: var(--text-muted);
        }

        .contact-form textarea {
            resize: vertical;
            min-height: 100px;
        }

        .contact-form .field + .field {
            margin-top: 0.7rem;
        }

        .contact-form button {
            margin-top: 0.9rem;
            width: 100%;
        }

        /* ─── FOOTER ─── */
        .footer {
            border-top: 1px solid rgba(148,163,184,0.28);
            padding: 1.4rem 1.5rem 1.7rem;
            text-align: center;
            font-size: 0.78rem;
            color: var(--text-muted);
            background: rgba(15,23,42,0.98);
        }

        .footer-social {
            margin-top: 0.6rem;
            display: flex;
            justify-content: center;
            gap: 0.65rem;
            flex-wrap: wrap;
        }

        .footer-social a {
            font-size: 0.78rem;
            padding: 0.25rem 0.7rem;
            border-radius: 999px;
            border: 1px solid rgba(148,163,184,0.4);
            transition: var(--transition);
        }

        .footer-social a:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        /* ─── REVEAL ANIMATIONS ─── */
        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }

        .reveal.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ─── KEYFRAMES ─── */
        @keyframes bgDrift {
            0% { transform: translate3d(-3%, 2%, 0) scale(1); }
            50% { transform: translate3d(4%, -2%, 0) scale(1.05); }
            100% { transform: translate3d(-2%, 3%, 0) scale(1.02); }
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 768px) {
            .hero {
                text-align: center;
                padding-top: 4rem;
            }
            .hero-actions {
                justify-content: center;
            }
            .hero-meta {
                justify-content: center;
            }
            .hero-description {
                margin: 0 auto 1.8rem;
            }
            .section-header {
                text-align: center;
            }
            .section-subtitle {
                margin: 0 auto;
            }
            section {
                padding: 3rem 0;
            }
            .hero-card {
                width: 100%;
            }
            .hero-avatar-ring {
                width: 140px;
                height: 140px;
            }
            .hero-avatar-disk {
                width: 100px;
                height: 100px;
                font-size: 1.5rem;
            }
        }

        /* ─── EMPTY STATE ─── */
        .empty-state {
            text-align: center;
            color: var(--text-muted);
            padding: 2rem;
            background: var(--bg-soft);
            border-radius: var(--radius-xl);
            border: 1px dashed rgba(148,163,184,0.4);
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
    $volunteers     = $user->volunteers ?? collect();
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
    $hasContact  = $profile->contact_email || $profile->location || $profile->contact_phone;
    $hasSocial   = $profile->social_facebook || $profile->social_linkedin || $profile->social_github
                   || $profile->social_instagram || $profile->social_twitter;
@endphp

<!-- ─── NAV ─── -->
<header class="nav">
    <div class="nav-inner">
        <div class="nav-brand">
            {{ $user->name }}
            <span>Portfolio</span>
        </div>
        <nav class="nav-links">
            <a href="#hero" class="nav-link active">Home</a>
            @if($hasAbout)<a href="#about" class="nav-link">About</a>@endif
            @if($hasSkills)<a href="#skills" class="nav-link">Skills</a>@endif
            @if($hasProjects)<a href="#projects" class="nav-link">Projects</a>@endif
            @if($hasCerts)<a href="#certifications" class="nav-link">Certifications</a>@endif
            @if($hasServices)<a href="#services" class="nav-link">Services</a>@endif
            @if($hasContact)<a href="#contact" class="nav-contact-btn">Contact</a>@endif
        </nav>
    </div>
</header>

<!-- ─── HERO ─── -->
<section id="hero" class="hero">
    <div class="hero-orbit-bg"></div>
    <div class="hero-grid"></div>

    <div class="container">
        <div class="hero-inner">
            <div class="hero-left reveal">
                <div class="hero-kicker">
                    <span class="kicker-dot"></span>
                    <span>Available for new opportunities</span>
                </div>
                <h1 class="hero-title">
                    Hi, I'm <span>{{ $user->name }}</span>
                </h1>

                @if($profile->tagline)
                    <p class="hero-tagline">{{ $profile->tagline }}</p>
                @endif

                @if($profile->about_short)
                    <p class="hero-description">{{ $profile->about_short }}</p>
                @endif

                <div class="hero-actions">
                    @if($hasProjects)
                        <a href="#projects" class="btn-primary">
                            View my work →
                        </a>
                    @endif

                    @if($hasContact)
                        <a href="#contact" class="btn-ghost">
                            Let's collaborate
                        </a>
                    @endif

                    <a href="{{ route('portfolio.pdf', ['id' => $user->id, 'username' => $user->username]) }}"
                       class="btn-ghost" target="_blank">
                        📄 Download CV
                    </a>

                    @if($profile->live_link)
                        <a href="{{ $profile->live_link }}" target="_blank" class="btn-ghost">
                            🌐 Live Demo
                        </a>
                    @endif
                </div>

                <div class="hero-meta">
                    @if($profile->location)
                        <div class="hero-meta-item">
                            <span>📍</span>
                            <span>{{ $profile->location }}</span>
                        </div>
                    @endif
                    @if($profile->contact_email)
                        <div class="hero-meta-item">
                            <span>📧</span>
                            <span>{{ $profile->contact_email }}</span>
                        </div>
                    @endif
                    @if($profile->contact_phone)
                        <div class="hero-meta-item">
                            <span>📱</span>
                            <span>{{ $profile->contact_phone }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="hero-right reveal">
                <div class="hero-card">
                    <div class="hero-avatar-ring">
                        <div class="hero-avatar-disk">
                            @if($profile->profile_image)
                                <img src="{{ asset('storage/' . $profile->profile_image) }}"
                                     alt="{{ $user->name }}"
                                     class="hero-avatar-img">
                            @else
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            @endif
                        </div>
                    </div>

                    <div class="hero-float-pill">
                        ✨ Crafting thoughtful experiences
                    </div>
                    <div class="hero-float-pill-2">
                        {{ $profile->tagline ?: 'Design · Code · Ship' }}
                    </div>

                    <p class="hero-card-title">{{ $user->name }}</p>
                    @if($profile->tagline)
                        <p class="hero-card-sub">{{ $profile->tagline }}</p>
                    @else
                        <p class="hero-card-sub">Digital creator & problem-solver</p>
                    @endif

                    <div class="hero-card-divider"></div>

                    @if($hasSocial)
                        <div class="hero-social">
                            @if($profile->social_github)
                                <a href="{{ $profile->social_github }}" target="_blank" title="GitHub">GH</a>
                            @endif
                            @if($profile->social_linkedin)
                                <a href="{{ $profile->social_linkedin }}" target="_blank" title="LinkedIn">in</a>
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

<!-- ─── ABOUT ─── -->
@if($hasAbout)
<section id="about">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-kicker">About</div>
            <h2 class="section-title">{{ $profile->about_title ?? 'About Me' }}</h2>
            @if($profile->about_short && !$profile->about_long)
                <p class="section-subtitle">{{ $profile->about_short }}</p>
            @endif
        </div>

        <div class="about-grid">
            <div class="about-copy reveal">
                @if($profile->about_short)
                    <p>{{ $profile->about_short }}</p>
                @endif
                @if($profile->about_long)
                    <p>{{ $profile->about_long }}</p>
                @endif
            </div>

            <div class="about-cards reveal">
                @if($goals->count())
                    <div class="about-card">
                        <p class="about-card-title">🎯 Goals</p>
                        <p class="about-card-text">
                            @foreach($goals as $goal)
                                • {{ $goal->goal_text }}<br>
                            @endforeach
                        </p>
                    </div>
                @endif
                <div class="about-card">
                    <p class="about-card-title">💡 What I enjoy</p>
                    <p class="about-card-text">
                        Building fast, minimal interfaces with enough motion to feel alive
                        without getting in the way of the content.
                    </p>
                </div>
                <div class="about-card">
                    <p class="about-card-title">⚡ How I work</p>
                    <p class="about-card-text">
                        I care about communication, clean code, and small details that
                        make products feel polished and trustworthy.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- ─── SKILLS ─── -->
@if($hasSkills)
<section id="skills">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-kicker">Skills</div>
            <h2 class="section-title">What I work with</h2>
            <p class="section-subtitle">
                A mix of tools and technologies I use to design and build digital products.
            </p>
        </div>

        <div class="skills-wrap">
            <div class="skills-list reveal">
                @foreach($skills as $skill)
                    @php
                        $percent = 40;
                        if ($skill->level === 'Expert') $percent = 95;
                        elseif ($skill->level === 'Intermediate') $percent = 70;
                        elseif ($skill->level === 'Beginner') $percent = 40;
                    @endphp
                    <div class="skill-item">
                        <div class="skill-top">
                            <div class="skill-name">{{ $skill->name }}</div>
                            @if($skill->level)
                                <div class="skill-level-label">{{ $skill->level }}</div>
                            @endif
                        </div>
                        <div class="skill-bar">
                            <div class="skill-fill" data-skill="{{ $percent }}"></div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="reveal">
                <p style="font-size:0.9rem; color:var(--text-muted); margin-bottom:0.7rem;">
                    A quick snapshot of my toolbox. Let's mix and match the right stack for your idea.
                </p>
                <div class="skills-cloud">
                    @foreach($skills as $skill)
                        <span class="skills-chip">{{ $skill->name }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- ─── EXPERIENCE ─── -->
@if($experiences->count() || $educations->count())
<section id="experience" style="background: rgba(15,23,42,0.4);">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-kicker">Journey</div>
            <h2 class="section-title">Experience & Education</h2>
            <p class="section-subtitle">Professional background and academic journey.</p>
        </div>

        <div class="about-grid">
            @if($experiences->count())
                <div>
                    <h3 style="font-size:0.95rem; font-weight:600; margin-bottom:0.8rem; color:var(--text-muted);">💼 Experience</h3>
                    <div style="display:grid; gap:0.8rem;">
                        @foreach($experiences as $exp)
                            <div class="achievement-item">
                                <div style="flex:1;">
                                    <div class="achievement-title">{{ $exp->role_title ?? $exp->title }}</div>
                                    <div style="font-size:0.85rem; color:var(--text-muted);">{{ $exp->company }}</div>
                                    <div style="font-size:0.7rem; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.1em; margin-top:0.2rem;">
                                        {{ optional($exp->start_date)->format('M Y') }} –
                                        {{ $exp->is_current ? 'Present' : optional($exp->end_date)->format('M Y') }}
                                        @if($exp->location) • {{ $exp->location }} @endif
                                    </div>
                                    @if($exp->description)
                                        <div style="font-size:0.85rem; color:var(--text-muted); margin-top:0.3rem;">{{ $exp->description }}</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($educations->count())
                <div>
                    <h3 style="font-size:0.95rem; font-weight:600; margin-bottom:0.8rem; color:var(--text-muted);">🎓 Education</h3>
                    <div style="display:grid; gap:0.8rem;">
                        @foreach($educations as $edu)
                            <div class="achievement-item">
                                <div style="flex:1;">
                                    <div class="achievement-title">{{ $edu->degree }}</div>
                                    <div style="font-size:0.85rem; color:var(--text-muted);">{{ $edu->institution }}</div>
                                    <div style="font-size:0.7rem; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.1em; margin-top:0.2rem;">
                                        {{ optional($edu->start_date)->format('Y') }} –
                                        {{ $edu->is_current ? 'Present' : optional($edu->end_date)->format('Y') }}
                                        @if($edu->field_of_study) • {{ $edu->field_of_study }} @endif
                                    </div>
                                    @if($edu->description)
                                        <div style="font-size:0.85rem; color:var(--text-muted); margin-top:0.3rem;">{{ $edu->description }}</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
@endif

<!-- ─── CERTIFICATIONS ─── -->
@if($hasCerts)
<section id="certifications">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-kicker">Certifications</div>
            <h2 class="section-title">📜 Professional Certifications</h2>
            <p class="section-subtitle">Validated expertise in my field.</p>
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
<section id="projects" style="background: rgba(15,23,42,0.4);">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-kicker">Projects</div>
            <h2 class="section-title">Selected work</h2>
            <p class="section-subtitle">
                A few things I've built. Each one taught me something new.
            </p>
        </div>

        <div class="projects-grid">
            @foreach($projects as $project)
                <article class="project-card reveal">
                    <div class="project-media">
                        @if($project->project_image)
                            <img src="{{ asset('storage/' . $project->project_image) }}"
                                 alt="{{ $project->title }}">
                        @else
                            <div style="display:flex; align-items:center; justify-content:center; height:100%; color:var(--accent); font-size:4rem;">
                                {{ strtoupper(substr($project->title, 0, 1)) }}
                            </div>
                        @endif
                        <div class="project-tag">Project</div>
                    </div>
                    <div class="project-body">
                        <h3 class="project-title">{{ $project->title }}</h3>
                        @if($project->short_description)
                            <p class="project-desc">{{ $project->short_description }}</p>
                        @endif
                        @if($project->project_url)
                            <a href="{{ $project->project_url }}" target="_blank" class="project-link">
                                View project →
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
<section id="services">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-kicker">Services</div>
            <h2 class="section-title">💎 What I offer</h2>
            <p class="section-subtitle">How I can help bring your ideas to life.</p>
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
<section id="achievements" style="background: rgba(15,23,42,0.4);">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-kicker">Achievements</div>
            <h2 class="section-title">🏆 Milestones</h2>
            <p class="section-subtitle">Recognition and accomplishments I'm proud of.</p>
        </div>

        <div style="display:grid; gap:1rem;">
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
    </div>
</section>
@endif

<!-- ─── VOLUNTEER ─── -->
@if($hasVolunteers)
<section id="volunteer">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-kicker">Volunteer</div>
            <h2 class="section-title">❤️ Giving Back</h2>
            <p class="section-subtitle">Community work and volunteer experiences.</p>
        </div>

        <div style="display:grid; gap:1rem;">
            @foreach($volunteers as $item)
                <div class="volunteer-item">
                    <div class="volunteer-org">{{ $item->organization_name }}</div>
                    <div class="volunteer-role">{{ $item->role }}</div>
                    @if($item->location)
                        <div class="volunteer-location">📍 {{ $item->location }}</div>
                    @endif
                    @if($item->description)
                        <div style="font-size:0.85rem; color:var(--text-muted); margin-top:0.3rem;">{{ $item->description }}</div>
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
<section id="testimonials" style="background: rgba(15,23,42,0.4);">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-kicker">Testimonials</div>
            <h2 class="section-title">💬 What People Say</h2>
            <p class="section-subtitle">Feedback from people I've worked with.</p>
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
<section id="gallery">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-kicker">Gallery</div>
            <h2 class="section-title">📸 Visual Diary</h2>
            <p class="section-subtitle">A glimpse into my creative world.</p>
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

<!-- ─── GOALS ─── -->
@if($hasGoals && !$hasAbout)
<section id="goals">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-kicker">Goals</div>
            <h2 class="section-title">Where I'm headed</h2>
            <p class="section-subtitle">
                Some of the things I'm learning, building toward, or excited to do next.
            </p>
        </div>

        <ul class="goals-list reveal">
            @foreach($goals as $goal)
                <li class="goal-item">{{ $goal->goal_text }}</li>
            @endforeach
        </ul>
    </div>
</section>
@endif

<!-- ─── CONTACT ─── -->
@if($hasContact)
<section id="contact" class="contact-section">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-kicker">Contact</div>
            <h2 class="section-title">🤝 Let's talk</h2>
            <p class="section-subtitle">
                Share a quick summary of your idea, timeline, or project and I'll get back to you.
            </p>
        </div>

        <div class="contact-card reveal">
            <div class="contact-info">
                @if($profile->contact_email || $profile->location || $profile->contact_phone)
                    <p>If you prefer email or just want to say hi:</p>
                @endif

                @if($profile->contact_email)
                    <div class="contact-row">
                        <span class="icon">📧</span>
                        <span>{{ $profile->contact_email }}</span>
                    </div>
                @endif

                @if($profile->contact_phone)
                    <div class="contact-row">
                        <span class="icon">📱</span>
                        <span>{{ $profile->contact_phone }}</span>
                    </div>
                @endif

                @if($profile->location)
                    <div class="contact-row">
                        <span class="icon">📍</span>
                        <span>{{ $profile->location }}</span>
                    </div>
                @endif

                @if($profile->live_link)
                    <div class="contact-row">
                        <span class="icon">🌐</span>
                        <a href="{{ $profile->live_link }}" target="_blank" style="color:var(--accent-2);">{{ $profile->live_link }}</a>
                    </div>
                @endif
            </div>

            <form class="contact-form" onsubmit="return false;">
                <div class="field">
                    <input type="text" placeholder="Your name">
                </div>
                <div class="field">
                    <input type="email" placeholder="Your email">
                </div>
                <div class="field">
                    <textarea placeholder="Project details, ideas, or questions"></textarea>
                </div>
                <button class="btn-primary" type="submit">
                    Send message →
                </button>
            </form>
        </div>
    </div>
</section>
@endif

<!-- ─── FOOTER ─── -->
<footer class="footer">
    <div>© {{ date('Y') }} {{ $user->name }}. All rights reserved.</div>

    @if($hasSocial)
        <div class="footer-social">
            @if($profile->social_github)
                <a href="{{ $profile->social_github }}" target="_blank">GitHub</a>
            @endif
            @if($profile->social_linkedin)
                <a href="{{ $profile->social_linkedin }}" target="_blank">LinkedIn</a>
            @endif
            @if($profile->social_twitter)
                <a href="{{ $profile->social_twitter }}" target="_blank">Twitter</a>
            @endif
            @if($profile->social_instagram)
                <a href="{{ $profile->social_instagram }}" target="_blank">Instagram</a>
            @endif
            @if($profile->social_facebook)
                <a href="{{ $profile->social_facebook }}" target="_blank">Facebook</a>
            @endif
        </div>
    @endif
</footer>

<script>
    // Scroll reveal for sections + skill bars
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');

                const fills = entry.target.querySelectorAll('.skill-fill[data-skill]');
                fills.forEach((el) => {
                    if (!el.style.width || el.style.width === '0px') {
                        el.style.width = el.dataset.skill + '%';
                    }
                });
            }
        });
    }, { threshold: 0.18 });

    document.querySelectorAll('.reveal').forEach((el) => observer.observe(el));

    // highlight nav link on scroll
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link');

    const highlightNav = () => {
        let currentId = 'hero';
        const scrollPos = window.scrollY + 120;
        sections.forEach(sec => {
            if (scrollPos >= sec.offsetTop && scrollPos < sec.offsetTop + sec.offsetHeight) {
                currentId = sec.id;
            }
        });
        navLinks.forEach(link => {
            link.classList.toggle('active', link.getAttribute('href') === '#' + currentId);
        });
    };

    window.addEventListener('scroll', highlightNav);
    highlightNav();

    // Smooth scroll for all anchor links
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
