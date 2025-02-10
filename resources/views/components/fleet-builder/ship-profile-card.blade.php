@if($ship)
<div class="card-ship" style="order: {{ $shipOrder }}">
    <div class="card-header">
        <div class="card-subsec-l">
{{--            <div class="card-faction-img">--}}
{{--                <img src="{{ asset('images/factions/' . $ship->faction->img_url) }}" alt="Faction logo">--}}
{{--            </div>--}}
            <div class="card-ship-class heading">{{ $ship->class }}</div>
        </div>
        <div class="card-subsec-r">
            <div class="card-ship-ld card-input heading">
                <label for="cardShipLd">Ld:</label>
                <input type="text" name="cardShipLd">
            </div>
            <div class="card-ship-pts card-input heading">
                <label for="cardShipPts">Pts:</label>
                <input type="text" name="cardShipPts" value="{{ $ship->points }}">
            </div>
            <div class="card-ship-remove-btn">&times;</div>
        </div>
    </div>
    <div class="card-body">
        <div class="card-section-t">
            <div class="card-subsec-l">
                <div class="card-ship-img">
                    <img src="{{ asset('images/ships/emperor-class-battleship-1.png') }}" alt="">
                </div>
            </div>
            <div class="card-subsec-r">
                <input type="text" placeholder="Enter Ship Name">
                <div class="card-ship-additional card-box-container">
                    <div class="card-ship-special">
                        <ul class="ship-specials-container">
                            @foreach($ship->rules as $rule)
                                <li data-special-type="rules">{{ $rule->text }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-ship-options"></div>
                </div>

            </div>
        </div>
        <div class="card-section-b">
            <div class="card-subsec-l">
                <div class="card-ship-stats">
                    <div class="stat-box card-box-container">
                        <div class="stat-name">HP</div>
                        <div class="stat-value">{{ $ship->hitpoints }}</div>
                    </div>
                    <div class="stat-box card-box-container">
                        <div class="stat-name">Speed</div>
                        <div class="stat-value">{{ $ship->speed }}cm</div>
                    </div>
                    <div class="stat-box card-box-container">
                        <div class="stat-name">Turns</div>
                        <div class="stat-value">{{ $ship->turns }}°</div>
                    </div>
                    <div class="stat-box card-box-container">
                        <div class="stat-name">Shields</div>
                        <div class="stat-value">{{ $ship->shields }}</div>
                    </div>
                    <div class="stat-box card-box-container">
                        <div class="stat-name">Armour</div>
                        <div class="stat-value">{{ $ship->armour_short }}</div>
                    </div>
                    <div class="stat-box card-box-container">
                        <div class="stat-name">Turrets</div>
                        <div class="stat-value">{{ $ship->turrets }}</div>
                    </div>
                </div>
            </div>
            <div class="card-subsec-r">
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
                                    @else
                                        <td style="font-size: 14px">Fighter, Bomber</td>
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
    </div>
</div>
@endif
