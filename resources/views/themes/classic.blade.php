<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('themes.partials.seo-meta')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        /* ── root & reset ── */
        :root {
            --carbon: #0b132b;
            --charcoal: #1c2541;
            --iris: #5bc0be;
            --blush: #f08a5d;
            --sand: #f9f7f7;
            --soft: rgba(249, 247, 247, 0.7);
            --border: rgba(255, 255, 255, 0.08);
            --radius-card: 28px;
            --radius-sm: 16px;
            --shadow-card: 0 40px 80px rgba(0, 0, 0, 0.35);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Space Grotesk', 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            min-height: 100vh;
            background: radial-gradient(circle at 10% 20%, rgba(91, 192, 190, 0.35), transparent 45%),
                        radial-gradient(circle at 90% 10%, rgba(240, 138, 93, 0.35), transparent 35%),
                        linear-gradient(135deg, #050810 0%, #12192c 60%, #050810 100%);
            color: var(--sand);
            padding: 48px 18px 96px;
        }

        body::before,
        body::after {
            content: "";
            position: fixed;
            inset: 0;
            opacity: 0.6;
            pointer-events: none;
        }
        body::before {
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='160'%3E%3Cpath d='M0 80h160v1H0z' fill='%23ffffff10'/%3E%3Cpath d='M80 0v160h-1V0z' fill='%23ffffff10'/%3E%3C/svg%3E") repeat;
        }
        body::after {
            background: radial-gradient(circle at 30% 10%, rgba(255, 255, 255, 0.08), transparent 45%),
                        radial-gradient(circle at 70% 0%, rgba(255, 255, 255, 0.06), transparent 35%);
            mix-blend-mode: screen;
        }

        .page {
            max-width: 1180px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .glass {
            background: rgba(15, 19, 32, 0.8);
            border: 1px solid var(--border);
            border-radius: var(--radius-card);
            backdrop-filter: blur(18px);
            box-shadow: var(--shadow-card);
        }

        /* ── hero ── */
        .hero {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 48px;
            padding: 56px;
            position: relative;
            overflow: hidden;
        }
        .hero::after {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 20% 20%, rgba(91, 192, 190, 0.15), transparent 50%),
                        radial-gradient(circle at 80% 0%, rgba(240, 138, 93, 0.12), transparent 35%);
            pointer-events: none;
        }

        .hero-avatar {
            width: 220px;
            height: 220px;
            border-radius: 32px;
            overflow: hidden;
            border: 1.5px solid var(--border);
            box-shadow: 0 30px 60px rgba(0,0,0,0.45);
            margin-bottom: 24px;
            position: relative;
        }
        .hero-avatar span,
        .hero-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .hero-avatar span {
            display: grid;
            place-items: center;
            font-size: 86px;
            font-weight: 600;
            color: var(--soft);
            background: linear-gradient(135deg, rgba(91, 192, 190, 0.25), rgba(91, 192, 190, 0));
        }

        .hero-info { z-index: 1; }

        .eyebrow {
            font-size: 13px;
            letter-spacing: 0.4em;
            text-transform: uppercase;
            color: rgba(249, 247, 247, 0.65);
        }
        h1 {
            font-size: clamp(38px, 5vw, 64px);
            margin: 16px 0 12px;
        }
        .role {
            color: var(--iris);
            font-size: 20px;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            font-weight: 600;
        }
        .summary {
            margin: 24px 0;
            color: rgba(249, 247, 247, 0.8);
            line-height: 1.8;
            max-width: 580px;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
        }
        .pill {
            padding: 14px 32px;
            border-radius: 999px;
            border: 1.5px solid rgba(249, 247, 247, 0.5);
            color: var(--sand);
            text-decoration: none;
            font-weight: 600;
            letter-spacing: 0.08em;
            transition: transform 0.3s ease, background 0.3s ease, border-color 0.3s ease;
        }
        .pill.accent {
            background: linear-gradient(120deg, var(--iris), var(--blush));
            border-color: transparent;
            color: #041421;
        }
        .pill:hover {
            transform: translateY(-4px);
            border-color: var(--sand);
        }

        .badge-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 18px;
            margin-top: 24px;
        }
        .badge {
            padding: 16px 22px;
            border-radius: 24px;
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, 0.04);
            min-width: 140px;
        }
        .badge strong {
            display: block;
            font-size: 28px;
            color: var(--sand);
        }
        .badge span {
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.3em;
            color: rgba(249, 247, 247, 0.6);
        }

        /* ── sections ── */
        .section { margin-top: 48px; }
        .section-header {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 28px;
            align-items: center;
        }
        .section-title {
            font-size: 24px;
            letter-spacing: 0.35em;
            text-transform: uppercase;
            color: rgba(249, 247, 247, 0.7);
        }

        .grid {
            display: grid;
            gap: 24px;
        }
        .grid.two { grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); }
        .grid.three { grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); }

        .card {
            padding: 32px;
            border-radius: var(--radius-card);
            border: 1px solid var(--border);
            background: rgba(14, 18, 33, 0.9);
            backdrop-filter: blur(4px);
        }

        /* ── timeline ── */
        .timeline {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .timeline-item {
            padding-left: 36px;
            position: relative;
        }
        .timeline-item::before {
            content: "";
            position: absolute;
            left: 0;
            top: 10px;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--iris), var(--blush));
            box-shadow: 0 0 18px var(--iris);
        }
        .timeline-title {
            font-size: 20px;
            font-weight: 600;
        }
        .timeline-meta {
            color: rgba(249, 247, 247, 0.7);
            margin: 4px 0;
        }
        .timeline-date {
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.4em;
            color: rgba(249, 247, 247, 0.5);
        }
        .timeline-description {
            color: rgba(249, 247, 247, 0.75);
            margin-top: 10px;
            line-height: 1.7;
        }

        /* ── chips ── */
        .chips {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }
        .chip {
            padding: 10px 20px;
            border-radius: 999px;
            border: 1px solid rgba(91, 192, 190, 0.5);
            color: var(--sand);
            background: rgba(91, 192, 190, 0.08);
            font-size: 14px;
            transition: background 0.2s;
        }
        .chip:hover { background: rgba(91, 192, 190, 0.18); }

        /* ── projects ── */
        .projects-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }
        @media (max-width: 1024px) { .projects-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
        @media (max-width: 640px) { .projects-grid { grid-template-columns: minmax(0, 1fr); } }

        .project-card {
            border-radius: 24px;
            border: 1px solid var(--border);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            background: rgba(0,0,0,0.35);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }
        .project-card:hover { transform: translateY(-6px); box-shadow: 0 20px 40px rgba(0,0,0,0.5); }
        .project-card img {
            width: 100%;
            height: 190px;
            object-fit: cover;
        }
        .project-body {
            padding: 24px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            flex: 1;
        }
        .project-title { font-size: 18px; font-weight: 600; }
        .project-link {
            margin-top: auto;
            color: var(--iris);
            text-decoration: none;
            letter-spacing: 0.2em;
            font-weight: 500;
        }
        .project-link:hover { text-decoration: underline; }

        /* ── certification ── */
        .certification-item {
            display: flex;
            align-items: center;
            gap: 18px;
            padding: 16px 20px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, 0.03);
            transition: background 0.2s;
        }
        .certification-item:hover { background: rgba(255, 255, 255, 0.06); }
        .certification-badge {
            font-size: 36px;
            flex-shrink: 0;
        }
        .certification-info { flex: 1; }
        .certification-name { font-weight: 600; font-size: 18px; }
        .certification-issuer {
            color: rgba(249, 247, 247, 0.6);
            font-size: 14px;
        }
        .certification-date {
            color: rgba(249, 247, 247, 0.5);
            font-size: 12px;
            letter-spacing: 0.2em;
            text-transform: uppercase;
        }

        /* ── gallery ── */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 16px;
        }
        .gallery-item {
            border-radius: var(--radius-sm);
            overflow: hidden;
            border: 1px solid var(--border);
            aspect-ratio: 1;
            background: rgba(0,0,0,0.3);
        }
        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .gallery-item img:hover { transform: scale(1.05); }

        /* ── testimonial ── */
        .testimonial-card {
            padding: 28px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border);
            background: rgba(14, 18, 33, 0.6);
            transition: background 0.2s;
        }
        .testimonial-card:hover { background: rgba(14, 18, 33, 0.8); }
        .testimonial-text {
            font-style: italic;
            color: rgba(249, 247, 247, 0.85);
            line-height: 1.6;
            margin-bottom: 16px;
        }
        .testimonial-author { font-weight: 600; color: var(--sand); }
        .testimonial-role {
            font-size: 13px;
            color: rgba(249, 247, 247, 0.6);
        }

        /* ── achievement ── */
        .achievement-item {
            display: flex;
            align-items: flex-start;
            gap: 18px;
            padding: 16px 20px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, 0.03);
            transition: background 0.2s;
        }
        .achievement-item:hover { background: rgba(255, 255, 255, 0.06); }
        .achievement-icon { font-size: 30px; flex-shrink: 0; }
        .achievement-content { flex: 1; }
        .achievement-title { font-weight: 600; font-size: 18px; }
        .achievement-description {
            color: rgba(249, 247, 247, 0.7);
            font-size: 14px;
            margin-top: 4px;
        }

        /* ── volunteer ── */
        .volunteer-item {
            padding: 20px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, 0.03);
            transition: background 0.2s;
        }
        .volunteer-item:hover { background: rgba(255, 255, 255, 0.06); }
        .volunteer-organization { font-weight: 600; font-size: 18px; }
        .volunteer-role {
            color: rgba(249, 247, 247, 0.7);
            font-size: 14px;
        }
        .volunteer-date {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: rgba(249, 247, 247, 0.5);
            margin-top: 8px;
        }

        /* ── service ── */
        .service-card {
            padding: 32px 24px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border);
            background: rgba(14, 18, 33, 0.6);
            text-align: center;
            transition: transform 0.25s ease, background 0.2s;
        }
        .service-card:hover { transform: translateY(-4px); background: rgba(14, 18, 33, 0.8); }
        .service-icon { font-size: 44px; margin-bottom: 16px; }
        .service-title { font-weight: 600; font-size: 18px; margin-bottom: 8px; }
        .service-description {
            color: rgba(249, 247, 247, 0.7);
            font-size: 14px;
            line-height: 1.6;
        }

        /* ── contact / socials ── */
        .contact-grid {
            display: grid;
            gap: 12px;
        }
        .contact-grid strong {
            display: block;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            font-size: 12px;
            color: rgba(249, 247, 247, 0.6);
        }
        .contact-grid span { font-size: 18px; }

        .socials {
            margin-top: 24px;
            display: flex;
            flex-wrap: wrap;
            gap: 18px;
        }
        .socials a {
            color: var(--sand);
            text-decoration: none;
            letter-spacing: 0.25em;
            font-size: 13px;
            border-bottom: 1px solid transparent;
            transition: border-color 0.2s;
        }
        .socials a:hover { border-color: var(--iris); }

        .empty {
            color: rgba(249, 247, 247, 0.45);
            font-size: 15px;
        }

        /* ── responsive ── */
        @media (max-width: 768px) {
            body { padding: 28px 16px 72px; }
            .hero { padding: 36px; }
            .hero-actions { flex-direction: column; }
            .hero-avatar { margin-inline: auto; }
            .badge-grid { flex-direction: column; }
            .gallery-grid { grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); }
        }
    </style>
</head>
<body>
@php
    $profile        = optional($user->profile);
    $experiences    = $user->experiences ?? collect();
    $educations     = $user->educations ?? collect();
    $projects       = $user->projects ?? collect();
    $skills         = $user->skills ?? collect();
    $goals          = $user->goals ?? collect();
    $certifications = $user->certifications ?? collect();
    $gallery        = $user->gallery ?? collect();
    $volunteers     = $user->volunteer ?? collect();       // renamed to avoid conflict with $volunteer variable later
    $achievements   = $user->achievements ?? collect();
    $services       = $user->services ?? collect();
    $testimonials   = $user->testimonials ?? collect();
    $primaryContact = $profile?->contact_email
        ? 'mailto:' . $profile->contact_email
        : ($profile?->contact_phone ? 'tel:' . $profile->contact_phone : null);
@endphp

<main class="page">
    <!-- ─── HERO ─── -->
    <section class="hero glass">
        <div class="hero-info">
            <span class="eyebrow">Classic Renaissance</span>
            <h1>{{ $user->name }}</h1>
            @if($profile && $profile->tagline)
                <p class="role">{{ $profile->tagline }}</p>
            @endif
            @if($profile && ($profile->about_short || $profile->about_long))
                <p class="summary">{{ $profile->about_long ?? $profile->about_short }}</p>
            @endif
            <div class="hero-actions">
                @if($primaryContact)
                    <a href="{{ $primaryContact }}" class="pill">Let's collaborate</a>
                @endif
                <a class="pill accent" target="_blank"
                    href="{{ route('portfolio.pdf', ['id' => $user->id, 'username' => $user->username]) }}">
                    Download PDF
                </a>
                @if($profile && $profile->live_link)
                    <a href="{{ $profile->live_link }}" target="_blank" class="pill">Live Demo</a>
                @endif
            </div>
            <div class="badge-grid">
                <div class="badge"><strong>{{ $experiences->count() ?: 0 }}+</strong><span>Experience</span></div>
                <div class="badge"><strong>{{ $projects->count() ?: 0 }}+</strong><span>Projects</span></div>
                <div class="badge"><strong>{{ $skills->count() ?: 0 }}</strong><span>Skills</span></div>
                @if($certifications->count())
                <div class="badge"><strong>{{ $certifications->count() }}</strong><span>Certifications</span></div>
                @endif
            </div>
        </div>
        <div>
            <div class="hero-avatar">
                @if($profile && $profile->profile_image)
                    <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="{{ $user->name }}" loading="lazy">
                @else
                    <span>{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                @endif
            </div>
            <div class="card" style="padding: 24px;">
                <div class="contact-grid">
                    @if($profile && $profile->contact_email)
                        <div><strong>Email</strong><span>{{ $profile->contact_email }}</span></div>
                    @endif
                    @if($profile && $profile->contact_phone)
                        <div><strong>Phone</strong><span>{{ $profile->contact_phone }}</span></div>
                    @endif
                    @if($profile && $profile->location)
                        <div><strong>Location</strong><span>{{ $profile->location }}</span></div>
                    @endif
                    @if($profile && $profile->live_link)
                        <div><strong>Website</strong><span><a href="{{ $profile->live_link }}" target="_blank" style="color: var(--iris); text-decoration: none;">{{ $profile->live_link }}</a></span></div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- ─── ABOUT (long) ─── -->
    @if($profile && $profile->about_long)
    <section class="section">
        <div class="section-header"><p class="section-title">About</p></div>
        <div class="card">
            <p style="color: rgba(249, 247, 247, 0.8); line-height: 1.8;">{{ $profile->about_long }}</p>
        </div>
    </section>
    @endif

    <!-- ─── EXPERIENCE ─── -->
    <section class="section">
        <div class="section-header"><p class="section-title">Experience</p></div>
        <div class="card">
            <div class="timeline">
                @forelse($experiences as $experience)
                    <article class="timeline-item">
                        <h3 class="timeline-title">{{ $experience->role_title ?? $experience->company }}</h3>
                        <p class="timeline-meta">
                            {{ $experience->company }}
                            @if($experience->location) • {{ $experience->location }} @endif
                            @if($experience->employment_type) • {{ $experience->employment_type }} @endif
                        </p>
                        <p class="timeline-date">
                            {{ optional($experience->start_date)->format('M Y') ?? '—' }} –
                            {{ $experience->is_current ? 'Present' : (optional($experience->end_date)->format('M Y') ?? '—') }}
                        </p>
                        @if($experience->description)
                            <p class="timeline-description">{{ $experience->description }}</p>
                        @endif
                    </article>
                @empty
                    <p class="empty">Your professional journey will shine here once you add experience entries.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ─── EDUCATION ─── -->
    <section class="section">
        <div class="section-header"><p class="section-title">Education</p></div>
        <div class="card">
            <div class="timeline">
                @forelse($educations as $education)
                    <article class="timeline-item">
                        <h3 class="timeline-title">{{ $education->degree ?? $education->institution }}</h3>
                        <p class="timeline-meta">
                            {{ $education->institution }}
                            @if($education->field_of_study) • {{ $education->field_of_study }} @endif
                            @if($education->location) • {{ $education->location }} @endif
                        </p>
                        <p class="timeline-date">
                            {{ optional($education->start_date)->format('M Y') ?? '—' }} –
                            {{ $education->is_current ? 'Present' : (optional($education->end_date)->format('M Y') ?? '—') }}
                        </p>
                        @if($education->description)
                            <p class="timeline-description">{{ $education->description }}</p>
                        @endif
                    </article>
                @empty
                    <p class="empty">Add your learning milestones to prove the depth of your craft.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ─── SKILLS & GOALS ─── -->
    <section class="section grid two">
        @if($skills->count())
            <div class="card">
                <div class="section-header" style="margin-bottom: 18px;"><p class="section-title" style="letter-spacing: 0.25em;">Skills</p></div>
                <div class="chips">
                    @foreach($skills as $skill)
                        <span class="chip">{{ $skill->name }}@if($skill->level) • {{ $skill->level }}@endif</span>
                    @endforeach
                </div>
            </div>
        @endif
        @if($goals->count())
            <div class="card">
                <div class="section-header" style="margin-bottom: 18px;"><p class="section-title" style="letter-spacing: 0.25em;">Focus</p></div>
                <div class="timeline">
                    @foreach($goals as $goal)
                        <div class="timeline-item" style="padding-left: 0;">
                            <p class="timeline-description" style="margin-top: 0;">{{ $goal->goal_text }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </section>

    <!-- ─── CERTIFICATIONS ─── -->
    @if($certifications->count())
    <section class="section">
        <div class="section-header"><p class="section-title">Certifications</p></div>
        <div class="card">
            <div style="display: flex; flex-direction: column; gap: 14px;">
                @foreach($certifications as $certification)
                    <div class="certification-item">
                        @if($certification->image)
                            <img src="{{ asset('storage/' . $certification->image) }}"
                                 alt="{{ $certification->title }}"
                                 style="width:60px;height:60px;border-radius:12px;object-fit:cover;flex-shrink:0;">
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
                                <p class="timeline-description" style="margin-top:8px;">{{ $certification->description }}</p>
                            @endif
                            @if($certification->credential_url)
                                <a href="{{ $certification->credential_url }}" target="_blank" class="project-link" style="font-size:13px;">Verify Credential →</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- ─── PROJECTS ─── -->
    @if($projects->count())
    <section class="section">
        <div class="section-header"><p class="section-title">Selected Work</p></div>
        <div class="projects-grid">
            @foreach($projects as $project)
                <article class="project-card">
                    @if($project->project_image)
                        <img src="{{ asset('storage/' . $project->project_image) }}" alt="{{ $project->title }}" loading="lazy">
                    @endif
                    <div class="project-body">
                        <h3 class="project-title">{{ $project->title }}</h3>
                        @if($project->short_description)
                            <p class="timeline-description">{{ $project->short_description }}</p>
                        @endif
                        @if($project->project_url)
                            <a href="{{ $project->project_url }}" class="project-link" target="_blank">Visit project →</a>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    </section>
    @endif

    <!-- ─── GALLERY ─── -->
    @if($gallery->count())
    <section class="section">
        <div class="section-header"><p class="section-title">Gallery</p></div>
        <div class="gallery-grid">
            @foreach($gallery as $item)
                <div class="gallery-item">
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title ?? 'Gallery image' }}" loading="lazy">
                    @endif
                </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- ─── SERVICES ─── -->
    @if($services->count())
    <section class="section">
        <div class="section-header"><p class="section-title">Services</p></div>
        <div class="grid three">
            @foreach($services as $service)
                <div class="service-card">
                    @if($service->icon) <div class="service-icon">{{ $service->icon }}</div> @endif
                    <div class="service-title">{{ $service->title }}</div>
                    @if($service->description) <div class="service-description">{{ $service->description }}</div> @endif
                </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- ─── ACHIEVEMENTS ─── -->
    @if($achievements->count())
    <section class="section">
        <div class="section-header"><p class="section-title">Achievements</p></div>
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
                                <div style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.2em; color: rgba(249, 247, 247, 0.5); margin-top: 4px;">
                                    {{ \Carbon\Carbon::parse($achievement->achievement_date)->format('M Y') }}
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- ─── VOLUNTEER ─── -->
    @if($volunteers->count())
    <section class="section">
        <div class="section-header"><p class="section-title">Volunteer Work</p></div>
        <div class="card">
            <div style="display: flex; flex-direction: column; gap: 14px;">
                @foreach($volunteers as $item)
                    <div class="volunteer-item">
                        <div class="volunteer-organization">{{ $item->organization_name ?? $item->organization }}</div>
                        <div class="volunteer-role">{{ $item->role }}</div>
                        @if($item->description)
                            <p style="color: rgba(249, 247, 247, 0.7); font-size: 14px; margin-top: 4px;">{{ $item->description }}</p>
                        @endif
                        <div class="volunteer-date">
                            @if($item->start_date) {{ \Carbon\Carbon::parse($item->start_date)->format('M Y') }} @endif
                            @if($item->end_date) – {{ \Carbon\Carbon::parse($item->end_date)->format('M Y') }} @elseif($item->currently_volunteering) – Present @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- ─── TESTIMONIALS ─── -->
    @if($testimonials->count())
    <section class="section">
        <div class="section-header"><p class="section-title">Testimonials</p></div>
        <div class="grid two">
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
                            <div style="margin-top:10px;color:#FFD700;font-size:18px;">
                                @for($i=1;$i<=5;$i++) {!! $i <= $testimonial->rating ? '★' : '☆' !!} @endfor
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- ─── CONNECT ─── -->
    <section class="section">
        <div class="card">
            <div class="section-header"><p class="section-title">Connect</p></div>
            <div class="contact-grid">
                @if(!$profile || (!$profile->contact_email && !$profile->contact_phone && !$profile->location && !$profile->live_link))
                    <p class="empty">Keep your contact profile up to date so people can reach you.</p>
                @endif
                @if($profile && $profile->contact_email)
                    <div><strong>Email</strong><span>{{ $profile->contact_email }}</span></div>
                @endif
                @if($profile && $profile->contact_phone)
                    <div><strong>Phone</strong><span>{{ $profile->contact_phone }}</span></div>
                @endif
                @if($profile && $profile->location)
                    <div><strong>Location</strong><span>{{ $profile->location }}</span></div>
                @endif
                @if($profile && $profile->live_link)
                    <div><strong>Website</strong><span><a href="{{ $profile->live_link }}" target="_blank" style="color: var(--iris); text-decoration: none;">{{ $profile->live_link }}</a></span></div>
                @endif
            </div>
            <div class="socials">
                @foreach ([
                    'social_linkedin' => 'LinkedIn',
                    'social_github' => 'GitHub',
                    'social_twitter' => 'Twitter',
                    'social_instagram' => 'Instagram',
                    'social_facebook' => 'Facebook'
                ] as $network => $label)
                    @if($profile && $profile->$network)
                        <a href="{{ $profile->$network }}" target="_blank">{{ $label }}</a>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
</main>
</body>
</html>
