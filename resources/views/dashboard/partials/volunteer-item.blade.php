
<div class="portal-sortable-item" data-volunteer-id="{{ $volunteer->id }}">

    <div class="portal-sortable-row">

        <div class="portal-drag-handle"
             draggable="true"
             aria-label="Drag to reorder"
             title="Drag to reorder">
            ⋮⋮
        </div>

        <div class="portal-sortable-body">

            <div class="font-semibold">
                {{ $volunteer->role }}
            </div>

            <div class="portal-meta">
                {{ $volunteer->organization_name }}

                @if($volunteer->location)
                    · {{ $volunteer->location }}
                @endif
            </div>

            <div class="portal-meta-sm">

                @if($volunteer->start_date)

                    {{ \Illuminate\Support\Carbon::parse($volunteer->start_date)->format('M Y') }}

                    —

                    @if($volunteer->currently_volunteering)

                        Present

                    @elseif($volunteer->end_date)

                        {{ \Illuminate\Support\Carbon::parse($volunteer->end_date)->format('M Y') }}

                    @else

                        ...

                    @endif

                @endif

            </div>

            @if($volunteer->description)
                <p class="portal-meta"
                   style="margin-top:8px;white-space:pre-line;">
                    {{ $volunteer->description }}
                </p>
            @endif

        </div>

        <div class="portal-sortable-actions">

            <button type="button"
                    class="portal-link-btn"
                    onclick="toggleItemEdit('volunteer', {{ $volunteer->id }})">
                Edit
            </button>

            <form method="POST"
                  action="{{ route('dashboard.volunteers.delete', $volunteer->id) }}"
                  class="ajax-form"
                  data-success-message="Volunteer deleted."
                  data-reload="true">

                @csrf
                @method('DELETE')

                <button type="submit"
                        class="portal-link-btn danger">
                    Delete
                </button>

            </form>

        </div>

    </div>

    <form method="POST"
          action="{{ route('dashboard.volunteers.update', $volunteer->id) }}"
          class="portal-inline-edit hidden ajax-form"
          id="volunteer-edit-{{ $volunteer->id }}"
          data-success-message="Volunteer updated.">

        @csrf
        @method('PUT')

        <div class="portal-form-grid">

            <div>
                <label>Organization Name</label>
                <input type="text"
                       name="organization_name"
                       value="{{ $volunteer->organization_name }}"
                       required>
            </div>

            <div>
                <label>Role</label>
                <input type="text"
                       name="role"
                       value="{{ $volunteer->role }}"
                       required>
            </div>

            <div>
                <label>Location</label>
                <input type="text"
                       name="location"
                       value="{{ $volunteer->location }}">
            </div>

            <div>
                <label>Start Date</label>
                <input type="date"
                       name="start_date"
                       value="{{ $volunteer->start_date?->format('Y-m-d') }}">
            </div>

            <div>
                <label>End Date</label>
                <input type="date"
                       name="end_date"
                       value="{{ $volunteer->end_date?->format('Y-m-d') }}">
            </div>

        </div>

        <label class="portal-check">
            <input type="checkbox"
                   name="currently_volunteering"
                   value="1"
                   {{ $volunteer->currently_volunteering ? 'checked' : '' }}>

            Currently volunteering here
        </label>

        <div>
            <label>Description</label>

            <textarea name="description"
                      rows="3">{{ $volunteer->description }}</textarea>
        </div>

        <div class="portal-inline-edit-actions">

            <button type="submit"
                    class="portal-btn portal-btn-primary">
                Save
            </button>

            <button type="button"
                    class="portal-btn portal-btn-ghost"
                    onclick="toggleItemEdit('volunteer', {{ $volunteer->id }})">
                Cancel
            </button>

        </div>

    </form>

</div
