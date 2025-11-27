<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="resumizo-logo-white.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portfolio Builder - Create a Premium Portfolio</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 1200px; margin: 0 auto; display: flex; min-height: 100vh; }
        .sidebar { width: 300px; background: #fff; padding: 40px 30px; box-shadow: 2px 0 10px rgba(0,0,0,0.1); }
        .main-content { flex: 1; padding: 40px; background: #f9f9f9; overflow-y: auto; }
        .profile-img { width: 150px; height: 150px; border-radius: 50%; object-fit: cover; margin: 0 auto 20px; display: block; border: 4px solid #4f46e5; }
        .name { text-align: center; font-size: 28px; font-weight: bold; margin-bottom: 10px; }
        .tagline { text-align: center; color: #666; font-size: 16px; margin-bottom: 30px; }
        .section { margin-bottom: 40px; }
        .section-title { font-size: 24px; font-weight: bold; margin-bottom: 20px; color: #4f46e5; border-bottom: 2px solid #4f46e5; padding-bottom: 10px; }
        .skills-list { display: flex; flex-wrap: wrap; gap: 10px; }
        .skill-badge { background: #4f46e5; color: white; padding: 8px 16px; border-radius: 20px; font-size: 14px; }
        .projects-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; }
        .project-card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .project-card img { width: 100%; height: 200px; object-fit: cover; border-radius: 4px; margin-bottom: 10px; }
        .project-title { font-size: 18px; font-weight: bold; margin-bottom: 10px; }
        .project-link { color: #4f46e5; text-decoration: none; }
        .contact-info { list-style: none; }
        .contact-info li { margin-bottom: 10px; }
        .social-links { display: flex; gap: 15px; justify-content: center; margin-top: 20px; }
        .social-links a { color: #4f46e5; text-decoration: none; font-size: 18px; }
        @media (max-width: 768px) {
            .container { flex-direction: column; }
            .sidebar { width: 100%; }
            .projects-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            @if(isset($user->profile) && $user->profile->profile_image)
                <img src="{{ asset('storage/' . $user->profile->profile_image) }}" alt="{{ $user->name }}" class="profile-img">
            @else
                <div class="profile-img" style="background: #e5e7eb; display: flex; align-items: center; justify-content: center; color: #999;">No Image</div>
            @endif
            <h1 class="name">{{ $user->name }}</h1>
            @if(isset($user->profile) && $user->profile->tagline)
                <p class="tagline">{{ $user->profile->tagline }}</p>
            @endif
            @if(isset($user->profile) && ($user->profile->contact_email || $user->profile->location))
                <div class="section">
                    <ul class="contact-info">
                        @if($user->profile->contact_email)
                            <li>📧 {{ $user->profile->contact_email }}</li>
                        @endif
                        @if($user->profile->location)
                            <li>📍 {{ $user->profile->location }}</li>
                        @endif
                    </ul>
                </div>
            @endif
            <div class="section">
                <a href="{{ route('portfolio.pdf', ['id' => $user->id, 'username' => $user->username]) }}" 
                   target="_blank"
                   style="display: block; text-align: center; padding: 12px 24px; background: #4f46e5; color: white; border-radius: 8px; text-decoration: none; font-weight: 600; margin-top: 20px;">
                    📄 Download CV
                </a>
            </div>
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
        <div class="main-content">
            @if(isset($user->profile) && ($user->profile->about_title || $user->profile->about_short || $user->profile->about_long))
                <div class="section">
                    <h2 class="section-title">{{ $user->profile->about_title ?? 'About Me' }}</h2>
                    @if($user->profile->about_short)
                        <p>{{ $user->profile->about_short }}</p>
                    @endif
                    @if($user->profile->about_long)
                        <p style="margin-top: 15px;">{{ $user->profile->about_long }}</p>
                    @endif
                </div>
            @endif

            @if(isset($user->skills) && $user->skills->count() > 0)
                <div class="section">
                    <h2 class="section-title">Skills</h2>
                    <div class="skills-list">
                        @foreach($user->skills as $skill)
                            <span class="skill-badge">{{ $skill->name }}@if($skill->level) - {{ $skill->level }}@endif</span>
                        @endforeach
                    </div>
                </div>
            @endif

            @if(isset($user->projects) && $user->projects->count() > 0)
                <div class="section">
                    <h2 class="section-title">Projects</h2>
                    <div class="projects-grid">
                        @foreach($user->projects as $project)
                            <div class="project-card">
                                @if($project->project_image)
                                    <img src="{{ asset('storage/' . $project->project_image) }}" alt="{{ $project->title }}">
                                @endif
                                <h3 class="project-title">{{ $project->title }}</h3>
                                @if($project->short_description)
                                    <p>{{ $project->short_description }}</p>
                                @endif
                                @if($project->project_url)
                                    <a href="{{ $project->project_url }}" target="_blank" class="project-link">View Project →</a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if(isset($user->goals) && $user->goals->count() > 0)
                <div class="section">
                    <h2 class="section-title">Goals</h2>
                    <ul style="list-style: disc; padding-left: 20px;">
                        @foreach($user->goals as $goal)
                            <li style="margin-bottom: 10px;">{{ $goal->goal_text }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</body>
</html>

