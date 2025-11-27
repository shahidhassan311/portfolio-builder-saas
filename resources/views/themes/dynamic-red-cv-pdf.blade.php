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
            color: #171717;
            line-height: 1.5;
            background: #FAFAFA;
            padding: 10mm;
        }

        .page {
            width: 100%;
            background: #FFFFFF;
            border-radius: 8px;
            overflow: hidden;
            border: 3px solid #DC2626;
        }

        .layout {
            width: 100%;
            border-collapse: collapse;
        }

        .layout td {
            vertical-align: top;
        }

        .sidebar {
            width: 32%;
            background: #DC2626;
            color: #FFFFFF;
            padding: 20px 16px 22px;
        }

        .main {
            width: 68%;
            padding: 22px 24px 26px;
        }

        /******** SIDEBAR ********/
        .avatar-wrapper {
            text-align: center;
            margin-bottom: 18px;
        }

        .avatar-ring {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            border: 4px solid #FFFFFF;
            margin: 0 auto 10px;
            overflow: hidden;
            background: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            font-weight: bold;
            color: #DC2626;
        }

        .avatar-ring img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .sidebar-name {
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            text-align: center;
            color: #FFFFFF;
        }

        .sidebar-title {
            font-size: 11px;
            text-align: center;
            color: #FEE2E2;
            margin-bottom: 16px;
            font-weight: 500;
        }

        .sidebar-section {
            margin-top: 16px;
        }

        .sidebar-heading {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: #FFFFFF;
            margin-bottom: 6px;
            font-weight: bold;
            border-bottom: 2px solid #FFFFFF;
            padding-bottom: 4px;
        }

        .sidebar-text {
            font-size: 10.5px;
            color: #FEE2E2;
            line-height: 1.6;
        }

        .sidebar-text div + div {
            margin-top: 4px;
        }

        .pill-row {
            margin-top: 4px;
        }

        .pill {
            display: inline-block;
            font-size: 9px;
            padding: 3px 8px;
            border-radius: 12px;
            border: 1px solid #FFFFFF;
            margin: 0 4px 6px 0;
            color: #FFFFFF;
            background: rgba(255, 255, 255, 0.1);
        }

        /******** MAIN HEADER ********/
        .main-header {
            margin-bottom: 18px;
            padding-bottom: 12px;
            border-bottom: 3px solid #DC2626;
        }

        .main-title {
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: #DC2626;
            margin-bottom: 8px;
        }

        .main-summary {
            font-size: 11.5px;
            color: #404040;
            line-height: 1.7;
        }

        /******** MAIN SECTIONS ********/
        .section {
            margin-top: 16px;
            margin-bottom: 12px;
        }

        .section-title {
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.18em;
            color: #DC2626;
            margin-bottom: 6px;
            border-bottom: 2px solid #DC2626;
            padding-bottom: 4px;
        }

        .item {
            margin-bottom: 12px;
        }

        .item-header {
            display: table;
            width: 100%;
            margin-bottom: 4px;
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
            font-size: 12px;
            font-weight: bold;
            color: #171717;
        }

        .item-place {
            font-size: 11px;
            color: #DC2626;
            font-weight: 600;
            margin-top: 2px;
        }

        .item-dates {
            font-size: 10px;
            color: #525252;
        }

        .item-body {
            font-size: 11px;
            color: #404040;
            margin-top: 4px;
            line-height: 1.6;
        }

        .list {
            list-style: disc;
            padding-left: 18px;
            margin-top: 4px;
        }

        .list li {
            margin-bottom: 3px;
            font-size: 11px;
            color: #404040;
        }

        /******** PROJECTS WITH THUMBNAILS ********/
        .project {
            margin-bottom: 12px;
        }

        .project-layout {
            width: 100%;
            border-collapse: collapse;
        }

        .project-layout td {
            vertical-align: top;
        }

        .project-thumb-cell {
            width: 35%;
            padding-right: 8px;
        }

        .project-thumb {
            width: 100%;
            height: 65px;
            border-radius: 6px;
            background: #FEE2E2;
            overflow: hidden;
            border: 2px solid #DC2626;
        }

        .project-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .project-content-cell {
            width: 65%;
        }

        .project-title {
            font-size: 12px;
            font-weight: bold;
            color: #171717;
            margin-bottom: 2px;
        }

        .project-url {
            font-size: 9.5px;
            color: #DC2626;
            margin-bottom: 3px;
        }

        .project-desc {
            font-size: 10.5px;
            color: #404040;
            margin-top: 3px;
            line-height: 1.5;
        }

        /******** GOALS ********/
        .goals-list {
            list-style: disc;
            padding-left: 18px;
            font-size: 10.5px;
            color: #FEE2E2;
        }

        .goals-list li {
            margin-bottom: 3px;
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
            padding: 4px 8px 4px 0;
            font-size: 10.5px;
            color: #404040;
        }

        .skill-name-main {
            font-weight: 600;
            color: #171717;
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
                            <div><strong>Email:</strong><br>{{ $profile->contact_email }}</div>
                        @endif
                        @if($profile->contact_phone)
                            <div><strong>Phone:</strong><br>{{ $profile->contact_phone }}</div>
                        @endif
                        @if($profile->location)
                            <div><strong>Location:</strong><br>{{ $profile->location }}</div>
                        @endif
                        @if($profile->social_linkedin)
                            <div><strong>LinkedIn:</strong><br>{{ $profile->social_linkedin }}</div>
                        @endif
                        @if($profile->social_github)
                            <div><strong>GitHub:</strong><br>{{ $profile->social_github }}</div>
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
                                                <div class="project-thumb"></div>
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
            </td>
        </tr>
    </table>
</div>
</body>
</html>

