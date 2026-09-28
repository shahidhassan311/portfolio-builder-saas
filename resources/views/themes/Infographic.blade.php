<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @include('themes.partials.seo-meta')
  <title>{{ $user->profile->name ?? 'Portfolio' }} · Glint</title>

  <!-- Google Fonts (inter & space grotesk) -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz@14..32&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet" />

  <!-- Font Awesome 6 (free) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

  <style>
    /* ---------- RESET & BASE ---------- */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background: #050505;
      color: #e0e0e0;
      font-family: 'Inter', sans-serif;
      line-height: 1.6;
      scroll-behavior: smooth;
    }

    a {
      text-decoration: none;
      color: inherit;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 24px;
    }

    /* ---------- GLASSMORPHISM UTILITY ---------- */
    .glass {
      background: rgba(255, 255, 255, 0.03);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border: 1px solid rgba(0, 255, 136, 0.08);
      border-radius: 32px;
      box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.8);
    }

    .glass-card {
      background: rgba(255, 255, 255, 0.02);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      border: 1px solid rgba(0, 255, 136, 0.06);
      border-radius: 24px;
      transition: transform 0.25s ease, box-shadow 0.3s ease;
    }

    .glass-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 30px 50px -20px rgba(0, 255, 136, 0.15);
      border-color: rgba(0, 255, 136, 0.2);
    }

    /* ---------- NEON GREEN ACCENTS ---------- */
    .neon-text {
      color: #00ff88;
    }

    .neon-border {
      border-color: #00ff88;
    }

    .neon-glow {
      box-shadow: 0 0 30px -8px rgba(0, 255, 136, 0.2);
    }

    .btn-neon {
      display: inline-block;
      background: transparent;
      border: 1.5px solid #00ff88;
      color: #00ff88;
      padding: 12px 32px;
      border-radius: 60px;
      font-weight: 600;
      font-size: 0.95rem;
      letter-spacing: 0.3px;
      transition: all 0.25s ease;
      cursor: pointer;
    }

    .btn-neon:hover {
      background: #00ff88;
      color: #050505;
      box-shadow: 0 0 30px rgba(0, 255, 136, 0.25);
    }

    .btn-neon-filled {
      background: #00ff88;
      color: #050505;
      border: 1.5px solid #00ff88;
      padding: 12px 32px;
      border-radius: 60px;
      font-weight: 600;
      font-size: 0.95rem;
      transition: all 0.25s ease;
      cursor: pointer;
    }

    .btn-neon-filled:hover {
      background: transparent;
      color: #00ff88;
      box-shadow: 0 0 30px rgba(0, 255, 136, 0.15);
    }

    /* ---------- STICKY NAV ---------- */
    .navbar {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      padding: 16px 0;
      z-index: 999;
      background: rgba(5, 5, 5, 0.6);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border-bottom: 1px solid rgba(0, 255, 136, 0.05);
      transition: background 0.2s ease;
    }

    .navbar .container {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .logo {
      font-family: 'Space Grotesk', sans-serif;
      font-weight: 700;
      font-size: 1.8rem;
      letter-spacing: -0.5px;
      margin-top:-50px;
    }

    .logo span {
      color: #00ff88;
    }

    .nav-links {
      display: flex;
      gap: 32px;
      list-style: none;
      font-weight: 500;
      font-size: 0.95rem;
    }

    .nav-links a {
      transition: color 0.2s ease;
      position: relative;
    }

    .nav-links a::after {
      content: '';
      position: absolute;
      bottom: -4px;
      left: 0;
      width: 0;
      height: 2px;
      background: #00ff88;
      transition: width 0.25s ease;
    }

    .nav-links a:hover {
      color: #00ff88;
    }

    .nav-links a:hover::after {
      width: 100%;
    }

    .menu-toggle {
      display: none;
      font-size: 1.6rem;
      background: none;
      border: none;
      color: #e0e0e0;
      cursor: pointer;
    }

    /* mobile nav */
    @media (max-width: 768px) {
      .nav-links {
        position: fixed;
        top: 72px;
        left: 0;
        width: 100%;
        flex-direction: column;
        background: rgba(5, 5, 5, 0.95);
        backdrop-filter: blur(20px);
        padding: 32px 24px;
        gap: 20px;
        border-bottom: 1px solid rgba(0, 255, 136, 0.1);
        transform: translateY(-120%);
        transition: transform 0.3s ease;
        text-align: center;
      }

      .nav-links.open {
        transform: translateY(0);
      }

      .menu-toggle {
        display: block;
      }
    }

    /* ---------- HERO ---------- */
    .hero {
      min-height: 100vh;
      display: flex;
      align-items: center;
      padding: 120px 0 80px;
      position: relative;
      overflow: hidden;
      background: #0b0b0b;
      background-image: url("/storage/projects/topography.svg");
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
    }

    .hero .container {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 60px;
      align-items: center;
      position: relative;
      z-index: 2;
    }

    .hero-content h1 {
      font-family: 'Space Grotesk', sans-serif;
      font-size: clamp(2.8rem, 8vw, 5rem);
      font-weight: 700;
      line-height: 1.1;
      letter-spacing: -2px;
    }

    .hero-content h1 .highlight {
      color: #00ff88;
      position: relative;
    }

    .hero-content p {
      font-size: 1.2rem;
      opacity: 0.7;
      max-width: 480px;
      margin: 24px 0 32px;
    }

    .hero-actions {
      display: flex;
      flex-wrap: wrap;
      gap: 16px;
      align-items: center;
    }

    .hero-social {
      display: flex;
      gap: 20px;
      margin-top: 32px;
      font-size: 1.4rem;
    }

    .hero-social a {
      transition: color 0.2s, transform 0.2s;
      color: #aaa;
    }

    .hero-social a:hover {
      color: #00ff88;
      transform: translateY(-3px);
    }

    .hero-image {
      display: flex;
      justify-content: center;
      align-items: flex-end;
      position: relative;
      min-height: 600px;
      margin-top: -150px;
    }

    .hero-image img {
      width: 100%;
      max-width: 500px;
      height: auto;
      object-fit: contain;
      border: none;
      border-radius: 0;
      background: transparent;
      box-shadow: none;
      filter: drop-shadow(0 20px 40px rgba(0,0,0,.35));
    }

    .hero-image::before {
      content: "";
      position: absolute;
      bottom: 30px;
      width: 320px;
      height: 320px;
      background: #00ff88;
      border-radius: 50%;
      filter: blur(120px);
      opacity: .15;
      z-index: -1;
    }

    .hero-shapes {
      position: absolute;
      inset: 0;
      pointer-events: none;
      overflow: hidden;
      z-index: 0;
    }

    .hero-shapes span {
      position: absolute;
      background: rgba(0, 255, 136, 0.03);
      border-radius: 50%;
      animation: floatShape 18s infinite alternate ease-in-out;
    }

    .hero-shapes span:nth-child(1) {
      width: 400px;
      height: 400px;
      top: -10%;
      right: -5%;
      background: radial-gradient(circle, rgba(0,255,136,0.06) 0%, transparent 70%);
    }

    .hero-shapes span:nth-child(2) {
      width: 300px;
      height: 300px;
      bottom: -5%;
      left: -5%;
      background: radial-gradient(circle, rgba(0,255,136,0.04) 0%, transparent 70%);
      animation-duration: 24s;
    }

    @keyframes floatShape {
      0% { transform: translate(0, 0) scale(1); }
      100% { transform: translate(30px, -30px) scale(1.05); }
    }

    @media (max-width: 900px) {
      .hero .container {
        grid-template-columns: 1fr;
        text-align: center;
      }
      .hero-content p {
        margin-left: auto;
        margin-right: auto;
      }
      .hero-actions {
        justify-content: center;
      }
      .hero-social {
        justify-content: center;
      }
      .hero-image img {
        max-width: 280px;
      }
    }

    /* ---------- SECTION TITLES ---------- */
    .section-title {
      font-family: 'Space Grotesk', sans-serif;
      font-size: clamp(2.2rem, 5vw, 3.4rem);
      font-weight: 700;
      letter-spacing: -1px;
      margin-bottom: 12px;
    }

    .section-sub {
      color: #00ff88;
      text-transform: uppercase;
      letter-spacing: 3px;
      font-weight: 500;
      font-size: 0.8rem;
      margin-bottom: 8px;
      display: inline-block;
    }

    .section-header {
      margin-bottom: 56px;
    }

    /* ---------- ABOUT ---------- */
    .about {
      padding: 100px 0;
    }

    .about-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 60px;
      align-items: center;
    }

    .about-text p {
      opacity: 0.75;
      margin-bottom: 20px;
      font-size: 1.05rem;
    }

    .stats-row {
      display: flex;
      gap: 40px;
      margin-top: 32px;
      flex-wrap: wrap;
    }

    .stat-item h3 {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 2.4rem;
      color: #00ff88;
      letter-spacing: -1px;
    }

    .stat-item p {
      opacity: 0.5;
      font-size: 0.9rem;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    @media (max-width: 768px) {
      .about-grid {
        grid-template-columns: 1fr;
      }
    }

    /* ---------- EXPERIENCE ---------- */
    .experience {
      padding: 80px 0;
    }

    .experience-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-end;
      gap: 40px;
      margin-bottom: 60px;
    }

    .experience-header .left h6 {
      font-size: 13px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 4px;
      color: #00ff66;
      margin-bottom: 8px;
    }

    .experience-header .left h2 {
      font-size: 42px;
      font-weight: 800;
      color: #fff;
      line-height: 1.2;
    }

    .experience-header .left h2 span {
      color: #00ff66;
    }

    .experience-header .right {
      max-width: 420px;
    }

    .experience-header .right p {
      font-size: 16px;
      color: rgba(255, 255, 255, 0.8);
      text-align: right;
      line-height: 1.9;
      font-weight: 400;
      letter-spacing: 0.3px;
      margin: 0;
      padding: 4px 0;
      transition: color 0.3s ease;
      border-left: 5px solid #00ff66;
      padding-left: 20px;
    }

    .timeline-grid {
      display: grid;
      grid-template-columns: repeat(4, minmax(220px, 1fr));
      gap: 25px;
    }

    .timeline-item {
      background: rgba(255, 255, 255, .03);
      border: 1px solid rgba(255, 255, 255, .08);
      border-radius: 14px;
      padding: 30px;
      transition: .35s ease;
    }

    .timeline-item:hover {
      transform: translateY(-8px);
      border-color: #00ff66;
      background: rgba(255, 255, 255, .05);
    }

    .timeline-item .year {
      color: #fff;
      font-size: 14px;
      font-weight: 600;
      margin-bottom: 15px;
    }

    .timeline-item h4 {
      color: #00ff66;
      font-size: 24px;
      font-weight: 800;
      margin-bottom: 18px;
      text-transform: uppercase;
    }

    .timeline-item .company {
      color: rgba(255,255,255,0.6);
      font-size: 14px;
      margin-bottom: 12px;
    }

    .timeline-item .desc {
      color: rgba(255, 255, 255, .8);
      font-size: 15px;
      line-height: 1.8;
    }

    @media (max-width: 1200px) {
      .timeline-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 768px) {
      .experience-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 20px;
      }
      .experience-header .right p {
        text-align: left;
        border-left: none;
        padding-left: 0;
      }
      .timeline-grid {
        grid-template-columns: 1fr;
      }
    }

    /* ---------- SKILLS ---------- */
    .skills {
      padding: 80px 0;
    }

    .skills-grid {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
      gap: 40px;
      width: 100%;
      margin: 0 auto;
    }

    .skill-item {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      width: 250px;
      min-width: 250px;
      max-width: 250px;
    }

    .circle-wrapper {
      position: relative;
      width: 140px;
      height: 140px;
      margin-bottom: 20px;
    }

    .circle-wrapper svg {
      width: 140px;
      height: 140px;
      transform: rotate(-90deg);
    }

    .circle-bg {
      fill: none;
      stroke: rgba(255,255,255,0.1);
      stroke-width: 10;
    }

    .circle-progress {
      fill: none;
      stroke: #00ff88;
      stroke-width: 10;
      stroke-linecap: butt;
      stroke-dasharray: 377;
      stroke-dashoffset: var(--offset);
    }

    .percentage {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: #fff;
      font-size: 32px;
      font-weight: 800;
    }

    .percentage span {
      font-size: 18px;
    }

    .skill-name {
      color: #fff;
      font-size: 18px;
      font-weight: 700;
      text-transform: uppercase;
      margin-top: 10px;
    }

    .skill-name small {
      display: block;
      font-size: 12px;
      font-weight: 400;
      color: rgba(255,255,255,0.5);
      text-transform: lowercase;
    }

    @media (max-width: 1200px) {
      .skills-grid {
        gap: 35px;
      }
    }

    @media (max-width: 992px) {
      .skills-grid {
        gap: 30px;
      }
      .circle-wrapper {
        width: 130px;
        height: 130px;
      }
      .percentage {
        font-size: 28px;
      }
      .skill-name {
        font-size: 17px;
      }
    }

    @media (max-width: 576px) {
      .skills-grid {
        gap: 25px;
      }
      .circle-wrapper {
        width: 120px;
        height: 120px;
      }
      .percentage {
        font-size: 24px;
      }
      .skill-name {
        font-size: 16px;
      }
    }

    /* ---------- PROJECTS ---------- */
    .projects {
      padding: 80px 0;
    }

    .projects-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 320px));
      gap: 25px;
      justify-content: center;
    }

    .project-card {
      background: rgba(255,255,255,0.03);
      border: 1px solid rgba(0, 255, 136, 0.15);
      border-radius: 16px;
      overflow: hidden;
      transition: all 0.3s ease;
    }

    .project-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 255, 136, 0.15);
      border-color: #00ff88;
    }

    .project-card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      display: block;
    }

    .project-info {
      padding: 18px;
    }

    .project-info h4 {
      color: #fff;
      font-size: 1.1rem;
      margin-bottom: 8px;
    }

    .project-info p {
      color: #b0b0b0;
      font-size: 0.9rem;
      line-height: 1.5;
      margin-bottom: 15px;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    /* ---------- CERTIFICATIONS ---------- */
    .certifications {
      padding: 80px 0;
      background: rgba(255,255,255,0.01);
    }

    .cert-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 20px;
    }

    .cert-item {
      background: rgba(255,255,255,0.02);
      border: 1px solid rgba(0, 255, 136, 0.08);
      border-radius: 16px;
      padding: 20px;
      display: flex;
      align-items: center;
      gap: 16px;
      transition: all 0.3s ease;
    }

    .cert-item:hover {
      border-color: #00ff88;
      transform: translateY(-4px);
      box-shadow: 0 10px 25px rgba(0, 255, 136, 0.1);
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
    .cert-title { font-weight: 600; font-size: 1rem; color: #fff; }
    .cert-org { font-size: 0.85rem; color: rgba(255,255,255,0.6); }
    .cert-date { font-size: 0.75rem; color: rgba(255,255,255,0.4); margin-top: 2px; }
    .cert-link { font-size: 0.8rem; color: #00ff88; font-weight: 500; }

    /* ---------- SERVICES ---------- */
    .services {
      padding: 80px 0;
    }

    .services-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 24px;
    }

    @media (max-width: 992px) {
      .services-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 576px) {
      .services-grid { grid-template-columns: 1fr; }
    }

    .service-card {
      background: rgba(255,255,255,0.02);
      border: 1px solid rgba(0, 255, 136, 0.08);
      border-radius: 16px;
      padding: 30px 24px;
      text-align: center;
      transition: all 0.3s ease;
    }

    .service-card:hover {
      border-color: #00ff88;
      transform: translateY(-4px);
      box-shadow: 0 10px 25px rgba(0, 255, 136, 0.1);
    }

    .service-icon { font-size: 3rem; margin-bottom: 16px; }
    .service-title { font-weight: 700; font-size: 1.1rem; color: #fff; }
    .service-desc { font-size: 0.9rem; color: rgba(255,255,255,0.6); margin-top: 8px; }

    /* ---------- ACHIEVEMENTS ---------- */
    .achievements {
      padding: 80px 0;
      background: rgba(255,255,255,0.01);
    }

    .achievement-item {
      background: rgba(255,255,255,0.02);
      border: 1px solid rgba(0, 255, 136, 0.08);
      border-radius: 16px;
      padding: 20px 24px;
      display: flex;
      align-items: flex-start;
      gap: 16px;
      transition: all 0.3s ease;
      margin-bottom: 16px;
    }

    .achievement-item:hover {
      border-color: #00ff88;
      transform: translateX(6px);
    }

    .achievement-icon { font-size: 2rem; flex-shrink: 0; }
    .achievement-title { font-weight: 600; color: #fff; }
    .achievement-org { font-size: 0.85rem; color: rgba(255,255,255,0.5); }
    .achievement-desc { font-size: 0.9rem; color: rgba(255,255,255,0.6); margin-top: 4px; }
    .achievement-date { font-size: 0.75rem; color: rgba(255,255,255,0.4); margin-top: 4px; }

    /* ---------- VOLUNTEER ---------- */
    .volunteer {
      padding: 80px 0;
    }

    .volunteer-item {
      background: rgba(255,255,255,0.02);
      border: 1px solid rgba(0, 255, 136, 0.08);
      border-radius: 16px;
      padding: 20px 24px;
      transition: all 0.3s ease;
      margin-bottom: 16px;
    }

    .volunteer-item:hover {
      border-color: #00ff88;
      transform: translateX(6px);
    }

    .volunteer-org { font-weight: 600; color: #fff; font-size: 1.05rem; }
    .volunteer-role { font-size: 0.9rem; color: rgba(255,255,255,0.6); }
    .volunteer-location { font-size: 0.85rem; color: rgba(255,255,255,0.4); }
    .volunteer-date { font-size: 0.75rem; color: rgba(255,255,255,0.4); margin-top: 4px; }

    /* ---------- TESTIMONIALS ---------- */
    .testimonials {
      padding: 80px 0;
      background: rgba(255,255,255,0.01);
    }

    .testimonial-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 24px;
    }

    @media (max-width: 768px) {
      .testimonial-grid { grid-template-columns: 1fr; }
    }

    .testimonial-card {
      background: rgba(255,255,255,0.02);
      border: 1px solid rgba(0, 255, 136, 0.08);
      border-radius: 16px;
      padding: 24px;
      transition: all 0.3s ease;
    }

    .testimonial-card:hover {
      border-color: #00ff88;
      transform: translateY(-4px);
      box-shadow: 0 10px 25px rgba(0, 255, 136, 0.1);
    }

    .testimonial-text {
      font-style: italic;
      font-size: 0.95rem;
      color: rgba(255,255,255,0.7);
      line-height: 1.7;
      margin-bottom: 16px;
    }
    .testimonial-author { font-weight: 600; color: #fff; }
    .testimonial-role { font-size: 0.85rem; color: rgba(255,255,255,0.5); }
    .testimonial-rating { color: #fbbf24; font-size: 1.1rem; margin-top: 8px; }

    /* ---------- GALLERY ---------- */
    .gallery {
      padding: 80px 0;
    }

    .gallery-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
      gap: 16px;
    }

    .gallery-item {
      border-radius: 16px;
      overflow: hidden;
      border: 1px solid rgba(0, 255, 136, 0.08);
      aspect-ratio: 1;
      transition: all 0.3s ease;
    }

    .gallery-item:hover {
      transform: scale(1.04);
      border-color: #00ff88;
      box-shadow: 0 10px 25px rgba(0, 255, 136, 0.1);
    }

    .gallery-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    /* ---------- GOALS ---------- */
    .goals {
      padding: 80px 0;
      background: rgba(255,255,255,0.01);
    }

    .goals-list {
      list-style: none;
      display: grid;
      gap: 16px;
      max-width: 800px;
      margin: 0 auto;
    }

    .goal-item {
      background: rgba(255,255,255,0.02);
      border: 1px solid rgba(0, 255, 136, 0.08);
      border-radius: 16px;
      padding: 18px 24px;
      display: flex;
      align-items: center;
      gap: 16px;
      transition: all 0.3s ease;
    }

    .goal-item:hover {
      border-color: #00ff88;
      transform: translateX(6px);
    }

    .goal-item::before {
      content: "◆";
      color: #00ff88;
      font-size: 12px;
    }

    .goal-item span {
      color: rgba(255,255,255,0.7);
      font-size: 1rem;
    }

    /* ---------- CONTACT ---------- */
    .contact {
      padding: 100px 0;
    }

    .contact-card {
      padding: 48px 40px;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 40px;
      background: rgba(255,255,255,0.02);
      border-radius: 40px;
      border: 1px solid rgba(0,255,136,0.06);
    }

    .contact-info h4 {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 1.6rem;
      margin-bottom: 16px;
    }

    .contact-info p {
      opacity: 0.7;
      margin: 6px 0;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .contact-info i {
      color: #00ff88;
      width: 24px;
    }

    .contact-social {
      display: flex;
      gap: 20px;
      margin-top: 24px;
      font-size: 1.4rem;
    }

    .contact-social a {
      transition: color 0.2s;
    }
    .contact-social a:hover {
      color: #00ff88;
    }

    .contact-form input,
    .contact-form textarea {
      width: 100%;
      padding: 14px 18px;
      background: rgba(255,255,255,0.03);
      border: 1px solid rgba(255,255,255,0.06);
      border-radius: 16px;
      color: #e0e0e0;
      font-size: 0.95rem;
      margin-bottom: 16px;
      transition: border 0.2s;
    }

    .contact-form input:focus,
    .contact-form textarea:focus {
      outline: none;
      border-color: #00ff88;
    }

    .contact-form textarea {
      min-height: 130px;
    }

    @media (max-width: 768px) {
      .contact-card {
        grid-template-columns: 1fr;
        padding: 32px 24px;
      }
    }

    /* ---------- FOOTER ---------- */
    .footer {
      padding: 40px 0 24px;
      border-top: 1px solid rgba(255,255,255,0.04);
      text-align: center;
    }

    .footer .social {
      display: flex;
      justify-content: center;
      gap: 24px;
      font-size: 1.3rem;
      margin-bottom: 16px;
    }

    .footer .social a:hover {
      color: #00ff88;
    }

    .footer p {
      opacity: 0.4;
      font-size: 0.9rem;
    }

    /* ---------- UTILITIES ---------- */
    .section-padding {
      padding: 80px 0;
    }
    .bg-dark {
      background: #070707;
    }
    .text-center {
      text-align: center;
    }
    .mb-2 {
      margin-bottom: 12px;
    }
    .gap-2 {
      gap: 12px;
    }

    /* ---------- EMPTY STATE ---------- */
    .empty-state {
      text-align: center;
      color: rgba(255,255,255,0.4);
      padding: 2rem;
      border: 1px dashed rgba(0, 255, 136, 0.15);
      border-radius: 16px;
    }

    /* ---------- HERO CONTENT ANIMATION ---------- */
    .hero-content h1,
    .hero-content p,
    .hero-content .hero-actions {
        opacity: 0;
        transform: translateY(-70px);
        animation: heroLoop 6s infinite;
    }

    .hero-content p { animation-delay: .15s; }
    .hero-content .hero-actions { animation-delay: .3s; }

    @keyframes heroLoop {
        0% { opacity:0; transform:translateY(-70px); }
        10% { opacity:1; transform:translateY(0); }
        75% { opacity:1; transform:translateY(0); }
        88% { opacity:0; transform:translateY(-40px); }
        100% { opacity:0; transform:translateY(-70px); }
    }

    .hero-social a {
        display: inline-block;
        opacity: 0;
        transform: translateY(-25px);
        animation: iconLoop 6s infinite;
    }

    .hero-social a:nth-child(1){ animation-delay:.45s; }
    .hero-social a:nth-child(2){ animation-delay:.55s; }
    .hero-social a:nth-child(3){ animation-delay:.65s; }
    .hero-social a:nth-child(4){ animation-delay:.75s; }
    .hero-social a:nth-child(5){ animation-delay:.85s; }

    @keyframes iconLoop {
        0%,8% { opacity:0; transform:translateY(-25px); }
        15%,75% { opacity:1; transform:translateY(0); }
        88%,100% { opacity:0; transform:translateY(-25px); }
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

  <!-- ========== STICKY NAV ========== -->
  <nav class="navbar" id="navbar">
    <div class="container">
      <!-- <div class="logo">
        <span>✦</span> {{ $profile->name ?? 'Glint' }}
      </div> -->
      <ul class="nav-links" id="navLinks">
        <li><a href="#about">About</a></li>
        @if($hasExp)<li><a href="#experience">Experience</a></li>@endif
        @if($hasSkills)<li><a href="#skills">Skills</a></li>@endif
        @if($hasCerts)<li><a href="#certifications">Certifications</a></li>@endif
        @if($hasProjects)<li><a href="#projects">Projects</a></li>@endif
        @if($hasServices)<li><a href="#services">Services</a></li>@endif
        @if($hasAchievements)<li><a href="#achievements">Achievements</a></li>@endif
        @if($hasVolunteers)<li><a href="#volunteer">Volunteer</a></li>@endif
        @if($hasTestimonials)<li><a href="#testimonials">Testimonials</a></li>@endif
        @if($hasGallery)<li><a href="#gallery">Gallery</a></li>@endif
        @if($hasGoals)<li><a href="#goals">Goals</a></li>@endif
        <li><a href="#contact">Contact</a></li>
      </ul>
      <button class="menu-toggle" id="menuToggle" aria-label="menu">
        <i class="fas fa-bars"></i>
      </button>
    </div>
  </nav>

  <!-- ========== HERO ========== -->
  <section class="hero" id="hero">
    <div class="hero-shapes">
      <span></span>
      <span></span>
    </div>
    <div class="container">
      <div class="hero-content">
        <h1>
          Hi, I'm <br />
          <span class="highlight">{{ $profile->name ?? 'Developer' }}</span>
        </h1>
        <p>{{ $profile->tagline ?? 'Crafting digital experiences with code & creativity.' }}</p>
        <div class="hero-actions">
          <a href="#projects" class="btn-neon-filled"><i class="fas fa-rocket" style="margin-right:8px;"></i>View Work</a>
          <a href="#contact" class="btn-neon">Let's Talk</a>
          <a href="{{ route('portfolio.pdf', ['id' => $user->id, 'username' => $user->username]) }}" class="btn-neon" target="_blank"><i class="fas fa-file-pdf" style="margin-right:8px;"></i>Download CV</a>
        </div>
        <div class="hero-social">
          @if($profile->social_facebook)
            <a href="{{ $profile->social_facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
          @endif
          @if($profile->social_linkedin)
            <a href="{{ $profile->social_linkedin }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
          @endif
          @if($profile->social_github)
            <a href="{{ $profile->social_github }}" target="_blank"><i class="fab fa-github"></i></a>
          @endif
          @if($profile->social_instagram)
            <a href="{{ $profile->social_instagram }}" target="_blank"><i class="fab fa-instagram"></i></a>
          @endif
          @if($profile->social_twitter)
            <a href="{{ $profile->social_twitter }}" target="_blank"><i class="fab fa-x-twitter"></i></a>
          @endif
        </div>
      </div>
      <div class="hero-image">
        @if($profile->profile_image)
          <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="{{ $profile->name }}" />
        @else
          <img src="https://ui-avatars.com/api/?name={{ urlencode($profile->name ?? 'User') }}&background=00ff88&color=050505&size=380" alt="avatar" />
        @endif
      </div>
    </div>
  </section>

  <!-- ========== ABOUT ========== -->
  @if($hasAbout)
  <section class="about" id="about">
    <div class="container">
      <div class="section-header">
        <span class="section-sub">About</span>
        <h2 class="section-title">Know Me <span style="color:#00ff88;"> Better</span></h2>
      </div>
      <div class="about-grid">
        <div class="about-text">
          <p>{{ $profile->about_short ?? 'I\'m a passionate developer with a knack for building clean, modern interfaces.' }}</p>
          <p>{{ $profile->about_long ?? 'With years of experience in full-stack development, I specialize in creating digital products that are both functional and visually stunning. I believe in writing code that is maintainable, scalable, and user-centric.' }}</p>
          <div class="stats-row">
            <div class="stat-item">
              <h3>{{ $projects->count() }}</h3>
              <p>Projects</p>
            </div>
            <div class="stat-item">
              <h3>{{ $experiences->count() }}</h3>
              <p>Experience</p>
            </div>
            <div class="stat-item">
              <h3>{{ $skills->count() }}</h3>
              <p>Skills</p>
            </div>
          </div>
        </div>
        <div class="glass" style="padding: 32px; min-height: 200px; display:flex; align-items:center; justify-content:center;">
          <p style="opacity:0.5; font-size:1.1rem;"><i class="fas fa-quote-left" style="color:#00ff88; margin-right:8px;"></i> {{ $profile->quote ?? 'Design is not just what it looks like, it\'s how it works.' }}</p>
        </div>
      </div>
    </div>
  </section>
  @endif

  <!-- ========== EXPERIENCE ========== -->
  @if($hasExp)
  <section class="experience" id="experience">
    <div class="container">
      <div class="experience-header">
        <div class="left">
          <h6>MY EXPERIENCE</h6>
          <h2>EXPERIENCE AND <span>SKILL</span></h2>
        </div>
        <div class="right">
          <p>Sint ratione reprehenderit, error qui enim sit ex provident</p>
        </div>
      </div>

      <div class="timeline-grid">
        @foreach($experiences->sortByDesc('start_date') as $exp)
          <div class="timeline-item">
            <div class="year">
              {{ \Carbon\Carbon::parse($exp->start_date)->format('Y') }} -
              {{ $exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->format('Y') : 'Present' }}
            </div>
            <h4>{{ $exp->role_title ?? $exp->title ?? 'UI DESIGNER' }}</h4>
            <div class="company">{{ $exp->company ?? 'Company Name' }}</div>
            <p class="desc">{{ $exp->description ?? 'All you need to do your best' }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  <!-- ========== SKILLS ========== -->
  @if($hasSkills)
  <section class="skills" id="skills">
    <div class="container">
      <div class="section-header">
        <span class="section-sub">Expertise</span>
        <h2 class="section-title">My <span style="color:#00ff88;">Skills</span></h2>
      </div>

      <div class="skills-grid">
        @foreach($skills as $skill)
          @php
            $percent = 70;
            if(isset($skill->level)) {
              if(strtolower($skill->level) == 'expert') $percent = 95;
              elseif(strtolower($skill->level) == 'intermediate') $percent = 75;
              elseif(strtolower($skill->level) == 'beginner') $percent = 50;
              else $percent = 70;
            }
            $offset = 314.159 - ($percent / 100) * 314.159;
          @endphp
          <div class="skill-item">
            <div class="circle-wrapper">
              <svg viewBox="0 0 120 120">
                <circle class="circle-bg" cx="60" cy="60" r="50" />
                <circle class="circle-progress" cx="60" cy="60" r="50" style="--offset: {{ $offset }};" />
              </svg>
              <div class="percentage">{{ $percent }}%</div>
            </div>
            <div class="skill-name">
              {{ $skill->name ?? 'BRANDING DESIGN' }}
              <small>{{ strtoupper($skill->level ?? '') }}</small>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  <!-- ========== CERTIFICATIONS ========== -->
  @if($hasCerts)
  <section class="certifications" id="certifications">
    <div class="container">
      <div class="section-header">
        <span class="section-sub">Credentials</span>
        <h2 class="section-title">Certifications</h2>
      </div>

      <div class="cert-grid">
        @foreach($certifications as $cert)
          <div class="cert-item">
            @if($cert->image)
              <img src="{{ asset('storage/' . $cert->image) }}" alt="{{ $cert->title }}" class="cert-image">
            @else
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

  <!-- ========== SERVICES ========== -->
  @if($hasServices)
  <section class="services" id="services">
    <div class="container">
      <div class="section-header">
        <span class="section-sub">Offerings</span>
        <h2 class="section-title"> Services</h2>
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

  <!-- ========== PROJECTS ========== -->
  @if($hasProjects)
  <section class="projects" id="projects">
    <div class="container">
      <div class="section-header">
        <span class="section-sub">Projects</span>
        <h2 class="section-title">Recent Work</h2>
      </div>

      <div class="projects-grid">
        @foreach($projects as $project)
          <div class="project-card">
            @if(!empty($project->project_image))
              <img src="{{ asset('storage/' . $project->project_image) }}" alt="{{ $project->title }}">
            @else
              <img src="https://placehold.co/600x400/111111/00ff88?text={{ urlencode($project->title) }}" alt="{{ $project->title }}">
            @endif
            <div class="project-info">
              <h4>{{ $project->title }}</h4>
              <p>{{ $project->short_description }}</p>
              @if(!empty($project->project_url))
                <a href="{{ $project->project_url }}" target="_blank" class="btn-neon">
                  <i class="fas fa-external-link-alt"></i> Live Preview
                </a>
              @endif
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  <!-- ========== ACHIEVEMENTS ========== -->
  @if($hasAchievements)
  <section class="achievements" id="achievements">
    <div class="container">
      <div class="section-header">
        <span class="section-sub">Recognition</span>
        <h2 class="section-title"> Achievements</h2>
      </div>

      @foreach($achievements as $achievement)
        <div class="achievement-item">
          <div class="achievement-icon"></div>
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

  <!-- ========== VOLUNTEER ========== -->
  @if($hasVolunteers)
  <section class="volunteer" id="volunteer">
    <div class="container">
      <div class="section-header">
        <span class="section-sub">Community</span>
        <h2 class="section-title"> Volunteer Work</h2>
      </div>

      @foreach($volunteers as $item)
        <div class="volunteer-item">
          <div class="volunteer-org">{{ $item->organization_name }}</div>
          <div class="volunteer-role">{{ $item->role }}</div>
          @if($item->location)
            <div class="volunteer-location"> {{ $item->location }}</div>
          @endif
          @if($item->description)
            <div style="color: rgba(255,255,255,0.6); font-size: 0.9rem; margin-top: 4px;">{{ $item->description }}</div>
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

  <!-- ========== TESTIMONIALS ========== -->
  @if($hasTestimonials)
  <section class="testimonials" id="testimonials">
    <div class="container">
      <div class="section-header">
        <span class="section-sub">Feedback</span>
        <h2 class="section-title"> Testimonials</h2>
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

  <!-- ========== GALLERY ========== -->
  @if($hasGallery)
  <section class="gallery" id="gallery">
    <div class="container">
      <div class="section-header">
        <span class="section-sub">Visuals</span>
        <h2 class="section-title">Gallery</h2>
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


  <!-- ========== CONTACT ========== -->
  <section class="contact bg-dark" id="contact">
    <div class="container">
      <div class="section-header">
        <span class="section-sub">Contact</span>
        <h2 class="section-title">Let's Connect</h2>
      </div>
      <div class="contact-card glass">
        <div class="contact-info">
          <h4>Get in touch</h4>
          @if($profile->contact_email)
            <p><i class="fas fa-envelope"></i> {{ $profile->contact_email }}</p>
          @endif
          @if($profile->contact_phone)
            <p><i class="fas fa-phone"></i> {{ $profile->contact_phone }}</p>
          @endif
          @if($profile->location)
            <p><i class="fas fa-map-marker-alt"></i> {{ $profile->location }}</p>
          @endif
          <div class="contact-social">
            @if($profile->social_facebook)
              <a href="{{ $profile->social_facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
            @endif
            @if($profile->social_linkedin)
              <a href="{{ $profile->social_linkedin }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
            @endif
            @if($profile->social_github)
              <a href="{{ $profile->social_github }}" target="_blank"><i class="fab fa-github"></i></a>
            @endif
            @if($profile->social_instagram)
              <a href="{{ $profile->social_instagram }}" target="_blank"><i class="fab fa-instagram"></i></a>
            @endif
            @if($profile->social_twitter)
              <a href="{{ $profile->social_twitter }}" target="_blank"><i class="fab fa-x-twitter"></i></a>
            @endif
          </div>
        </div>
        <form class="contact-form" action="{{ route('contact.submit') }}" method="POST">
          @csrf
          <input type="text" name="name" placeholder="Your Name" required />
          <input type="email" name="email" placeholder="Your Email" required />
          <textarea name="message" placeholder="Your Message" required></textarea>
          <button type="submit" class="btn-neon-filled" style="width:100%;"><i class="fas fa-paper-plane"></i> Send Message</button>
        </form>
      </div>
    </div>
  </section>

  <!-- ========== FOOTER ========== -->
  <footer class="footer">
    <div class="container">
      <div class="social">
        @if($profile->social_facebook)
          <a href="{{ $profile->social_facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
        @endif
        @if($profile->social_linkedin)
          <a href="{{ $profile->social_linkedin }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
        @endif
        @if($profile->social_github)
          <a href="{{ $profile->social_github }}" target="_blank"><i class="fab fa-github"></i></a>
        @endif
        @if($profile->social_instagram)
          <a href="{{ $profile->social_instagram }}" target="_blank"><i class="fab fa-instagram"></i></a>
        @endif
        @if($profile->social_twitter)
          <a href="{{ $profile->social_twitter }}" target="_blank"><i class="fab fa-x-twitter"></i></a>
        @endif
      </div>
      <p>&copy; {{ date('Y') }} {{ $profile->name ?? 'Portfolio' }}. All rights reserved.</p>
    </div>
  </footer>

  <!-- ========== JAVASCRIPT ========== -->
  <script>
    (function() {
      // Mobile menu toggle
      const toggle = document.getElementById('menuToggle');
      const navLinks = document.getElementById('navLinks');
      if (toggle && navLinks) {
        toggle.addEventListener('click', function(e) {
          e.stopPropagation();
          navLinks.classList.toggle('open');
        });
        navLinks.querySelectorAll('a').forEach(link => {
          link.addEventListener('click', () => {
            navLinks.classList.remove('open');
          });
        });
        document.addEventListener('click', function(event) {
          if (!navLinks.contains(event.target) && !toggle.contains(event.target)) {
            navLinks.classList.remove('open');
          }
        });
      }

      // Smooth scroll for anchor links (offset fixed nav)
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
          const target = document.querySelector(this.getAttribute('href'));
          if (target) {
            e.preventDefault();
            const offset = 80;
            const top = target.getBoundingClientRect().top + window.scrollY - offset;
            window.scrollTo({ top, behavior: 'smooth' });
          }
        });
      });

      // Navbar background on scroll
      const navbar = document.getElementById('navbar');
      window.addEventListener('scroll', function() {
        if (window.scrollY > 40) {
          navbar.style.background = 'rgba(5,5,5,0.85)';
        } else {
          navbar.style.background = 'rgba(5,5,5,0.6)';
        }
      });
    })();
  </script>
</body>
</html>
