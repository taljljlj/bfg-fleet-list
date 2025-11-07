<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @stack('headers')

    <title>{{ config("app.name") }}</title>

    <link rel="icon" type="image/x-icon" href="{{ asset("images/favicon.png") }}">

    <!-- Fonts -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=League+Gothic&display=swap');
    </style>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=League+Gothic&family=Pathway+Gothic+One&display=swap');
    </style>

    <!-- Styles -->
    @vite('resources/css/app.css')
</head>
<body id="mainBody" class="bg-tertiary flex flex-col min-h-screen">
    <header id="bfgHeader">
        <div class="banner-container">
            <a class="logo-home" href="{{ route('home') }}">
                <img id="bfg-logo" src="{{ asset("images/bfg-logo.png") }}" alt="bfg logo">
            </a>
        </div>
    </header>
    <div id="navbar">
        <div class="navbar-container">
            <ul>
                <li><a href="{{ route('builder.index') }}">Fleet Builder</a></li>
                <li>
                    <div id="userDropdownBtn"><img src="{{ asset("images/user-icon.png") }}" alt="user logo"></div>
                </li>
            </ul>
        </div>
    </div>
    @yield('content')
    <footer>
        @stack('scripts')
    </footer>
</body>
</html>
