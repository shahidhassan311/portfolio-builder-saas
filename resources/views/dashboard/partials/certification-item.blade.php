<div class="portal-sortable-item" data-certification-id="{{ $cert->id }}">

    <div class="portal-sortable-row">

        {{-- DRAG --}}
        <div class="portal-drag-handle"
             draggable="true"
             title="Drag to reorder">
            ⋮⋮
        </div>

        {{-- IMAGE (LIKE GALLERY) --}}
        <div style="margin-right:15px;">
            <img src="{{ asset('storage/'.$cert->image) }}"
                 style="width:90px;height:90px;object-fit:cover;border-radius:8px;">
        </div>

        {{-- BODY --}}
        <div class="portal-sortable-body">

            <div class="font-semibold">
                {{ $cert->title }}
            </div>

            <div class="portal-meta">
                {{ $cert->organization }}
            </div>

            @if($cert->issue_date)
                <div class="portal-meta-sm">
                    {{ \Carbon\Carbon::parse($cert->issue_date)->format('Y') }}
                </div>
            @endif

            @if($cert->description)
                <p class="portal-meta" style="margin-top:8px;white-space:pre-line;">
                    {{ $cert->description }}
                </p>
            @endif

        </div>

        {{-- ACTIONS --}}
        <div class="portal-sortable-actions">

            <button type="button"
                    class="portal-link-btn"
                    onclick="toggleItemEdit('certification', {{ $cert->id }})">
                Edit
            </button>

            <form method="POST"
                  action="{{ route('dashboard.certifications.delete',$cert->id) }}"
                  class="ajax-form"
                  data-success-message="Certification deleted."
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
          action="{{ route('dashboard.certifications.update',$cert->id) }}"
          enctype="multipart/form-data"
          class="portal-inline-edit hidden ajax-form"
          id="certification-edit-{{ $cert->id }}"
          data-success-message="Certification updated."
          data-reload="true">

        @csrf
        @method('PUT')

        <div class="portal-form-grid">

            <div>
                <label>Title</label>
                <input type="text" name="title" value="{{ $cert->title }}" required>
            </div>

            <div>
                <label>Organization</label>
                <input type="text" name="organization" value="{{ $cert->organization }}" required>
            </div>

            <div>
                <label>Issue Date</label>
                <input type="date" name="issue_date" value="{{ $cert->issue_date }}">
            </div>

            <div>
                <label>Credential URL</label>
                <input type="url" name="credential_url" value="{{ $cert->credential_url }}">
            </div>

            <div>
                <label>Replace Image</label>
                <input type="file" name="image" accept="image/*">
            </div>

        </div>

        <div>
            <label>Description</label>
            <textarea name="description" rows="3">{{ $cert->description }}</textarea>
        </div>

        <div class="portal-inline-edit-actions">

            <button type="submit" class="portal-btn portal-btn-primary">
                Save
            </button>

            <button type="button"
                    class="portal-btn portal-btn-ghost"
                    onclick="toggleItemEdit('certification', {{ $cert->id }})">
                Cancel
            </button>

        </div>

    </form>

</div>
