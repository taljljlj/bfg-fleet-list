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
        <div class="section-subsection last">
            <ul id="shipList">
            </ul>
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
        var shipList = document.getElementById('shipList');

        //Faction selection event listener
        factions.forEach(faction => {
            faction.addEventListener('click', function () {
                // Toggle the 'selected' class on click
                factionChangeClear();
                this.classList.add('selected');

                //Loading overlay
                toggleLoadingOverlay(true);

                //Submit faction via ajax
                let factionId = this.getAttribute('data-faction-id');
                submitFaction(factionId);
            });
        });

        //Reset fleet builder content when fleet selected
        function factionChangeClear() {
            //Factions clear
            let selectedFaction = document.querySelector('.faction.selected');
            if (selectedFaction) {
                selectedFaction.classList.remove('selected');
            }

            //Fleet list clear
            fleetListDropdownSelected.innerHTML = '';
            clearFleetListDropdown();

            //Ship list clear
            shipList.innerHTML = '';
        }

        //Submit selected faction, get related fleet lists
        function submitFaction(factionId) {
            fetch(`/api/faction/${factionId}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Assuming you're using Laravel with CSRF protection
                }
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

                submitFleetList(fleetListId);
            }
        })

        function submitFleetList(fleetListId) {
            fetch(`/api/fleet-list/${fleetListId}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Assuming you're using Laravel with CSRF protection
                }
            })
                .then(response => response.json())
                .then(data => {
                    updateShipList(data);

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

        function updateShipList(data) {
            let shipsList = data.ships;

            let shipListHtml = '';
            let addShipIcon = '{{ asset('images/add-ship-icon.png') }}';

            Object.keys(shipsList).forEach(type => {
                shipListHtml += `<h4>${type}</h4>`;
                shipsList[type].forEach(ship => {
                    shipListHtml += `<li><span class="ship-class">${ship.class}</span> <span class="ship-pts">${ship.points}</span> <span class="ship-add-btn" data-ship-id="${ship.id}"><img src="${addShipIcon}" alt="Add Ship Icon"></span></li>`
                })
            })

            shipList.innerHTML = shipListHtml;
        }

        shipList.addEventListener('click', function (e) {
            if(e.target.parentElement.classList.contains('ship-add-btn')) {
                let shipId = e.target.parentElement.getAttribute('data-ship-id');

                addShip(shipId);
            }
        })

        function addShip(shipId) {
            fetch(`/api/ship/${shipId}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Assuming you're using Laravel with CSRF protection
                }
            })
                .then(response => response.json())
                .then(data => {
                    //TODO: 2 chained ajax request are going to be needed here, 1st to get ships data, then apply modifiersto data, 2nd get blade component populated with data return HTML. go straight for the 2nd request in initial implementation before developing custom fleet list logic, conditions and modifiers

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
