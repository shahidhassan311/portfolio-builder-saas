{{-- Free AI chat widget (WebChat.js, MIT). Lazy-loaded; no signup required. --}}
<script
    src="https://webchat-js.pages.dev/webchat.min.js"
    data-webchat
    @if (config('webchat.groq_api_key'))
        data-groq-key="{{ config('webchat.groq_api_key') }}"
    @endif
    data-bot-name="{{ config('webchat.bot_name') }}"
    data-primary-color="{{ config('webchat.primary_color') }}"
    data-accent-color="{{ config('webchat.accent_color') }}"
    data-position="bottom-right"
    data-theme="auto"
    data-lazy-load="true"
    data-lazy-scrape="true"
    data-enable-popup="false"
></script>
