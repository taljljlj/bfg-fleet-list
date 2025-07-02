@if($ship)
<div class="card-ship" style="order: {{ $shipOrder }}" data-id="{{ $ship->id }}" data-pivot-id="{{ $ship->pivot->id }}">
    <div class="card-header">
        <div class="card-subsec-l">
{{--            <div class="card-faction-img">--}}
{{--                <img src="{{ asset('images/factions/' . $ship->faction->img_url) }}" alt="Faction logo">--}}
{{--            </div>--}}
            <div class="card-ship-class heading">{{ $ship->class }}
                @if($ship->type == 'Escort')
                    {{ ' Squadron' }}
                    <div class="card-ship-amount">
                        <p>&times;</p>
                        <div class="squadron-amount-btn">
                            <button onclick="this.nextElementSibling.stepDown()"><</button>
                            <input type="number" min="1" max="6" title="Number Of Ships" value="1">
                            <button onclick="this.previousElementSibling.stepUp()">></button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="card-subsec-r">
            <div class="card-ship-ld card-input heading">
                <label for="cardShipLd">Ld:</label>
                <input type="text" name="cardShipLd" title="Leadership" {{ $ship->type == 'Escort' ? 'maxlength=1 class=ship-escort-ld' : '' }}>
            </div>
            <div class="card-ship-pts card-input heading">
                <label for="cardShipPts">Pts:</label>
                <input type="text" name="cardShipPts" title="Ship Points Value" value="{{ $ship->pivot->points ?? $ship->points }}">
            </div>
            <div class="card-ship-remove-btn">&times;</div>
        </div>
    </div>
    <div class="card-body thin-font">
        <div class="card-section-t">
            <div class="card-subsec-l">
                @if($ship->refits->isNotEmpty())
                    <div class="card-ship-refit-btn collapsed">
                        <img class="refit-icon" src="{{ asset('images/fleet-builder/refit-icon.png') }}" alt="Refit Icon">
                        <img class="apply-icon" src="{{ asset('images/fleet-builder/apply-icon.png') }}" alt="Refit Icon">
                    </div>
                    <div class="card-ship-refit-container collapsed">
                        <ul>
                        @foreach($ship->refits as $refit)
                            <li class="ship-refit">
                                <label>
                                    <input type="checkbox" name="{{ $refit->name }}" data-refit-pivot-id="{{ $refit->pivot->id }}" {{ (!empty($ship->appliedRefits) && $ship->appliedRefits->contains('ship_refit_id', $refit->pivot->id)) ? 'checked' : '' }}>
                                    {{$refit->text}}
                                    <span class="tooltip">{{ $refit->text_long }}
                                    @foreach($refit->modifications as $mod)
                                        @if($mod->type == 'arm')
                                            @if($mod->action == 'modify')
                                                @php
                                                    $moduleData = json_decode($mod->module);
                                                @endphp
                                                <br>[{{ $moduleData->placement . ' ' . $moduleData->type . ($moduleData->fire_arc ? (' (' . $moduleData->fire_arc . ')') : '') }}: firepower({{ $mod->pivot->firepower ?: 'N/A' }}) range({{ $mod->pivot->range_speed ?: ($mod->pivot->misc ?: 'N/A') }})]
                                            @elseif($mod->action == 'replace' || $mod->action == 'add')
                                                @php
                                                    $valueData = json_decode($mod->value);
                                                @endphp
                                                <br>[{{ $valueData->placement . ' ' . $valueData->type . ($valueData->fire_arc ? (' (' . $valueData->fire_arc . ')') : '') }}: firepower({{ $mod->pivot->firepower ?: 'N/A' }}) range({{ $mod->pivot->range_speed ?: ($mod->pivot->misc ?: 'N/A') }})]
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
                                                    <input type="checkbox" name="{{ $child->name }}" data-refit-pivot-id="{{ $child->pivot->id }}" {{ (!empty($ship->appliedRefits) && $ship->appliedRefits->contains('ship_refit_id', $child->pivot->id)) ? 'checked' : '' }} {{ (!empty($ship->appliedRefits) && $ship->appliedRefits->contains('ship_refit_id', $refit->pivot->id)) ? '' : 'disabled' }}>
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
                    <img src="{{ asset(file_exists(public_path('images/ships/' . $ship->img_url)) ? ('images/ships/' . $ship->img_url) : ('images/ships/ship-no-image.png')) }}" alt="Ship Profile Image">
                </div>
            </div>
            <div class="card-subsec-r">
                <input type="text" name="cardShipName" placeholder="Enter {{ $ship->type == 'Escort' ? 'Squadron' : 'Ship' }} Name">
                <div class="card-ship-additional card-box-container">
                    <div class="card-ship-special ship-rules-section-container">
                        <x-fleet-builder.ship-profile-sections.ship-profile-rules-section :rules="$ship->rules" />
                    </div>
                </div>
            </div>
        </div>
        <div class="card-section-b">
            <div class="card-subsec-l ship-stats-section-container">
                <x-fleet-builder.ship-profile-sections.ship-profile-stats-section :ship="$ship" />
            </div>
            <div class="card-subsec-r ship-armaments-section-container">
                <x-fleet-builder.ship-profile-sections.ship-profile-armaments-section :armaments="$ship->armaments" />
            </div>
        </div>
    </div>
</div>
@endif
