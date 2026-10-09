@if ($key = config('seo.ahrefs_analytics_key'))
    <script src="https://analytics.ahrefs.com/analytics.js" data-key="{{ $key }}" async></script>
@endif
