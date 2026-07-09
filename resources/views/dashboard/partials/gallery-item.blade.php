<div class="portal-sortable-item" data-gallery-id="{{ $gallery->id }}">

    <div class="portal-sortable-row">

        <div class="portal-drag-handle"
             draggable="true"
             aria-label="Drag to reorder"
             title="Drag to reorder">
            ⋮⋮
        </div>

        <div style="margin-right:15px;">
            <img src="{{ asset('storage/'.$gallery->image) }}"
                 style="width:90px;height:90px;object-fit:cover;border-radius:8px;">
        </div>

        <div class="portal-sortable-body">

            <div class="font-semibold">
                {{ $gallery->title }}
            </div>

            @if($gallery->description)
                <p class="portal-meta" style="margin-top:8px;white-space:pre-line;">
                    {{ $gallery->description }}
                </p>
            @endif

        </div>

        <div class="portal-sortable-actions">

            <button
                type="button"
                class="portal-link-btn"
                onclick="toggleItemEdit('gallery', {{ $gallery->id }})">
                Edit
            </button>

            <form method="POST"
                  action="{{ route('dashboard.gallery.delete',$gallery->id) }}"
                  class="ajax-form"
                  data-success-message="Gallery image deleted."
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
          action="{{ route('dashboard.gallery.update',$gallery->id) }}"
          enctype="multipart/form-data"
          class="portal-inline-edit hidden ajax-form"
          id="gallery-edit-{{ $gallery->id }}"
          data-success-message="Gallery updated."
          data-reload="true">

        @csrf
        @method('PUT')

        <div class="portal-form-grid">

            <div>
                <label>Title</label>
                <input type="text"
                       name="title"
                       value="{{ $gallery->title }}"
                       required>
            </div>

            <div>
                <label>Replace Image</label>
                <input type="file"
                       name="image"
                       accept="image/*">
            </div>

        </div>

        <div>

            <label>Description</label>

            <textarea name="description"
                      rows="3">{{ $gallery->description }}</textarea>

        </div>

        <div class="portal-inline-edit-actions">

            <button type="submit"
                    class="portal-btn portal-btn-primary">
                Save
            </button>

            <button type="button"
                    class="portal-btn portal-btn-ghost"
                    onclick="toggleItemEdit('gallery', {{ $gallery->id }})">
                Cancel
            </button>

        </div>

    </form>

</div>
