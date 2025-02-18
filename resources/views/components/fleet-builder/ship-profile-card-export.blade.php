@if($ship)
    <div class="card-ship export card-box-container">
        <div class="card-header">
            <div class="card-subsec-l">
{{--                <div class="card-faction-img">--}}
{{--                    <img src="{{ asset('images/factions/imperium-logo.png') }}" alt="Faction logo">--}}
{{--                </div>--}}
                <div class="card-ship-class heading">Emperor Class Battleship</div>
                <div class="card-input">
                    <label for="ship-name">Ship Name:</label>
                    <input type="text" name="ship-name" placeholder="">
                </div>
            </div>
            <div class="card-subsec-r">
                <div class="card-ship-ld card-input heading">
                    <label for="cardShipLd">Ld:</label>
                    <input type="text" name="cardShipLd">
                </div>
                <div class="card-ship-pts card-input heading">
                    <label for="cardShipPts">Pts:</label>
                    <input type="text" name="cardShipPts" placeholder="365">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="card-section-t">
                <div class="card-subsec-l">
                    <div class="card-ship-img">
                        <img src="./Fleet PDF Export_files/emperor-class-battleship.png" alt="">
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
                            <div class="stat-value">5+</div>
                        </div>
                        <div class="stat-box card-box-container">
                            <div class="stat-name">Turrets</div>
                            <div class="stat-value">5</div>
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
                        <ul class="ship-specials-container card-box-container">
                            <li class="ship-special">Come To A New Heading disabled</li>
                            <li class="ship-special">Prow Sensors: +1 Ld</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
