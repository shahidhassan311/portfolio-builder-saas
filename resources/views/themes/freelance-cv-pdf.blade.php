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

        /* A4-friendly layout */
        body {
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #111827;
            line-height: 1.4;
            background: #f3f4f6;
            padding: 10mm; /* consistent print padding */
        }

        .page {
            width: 100%;
            background: #ffffff;
            border-radius: 6px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
            min-height: 270mm; /* fill (almost) full A4 page */
        }

        /* LAYOUT: SIDEBAR + MAIN */
        .layout {
            width: 100%;
            border-collapse: collapse;
            height: 100%;
        }

        .layout td {
            vertical-align: top;
        }

        .sidebar {
            width: 30%;
            background: #111827;
            color: #f9fafb;
            padding: 16px 14px 18px;
        }

        .main {
            width: 70%;
            padding: 18px 20px 22px;
        }

        /******** SIDEBAR ********/
        .avatar-wrapper {
            text-align: center;
            margin-bottom: 14px;
        }

        .avatar-ring {
            width: 95px;
            height: 95px;
            border-radius: 50%;
            border: 3px solid #f24e1e;
            margin: 0 auto 8px;
            overflow: hidden;
            background: #111827;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: bold;
        }

        .avatar-ring img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .sidebar-name {
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            text-align: center;
        }

        .sidebar-title {
            font-size: 11px;
            text-align: center;
            color: #e5e7eb;
            margin-bottom: 12px;
        }

        .sidebar-section {
            margin-top: 12px;
        }

        .sidebar-heading {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.16em;
            color: #fca5a5;
            margin-bottom: 4px;
        }

        .sidebar-rule {
            height: 1px;
            background: #4b5563;
            margin-bottom: 6px;
        }

        .sidebar-text {
            font-size: 10.5px;
            color: #e5e7eb;
        }

        .sidebar-text div + div {
            margin-top: 2px;
        }

        .pill-row {
            margin-top: 2px;
        }

        .pill {
            display: inline-block;
            font-size: 9.5px;
            padding: 2px 6px;
            border-radius: 999px;
            border: 1px solid #4b5563;
            margin: 0 3px 4px 0;
            color: #e5e7eb;
        }

        /******** MAIN HEADER ********/
        .main-header {
            margin-bottom: 14px;
        }

        .main-title {
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.16em;
            color: #f24e1e;
            margin-bottom: 6px;
        }

        .main-summary {
            font-size: 11px;
            color: #374151;
        }

        /******** MAIN SECTIONS ********/
        .section {
            margin-top: 12px;
            margin-bottom: 8px;
        }

        .section-title {
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.14em;
            color: #f24e1e;
            margin-bottom: 4px;
        }

        .section-rule {
            height: 1px;
            background: #fecaca;
            margin-bottom: 5px;
        }

        .item {
            margin-bottom: 8px;
        }

        .item-header {
            display: table;
            width: 100%;
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
            font-size: 11.5px;
            font-weight: bold;
        }

        .item-place {
            font-size: 10.5px;
            color: #4b5563;
        }

        .item-dates {
            font-size: 10px;
            color: #6b7280;
        }

        .item-body {
            font-size: 11px;
            color: #374151;
            margin-top: 3px;
        }

        .list {
            list-style: disc;
            padding-left: 16px;
            margin-top: 3px;
        }

        .list li {
            margin-bottom: 2px;
        }

        /******** PROJECTS WITH THUMBNAILS ********/
        .project {
            margin-bottom: 8px;
        }

        .project-layout {
            width: 100%;
            border-collapse: collapse;
        }

        .project-layout td {
            vertical-align: top;
        }

        .project-thumb-cell {
            width: 32%;
            padding-right: 6px;
        }

        .project-thumb {
            width: 100%;
            height: 55px;
            border-radius: 6px;
            background: #fee2e2;
            overflow: hidden;
        }

        .project-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .project-content-cell {
            width: 68%;
        }

        .project-title {
            font-size: 11.5px;
            font-weight: bold;
        }

        .project-url {
            font-size: 9.5px;
            color: #f24e1e;
        }

        .project-desc {
            font-size: 10.5px;
            color: #374151;
            margin-top: 2px;
        }

        /******** GOALS ********/
        .goals-list {
            list-style: disc;
            padding-left: 16px;
            font-size: 10.5px;
            color: #e5e7eb;
        }

        .goals-list li {
            margin-bottom: 2px;
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
                    <div class="sidebar-rule"></div>
                    <div class="sidebar-text">
                        @if($profile->contact_email)
                            <div>{{ $profile->contact_email }}</div>
                        @endif
                        @if($profile->contact_phone)
                            <div>{{ $profile->contact_phone }}</div>
                        @endif
                        @if($profile->location)
                            <div>{{ $profile->location }}</div>
                        @endif
                        @if($profile->social_linkedin)
                            <div>LinkedIn: {{ $profile->social_linkedin }}</div>
                        @endif
                    </div>
                </div>

                {{-- SKILLS (pills) --}}
                @if($hasSkills)
                    <div class="sidebar-section">
                        <div class="sidebar-heading">Skills</div>
                        <div class="sidebar-rule"></div>
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
                        <div class="sidebar-rule"></div>
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
                        <div class="section-title">Experience</div>
                        <div class="section-rule"></div>

                        @foreach($user->experiences as $exp)
                            <div class="item">
                                <div class="item-header">
                                    <div class="item-header-left">
                                        <div class="item-title">{{ $exp->title }}</div>
                                        <div class="item-place">{{ $exp->company }}</div>
                                    </div>
                                    <div class="item-header-right">
                                        <div class="item-dates">
                                            {{ $exp->start_date }} – {{ $exp->end_date ?? 'Present' }}
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
                        <div class="section-rule"></div>

                        @foreach($user->educations as $edu)
                            <div class="item">
                                <div class="item-header">
                                    <div class="item-header-left">
                                        <div class="item-title">{{ $edu->degree }}</div>
                                        <div class="item-place">{{ $edu->institution }}</div>
                                    </div>
                                    <div class="item-header-right">
                                        <div class="item-dates">
                                            {{ $edu->start_year }} – {{ $edu->end_year ?? 'Present' }}
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
                        <div class="section-rule"></div>

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
