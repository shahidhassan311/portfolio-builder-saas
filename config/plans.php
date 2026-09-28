<?php

return [
    'free' => [
        'name' => 'Free',
        'tagline' => 'Perfect to launch your first portfolio',
        'price' => '$0',
        'price_suffix' => '/ forever',
        'features' => [
            'templates' => 'All portfolio templates',
            'live_link' => 'Live portfolio link',
            'pdf' => 'PDF export',
            'edits' => 'Unlimited content edits',
            'theme' => 'Theme switching',
        ],
    ],

    'pro' => [
        'name' => 'Pro',
        'tagline' => 'For serious job hunts & client work',
        'price' => 'Launching soon',
        'badge' => 'Coming soon',
        'available' => false,
        'features' => [
            'everything_free' => 'Everything in Free',
            'custom_domain' => 'Custom domain support',
            'pdf_priority' => 'Priority PDF quality',
            'branding' => 'Remove branding',
            'support' => 'Priority email support',
        ],
    ],

    'teams' => [
        'name' => 'Teams',
        'tagline' => 'Bootcamps, agencies & career centers',
        'price' => 'Custom',
        'features' => [
            'bulk' => 'Bulk student accounts',
            'library' => 'Shared template library',
            'admin' => 'Admin dashboard',
            'onboarding' => 'Onboarding support',
        ],
    ],
];
