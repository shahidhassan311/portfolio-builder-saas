<x-portal-layout active="templates" title="Templates" description="{{ config('plans.free.features.templates') }} — switch anytime, unlimited edits.">

    @if($recommendedThemes->count())
        <div class="portal-section-header">
            <p class="portal-section-label">
                Profession:
                <strong>{{ $user->professions->first()?->name ?? 'Not Selected' }}</strong>
            </p>

            <h3> Recommended for your Profession</h3>
            <p>These templates are recommended based on your selected profession.</p>
        </div>

        <div class="portal-template-grid">
            @foreach ($recommendedThemes as $theme)
                <article class="portal-template-card {{ $user->active_theme_id === $theme->id ? 'is-active' : '' }}">
                    <div class="portal-template-preview">
                        @if ($theme->preview_image)
                            <img src="{{ asset('storage/' . $theme->preview_image) }}" alt="{{ $theme->name }}">
                        @else
                            <div class="portal-template-placeholder">{{ $theme->name }}</div>
                        @endif

                        @if ($user->active_theme_id === $theme->id)
                            <span class="portal-template-active-badge">Active</span>
                        @else
                            <span class="portal-template-active-badge">Recommended</span>
                        @endif
                    </div>

                    <div class="portal-template-body">
                        <h3>{{ $theme->name }}</h3>

                        <div class="portal-template-actions">
                            <a href="{{ route('preview.theme', $theme->id) }}" target="_blank" class="portal-btn portal-btn-ghost">
                                Preview
                            </a>

                            <form method="POST" action="{{ route('dashboard.theme.update') }}" class="ajax-form inline">
                                @csrf
                                <input type="hidden" name="active_theme_id" value="{{ $theme->id }}">

                                <button type="submit" class="portal-btn portal-btn-primary">
                                    {{ $user->active_theme_id === $theme->id ? 'Selected' : 'Use Template' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    @endif


    @if($otherThemes->count())
        <div class="portal-section-header mt-5">
            <h2>Suggestions</h2>
        </div>

        <div class="portal-template-grid">
            @foreach ($otherThemes as $theme)
                <article class="portal-template-card {{ $user->active_theme_id === $theme->id ? 'is-active' : '' }}">
                    <div class="portal-template-preview">
                        @if ($theme->preview_image)
                            <img src="{{ asset('storage/' . $theme->preview_image) }}" alt="{{ $theme->name }}">
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
                            <a href="{{ route('preview.theme', $theme->id) }}" target="_blank" class="portal-btn portal-btn-ghost">
                                Preview
                            </a>

                            <form method="POST" action="{{ route('dashboard.theme.update') }}" class="ajax-form inline">
                                @csrf
                                <input type="hidden" name="active_theme_id" value="{{ $theme->id }}">

                                <button type="submit" class="portal-btn portal-btn-primary">
                                    {{ $user->active_theme_id === $theme->id ? 'Selected' : 'Use Template' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    @endif

    @push('portal-scripts')
        @include('dashboard.partials.scripts-ajax-forms')
    @endpush

</x-portal-layout>

<style>
.portal-section-label{
    margin:0 0 6px;
    color:#6b7280;
    font-size:14px;
    font-weight:600;
}
</style>
