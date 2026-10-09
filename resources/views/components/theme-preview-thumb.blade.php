@props(['theme', 'compact' => false])

<div {{ $attributes->merge(['class' => 'theme-preview-thumb']) }}>
    @if ($theme->hasStoredPreviewImage())
        <img
            src="{{ $theme->previewImageUrl() }}"
            alt="{{ $theme->name }} template preview"
            loading="lazy"
            width="400"
            height="300"
        >
    @elseif ($compact)
        <div class="theme-preview-mock theme-preview-mock--{{ $theme->slug }}" aria-hidden="true">
            <div class="theme-preview-mock-chrome">
                <span></span><span></span><span></span>
            </div>
            <div class="theme-preview-mock-hero"></div>
            <div class="theme-preview-mock-grid">
                <span></span><span></span><span></span><span></span>
            </div>
        </div>
    @else
        <iframe
            src="{{ route('preview.theme', $theme->id) }}"
            title="{{ $theme->name }} preview"
            style="width: 400%; height: 400%; transform: scale(0.25); transform-origin: 0 0;"
            loading="lazy"
            tabindex="-1"
        ></iframe>
    @endif
</div>
