<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $user->name }} - CV</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #1a1a1a;
            line-height: 1.6;
            background: #f5f7fa;
            padding: 10mm;
        }

        .page {
            width: 100%;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            border: 2px solid rgba(102, 126, 234, 0.2);
            /* Dynamic height - adjusts to content */
        }

        .layout {
            width: 100%;
            border-collapse: collapse;
            /* Dynamic height - adjusts to content */
        }

        .layout td {
            vertical-align: top;
        }

        .sidebar {
            width: 35%;
            background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            padding: 24px 20px 28px;
        }

        .main {
            width: 65%;
            padding: 24px 28px 28px;
        }

        /******** SIDEBAR ********/
        .avatar-wrapper {
            text-align: center;
            margin-bottom: 20px;
        }

        .avatar-ring {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid #ffffff;
            margin: 0 auto 12px;
            overflow: hidden;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            font-weight: bold;
            color: #667eea;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .avatar-ring img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .sidebar-name {
            font-size: 22px;
            font-weight: 900;
            letter-spacing: 0.05em;
            text-align: center;
            color: #ffffff;
            margin-bottom: 6px;
        }

        .sidebar-title {
            font-size: 11.5px;
            text-align: center;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 20px;
            font-weight: 500;
        }

        .sidebar-section {
            margin-top: 20px;
        }

        .sidebar-heading {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: #ffffff;
            margin-bottom: 8px;
            font-weight: 800;
            border-bottom: 2px solid rgba(255, 255, 255, 0.3);
            padding-bottom: 6px;
        }

        .sidebar-text {
            font-size: 10.5px;
            color: rgba(255, 255, 255, 0.95);
            line-height: 1.7;
        }

        .sidebar-text div + div {
            margin-top: 6px;
        }

        .sidebar-text strong {
            color: #ffffff;
            font-weight: 700;
            display: block;
            margin-bottom: 2px;
        }

        .pill-row {
            margin-top: 6px;
        }

        .pill {
            display: inline-block;
            font-size: 9px;
            padding: 4px 10px;
            border-radius: 15px;
            border: 1.5px solid rgba(255, 255, 255, 0.5);
            margin: 0 4px 6px 0;
            color: #ffffff;
            background: rgba(255, 255, 255, 0.15);
            font-weight: 500;
        }

        .goals-list {
            list-style: disc;
            padding-left: 18px;
            font-size: 10.5px;
            color: rgba(255, 255, 255, 0.95);
        }

        .goals-list li {
            margin-bottom: 4px;
            line-height: 1.6;
        }

        /******** MAIN HEADER ********/
        .main-header {
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 3px solid #667eea;
        }

        .main-title {
            font-size: 18px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
        }

        .main-summary {
            font-size: 11.5px;
            color: #404040;
            line-height: 1.8;
        }

        /******** MAIN SECTIONS ********/
        .section {
            margin-top: 20px;
            margin-bottom: 16px;
        }

        .section-title {
            font-size: 14px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: #667eea;
            margin-bottom: 8px;
            border-bottom: 2px solid #667eea;
            padding-bottom: 6px;
        }

        .item {
            margin-bottom: 14px;
        }

        .item-header {
            display: table;
            width: 100%;
            margin-bottom: 6px;
        }

        .item-header-left,
        .item-header-right {
            display: table-cell;
            vertical-align: top;
        }

        .item-header-right {
            text-align: right;
        }

        .item-title {
            font-size: 12.5px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 3px;
        }

        .item-place {
            font-size: 11.5px;
            color: #667eea;
            font-weight: 600;
            margin-top: 2px;
        }

        .item-dates {
            font-size: 10px;
            color: #666666;
            padding: 3px 10px;
            background: rgba(102, 126, 234, 0.1);
            border-radius: 12px;
            display: inline-block;
        }

        .item-body {
            font-size: 11px;
            color: #404040;
            margin-top: 6px;
            line-height: 1.7;
        }

        .list {
            list-style: disc;
            padding-left: 20px;
            margin-top: 6px;
        }

        .list li {
            margin-bottom: 4px;
            font-size: 11px;
            color: #404040;
            line-height: 1.6;
        }

        /******** PROJECTS WITH THUMBNAILS ********/
        .project {
            margin-bottom: 14px;
        }

        .project-layout {
            width: 100%;
            border-collapse: collapse;
        }

        .project-layout td {
            vertical-align: top;
        }

        .project-thumb-cell {
            width: 38%;
            padding-right: 10px;
        }

        .project-thumb {
            width: 100%;
            height: 75px;
            border-radius: 8px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            overflow: hidden;
            border: 2px solid rgba(102, 126, 234, 0.2);
        }

        .project-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .project-content-cell {
            width: 62%;
        }

        .project-title {
            font-size: 12.5px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 4px;
        }

        .project-url {
            font-size: 9.5px;
            color: #667eea;
            margin-bottom: 4px;
            font-weight: 600;
        }

        .project-desc {
            font-size: 10.5px;
            color: #404040;
            margin-top: 4px;
            line-height: 1.6;
        }

        /******** SKILLS SECTION IN MAIN ********/
        .skills-grid {
            display: table;
            width: 100%;
        }

        .skill-row {
            display: table-row;
        }

        .skill-cell {
            display: table-cell;
            padding: 6px 12px 6px 0;
            font-size: 10.5px;
            color: #404040;
        }

        .skill-name-main {
            font-weight: 700;
            color: #1a1a1a;
        }

        .skill-level-main {
            color: #667eea;
            font-weight: 600;
        }
    </style>
</head>
<body>
@php
    $profile   = optional($user->profile);
    $hasAbout  = $profile->about_short || $profile->about_long;
    $hasSkills = $user->skills->count() ?? 0;
    $hasExp    = method_exists($user, 'experiences') && $user->experiences->count();
    $hasEdu    = method_exists($user, 'educations') && $user->educations->count();
    $hasProj   = $user->projects->count() ?? 0;
    $hasGoals  = $user->goals->count() ?? 0;
@endphp

<div class="page">
    <table class="layout">
        <tr>
            {{-- SIDEBAR --}}
            <td class="sidebar">
                <div class="avatar-wrapper">
                    <div class="avatar-ring">
                        @if($profile->profile_image)
                            <img src="{{ public_path('storage/' . $profile->profile_image) }}" alt="{{ $user->name }}">
                        @else
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        @endif
                    </div>
                    <div class="sidebar-name">{{ strtoupper($user->name) }}</div>
                    @if($profile->tagline)
                        <div class="sidebar-title">{{ $profile->tagline }}</div>
                    @endif
                </div>

                {{-- CONTACT --}}
                <div class="sidebar-section">
                    <div class="sidebar-heading">Contact</div>
                    <div class="sidebar-text">
                        @if($profile->contact_email)
                            <div>
                                <strong>Email:</strong>
                                {{ $profile->contact_email }}
                            </div>
                        @endif
                        @if($profile->contact_phone)
                            <div>
                                <strong>Phone:</strong>
                                {{ $profile->contact_phone }}
                            </div>
                        @endif
                        @if($profile->location)
                            <div>
                                <strong>Location:</strong>
                                {{ $profile->location }}
                            </div>
                        @endif
                        @if($profile->social_linkedin)
                            <div>
                                <strong>LinkedIn:</strong>
                                {{ $profile->social_linkedin }}
                            </div>
                        @endif
                        @if($profile->social_github)
                            <div>
                                <strong>GitHub:</strong>
                                {{ $profile->social_github }}
                            </div>
                        @endif
                    </div>
                </div>

                {{-- SKILLS (pills) --}}
                @if($hasSkills)
                    <div class="sidebar-section">
                        <div class="sidebar-heading">Skills</div>
                        <div class="pill-row">
                            @foreach($user->skills as $skill)
                                <span class="pill">
                                    {{ $skill->name }}
                                    @if($skill->level) · {{ $skill->level }} @endif
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- GOALS --}}
                @if($hasGoals)
                    <div class="sidebar-section">
                        <div class="sidebar-heading">Goals</div>
                        <ul class="goals-list">
                            @foreach($user->goals as $goal)
                                <li>{{ $goal->goal_text }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </td>

            {{-- MAIN CONTENT --}}
            <td class="main">
                {{-- PROFILE / SUMMARY --}}
                @if($hasAbout)
                    <div class="main-header">
                        <div class="main-title">Professional Profile</div>
                        <div class="main-summary">
                            @if($profile->about_short)
                                {{ $profile->about_short }}
                            @endif
                            @if($profile->about_long)
                                @if($profile->about_short)<br><br>@endif
                                {{ $profile->about_long }}
                            @endif
                        </div>
                    </div>
                @endif

                {{-- EXPERIENCE --}}
                @if($hasExp)
                    <section class="section">
                        <div class="section-title">Professional Experience</div>

                        @foreach($user->experiences as $exp)
                            <div class="item">
                                <div class="item-header">
                                    <div class="item-header-left">
                                        <div class="item-title">{{ $exp->title }}</div>
                                        <div class="item-place">{{ $exp->company }}</div>
                                    </div>
                                    <div class="item-header-right">
                                        <div class="item-dates">
                                            @if($exp->start_date)
                                                {{ \Carbon\Carbon::parse($exp->start_date)->format('M Y') }}
                                            @endif
                                            @if($exp->end_date)
                                                – {{ \Carbon\Carbon::parse($exp->end_date)->format('M Y') }}
                                            @elseif($exp->is_current)
                                                – Present
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @if($exp->description)
                                    <div class="item-body">{{ $exp->description }}</div>
                                @endif
                            </div>
                        @endforeach
                    </section>
                @endif

                {{-- EDUCATION --}}
                @if($hasEdu)
                    <section class="section">
                        <div class="section-title">Education</div>

                        @foreach($user->educations as $edu)
                            <div class="item">
                                <div class="item-header">
                                    <div class="item-header-left">
                                        <div class="item-title">{{ $edu->degree }}</div>
                                        <div class="item-place">{{ $edu->institution }}</div>
                                    </div>
                                    <div class="item-header-right">
                                        <div class="item-dates">
                                            @if($edu->start_date)
                                                {{ \Carbon\Carbon::parse($edu->start_date)->format('Y') }}
                                            @endif
                                            @if($edu->end_date)
                                                – {{ \Carbon\Carbon::parse($edu->end_date)->format('Y') }}
                                            @elseif($edu->is_current)
                                                – Present
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @if($edu->description)
                                    <div class="item-body">{{ $edu->description }}</div>
                                @endif
                            </div>
                        @endforeach
                    </section>
                @endif

                {{-- PROJECTS WITH THUMBNAILS --}}
                @if($hasProj)
                    <section class="section">
                        <div class="section-title">Selected Projects</div>

                        @foreach($user->projects as $project)
                            <div class="project">
                                <table class="project-layout">
                                    <tr>
                                        <td class="project-thumb-cell">
                                            @if($project->project_image)
                                                <div class="project-thumb">
                                                    <img src="{{ public_path('storage/' . $project->project_image) }}"
                                                         alt="{{ $project->title }}">
                                                </div>
                                            @else
                                                <div class="project-thumb" style="display: flex; align-items: center; justify-content: center; color: white; font-size: 24px; font-weight: 900;">
                                                    {{ strtoupper(substr($project->title, 0, 1)) }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="project-content-cell">
                                            <div class="project-title">{{ $project->title }}</div>
                                            @if($project->project_url)
                                                <div class="project-url">{{ $project->project_url }}</div>
                                            @endif
                                            @if($project->short_description)
                                                <div class="project-desc">{{ $project->short_description }}</div>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        @endforeach
                    </section>
                @endif

                {{-- SKILLS IN MAIN (if not in sidebar or additional display) --}}
                @if($hasSkills && false)
                    <section class="section">
                        <div class="section-title">Technical Skills</div>
                        <table class="skills-grid">
                            @foreach($user->skills->chunk(2) as $skillRow)
                                <tr class="skill-row">
                                    @foreach($skillRow as $skill)
                                        <td class="skill-cell">
                                            <span class="skill-name-main">{{ $skill->name }}</span>
                                            @if($skill->level)
                                                <span class="skill-level-main"> · {{ $skill->level }}</span>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </table>
                    </section>
                @endif
            </td>
        </tr>
    </table>
</div>
</body>
</html>

