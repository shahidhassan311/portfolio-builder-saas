<x-app-layout>
    <div class="portal-app">
        @include('layouts.portal-sidebar', ['active' => $active])

        <div class="portal-app-main">
            <header class="portal-page-head">
                <div class="portal-page-head-inner">
                    @php $planConfig = auth()->user()->planConfig(); @endphp
                    <span class="portal-plan-pill portal-plan-pill--{{ auth()->user()->planKey() }}">
                        {{ $planConfig['name'] }} plan
                    </span>
                    <h1>{{ $title }}</h1>
                    @if ($description)
                        <p>{{ $description }}</p>
                    @endif
                </div>
            </header>

            <div class="portal-page-body">
                {{ $slot }}
            </div>
        </div>
    </div>

</x-app-layout>
