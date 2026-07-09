@props([
    'align' => 'right',
    'width' => '56',
    'contentClasses' => 'portal-dropdown-content'
])

@php
$alignmentClasses = match ($align) {
    'left' => 'left-0 origin-top-left',
    'top' => 'origin-top',
    default => 'right-0 origin-top-right',
};

$width = match ($width) {
    '48' => 'w-48',
    '56' => 'w-56',
    default => $width,
};
@endphp

<div class="relative" x-data="{ open: false }" @click.outside="open = false">
    <div @click="open = !open">
        {{ $trigger }}
    </div>

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-1"
        class="absolute {{ $alignmentClasses }} z-50 mt-3 {{ $width }} portal-dropdown"
        style="display:none;"
    >
        <div class="{{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>  
