<div class="portal-sortable-item" data-testimonial-id="{{ $testimonial->id }}">

    <div class="portal-sortable-row">

        {{-- Drag Handle --}}
        <div class="portal-drag-handle" draggable="true" aria-label="Drag to reorder" title="Drag to reorder">
            ⋮⋮
        </div>

        {{-- Body --}}
        <div class="portal-sortable-body" style="display:flex;gap:12px;align-items:flex-start;">

            {{-- Image --}}
            <div>
                @if($testimonial->image)
                    <img src="{{ asset('storage/' . $testimonial->image) }}"
                         style="width:50px;height:50px;border-radius:50%;object-fit:cover;">
                @else
                    <div style="width:50px;height:50px;border-radius:50%;background:#ddd;display:flex;align-items:center;justify-content:center;">
                        {{ strtoupper(substr($testimonial->name,0,1)) }}
                    </div>
                @endif
            </div>

            {{-- Content --}}
            <div style="flex:1;">

                <div class="font-semibold">
                    {{ $testimonial->name }}
                    @if($testimonial->role)
                        <span style="font-weight:400;">– {{ $testimonial->role }}</span>
                    @endif
                </div>

                <div class="portal-meta">
                    @if($testimonial->company)
                        {{ $testimonial->company }}
                    @endif
                </div>

                {{-- Rating --}}
                @if($testimonial->rating)
                    <div style="color:#f5a623;font-size:14px;">
                        @for($i=1; $i<=5; $i++)
                            ★
                        @endfor
                    </div>
                @endif

                {{-- Message --}}
                @if($testimonial->message)
                    <p class="portal-meta" style="margin-top:8px;white-space:pre-line;">
                        {{ $testimonial->message }}
                    </p>
                @endif

            </div>
        </div>

        {{-- Actions --}}
        <div class="portal-sortable-actions">

            <button type="button"
                    class="portal-link-btn"
                    onclick="toggleItemEdit('testimonial', {{ $testimonial->id }})">
                Edit
            </button>

            <form method="POST"
                  action="{{ route('dashboard.testimonial.delete', $testimonial->id) }}"
                  class="ajax-form"
                  data-success-message="Testimonial deleted."
                  data-reload="true">
                @csrf
                @method('DELETE')

                <button type="submit" class="portal-link-btn danger">
                    Delete
                </button>
            </form>

        </div>

    </div>

    {{-- INLINE EDIT FORM --}}
    <form method="POST"
          action="{{ route('dashboard.testimonial.update', $testimonial->id) }}"
          class="portal-inline-edit hidden ajax-form"
          id="testimonial-edit-{{ $testimonial->id }}"
          data-success-message="Testimonial updated.">

        @csrf
        @method('PUT')

        <div class="portal-form-grid">

            <div>
                <label>Name</label>
                <input type="text" name="name" value="{{ $testimonial->name }}" required>
            </div>

            <div>
                <label>Role</label>
                <input type="text" name="role" value="{{ $testimonial->role }}">
            </div>

            <div>
                <label>Company</label>
                <input type="text" name="company" value="{{ $testimonial->company }}">
            </div>

            <div>
                <label>Rating</label>
                <input type="number" name="rating" min="1" max="5" value="{{ $testimonial->rating }}">
            </div>

        </div>

        <div>
            <label>Message</label>
            <textarea name="message" rows="3">{{ $testimonial->message }}</textarea>
        </div>

        <div>
            <label>Image URL / Upload Path (optional)</label>
            <input type="text" name="image" value="{{ $testimonial->image }}">
        </div>

        <div class="portal-inline-edit-actions">
            <button type="submit" class="portal-btn portal-btn-primary">Save</button>

            <button type="button"
                    class="portal-btn portal-btn-ghost"
                    onclick="toggleItemEdit('testimonial', {{ $testimonial->id }})">
                Cancel
            </button>
        </div>

    </form>

</div>
