<div class="portal-sortable-item" data-achievement-id="{{ $achievement->id }}">

    <div class="portal-sortable-row">

        <div class="portal-drag-handle"
             draggable="true"
             title="Drag to reorder">
            ⋮⋮
        </div>

        <div class="portal-sortable-body">

            <div class="font-semibold">
                {{ $achievement->title }}
            </div>

            <div class="portal-meta">

                @if($achievement->organization)
                    {{ $achievement->organization }}
                @endif

                @if($achievement->achievement_date)
                    · {{ \Carbon\Carbon::parse($achievement->achievement_date)->format('M Y') }}
                @endif

            </div>

            @if($achievement->description)
                <p class="portal-meta"
                   style="margin-top:8px;white-space:pre-line;">
                    {{ $achievement->description }}
                </p>
            @endif

        </div>

        <div class="portal-sortable-actions">

            <button type="button"
                    class="portal-link-btn"
                    onclick="toggleItemEdit('achievement',{{ $achievement->id }})">
                Edit
            </button>

            <form method="POST"
                  action="{{ route('dashboard.achievements.delete',$achievement->id) }}"
                  class="ajax-form"
                  data-success-message="Achievement deleted."
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
          action="{{ route('dashboard.achievements.update',$achievement->id) }}"
          id="achievement-edit-{{ $achievement->id }}"
          class="portal-inline-edit hidden ajax-form"
          data-success-message="Achievement updated.">

        @csrf
        @method('PUT')

        <div class="portal-form-grid">

            <div>

                <label>Title</label>

                <input type="text"
                       name="title"
                       value="{{ $achievement->title }}"
                       required>

            </div>

            <div>

                <label>Organization</label>

                <input type="text"
                       name="organization"
                       value="{{ $achievement->organization }}">

            </div>

            <div>

                <label>Achievement Date</label>

                <input type="date"
                       name="achievement_date"
                       value="{{ optional($achievement->achievement_date)->format('Y-m-d') }}">

            </div>

        </div>

        <div>

            <label>Description</label>

            <textarea name="description"
                      rows="3">{{ $achievement->description }}</textarea>

        </div>

        <div class="portal-inline-edit-actions">

            <button type="submit"
                    class="portal-btn portal-btn-primary">
                Save
            </button>

            <button type="button"
                    class="portal-btn portal-btn-ghost"
                    onclick="toggleItemEdit('achievement',{{ $achievement->id }})">
                Cancel
            </button>

        </div>

    </form>

</div>
