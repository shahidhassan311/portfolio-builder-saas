@if(count($items) > 0)
<nav class="breadcrumbs" aria-label="Breadcrumb">
    <ol itemscope itemtype="https://schema.org/BreadcrumbList">
        @foreach($items as $index => $item)
            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                @if(!empty($item['url']) && $index < count($items) - 1)
                    <a itemprop="item" href="{{ $item['url'] }}">
                        <span itemprop="name">{{ $item['name'] }}</span>
                    </a>
                @else
                    <span itemprop="name" aria-current="page">{{ $item['name'] }}</span>
                @endif
                <meta itemprop="position" content="{{ $index + 1 }}">
                @if($index < count($items) - 1)
                    <span class="breadcrumbs-sep" aria-hidden="true">/</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
@endif
