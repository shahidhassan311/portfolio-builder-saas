<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="flash-message" class="mb-4 hidden">
                <div class="px-4 py-3 rounded border text-sm" id="flash-message-inner"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                        <nav class="space-y-2">
                            <a href="#profile" onclick="showSection(event, 'profile')" class="block px-4 py-2 bg-indigo-100 text-indigo-700 rounded-md section-link" data-section="profile">Profile Settings</a>
                            <a href="#about" onclick="showSection(event, 'about')" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md section-link" data-section="about">About Me</a>
                            <a href="#skills" onclick="showSection(event, 'skills')" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md section-link" data-section="skills">Skills</a>
                            <a href="#projects" onclick="showSection(event, 'projects')" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md section-link" data-section="projects">Projects</a>

                            <!-- NEW -->
                            <a href="#experience" onclick="showSection(event, 'experience')" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md section-link" data-section="experience">Experience</a>
                            <a href="#education" onclick="showSection(event, 'education')" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md section-link" data-section="education">Education</a>

                            <a href="#goals" onclick="showSection(event, 'goals')" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md section-link" data-section="goals">Goals</a>
                            <a href="#contact" onclick="showSection(event, 'contact')" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md section-link" data-section="contact">Contact Details</a>
                            <a href="#theme" onclick="showSection(event, 'theme')" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md section-link" data-section="theme">Theme Settings</a>
                            <a href="{{ route('portfolio.show', ['id' => $user->id, 'username' => $user->username]) }}" target="_blank" class="block px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 text-center">
                                Preview Portfolio
                            </a>
                        </nav>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="lg:col-span-3">
                    <!-- Profile Section -->
                    <div id="profile-section" class="section-content bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-4">Profile Settings</h3>
                        <form method="POST" action="{{ route('dashboard.profile.update') }}" enctype="multipart/form-data" class="ajax-form" data-success-message="Profile updated successfully!">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Full Name</label>
                                    <input type="text" name="name" value="{{ $user->name }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Username</label>
                                    <input type="text" name="username" value="{{ $user->username }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Tagline</label>
                                    <input type="text" name="tagline" value="{{ $user->profile->tagline ?? '' }}" placeholder="e.g., Web Developer" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Profile Image</label>
                                    @if($user->profile && $user->profile->profile_image)
                                        <img src="{{ asset('storage/' . $user->profile->profile_image) }}" alt="Profile" class="w-32 h-32 rounded-full mb-2">
                                    @endif
                                    <input type="file" name="profile_image" accept="image/*" class="mt-1 block w-full">
                                </div>
                                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Save</button>
                            </div>
                        </form>
                    </div>

                    <!-- About Section -->
                    <div id="about-section" class="section-content hidden bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-4">About Me</h3>
                        <form method="POST" action="{{ route('dashboard.about.update') }}" class="ajax-form" data-success-message="About section updated successfully!">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Title</label>
                                    <input type="text" name="about_title" value="{{ $user->profile->about_title ?? 'About Me' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Short Description (300-500 chars)</label>
                                    <textarea name="about_short" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ $user->profile->about_short ?? '' }}</textarea>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Long Description (Optional)</label>
                                    <textarea name="about_long" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ $user->profile->about_long ?? '' }}</textarea>
                                </div>
                                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Save</button>
                            </div>
                        </form>
                    </div>

                    <!-- Skills Section -->
                    <div id="skills-section" class="section-content hidden bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-4">Skills</h3>
                        <form method="POST" action="{{ route('dashboard.skills.store') }}" class="mb-4 ajax-form" data-success-message="Skill added successfully!">
                            @csrf
                            <div class="flex gap-2">
                                <input type="text" name="name" placeholder="Skill Name" required class="flex-1 rounded-md border-gray-300 shadow-sm">
                                <input type="text" name="level" placeholder="Level (e.g., Expert)" class="w-32 rounded-md border-gray-300 shadow-sm">
                                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Add</button>
                            </div>
                        </form>
                        <div class="space-y-2" id="skills-list">
                            @foreach($user->skills as $skill)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-md" data-skill-id="{{ $skill->id }}">
                                    <span><strong>{{ $skill->name }}</strong> @if($skill->level) - {{ $skill->level }} @endif</span>
                                    <div class="flex gap-2">
                                        <button onclick="editSkill({{ $skill->id }}, '{{ addslashes($skill->name) }}', '{{ addslashes($skill->level) }}')" class="text-blue-600 hover:text-blue-800">Edit</button>
                                        <form method="POST" action="{{ route('dashboard.skills.delete', $skill->id) }}" class="inline ajax-form" data-success-message="Skill deleted successfully!">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Projects Section -->
                    <div id="projects-section" class="section-content hidden bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-4">Projects</h3>
                        <form method="POST" action="{{ route('dashboard.projects.store') }}" enctype="multipart/form-data" class="mb-4 ajax-form" data-success-message="Project added successfully!">
                            @csrf
                            <div class="space-y-2">
                                <input type="text" name="title" placeholder="Project Title" required class="w-full rounded-md border-gray-300 shadow-sm">
                                <textarea name="short_description" placeholder="Description" rows="2" class="w-full rounded-md border-gray-300 shadow-sm"></textarea>
                                <input type="url" name="project_url" placeholder="Project URL (optional)" class="w-full rounded-md border-gray-300 shadow-sm">
                                <input type="file" name="project_image" accept="image/*" class="w-full rounded-md border-gray-300 shadow-sm">
                                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Add Project</button>
                            </div>
                        </form>
                        <div class="grid md:grid-cols-2 gap-4" id="projects-list">
                            @foreach($user->projects as $project)
                                <div class="border rounded-lg p-4" data-project-id="{{ $project->id }}">
                                    @if($project->project_image)
                                        <img src="{{ asset('storage/' . $project->project_image) }}" alt="{{ $project->title }}" class="w-full h-32 object-cover rounded mb-2">
                                    @endif
                                    <h4 class="font-semibold">{{ $project->title }}</h4>
                                    <p class="text-sm text-gray-600">{{ $project->short_description }}</p>
                                    @if($project->project_url)
                                        <a href="{{ $project->project_url }}" target="_blank" class="text-blue-600 text-sm">View Project</a>
                                    @endif
                                    <div class="mt-2 flex gap-2">
                                        {{--                                        <button onclick="editProject({{ $project->id }})" class="text-blue-600 text-sm">Edit</button>--}}
                                        <form method="POST" action="{{ route('dashboard.projects.delete', $project->id) }}" class="inline ajax-form" data-success-message="Project deleted successfully!">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 text-sm">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Experience Section --}}
                    <div id="experience-section" class="section-content hidden bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-4">Experience</h3>

                        {{-- Add experience --}}
                        <form method="POST" action="{{ route('dashboard.experience.store') }}" class="mb-4 space-y-3 ajax-form" data-success-message="Experience added successfully!">
                            @csrf
                            <div class="grid md:grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Company</label>
                                    <input type="text" name="company" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Role / Title</label>
                                    <input type="text" name="role_title" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Employment Type</label>
                                    <input type="text" name="employment_type" placeholder="Full-time, Part-time, Freelance..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Location</label>
                                    <input type="text" name="location" placeholder="City, Country" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Start Date</label>
                                    <input type="date" name="start_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">End Date</label>
                                    <input type="date" name="end_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <input type="checkbox" id="exp_is_current" name="is_current" value="1" class="rounded border-gray-300">
                                <label for="exp_is_current" class="text-sm text-gray-700">Currently working here</label>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="description" rows="3" placeholder="What did you work on? Tech stack, responsibilities..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Sort Order (optional)</label>
                                <input type="number" name="sort_order" min="0" class="mt-1 block w-32 rounded-md border-gray-300 shadow-sm">
                            </div>

                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                                Add Experience
                            </button>
                        </form>

                        {{-- List experiences --}}
                        <div class="space-y-3" id="experience-list">
                            @forelse($user->experiences as $exp)
                                <div class="border rounded-md p-3 flex flex-col md:flex-row md:items-center md:justify-between bg-gray-50" data-experience-id="{{ $exp->id }}">
                                    <div>
                                        <div class="font-semibold">
                                            {{ $exp->role_title }} @ {{ $exp->company }}
                                        </div>
                                        <div class="text-sm text-gray-600">
                                            {{ $exp->employment_type ? $exp->employment_type . ' · ' : '' }}
                                            {{ $exp->location }}
                                        </div>
                                        <div class="text-xs text-gray-500 mt-1">
                                            @if($exp->start_date)
                                                {{ \Illuminate\Support\Carbon::parse($exp->start_date)->format('M Y') }}
                                                –
                                                @if($exp->is_current)
                                                    Present
                                                @elseif($exp->end_date)
                                                    {{ \Illuminate\Support\Carbon::parse($exp->end_date)->format('M Y') }}
                                                @else
                                                    …
                                                @endif
                                            @endif
                                        </div>
                                        @if($exp->description)
                                            <p class="text-sm text-gray-700 mt-2">{{ $exp->description }}</p>
                                        @endif
                                    </div>
                                    <div class="mt-2 md:mt-0 flex gap-2">
                                        {{-- later add editExperience() --}}
                                        <form method="POST" action="{{ route('dashboard.experience.delete', $exp->id) }}" class="ajax-form" data-success-message="Experience deleted successfully!">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 text-sm hover:text-red-800">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500">No experience added yet.</p>
                            @endforelse
                        </div>
                    </div>

                    {{-- Education Section --}}
                    <div id="education-section" class="section-content hidden bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-4">Education</h3>

                        {{-- Add education --}}
                        <form method="POST" action="{{ route('dashboard.education.store') }}" class="mb-4 space-y-3 ajax-form" data-success-message="Education added successfully!">
                            @csrf
                            <div class="grid md:grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Institution</label>
                                    <input type="text" name="institution" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Degree</label>
                                    <input type="text" name="degree" placeholder="e.g. BS Computer Science" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Field of Study</label>
                                    <input type="text" name="field_of_study" placeholder="Computer Science, IT, Design..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Location</label>
                                    <input type="text" name="location" placeholder="City, Country" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Start Date</label>
                                    <input type="date" name="start_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">End Date</label>
                                    <input type="date" name="end_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <input type="checkbox" id="edu_is_current" name="is_current" value="1" class="rounded border-gray-300">
                                <label for="edu_is_current" class="text-sm text-gray-700">Currently studying here</label>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="description" rows="3" placeholder="Highlights, GPA (optional), relevant courses..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Sort Order (optional)</label>
                                <input type="number" name="sort_order" min="0" class="mt-1 block w-32 rounded-md border-gray-300 shadow-sm">
                            </div>

                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                                Add Education
                            </button>
                        </form>

                        {{-- List educations --}}
                        <div class="space-y-3" id="education-list">
                            @forelse($user->educations as $edu)
                                <div class="border rounded-md p-3 flex flex-col md:flex-row md:items-center md:justify-between bg-gray-50" data-education-id="{{ $edu->id }}">
                                    <div>
                                        <div class="font-semibold">
                                            {{ $edu->degree ?? 'Education' }}
                                            @if($edu->field_of_study)
                                                – {{ $edu->field_of_study }}
                                            @endif
                                        </div>
                                        <div class="text-sm text-gray-600">
                                            {{ $edu->institution }}
                                            @if($edu->location) · {{ $edu->location }} @endif
                                        </div>
                                        <div class="text-xs text-gray-500 mt-1">
                                            @if($edu->start_date)
                                                {{ \Illuminate\Support\Carbon::parse($edu->start_date)->format('Y') }}
                                                –
                                                @if($edu->is_current)
                                                    Present
                                                @elseif($edu->end_date)
                                                    {{ \Illuminate\Support\Carbon::parse($edu->end_date)->format('Y') }}
                                                @else
                                                    …
                                                @endif
                                            @endif
                                        </div>
                                        @if($edu->description)
                                            <p class="text-sm text-gray-700 mt-2">{{ $edu->description }}</p>
                                        @endif
                                    </div>
                                    <div class="mt-2 md:mt-0 flex gap-2">
                                        <form method="POST" action="{{ route('dashboard.education.delete', $edu->id) }}" class="ajax-form" data-success-message="Education deleted successfully!">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 text-sm hover:text-red-800">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500">No education added yet.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Goals Section -->
                    <div id="goals-section" class="section-content hidden bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-4">Goals</h3>
                        <form method="POST" action="{{ route('dashboard.goals.store') }}" class="mb-4 ajax-form" data-success-message="Goal added successfully!">
                            @csrf
                            <textarea name="goal_text" placeholder="Enter your goal" rows="2" required class="w-full rounded-md border-gray-300 shadow-sm"></textarea>
                            <button type="submit" class="mt-2 bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Add Goal</button>
                        </form>
                        <div class="space-y-2" id="goals-list">
                            @foreach($user->goals as $goal)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-md" data-goal-id="{{ $goal->id }}">
                                    <span class="goal-text">{{ $goal->goal_text }}</span>
                                    <div class="flex gap-2">
                                        <button onclick="editGoal({{ $goal->id }}, '{{ addslashes($goal->goal_text) }}')" class="text-blue-600 hover:text-blue-800">Edit</button>
                                        <form method="POST" action="{{ route('dashboard.goals.delete', $goal->id) }}" class="inline ajax-form" data-success-message="Goal deleted successfully!">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Contact Section -->
                    <div id="contact-section" class="section-content hidden bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-4">Contact Details</h3>
                        <form method="POST" action="{{ route('dashboard.contact.update') }}" class="ajax-form" data-success-message="Contact details updated successfully!">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Email</label>
                                    <input type="email" name="contact_email" value="{{ $user->profile->contact_email ?? $user->email }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Phone</label>
                                    <input type="text" name="contact_phone" value="{{ $user->profile->contact_phone ?? '' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Location</label>
                                    <input type="text" name="location" value="{{ $user->profile->location ?? '' }}" placeholder="City, Country" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>
                                <h4 class="font-medium mt-4">Social Links</h4>
                                <div class="grid grid-cols-2 gap-4">
                                    <input type="url" name="social_facebook" value="{{ $user->profile->social_facebook ?? '' }}" placeholder="Facebook URL" class="rounded-md border-gray-300 shadow-sm">
                                    <input type="url" name="social_instagram" value="{{ $user->profile->social_instagram ?? '' }}" placeholder="Instagram URL" class="rounded-md border-gray-300 shadow-sm">
                                    <input type="url" name="social_linkedin" value="{{ $user->profile->social_linkedin ?? '' }}" placeholder="LinkedIn URL" class="rounded-md border-gray-300 shadow-sm">
                                    <input type="url" name="social_github" value="{{ $user->profile->social_github ?? '' }}" placeholder="GitHub URL" class="rounded-md border-gray-300 shadow-sm">
                                    <input type="url" name="social_twitter" value="{{ $user->profile->social_twitter ?? '' }}" placeholder="Twitter/X URL" class="rounded-md border-gray-300 shadow-sm">
                                </div>
                                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Save</button>
                            </div>
                        </form>
                    </div>

                    <!-- Theme Section -->
                    <div id="theme-section" class="section-content hidden bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-4">Theme Settings</h3>
                        <form method="POST" action="{{ route('dashboard.theme.update') }}" class="ajax-form" data-success-message="Theme updated successfully!">
                            @csrf
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Select Theme</label>
                                <select name="active_theme_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    <option value="">-- Select a theme --</option>
                                    @foreach($themes as $theme)
                                        <option value="{{ $theme->id }}" {{ $user->active_theme_id == $theme->id ? 'selected' : '' }}>
                                            {{ $theme->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="mt-4 bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';
            const flashWrapper = document.getElementById('flash-message');
            const flashInner = document.getElementById('flash-message-inner');

            function showFlash(message, type = 'success') {
                if (!flashWrapper || !flashInner) return;
                flashInner.textContent = message;
                flashInner.className = 'px-4 py-3 rounded border text-sm ' + (type === 'success'
                    ? 'bg-green-100 border-green-400 text-green-700'
                    : 'bg-red-100 border-red-400 text-red-700');
                flashWrapper.classList.remove('hidden');
            }

            // Generic AJAX handler – NO PAGE RELOAD
            document.querySelectorAll('form.ajax-form').forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

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
                        } catch (e) {
                            // non JSON response
                        }

                        if (response.ok) {
                            const msg = (data && data.message)
                                || form.getAttribute('data-success-message')
                                || 'Saved successfully!';
                            showFlash(msg, 'success');

                            // OPTIONAL: hook here per-form for real-time DOM updates
                            // Example:
                            // if (form.matches('[action$="/dashboard/skills"]') && data && data.html) {
                            //     document.getElementById('skills-list').insertAdjacentHTML('beforeend', data.html);
                            //     form.reset();
                            // }

                            // NOTE: we **do NOT** reload or redirect here anymore.
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

            // On load, honor the hash (so refresh to #skills opens Skills)
            const initialHash = window.location.hash.replace('#', '');
            if (initialHash) {
                const link = document.querySelector('.section-link[data-section="' + initialHash + '"]');
                if (link) {
                    showSection({ target: link }, initialHash);
                }
            }
        });

        function showSection(event, section) {
            if (event && event.preventDefault) event.preventDefault();

            document.querySelectorAll('.section-content').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('.section-link').forEach(el => {
                el.classList.remove('bg-indigo-100', 'text-indigo-700');
                el.classList.add('text-gray-700');
            });
            const sectionEl = document.getElementById(section + '-section');
            if (sectionEl) {
                sectionEl.classList.remove('hidden');
            }
            if (event && event.target) {
                event.target.classList.add('bg-indigo-100', 'text-indigo-700');
                event.target.classList.remove('text-gray-700');
            }

            // update URL hash without reloading
            if (history && history.replaceState) {
                history.replaceState(null, '', '#' + section);
            }
        }

        function editSkill(id, name, level) {
            const newName = prompt('Edit skill name:', name);
            if (newName === null) return;

            const newLevel = prompt('Edit skill level:', level || '');
            if (newLevel === null) return;

            // AJAX update; no page reload
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
                    if (res.ok) {
                        if (flashWrapper && flashInner) {
                            flashInner.textContent = data.message || 'Skill updated successfully!';
                            flashInner.className = 'px-4 py-3 rounded border text-sm bg-green-100 border-green-400 text-green-700';
                            flashWrapper.classList.remove('hidden');
                        }
                        // update DOM
                        const row = document.querySelector(`[data-skill-id="${id}"] span`);
                        if (row) {
                            row.innerHTML = `<strong>${newName}</strong>` + (newLevel ? ` - ${newLevel}` : '');
                        }
                    } else {
                        if (flashWrapper && flashInner) {
                            flashInner.textContent = data.message || 'Error updating skill.';
                            flashInner.className = 'px-4 py-3 rounded border text-sm bg-red-100 border-red-400 text-red-700';
                            flashWrapper.classList.remove('hidden');
                        }
                    }
                }).catch(() => {
                const flashWrapper = document.getElementById('flash-message');
                const flashInner = document.getElementById('flash-message-inner');
                if (flashWrapper && flashInner) {
                    flashInner.textContent = 'Network error. Please try again.';
                    flashInner.className = 'px-4 py-3 rounded border text-sm bg-red-100 border-red-400 text-red-700';
                    flashWrapper.classList.remove('hidden');
                }
            });
        }

        function editGoal(id, text) {
            const newText = prompt('Edit goal:', text);
            if (newText === null) return;

            const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';

            const formData = new FormData();
            formData.append('goal_text', newText);
            formData.append('_method', 'PUT');

            fetch(`/dashboard/goals/${id}`, {
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

                    if (res.ok) {
                        if (flashWrapper && flashInner) {
                            flashInner.textContent = data.message || 'Goal updated successfully!';
                            flashInner.className = 'px-4 py-3 rounded border text-sm bg-green-100 border-green-400 text-green-700';
                            flashWrapper.classList.remove('hidden');
                        }
                        const row = document.querySelector(`[data-goal-id="${id}"] .goal-text`);
                        if (row) {
                            row.textContent = newText;
                        }
                    } else {
                        if (flashWrapper && flashInner) {
                            flashInner.textContent = data.message || 'Error updating goal.';
                            flashInner.className = 'px-4 py-3 rounded border text-sm bg-red-100 border-red-400 text-red-700';
                            flashWrapper.classList.remove('hidden');
                        }
                    }
                }).catch(() => {
                const flashWrapper = document.getElementById('flash-message');
                const flashInner = document.getElementById('flash-message-inner');
                if (flashWrapper && flashInner) {
                    flashInner.textContent = 'Network error. Please try again.';
                    flashInner.className = 'px-4 py-3 rounded border text-sm bg-red-100 border-red-400 text-red-700';
                    flashWrapper.classList.remove('hidden');
                }
            });
        }

        function editProject(id) {
            alert('Edit project functionality - implement as needed');
        }
    </script>
</x-app-layout>
