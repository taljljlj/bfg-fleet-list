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
        @page {
            size: A4 portrait;
            margin: 0;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: "League Gothic", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
            font-variation-settings:
                "wdth" 100;
            letter-spacing: 1px;
            background-color: dimgray;
        }

        .page {
            background-color: white;
            width: 210mm;
            margin: 0 auto;
            padding: 10mm;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
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

        .header h4 {
            font-size: 0.8em;
        }

        .header .commander-list h4 {
            display: flex;
            vertical-align: middle;
            margin: 15px 0;
        }

        .header .commander-reroll-img {
            height: 16px;
            margin-left: 10px;
            opacity: 0.6;
        }

        .ships-container {
            padding: 10px;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
        }

        .ships-container .new-page {
            margin-top: 100px;
        }

        .card-box-container {
            border: 2px solid black;
            border-radius: 5px;
        }

        .card-ship {
            margin: 5px 0;
        }

        .card-ship .card-header {
            background-color: lightgray;
            display: flex;
            justify-content: center;
            padding: 3px 12px;
            border-bottom: 2px solid black;
            align-items: center;
            font-size: 12px;
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
            margin: 0 7px;
        }

        .card-ship .card-header .card-subsec-l .card-input {
            margin-left: 8%;
        }

        .card-ship .card-header .card-input input {
            height: 25px;
            font-size: 16px;
            vertical-align: middle;
            font-weight: bold;
            text-align: center;
            border-radius: 5px;
            padding: 1px;
        }

        .card-ship .card-header .card-input input::placeholder {
            color: black;
        }

        .card-ship .card-header .card-ship-class,
        .card-ship .card-header label {
            font-size: 12px
        }

        .card-ship .card-header .card-subsec-l .card-input input {
            width: 220px;
        }

        .card-ship .card-header .card-input.card-ship-ld input {
            width: 25px;
        }

        .card-ship .card-header .card-input.card-ship-pts input {
            width: 35px;
        }

        .card-ship .card-body {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            font-family: "Pathway Gothic One", sans-serif;
            letter-spacing: 0.5px;
            padding: 10px 5px;
            justify-content: space-evenly;
        }

        .card-ship .card-body .card-section-t,
        .card-ship .card-body .card-section-b {
            display: flex;
            flex-direction: row;
        }

        .card-ship .card-body .card-section-t .card-subsec-r {
            padding-right: 15px;
        }

        .card-ship .card-body .card-section-t .card-subsec-l {
            position: relative;
        }

        .card-ship .card-body .card-section-t .commander-tag {
            position: absolute;
            bottom: 0;
            left: 4px;
            display: flex;
            align-items: end;
        }

        .card-ship .card-body .card-section-t .commander-tag img {
            height: 14px;
            opacity: 0.8;
            display: inline-block;
            filter: grayscale(1);
        }

        .card-ship .card-body .card-section-t .commander-tag span {
            font-family: "Pathway Gothic One", sans-serif;
            font-size: 10px;
            display: inline-block;
            margin-left: 2px;
        }

        .card-ship .card-body .card-ship-img {
            box-sizing: border-box;
            width: 140px;
            padding: 5px;
            filter: grayscale(1);
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
            padding: 2px 1px;
            width: 40px;
            margin: 1px;
            border-radius: 5px 5px 0 0;
            border: 1px solid black;
            text-align: center;
        }

        .card-ship .card-body .card-ship-stats .stat-box:first-child {
            margin-left: 0;
        }

        .card-ship .card-body .card-ship-stats .stat-box:last-child {
            margin-right: 0;
        }

        .card-ship .card-body .card-ship-stats .stat-box .stat-value {
            font-size: 9px;
            font-weight: 600;
        }

        .card-ship .card-body .card-ship-stats .stat-box .stat-name {
            font-size: 8px;
        }

        .card-ship .card-body .card-ship-armaments {
            box-sizing: border-box;
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
            align-self: center;
            align-items: center;
            width: 100%;
            border-width: 1px;
            border-radius: 0 0 5px 5px;
        }

        .card-ship .card-body table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            font-size: 10px;
        }

        .card-ship .card-body table thead {
            border-radius: 5px 5px 0 0;
        }

        .card-ship .card-body table thead th {
            font-weight: 600;
            background-color: lightgray;
        }

        .card-ship .card-body table tbody tr {
            border-top: 1px solid black;
            position: relative;
        }

        .card-ship .card-body table tbody td {
            border-right: 1px solid black;
        }

        .card-ship .card-body table tbody td:last-child {
            border-right: 0;
        }

        .card-ship .card-body table tbody tr:after {
            content: '';
            display: block;
            position: absolute;
            top: 0;
            right: -15px;
            width: 11px;
            height: 11px;
            background-size: contain;
            background-repeat: no-repeat;
        }

        .card-ship .card-body table tbody tr.firearc-lr:after {
            background-image: url('{{ asset('images/fleet-builder/firearc-lr.png') }}');
            filter: grayscale(1);
        }

        .card-ship .card-body table tbody tr.firearc-f:after {
            background-image: url('{{ asset('images/fleet-builder/firearc-f.png') }}');
            filter: grayscale(1);
        }

        .card-ship .card-body table tbody tr.firearc-lfr:after {
            background-image: url('{{ asset('/images/fleet-builder/firearc-lfr.png') }}');
            filter: grayscale(1);
        }

        .card-ship .card-body .card-ship-hp {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        .card-ship .card-body .card-ship-hp.escorts-hp h4 {
            width: 100%;
        }

        .card-ship .card-body .card-ship-hp .hp-row-1,
        .card-ship .card-body .card-ship-hp .hp-row-2 {
            display: flex;
            flex-direction: row;
        }

        .card-ship .card-body .card-ship-hp .hp-col {
            display: flex;
            flex-direction: column;
        }

        .card-ship .card-body .card-ship-hp .hp-box {
            width: 13px;
            height: 13px;
            border-radius: 3px;
            border: 1px solid black;
            margin: 1px 1px;
        }

        .card-ship .card-body .card-ship-hp.escorts-hp .hp-box {
            width: 20px;
            height: 16px;
            border-radius: 0 0 5px 5px;
            border: 1px solid black;
            margin: 1px 1px;
            font-size: 14px;
            text-align: center;
            font-weight: 600;
            color: gray;
            line-height: 14px;
            position: relative;
        }

        .card-ship .card-body .card-ship-hp .hp-row-2 .hp-box {
            background-color: lightgray;
        }

        .card-ship .card-body .card-ship-crits h4,
        .card-ship .card-body .card-ship-hp.escorts-hp h4 {
            text-align: center;
            border: 1px solid black;
            border-radius: 5px 5px 0 0;
            background-color: lightgray;
            margin: 2px 0 1px 0;
            font-size: 12px;
        }

        .card-ship .card-body .card-ship-hp.escorts-hp h4 {
            font-size: 10px;
        }

        .card-ship .card-body .card-ship-hp.escorts-hp p {
            position: absolute;
            top: -1px;
            left: 1px;
            line-height: 8px;
            text-align: center;
            margin: 0;
            font-size: 6px;
            color: black;
        }

        .card-ship .card-body .card-ship-crits-container {
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
        }

        .card-ship .card-body .card-ship-crits .crit-box {
            border: 1px solid black;
            border-bottom: none;
            border-image: linear-gradient(to bottom, black 0%, transparent 100%) 1;
            margin: 0 1px;
            text-align: center;
            height: 50px;
            width: 20px;
        }

        .card-ship .card-body .card-ship-crits .crit-box:first-child {
            margin-left: 0;
        }

        .card-ship .card-body .card-ship-crits .crit-box:last-child {
            margin-right: 0;
        }

        .card-ship .card-body .card-ship-crits.escorts-crits .crit-box {
            height: 35px;
        }

        .card-ship .card-body .card-ship-crits.escorts-crits h4 {
            font-size: 10px;
        }

        .card-ship .card-body .card-ship-crits .crit-box .crit-dmg-num {
            font-size: 12px;
            font-weight: 600;
        }

        .card-ship .card-body .card-ship-crits .crit-box .crit-dmg-name {
            letter-spacing: 0;
            font-size: 5px;
        }

        .card-ship .card-body .card-ship-crits .crit-box.lightgray-bg .crit-dmg-num {
            background-color: lightgray;
        }

        .card-ship .card-body .card-ship-crits .crit-box.lightgray-bg .crit-dmg-name {
            background-color: lightgray;
        }

        .card-ship .card-body .ship-specials-container {
            box-sizing: border-box;
            margin: 0 0 0 3px;
            min-height: 85px;
            width: 110px;
            padding: 1px 1px 1px 4px;
            border-width: 1px;
            list-style: none;
            overflow: hidden;
        }

        .card-ship .card-body .ship-specials-container .ship-special {
            font-size: 8px;
            position: relative;
        }

        .card-ship .card-body .ship-specials-container .ship-special:before {
            position: absolute;
            content: '*';
            left: -3px;
            top: 2px;
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="content-wrapper">
            <div class="header">
                <div class="header-l">
                    <h1>{{ $faction->name }}</h1>
                    <h3>{{ $fleetList->name }}</h3>
                </div>
                <div class="header-r">
                    <h1>{{ $fleet->points }}</h1>
                    <h3>Pts</h3>
                </div>
            </div>
            <div class="header">
                <div class="header-l commander-list">
                    @if($commanders)
                        @foreach($commanders as $commander)
                            @php
                                $commanderShip = $ships->first(function ($ship) use ($commander) {
                                    return $ship->pivot->id === $commander->pivot->fleet_ship_id;
                                });
                            @endphp
                            @if($loop->first)
                                <h3>Fleet Commander:</h3>
                            @elseif($loop->index === 1)
                                <h3>Ship Commander{{ $loop->count > 2 ? 's' : '' }}:</h3>
                            @endif
                                <h4>{{ $commander->name }} ({{ $commander->pivot->points }} Pts) [{{ $commanderShip ? ($commanderShip->pivot->name ?? $commanderShip->class) : 'No ship assigned' }}]
                                    @for($i=0; $i<$commander->pivot->rolls; $i++)
                                        <span>
                                            <img class="commander-reroll-img" src="{{ asset('images/fleet-builder/reroll-icon.png') }}" alt="Re-roll Icon">
                                        </span>
                                    @endfor
                                </h4>
                        @endforeach
                    @else
                        <h3>This fleet has no commanders assigned</h3>
                    @endif
                </div>
            </div>
            <div class="ships-container">
                @if($ships)
                    @foreach($ships as $ship)
                        <x-fleet-builder.ship-profile-card-export :ship="$ship" :commanders="$commanders"/>
                        @if (($loop->index + 1) % 5 == 0 && !$loop->last)
                            <div style="page-break-after: always;"></div>
                            <div class="new-page"></div>
                        @endif
                    @endforeach
                @else
                    <h3>No ships have been added to the fleet yet</h3>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
