<div class="portal-sortable-item" data-service-id="{{ $service->id }}">

    <div class="portal-sortable-row">

        {{-- DRAG --}}
        <div class="portal-drag-handle"
             draggable="true"
             title="Drag to reorder">
            ⋮⋮
        </div>

        {{-- BODY --}}
        <div class="portal-sortable-body">

            <div class="font-semibold" style="display:flex;gap:8px;align-items:center;">
                @if($service->icon)
                    <span>{{ $service->icon }}</span>
                @endif

                {{ $service->title }}
            </div>

            @if($service->description)
                <p class="portal-meta" style="margin-top:8px;white-space:pre-line;">
                    {{ $service->description }}
                </p>
            @endif

        </div>

        {{-- ACTIONS --}}
        <div class="portal-sortable-actions">

            <button type="button"
                    class="portal-link-btn"
                    onclick="toggleItemEdit('service', {{ $service->id }})">
                Edit
            </button>

            <form method="POST"
                  action="{{ route('dashboard.service.delete',$service->id) }}"
                  class="ajax-form"
                  data-success-message="Service deleted."
                  data-reload="true">

                @csrf
                @method('DELETE')

                <button type="submit" class="portal-link-btn danger">
                    Delete
                </button>

            </form>

        </div>

    </div>

    {{-- INLINE EDIT --}}
    <form method="POST"
          action="{{ route('dashboard.service.update',$service->id) }}"
          class="portal-inline-edit hidden ajax-form"
          id="service-edit-{{ $service->id }}"
          data-success-message="Service updated."
          data-reload="true">

        @csrf
        @method('PUT')

        <div class="portal-form-grid">

            <div>
                <label>Icon</label>
                <input type="text" name="icon" value="{{ $service->icon }}">
            </div>

            <div>
                <label>Title</label>
                <input type="text" name="title" value="{{ $service->title }}" required>
            </div>

        </div>

        <div>
            <label>Description</label>
            <textarea name="description" rows="3">{{ $service->description }}</textarea>
        </div>

        <div class="portal-inline-edit-actions">

            <button type="submit" class="portal-btn portal-btn-primary">
                Save
            </button>

            <button type="button"
                    class="portal-btn portal-btn-ghost"
                    onclick="toggleItemEdit('service', {{ $service->id }})">
                Cancel
            </button>

        </div>

    </form>

</div>
