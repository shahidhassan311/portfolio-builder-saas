<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <x-seo-head :seo="$seo" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet"></noscript>
    @vite(['resources/css/landing.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="marketing">
<div class="page {{ $attributes->get('class') }}">
    <x-header :activePage="$activePage" />

    @if($showBreadcrumbs && !empty($seo['breadcrumbs']))
        <div class="max breadcrumbs-wrap">
            <x-breadcrumbs :items="$seo['breadcrumbs']" />
        </div>
    @endif

    {{ $slot }}

    <x-marketing-footer />
</div>
</body>
</html>
