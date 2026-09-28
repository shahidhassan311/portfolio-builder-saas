<x-app-layout>
    <div class="portal-app">
        @include('layouts.portal-sidebar', ['active' => $active])

        <div class="portal-app-main">
            @if (session('success'))
                <div class="portal-flash success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="portal-flash error">{{ session('error') }}</div>
            @endif

            <div id="flash-message" class="portal-flash hidden">
                <span id="flash-message-inner"></span>
            </div>

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
