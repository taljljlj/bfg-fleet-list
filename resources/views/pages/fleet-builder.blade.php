@extends('layouts.builder-layout')

@section('builder-content')
    <div class="section">
        @foreach($factions as $faction)
            <div class="faction">
                <img src="{{ asset('images/factions/' . $faction->img_url) }}" alt="{{ $faction->name }} Logo">
            </div>
        @endforeach
    </div>
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
