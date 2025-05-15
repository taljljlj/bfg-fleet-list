<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [
    /*
    |--------------------------------------------------------------------------
    | Puppeteer Cache Path
    |--------------------------------------------------------------------------
    |
    | Path where puppeteer stores temp fleet pdf export files
    |
    */

    'browsershot' => [
        'executablePath' => env('CHROME_CACHE_PATH'),
    ]
];
