<div class="card-ship border-3 border-secondary rounded-md w-[600px] backdrop-blur-sm bg-secondary mb-5">
    <div class="card-ship-header relative bg-primary-500-opc-80 text-secondary flex flex-row justify-between items-center text-3xl z-10 py-1.5">
        <div class="card-subsec-l">
            @if($ship->type === 'Escort')
                <div class="card-ship-class heading">
                    {{ $ship->class . ($ship->type==='Escort' ? ' Squadron (' . $ship->pivot->squadron_counter . ')' : '') }}
                </div>
            @else
                <div class="card-ship-class heading">{{ $ship->class }}</div>
            @endif
        </div>
        <div class="card-subsec-r px-2.5">
            <div class="card-ship-ld card-input heading px-2.5">
                <label for="cardShipLd">Ld: </label>
                <input
                    type="text"
                    name="cardShipLd"
                    readonly
                    placeholder="{{ $ship->pivot->leadership }}"
                    @if($ship->type === 'Escort')
                        class="ship-escort-ld w-24 text-2xl bfi-input light-input m-0 p-0 text-center placeholder:text-secondary"
                    @else
                        class="w-8 text-2xl bfi-input light-input m-0 p-0 text-center placeholder:text-secondary"
                    @endif
                />
            </div>
            <div class="card-ship-pts card-input heading px-2.5">
                <label for="cardShipPts">Pts: </label>
                <input
                    type="number"
                    class="w-14 text-2xl bfi-input light-input m-0 p-0 text-center placeholder:text-secondary"
                    name="cardShipPts"
                    readonly
                    @if($ship->type === 'Escort')
                        placeholder="{{ $ship->pivot->points * $ship->pivot->squadron_counter }}"
                    @else
                        placeholder="{{ $ship->pivot->points }}"
                    @endif
                />
            </div>
        </div>
    </div>

    <div class="card-ship-body font-secondary tracking-tight flex flex-wrap flex-row pt-0.5">
        <div class="card-section-t flex justify-evenly items-center w-full">
            <div class="card-subsec-l flex flex-col w-1/2 relative">
                <div class="card-ship-img">
                    <img
                        src="{{ asset(file_exists(public_path('images/ships/' . $ship->img_url)) ? ('images/ships/' . $ship->img_url) : ('images/ships/ship-no-image.png')) }}"
                        alt="Ship Profile Image"
                        class="drop-shadow-[0_0_15px_rgb(54,87,115)]">
                </div>
                @php
                    $shipCommander = $commanders?->first(function ($commander) use ($ship) {
                        return $commander->pivot->fleet_ship_id === $ship->pivot->id;
                    })
                @endphp
                @if($shipCommander)
                    <div class="absolute bottom-0 left-2.5 flex items-end">
                        <img src="{{ asset('images/fleet-builder/commander-icon.png') }}" alt="Commander Icon" class="h-8 opacity-80 inline-block">
                        <span class="font-family-secondary text-primary-500-opc-80 text-md inline-block ml-1">{{ $shipCommander->name }}</span>
                    </div>
                @endif
            </div>
            <div class="card-subsec-r flex flex-col w-1/2 px-2.5">
                <input
                    type="text"
                    class="w-full text-lg font-thin px-2.5 py-0 text-ellipsis border-primary-500-opc-80 text-primary-500-opc-80 focus-visible:shadow-[inset_0_0_5px_#365773CC] placeholder:text-primary-500-opc-80 bfi-input m-0 text-center"
                    name="cardShipName"
                    placeholder="{{ $ship->pivot->name }}"
                >
                <div class="card-ship-additional card-box-container w-full h-32 overflow-y-auto overflow-x-hidden">
                    <div class="card-ship-special ship-rules-section-container">
                        @if($ship->rules)
                            <ul class="rules-list pl-5 m-0 text-left">
                                @foreach($ship->rules as $rule)
                                    <li>{{ $rule->text }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="card-section-b flex justify-evenly items-center w-full mt-1">
            <div class="card-subsec-l ship-stats-section-container flex flex-col w-1/3">
                <div class="card-ship-stats flex flex-row flex-wrap justify-between w-full items-center\">
                    <div class="stat-box card-box-container">
                        <div class="stat-name">HP</div>
                        <div class="stat-value font-semibold">{{ $ship->hitpoints }}</div>
                    </div>
                    <div class="stat-box card-box-container">
                        <div class="stat-name">Speed</div>
                        <div class="stat-value font-semibold">{{ $ship->pivot->speed ?? $ship->speed }}{{ strlen($ship->speed) > 2 ? '' : 'cm' }}</div>
                    </div>
                    <div class="stat-box card-box-container">
                        <div class="stat-name">Turns</div>
                        <div class="stat-value font-semibold">{{ $ship->pivot->turns ?? $ship->turns }}{{ strlen($ship->turns) > 2 ? '' : '°' }}</div>
                    </div>
                    <div class="stat-box card-box-container">
                        <div class="stat-name">Shields</div>
                        <div class="stat-value font-semibold">{{ $ship->pivot->shields ?? $ship->shields }}</div>
                    </div>
                    <div class="stat-box card-box-container">
                        <div class="stat-name">Armour</div>
                        <div class="stat-value font-semibold">{{ $ship->pivot->armour_short ??  $ship->armour_short }}</div>
                    </div>
                    <div class="stat-box card-box-container">
                        <div class="stat-name">{{ $ship->faction_id === 11 ? 'Spores' : 'Turrets' }}</div>
                        <div class="stat-value font-semibold">{{ $ship->pivot->turrets ?? $ship->turrets }}</div>
                    </div>
                </div>
            </div>
            <div class="card-subsec-r ship-armaments-section-container flex flex-col w-2/3 self-center pr-9">
                @if($ship->armaments)
                    <div class="card-ship-armaments card-box-container flex flex-wrap flex-col self-center items-center w-full">
                        <table class="w-full bg-primary-500-opc-80 border-collapse">
                            <thead class="text-secondary w-full">
                            <tr>
                                <th class="font-normal">Armament</th>
                                <th class="font-normal">Speed/Range</th>
                                <th class="font-normal" colspan="2">Firepower</th>
                            </tr>
                            </thead>
                            <tbody class="bg-secondary">
                            @foreach($ship->armaments as $armament)
                                @if($armament->placement !== 'Starboard')
                                    <tr class="border-t-2 border-b-primary-500-opc-80 relative after:content-[''] after:block after:absolute after:-top-0.5 after:-right-7 after:w-6 after:h-6 after:bg-contain after:bg-no-repeat {{ 'firearc-' . $armament->fire_arc_short }}">
                                        <!-- 1st col -->
                                        <td class="border-r-2 border-b-primary-500-opc-80">{{ ($armament->placement === 'Port' ? 'Pt|Sb' : $armament->placement) . ' ' . $armament->type }}</td>

                                        <!-- 2nd col -->
                                        @if($armament->pivot->range_speed)
                                            <td class="border-r-2 border-b-primary-500-opc-80">{{ $armament->pivot->range_speed }}</td>
                                        @elseif($armament->pivot->misc)
                                            <td class="border-r-2 border-b-primary-500-opc-80">{{ $armament->pivot->misc }}</td>
                                        @else
                                            <td class="border-r-2 border-b-primary-500-opc-80">N/A</td>
                                        @endif

                                        <!-- 3rd col -->
                                        @if($armament->placement === 'Port')
                                            <td class="border-r-2 border-b-primary-500-opc-80">{{ $armament->pivot->firepower }}</td>
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
                @endif
            </div>
        </div>
    </div>
</div>
