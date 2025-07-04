@if($ship)
    <div class="card-ship export card-box-container">
        <div class="card-header">
            <div class="card-subsec-l">
{{--                <div class="card-faction-img">--}}
{{--                    <img src="{{ asset('images/factions/imperium-logo.png') }}" alt="Faction logo">--}}
{{--                </div>--}}
                <div class="card-ship-class heading">{{ $ship->class }}</div>
                <div class="card-input">
                    <label for="ship-name">Ship Name:</label>
                    <input type="text" name="ship-name" value="{{ $ship->pivot->name ?: '' }}">
                </div>
            </div>
            <div class="card-subsec-r">
                <div class="card-ship-ld card-input heading">
                    <label for="cardShipLd">Ld:</label>
                    <input type="text" name="cardShipLd" value="{{ $ship->pivot->leadership ?: '' }}">
                </div>
                <div class="card-ship-pts card-input heading">
                    <label for="cardShipPts">Pts:</label>
                    <input type="text" name="cardShipPts" placeholder="{{ $ship->pivot->points }}">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="card-section-t">
                <div class="card-subsec-l">
                    <div class="card-ship-img">
                        <img src="{{ asset(file_exists(public_path('images/ships/' . $ship->img_url)) ? ('images/ships/' . $ship->img_url) : ('images/ships/ship-no-image.png')) }}" alt="Ship Profile Image">
                    </div>
                </div>
                <div class="card-subsec-r">
                    <div class="card-ship-stats">
                        <div class="stat-box card-box-container">
                            <div class="stat-name">Speed</div>
                            <div class="stat-value">{{ $ship->pivot->speed ?? $ship->speed }}cm</div>
                        </div>
                        <div class="stat-box card-box-container">
                            <div class="stat-name">Turns</div>
                            <div class="stat-value">{{ $ship->pivot->turns ?? $ship->turns }}°</div>
                        </div>
                        <div class="stat-box card-box-container">
                            <div class="stat-name">Shields</div>
                            <div class="stat-value">{{ $ship->pivot->shields ?? $ship->shields }}</div>
                        </div>
                        <div class="stat-box card-box-container">
                            <div class="stat-name">Armour</div>
                            <div class="stat-value">{{ $ship->pivot->armour_short ?? $ship->armour_short }}</div>
                        </div>
                        <div class="stat-box card-box-container">
                            <div class="stat-name">Turrets</div>
                            <div class="stat-value">{{ $ship->pivot->turrets ?? $ship->turrets }}</div>
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
                            @foreach($ship->armaments as $armament)
                                @if($armament->placement != 'Starboard')
                                    <tr class="firearc-{{ $armament->fire_arc_short }}">
                                        <td>{{ ($armament->placement === 'Port' ? 'Pt|Sb' : $armament->placement) . ' ' . $armament->type }}</td>
                                        @if($armament->pivot->range_speed)
                                            <td>{{ $armament->pivot->range_speed }}cm</td>
                                        @elseif($armament->pivot->misc)
                                            <td>{{ $armament->pivot->misc }}</td>
                                        @else
                                            <td>N/A</td>
                                        @endif
                                        @if($armament->placement === 'Port')
                                            <td>{{ $armament->pivot->firepower }}</td>
                                            <td>{{ $armament->pivot->firepower }}</td>
                                        @else
                                            <td colspan="2">{{ $armament->pivot->firepower }}</td>
                                        @endif
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-section-b">
                <div class="card-subsec-l">
                    <div class="card-ship-hp">
                        @for($i=1; $i<=$ship->hitpoints;$i++)
                            @if($i==1)
                                <div class="hp-row-1">
                            @endif
                                    <div class="hp-box"></div>
                            @if($i == ($ship->hitpoints/2))
                                </div>
                                <div class="hp-row-2">
                            @endif
                            @if($i == $ship->hitpoints)
                                </div>
                            @endif
                        @endfor
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
                            <div class="crit-box lightgray-bg">
                                <div class="crit-dmg-num">9</div>
                                <div class="crit-dmg-name">Bridge</div>
                            </div>
                            <div class="crit-box lightgray-bg">
                                <div class="crit-dmg-num">10</div>
                                <div class="crit-dmg-name">Shields</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-subsec-r">
                    <div class="card-ship-additional">
                        <ul class="ship-specials-container card-box-container">
                            @foreach($ship->rules as $rule)
                                <li class="ship-special" data-special-type="rules">{{ $rule->text }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
