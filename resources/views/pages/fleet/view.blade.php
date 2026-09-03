@extends('layouts.builder-layout')

@section('builder-content')
    <div class="fleet-builder relative">
        <div class="fixed z-50 top-5 left-1">
            {{-- TODO: implement message box for tooltips much like in editor only non-vue --}}
            <MessageBox />
        </div>
        <!-- Faction Selection -->
        <div class="section section-top">
            <div class="flex flex-row justify-between px-12 py-3 align-middle">
                <div class="text-center user-select-none">
                    <div class="flex flex-row justify-center">
                        @if($fleet->faction)
                            <img src="{{ asset('images/factions/' . $fleet->faction->img_url) }}" alt="{{ $fleet->faction->name }} Logo" class="h-8 mr-2">
                        @endif
                        <h3 class="tracking-wider text-white text-2xl font-bold">
                            @if($fleet->faction)
                                {{ $fleet->faction->name }}
                            @endif
                            @if($fleet->faction && $fleet->fleetList)
                                <span class="font-light tracking-normal">({{ $fleet->fleetList->name }})</span>
                            @endif
                        </h3>
                    </div>
                </div>
                <div>
                    <h1 class="text-4xl">{{ $fleet->name }}</h1>
                </div>
                <div>
                    <h1 class="text-right text-4xl font-bold"><span id="points">{{ $fleet->points }}</span> pts.</h1>
                </div>
            </div>
        </div>

        <!-- Left Section -->
        <div class="section section-left w-60 float-left">
            {{-- TODO: replace vue with blade animation for overlay when user makes requests - i think it is needed only for pdf export --}}
            <div class="section-overlay" v-if="state.isLoading" style="visibility: hidden">
                <img :src="loadingIcon" alt="Loading Icon">
            </div>

            <div class="section-divider divider-r">
                <h1 class="m-0 text-right text-2xl">Fleet template by <strong>{{ $fleet->user->name ?? 'Anonymous' }}</strong></h1>
            </div>

            <!-- Fleet Actions -->
            <div class="fleet-actions flex flex-row justify-evenly pt-2.5 flex-wrap gap-1.5 font-family-secondary tracking-tighter">
                <div id="export_pdf_btn" class="w-16">
                    <div class="btn-primary">
                        <img src="{{ asset('images/fleet-builder/pdf-export-icon.png') }}" alt="PDF Export" class="hover:opacity-80 p-1">
                    </div>
                    <div>Export PDF</div>
                </div>

                <a href="{{ route('builder.view-printable', $fleet) }}" class="w-16">
                    <div class="btn-primary">
                        <img src="{{ asset('images/fleet-builder/print-preview-icon.png') }}" alt="Print Preview" class="hover:opacity-80 p-1">
                    </div>
                    <div>
                        Print Preview
                    </div>
                </a>

                <div id="share_fleet_btn" class="w-16">
                    <div class="btn-primary">
                        <img src="{{ asset('images/fleet-builder/share-icon.png') }}" alt="Share" class="hover:opacity-80 p-1">
                    </div>
                    <div>
                        Share
                    </div>
                </div>

                @can('update', $fleet)
                    <a href="{{ route('builder.edit', $fleet) }}" class="w-16">
                        <div class="btn-primary">
                            <img src="{{ asset('images/fleet-builder/edit-icon.png') }}" alt="Edit" class="hover:opacity-80 p-1">
                        </div>
                        <div>
                            Edit
                        </div>
                    </a>
                @else
                    <form action="{{ route('builder.clone-n-edit', $fleet->id) }}" method="POST" class="w-16">
                        @csrf
                        <button type="submit">
                            <div class="btn-primary">
                                <img src="{{ asset('images/fleet-builder/clone-n-edit-icon.png') }}" alt="Edit" class="hover:opacity-80 p-1">
                            </div>
                            <div>
                                Clone & Edit
                            </div>
                        </button>

                    </form>
                @endcan

                @can('delete', $fleet)
                    <form action="{{ route('builder.delete', $fleet->id) }}" method="POST" class="w-16">
                        @csrf
                        @method('DELETE')
                        <button type="submit">
                            <div class="btn-primary">
                                <img src="{{ asset('images/fleet-builder/delete-icon.png') }}" alt="Delete" class="hover:opacity-80 p-1">
                            </div>
                            <div>
                                Delete
                            </div>
                        </button>
                    </form>
                @endcan
            </div>
        </div>

        <!-- Right Section -->
        <div class="section section-right w-[calc(100%-290px)] min-h-[50vh] float-right flex flex-col">
            <div class="section-overlay" v-if="state.isLoading" style="visibility: hidden">
                <img :src="loadingIcon" alt="Loading Icon">
            </div>
            <div class="fleet-setup-container section-divider divider-r flex flex-row">
                <div class="flex-1/3 pb-4">
                    @if($fleet->commanders)
                    <!-- Commander Setup -->
                    @foreach($fleet->commanders as $commander)
                        @php
                            $commanderShip = $fleet->ships->first(function ($ship) use ($commander) {
                                return $ship->pivot->id === $commander->pivot->fleet_ship_id;
                            });
                        @endphp
                        @if($loop->first)
                            <h2 class="text-2xl mb-4">Fleet Commander:</h2>
                        @elseif($loop->index === 1)
                            <h2 class="text-2xl my-4">Ship Commander{{ $loop->count > 2 ? 's' : '' }}:</h2>
                        @endif
                        <h3 class="text-xl flex align-middle px-4">{{ $commander->name }} ({{ $commander->pivot->points }} Pts) Ld:{{ $commander->leadership }} [{{ $commanderShip ? ($commanderShip->pivot->name ?? $commanderShip->class) : 'No ship assigned' }}]
                            @for($i=0; $i<$commander->rolls; $i++)
                                <span>
                                    <img class="h-7 ml-2 invert opacity-60" src="{{ asset('images/fleet-builder/reroll-icon.png') }}" alt="Re-roll Icon">
                                </span>
                            @endfor
                            @for($i=$commander->rolls;$i<$commander->pivot->rolls; $i++)
                                <span>
                                    <img class="h-7 ml-2 opacity-60" src="{{ asset('images/fleet-builder/extra-reroll-icon.png') }}" alt="Re-roll Icon">
                                </span>
                            @endfor
                        </h3>
                    @endforeach
                    @else
                        <h2 class="text-2xl my-4">This fleet has no commanders assigned</h2>
                    @endif
                </div>
                <div class="flex-1/3">
                </div>
                <div class="flex-1/3">
                </div>
            </div>

            <!-- Ship Cards -->
            <div class="ship-card-container flex flex-wrap flex-row text-center justify-evenly w-full pt-5">
                @if($fleet->ships)
                    @foreach($fleet->ships as $ship)
                        <x-fleet.ship-profile-card :ship="$ship" :commanders="$fleet->commanders"/>
                    @endforeach
                @else
                    <h2 class="text-2xl mt-8">No ships have been added to the fleet yet</h2>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('modals')
    <x-fleet.share-modal :fleet="$fleet"/>
@endsection

@push('scripts')
    <script data-origin="fleet-view">
        document.addEventListener('DOMContentLoaded', () => {
            const exportPdfButton = document.getElementById('export_pdf_btn');

            if (!exportPdfButton && !shareFleetButton) {
                return;
            }

            exportPdfButton.addEventListener('click', async () => {
                try {
                    const response = await fetch('/api/{{ $fleet->id }}/export-pdf/', {
                        method: 'GET'
                    });

                    if (!response.ok) {
                        console.error('Failed to fetch PDF:', response.status, response.statusText);
                        alert('+++ Vox Interruption +++\r\nData-slate request denied. The Machine Spirit refuses to yield the PDF. Review fleet data and renew the request.');
                        return;
                    }

                    const blob = await response.blob();
                    const url = window.URL.createObjectURL(blob);
                    const downloadLink = document.createElement('a');

                    downloadLink.href = url;
                    downloadLink.download = 'fleet-builder.pdf';
                    document.body.appendChild(downloadLink);
                    downloadLink.click();
                    downloadLink.remove();
                    window.URL.revokeObjectURL(url);
                } catch (error) {
                    console.error('Error:', error);
                    alert('+++ Vox Interruption +++\r\nData-slate request denied. The Machine Spirit refuses to yield the PDF. Review fleet data and renew the request.');
                }
            });
        });
    </script>
@endpush
