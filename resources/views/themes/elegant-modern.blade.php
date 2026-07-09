<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="{{ asset(config('branding.logo')) }}" />
    @include('themes.partials.seo-meta')
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
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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
            transition: var(--transition);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        section {
            padding: 6rem 0;
        }

        /* ─── NAVIGATION ─── */
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
            transition: var(--transition);
        }

        .nav.scrolled {
            box-shadow: var(--shadow-md);
        }

        .nav-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
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
            flex-shrink: 0;
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
            transition: var(--transition);
            flex-shrink: 0;
        }

        .nav-logo:hover .nav-logo-mark {
            transform: rotate(5deg) scale(1.05);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 1.8rem;
            font-size: 0.9rem;
            font-weight: 500;
            flex-wrap: wrap;
        }

        .nav-link {
            color: var(--gray-700);
            position: relative;
            padding: 0.5rem 0;
            white-space: nowrap;
        }

        .nav-link::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 0;
            height: 3px;
            background: var(--primary-gradient);
            transition: var(--transition);
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
            padding: 0.6rem 1.5rem;
            border-radius: 12px;
            background: var(--primary-gradient);
            color: var(--white);
            font-weight: 600;
            font-size: 0.85rem;
            box-shadow: var(--shadow-lg);
            transition: var(--transition);
            white-space: nowrap;
        }

        .nav-cta:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-xl);
        }

        @media (max-width: 992px) {
            .nav-links {
                gap: 1.2rem;
                font-size: 0.85rem;
            }
        }

        @media (max-width: 768px) {
            .nav-inner {
                flex-direction: column;
                align-items: stretch;
                padding: 0.8rem 1.5rem;
                gap: 0.8rem;
            }

            .nav-links {
                justify-content: center;
                gap: 0.8rem 1rem;
                font-size: 0.8rem;
                padding-top: 0.3rem;
                border-top: 1px solid rgba(102, 126, 234, 0.1);
            }

            .nav-link {
                padding: 0.3rem 0;
            }

            .nav-cta {
                padding: 0.4rem 1rem;
                font-size: 0.8rem;
            }
        }

        @media (max-width: 480px) {
            .nav-links {
                gap: 0.5rem 0.7rem;
                font-size: 0.7rem;
                flex-wrap: wrap;
            }

            .nav-cta {
                padding: 0.3rem 0.8rem;
                font-size: 0.7rem;
            }

            .nav-logo {
                font-size: 1rem;
            }

            .nav-logo-mark {
                width: 36px;
                height: 36px;
                font-size: 1rem;
            }
        }

        /* ─── HERO SECTION ─── */
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

        @media (max-width: 968px) {
            .hero-actions { justify-content: center; }
        }

        .btn-primary {
            padding: 1rem 2rem;
            border-radius: 12px;
            background: var(--primary-gradient);
            color: var(--white);
            font-weight: 600;
            font-size: 1rem;
            box-shadow: var(--shadow-lg);
            transition: var(--transition);
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
            transition: var(--transition);
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

        @media (max-width: 968px) {
            .hero-meta { justify-content: center; }
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
            transition: var(--transition);
        }

        .hero-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 30px 60px rgba(102, 126, 234, 0.3);
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

        /* ─── SECTION HEADER ─── */
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

        /* ─── ABOUT SECTION ─── */
        .about {
            background: var(--white);
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
            transition: var(--transition);
        }

        .stat-item:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
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

        /* ─── EXPERIENCE SECTION ─── */
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
            transition: var(--transition);
        }

        .timeline-item:hover::before {
            transform: scale(1.2);
            box-shadow: var(--shadow-glow);
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

        /* ─── SKILLS SECTION ─── */
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
            transition: var(--transition);
            text-align: center;
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

        /* ─── CERTIFICATIONS ─── */
        .certifications {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }

        .cert-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .cert-item {
            background: var(--white);
            border-radius: 16px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(102, 126, 234, 0.1);
            transition: var(--transition);
        }

        .cert-item:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--purple-primary);
        }

        .cert-icon {
            font-size: 2.5rem;
            flex-shrink: 0;
        }

        .cert-image {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .cert-info { flex: 1; }
        .cert-title { font-weight: 700; font-size: 1rem; }
        .cert-org { font-size: 0.9rem; color: var(--gray-600); }
        .cert-date { font-size: 0.8rem; color: var(--gray-600); }
        .cert-link { font-size: 0.85rem; color: var(--purple-primary); font-weight: 600; }

        /* ─── SERVICES ─── */
        .services {
            background: var(--white);
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        @media (max-width: 1024px) {
            .services-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            .services-grid { grid-template-columns: 1fr; }
        }

        .service-card {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
            padding: 2rem;
            border-radius: 16px;
            border: 1px solid rgba(102, 126, 234, 0.1);
            text-align: center;
            transition: var(--transition);
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            border-color: var(--purple-primary);
        }

        .service-icon { font-size: 3rem; margin-bottom: 1rem; }
        .service-title { font-weight: 700; font-size: 1.2rem; }
        .service-desc { font-size: 0.95rem; color: var(--gray-600); margin-top: 0.5rem; }

        /* ─── ACHIEVEMENTS ─── */
        .achievements {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }

        .achievement-item {
            background: var(--white);
            border-radius: 16px;
            padding: 1.5rem;
            display: flex;
            align-items: flex-start;
            gap: 1.2rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(102, 126, 234, 0.1);
            transition: var(--transition);
            margin-bottom: 1rem;
        }

        .achievement-item:hover {
            transform: translateX(6px);
            box-shadow: var(--shadow-md);
            border-color: var(--purple-primary);
        }

        .achievement-icon { font-size: 2.2rem; flex-shrink: 0; }
        .achievement-title { font-weight: 700; font-size: 1.05rem; }
        .achievement-org { font-size: 0.9rem; color: var(--gray-600); }
        .achievement-desc { font-size: 0.95rem; color: var(--gray-700); margin-top: 0.25rem; }
        .achievement-date { font-size: 0.8rem; color: var(--gray-600); }

        /* ─── VOLUNTEER ─── */
        .volunteer {
            background: var(--white);
        }

        .volunteer-item {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
            border-radius: 16px;
            padding: 1.5rem;
            border: 1px solid rgba(102, 126, 234, 0.1);
            transition: var(--transition);
            margin-bottom: 1rem;
        }

        .volunteer-item:hover {
            transform: translateX(6px);
            box-shadow: var(--shadow-md);
            border-color: var(--purple-primary);
        }

        .volunteer-org { font-weight: 700; font-size: 1.1rem; }
        .volunteer-role { font-size: 0.95rem; color: var(--gray-600); }
        .volunteer-location { font-size: 0.9rem; color: var(--gray-600); }
        .volunteer-date { font-size: 0.8rem; color: var(--gray-600); margin-top: 0.25rem; }

        /* ─── TESTIMONIALS ─── */
        .testimonials {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }

        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
        }

        @media (max-width: 768px) {
            .testimonial-grid { grid-template-columns: 1fr; }
        }

        .testimonial-card {
            background: var(--white);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(102, 126, 234, 0.1);
            transition: var(--transition);
        }

        .testimonial-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--purple-primary);
        }

        .testimonial-text {
            font-style: italic;
            font-size: 1rem;
            color: var(--gray-700);
            line-height: 1.8;
            margin-bottom: 1rem;
        }
        .testimonial-author { font-weight: 700; font-size: 1.05rem; }
        .testimonial-role { font-size: 0.9rem; color: var(--gray-600); }
        .testimonial-rating { color: #fbbf24; font-size: 1.2rem; margin-top: 0.5rem; }

        /* ─── GALLERY ─── */
        .gallery {
            background: var(--white);
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 1.2rem;
        }

        .gallery-item {
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(102, 126, 234, 0.1);
            aspect-ratio: 1;
            transition: var(--transition);
        }

        .gallery-item:hover {
            transform: scale(1.05);
            box-shadow: var(--shadow-lg);
            border-color: var(--purple-primary);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* ─── PROJECTS SECTION ─── */
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
            transition: var(--transition);
            border: 1px solid rgba(102, 126, 234, 0.1);
        }

        .project-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
            border-color: var(--purple-primary);
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
            transition: var(--transition);
        }

        .project-link:hover {
            gap: 0.75rem;
            color: var(--purple-dark);
        }

        /* ─── GOALS ─── */
        .goals {
            background: var(--white);
        }

        .goals-list {
            list-style: none;
            display: grid;
            gap: 1rem;
            max-width: 800px;
            margin: 0 auto;
        }

        .goal-item {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
            padding: 1.2rem 1.5rem;
            border-radius: 12px;
            border-left: 4px solid var(--purple-primary);
            font-size: 1rem;
            color: var(--gray-700);
            transition: var(--transition);
        }

        .goal-item:hover {
            transform: translateX(6px);
            box-shadow: var(--shadow-md);
        }

        /* ─── CONTACT SECTION ─── */
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
            transition: var(--transition);
        }

        .contact-card:hover {
            border-color: var(--purple-primary);
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

        .contact-line a {
            color: var(--purple-primary);
        }

        .contact-line a:hover {
            text-decoration: underline;
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
            transition: var(--transition);
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
            transition: var(--transition);
        }

        .contact-form button:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-xl);
        }

        /* ─── FOOTER ─── */
        .footer {
            padding: 3rem 2rem;
            font-size: 0.9rem;
            color: var(--white);
            text-align: center;
            background: var(--dark-gradient);
        }

        .footer-social {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .footer-social a {
            color: rgba(255, 255, 255, 0.7);
            transition: var(--transition);
        }

        .footer-social a:hover {
            color: var(--white);
            transform: translateY(-2px);
        }

        /* ─── SCROLL ANIMATIONS ─── */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ─── EMPTY STATE ─── */
        .empty-state {
            text-align: center;
            color: var(--gray-600);
            padding: 2rem;
            background: rgba(102, 126, 234, 0.05);
            border-radius: 12px;
            border: 2px dashed rgba(102, 126, 234, 0.2);
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
    $hasExp      = $experiences->count() > 0;
    $hasEdu      = $educations->count() > 0;
    $hasContact  = $profile->contact_email || $profile->location || $profile->contact_phone;
    $hasSocial   = $profile->social_facebook || $profile->social_linkedin || $profile->social_github
                   || $profile->social_instagram || $profile->social_twitter;

    // ─── STATS ───
    $stats = [
        ['number' => $projects->count(), 'label' => 'Projects'],
        ['number' => $skills->count(), 'label' => 'Skills'],
        ['number' => $experiences->count(), 'label' => 'Experiences'],
        ['number' => $educations->count(), 'label' => 'Education'],
    ];
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
            @if($hasCerts)<a href="#certifications" class="nav-link">Certifications</a>@endif
            @if($hasProjects)<a href="#projects" class="nav-link">Projects</a>@endif
            @if($hasServices)<a href="#services" class="nav-link">Services</a>@endif
            @if($hasAchievements)<a href="#achievements" class="nav-link">Achievements</a>@endif
            @if($hasVolunteers)<a href="#volunteer" class="nav-link">Volunteer</a>@endif
            @if($hasTestimonials)<a href="#testimonials" class="nav-link">Testimonials</a>@endif
            @if($hasGallery)<a href="#gallery" class="nav-link">Gallery</a>@endif
            @if($hasGoals)<a href="#goals" class="nav-link">Goals</a>@endif
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
                    <div class="hero-eyebrow">✨ Welcome to My Portfolio</div>
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

                        @if($hasSocial)
                            <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
                                @if($profile->social_linkedin)
                                    <a href="{{ $profile->social_linkedin }}" target="_blank" style="color: var(--purple-primary); font-size: 1.5rem; transition: var(--transition);" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🔗</a>
                                @endif
                                @if($profile->social_github)
                                    <a href="{{ $profile->social_github }}" target="_blank" style="color: var(--purple-primary); font-size: 1.5rem; transition: var(--transition);" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">💻</a>
                                @endif
                                @if($profile->social_twitter)
                                    <a href="{{ $profile->social_twitter }}" target="_blank" style="color: var(--purple-primary); font-size: 1.5rem; transition: var(--transition);" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">🐦</a>
                                @endif
                                @if($profile->social_instagram)
                                    <a href="{{ $profile->social_instagram }}" target="_blank" style="color: var(--purple-primary); font-size: 1.5rem; transition: var(--transition);" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">📸</a>
                                @endif
                                @if($profile->social_facebook)
                                    <a href="{{ $profile->social_facebook }}" target="_blank" style="color: var(--purple-primary); font-size: 1.5rem; transition: var(--transition);" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">📘</a>
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
                        @foreach($stats as $stat)
                            @if($stat['number'] > 0)
                                <div class="stat-item">
                                    <div class="stat-number">{{ $stat['number'] }}+</div>
                                    <div class="stat-label">{{ $stat['label'] }}</div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- ─── EXPERIENCE & EDUCATION ─── -->
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
                        @foreach($experiences->sortByDesc('start_date') as $exp)
                            <div class="timeline-item">
                                <div class="timeline-header">
                                    <div>
                                        <div class="timeline-title">{{ $exp->role_title ?? $exp->title }}</div>
                                        <div class="timeline-company">{{ $exp->company }}</div>
                                    </div>
                                    <div class="timeline-date">
                                        @if($exp->start_date)
                                            {{ \Carbon\Carbon::parse($exp->start_date)->format('M Y') }}
                                            –
                                            {{ $exp->is_current ? 'Present' : ($exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->format('M Y') : '') }}
                                        @endif
                                    </div>
                                </div>
                                @if($exp->description)
                                    <div class="timeline-description">{{ $exp->description }}</div>
                                @endif
                            </div>
                        @endforeach
                    @endif

                    @if($hasEdu)
                        @foreach($educations->sortByDesc('start_date') as $edu)
                            <div class="timeline-item">
                                <div class="timeline-header">
                                    <div>
                                        <div class="timeline-title">{{ $edu->degree }}</div>
                                        <div class="timeline-company">{{ $edu->institution }}</div>
                                    </div>
                                    <div class="timeline-date">
                                        @if($edu->start_date)
                                            {{ \Carbon\Carbon::parse($edu->start_date)->format('Y') }}
                                            –
                                            {{ $edu->is_current ? 'Present' : ($edu->end_date ? \Carbon\Carbon::parse($edu->end_date)->format('Y') : '') }}
                                        @endif
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

    <!-- ─── SKILLS ─── -->
    @if($hasSkills)
        <section id="skills" class="skills fade-in">
            <div class="container">
                <div class="section-header">
                    <div class="section-eyebrow">What I Do</div>
                    <h2 class="section-title">Skills & Expertise</h2>
                    <p class="section-subtitle">Technologies and tools I work with</p>
                </div>

                <div class="skills-grid">
                    @foreach($skills as $skill)
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

    <!-- ─── CERTIFICATIONS ─── -->
    @if($hasCerts)
        <section id="certifications" class="certifications fade-in">
            <div class="container">
                <div class="section-header">
                    <div class="section-eyebrow">Credentials</div>
                    <h2 class="section-title">📜 Certifications</h2>
                    <p class="section-subtitle">Professional certifications that validate my expertise</p>
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

    <!-- ─── SERVICES ─── -->
    @if($hasServices)
        <section id="services" class="services fade-in">
            <div class="container">
                <div class="section-header">
                    <div class="section-eyebrow">Offerings</div>
                    <h2 class="section-title">💎 Services</h2>
                    <p class="section-subtitle">How I can help bring your ideas to life</p>
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

    <!-- ─── PROJECTS ─── -->
    @if($hasProjects)
        <section id="projects" class="projects fade-in">
            <div class="container">
                <div class="section-header">
                    <div class="section-eyebrow">My Work</div>
                    <h2 class="section-title">Featured Projects</h2>
                    <p class="section-subtitle">A showcase of my best work and achievements</p>
                </div>

                <div class="projects-grid">
                    @foreach($projects as $project)
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

    <!-- ─── ACHIEVEMENTS ─── -->
    @if($hasAchievements)
        <section id="achievements" class="achievements fade-in">
            <div class="container">
                <div class="section-header">
                    <div class="section-eyebrow">Recognition</div>
                    <h2 class="section-title">🏆 Achievements</h2>
                    <p class="section-subtitle">Milestones and recognition I'm proud of</p>
                </div>

                <div style="max-width: 800px; margin: 0 auto;">
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
        <section id="volunteer" class="volunteer fade-in">
            <div class="container">
                <div class="section-header">
                    <div class="section-eyebrow">Community</div>
                    <h2 class="section-title">❤️ Volunteer Work</h2>
                    <p class="section-subtitle">Giving back to the community</p>
                </div>

                <div style="max-width: 800px; margin: 0 auto;">
                    @foreach($volunteers as $item)
                        <div class="volunteer-item">
                            <div class="volunteer-org">{{ $item->organization_name }}</div>
                            <div class="volunteer-role">{{ $item->role }}</div>
                            @if($item->location)
                                <div class="volunteer-location">📍 {{ $item->location }}</div>
                            @endif
                            @if($item->description)
                                <div style="font-size: 0.95rem; color: var(--gray-700); margin-top: 0.5rem;">{{ $item->description }}</div>
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
        <section id="testimonials" class="testimonials fade-in">
            <div class="container">
                <div class="section-header">
                    <div class="section-eyebrow">Feedback</div>
                    <h2 class="section-title">💬 Testimonials</h2>
                    <p class="section-subtitle">What people say about working with me</p>
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
        <section id="gallery" class="gallery fade-in">
            <div class="container">
                <div class="section-header">
                    <div class="section-eyebrow">Visuals</div>
                    <h2 class="section-title">📸 Gallery</h2>
                    <p class="section-subtitle">A glimpse into my creative world</p>
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
    @if($hasGoals)
        <section id="goals" class="goals fade-in">
            <div class="container">
                <div class="section-header">
                    <div class="section-eyebrow">Forward</div>
                    <h2 class="section-title">🎯 Goals</h2>
                    <p class="section-subtitle">What I'm working toward next</p>
                </div>

                <ul class="goals-list">
                    @foreach($goals as $goal)
                        <li class="goal-item">{{ $goal->goal_text }}</li>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif

    <!-- ─── CONTACT ─── -->
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
                                <a href="mailto:{{ $profile->contact_email }}">{{ $profile->contact_email }}</a>
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
                        @if($profile->live_link)
                            <div class="contact-line">
                                <strong>Website:</strong>
                                <a href="{{ $profile->live_link }}" target="_blank">{{ $profile->live_link }}</a>
                            </div>
                        @endif
                        @if($hasSocial)
                            <div style="margin-top: 2rem;">
                                @if($profile->social_linkedin)
                                    <div class="contact-line">
                                        <strong>LinkedIn:</strong>
                                        <a href="{{ $profile->social_linkedin }}" target="_blank">LinkedIn Profile</a>
                                    </div>
                                @endif
                                @if($profile->social_github)
                                    <div class="contact-line">
                                        <strong>GitHub:</strong>
                                        <a href="{{ $profile->social_github }}" target="_blank">GitHub Profile</a>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="contact-form">
                        <h3 style="font-size: 1.8rem; font-weight: 800; margin-bottom: 1.5rem; background: var(--primary-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Send a Message</h3>
                        <form onsubmit="return false;">
                            <input type="text" placeholder="Your Name" required>
                            <input type="email" placeholder="Your Email" required>
                            <textarea placeholder="Your Message" required></textarea>
                            <button type="submit">Send Message →</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @endif
</main>

<!-- ─── FOOTER ─── -->
<footer class="footer">
    <div class="container">
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
        <p>&copy; {{ date('Y') }} {{ $user->name }}. All rights reserved. Built with ❤️</p>
    </div>
</footer>

<script>
    // ─── NAVBAR SCROLL EFFECT ───
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // ─── ACTIVE NAV LINK ON SCROLL ───
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

    // ─── FADE IN ON SCROLL ───
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
