@if($ship)
<div class="card-ship" style="order: {{ $shipOrder }}" data-id="{{ $ship->id }}" data-pivot-id="{{ $ship->pivot_id }}">
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
    <div class="card-body thin-font">
        <div class="card-section-t">
            <div class="card-subsec-l">
                @if($ship->refitParents->isNotEmpty())
                    <div class="card-ship-refit-btn">
                        <img src="{{ asset('images/fleet-builder/refit-icon.png') }}" alt="Refit Icon">
                    </div>
                    <div class="card-ship-refit-container collapsed">
                        <ul>
                        @foreach($ship->refitParents as $refit)
                            <li class="ship-refit">
                                <label>
                                    <input type="checkbox" name="{{ $refit->name }}">
                                    {{$refit->text}}
                                    <span class="tooltip">{{ $refit->text_long }}
                                    @foreach($refit->modifications as $mod)
                                        @if($mod->type == 'arm')
                                            @if($mod->action == 'modify')
                                                <br>[{{ $mod->module }}: firepower({{ $mod->pivot->firepower ?: 'N/A' }}) range({{ $mod->pivot->range_speed ?: ($mod->pivot->misc ?: 'N/A') }})]
                                            @elseif($mod->action == 'replace' || $mod->action == 'add')
                                                <br>[{{ $mod->value }}: firepower({{ $mod->pivot->firepower ?: 'N/A' }}) range({{ $mod->pivot->range_speed ?: ($mod->pivot->misc ?: 'N/A') }})]
                                            @endif
                                        @endif
                                    @endforeach
                                    </span>
                                    <span> ({{ $refit->pivot->points }}pts)</span>
                                </label>
                                @if($refit->children->isNotEmpty())
                                    <ul class="ship-refits-children">
                                        @foreach($refit->children as $child)
                                            <li class="ship-refit">
                                                <label>
                                                    <input type="checkbox" name="{{ $child->name }}">
                                                    {{ $child->text }}
                                                    <span class="tooltip">{{ $child->text_long }}</span>
                                                    <span> ({{ $child->pivot->points }}pts)</span>
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-ship-img">
                    <img src="{{ asset('images/ships/' . $ship->img_url) }}" alt="Ship Profile Image">
                </div>
            </div>
            <div class="card-subsec-r">
                <input type="text" name="cardShipName" placeholder="Enter Ship Name">
                <div class="card-ship-additional card-box-container">
                    <div class="card-ship-special">
                        <ul class="ship-specials-container">
                            @foreach($ship->rules as $rule)
                                <li class="ship-special" data-special-type="rules">{{ $rule->text }}<span class="tooltip">{{ $rule->text_long }}</span></li>

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
    </div>
</div>
@endif
