@extends('layouts.builder-layout')

@section('builder-content')
    <div class="section section-top">
        @foreach($factions as $faction)
            <div class="faction">
                <img src="{{ asset('images/factions/' . $faction->img_url) }}" alt="{{ $faction->name }} Logo">
                <h3>{{ $faction->name }}</h3>
            </div>
        @endforeach
    </div>
    <div class="section section-left">
        <div class="section-overlay" style="display: none">
            <img src="{{ asset('images/loading-icon.png') }}" alt="Loading Icon">
        </div>
        <div class="section-subsection">
            <h1><span id="points">0</span> pts.</h1>
        </div>
        <div class="section-subsection">
            <h3>Fleet List:</h3>
            <div id="fleetlistDropdownBtn" class="dropdown">
                <div class="dropdown-select">
                    <span id="dropdownSelected"></span>
                    <span class="dropdown-caret"><img src="{{ asset('images/caret-icon.png') }}" alt="Caret"></span>
                </div>
                <div class="dropdown-content" style="display: none">
                    <ul id="fleetListDropdown">
                        <li>Test 1</li>
                        <li>Test 2</li>
                        <li>Test 3</li>
                        <li>Test 4</li>
                        <li>Test 5</li>
                        <li>Test 6</li>
                        <li>Test 7</li>
                        <li>Test 8</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="section section-right">
        <div class="section-overlay" style="display: none">
            <img src="{{ asset('images/loading-icon.png') }}" alt="Loading Icon">
        </div>
    </div>
@endsection

@push('scripts')
    {{--Faction selection script--}}
    <script>
        var factions = document.querySelectorAll('.faction');

        factions.forEach(faction => {
            faction.addEventListener('click', function () {
                clearSelected();
                // Toggle the 'selected' class on click
                this.classList.add('selected');
            });
        });

        function clearSelected() {
            var selectedFaction = document.querySelector('.faction.selected');
            if (selectedFaction) {
                selectedFaction.classList.remove('selected');
            }
        }
    </script>
    {{--Fleet List Selection Script--}}
    <script>
        var fleetListDropdown = document.getElementById('fleetlistDropdownBtn');
        var fleetListDropdownContent = document.querySelector('#fleetlistDropdownBtn .dropdown-content');

        fleetListDropdown.addEventListener('click', function () {
            fleetListDropdownContent.style.display = fleetListDropdownContent.style.display === 'none' ? 'block' : 'none';
        })
    </script>
@endpush
