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
<body id="mainBody" class="font-family-primary flex flex-col min-h-screen">
    <header id="bfgHeader" class="h-40 bg-cover text-center">
        <div class="banner-container relative h-full">
            <a class="logo-home inline-block h-full" href="{{ route('home') }}">
                <img id="bfg-logo" src="{{ asset("images/bfg-logo.png") }}" alt="bfg logo">
            </a>
        </div>
    </header>
    <nav id="navbar" class="font-semibold tracking-tight bg-secondary font-family-primary">
        <div class="navbar-container max-w-[1500px] m-auto">
            <ul class="text-right m-0 p-0 list-none">
                <li class="navbar-li">
                    <a href="{{ route('builder.index') }}" class="block no-underline h-full hover:opacity-80 text-primary-700">Fleet Builder</a>
                </li>
                <li class="navbar-li">
                    <a href="{{ route('builder.index') }}" class="block no-underline h-full hover:opacity-80 text-primary-700">Battlefield Generator</a>
                </li>
                <li class="navbar-li">
                    <div class="h-full text-primary-700">
                        <img src="{{ asset("images/user-icon.png") }}" alt="user logo" class="inline-block">
                        @if(Auth::user())
                            <span>{{ Auth::user()->name }} (</span>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit"
                                        class="hover:opacity-80 bg-transparent border-0 cursor-pointer p-0 font-inherit text-inherit">
                                    Logout
                                </button>
                            </form>
                            <span>)</span>
                        @else
                            <a href="{{ route('show-login') }}" class="hover:opacity-80">Login</a>
                            <span> / </span>
                            <a href="{{ route('show-register') }}" class="hover:opacity-80">Register</a>
                        @endif
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    @yield('content')
    <footer>
        @stack('scripts')
    </footer>
</body>
</html>
