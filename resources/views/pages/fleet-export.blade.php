<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <title>Fleet PDF Export</title>

    <!-- Fonts -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=League+Gothic&display=swap');
    </style>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=League+Gothic&family=Pathway+Gothic+One&display=swap');
    </style>

    <!-- Styles -->
    @vite('resources/css/pdf.css')
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
            <div class="card-ship export card-box-container">
                <div class="card-header">
                    <div class="card-subsec-l">
{{--                        <div class="card-faction-img">--}}
{{--                            <img src="{{ asset('images/factions/imperium-logo.png') }}" alt="Faction logo">--}}
{{--                        </div>--}}
                        <div class="card-ship-class heading">Retribution Class Battleship</div>
                        <div class="card-input">
                            <label for="ship-name">Ship Name:</label>
                            <input type="text" name="ship-name">
                        </div>
                    </div>
                    <div class="card-subsec-r">
                        <div class="card-ship-ld card-input heading">
                            <label for="cardShipLd">Ld:</label>
                            <input type="text" name="cardShipLd">
                        </div>
                        <div class="card-ship-pts card-input heading">
                            <label for="cardShipPts">Pts:</label>
                            <input type="text" name="cardShipPts">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-section-t">
                        <div class="card-subsec-l">
                            <div class="card-ship-img">
                                <img src="{{ asset('images/ships/emperor-class-battleship.png') }}" alt="">
                            </div>
                        </div>
                        <div class="card-subsec-r">
                            <div class="card-ship-stats">
                                <div class="stat-box card-box-container">
                                    <div class="stat-name">Speed</div>
                                    <div class="stat-value">15cm</div>
                                </div>
                                <div class="stat-box card-box-container">
                                    <div class="stat-name">Turns</div>
                                    <div class="stat-value">45°</div>
                                </div>
                                <div class="stat-box card-box-container">
                                    <div class="stat-name">Shields</div>
                                    <div class="stat-value">4</div>
                                </div>
                                <div class="stat-box card-box-container">
                                    <div class="stat-name">Armour</div>
                                    <div class="stat-value">5+/F6+</div>
                                </div>
                                <div class="stat-box card-box-container">
                                    <div class="stat-name">Turrets</div>
                                    <div class="stat-value">4</div>
                                </div>
                            </div>
                            <div class="card-ship-armaments card-box-container">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>Armament</th>
                                        <th>Speed/Range</th>
                                        <th colspan="2">Firepower</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="firearc-lr">
                                        <td>Pt|Sb Weapons Battery</td>
                                        <td>60cm</td>
                                        <td>6</td>
                                        <td>6</td>
                                    </tr>
                                    <tr class="firearc-">
                                        <td>Pt|Sb Launch Bays</td>
                                        <td style="font-size: 14px">Fighter, Bomber</td>
                                        <td>4</td>
                                        <td>4</td>
                                    </tr>
                                    <tr class="firearc-lfr">
                                        <td>Dorsal Weapons Battery</td>
                                        <td>60cm</td>
                                        <td colspan="2">5</td>
                                    </tr>
                                    <tr class="firearc-lfr">
                                        <td>Prow Weapons Battery</td>
                                        <td>60cm</td>
                                        <td colspan="2">5</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-section-b">
                        <div class="card-subsec-l">
                            <div class="card-ship-hp">
                                <div class="hp-row-1">
                                    <div class="hp-box"></div>
                                    <div class="hp-box"></div>
                                    <div class="hp-box"></div>
                                    <div class="hp-box"></div>
                                    <div class="hp-box"></div>
                                    <div class="hp-box"></div>
                                </div>
                                <div class="hp-row-2">
                                    <div class="hp-box"></div>
                                    <div class="hp-box"></div>
                                    <div class="hp-box"></div>
                                    <div class="hp-box"></div>
                                    <div class="hp-box"></div>
                                    <div class="hp-box"></div>
                                </div>
                            </div>
                            <div class="card-ship-crits">
                                <h4>Critical Damages</h4>
                                <div class="card-ship-crits-container">
                                    <div class="crit-box">
                                        <div class="crit-dmg-num">2</div>
                                        <div class="crit-dmg-name">Dorsal</div>
                                    </div>
                                    <div class="crit-box">
                                        <div class="crit-dmg-num">3</div>
                                        <div class="crit-dmg-name">Starboard</div>
                                    </div>
                                    <div class="crit-box">
                                        <div class="crit-dmg-num">4</div>
                                        <div class="crit-dmg-name">Port</div>
                                    </div>
                                    <div class="crit-box">
                                        <div class="crit-dmg-num">5</div>
                                        <div class="crit-dmg-name">Prow</div>
                                    </div>
                                    <div class="crit-box">
                                        <div class="crit-dmg-num">6</div>
                                        <div class="crit-dmg-name">Engine</div>
                                    </div>
                                    <div class="crit-box">
                                        <div class="crit-dmg-num">7</div>
                                        <div class="crit-dmg-name">Fire</div>
                                    </div>
                                    <div class="crit-box">
                                        <div class="crit-dmg-num">8</div>
                                        <div class="crit-dmg-name">Thrusters</div>
                                    </div>
                                    <div class="crit-box">
                                        <div class="crit-dmg-num">9</div>
                                        <div class="crit-dmg-name">Bridge</div>
                                    </div>
                                    <div class="crit-box">
                                        <div class="crit-dmg-num">10</div>
                                        <div class="crit-dmg-name">Shields</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-subsec-r">
                            <div class="card-ship-additional">
                                <div class="card-ship-special"></div>
                                <div class="card-ship-options"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
