@extends('layouts.builder-layout')

@section('builder-content')
    <h1>{{ $faction->name }}</h1>
    <h3>{{ $fleetList->name }}</h3>
    <h1><span id="points">0</span> pts.</h1>
    <button id="addShip">Add Ship</button>
    <div id="shipContainer">

    </div>
    <div id="shipModal" class="modal" style="display:none">
        <div class="modal-content">
            <div class="modal-header">
                <div class="dropdown">
                    <div class="dropdown-select"></div>
                    <div class="dropdown-content">
                        <ul>
                            @foreach($shipsGrouped as $type=>$ships)
                                <li><b>{{ $type }}</b></li>
                                @foreach($ships as $ship)
                                    <li>{{ $ship->class }}</li>
                                @endforeach
                            @endforeach
                        </ul>
                    </div>
                </div>
                <span class="modal-close">&times;</span>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var addShipButton = document.getElementById('addShip');
        var shipModal = document.getElementById('shipModal');

        addShipButton.addEventListener('click', function () {
            shipModal.style.display = "block";
        });
    </script>
@endpush
