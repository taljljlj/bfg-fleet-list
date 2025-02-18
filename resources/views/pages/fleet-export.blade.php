<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <title>Fleet PDF Export</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=League+Gothic&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=League+Gothic&family=Pathway+Gothic+One&display=swap">

    <!-- Styles -->
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: auto;
            padding: 50px 25px;
            font-family: "League Gothic", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
            font-variation-settings:
                "wdth" 100;
            letter-spacing: 1px;
        }

        img {
            max-width: 100%;
            max-height: 100%;
        }

        .content-wrapper {
            border: 2px solid black;
            border-radius: 10px;
        }

        .header {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            border-bottom: 2px solid black;
            padding: 10px 0;
        }

        .header h1,
        .header h3 {
            margin: 0;
            text-align: center;
        }

        .header h1 {
            font-size: 1.5em;
        }

        .header h3 {
            font-size: 1em;
        }

        .ships-container {
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
        }
        .card-box-container {
            border: 2px solid black;
            border-radius: 5px;
        }

        .card-ship {
            margin: 10px 0;
        }

        .card-ship .card-header {
            background-color: lightgray;
            display: flex;
            justify-content: center;
            padding: 10px 20px;
            border-bottom: 2px solid black;
            align-items: center;
            font-size: 18px;
        }

        .card-ship .card-header .card-subsec-l {
            display: flex;
            flex-grow: 1;
            align-items: center;
        }

        .card-ship .card-header .card-subsec-r {
            display: flex;
            flex-direction: row;
        }

        .card-ship .card-header .card-input {
            margin: 0 15px;
        }

        .card-ship .card-header .card-subsec-l .card-input {
            margin-left: 15%;
        }

        .card-ship .card-header .card-input input {
            height: 25px;
            font-size: 20px;
            vertical-align: middle;
            font-weight: bold;
            text-align: center;
            border-radius: 5px;
        }

        .card-ship .card-header .card-input input::placeholder {
            color: black;
        }

        .card-ship .card-header .card-subsec-l .card-input input {
            width: 70%;
        }

        .card-ship .card-header .card-input.card-ship-ld input {
            width: 30px;
        }

        .card-ship .card-header .card-input.card-ship-pts input {
            width: 40px;
        }

        .card-ship .card-body {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            font-family: "Pathway Gothic One", sans-serif;
            letter-spacing: 0.5px;
            padding: 10px;
            justify-content: space-evenly;
        }

        .card-ship .card-body .card-section-t,
        .card-ship .card-body .card-section-b {
            display: flex;
            flex-direction: row;
        }

        .card-ship .card-body .card-section-t .card-subsec-r {
            padding-right: 35px;
        }

        .card-ship .card-body .card-ship-img {
            box-sizing: border-box;
            width: 300px;
            padding: 15px;
        }

        .card-ship .card-body .card-ship-stats {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
        }

        .card-ship .card-body .card-ship-stats .stat-box {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3px;
            width: 50px;
            margin: 3px;
            border-radius: 5px;
            border: 2px solid black;
            text-align: center;
        }

        .card-ship .card-body .card-ship-stats .stat-box .stat-value {
            font-size: 18px;
            font-weight: 600;
        }

        .card-ship .card-body .card-ship-armaments {
            box-sizing: border-box;
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
            align-self: center;
            align-items: center;
            width: 100%;
        }

        .card-ship .card-body table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        .card-ship .card-body table thead {
            background-color: lightgray;
        }

        .card-ship .card-body table thead th {
            font-weight: 600;
        }

        .card-ship .card-body table tbody tr {
            border-top: 2px solid black;
            position: relative;
        }

        .card-ship .card-body table tbody td {
            border-right: 2px solid black;
        }

        .card-ship .card-body table tbody td:last-child {
            border-right: 0;
        }

        .card-ship .card-body table tbody tr:after {
            content: '';
            display: block;
            position: absolute;
            top: -2px;
            right: -30px;
            width: 22px;
            height: 22px;
            background-size: contain;
            background-repeat: no-repeat;
        }

        .card-ship .card-body table tbody tr.firearc-lr:after {
            background-image: url('@images/fleet-builder/firearc-lr.png');
            filter: grayscale(1);
        }

        .card-ship .card-body table tbody tr.firearc-f:after {
            background-image: url('@images/fleet-builder/firearc-f.png');
            filter: grayscale(1);
        }

        .card-ship .card-body table tbody tr.firearc-lfr:after {
            background-image: url('@images/fleet-builder/firearc-lfr.png');
            filter: grayscale(1);
        }

        .card-ship .card-body .card-ship-hp {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        .card-ship .card-body .card-ship-hp .hp-row-1,
        .card-ship .card-body .card-ship-hp .hp-row-2 {
            display: flex;
            flex-direction: row;
        }

        .card-ship .card-body .hp-box {
            width: 20px;
            height: 20px;
            border-radius: 5px;
            border: 2px solid black;
            margin: 1px 2px;
        }

        .card-ship .card-body .card-ship-hp .hp-row-2 .hp-box {
            background-color: lightgray;
        }

        .card-ship .card-body .card-ship-crits h4 {
            text-align: center;
            border: 2px solid black;
            border-radius: 5px 5px 0 0;
            background-color: lightgray;
            margin: 2px 0 1px 0;
        }

        .card-ship .card-body .card-ship-crits-container {
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
        }

        .card-ship .card-body .card-ship-crits .crit-box {
            border: 2px solid black;
            border-bottom: none;
            border-image: linear-gradient(to bottom, black 0%, transparent 100%) 1;
            margin: 0 1px;
            text-align: center;
            height: 100px;
            padding: 0 2px;
            width: 40px;
        }

        .card-ship .card-body .card-ship-crits .crit-box .crit-dmg-num {
            font-size: 20px;
            font-weight: 600;
        }

        .card-ship .card-body .card-ship-crits .crit-box .crit-dmg-name {
            letter-spacing: 0;
            font-size: 12px;
        }

        .card-ship .card-body .ship-specials-container {
            box-sizing: border-box;
            margin: 0 0 0 10px;
            height: 180px;
            width: 200px;
            padding: 2px 5px 2px 25px;
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <div class="header">
            <div class="header-l">
                <h1>{{ $faction->name }}</h1>
                <h3>{{ $fleetList->name }}</h3>
            </div>
            <div class="header-r">
                <h1>{{ $ships->sum('points') }}</h1>
                <h3>Pts</h3>
            </div>
        </div>
        <div class="ships-container">
            @foreach($ships as $ship)
                <x-fleet-builder.ship-profile-card-export :ship="$ship">
            @endforeach
        </div>
    </div>
</body>
</html>
