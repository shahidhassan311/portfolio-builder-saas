<div class="portal-sortable-item" data-education-id="{{ $edu->id }}">
    <div class="portal-sortable-row">
        <div class="portal-drag-handle" draggable="true" aria-label="Drag to reorder" title="Drag to reorder">⋮⋮</div>
        <div class="portal-sortable-body">
            <div class="font-semibold">
                {{ $edu->degree ?? 'Education' }}
                @if($edu->field_of_study) – {{ $edu->field_of_study }} @endif
            </div>
            <div class="portal-meta">
                {{ $edu->institution }}
                @if($edu->location) · {{ $edu->location }} @endif
            </div>
            <div class="portal-meta-sm">
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
                <p class="portal-meta" style="margin-top:8px;white-space:pre-line;">{{ $edu->description }}</p>
            @endif
        </div>
        <div class="portal-sortable-actions">
            <button type="button" class="portal-link-btn" onclick="toggleItemEdit('education', {{ $edu->id }})">Edit</button>
            <form method="POST" action="{{ route('dashboard.education.delete', $edu->id) }}" class="ajax-form" data-success-message="Education deleted." data-reload="true">
                @csrf
                @method('DELETE')
                <button type="submit" class="portal-link-btn danger">Delete</button>
            </form>
        </div>
    </div>
    <form method="POST" action="{{ route('dashboard.education.update', $edu->id) }}" class="portal-inline-edit hidden ajax-form" id="education-edit-{{ $edu->id }}" data-success-message="Education updated.">
        @csrf
        @method('PUT')
        <div class="portal-form-grid">
            <div>
                <label>Institution</label>
                <input type="text" name="institution" value="{{ $edu->institution }}" required>
            </div>
            <div>
                <label>Degree</label>
                <input type="text" name="degree" value="{{ $edu->degree }}">
            </div>
            <div>
                <label>Field of Study</label>
                <input type="text" name="field_of_study" value="{{ $edu->field_of_study }}">
            </div>
            <div>
                <label>Location</label>
                <input type="text" name="location" value="{{ $edu->location }}">
            </div>
            <div>
                <label>Start Date</label>
                <input type="date" name="start_date" value="{{ $edu->start_date?->format('Y-m-d') }}">
            </div>
            <div>
                <label>End Date</label>
                <input type="date" name="end_date" value="{{ $edu->end_date?->format('Y-m-d') }}">
            </div>
        </div>
        <label class="portal-check">
            <input type="checkbox" name="is_current" value="1" {{ $edu->is_current ? 'checked' : '' }}>
            Currently studying here
        </label>
        <div>
            <label>Description</label>
            <textarea name="description" rows="3">{{ $edu->description }}</textarea>
        </div>
        <div class="portal-inline-edit-actions">
            <button type="submit" class="portal-btn portal-btn-primary">Save</button>
            <button type="button" class="portal-btn portal-btn-ghost" onclick="toggleItemEdit('education', {{ $edu->id }})">Cancel</button>
        </div>
    </form>
</div>
