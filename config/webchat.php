<?php

return [

    /*
    |--------------------------------------------------------------------------
    | WebChat.js (on-site AI assistant)
    |--------------------------------------------------------------------------
    |
    | Free, open-source widget: https://webchat-js.pages.dev
    | Works without API keys using local fallback from scraped page content.
    | Optional GROQ_API_KEY enables Groq's free tier (key is sent from the browser).
    |
    */

    'groq_api_key' => env('GROQ_API_KEY'),

    'bot_name' => env('WEBCHAT_BOT_NAME', 'Resumizo Help'),

    'primary_color' => env('WEBCHAT_PRIMARY_COLOR', '#6366f1'),

    'accent_color' => env('WEBCHAT_ACCENT_COLOR', '#0891b2'),

];
