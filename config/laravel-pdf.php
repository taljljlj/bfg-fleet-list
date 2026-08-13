<?php

return [
    'driver' => env('LARAVEL_PDF_DRIVER', 'cloudflare'),

    'drivers' => [
        'browsershot' => [
            // Browsershot options
        ],
        'cloudflare' => [
            'api_token' => env('CLOUDFLARE_API_TOKEN'),
            'account_id' => env('CLOUDFLARE_ACCOUNT_ID'),
        ],
    ],
];
