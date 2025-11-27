<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - Portfolio</title>


    <link rel="icon" type="image/png" href="resumizo-logo-white.png" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif; line-height: 1.6; color: #333; }
        .hero { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 100px 40px; text-align: center; position: relative; }
        .hero-content { max-width: 800px; margin: 0 auto; }
        .hero-avatar { width: 150px; height: 150px; border-radius: 50%; border: 5px solid white; margin: 0 auto 30px; object-fit: cover; }
        .hero-name { font-size: 48px; font-weight: bold; margin-bottom: 15px; }
        .hero-tagline { font-size: 24px; margin-bottom: 30px; opacity: 0.9; }
        .hero-description { font-size: 18px; margin-bottom: 40px; opacity: 0.8; }
        .cta-button { display: inline-block; background: white; color: #667eea; padding: 15px 40px; border-radius: 30px; text-decoration: none; font-weight: bold; transition: transform 0.3s; }
        .cta-button:hover { transform: scale(1.05); }
        .section { padding: 60px 40px; max-width: 1200px; margin: 0 auto; }
        .section-title { font-size: 36px; font-weight: bold; margin-bottom: 40px; text-align: center; color: #667eea; }
        .about-text { font-size: 18px; line-height: 1.8; max-width: 800px; margin: 0 auto; }
        .skills-container { display: flex; flex-direction: column; gap: 20px; max-width: 800px; margin: 0 auto; }
        .skill-item { background: #f5f5f5; padding: 20px; border-radius: 8px; }
        .skill-name { font-weight: bold; font-size: 18px; margin-bottom: 10px; }
        .skill-bar { background: #e0e0e0; height: 10px; border-radius: 5px; overflow: hidden; }
        .skill-level { background: #667eea; height: 100%; }
        .projects-container { display: flex; flex-direction: column; gap: 30px; max-width: 900px; margin: 0 auto; }
        .project-card { background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); display: flex; }
        .project-image { width: 300px; height: 200px; object-fit: cover; }
        .project-content { padding: 30px; flex: 1; }
        .project-title { font-size: 24px; font-weight: bold; margin-bottom: 15px; }
        .project-description { color: #666; margin-bottom: 15px; }
        .project-link { color: #667eea; text-decoration: none; font-weight: bold; }
        .goals-list { list-style: none; max-width: 800px; margin: 0 auto; }
        .goals-list li { background: #f5f5f5; padding: 20px; margin-bottom: 15px; border-radius: 8px; border-left: 4px solid #667eea; }
        .footer { background: #333; color: white; padding: 40px; text-align: center; }
        .social-links { display: flex; gap: 20px; justify-content: center; margin-top: 20px; }
        .social-links a { color: white; text-decoration: none; font-size: 24px; }
        @media (max-width: 768px) {
            .hero-name { font-size: 32px; }
            .project-card { flex-direction: column; }
            .project-image { width: 100%; }
        }
    </style>
</head>
<body>
    <div class="hero" id="hero">
        <div class="hero-content">
            @if(isset($user->profile) && $user->profile->profile_image)
                <img src="{{ asset('storage/' . $user->profile->profile_image) }}" alt="{{ $user->name }}" class="hero-avatar">
            @else
                <div class="hero-avatar" style="background: rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center;">{{ substr($user->name, 0, 1) }}</div>
            @endif
            <h1 class="hero-name">{{ $user->name }}</h1>
            @if(isset($user->profile) && $user->profile->tagline)
                <p class="hero-tagline">{{ $user->profile->tagline }}</p>
            @endif
            @if(isset($user->profile) && $user->profile->about_short)
                <p class="hero-description">{{ $user->profile->about_short }}</p>
            @endif
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                @if(isset($user->profile) && ($user->profile->contact_email || $user->profile->location))
                    <a href="#contact" class="cta-button">Contact Me</a>
                @endif
                <a href="{{ route('portfolio.pdf', ['id' => $user->id, 'username' => $user->username]) }}" 
                   class="cta-button" 
                   target="_blank"
                   style="background: rgba(255,255,255,0.2); border: 2px solid white;">
                    📄 Download CV
                </a>
            </div>
        </div>
    </div>

    @if(isset($user->profile) && ($user->profile->about_title || $user->profile->about_short || $user->profile->about_long))
        <div class="section">
            <h2 class="section-title">{{ $user->profile->about_title ?? 'About Me' }}</h2>
            <div class="about-text">
                @if($user->profile->about_short)
                    <p>{{ $user->profile->about_short }}</p>
                @endif
                @if($user->profile->about_long)
                    <p style="margin-top: 20px;">{{ $user->profile->about_long }}</p>
                @endif
            </div>
        </div>
    @endif

    @if(isset($user->skills) && $user->skills->count() > 0)
        <div class="section" style="background: #f9f9f9;">
            <h2 class="section-title">Skills</h2>
            <div class="skills-container">
                @foreach($user->skills as $skill)
                    <div class="skill-item">
                        <div class="skill-name">{{ $skill->name }}@if($skill->level) - {{ $skill->level }}@endif</div>
                        <div class="skill-bar">
                            <div class="skill-level" style="width: {{ $skill->level == 'Expert' ? '100%' : ($skill->level == 'Intermediate' ? '70%' : '40%') }};"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if(isset($user->projects) && $user->projects->count() > 0)
        <div class="section">
            <h2 class="section-title">Projects</h2>
            <div class="projects-container">
                @foreach($user->projects as $project)
                    <div class="project-card">
                        @if($project->project_image)
                            <img src="{{ asset('storage/' . $project->project_image) }}" alt="{{ $project->title }}" class="project-image">
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

    @if(isset($user->goals) && $user->goals->count() > 0)
        <div class="section" style="background: #f9f9f9;">
            <h2 class="section-title">Goals</h2>
            <ul class="goals-list">
                @foreach($user->goals as $goal)
                    <li>{{ $goal->goal_text }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="footer" id="contact">
        @if(isset($user->profile) && ($user->profile->contact_email || $user->profile->location))
            <div>
                @if($user->profile->contact_email)
                    <p>📧 {{ $user->profile->contact_email }}</p>
                @endif
                @if($user->profile->location)
                    <p>📍 {{ $user->profile->location }}</p>
                @endif
            </div>
        @endif
        @if(isset($user->profile) && (isset($user->profile->social_facebook) || isset($user->profile->social_linkedin) || isset($user->profile->social_github) || isset($user->profile->social_instagram) || isset($user->profile->social_twitter)))
            <div class="social-links">
                @if(isset($user->profile->social_facebook) && $user->profile->social_facebook)
                    <a href="{{ $user->profile->social_facebook }}" target="_blank">Facebook</a>
                @endif
                @if(isset($user->profile->social_linkedin) && $user->profile->social_linkedin)
                    <a href="{{ $user->profile->social_linkedin }}" target="_blank">LinkedIn</a>
                @endif
                @if(isset($user->profile->social_github) && $user->profile->social_github)
                    <a href="{{ $user->profile->social_github }}" target="_blank">GitHub</a>
                @endif
                @if(isset($user->profile->social_instagram) && $user->profile->social_instagram)
                    <a href="{{ $user->profile->social_instagram }}" target="_blank">Instagram</a>
                @endif
                @if(isset($user->profile->social_twitter) && $user->profile->social_twitter)
                    <a href="{{ $user->profile->social_twitter }}" target="_blank">Twitter</a>
                @endif
            </div>
        @endif
    </div>
</body>
</html>

