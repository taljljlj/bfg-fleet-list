@if($ship)
    <div class="card-ship card-box-container my-2">
        <div class="card-header flex justify-center py-1 px-3 border-b-2 border-b-secondary items-center text-lg">
            <div class="card-subsec-l flex grow items-center">
{{--                <div class="card-faction-img">--}}
{{--                    <img src="{{ asset('images/factions/imperium-logo.png') }}" alt="Faction logo">--}}
{{--                </div>--}}
                <div class="card-ship-class heading">{{ $ship->class }} {{ $ship->type === 'Escort' ? 'Squadron (' . $ship->pivot->squadron_counter . ')' : '' }}</div>
                <div class="card-input">
                    <label for="ship-name">{{ $ship->type === 'Escort' ? 'Squadron' : 'Ship' }} Name:</label>
                    <input type="text" name="ship-name" value="{{ $ship->pivot->name ?: '' }}" readonly class="ml-3 mr-2 h-7 text-xl align-middle font-bold text-center p-1 w-56">
                </div>
            </div>
            <div class="card-subsec-r flex flex-row">
                @if($ship->type != 'Escort')
                <div class="card-ship-ld card-input heading">
                    <label for="cardShipLd">Ld:</label>
                    <input type="text" name="cardShipLd" value="{{ $ship->pivot->leadership ?: '' }}" readonly class="mx-2 h-7 text-xl align-middle font-bold text-center p-1 w-7">
                </div>
                @endif
                <div class="card-ship-pts card-input heading">
                    <label for="cardShipPts">{{ $ship->type === 'Escort' ? 'Pts per ship' : 'Pts' }}:</label>
                    <input type="text" name="cardShipPts" placeholder="{{ $ship->pivot->points }}" readonly class="mx-2 h-7 text-xl align-middle font-bold text-center p-1 w-9">
                </div>
            </div>
        </div>
        <div class="card-body flex flex-row flex-wrap font-family-secondary tracking-wide py-3 px-1.5 justify-evenly">
            <div class="card-section-t flex flex-row">
                <div class="card-subsec-l relative">
                    <div class="card-ship-img">
                        <img src="{{ asset(file_exists(public_path('images/ships/' . $ship->img_url)) ? ('images/ships/' . $ship->img_url) : ('images/ships/ship-no-image.png')) }}" alt="Ship Profile Image">
                    </div>
                    @php
                        $shipCommander = $commanders->first(function ($commander) use ($ship) {
                            return $commander->pivot->fleet_ship_id === $ship->pivot->id;
                        })
                    @endphp
                    @if($shipCommander)
                    <div class="commander-tag absolute bottom-0 left-1 flex items-end">
                        <img src="{{ asset('images/fleet-builder/commander-icon.png') }}" alt="Commander Icon" class="h-3.5 opacity-80 inline-block">
                        <span class="text-sm inline-block ml-1 font-family-secondary">{{ $shipCommander->name }}</span>
                    </div>
                    @endif
                </div>
                <div class="card-subsec-r pr-4">
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
            <div class="card-section-b flex flex-row">
                <div class="card-subsec-l">
                        @if($ship->type === 'Escort')
                            @php
                                $escortLdDigits = str_replace('-', '', (string)$ship->pivot->leadership);
                                $escortLd = str_split($escortLdDigits);
                            @endphp
                            <div class="card-ship-hp escorts-hp">
                                <h4>Escorts Ld & HP</h4>
                                @for($i=1; $i<=$ship->pivot->squadron_counter; $i++)
                                    <div class="hp-col">
                                        <div class="hp-box">{{ $escortLd[$i-1] ?? '' }}
                                            <p>{{ $i }}</p>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        @else
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
                        @endif
                    <div class="card-ship-crits {{ $ship->type === 'Escort' ? 'escorts-crits' : '' }}">
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
