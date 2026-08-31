@extends('layouts.builder-layout')

@section('builder-content')
    <div id="fleet-builder-app"
        data-fleet="{{ json_encode($fleet) }}"
        data-factions="{{ json_encode($factions) }}"
        data-fleet-lists="{{ json_encode($fleetLists) }}"
        data-selected-fleet-list="{{ json_encode($selectedFleetList) }}"
        data-ship-list="{{ json_encode($shipList) }}"
        data-ships="{{ json_encode($ships) }}"
        data-commander-list="{{ json_encode($commanderList) }}"
        data-commanders="{{ json_encode($commanders) }}"
        data-csrf-token="{{ csrf_token() }}"
        data-web-routes="{{ json_encode([
            'view' => route('builder.view', $fleet),
            'delete' => route('api.builder.delete', $fleet),
        ]) }}"
    >
        <!-- Vue app -->
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/app.js'])
@endpush
