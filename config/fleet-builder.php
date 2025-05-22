<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [
    /*
    |--------------------------------------------------------------------------
    | Puppeteer config
    |--------------------------------------------------------------------------
    |
    | Path to chrome/chromium
    |
    */

    'puppeteer' => [
        'chromePath' => env('PUPPETEER_EXECUTABLE_PATH', null),
    ]
];
