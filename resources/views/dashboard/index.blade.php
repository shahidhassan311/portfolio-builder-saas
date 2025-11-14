<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                        <nav class="space-y-2">
                            <a href="#profile" onclick="showSection('profile')" class="block px-4 py-2 bg-indigo-100 text-indigo-700 rounded-md section-link" data-section="profile">Profile Settings</a>
                            <a href="#about" onclick="showSection('about')" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md section-link" data-section="about">About Me</a>
                            <a href="#skills" onclick="showSection('skills')" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md section-link" data-section="skills">Skills</a>
                            <a href="#projects" onclick="showSection('projects')" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md section-link" data-section="projects">Projects</a>
                            <a href="#goals" onclick="showSection('goals')" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md section-link" data-section="goals">Goals</a>
                            <a href="#contact" onclick="showSection('contact')" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md section-link" data-section="contact">Contact Details</a>
                            <a href="#theme" onclick="showSection('theme')" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md section-link" data-section="theme">Theme Settings</a>
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
                        <form method="POST" action="{{ route('dashboard.profile.update') }}" enctype="multipart/form-data">
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
                        <form method="POST" action="{{ route('dashboard.about.update') }}">
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
                        <form method="POST" action="{{ route('dashboard.skills.store') }}" class="mb-4">
                            @csrf
                            <div class="flex gap-2">
                                <input type="text" name="name" placeholder="Skill Name" required class="flex-1 rounded-md border-gray-300 shadow-sm">
                                <input type="text" name="level" placeholder="Level (e.g., Expert)" class="w-32 rounded-md border-gray-300 shadow-sm">
                                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Add</button>
                            </div>
                        </form>
                        <div class="space-y-2">
                            @foreach($user->skills as $skill)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-md">
                                    <span><strong>{{ $skill->name }}</strong> @if($skill->level) - {{ $skill->level }} @endif</span>
                                    <div class="flex gap-2">
                                        <button onclick="editSkill({{ $skill->id }}, '{{ $skill->name }}', '{{ $skill->level }}')" class="text-blue-600 hover:text-blue-800">Edit</button>
                                        <form method="POST" action="{{ route('dashboard.skills.delete', $skill->id) }}" class="inline">
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
                        <form method="POST" action="{{ route('dashboard.projects.store') }}" enctype="multipart/form-data" class="mb-4">
                            @csrf
                            <div class="space-y-2">
                                <input type="text" name="title" placeholder="Project Title" required class="w-full rounded-md border-gray-300 shadow-sm">
                                <textarea name="short_description" placeholder="Description" rows="2" class="w-full rounded-md border-gray-300 shadow-sm"></textarea>
                                <input type="url" name="project_url" placeholder="Project URL (optional)" class="w-full rounded-md border-gray-300 shadow-sm">
                                <input type="file" name="project_image" accept="image/*" class="w-full rounded-md border-gray-300 shadow-sm">
                                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Add Project</button>
                            </div>
                        </form>
                        <div class="grid md:grid-cols-2 gap-4">
                            @foreach($user->projects as $project)
                                <div class="border rounded-lg p-4">
                                    @if($project->project_image)
                                        <img src="{{ asset('storage/' . $project->project_image) }}" alt="{{ $project->title }}" class="w-full h-32 object-cover rounded mb-2">
                                    @endif
                                    <h4 class="font-semibold">{{ $project->title }}</h4>
                                    <p class="text-sm text-gray-600">{{ $project->short_description }}</p>
                                    @if($project->project_url)
                                        <a href="{{ $project->project_url }}" target="_blank" class="text-blue-600 text-sm">View Project</a>
                                    @endif
                                    <div class="mt-2 flex gap-2">
                                        <button onclick="editProject({{ $project->id }})" class="text-blue-600 text-sm">Edit</button>
                                        <form method="POST" action="{{ route('dashboard.projects.delete', $project->id) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 text-sm">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Goals Section -->
                    <div id="goals-section" class="section-content hidden bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-4">Goals</h3>
                        <form method="POST" action="{{ route('dashboard.goals.store') }}" class="mb-4">
                            @csrf
                            <textarea name="goal_text" placeholder="Enter your goal" rows="2" required class="w-full rounded-md border-gray-300 shadow-sm"></textarea>
                            <button type="submit" class="mt-2 bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Add Goal</button>
                        </form>
                        <div class="space-y-2">
                            @foreach($user->goals as $goal)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-md">
                                    <span>{{ $goal->goal_text }}</span>
                                    <div class="flex gap-2">
                                        <button onclick="editGoal({{ $goal->id }}, '{{ addslashes($goal->goal_text) }}')" class="text-blue-600 hover:text-blue-800">Edit</button>
                                        <form method="POST" action="{{ route('dashboard.goals.delete', $goal->id) }}" class="inline">
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
                        <form method="POST" action="{{ route('dashboard.contact.update') }}">
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
                        <form method="POST" action="{{ route('dashboard.theme.update') }}">
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
        function showSection(section) {
            document.querySelectorAll('.section-content').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('.section-link').forEach(el => {
                el.classList.remove('bg-indigo-100', 'text-indigo-700');
                el.classList.add('text-gray-700');
            });
            document.getElementById(section + '-section').classList.remove('hidden');
            event.target.classList.add('bg-indigo-100', 'text-indigo-700');
            event.target.classList.remove('text-gray-700');
        }

        function editSkill(id, name, level) {
            // Simple edit - you can enhance this with a modal
            const newName = prompt('Edit skill name:', name);
            const newLevel = prompt('Edit skill level:', level || '');
            if (newName) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/dashboard/skills/${id}`;
                form.innerHTML = `
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="name" value="${newName}">
                    <input type="hidden" name="level" value="${newLevel}">
                `;
                document.body.appendChild(form);
                form.submit();
            }
        }

        function editGoal(id, text) {
            const newText = prompt('Edit goal:', text);
            if (newText) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/dashboard/goals/${id}`;
                form.innerHTML = `
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="goal_text" value="${newText}">
                `;
                document.body.appendChild(form);
                form.submit();
            }
        }

        function editProject(id) {
            // Redirect to edit page or show modal
            alert('Edit project functionality - implement as needed');
        }
    </script>
</x-app-layout>

