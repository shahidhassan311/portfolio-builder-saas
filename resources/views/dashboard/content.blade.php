<x-portal-layout active="content" title="Content" description="{{ config('plans.free.features.edits') }} — profile, experience, projects, and more.">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>

    </style>

    <div class="portal-container">
        <!-- Header -->
        <div class="portal-header">
            <div class="header-right">
                <span class="last-saved">Last saved 1 min ago</span>
                <button class="btn-primary save-all-btn">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                    </svg>
                    Save Changes
                </button>
            </div>
        </div>

        @php
            $iconMap = [
                'profile'    => 'fa-solid fa-user',
                'about'      => 'fa-solid fa-address-card',
                'experience' => 'fa-solid fa-briefcase',
                'education'  => 'fa-solid fa-graduation-cap',
                'skills'     => 'fa-solid fa-bolt',
                'projects'   => 'fa-solid fa-folder-open',
                'live_link'  => 'fa-solid fa-link',
            ];
        @endphp

        <!-- Tabs -->
        <div class="portal-tabs-wrapper">
            <div class="portal-tabs">
                @php
                    $defaultBlockSlugs = ['profile', 'about', 'education', 'skills', 'experience', 'projects'];
                    $allBlocks = collect();

                    foreach($defaultBlocks as $block) {
                        $allBlocks->push((object) [
                            'id' => 'default_' . $block->slug,
                            'block' => $block,
                            'is_default' => true,
                            'is_enabled' => true,
                            'sort_order' => array_search($block->slug, $defaultBlockSlugs),
                            'user_block_id' => null
                        ]);
                    }

                    foreach($userBlocks as $userBlock) {
                        if(!in_array($userBlock->block->slug, $defaultBlockSlugs)) {
                            $allBlocks->push((object) [
                                'id' => $userBlock->id,
                                'block' => $userBlock->block,
                                'is_default' => false,
                                'is_enabled' => $userBlock->is_enabled,
                                'sort_order' => $userBlock->sort_order ?? 999,
                                'user_block_id' => $userBlock->id
                            ]);
                        }
                    }

                    $allBlocks = $allBlocks->sortBy('sort_order');
                @endphp

                @foreach($allBlocks as $index => $item)
                    @php
                        $tabIcon = $item->block->icon ?: ($iconMap[$item->block->slug] ?? 'fa-solid fa-circle-dot');
                    @endphp
                    <button
                        onclick="showSection(event, '{{ $item->block->slug }}')"
                        class="portal-tab {{ $index === 0 ? 'is-active' : '' }}"
                        data-section="{{ $item->block->slug }}"
                    >
                        <i class="{{ $tabIcon }}"></i>
                        {{ $item->block->name }}
                        @if(!$item->is_enabled)
                            <span class="badge-disabled">Disabled</span>
                        @endif
                    </button>
                @endforeach

                <button onclick="openAddBlockModal()" class="portal-tab add-tab">
                    <i class="fa-solid fa-circle-plus"></i>
                    Add Block
                </button>
            </div>
        </div>

        <!-- Main Content -->
        <div class="portal-content-wrapper">
            @foreach($allBlocks as $index => $item)
                @php
                    $sectionId = $item->block->slug . '-section';
                    $isFirst = $index === 0;
                    $userBlockId = $item->user_block_id;
                @endphp

                <div id="{{ $sectionId }}" class="section-content {{ $isFirst ? '' : 'hidden' }}">
                    @switch($item->block->slug)
                        @case('profile')
                            <!-- PROFILE SECTION -->
                            <div class="profile-two-column">
                                <div class="profile-left">
                                    <div class="profile-card">
                                        <div class="content-card-header">
                                            <h2 class="content-card-title">Profile Information</h2>
                                            <p class="content-card-subtitle">Update your personal details and profile information.</p>
                                        </div>
                                        <form method="POST" action="{{ route('dashboard.profile.update') }}" enctype="multipart/form-data" class="profile-form ajax-form" data-success-message="Profile updated successfully!">
                                            @csrf
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <label><i class="fa-solid fa-user field-icon"></i> Full Name</label>
                                                    <input type="text" name="name" value="{{ $user->name }}" placeholder="Ebad Rehman" required>
                                                </div>
                                                <div class="form-group">
                                                    <label><i class="fa-solid fa-at field-icon"></i> Username</label>
                                                    <input type="text" name="username" value="{{ $user->username }}" placeholder="ebad1122" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label><i class="fa-solid fa-wand-magic-sparkles field-icon"></i> Professional Tagline</label>
                                                <input type="text" name="tagline" value="{{ $user->profile->tagline ?? '' }}" placeholder="e.g., Web Developer">
                                            </div>
                                            <div class="form-group">
                                                <label><i class="fa-solid fa-pen-nib field-icon"></i> Short Bio</label>
                                                <textarea name="about_short" rows="4" maxlength="80" placeholder="Write a short bio about yourself...">{{ $user->profile->about_short ?? '' }}</textarea>
                                                <span class="char-counter">0/80</span>
                                            </div>
                                            <div class="form-group profile-image-field">
                                                <label><i class="fa-solid fa-image field-icon"></i> Profile Image</label>
                                                <div class="profile-image-upload-row">
                                                    <label for="profileImage" class="upload-dropzone">
                                                        <i class="fa-solid fa-cloud-arrow-up upload-icon"></i>
                                                        <p class="upload-text">Upload your photo</p>
                                                        <p class="upload-hint">JPG, PNG or WEBP. Max size 2MB</p>
                                                        <span class="btn-choose-file">Choose File</span>
                                                    </label>
                                                    <input type="file" name="profile_image" accept="image/*" id="profileImage" class="hidden file-input">
                                                    <div class="profile-preview-wrapper">
                                                        @if($user->profile && $user->profile->profile_image)
                                                            <img src="{{ asset('storage/' . $user->profile->profile_image) }}" alt="Profile" class="profile-preview-image">
                                                        @else
                                                            <div class="profile-preview-placeholder">
                                                                <i class="fa-solid fa-user"></i>
                                                            </div>
                                                        @endif
                                                        <label for="profileImage" class="profile-edit-btn">
                                                            <i class="fa-solid fa-pen"></i>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="profile-right">
                                    <div class="tips-card">
                                        <h3 class="tips-title"><i class="fa-solid fa-lightbulb"></i> Tips</h3>
                                        <ul class="tips-list">
                                            <li class="tip-item">
                                                <span class="tip-icon">✓</span>
                                                <span class="tip-text">Add a professional photo for better first impression.</span>
                                            </li>
                                            <li class="tip-item">
                                                <span class="tip-icon">✓</span>
                                                <span class="tip-text">Your tagline should be short and impactful.</span>
                                            </li>
                                            <li class="tip-item">
                                                <span class="tip-icon">✓</span>
                                                <span class="tip-text">A short bio helps people understand who you are.</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @break

                        @case('about')
                            <!-- ABOUT SECTION -->
                            <div class="content-two-column">
                                <div class="content-left">
                                    <div class="content-card">
                                        <div class="content-card-header">
                                            <h2 class="content-card-title">About Information</h2>
                                            <p class="content-card-subtitle">Tell your story and share your background.</p>
                                        </div>
                                        <form method="POST" action="{{ route('dashboard.about.update') }}" class="ajax-form" data-success-message="About section updated successfully!">
                                            @csrf
                                            <div class="form-group">
                                                <label><i class="fa-solid fa-heading field-icon"></i> Title</label>
                                                <input type="text" name="about_title" value="{{ $user->profile->about_title ?? 'About Me' }}" placeholder="About Me">
                                            </div>
                                            <div class="form-group">
                                                <label><i class="fa-solid fa-align-left field-icon"></i> Short description (300–500 chars)</label>
                                                <textarea name="about_short" rows="4" placeholder="Tell a brief story about yourself...">{{ $user->profile->about_short ?? '' }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label><i class="fa-solid fa-file-lines field-icon"></i> Long description (optional)</label>
                                                <textarea name="about_long" rows="6" placeholder="Share your full story...">{{ $user->profile->about_long ?? '' }}</textarea>
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="content-right">
                                    <div class="tips-card">
                                        <h3 class="tips-title"><i class="fa-solid fa-lightbulb"></i> Tips</h3>
                                        <ul class="tips-list">
                                            <li class="tip-item">
                                                <span class="tip-icon">✓</span>
                                                <span class="tip-text">Keep your bio concise and engaging.</span>
                                            </li>
                                            <li class="tip-item">
                                                <span class="tip-icon">✓</span>
                                                <span class="tip-text">Highlight your key achievements and skills.</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @break

                            @case('contact')
<div class="content-two-column">
    <div class="content-left">
        <div class="content-card">
            <div class="content-card-header">
                <h2 class="content-card-title">Contact Information</h2>
                <p class="content-card-subtitle">
                    Manage your contact details and social media profiles.
                </p>
            </div>

            <form method="POST"
                  action="{{ route('dashboard.contact.update') }}"
                  class="ajax-form"
                  data-success-message="Contact details updated successfully!">
                @csrf

                <div class="form-grid">

                    <div class="form-group">
                        <label>
                            <i class="fa-solid fa-envelope field-icon"></i>
                            Email Address
                        </label>
                        <input type="email"
                               name="contact_email"
                               value="{{ $user->profile->contact_email ?? $user->email }}"
                               placeholder="example@email.com">
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fa-solid fa-phone field-icon"></i>
                            Phone Number
                        </label>
                        <input type="text"
                               name="contact_phone"
                               value="{{ $user->profile->contact_phone ?? '' }}"
                               placeholder="+92 300 1234567">
                    </div>

                    <div class="form-group full-width">
                        <label>
                            <i class="fa-solid fa-location-dot field-icon"></i>
                            Location
                        </label>
                        <input type="text"
                               name="location"
                               value="{{ $user->profile->location ?? '' }}"
                               placeholder="Karachi, Pakistan">
                    </div>

                </div>

                <div class="section-divider">
                    <h3>Social Links</h3>
                    <p>Add your professional and social media profiles.</p>
                </div>

                <div class="form-grid">

                    <div class="form-group">
                        <label>
                            <i class="fab fa-facebook field-icon"></i>
                            Facebook
                        </label>
                        <input type="url"
                               name="social_facebook"
                               value="{{ $user->profile->social_facebook ?? '' }}"
                               placeholder="https://facebook.com/username">
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fab fa-instagram field-icon"></i>
                            Instagram
                        </label>
                        <input type="url"
                               name="social_instagram"
                               value="{{ $user->profile->social_instagram ?? '' }}"
                               placeholder="https://instagram.com/username">
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fab fa-linkedin field-icon"></i>
                            LinkedIn
                        </label>
                        <input type="url"
                               name="social_linkedin"
                               value="{{ $user->profile->social_linkedin ?? '' }}"
                               placeholder="https://linkedin.com/in/username">
                    </div>

                    <div class="form-group">
                        <label>
                            <i class="fab fa-github field-icon"></i>
                            GitHub
                        </label>
                        <input type="url"
                               name="social_github"
                               value="{{ $user->profile->social_github ?? '' }}"
                               placeholder="https://github.com/username">
                    </div>

                    <div class="form-group full-width">
                        <label>
                            <i class="fab fa-x-twitter field-icon"></i>
                            Twitter / X
                        </label>
                        <input type="url"
                               name="social_twitter"
                               value="{{ $user->profile->social_twitter ?? '' }}"
                               placeholder="https://x.com/username">
                    </div>

                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">
                        Save Changes
                    </button>
                </div>

            </form>
        </div>
    </div>

    <div class="content-right">
        <div class="tips-card">
            <h3 class="tips-title">
                <i class="fa-solid fa-lightbulb"></i>
                Tips
            </h3>

            <ul class="tips-list">
                <li class="tip-item">
                    <span class="tip-icon">✓</span>
                    <span class="tip-text">
                        Always use an email address that you check regularly.
                    </span>
                </li>

                <li class="tip-item">
                    <span class="tip-icon">✓</span>
                    <span class="tip-text">
                        Include your city and country to help visitors know your location.
                    </span>
                </li>

                <li class="tip-item">
                    <span class="tip-icon">✓</span>
                    <span class="tip-text">
                        Add only active social profiles to build credibility.
                    </span>
                </li>

                <li class="tip-item">
                    <span class="tip-icon">✓</span>
                    <span class="tip-text">
                        Double-check that all URLs start with https://
                    </span>
                </li>
            </ul>
        </div>
    </div>
</div>
@break

                        @case('skills')
                            <!-- SKILLS SECTION -->
                            <div class="content-two-column">
                                <div class="content-left">
                                    <div class="content-card">
                                        <div class="content-card-header">
                                            <h2 class="content-card-title">Skills</h2>
                                            <p class="content-card-subtitle">Add and manage your professional skills.</p>
                                        </div>
                                        <form method="POST" action="{{ route('dashboard.skills.store') }}" class="ajax-form" data-success-message="Skill added successfully!">
                                            @csrf
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <label><i class="fa-solid fa-bolt field-icon"></i> Skill Name</label>
                                                    <input type="text" name="name" placeholder="Skill name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label><i class="fa-solid fa-chart-simple field-icon"></i> Level</label>
                                                    <input type="text" name="level" placeholder="Level (e.g. Expert)">
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn-primary">Add Skill</button>
                                            </div>
                                        </form>
                                        <div id="skills-list" class="items-list">
                                            @foreach($user->skills as $skill)
                                                <div class="list-item" data-skill-id="{{ $skill->id }}">
                                                    <span><strong>{{ $skill->name }}</strong>@if($skill->level) <span class="meta">— {{ $skill->level }}</span>@endif</span>
                                                    <div class="item-actions">
                                                        <button type="button" onclick="editSkill({{ $skill->id }}, '{{ addslashes($skill->name) }}', '{{ addslashes($skill->level) }}')" class="link-btn">Edit</button>
                                                        <form method="POST" action="{{ route('dashboard.skills.delete', $skill->id) }}" class="inline ajax-form" data-success-message="Skill deleted successfully!">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="link-btn danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="content-right">
                                    <div class="tips-card">
                                        <h3 class="tips-title"><i class="fa-solid fa-lightbulb"></i> Tips</h3>
                                        <ul class="tips-list">
                                            <li class="tip-item">
                                                <span class="tip-icon">✓</span>
                                                <span class="tip-text">List skills that are relevant to your career.</span>
                                            </li>
                                            <li class="tip-item">
                                                <span class="tip-icon">✓</span>
                                                <span class="tip-text">Use skill levels to show your proficiency.</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @break

                        @case('experience')
                            <!-- EXPERIENCE SECTION -->
                            <div class="content-two-column">
                                <div class="content-left">
                                    <div class="content-card">
                                        <div class="content-card-header">
                                            <h2 class="content-card-title">Experience</h2>
                                            <p class="content-card-subtitle">Add your professional experience and work history.</p>
                                        </div>
                                        <form method="POST" action="{{ route('dashboard.experience.store') }}" class="ajax-form" data-success-message="Experience added successfully!">
                                            @csrf
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <label><i class="fa-solid fa-building field-icon"></i> Company</label>
                                                    <input type="text" name="company" placeholder="Company name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label><i class="fa-solid fa-id-badge field-icon"></i> Role / Title</label>
                                                    <input type="text" name="role_title" placeholder="Job title" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <label><i class="fa-solid fa-briefcase field-icon"></i> Employment Type</label>
                                                    <input type="text" name="employment_type" placeholder="Full-time, Part-time, Freelance…">
                                                </div>
                                                <div class="form-group">
                                                    <label><i class="fa-solid fa-location-dot field-icon"></i> Location</label>
                                                    <input type="text" name="location" placeholder="City, Country">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <label><i class="fa-solid fa-calendar-day field-icon"></i> Start Date</label>
                                                    <input type="date" name="start_date">
                                                </div>
                                                <div class="form-group">
                                                    <label><i class="fa-solid fa-calendar-check field-icon"></i> End Date</label>
                                                    <input type="date" name="end_date">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="checkbox-label">
                                                    <input type="checkbox" id="exp_is_current" name="is_current" value="1">
                                                    Currently working here
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label><i class="fa-solid fa-align-left field-icon"></i> Description</label>
                                                <textarea name="description" rows="3" placeholder="What did you work on? Tech stack, responsibilities…"></textarea>
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn-primary">Add experience</button>
                                            </div>
                                        </form>
                                        @if($user->experiences->isNotEmpty())
                                            <p class="sort-hint">Drag ⋮⋮ to reorder how experience appears on your portfolio.</p>
                                        @endif
                                        <div class="sortable-list" id="experience-list" data-reorder-url="{{ route('dashboard.experience.reorder') }}">
                                            @forelse($user->experiences as $exp)
                                                @include('dashboard.partials.experience-item', ['exp' => $exp])
                                            @empty
                                                <p class="empty-state">No experience added yet.</p>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <div class="content-right">
                                    <div class="tips-card">
                                        <h3 class="tips-title"><i class="fa-solid fa-lightbulb"></i> Tips</h3>
                                        <ul class="tips-list">
                                            <li class="tip-item">
                                                <span class="tip-icon">✓</span>
                                                <span class="tip-text">Highlight your most relevant experience first.</span>
                                            </li>
                                            <li class="tip-item">
                                                <span class="tip-icon">✓</span>
                                                <span class="tip-text">Include specific achievements and metrics.</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @break

                        @case('education')
                            <!-- EDUCATION SECTION -->
                            <div class="content-two-column">
                                <div class="content-left">
                                    <div class="content-card">
                                        <div class="content-card-header">
                                            <h2 class="content-card-title">Education</h2>
                                            <p class="content-card-subtitle">Add your educational background.</p>
                                        </div>
                                        <form method="POST" action="{{ route('dashboard.education.store') }}" class="ajax-form" data-success-message="Education added successfully!">
                                            @csrf
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <label><i class="fa-solid fa-school field-icon"></i> Institution</label>
                                                    <input type="text" name="institution" placeholder="e.g. Harvard University" required>
                                                </div>
                                                <div class="form-group">
                                                    <label><i class="fa-solid fa-graduation-cap field-icon"></i> Degree</label>
                                                    <input type="text" name="degree" placeholder="e.g. BS Computer Science">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <label><i class="fa-solid fa-book field-icon"></i> Field of Study</label>
                                                    <input type="text" name="field_of_study" placeholder="Computer Science, IT, Design…">
                                                </div>
                                                <div class="form-group">
                                                    <label><i class="fa-solid fa-location-dot field-icon"></i> Location</label>
                                                    <input type="text" name="location" placeholder="City, Country">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <label><i class="fa-solid fa-calendar-day field-icon"></i> Start Date</label>
                                                    <input type="date" name="start_date">
                                                </div>
                                                <div class="form-group">
                                                    <label><i class="fa-solid fa-calendar-check field-icon"></i> End Date</label>
                                                    <input type="date" name="end_date">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="checkbox-label">
                                                    <input type="checkbox" id="edu_is_current" name="is_current" value="1">
                                                    Currently studying here
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label><i class="fa-solid fa-align-left field-icon"></i> Description</label>
                                                <textarea name="description" rows="3" placeholder="Highlights, GPA (optional), relevant courses…"></textarea>
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn-primary">Add education</button>
                                            </div>
                                        </form>
                                        @if($user->educations->isNotEmpty())
                                            <p class="sort-hint">Drag ⋮⋮ to reorder education entries.</p>
                                        @endif
                                        <div class="sortable-list" id="education-list" data-reorder-url="{{ route('dashboard.education.reorder') }}">
                                            @forelse($user->educations as $edu)
                                                @include('dashboard.partials.education-item', ['edu' => $edu])
                                            @empty
                                                <p class="empty-state">No education added yet.</p>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <div class="content-right">
                                    <div class="tips-card">
                                        <h3 class="tips-title"><i class="fa-solid fa-lightbulb"></i> Tips</h3>
                                        <ul class="tips-list">
                                            <li class="tip-item">
                                                <span class="tip-icon">✓</span>
                                                <span class="tip-text">Include relevant coursework and achievements.</span>
                                            </li>
                                            <li class="tip-item">
                                                <span class="tip-icon">✓</span>
                                                <span class="tip-text">List education in reverse chronological order.</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @break

                        @case('testimonials')
                            <!-- TESTIMONIALS SECTION -->
                            <div class="content-two-column">
                                <div class="content-left">
                                    <div class="content-card">
                                        <div class="content-card-header">
                                            <h2 class="content-card-title">Testimonials</h2>
                                            <p class="content-card-subtitle">Add testimonials from clients or colleagues.</p>
                                        </div>
                                        <form method="POST" action="{{ route('dashboard.testimonial.store') }}" class="portal-add-form ajax-form" data-success-message="Testimonial added successfully!" data-reload="true">
                                            @csrf
                                            <div class="portal-form-grid">
                                                <div class="portal-field">
                                                    <label><i class="fa-solid fa-user field-icon"></i> Name</label>
                                                    <input type="text" name="name" required>
                                                </div>
                                                <div class="portal-field">
                                                    <label><i class="fa-solid fa-briefcase field-icon"></i> Role</label>
                                                    <input type="text" name="role">
                                                </div>
                                                <div class="portal-field">
                                                    <label><i class="fa-solid fa-building field-icon"></i> Company</label>
                                                    <input type="text" name="company">
                                                </div>
                                                <div class="portal-field">
                                                    <label><i class="fa-solid fa-star field-icon"></i> Rating (1-5)</label>
                                                    <input type="number" name="rating" min="1" max="5" value="5">
                                                </div>
                                            </div>
                                            <div class="portal-field portal-field-spaced">
                                                <label><i class="fa-solid fa-message field-icon"></i> Message</label>
                                                <textarea name="message" rows="3" required></textarea>
                                            </div>
                                            <button type="submit" class="portal-btn-primary">Add Testimonial</button>
                                        </form>
                                        @if($user->testimonials->isNotEmpty())
                                            <p class="portal-sort-hint">Drag ⋮⋮ to reorder testimonials.</p>
                                        @endif
                                        <div class="sortable-list" id="testimonial-list" data-reorder-url="{{ route('dashboard.testimonial.reorder') }}">
                                            @forelse($user->testimonials as $testimonial)
                                                @include('dashboard.partials.testimonial-item', ['testimonial' => $testimonial])
                                            @empty
                                                <p class="portal-empty">No testimonials added yet.</p>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <div class="content-right">
                                    <div class="tips-card">
                                        <h3 class="tips-title"><i class="fa-solid fa-lightbulb"></i> Tips</h3>
                                        <ul class="tips-list">
                                            <li class="tip-item">
                                                <span class="tip-icon">✓</span>
                                                <span class="tip-text">Ask clients or colleagues for testimonials.</span>
                                            </li>
                                            <li class="tip-item">
                                                <span class="tip-icon">✓</span>
                                                <span class="tip-text">Include ratings to show credibility.</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @break

                        @case('certifications')
                            <!-- CERTIFICATIONS SECTION -->
                            <div class="content-two-column">
                                <div class="content-left">
                                    <div class="content-card">
                                        <div class="content-card-header">
                                            <h2 class="content-card-title">Certifications</h2>
                                            <p class="content-card-subtitle">Showcase your professional certifications.</p>
                                        </div>
                                        <form method="POST" action="{{ route('dashboard.certifications.store') }}" enctype="multipart/form-data" class="portal-add-form ajax-form" data-success-message="Certification added successfully!" data-reload="true">
                                            @csrf
                                            <div class="portal-form-grid">
                                                <div class="portal-field">
                                                    <label><i class="fa-solid fa-image field-icon"></i> Image</label>
                                                    <input type="file" name="image" accept="image/*" required>
                                                </div>
                                                <div class="portal-field">
                                                    <label><i class="fa-solid fa-certificate field-icon"></i> Title</label>
                                                    <input type="text" name="title" required>
                                                </div>
                                                <div class="portal-field">
                                                    <label><i class="fa-solid fa-building field-icon"></i> Organization</label>
                                                    <input type="text" name="organization" required>
                                                </div>
                                                <div class="portal-field">
                                                    <label><i class="fa-solid fa-calendar-day field-icon"></i> Issue Date</label>
                                                    <input type="date" name="issue_date">
                                                </div>
                                                <div class="portal-field">
                                                    <label><i class="fa-solid fa-link field-icon"></i> Credential URL</label>
                                                    <input type="url" name="credential_url" placeholder="https://">
                                                </div>
                                            </div>
                                            <div class="portal-field portal-field-spaced">
                                                <label><i class="fa-solid fa-align-left field-icon"></i> Description</label>
                                                <textarea name="description" rows="3"></textarea>
                                            </div>
                                            <button type="submit" class="portal-btn-primary">Add Certification</button>
                                        </form>
                                        @if($user->certifications->isNotEmpty())
                                            <p class="portal-sort-hint">Drag ⋮⋮ to reorder certifications.</p>
                                        @endif
                                        <div class="sortable-list" id="certifications-list" data-reorder-url="{{ route('dashboard.certifications.reorder') }}">
                                            @forelse($user->certifications->sortBy('sort_order') as $cert)
                                                @include('dashboard.partials.certification-item', ['cert' => $cert])
                                            @empty
                                                <p class="portal-empty">No certifications found.</p>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <div class="content-right">
                                    <div class="tips-card">
                                        <h3 class="tips-title"><i class="fa-solid fa-lightbulb"></i> Tips</h3>
                                        <ul class="tips-list">
                                            <li class="tip-item">
                                                <span class="tip-icon">✓</span>
                                                <span class="tip-text">Showcase certifications relevant to your career.</span>
                                            </li>
                                            <li class="tip-item">
                                                <span class="tip-icon">✓</span>
                                                <span class="tip-text">Include credential URLs for verification.</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @break

                        @case('volunteers')
                            <!-- VOLUNTEERS SECTION -->
                            <div class="content-two-column">
                                <div class="content-left">
                                    <div class="content-card">
                                        <div class="content-card-header">
                                            <h2 class="content-card-title">Volunteer Experience</h2>
                                            <p class="content-card-subtitle">Add your volunteer work and community service.</p>
                                        </div>
                                        <form method="POST" action="{{ route('dashboard.volunteers.store') }}" class="portal-add-form ajax-form" data-success-message="Volunteer experience added successfully!" data-reload="true">
                                            @csrf
                                            <div class="portal-form-grid">
                                                <div class="portal-field">
                                                    <label><i class="fa-solid fa-hand-holding-heart field-icon"></i> Organization</label>
                                                    <input type="text" name="organization_name" placeholder="e.g. Saylani Welfare" required>
                                                </div>
                                                <div class="portal-field">
                                                    <label><i class="fa-solid fa-user-tie field-icon"></i> Role</label>
                                                    <input type="text" name="role" placeholder="Volunteer, Mentor..." required>
                                                </div>
                                                <div class="portal-field">
                                                    <label><i class="fa-solid fa-location-dot field-icon"></i> Location</label>
                                                    <input type="text" name="location" placeholder="City, Country">
                                                </div>
                                                <div class="portal-field">
                                                    <label><i class="fa-solid fa-calendar-day field-icon"></i> Start Date</label>
                                                    <input type="date" name="start_date">
                                                </div>
                                                <div class="portal-field">
                                                    <label><i class="fa-solid fa-calendar-check field-icon"></i> End Date</label>
                                                    <input type="date" name="end_date">
                                                </div>
                                            </div>
                                            <div class="portal-check">
                                                <input type="checkbox" id="volunteer_current" name="currently_volunteering" value="1">
                                                <label for="volunteer_current">Currently volunteering here</label>
                                            </div>
                                            <div class="portal-field portal-field-spaced">
                                                <label><i class="fa-solid fa-align-left field-icon"></i> Description</label>
                                                <textarea name="description" rows="3" placeholder="Describe your volunteer work..."></textarea>
                                            </div>
                                            <button type="submit" class="portal-btn-primary">Add Volunteer Experience</button>
                                        </form>
                                        @if($user->volunteers->isNotEmpty())
                                            <p class="portal-sort-hint">Drag ⋮⋮ to reorder volunteer experiences.</p>
                                        @endif
                                        <div class="sortable-list" id="volunteer-list" data-reorder-url="{{ route('dashboard.volunteers.reorder') }}">
                                            @forelse($user->volunteers as $volunteer)
                                                @include('dashboard.partials.volunteer-item', ['volunteer' => $volunteer])
                                            @empty
                                                <p class="portal-empty">No volunteer experience added yet.</p>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <div class="content-right">
                                    <div class="tips-card">
                                        <h3 class="tips-title"><i class="fa-solid fa-lightbulb"></i> Tips</h3>
                                        <ul class="tips-list">
                                            <li class="tip-item">
                                                <span class="tip-icon">✓</span>
                                                <span class="tip-text">Highlight volunteer work that shows leadership.</span>
                                            </li>
                                            <li class="tip-item">
                                                <span class="tip-icon">✓</span>
                                                <span class="tip-text">Include dates to show your commitment.</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @break

                        @case('achievements')
                            <!-- ACHIEVEMENTS SECTION -->
                            <div class="content-two-column">
                                <div class="content-left">
                                    <div class="content-card">
                                        <div class="content-card-header">
                                            <h2 class="content-card-title">Achievements</h2>
                                            <p class="content-card-subtitle">Showcase your notable achievements and awards.</p>
                                        </div>
                                        <form method="POST" action="{{ route('dashboard.achievements.store') }}" class="portal-add-form ajax-form" data-success-message="Achievement added successfully!" data-reload="true">
                                            @csrf
                                            <div class="portal-form-grid">
                                                <div class="portal-field">
                                                    <label><i class="fa-solid fa-trophy field-icon"></i> Title</label>
                                                    <input type="text" name="title" placeholder="Achievement title" required>
                                                </div>
                                                <div class="portal-field">
                                                    <label><i class="fa-solid fa-building field-icon"></i> Organization</label>
                                                    <input type="text" name="organization" placeholder="Organization">
                                                </div>
                                                <div class="portal-field">
                                                    <label><i class="fa-solid fa-calendar-day field-icon"></i> Achievement Date</label>
                                                    <input type="date" name="achievement_date">
                                                </div>
                                            </div>
                                            <div class="portal-field portal-field-spaced">
                                                <label><i class="fa-solid fa-align-left field-icon"></i> Description</label>
                                                <textarea name="description" rows="3" placeholder="Achievement details..."></textarea>
                                            </div>
                                            <button type="submit" class="portal-btn-primary">Add Achievement</button>
                                        </form>
                                        @if($user->achievements->isNotEmpty())
                                            <p class="portal-sort-hint">Drag ⋮⋮ to reorder achievements.</p>
                                        @endif
                                        <div class="sortable-list" id="achievement-list" data-reorder-url="{{ route('dashboard.achievements.reorder') }}">
                                            @forelse($user->achievements as $achievement)
                                                @include('dashboard.partials.achievement-item', ['achievement' => $achievement])
                                            @empty
                                                <p class="portal-empty">No achievements added yet.</p>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <div class="content-right">
                                    <div class="tips-card">
                                        <h3 class="tips-title"><i class="fa-solid fa-lightbulb"></i> Tips</h3>
                                        <ul class="tips-list">
                                            <li class="tip-item">
                                                <span class="tip-icon">✓</span>
                                                <span class="tip-text">Highlight awards and recognitions.</span>
                                            </li>
                                            <li class="tip-item">
                                                <span class="tip-icon">✓</span>
                                                <span class="tip-text">Include dates to show relevance.</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @break

                        @case('services')
                            <!-- SERVICES SECTION -->
                            <div class="content-two-column">
                                <div class="content-left">
                                    <div class="content-card">
                                        <div class="content-card-header">
                                            <h2 class="content-card-title">Services</h2>
                                            <p class="content-card-subtitle">List the services you offer.</p>
                                        </div>
                                        <form method="POST" action="{{ route('dashboard.service.store') }}" class="portal-add-form ajax-form" data-success-message="Service added successfully!" data-reload="true">
                                            @csrf
                                            <div class="portal-form-grid">
                                                <div class="portal-field">
                                                    <label><i class="fa-solid fa-icons field-icon"></i> Icon</label>
                                                    <input type="text" name="icon" placeholder="e.g. 💻 or fa-code">
                                                </div>
                                                <div class="portal-field">
                                                    <label><i class="fa-solid fa-heading field-icon"></i> Title</label>
                                                    <input type="text" name="title" required>
                                                </div>
                                            </div>
                                            <div class="portal-field portal-field-spaced">
                                                <label><i class="fa-solid fa-align-left field-icon"></i> Description</label>
                                                <textarea name="description" rows="3"></textarea>
                                            </div>
                                            <button type="submit" class="portal-btn-primary">Add Service</button>
                                        </form>
                                        @if($user->services->isNotEmpty())
                                            <p class="portal-sort-hint">Drag ⋮⋮ to reorder services.</p>
                                        @endif
                                        <div class="sortable-list" id="services-list" data-reorder-url="{{ route('dashboard.service.reorder') }}">
                                            @forelse($user->services->sortBy('sort_order') as $service)
                                                @include('dashboard.partials.service-item', ['service' => $service])
                                            @empty
                                                <p class="portal-empty">No services found.</p>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <div class="content-right">
                                    <div class="tips-card">
                                        <h3 class="tips-title"><i class="fa-solid fa-lightbulb"></i> Tips</h3>
                                        <ul class="tips-list">
                                            <li class="tip-item">
                                                <span class="tip-icon">✓</span>
                                                <span class="tip-text">List services that you actively offer.</span>
                                            </li>
                                            <li class="tip-item">
                                                <span class="tip-icon">✓</span>
                                                <span class="tip-text">Use icons to make services visually appealing.</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @break

                        @case('gallery')
                            <!-- GALLERY SECTION -->
                            <div class="content-two-column">
                                <div class="content-left">
                                    <div class="content-card">
                                        <div class="content-card-header">
                                            <h2 class="content-card-title">Gallery</h2>
                                            <p class="content-card-subtitle">Showcase your work, projects, and moments through images.</p>
                                        </div>
                                        <form method="POST" action="{{ route('dashboard.gallery.store') }}" enctype="multipart/form-data" class="portal-add-form ajax-form" data-success-message="Gallery image added successfully!" data-reload="true">
                                            @csrf
                                            <div class="portal-form-grid">
                                                <div class="portal-field">
                                                    <label><i class="fa-solid fa-image field-icon"></i> Image</label>
                                                    <input type="file" name="image" accept="image/*" required>
                                                </div>
                                                <div class="portal-field">
                                                    <label><i class="fa-solid fa-heading field-icon"></i> Title</label>
                                                    <input type="text" name="title" placeholder="Image title" required>
                                                </div>
                                                <div class="portal-field" style="grid-column: 1 / -1;">
                                                    <label><i class="fa-solid fa-align-left field-icon"></i> Description</label>
                                                    <textarea name="description" rows="2" placeholder="Brief description..."></textarea>
                                                </div>
                                            </div>
                                            <button type="submit" class="portal-btn-primary">
                                                <i class="fa-solid fa-plus"></i> Add Image
                                            </button>
                                        </form>

                                        @if($user->galleries->isNotEmpty())
                                            <p class="portal-sort-hint"><i class="fa-solid fa-arrows-up-down"></i> Drag ⋮⋮ to reorder gallery images.</p>
                                        @endif
                                        <div class="sortable-list" id="gallery-list" data-reorder-url="{{ route('dashboard.gallery.reorder') }}" style="margin-top:20px;">
                                            @forelse($user->galleries->sortBy('sort_order') as $gallery)
                                                @include('dashboard.partials.gallery-item', ['gallery' => $gallery])
                                            @empty
                                                <div class="portal-empty">
                                                    <i class="fa-regular fa-images" style="font-size: 32px; display: block; margin-bottom: 12px; color: var(--gray-300);"></i>
                                                    No gallery images added yet. Upload your first image above!
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <div class="content-right">
                                    <div class="tips-card">
                                        <h3 class="tips-title"><i class="fa-solid fa-lightbulb"></i> Tips</h3>
                                        <ul class="tips-list">
                                            <li class="tip-item">
                                                <span class="tip-icon">✓</span>
                                                <span class="tip-text">Upload high-quality images (JPG, PNG, or WEBP).</span>
                                            </li>
                                            <li class="tip-item">
                                                <span class="tip-icon">✓</span>
                                                <span class="tip-text">Add descriptive titles to help visitors understand your work.</span>
                                            </li>
                                            <li class="tip-item">
                                                <span class="tip-icon">✓</span>
                                                <span class="tip-text">Keep descriptions short but meaningful.</span>
                                            </li>
                                            <li class="tip-item">
                                                <span class="tip-icon">✓</span>
                                                <span class="tip-text">Drag and drop to reorder images for better presentation.</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @break

                        @case('projects')
                            <!-- PROJECTS SECTION -->
                            <div class="content-two-column">
                                <div class="content-left">
                                    <div class="content-card">
                                        <div class="content-card-header">
                                            <h2 class="content-card-title">Projects</h2>
                                            <p class="content-card-subtitle">Showcase your projects and portfolio work.</p>
                                        </div>
                                        <form method="POST" action="{{ route('dashboard.projects.store') }}" enctype="multipart/form-data" class="ajax-form" data-success-message="Project added successfully!">
                                            @csrf
                                            <div class="form-group">
                                                <label><i class="fa-solid fa-heading field-icon"></i> Title</label>
                                                <input type="text" name="title" placeholder="Project title" required>
                                            </div>
                                            <div class="form-group">
                                                <label><i class="fa-solid fa-align-left field-icon"></i> Description</label>
                                                <textarea name="short_description" placeholder="Short description" rows="2"></textarea>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <label><i class="fa-solid fa-link field-icon"></i> Project URL</label>
                                                    <input type="url" name="project_url" placeholder="https://">
                                                </div>
                                                <div class="form-group">
                                                    <label><i class="fa-solid fa-image field-icon"></i> Image</label>
                                                    <input type="file" name="project_image" accept="image/*">
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn-primary">Add project</button>
                                            </div>
                                        </form>
                                        <div class="projects-grid" id="projects-list">
                                            @foreach($user->projects as $project)
                                                <div class="project-card" data-project-id="{{ $project->id }}">
                                                    @if($project->project_image)
                                                        <img src="{{ asset('storage/' . $project->project_image) }}" alt="{{ $project->title }}" class="project-thumb">
                                                    @endif
                                                    <h4>{{ $project->title }}</h4>
                                                    <p class="meta">{{ $project->short_description }}</p>
                                                    @if($project->project_url)
                                                        <a href="{{ $project->project_url }}" target="_blank" class="link-btn">View project</a>
                                                    @endif
                                                    <div class="item-actions">
                                                        <form method="POST" action="{{ route('dashboard.projects.delete', $project->id) }}" class="inline ajax-form" data-success-message="Project deleted successfully!">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="link-btn danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="content-right">
                                    <div class="tips-card">
                                        <h3 class="tips-title"><i class="fa-solid fa-lightbulb"></i> Tips</h3>
                                        <ul class="tips-list">
                                            <li class="tip-item">
                                                <span class="tip-icon">✓</span>
                                                <span class="tip-text">Showcase your best and most recent projects.</span>
                                            </li>
                                            <li class="tip-item">
                                                <span class="tip-icon">✓</span>
                                                <span class="tip-text">Include live demo links when possible.</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @break

                        @case('live_link')
                            <!-- LIVE LINK SECTION -->
                            <div class="content-two-column">
                                <div class="content-left">
                                    <div class="content-card">
                                        <div class="content-card-header">
                                            <h2 class="content-card-title">Live Link</h2>
                                            <p class="content-card-subtitle">Add a live demo or website link.</p>
                                        </div>
                                        <form method="POST" action="{{ route('dashboard.profile.update') }}" class="ajax-form" data-success-message="Live link updated successfully!">
                                            @csrf
                                            <div class="form-group">
                                                <label><i class="fa-solid fa-link field-icon"></i> Live Demo URL</label>
                                                <input type="url" name="live_link" value="{{ $user->profile->live_link ?? '' }}" placeholder="https://your-site.com">
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="content-right">
                                    <div class="tips-card">
                                        <h3 class="tips-title"><i class="fa-solid fa-lightbulb"></i> Tips</h3>
                                        <ul class="tips-list">
                                            <li class="tip-item">
                                                <span class="tip-icon">✓</span>
                                                <span class="tip-text">Add a link to your live portfolio or website.</span>
                                            </li>
                                            <li class="tip-item">
                                                <span class="tip-icon">✓</span>
                                                <span class="tip-text">Make sure the link is working and accessible.</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @break

                        @default
                            <div class="content-card">
                                <div class="content-card-header">
                                    <h2 class="content-card-title">{{ $item->block->name }}</h2>
                                    <p class="content-card-subtitle">Content for {{ $item->block->name }} section.</p>
                                </div>
                                <p>Content for {{ $item->block->name }} section.</p>
                            </div>
                    @endswitch
                </div>
            @endforeach
        </div>
    </div>

    <!-- Add Block Modal -->
    <div id="addBlockModal" class="portal-modal" style="display: none;">
        <div class="portal-modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-plus-circle"></i> Add New Block</h3>
                <button onclick="closeAddBlockModal()" class="modal-close">&times;</button>
            </div>
            <form id="addBlockForm" method="POST" action="{{ route('dashboard.blocks.store') }}" class="ajax-form" data-success-message="Block added successfully!" data-reload="true">
                @csrf
                <div class="form-group">
                    <label><i class="fa-solid fa-layer-group field-icon"></i> Block Type</label>
                    <select name="block_id" id="blockSelect" required>
                        <option value="">Select a block type...</option>
                        @foreach($availableBlocks ?? [] as $block)
                            <option value="{{ $block->id }}" data-icon="{{ $block->icon }}" data-slug="{{ $block->slug }}">
                                @if($block->icon) <i class="{{ $block->icon }}"></i> @endif
                                {{ $block->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div id="blockPreview" style="display: none; background: #f8fafc; border-radius: 10px; padding: 16px; margin: 16px 0; border: 2px dashed #e2e8f0;">
                    <p>
                        <span id="previewIcon"></span>
                        <span id="previewName" style="font-weight: 600;"></span>
                    </p>
                    <p style="font-size: 13px; color: #94a3b8;">Slug: <span id="previewSlug"></span></p>
                </div>
                <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">
                    <i class="fas fa-plus"></i> Add Block
                </button>
            </form>
        </div>
    </div>

    <!-- Delete Block Modal -->
    <div id="deleteBlockModal" class="portal-modal" style="display: none;">
        <div class="portal-modal-content" style="max-width: 400px;">
            <div class="modal-header">
                <h3><i class="fas fa-exclamation-triangle" style="color: #ef4444;"></i> Remove Block</h3>
                <button onclick="closeDeleteBlockModal()" class="modal-close">&times;</button>
            </div>
            <p style="margin-bottom: 24px; color: #475569;">
                Are you sure you want to remove the "<strong id="deleteBlockName"></strong>" block?
                This will hide it from your portfolio, but your data will be preserved.
            </p>
            <form id="deleteBlockForm" method="POST" action="" class="ajax-form" data-success-message="Block removed successfully!" data-reload="true">
                @csrf
                @method('DELETE')
                <div style="display: flex; gap: 12px; justify-content: flex-end;">
                    <button type="button" onclick="closeDeleteBlockModal()" class="btn-secondary">Cancel</button>
                    <button type="submit" class="btn-danger">
                        <i class="fas fa-trash"></i> Remove Block
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('portal-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';
            const flashWrapper = document.getElementById('flash-message');
            const flashInner = document.getElementById('flash-message-inner');

            function showFlash(message, type = 'success') {
                if (!flashWrapper || !flashInner) return;
                flashInner.textContent = message;
                flashWrapper.className = 'portal-flash ' + (type === 'success' ? 'success' : 'error');
                flashWrapper.classList.remove('hidden');
            }

            function clearErrors(form) {
                form.querySelectorAll('.error-message').forEach(el => el.remove());
                form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            }

            function showError(input, message) {
                input.classList.add('is-invalid');
                let existing = input.parentElement.querySelector('.error-message');
                if (existing) existing.remove();

                const error = document.createElement('div');
                error.className = 'error-message';
                error.style.color = '#dc2626';
                error.style.fontSize = '13px';
                error.style.marginTop = '4px';
                error.innerText = message;
                input.insertAdjacentElement('afterend', error);
            }

            function validateForm(form) {
                clearErrors(form);
                let isValid = true;
                let firstInvalid = null;

                form.querySelectorAll('input, textarea, select').forEach(input => {
                    if (input.type === 'hidden') return;
                    const value = (input.value || '').trim();

                    if (input.hasAttribute('required') && value === '' && input.type !== 'file') {
                        showError(input, 'This field is required.');
                        isValid = false;
                        if (!firstInvalid) firstInvalid = input;
                        return;
                    }
                    if (input.hasAttribute('required') && input.type === 'file' && input.files.length === 0) {
                        showError(input, 'Please choose a file.');
                        isValid = false;
                        if (!firstInvalid) firstInvalid = input;
                        return;
                    }

                    if (value === '') return;

                    if (input.type === 'email') {
                        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailPattern.test(value)) {
                            showError(input, 'Please enter a valid email address.');
                            isValid = false;
                            if (!firstInvalid) firstInvalid = input;
                            return;
                        }
                    }

                    if (input.type === 'url') {
                        try {
                            const parsed = new URL(value);
                            if (!/^https?:$/.test(parsed.protocol)) throw new Error('bad protocol');
                        } catch (e) {
                            showError(input, 'Please enter a valid URL (starting with https://).');
                            isValid = false;
                            if (!firstInvalid) firstInvalid = input;
                            return;
                        }
                    }

                    if (input.type === 'number') {
                        const num = parseFloat(value);
                        const min = input.hasAttribute('min') ? parseFloat(input.min) : null;
                        const max = input.hasAttribute('max') ? parseFloat(input.max) : null;
                        if (isNaN(num) || (min !== null && num < min) || (max !== null && num > max)) {
                            showError(input, `Please enter a number between ${min ?? '–'} and ${max ?? '–'}.`);
                            isValid = false;
                            if (!firstInvalid) firstInvalid = input;
                            return;
                        }
                    }
                });

                if (firstInvalid) {
                    firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstInvalid.focus({ preventScroll: true });
                }

                return isValid;
            }

            document.addEventListener('input', (e) => {
                if (e.target.matches('input, textarea, select')) {
                    const field = e.target;
                    if (field.classList.contains('is-invalid')) {
                        field.classList.remove('is-invalid');
                        const err = field.parentElement.querySelector('.error-message');
                        if (err) err.remove();
                    }
                }
            });

            document.querySelectorAll('form.ajax-form').forEach(form => {
                form.setAttribute('novalidate', '');

                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    if (!validateForm(form)) {
                        return;
                    }

                    const submitButton = form.querySelector('button[type="submit"]');
                    const originalText = submitButton ? submitButton.textContent : null;
                    if (submitButton) {
                        submitButton.disabled = true;
                        submitButton.textContent = 'Saving...';
                    }

                    const formData = new FormData(form);

                    fetch(form.getAttribute('action'), {
                        method: (form.getAttribute('method') || 'POST').toUpperCase(),
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            ...(csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {})
                        },
                        body: formData
                    }).then(async response => {
                        let data = null;
                        try {
                            data = await response.json();
                        } catch (e) {}

                        if (response.ok) {
                            const msg = (data && data.message) || form.getAttribute('data-success-message') || 'Saved successfully!';
                            showFlash(msg, 'success');

                            const shouldReload = form.getAttribute('data-reload') === 'true' || (data && data.reload);
                            if (shouldReload) {
                                setTimeout(() => window.location.reload(), 700);
                            } else if (!form.classList.contains('portal-inline-edit')) {
                                form.reset();
                                clearErrors(form);
                            } else {
                                // For inline edit forms, close the edit mode on success
                                const parentItem = form.closest('.portal-sortable-item');
                                if (parentItem) {
                                    const editForm = parentItem.querySelector('.portal-inline-edit');
                                    if (editForm) {
                                        editForm.classList.add('hidden');
                                    }
                                }
                            }
                        } else {
                            let errorMsg = 'Something went wrong. Please try again.';
                            if (data) {
                                if (data.message) {
                                    errorMsg = data.message;
                                } else if (data.errors) {
                                    const firstErrorField = Object.keys(data.errors)[0];
                                    if (firstErrorField && data.errors[firstErrorField][0]) {
                                        errorMsg = data.errors[firstErrorField][0];
                                    }
                                    Object.keys(data.errors).forEach(fieldName => {
                                        const input = form.querySelector(`[name="${fieldName}"]`);
                                        if (input && data.errors[fieldName][0]) {
                                            showError(input, data.errors[fieldName][0]);
                                        }
                                    });
                                }
                            }
                            showFlash(errorMsg, 'error');
                        }
                    }).catch(() => {
                        showFlash('Network error. Please check your connection and try again.', 'error');
                    }).finally(() => {
                        if (submitButton) {
                            submitButton.disabled = false;
                            submitButton.textContent = originalText;
                        }
                    });
                });
            });

            // Initialize sortable lists
            function initSortableList(listEl) {
                if (!listEl || !listEl.dataset.reorderUrl) return;

                const url = listEl.dataset.reorderUrl;
                let draggedEl = null;

                const getItems = () => [...listEl.querySelectorAll(':scope > .portal-sortable-item')];

                const clearDragState = () => {
                    getItems().forEach(i => i.classList.remove('is-drag-over', 'is-dragging'));
                    draggedEl = null;
                };

                listEl.querySelectorAll('.portal-drag-handle').forEach(handle => {
                    handle.addEventListener('dragstart', (e) => {
                        draggedEl = handle.closest('.portal-sortable-item');
                        if (!draggedEl) return;

                        draggedEl.classList.add('is-dragging');
                        e.dataTransfer.effectAllowed = 'move';
                        e.dataTransfer.setData('text/plain', String(
                            draggedEl.dataset.experienceId ||
                            draggedEl.dataset.educationId ||
                            draggedEl.dataset.testimonialId ||
                            draggedEl.dataset.galleryId ||
                            draggedEl.dataset.certificationId ||
                            draggedEl.dataset.volunteerId ||
                            draggedEl.dataset.achievementId ||
                            draggedEl.dataset.serviceId || ''
                        ));
                    });

                    handle.addEventListener('dragend', clearDragState);
                });

                const moveDraggedBefore = (targetItem) => {
                    if (!draggedEl || !targetItem || draggedEl === targetItem) return false;

                    const items = getItems();
                    const from = items.indexOf(draggedEl);
                    const to = items.indexOf(targetItem);
                    if (from < 0 || to < 0) return false;

                    if (from < to) {
                        targetItem.after(draggedEl);
                    } else {
                        targetItem.before(draggedEl);
                    }

                    return true;
                };

                getItems().forEach(item => {
                    item.addEventListener('dragover', (e) => {
                        e.preventDefault();
                        e.dataTransfer.dropEffect = 'move';
                        if (draggedEl && draggedEl !== item) {
                            item.classList.add('is-drag-over');
                        }
                    });

                    item.addEventListener('dragleave', (e) => {
                        if (!item.contains(e.relatedTarget)) {
                            item.classList.remove('is-drag-over');
                        }
                    });

                    item.addEventListener('drop', (e) => {
                        e.preventDefault();
                        e.stopPropagation();
                        item.classList.remove('is-drag-over');
                        if (moveDraggedBefore(item)) {
                            saveSortOrder(listEl, url);
                        }
                        clearDragState();
                    });
                });

                listEl.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    e.dataTransfer.dropEffect = 'move';
                });

                listEl.addEventListener('drop', (e) => {
                    if (e.target !== listEl) return;
                    e.preventDefault();
                    const items = getItems();
                    const last = items[items.length - 1];
                    if (draggedEl && last && draggedEl !== last) {
                        last.after(draggedEl);
                        saveSortOrder(listEl, url);
                    }
                    clearDragState();
                });
            }

            function saveSortOrder(listEl, url) {
                const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
                const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';
                const order = [...listEl.querySelectorAll(':scope > .portal-sortable-item')].map(el => {
                    return parseInt(
                        el.dataset.experienceId ||
                        el.dataset.educationId ||
                        el.dataset.testimonialId ||
                        el.dataset.galleryId ||
                        el.dataset.certificationId ||
                        el.dataset.volunteerId ||
                        el.dataset.achievementId ||
                        el.dataset.serviceId, 10
                    );
                }).filter(id => !isNaN(id));

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        ...(csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {})
                    },
                    body: JSON.stringify({ order })
                }).then(async (res) => {
                    let data = {};
                    try { data = await res.json(); } catch (e) {}

                    const flashWrapper = document.getElementById('flash-message');
                    const flashInner = document.getElementById('flash-message-inner');
                    if (!flashWrapper || !flashInner) return;

                    if (res.ok) {
                        flashInner.textContent = data.message || 'Order saved.';
                        flashWrapper.className = 'portal-flash success';
                    } else {
                        flashInner.textContent = data.message || 'Could not save order.';
                        flashWrapper.className = 'portal-flash error';
                    }
                    flashWrapper.classList.remove('hidden');
                }).catch(() => {
                    const flashWrapper = document.getElementById('flash-message');
                    const flashInner = document.getElementById('flash-message-inner');
                    if (flashWrapper && flashInner) {
                        flashInner.textContent = 'Could not save order. Please try again.';
                        flashWrapper.className = 'portal-flash error';
                        flashWrapper.classList.remove('hidden');
                    }
                });
            }

            // Initialize all sortable lists
            const sortableLists = [
                'experience-list',
                'education-list',
                'testimonial-list',
                'gallery-list',
                'certifications-list',
                'volunteer-list',
                'achievement-list',
                'services-list'
            ];

            sortableLists.forEach(id => {
                const el = document.getElementById(id);
                if (el) initSortableList(el);
            });

            // Show section function
            window.showSection = function(event, section) {
                if (event && event.preventDefault) event.preventDefault();

                document.querySelectorAll('.section-content').forEach(el => el.classList.add('hidden'));
                document.querySelectorAll('.portal-tab').forEach(el => el.classList.remove('is-active'));

                const sectionEl = document.getElementById(section + '-section');
                if (sectionEl) {
                    sectionEl.classList.remove('hidden');
                }

                let clickedTab = null;
                if (event && event.target) {
                    clickedTab = event.target.closest('.portal-tab');
                }
                if (clickedTab) {
                    clickedTab.classList.add('is-active');
                } else {
                    const tab = document.querySelector(`.portal-tab[data-section="${section}"]`);
                    if (tab) tab.classList.add('is-active');
                }

                if (history && history.replaceState) {
                    history.replaceState(null, '', '#' + section);
                }
            };

            // Handle initial hash
            const initialHash = window.location.hash.replace('#', '');
            if (initialHash) {
                const tab = document.querySelector(`.portal-tab[data-section="${initialHash}"]`);
                if (tab) {
                    tab.click();
                }
            }

            // Profile image upload preview
            document.querySelectorAll('.file-input').forEach(input => {
                input.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        const wrapper = this.closest('.profile-image-field') || this.closest('form');
                        const previewWrapper = wrapper ? wrapper.querySelector('.profile-preview-wrapper') : null;

                        if (previewWrapper) {
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                let img = previewWrapper.querySelector('.profile-preview-image');
                                const placeholder = previewWrapper.querySelector('.profile-preview-placeholder');
                                if (!img) {
                                    img = document.createElement('img');
                                    img.className = 'profile-preview-image';
                                    previewWrapper.prepend(img);
                                }
                                img.src = e.target.result;
                                if (placeholder) placeholder.remove();
                            };
                            reader.readAsDataURL(this.files[0]);
                        }

                        const form = this.closest('form');
                        if (form) {
                            form.requestSubmit ? form.requestSubmit() : form.submit();
                        }
                    }
                });
            });

            // Block select preview
            const blockSelect = document.getElementById('blockSelect');
            if (blockSelect) {
                blockSelect.addEventListener('change', function() {
                    const preview = document.getElementById('blockPreview');
                    const selectedOption = this.options[this.selectedIndex];

                    if (this.value) {
                        preview.style.display = 'block';
                        document.getElementById('previewIcon').innerHTML = selectedOption.dataset.icon ?
                            '<i class="' + selectedOption.dataset.icon + '"></i> ' : '';
                        document.getElementById('previewName').textContent = selectedOption.textContent.trim();
                        document.getElementById('previewSlug').textContent = selectedOption.dataset.slug || '';
                    } else {
                        preview.style.display = 'none';
                    }
                });
            }
        });

        // Modal functions
        function openAddBlockModal() {
            document.getElementById('addBlockModal').style.display = 'flex';
        }

        function closeAddBlockModal() {
            document.getElementById('addBlockModal').style.display = 'none';
        }

        let deleteBlockId = null;

        function confirmDeleteBlock(id, name) {
            deleteBlockId = id;
            document.getElementById('deleteBlockName').textContent = name;
            document.getElementById('deleteBlockModal').style.display = 'flex';
            document.getElementById('deleteBlockForm').action = '/dashboard/blocks/' + id + '/delete';
        }

        function closeDeleteBlockModal() {
            document.getElementById('deleteBlockModal').style.display = 'none';
            deleteBlockId = null;
        }

        document.addEventListener('click', function(e) {
            const addModal = document.getElementById('addBlockModal');
            const deleteModal = document.getElementById('deleteBlockModal');

            if (e.target === addModal) {
                closeAddBlockModal();
            }
            if (e.target === deleteModal) {
                closeDeleteBlockModal();
            }
        });

        // Toggle inline edit form
        window.toggleItemEdit = function(type, id) {
            const form = document.getElementById(type + '-edit-' + id);
            if (form) {
                form.classList.toggle('hidden');
                if (!form.classList.contains('hidden')) {
                    setTimeout(() => {
                        form.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }, 100);
                }
            } else {
                console.warn('Edit form not found for:', type, id);
            }
        };

        // Edit functions for various sections
        function editSkill(id, name, level) {
            const newName = prompt('Edit skill name:', name);
            if (newName === null) return;

            const newLevel = prompt('Edit skill level:', level || '');
            if (newLevel === null) return;

            const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';

            const formData = new FormData();
            formData.append('name', newName);
            formData.append('level', newLevel);
            formData.append('_method', 'PUT');

            fetch(`/dashboard/skills/${id}`, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    ...(csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {})
                },
                body: formData
            }).then(res => res.json())
            .then(data => {
                const flashWrapper = document.getElementById('flash-message');
                const flashInner = document.getElementById('flash-message-inner');
                if (flashWrapper && flashInner) {
                    flashInner.textContent = data.message || 'Skill updated successfully!';
                    flashWrapper.className = 'portal-flash success';
                    flashWrapper.classList.remove('hidden');
                }
                const row = document.querySelector(`[data-skill-id="${id}"] span`);
                if (row) {
                    row.innerHTML = `<strong>${newName}</strong>` + (newLevel ? ` <span class="portal-meta">— ${newLevel}</span>` : '');
                }
            }).catch(() => {
                const flashWrapper = document.getElementById('flash-message');
                const flashInner = document.getElementById('flash-message-inner');
                if (flashWrapper && flashInner) {
                    flashInner.textContent = 'Network error. Please try again.';
                    flashWrapper.className = 'portal-flash error';
                    flashWrapper.classList.remove('hidden');
                }
            });
        }

        function editGalleryItem(id, title, description) {
            const newTitle = prompt('Edit gallery title:', title);
            if (newTitle === null) return;

            const newDescription = prompt('Edit description:', description || '');
            if (newDescription === null) return;

            const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';

            const formData = new FormData();
            formData.append('title', newTitle);
            formData.append('description', newDescription);
            formData.append('_method', 'PUT');

            fetch(`/dashboard/gallery/${id}`, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    ...(csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {})
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                const flashWrapper = document.getElementById('flash-message');
                const flashInner = document.getElementById('flash-message-inner');
                if (flashWrapper && flashInner) {
                    flashInner.textContent = data.message || 'Gallery image updated successfully!';
                    flashWrapper.className = 'portal-flash success';
                    flashWrapper.classList.remove('hidden');
                }
                setTimeout(() => window.location.reload(), 700);
            })
            .catch(() => {
                const flashWrapper = document.getElementById('flash-message');
                const flashInner = document.getElementById('flash-message-inner');
                if (flashWrapper && flashInner) {
                    flashInner.textContent = 'Network error. Please try again.';
                    flashWrapper.className = 'portal-flash error';
                    flashWrapper.classList.remove('hidden');
                }
            });
        }

        // Edit functions that use toggleItemEdit
        function editCertification(id) {
            toggleItemEdit('certification', id);
        }

        function editEducation(id) {
            toggleItemEdit('education', id);
        }

        function editExperience(id) {
            toggleItemEdit('experience', id);
        }

        function editVolunteer(id) {
            toggleItemEdit('volunteer', id);
        }

        function editAchievement(id) {
            toggleItemEdit('achievement', id);
        }

        function editService(id) {
            toggleItemEdit('service', id);
        }

        function editTestimonial(id) {
            toggleItemEdit('testimonial', id);
        }
    </script>
    @endpush
</x-portal-layout>
