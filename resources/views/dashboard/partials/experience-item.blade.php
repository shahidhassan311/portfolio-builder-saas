<div class="portal-sortable-item" data-experience-id="{{ $exp->id }}">
    <div class="portal-sortable-row">
        <div class="portal-drag-handle" draggable="true" aria-label="Drag to reorder" title="Drag to reorder">⋮⋮</div>
        <div class="portal-sortable-body">
            <div class="font-semibold">{{ $exp->role_title }} @ {{ $exp->company }}</div>
            <div class="portal-meta">
                {{ $exp->employment_type ? $exp->employment_type . ' · ' : '' }}{{ $exp->location }}
            </div>
            <div class="portal-meta-sm">
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
                <p class="portal-meta" style="margin-top:8px;white-space:pre-line;">{{ $exp->description }}</p>
            @endif
        </div>
        <div class="portal-sortable-actions">
            <button type="button" class="portal-link-btn" onclick="toggleItemEdit('experience', {{ $exp->id }})">Edit</button>
            <form method="POST" action="{{ route('dashboard.experience.delete', $exp->id) }}" class="ajax-form" data-success-message="Experience deleted." data-reload="true">
                @csrf
                @method('DELETE')
                <button type="submit" class="portal-link-btn danger">Delete</button>
            </form>
        </div>
    </div>
    <form method="POST" action="{{ route('dashboard.experience.update', $exp->id) }}" class="portal-inline-edit hidden ajax-form" id="experience-edit-{{ $exp->id }}" data-success-message="Experience updated.">
        @csrf
        @method('PUT')
        <div class="portal-form-grid">
            <div>
                <label>Company</label>
                <input type="text" name="company" value="{{ $exp->company }}" required>
            </div>
            <div>
                <label>Role / Title</label>
                <input type="text" name="role_title" value="{{ $exp->role_title }}" required>
            </div>
            <div>
                <label>Employment Type</label>
                <input type="text" name="employment_type" value="{{ $exp->employment_type }}">
            </div>
            <div>
                <label>Location</label>
                <input type="text" name="location" value="{{ $exp->location }}">
            </div>
            <div>
                <label>Start Date</label>
                <input type="date" name="start_date" value="{{ $exp->start_date?->format('Y-m-d') }}">
            </div>
            <div>
                <label>End Date</label>
                <input type="date" name="end_date" value="{{ $exp->end_date?->format('Y-m-d') }}">
            </div>
        </div>
        <label class="portal-check">
            <input type="checkbox" name="is_current" value="1" {{ $exp->is_current ? 'checked' : '' }}>
            Currently working here
        </label>
        <div>
            <label>Description</label>
            <textarea name="description" rows="4">{{ $exp->description }}</textarea>
        </div>
        <div class="portal-inline-edit-actions">
            <button type="submit" class="portal-btn portal-btn-primary">Save</button>
            <button type="button" class="portal-btn portal-btn-ghost" onclick="toggleItemEdit('experience', {{ $exp->id }})">Cancel</button>
        </div>
    </form>
</div>
