<x-portal-layout active="templates" title="Templates" description="{{ config('plans.free.features.templates') }} — switch anytime, unlimited edits.">
    <div class="portal-template-grid">
        @foreach ($themes as $theme)
            <article class="portal-template-card {{ $user->active_theme_id === $theme->id ? 'is-active' : '' }}">
                <div class="portal-template-preview">
                    @if ($theme->preview_image)
                        <img src="{{ asset('storage/' . $theme->preview_image) }}" alt="{{ $theme->name }} preview">
                    @else
                        <div class="portal-template-placeholder">{{ $theme->name }}</div>
                    @endif
                    @if ($user->active_theme_id === $theme->id)
                        <span class="portal-template-active-badge">Active</span>
                    @endif
                </div>
                <div class="portal-template-body">
                    <h3>{{ $theme->name }}</h3>
                    <div class="portal-template-actions">
                        <a href="{{ route('preview.theme', $theme->id) }}" target="_blank" class="portal-btn portal-btn-ghost">Preview</a>
                        <form method="POST" action="{{ route('dashboard.theme.update') }}" class="ajax-form inline">
                            @csrf
                            <input type="hidden" name="active_theme_id" value="{{ $theme->id }}">
                            <button type="submit" class="portal-btn portal-btn-primary">
                                {{ $user->active_theme_id === $theme->id ? 'Selected' : 'Use template' }}
                            </button>
                        </form>
                    </div>
                </div>
            </article>
        @endforeach
    </div>

    @push('portal-scripts')
        @include('dashboard.partials.scripts-ajax-forms')
    @endpush
</x-portal-layout>
