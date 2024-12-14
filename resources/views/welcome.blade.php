<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Battlefleet Gothic Fleetlist Generator</title>

        <link rel="icon" type="image/x-icon" href="{{ asset("images/favicon.png") }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>

        </style>
    </head>
    <body>
        <header id="bfg-header">
            <div class="banner-container">
                <img id="bfg-logo" src="{{ asset("images/bfg-logo.png") }}" alt="bfg logo">
            </div>
        </header>
        <div class="quick-get-started">
            <h1>Build your fleet!</h1>
            <!-- TODO: use gw2skills landing page for reference -->
        </div>
    <div class="explore-fleets">
        <h1>Explore fleets</h1>
        <div class="most-popular">
            <h2>Most popular fleets</h2>
        </div>
    </div>
    </body>
</html>
