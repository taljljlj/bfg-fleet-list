@extends('layouts.builder-layout')

@section('builder-content')
    <div class="section section-top">
        @foreach($factions as $faction)
            <div class="faction" data-faction-id="{{ $faction->id }}">
                <img src="{{ asset('images/factions/' . $faction->img_url) }}" alt="{{ $faction->name }} Logo">
                <h3>{{ $faction->name }}</h3>
            </div>
        @endforeach
    </div>
    <div class="section section-left">
        <div class="section-overlay" style="visibility: hidden">
            <img src="{{ asset('images/loading-icon.png') }}" alt="Loading Icon">
        </div>
        <div class="section-subsection">
            <h1><span id="points">0</span> pts.</h1>
        </div>
        <div class="section-subsection">
            <h3>Fleet List:</h3>
            <div id="fleetListDropdownBtn" class="dropdown">
                <div class="dropdown-select">
                    <span id="dropdownSelected"></span>
                    <span class="dropdown-caret"><img src="{{ asset('images/caret-icon.png') }}" alt="Caret"></span>
                </div>
                <div class="dropdown-content" style="display: none">
                    <ul id="fleetListDropdown">
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="section section-right">
        <div class="section-overlay" style="visibility: hidden">
            <img src="{{ asset('images/loading-icon.png') }}" alt="Loading Icon">
        </div>
    </div>
@endsection

@push('scripts')
    {{--Faction selection script--}}
    <script>
        //Global vars
        var factions = document.querySelectorAll('.faction');
        var fleetListDropdown = document.getElementById('fleetListDropdown');
        var fleetListDropdownBtn = document.getElementById('fleetListDropdownBtn');
        var fleetListDropdownContent = document.querySelector('#fleetListDropdownBtn .dropdown-content');
        var fleetListDropdownSelected = document.getElementById('dropdownSelected');

        //Faction selection event listener
        factions.forEach(faction => {
            faction.addEventListener('click', function () {
                // Toggle the 'selected' class on click
                factionClear();
                this.classList.add('selected');

                //Loading overlay
                toggleLoadingOverlay(true);

                //Submit faction via ajax
                let factionId = this.getAttribute('data-faction-id');
                submitFaction('faction', factionId);
            });
        });

        //Reset fleet builder content when fleet selected
        function factionClear() {
            let selectedFaction = document.querySelector('.faction.selected');
            if (selectedFaction) {
                selectedFaction.classList.remove('selected');
            }
            fleetListDropdownSelected.innerHTML = '';
            clearFleetListDropdown();
        }

        //Submit selected faction, get related fleet lists
        function submitFaction(step, factionId) {
            fetch('{{ route('faction.submit') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Assuming you're using Laravel with CSRF protection
                },
                body: JSON.stringify({
                    faction: factionId,
                    step: step
                })
            })
                .then(response => response.json())
                .then(data => {
                    //Update fleet list GUI
                    updateFleetListDropdown(data.fleetLists);

                    //Remove loading overlay after request is processed
                    toggleLoadingOverlay(false);
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Submission failed. Please check your input.');

                    //Remove loading overlay after request is processed
                    toggleLoadingOverlay(false);
                });
        }

        function toggleLoadingOverlay(activate) {
            let loadingOverlays = document.querySelectorAll('.section-overlay');

            loadingOverlays.forEach(loadingOverlay => {
                if(activate) {
                    loadingOverlay.style.visibility = 'visible';
                } else {
                    loadingOverlay.style.visibility = 'hidden';
                }
            })
        }

        function clearFleetListDropdown() {
            fleetListDropdown.innerHTML = '';
        }

        function updateFleetListDropdown(fleetLists) {
            let fleetListHtml = '';
            fleetLists.forEach(fleetList => {
                fleetListHtml += '<li data-id="'+ fleetList.id +'" data-name="'+ fleetList.name +'">'+ fleetList.name +'</li>';
            })

            fleetListDropdown.innerHTML = fleetListHtml;
        }

        fleetListDropdownBtn.addEventListener('click', function () {
            fleetListDropdownContent.style.display = fleetListDropdownContent.style.display === 'none' ? 'block' : 'none';
            fleetListDropdownBtn.classList.toggle('extended');
        })

        fleetListDropdown.addEventListener('click', function (e) {
            if(e.target.tagName === 'LI') {
                let fleetListId = e.target.getAttribute('data-id');
                let fleetListName = e.target.getAttribute('data-name');

                fleetListDropdownSelected.innerHTML = fleetListName;
            }
        })

        function submitFleetList(step, fleetListId) {
            fetch('{{ route('faction.submit') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Assuming you're using Laravel with CSRF protection
                },
                body: JSON.stringify({
                    faction: factionId,
                    step: step
                })
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    //Update fleet list GUI
                    clearFleetListDropdown();
                    updateFleetListDropdown(data.fleetLists);


                    //Remove loading overlay after data is processed
                    toggleLoadingOverlay(false);
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Submission failed. Please check your input.');

                    //Remove loading overlay after running into errors
                    toggleLoadingOverlay(false);
                });
        }
    </script>
@endpush

@push('headers')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
