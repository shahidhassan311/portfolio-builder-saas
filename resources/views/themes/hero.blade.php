<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('themes.partials.seo-meta')

    <link rel="icon" type="image/png" href="{{ asset(config('branding.logo')) }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #667eea;
            --primary-dark: #4c51bf;
            --primary-soft: #e0e7ff;
            --primary-light: rgba(102, 126, 234, 0.12);
            --bg-soft: #f9fafb;
            --text-main: #111827;
            --text-muted: #6b7280;
            --card-bg: #ffffff;
            --shadow-soft: 0 18px 45px rgba(15, 23, 42, 0.18);
            --shadow-hover: 0 24px 60px rgba(15, 23, 42, 0.25);
            --radius-card: 24px;
            --radius-sm: 16px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: var(--text-main);
            background: radial-gradient(circle at 0% 0%, rgba(102, 126, 234, 0.18), transparent 55%),
                        radial-gradient(circle at 100% 0%, rgba(118, 75, 162, 0.18), transparent 55%),
                        #0f172a;
            min-height: 100vh;
        }

        .page-wrapper {
            min-height: 100vh;
            background:
                radial-gradient(circle at 10% 20%, rgba(148, 163, 255, 0.25), transparent 60%),
                radial-gradient(circle at 90% 10%, rgba(129, 140, 248, 0.15), transparent 55%);
        }

        /* ─── HERO ─── */
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
            transition: var(--transition);
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
            transition: var(--transition);
        }

        .hero-social a:hover {
            transform: translateY(-2px) scale(1.04);
            background: #e5e7eb;
            color: #111827;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.8);
        }

        /* ─── SECTIONS ─── */
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

        /* ─── GRID LAYOUTS ─── */
        .two-col {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
            gap: 28px;
            align-items: flex-start;
        }

        .grid-three {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 24px;
        }

        .grid-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 16px;
        }

        @media (max-width: 1024px) {
            .grid-three { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }

        @media (max-width: 768px) {
            .two-col { grid-template-columns: minmax(0, 1fr); }
            .grid-three { grid-template-columns: minmax(0, 1fr); }
            .grid-gallery { grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); }
        }

        /* ─── CARDS ─── */
        .card {
            background: var(--card-bg);
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-soft);
            padding: 24px 24px 22px;
            transition: var(--transition);
        }

        .card:hover {
            box-shadow: var(--shadow-hover);
            transform: translateY(-2px);
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

        /* ─── TIMELINE ─── */
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

        /* ─── SKILLS ─── */
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
            border-radius: var(--radius-sm);
            box-shadow: 0 14px 30px rgba(15, 23, 42, 0.08);
            border: 1px solid rgba(148, 163, 255, 0.4);
            transition: var(--transition);
        }

        .skill-item:hover {
            transform: translateX(4px);
            box-shadow: var(--shadow-hover);
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

        /* ─── PROJECTS ─── */
        .projects-container {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 24px;
            max-width: 1120px;
            margin: 0 auto;
        }

        @media (max-width: 1024px) {
            .projects-container { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }

        @media (max-width: 640px) {
            .projects-container { grid-template-columns: minmax(0, 1fr); }
        }

        .project-card {
            background: var(--card-bg);
            border-radius: var(--radius-card);
            overflow: hidden;
            box-shadow: var(--shadow-soft);
            display: flex;
            flex-direction: column;
            height: 100%;
            transition: var(--transition);
        }

        .project-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
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
            transition: var(--transition);
        }

        .project-link:hover {
            color: var(--primary);
            letter-spacing: 0.12em;
        }

        /* ─── GOALS ─── */
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
            border-radius: var(--radius-sm);
            border-left: 4px solid var(--primary);
            color: var(--text-muted);
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.09);
            font-size: 14px;
            transition: var(--transition);
        }

        .goals-list li:hover {
            transform: translateX(4px);
            box-shadow: var(--shadow-hover);
        }

        /* ─── CERTIFICATIONS ─── */
        .certification-item {
            display: flex;
            align-items: center;
            gap: 18px;
            padding: 16px 20px;
            border-radius: var(--radius-sm);
            border: 1px solid rgba(148, 163, 255, 0.2);
            background: rgba(255, 255, 255, 0.03);
            transition: var(--transition);
            backdrop-filter: blur(4px);
        }

        .certification-item:hover {
            background: rgba(148, 163, 255, 0.08);
            transform: translateX(4px);
            border-color: rgba(148, 163, 255, 0.5);
        }

        .certification-badge {
            font-size: 36px;
            flex-shrink: 0;
        }

        .certification-image {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .certification-info {
            flex: 1;
        }

        .certification-name {
            font-weight: 600;
            font-size: 18px;
            color: var(--text-main);
        }

        .certification-issuer {
            color: var(--text-muted);
            font-size: 14px;
        }

        .certification-date {
            color: var(--text-muted);
            font-size: 12px;
            letter-spacing: 0.2em;
            text-transform: uppercase;
        }

        /* ─── SERVICES ─── */
        .service-card {
            padding: 32px 24px;
            border-radius: var(--radius-card);
            border: 1px solid rgba(148, 163, 255, 0.2);
            background: var(--card-bg);
            text-align: center;
            transition: var(--transition);
            box-shadow: var(--shadow-soft);
        }

        .service-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
            border-color: var(--primary);
        }

        .service-icon {
            font-size: 44px;
            margin-bottom: 16px;
        }

        .service-title {
            font-weight: 600;
            font-size: 18px;
            margin-bottom: 8px;
            color: var(--text-main);
        }

        .service-description {
            color: var(--text-muted);
            font-size: 14px;
            line-height: 1.6;
        }

        /* ─── ACHIEVEMENTS ─── */
        .achievement-item {
            display: flex;
            align-items: flex-start;
            gap: 18px;
            padding: 16px 20px;
            border-radius: var(--radius-sm);
            border: 1px solid rgba(148, 163, 255, 0.2);
            background: rgba(255, 255, 255, 0.03);
            transition: var(--transition);
        }

        .achievement-item:hover {
            background: rgba(148, 163, 255, 0.08);
            transform: translateX(4px);
        }

        .achievement-icon {
            font-size: 30px;
            flex-shrink: 0;
        }

        .achievement-content {
            flex: 1;
        }

        .achievement-title {
            font-weight: 600;
            font-size: 18px;
            color: var(--text-main);
        }

        .achievement-description {
            color: var(--text-muted);
            font-size: 14px;
            margin-top: 4px;
        }

        /* ─── VOLUNTEER ─── */
        .volunteer-item {
            padding: 20px;
            border-radius: var(--radius-sm);
            border: 1px solid rgba(148, 163, 255, 0.2);
            background: rgba(255, 255, 255, 0.03);
            transition: var(--transition);
        }

        .volunteer-item:hover {
            background: rgba(148, 163, 255, 0.08);
            transform: translateX(4px);
        }

        .volunteer-organization {
            font-weight: 600;
            font-size: 18px;
            color: var(--text-main);
        }

        .volunteer-role {
            color: var(--text-muted);
            font-size: 14px;
        }

        .volunteer-date {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: var(--text-muted);
            margin-top: 8px;
        }

        /* ─── TESTIMONIALS ─── */
        .testimonial-card {
            padding: 28px;
            border-radius: var(--radius-card);
            border: 1px solid rgba(148, 163, 255, 0.2);
            background: var(--card-bg);
            transition: var(--transition);
            box-shadow: var(--shadow-soft);
        }

        .testimonial-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .testimonial-text {
            font-style: italic;
            color: var(--text-main);
            line-height: 1.6;
            margin-bottom: 16px;
            font-size: 15px;
        }

        .testimonial-author {
            font-weight: 600;
            color: var(--text-main);
        }

        .testimonial-role {
            font-size: 13px;
            color: var(--text-muted);
        }

        .testimonial-rating {
            margin-top: 10px;
            color: #FFD700;
            font-size: 18px;
        }

        /* ─── GALLERY ─── */
        .gallery-item {
            border-radius: var(--radius-sm);
            overflow: hidden;
            border: 1px solid rgba(148, 163, 255, 0.2);
            aspect-ratio: 1;
            background: rgba(0, 0, 0, 0.3);
            transition: var(--transition);
        }

        .gallery-item:hover {
            transform: scale(1.03);
            box-shadow: var(--shadow-hover);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .gallery-item img:hover {
            transform: scale(1.05);
        }

        /* ─── FOOTER ─── */
        .footer {
            background: #020617;
            color: #e5e7eb;
            padding: 40px 24px 36px;
            text-align: center;
            border-top: 1px solid rgba(148, 163, 255, 0.3);
            margin-top: 40px;
        }

        .footer-contact {
            display: flex;
            flex-wrap: wrap;
            gap: 24px;
            justify-content: center;
            margin-bottom: 20px;
        }

        .footer-contact p {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #c7d2fe;
            font-size: 14px;
        }

        .social-links {
            display: flex;
            gap: 18px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .social-links a {
            color: #e5e7eb;
            text-decoration: none;
            font-size: 14px;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            transition: var(--transition);
        }

        .social-links a:hover {
            color: var(--primary);
            transform: translateY(-2px);
        }

        .footer-copy {
            margin-top: 24px;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.4);
        }

        /* ─── ANIMATIONS ─── */
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

        /* ─── RESPONSIVE ─── */
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
                padding-top: 48px;
                padding-bottom: 48px;
            }

            .section-title {
                font-size: 24px;
            }

            .hero {
                padding: 48px 18px 40px;
            }

            .hero-card {
                width: 100%;
                padding: 20px 16px;
            }

            .hero-avatar,
            .hero-avatar-fallback {
                width: 100px;
                height: 100px;
                font-size: 36px;
            }

            .certification-item {
                flex-direction: column;
                text-align: center;
            }

            .testimonial-card {
                padding: 20px;
            }
        }

        /* ─── UTILITY ─── */
        .empty {
            color: var(--text-muted);
            font-size: 14px;
            text-align: center;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        @php
            // ─── SAME VARIABLES AS TEMPLATE 1 ───
            $profile        = optional($user->profile);
            $experiences    = $user->experiences ?? collect();
            $educations     = $user->educations ?? collect();
            $projects       = $user->projects ?? collect();
            $skills         = $user->skills ?? collect();
            $goals          = $user->goals ?? collect();
            $certifications = $user->certifications ?? collect();
            $gallery        = $user->gallery ?? collect();
            $volunteers     = $user->volunteer ?? collect();  // same as template 1
            $achievements   = $user->achievements ?? collect();
            $services       = $user->services ?? collect();
            $testimonials   = $user->testimonials ?? collect();

            // ─── SAME PRIMARY CONTACT LOGIC ───
            $primaryContact = $profile?->contact_email
                ? 'mailto:' . $profile->contact_email
                : ($profile?->contact_phone ? 'tel:' . $profile->contact_phone : null);
        @endphp

        <!-- ─── HERO ─── -->
        <div class="hero" id="hero">
            <div class="hero-inner">
                <div class="hero-main">
                    <div class="hero-pill">✨ Personal Portfolio</div>
                    <h1 class="hero-name">
                        Hi, I'm <span>{{ $user->name }}</span>
                    </h1>
                    @if($profile && $profile->tagline)
                        <p class="hero-tagline">{{ $profile->tagline }}</p>
                    @endif
                    @if($profile && ($profile->about_short || $profile->about_long))
                        <p class="hero-description">{{ $profile->about_long ?? $profile->about_short }}</p>
                    @endif

                    <div class="hero-actions">
                        @if($primaryContact)
                            <a href="{{ $primaryContact }}" class="cta-button cta-primary">
                                📬 Let's collaborate
                            </a>
                        @endif
                        <a href="{{ route('portfolio.pdf', ['id' => $user->id, 'username' => $user->username]) }}"
                           class="cta-button cta-secondary" target="_blank">
                            📄 Download PDF
                        </a>
                        @if($profile && $profile->live_link)
                            <a href="{{ $profile->live_link }}" target="_blank" class="cta-button cta-secondary">
                                🌐 Live Demo
                            </a>
                        @endif
                    </div>

                    <div class="hero-meta">
                        @if($profile && $profile->location)
                            <span>📍 {{ $profile->location }}</span>
                        @endif
                        @if($profile && $profile->contact_email)
                            <span>✉️ {{ $profile->contact_email }}</span>
                        @endif
                        @if($profile && $profile->contact_phone)
                            <span>📱 {{ $profile->contact_phone }}</span>
                        @endif
                    </div>
                </div>

                <div class="hero-side">
                    <div class="hero-card">
                        @if($profile && $profile->profile_image)
                            <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="{{ $user->name }}" class="hero-avatar">
                        @else
                            <div class="hero-avatar-fallback">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif

                        <div class="hero-card-name">{{ $user->name }}</div>
                        <div class="hero-card-role">
                            {{ $profile && $profile->tagline ? $profile->tagline : 'Creative Professional' }}
                        </div>

                        <div class="hero-card-divider"></div>

                        <div class="hero-badges">
                            <div class="hero-badge">
                                <strong>{{ $experiences->count() }}</strong>
                                <span>Experience</span>
                            </div>
                            <div class="hero-badge">
                                <strong>{{ $projects->count() }}</strong>
                                <span>Projects</span>
                            </div>
                            <div class="hero-badge">
                                <strong>{{ $skills->count() }}</strong>
                                <span>Skills</span>
                            </div>
                        </div>

                        @if($profile && ($profile->social_linkedin || $profile->social_github || $profile->social_twitter || $profile->social_instagram || $profile->social_facebook))
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

        <!-- ─── ABOUT ─── -->
        @if($profile && ($profile->about_title || $profile->about_short || $profile->about_long))
            <div class="section section alt fade-in-section" id="about">
                <h2 class="section-title">{{ $profile->about_title ?? 'About Me' }}</h2>
                <p class="section-sub">A quick snapshot of who I am, how I work, and what I love building.</p>
                <div class="about-text">
                    @if($profile->about_short)
                        <p>{{ $profile->about_short }}</p>
                    @endif
                    @if($profile->about_long)
                        <p style="margin-top: 18px;">{{ $profile->about_long }}</p>
                    @endif
                </div>
            </div>
        @endif

        <!-- ─── EXPERIENCE ─── -->
        @if($experiences->count())
            <div class="section fade-in-section" id="experience">
                <h2 class="section-title">💼 Experience</h2>
                <p class="section-sub">Where I've been investing my time professionally.</p>
                <div class="card">
                    <div class="timeline">
                        @foreach($experiences as $experience)
                            <div class="timeline-item">
                                <div class="timeline-title">{{ $experience->role_title ?? $experience->company }}</div>
                                <div class="timeline-meta">
                                    {{ $experience->company }}
                                    @if($experience->location) • {{ $experience->location }} @endif
                                    @if($experience->employment_type) • {{ $experience->employment_type }} @endif
                                </div>
                                <div class="timeline-dates">
                                    {{ optional($experience->start_date)->format('M Y') ?? '—' }} –
                                    {{ $experience->is_current ? 'Present' : (optional($experience->end_date)->format('M Y') ?? '—') }}
                                </div>
                                @if($experience->description)
                                    <div class="timeline-body">{{ $experience->description }}</div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <!-- ─── EDUCATION ─── -->
        @if($educations->count())
            <div class="section fade-in-section" id="education">
                <h2 class="section-title">🎓 Education</h2>
                <p class="section-sub">My academic journey and learning milestones.</p>
                <div class="card">
                    <div class="timeline">
                        @foreach($educations as $education)
                            <div class="timeline-item">
                                <div class="timeline-title">{{ $education->degree ?? $education->institution }}</div>
                                <div class="timeline-meta">
                                    {{ $education->institution }}
                                    @if($education->field_of_study) • {{ $education->field_of_study }} @endif
                                    @if($education->location) • {{ $education->location }} @endif
                                </div>
                                <div class="timeline-dates">
                                    {{ optional($education->start_date)->format('M Y') ?? '—' }} –
                                    {{ $education->is_current ? 'Present' : (optional($education->end_date)->format('M Y') ?? '—') }}
                                </div>
                                @if($education->description)
                                    <div class="timeline-body">{{ $education->description }}</div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <!-- ─── SKILLS & GOALS ─── -->
        <div class="section fade-in-section grid two" id="skills-goals">
            @if($skills->count())
                <div class="card">
                    <div class="section-header" style="margin-bottom: 18px; display:flex; justify-content:space-between; align-items:center;">
                        <p class="section-title" style="font-size:18px; margin:0;">⚡ Skills</p>
                    </div>
                    <div class="skills-container" style="max-width:100%;">
                        @foreach($skills as $skill)
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

            @if($goals->count())
                <div class="card">
                    <div class="section-header" style="margin-bottom: 18px; display:flex; justify-content:space-between; align-items:center;">
                        <p class="section-title" style="font-size:18px; margin:0;">🎯 Goals</p>
                    </div>
                    <div class="timeline">
                        @foreach($goals as $goal)
                            <div class="timeline-item" style="padding-left:0;">
                                <p class="timeline-body" style="margin-top:0;">{{ $goal->goal_text }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

       <!-- ─── CERTIFICATIONS ─── -->
@if($certifications->count())
    <div class="section fade-in-section" id="certifications">
        <h2 class="section-title">📜 Certifications</h2>
        <p class="section-sub">Professional certifications that validate my expertise.</p>
        <div class="card">
            <div style="display: flex; flex-direction: column; gap: 14px;">
                @foreach($certifications as $certification)
                    <div class="certification-item">
                    @if(isset($certification->image) && $certification->image)
                            <img src="{{ asset('storage/' . $certification->image) }}"
                                 alt="{{ $certification->title }}"
                                 class="certification-image">
                        @else
                            <span class="certification-badge">🎓</span>
                        @endif
                        <div class="certification-info">
                            <div class="certification-name">{{ $certification->title }}</div>
                            <div class="certification-issuer">{{ $certification->organization }}</div>
                            @if($certification->issue_date)
                                <div class="certification-date">{{ \Carbon\Carbon::parse($certification->issue_date)->format('M Y') }}</div>
                            @endif
                            @if($certification->description)
                                <p style="color: var(--text-muted); font-size: 13px; margin-top: 4px;">{{ $certification->description }}</p>
                            @endif
                            @if($certification->credential_url)
                                <a href="{{ $certification->credential_url }}" target="_blank" class="project-link" style="font-size:12px;">Verify Credential →</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
        <!-- ─── PROJECTS ─── -->
        @if($projects->count())
            <div class="section fade-in-section" id="projects">
                <h2 class="section-title">🚀 Projects</h2>
                <p class="section-sub">Selected work that reflects how I think about design, code, and impact.</p>
                <div class="projects-container">
                    @foreach($projects as $project)
                        <div class="project-card">
                            @if($project->project_image)
                                <img src="{{ asset('storage/' . $project->project_image) }}" alt="{{ $project->title }}" class="project-image">
                            @else
                                <div style="background: var(--primary-soft); height:210px; display:flex; align-items:center; justify-content:center; color: var(--primary-dark); font-weight: 700; font-size: 48px;">
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

        <!-- ─── SERVICES ─── -->
        @if($services->count())
            <div class="section fade-in-section" id="services">
                <h2 class="section-title">💎 Services</h2>
                <p class="section-sub">What I can help you with.</p>
                <div class="grid-three">
                    @foreach($services as $service)
                        <div class="service-card">
                            @if($service->icon)
                                <div class="service-icon">{{ $service->icon }}</div>
                            @endif
                            <div class="service-title">{{ $service->title }}</div>
                            @if($service->description)
                                <div class="service-description">{{ $service->description }}</div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- ─── ACHIEVEMENTS ─── -->
        @if($achievements->count())
            <div class="section fade-in-section" id="achievements">
                <h2 class="section-title">🏆 Achievements</h2>
                <p class="section-sub">Milestones and recognition I've earned.</p>
                <div class="card">
                    <div style="display: flex; flex-direction: column; gap: 14px;">
                        @foreach($achievements as $achievement)
                            <div class="achievement-item">
                                <div class="achievement-icon">🏆</div>
                                <div class="achievement-content">
                                    <div class="achievement-title">{{ $achievement->title }}</div>
                                    @if($achievement->description)
                                        <div class="achievement-description">{{ $achievement->description }}</div>
                                    @endif
                                    @if($achievement->achievement_date)
                                        <div style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.2em; color: var(--text-muted); margin-top: 4px;">
                                            {{ \Carbon\Carbon::parse($achievement->achievement_date)->format('M Y') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <!-- ─── VOLUNTEER ─── -->
        @if($volunteers->count())
            <div class="section fade-in-section" id="volunteer">
                <h2 class="section-title">❤️ Volunteer Work</h2>
                <p class="section-sub">Giving back to the community.</p>
                <div class="card">
                    <div style="display: flex; flex-direction: column; gap: 14px;">
                        @foreach($volunteers as $item)
                            <div class="volunteer-item">
                                <div class="volunteer-organization">{{ $item->organization ?? $item->organization_name }}</div>
                                <div class="volunteer-role">{{ $item->role }}</div>
                                @if($item->description)
                                    <p style="color: var(--text-muted); font-size: 14px; margin-top: 4px;">{{ $item->description }}</p>
                                @endif
                                <div class="volunteer-date">
                                    @if($item->start_date)
                                        {{ \Carbon\Carbon::parse($item->start_date)->format('M Y') }}
                                    @endif
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
            </div>
        @endif

        <!-- ─── TESTIMONIALS ─── -->
        @if($testimonials->count())
            <div class="section fade-in-section" id="testimonials">
                <h2 class="section-title">💬 Testimonials</h2>
                <p class="section-sub">What people say about working with me.</p>
                <div class="two-col">
                    @foreach($testimonials as $testimonial)
                        <div class="testimonial-card">
                            @if($testimonial->message)
                                <div class="testimonial-text">"{{ $testimonial->message }}"</div>
                            @endif
                            <div>
                                <div class="testimonial-author">{{ $testimonial->name }}</div>
                                @if($testimonial->role)
                                    <div class="testimonial-role">{{ $testimonial->role }} @if($testimonial->company) • {{ $testimonial->company }} @endif</div>
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
        @endif

        <!-- ─── GALLERY ─── -->
        @if($gallery->count())
            <div class="section fade-in-section" id="gallery">
                <h2 class="section-title">📸 Gallery</h2>
                <p class="section-sub">A visual glimpse into my world.</p>
                <div class="grid-gallery">
                    @foreach($gallery as $item)
                        <div class="gallery-item">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title ?? 'Gallery image' }}" loading="lazy">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- ─── CONNECT / FOOTER ─── -->
        <div class="footer" id="contact">
            <div class="section-header" style="max-width:1120px; margin:0 auto 24px; display:flex; justify-content:center;">
                <p class="section-title" style="font-size:24px; color:#e5e7eb;">🤝 Connect</p>
            </div>

            @if($profile && ($profile->contact_email || $profile->contact_phone || $profile->location || $profile->live_link))
                <div class="footer-contact">
                    @if($profile->contact_email)
                        <p>📧 {{ $profile->contact_email }}</p>
                    @endif
                    @if($profile->contact_phone)
                        <p>📱 {{ $profile->contact_phone }}</p>
                    @endif
                    @if($profile->location)
                        <p>📍 {{ $profile->location }}</p>
                    @endif
                    @if($profile->live_link)
                        <p>🌐 <a href="{{ $profile->live_link }}" target="_blank" style="color: var(--primary); text-decoration: none;">{{ $profile->live_link }}</a></p>
                    @endif
                </div>
            @endif

            @if($profile && ($profile->social_facebook || $profile->social_linkedin || $profile->social_github || $profile->social_instagram || $profile->social_twitter))
                <div class="social-links">
                    @if($profile->social_facebook)
                        <a href="{{ $profile->social_facebook }}" target="_blank">Facebook</a>
                    @endif
                    @if($profile->social_linkedin)
                        <a href="{{ $profile->social_linkedin }}" target="_blank">LinkedIn</a>
                    @endif
                    @if($profile->social_github)
                        <a href="{{ $profile->social_github }}" target="_blank">GitHub</a>
                    @endif
                    @if($profile->social_instagram)
                        <a href="{{ $profile->social_instagram }}" target="_blank">Instagram</a>
                    @endif
                    @if($profile->social_twitter)
                        <a href="{{ $profile->social_twitter }}" target="_blank">Twitter</a>
                    @endif
                </div>
            @endif

            <div class="footer-copy">
                &copy; {{ date('Y') }} {{ $user->name }}. All rights reserved.
            </div>
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
                        if (entry.target.id === 'skills-goals' || entry.target.closest('#skills-goals')) {
                            entry.target.querySelectorAll('.skill-level').forEach(bar => {
                                const width = bar.getAttribute('data-skill-width');
                                setTimeout(() => {
                                    bar.style.width = width;
                                }, 200);
                            });
                        }
                    }
                });
            },
            { threshold: 0.2 }
        );

        sections.forEach(section => observer.observe(section));

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
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
