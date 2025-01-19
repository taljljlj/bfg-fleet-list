<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config("app.name") }}</title>

    <link rel="icon" type="image/x-icon" href="{{ asset("images/favicon.png") }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=League+Gothic&display=swap');
    </style>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=League+Gothic&family=Pathway+Gothic+One&display=swap');
    </style>

    <!-- Styles -->
    @vite('resources/css/app.css')
</head>
<body id="main_body">
<header id="bfg_header">
    <div class="banner-container">
        <a id="logo_home" href="{{ route('home') }}">
            <img id="bfg_logo" src="{{ asset("images/bfg-logo.png") }}" alt="bfg logo">
        </a>
    </div>
</header>
<div id="navbar">
    <div class="navbar-container">
        <ul>
            <li><a href="{{ route('editor.index') }}">Fleet Editor</a></li>
            <li>
                <div id="user_dropdown_btn"><img src="{{ asset("images/user-icon.png") }}" alt="user logo"></div>
            </li>
        </ul>
    </div>
</div>
<div id="page_content">
    @yield('content')
</div>
</body>
</html>
