<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <x-seo-head :seo="$seo ?? []" :include-performance-hints="true" />
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
        <noscript><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet"></noscript>

        @vite(['resources/css/app.css', 'resources/css/portal.css', 'resources/js/app.js'])
    </head>
    @php
        $usePortalShell = auth()->check() && ! request()->routeIs('admin.*');
    @endphp
    <body class="font-sans antialiased {{ $usePortalShell ? 'portal-body' : '' }}">

        <div class="min-h-screen {{ $usePortalShell ? '' : 'bg-gray-100' }}">
            @if($usePortalShell)
                @include('layouts.portal-navigation')
            @else
                @include('layouts.navigation')
            @endif

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="{{ $usePortalShell ? 'portal-main-slot' : '' }}">
                {{ $slot }}
            </main>
        </div>
        @stack('portal-scripts')
    </body>
</html>
