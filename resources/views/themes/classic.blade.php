<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $user->name }} | Classic Theme</title>
    <link rel="icon" type="image/png" href="resumizo-logo-white.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --carbon: #0b132b;
            --charcoal: #1c2541;
            --iris: #5bc0be;
            --blush: #f08a5d;
            --sand: #f9f7f7;
            --soft: rgba(249, 247, 247, 0.7);
            --border: rgba(255, 255, 255, 0.08);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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
            border-radius: 32px;
            backdrop-filter: blur(18px);
            box-shadow: 0 40px 80px rgba(0, 0, 0, 0.35);
        }

        .hero {
            @supports (backdrop-filter: blur(10px)) {
                backdrop-filter: blur(24px);
            }
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
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.45);
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

        .hero-info {
            z-index: 1;
        }

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
        }

        .badge {
            padding: 16px 22px;
            border-radius: 24px;
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, 0.04);
            min-width: 160px;
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

        .section {
            margin-top: 48px;
        }

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

        .grid.two {
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        }

        .card {
            padding: 32px;
            border-radius: 28px;
            border: 1px solid var(--border);
            background: rgba(14, 18, 33, 0.9);
        }

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
        }

        .projects-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
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
            border-radius: 24px;
            border: 1px solid var(--border);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            background: rgba(0, 0, 0, 0.35);
        }

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

        .project-title {
            font-size: 18px;
        }

        .project-link {
            margin-top: auto;
            color: var(--iris);
            text-decoration: none;
            letter-spacing: 0.2em;
        }

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

        .contact-grid span {
            font-size: 18px;
        }

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
        }

        .empty {
            color: rgba(249, 247, 247, 0.45);
            font-size: 15px;
        }

        @media (max-width: 768px) {
            body {
                padding: 28px 16px 72px;
            }

            .hero {
                padding: 36px;
            }

            .hero-actions {
                flex-direction: column;
            }

            .hero-avatar {
                margin-inline: auto;
            }

            .badge-grid {
                flex-direction: column;
            }
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
    $primaryContact = $profile?->contact_email
        ? 'mailto:' . $profile->contact_email
        : ($profile?->contact_phone ? 'tel:' . $profile->contact_phone : null);
@endphp

<main class="page">
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
            </div>
            <div class="badge-grid section">
                <div class="badge">
                    <strong>{{ $experiences->count() ?: '0' }}+</strong>
                    <span>Experience</span>
                </div>
                <div class="badge">
                    <strong>{{ $projects->count() ?: '0' }}+</strong>
                    <span>Projects</span>
                </div>
                <div class="badge">
                    <strong>{{ $skills->count() ?: '0' }}</strong>
                    <span>Skills</span>
                </div>
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
            <div class="card">
                <div class="contact-grid">
                    @if($profile && $profile->contact_email)
                        <div>
                            <strong>Email</strong>
                            <span>{{ $profile->contact_email }}</span>
                        </div>
                    @endif
                    @if($profile && $profile->contact_phone)
                        <div>
                            <strong>Phone</strong>
                            <span>{{ $profile->contact_phone }}</span>
                        </div>
                    @endif
                    @if($profile && $profile->location)
                        <div>
                            <strong>Location</strong>
                            <span>{{ $profile->location }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <p class="section-title">Experience</p>
        </div>
        <div class="card">
            <div class="timeline">
                @forelse($experiences as $experience)
                    <article class="timeline-item">
                        <h3 class="timeline-title">{{ $experience->role_title ?? $experience->company }}</h3>
                        <p class="timeline-meta">
                            {{ $experience->company }}
                            @if($experience->location)
                                � {{ $experience->location }}
                            @endif
                        </p>
                        <p class="timeline-date">
                            {{ optional($experience->start_date)->format('M Y') ?? '�' }} �
                            {{ $experience->is_current ? 'Present' : (optional($experience->end_date)->format('M Y') ?? '�') }}
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

    <section class="section">
        <div class="section-header">
            <p class="section-title">Education</p>
        </div>
        <div class="card">
            <div class="timeline">
                @forelse($educations as $education)
                    <article class="timeline-item">
                        <h3 class="timeline-title">{{ $education->degree ?? $education->institution }}</h3>
                        <p class="timeline-meta">
                            {{ $education->institution }}
                            @if($education->field_of_study)
                                � {{ $education->field_of_study }}
                            @endif
                        </p>
                        <p class="timeline-date">
                            {{ optional($education->start_date)->format('M Y') ?? '�' }} �
                            {{ $education->is_current ? 'Present' : (optional($education->end_date)->format('M Y') ?? '�') }}
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

    <section class="section grid two">
        @if($skills->count())
            <div class="card">
                <div class="section-header" style="margin-bottom: 18px;">
                    <p class="section-title" style="letter-spacing: 0.25em;">Skills</p>
                </div>
                <div class="chips">
                    @foreach($skills as $skill)
                        <span class="chip">
                            {{ $skill->name }}
                            @if($skill->level)
                                � {{ $skill->level }}
                            @endif
                        </span>
                    @endforeach
                </div>
            </div>
        @endif

        @if($goals->count())
            <div class="card">
                <div class="section-header" style="margin-bottom: 18px;">
                    <p class="section-title" style="letter-spacing: 0.25em;">Focus</p>
                </div>
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

    @if($projects->count())
        <section class="section">
            <div class="section-header">
                <p class="section-title">Selected Work</p>
            </div>
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
                                <a href="{{ $project->project_url }}" class="project-link" target="_blank">Visit project ?</a>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif

    <section class="section">
        <div class="card">
            <div class="section-header">
                <p class="section-title">Connect</p>
            </div>
            <div class="contact-grid">
                @if(!$profile || (!$profile->contact_email && !$profile->contact_phone && !$profile->location))
                    <p class="empty">Keep your contact profile up to date so people can reach you.</p>
                @endif
                @if($profile && $profile->contact_email)
                    <div>
                        <strong>Email</strong>
                        <span>{{ $profile->contact_email }}</span>
                    </div>
                @endif
                @if($profile && $profile->contact_phone)
                    <div>
                        <strong>Phone</strong>
                        <span>{{ $profile->contact_phone }}</span>
                    </div>
                @endif
                @if($profile && $profile->location)
                    <div>
                        <strong>Location</strong>
                        <span>{{ $profile->location }}</span>
                    </div>
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
