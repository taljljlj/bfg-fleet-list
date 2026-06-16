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
<body id="mainBody" class="bg-tertiary font-family-primary flex flex-col min-h-screen">
    <header id="bfgHeader" class="h-36 bg-cover text-center">
        <div class="banner-container relative h-full">
            <a class="logo-home inline-block pt-3.5 h-4/5" href="{{ route('home') }}">
                <img id="bfg-logo" src="{{ asset("images/bfg-logo.png") }}" alt="bfg logo">
            </a>
        </div>
    </header>
    <div id="navbar" class="font-semibold tracking-tight bg-secondary font-family-primary">
        <div class="navbar-container max-w-[1500px] m-auto">
            <ul class="text-right m-0 p-0 list-none">
                <li class="navbar-li">
                    <a href="{{ route('builder.index') }}" class="block no-underline h-full hover:opacity-80 text-primary-700">Fleet Builder</a>
                </li>
                <li class="navbar-li">
                    <div id="userDropdownBtn" class="hover:opacity-80 h-full"><img src="{{ asset("images/user-icon.png") }}" alt="user logo"></div>
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
