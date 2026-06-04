<x-portal-layout active="content" title="Content" description="{{ config('plans.free.features.edits') }} — profile, experience, projects, and more.">
        <div class="portal-shell">
            <aside class="portal-sidebar">
                <nav>
                    <span class="portal-sidebar-label">Content</span>
                    <a href="#profile" onclick="showSection(event, 'profile')" class="section-link is-active" data-section="profile">Profile</a>
                    <a href="#about" onclick="showSection(event, 'about')" class="section-link" data-section="about">About</a>
                    <a href="#skills" onclick="showSection(event, 'skills')" class="section-link" data-section="skills">Skills</a>
                    <a href="#projects" onclick="showSection(event, 'projects')" class="section-link" data-section="projects">Projects</a>
                    <a href="#experience" onclick="showSection(event, 'experience')" class="section-link" data-section="experience">Experience</a>
                    <a href="#education" onclick="showSection(event, 'education')" class="section-link" data-section="education">Education</a>
                    <div class="portal-sidebar-divider"></div>
                    <span class="portal-sidebar-label">Publish</span>
                    <a href="#goals" onclick="showSection(event, 'goals')" class="section-link" data-section="goals">Goals</a>
                    <a href="#contact" onclick="showSection(event, 'contact')" class="section-link" data-section="contact">Contact</a>
                    <div class="portal-sidebar-divider"></div>
                    <a href="{{ route('dashboard.templates') }}" class="section-link">Templates →</a>
                    <a href="{{ route('portfolio.show', ['id' => $user->id, 'username' => $user->username]) }}" target="_blank" class="portal-preview-btn">
                        Preview live site →
                    </a>
                </nav>
            </aside>

            <div class="portal-main">
                    <div id="profile-section" class="section-content portal-panel">
                        <h3>Profile</h3>
                        <form method="POST" action="{{ route('dashboard.profile.update') }}" enctype="multipart/form-data" class="ajax-form portal-form-stack" data-success-message="Profile updated successfully!">
                            @csrf
                            <div class="portal-form-grid">
                                <div class="portal-field">
                                    <label>Full Name</label>
                                    <input type="text" name="name" value="{{ $user->name }}" required>
                                </div>
                                <div class="portal-field">
                                    <label>Username</label>
                                    <input type="text" name="username" value="{{ $user->username }}" required>
                                </div>
                                <div class="portal-field portal-field-full">
                                    <label>Tagline</label>
                                    <input type="text" name="tagline" value="{{ $user->profile->tagline ?? '' }}" placeholder="e.g., Web Developer">
                                </div>
                                <div class="portal-field portal-field-full">
                                    <label>Profile Image</label>
                                    @if($user->profile && $user->profile->profile_image)
                                        <img src="{{ asset('storage/' . $user->profile->profile_image) }}" alt="Profile" class="portal-profile-thumb">
                                    @endif
                                    <input type="file" name="profile_image" accept="image/*">
                                </div>
                            </div>
                            <button type="submit" class="portal-btn portal-btn-primary">Save changes</button>
                        </form>
                    </div>

                    <!-- About Section -->
                    <div id="about-section" class="section-content hidden portal-panel">
                        <h3>About</h3>
                        <form method="POST" action="{{ route('dashboard.about.update') }}" class="ajax-form portal-form-stack" data-success-message="About section updated successfully!">
                            @csrf
                            <div class="portal-field">
                                <label>Title</label>
                                <input type="text" name="about_title" value="{{ $user->profile->about_title ?? 'About Me' }}">
                            </div>
                            <div class="portal-field">
                                <label>Short description (300–500 chars)</label>
                                <textarea name="about_short" rows="3">{{ $user->profile->about_short ?? '' }}</textarea>
                            </div>
                            <div class="portal-field">
                                <label>Long description (optional)</label>
                                <textarea name="about_long" rows="5">{{ $user->profile->about_long ?? '' }}</textarea>
                            </div>
                            <button type="submit" class="portal-btn portal-btn-primary">Save changes</button>
                        </form>
                    </div>

                    <!-- Skills Section -->
                    <div id="skills-section" class="section-content hidden portal-panel">
                        <h3>Skills</h3>
                        <form method="POST" action="{{ route('dashboard.skills.store') }}" class="portal-skills-add ajax-form" data-success-message="Skill added successfully!">
                            @csrf
                            <input type="text" name="name" placeholder="Skill name" required>
                            <input type="text" name="level" placeholder="Level (e.g. Expert)">
                            <button type="submit" class="portal-btn portal-btn-primary">Add</button>
                        </form>
                        <div id="skills-list">
                            @foreach($user->skills as $skill)
                                <div class="portal-list-row" data-skill-id="{{ $skill->id }}">
                                    <span><strong>{{ $skill->name }}</strong>@if($skill->level) <span class="portal-meta">— {{ $skill->level }}</span>@endif</span>
                                    <div class="portal-sortable-actions">
                                        <button type="button" onclick="editSkill({{ $skill->id }}, '{{ addslashes($skill->name) }}', '{{ addslashes($skill->level) }}')" class="portal-link-btn">Edit</button>
                                        <form method="POST" action="{{ route('dashboard.skills.delete', $skill->id) }}" class="inline ajax-form" data-success-message="Skill deleted successfully!">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="portal-link-btn danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Projects Section -->
                    <div id="projects-section" class="section-content hidden portal-panel">
                        <h3>Projects</h3>
                        <form method="POST" action="{{ route('dashboard.projects.store') }}" enctype="multipart/form-data" class="portal-add-form portal-form-stack ajax-form" data-success-message="Project added successfully!">
                            @csrf
                            <div class="portal-field">
                                <label>Title</label>
                                <input type="text" name="title" placeholder="Project title" required>
                            </div>
                            <div class="portal-field">
                                <label>Description</label>
                                <textarea name="short_description" placeholder="Short description" rows="2"></textarea>
                            </div>
                            <div class="portal-form-grid">
                                <div class="portal-field">
                                    <label>Project URL</label>
                                    <input type="url" name="project_url" placeholder="https://">
                                </div>
                                <div class="portal-field">
                                    <label>Image</label>
                                    <input type="file" name="project_image" accept="image/*">
                                </div>
                            </div>
                            <button type="submit" class="portal-btn portal-btn-primary">Add project</button>
                        </form>
                        <div class="portal-projects-grid" id="projects-list">
                            @foreach($user->projects as $project)
                                <div class="portal-project-card" data-project-id="{{ $project->id }}">
                                    @if($project->project_image)
                                        <img src="{{ asset('storage/' . $project->project_image) }}" alt="{{ $project->title }}" class="portal-project-thumb">
                                    @endif
                                    <h4>{{ $project->title }}</h4>
                                    <p class="portal-meta">{{ $project->short_description }}</p>
                                    @if($project->project_url)
                                        <a href="{{ $project->project_url }}" target="_blank" class="portal-link-btn">View project</a>
                                    @endif
                                    <div class="portal-sortable-actions" style="margin-top:12px;">
                                        <form method="POST" action="{{ route('dashboard.projects.delete', $project->id) }}" class="inline ajax-form" data-success-message="Project deleted successfully!">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="portal-link-btn danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Experience Section --}}
                    <div id="experience-section" class="section-content hidden portal-panel">
                        <h3>Experience</h3>

                        <form method="POST" action="{{ route('dashboard.experience.store') }}" class="portal-add-form ajax-form" data-success-message="Experience added successfully!">
                            @csrf
                            <div class="portal-form-grid">
                                <div class="portal-field">
                                    <label>Company</label>
                                    <input type="text" name="company" required>
                                </div>
                                <div class="portal-field">
                                    <label>Role / Title</label>
                                    <input type="text" name="role_title" required>
                                </div>
                                <div class="portal-field">
                                    <label>Employment Type</label>
                                    <input type="text" name="employment_type" placeholder="Full-time, Part-time, Freelance…">
                                </div>
                                <div class="portal-field">
                                    <label>Location</label>
                                    <input type="text" name="location" placeholder="City, Country">
                                </div>
                                <div class="portal-field">
                                    <label>Start Date</label>
                                    <input type="date" name="start_date">
                                </div>
                                <div class="portal-field">
                                    <label>End Date</label>
                                    <input type="date" name="end_date">
                                </div>
                            </div>
                            <label class="portal-check">
                                <input type="checkbox" id="exp_is_current" name="is_current" value="1">
                                Currently working here
                            </label>
                            <div class="portal-field portal-field-spaced">
                                <label>Description</label>
                                <textarea name="description" rows="3" placeholder="What did you work on? Tech stack, responsibilities…"></textarea>
                            </div>
                            <button type="submit" class="portal-btn portal-btn-primary">Add experience</button>
                        </form>

                        @if($user->experiences->isNotEmpty())
                            <p class="portal-sort-hint">Drag ⋮⋮ to reorder how experience appears on your portfolio. Click Edit to fix imported fields.</p>
                        @endif
                        <div class="portal-sortable-list" id="experience-list" data-reorder-url="{{ route('dashboard.experience.reorder') }}">
                            @forelse($user->experiences as $exp)
                                @include('dashboard.partials.experience-item', ['exp' => $exp])
                            @empty
                                <p class="portal-empty">No experience added yet.</p>
                            @endforelse
                        </div>
                    </div>

                    {{-- Education Section --}}
                    <div id="education-section" class="section-content hidden portal-panel">
                        <h3>Education</h3>

                        <form method="POST" action="{{ route('dashboard.education.store') }}" class="portal-add-form ajax-form" data-success-message="Education added successfully!">
                            @csrf
                            <div class="portal-form-grid">
                                <div class="portal-field">
                                    <label>Institution</label>
                                    <input type="text" name="institution" required>
                                </div>
                                <div class="portal-field">
                                    <label>Degree</label>
                                    <input type="text" name="degree" placeholder="e.g. BS Computer Science">
                                </div>
                                <div class="portal-field">
                                    <label>Field of Study</label>
                                    <input type="text" name="field_of_study" placeholder="Computer Science, IT, Design…">
                                </div>
                                <div class="portal-field">
                                    <label>Location</label>
                                    <input type="text" name="location" placeholder="City, Country">
                                </div>
                                <div class="portal-field">
                                    <label>Start Date</label>
                                    <input type="date" name="start_date">
                                </div>
                                <div class="portal-field">
                                    <label>End Date</label>
                                    <input type="date" name="end_date">
                                </div>
                            </div>
                            <label class="portal-check">
                                <input type="checkbox" id="edu_is_current" name="is_current" value="1">
                                Currently studying here
                            </label>
                            <div class="portal-field portal-field-spaced">
                                <label>Description</label>
                                <textarea name="description" rows="3" placeholder="Highlights, GPA (optional), relevant courses…"></textarea>
                            </div>
                            <button type="submit" class="portal-btn portal-btn-primary">Add education</button>
                        </form>

                        @if($user->educations->isNotEmpty())
                            <p class="portal-sort-hint">Drag ⋮⋮ to reorder education entries. Use Edit to add degree or school name if import missed them.</p>
                        @endif
                        <div class="portal-sortable-list" id="education-list" data-reorder-url="{{ route('dashboard.education.reorder') }}">
                            @forelse($user->educations as $edu)
                                @include('dashboard.partials.education-item', ['edu' => $edu])
                            @empty
                                <p class="portal-empty">No education added yet.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Goals Section -->
                    <div id="goals-section" class="section-content hidden portal-panel">
                        <h3>Goals</h3>
                        <form method="POST" action="{{ route('dashboard.goals.store') }}" class="portal-add-form portal-form-stack ajax-form" data-success-message="Goal added successfully!">
                            @csrf
                            <div class="portal-field">
                                <label>Goal</label>
                                <textarea name="goal_text" placeholder="What are you working toward?" rows="2" required></textarea>
                            </div>
                            <button type="submit" class="portal-btn portal-btn-primary">Add goal</button>
                        </form>
                        <div id="goals-list">
                            @foreach($user->goals as $goal)
                                <div class="portal-list-row" data-goal-id="{{ $goal->id }}">
                                    <span class="goal-text">{{ $goal->goal_text }}</span>
                                    <div class="portal-sortable-actions">
                                        <button type="button" onclick="editGoal({{ $goal->id }}, '{{ addslashes($goal->goal_text) }}')" class="portal-link-btn">Edit</button>
                                        <form method="POST" action="{{ route('dashboard.goals.delete', $goal->id) }}" class="inline ajax-form" data-success-message="Goal deleted successfully!">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="portal-link-btn danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Contact Section -->
                    <div id="contact-section" class="section-content hidden portal-panel">
                        <h3>Contact</h3>
                        <form method="POST" action="{{ route('dashboard.contact.update') }}" class="ajax-form portal-form-stack" data-success-message="Contact details updated successfully!">
                            @csrf
                            <div class="portal-form-grid">
                                <div class="portal-field">
                                    <label>Email</label>
                                    <input type="email" name="contact_email" value="{{ $user->profile->contact_email ?? $user->email }}">
                                </div>
                                <div class="portal-field">
                                    <label>Phone</label>
                                    <input type="text" name="contact_phone" value="{{ $user->profile->contact_phone ?? '' }}">
                                </div>
                                <div class="portal-field portal-field-full">
                                    <label>Location</label>
                                    <input type="text" name="location" value="{{ $user->profile->location ?? '' }}" placeholder="City, Country">
                                </div>
                            </div>
                            <span class="portal-form-section-label">Social links</span>
                            <div class="portal-form-grid">
                                <div class="portal-field">
                                    <label>Facebook</label>
                                    <input type="url" name="social_facebook" value="{{ $user->profile->social_facebook ?? '' }}" placeholder="https://">
                                </div>
                                <div class="portal-field">
                                    <label>Instagram</label>
                                    <input type="url" name="social_instagram" value="{{ $user->profile->social_instagram ?? '' }}" placeholder="https://">
                                </div>
                                <div class="portal-field">
                                    <label>LinkedIn</label>
                                    <input type="url" name="social_linkedin" value="{{ $user->profile->social_linkedin ?? '' }}" placeholder="https://">
                                </div>
                                <div class="portal-field">
                                    <label>GitHub</label>
                                    <input type="url" name="social_github" value="{{ $user->profile->social_github ?? '' }}" placeholder="https://">
                                </div>
                                <div class="portal-field portal-field-full">
                                    <label>Twitter / X</label>
                                    <input type="url" name="social_twitter" value="{{ $user->profile->social_twitter ?? '' }}" placeholder="https://">
                                </div>
                            </div>
                            <button type="submit" class="portal-btn portal-btn-primary">Save changes</button>
                        </form>
                    </div>

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

                            const shouldReload = form.getAttribute('data-reload') === 'true'
                                || (data && data.reload)
                                || form.classList.contains('portal-inline-edit');
                            if (shouldReload) {
                                setTimeout(() => window.location.reload(), 700);
                            } else if (!form.classList.contains('portal-inline-edit')) {
                                form.reset();
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

            initSortableList(document.getElementById('experience-list'));
            initSortableList(document.getElementById('education-list'));

            // On load, honor the hash (so refresh to #skills opens Skills)
            const initialHash = window.location.hash.replace('#', '');
            if (initialHash) {
                const link = document.querySelector('.section-link[data-section="' + initialHash + '"]');
                if (link) {
                    showSection({ target: link }, initialHash);
                }
            }
        });

        function toggleItemEdit(type, id) {
            const form = document.getElementById(type + '-edit-' + id);
            if (form) {
                form.classList.toggle('hidden');
            }
        }

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
                        draggedEl.dataset.experienceId || draggedEl.dataset.educationId || ''
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
            const order = [...listEl.querySelectorAll(':scope > .portal-sortable-item')].map(el =>
                parseInt(el.dataset.experienceId || el.dataset.educationId, 10)
            ).filter(id => !isNaN(id));

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

        function showSection(event, section) {
            if (event && event.preventDefault) event.preventDefault();

            document.querySelectorAll('.section-content').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('.section-link').forEach(el => el.classList.remove('is-active'));
            const sectionEl = document.getElementById(section + '-section');
            if (sectionEl) {
                sectionEl.classList.remove('hidden');
            }
            const link = event?.target?.closest?.('.section-link') || event?.target;
            if (link && link.classList?.contains('section-link')) {
                link.classList.add('is-active');
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
                            flashWrapper.className = 'portal-flash success';
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
                            flashWrapper.className = 'portal-flash error';
                            flashWrapper.classList.remove('hidden');
                        }
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
                            flashWrapper.className = 'portal-flash success';
                            flashWrapper.classList.remove('hidden');
                        }
                        const row = document.querySelector(`[data-goal-id="${id}"] .goal-text`);
                        if (row) {
                            row.textContent = newText;
                        }
                    } else {
                        if (flashWrapper && flashInner) {
                            flashInner.textContent = data.message || 'Error updating goal.';
                            flashWrapper.className = 'portal-flash error';
                            flashWrapper.classList.remove('hidden');
                        }
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

        function editProject(id) {
            alert('Edit project functionality - implement as needed');
        }
    </script>
@endpush
</x-portal-layout>
