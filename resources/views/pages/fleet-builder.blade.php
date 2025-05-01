@extends('layouts.builder-layout')

@section('builder-content')
    <div class="section section-top">
        @foreach($factions as $faction)
            <div class="faction{{ ($fleet->faction_id && $fleet->faction_id===$faction->id) ? ' selected' : '' }}" data-faction-id="{{ $faction->id }}">
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
            <h1><span id="points">{{ $fleet->points }}</span> pts.</h1>
        </div>
        <div class="section-subsection">
            <h3>Fleet List:</h3>
            <div id="fleetListDropdownBtn" class="dropdown">
                <div class="dropdown-select">
                    <span id="dropdownSelected">{{ $selectedFleetList ? $selectedFleetList->name : '' }}</span>
                    <span class="dropdown-caret"><img src="{{ asset('images/caret-icon.png') }}" alt="Caret"></span>
                </div>
                <div class="dropdown-content" style="display: none">
                    <ul id="fleetListDropdown">
                        @if($fleetLists)
                            @foreach($fleetLists as $fleetList)
                                <li data-id="{{ $fleetList->id }}" data-name="{{ $fleetList->name }}">{{ $fleetList->name }}</li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="section-subsection last">
            <ul id="shipList">
                @if($shipList)
                    @foreach($shipList as $type=>$shipsLi)
                        <li class="ship-type-group collapsed">
                            <h4 class="ship-type-group-title">{{ $type }}s<span class="caret-icon"><img src="{{ asset('images/caret-icon.png') }}" alt="caret-icon"></span></h4>
                            <ul class="ship-type-container thin-font">
                                @foreach($shipsLi as $shipLi)
                                    <li><span class="ship-class">{{ $shipLi->class }}</span> <span class="ship-pts">{{ $shipLi->points }}</span> <span class="ship-add-btn" data-ship-id="{{ $shipLi->id }}"><img src="{{ asset('images/add-ship-icon.png') }}" alt="Add Ship Icon"></span></li>
                                @endforeach
                            </ul>
                        </li>

                    @endforeach
                @endif
            </ul>
        </div>
    </div>
    <div class="section section-right">
        <div class="section-overlay" style="visibility: hidden">
            <img src="{{ asset('images/loading-icon.png') }}" alt="Loading Icon">
        </div>
        <div class="fleet-actions">
{{-- TODO: <a> for pdf testing, remove after pdf export fully completed --}}
            <a href="{{ route('test.fleet.export-pdf', ['faction' => 1, 'fleetList' => 1]) . '?ships%5B0%5D%5Bid%5D=2&ships%5B0%5D%5Border%5D=1&ships%5B0%5D%5Bname%5D=&ships%5B0%5D%5Bpoints%5D=365&ships%5B0%5D%5Bld%5D=&ships%5B1%5D%5Bid%5D=20&ships%5B1%5D%5Border%5D=4&ships%5B1%5D%5Bname%5D=&ships%5B1%5D%5Bpoints%5D=180&ships%5B1%5D%5Bld%5D=&ships%5B2%5D%5Bid%5D=20&ships%5B2%5D%5Border%5D=4&ships%5B2%5D%5Bname%5D=&ships%5B2%5D%5Bpoints%5D=180&ships%5B2%5D%5Bld%5D=&ships%5B3%5D%5Bid%5D=18&ships%5B3%5D%5Border%5D=4&ships%5B3%5D%5Bname%5D=&ships%5B3%5D%5Bpoints%5D=185&ships%5B3%5D%5Bld%5D=' }}">Test Pdf</a>
            <button id="exportPdf" class="export-btn">Export PDF</button>
            <button id="exportUrl" class="export-btn">Share URL</button>
            <button id="exportStore" class="export-btn">Save</button>
        </div>
        <div id="shipCardContainer" class="ship-card-container">
            @if($ships)
                @foreach($ships as $ship)
                    <x-fleet-builder.ship-profile-card :shipOrder="$ship->order" :ship="$ship" />
                @endforeach
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    {{--Fleet Builder Main Script--}}
    <script>
        //Global vars
        const pageData = {
            fleetId: {{ $fleet->id }},
            csrf: @json(csrf_token())
        };
        var factions = document.querySelectorAll('.faction');
        var fleetListDropdown = document.getElementById('fleetListDropdown');
        var fleetListDropdownBtn = document.getElementById('fleetListDropdownBtn');
        var fleetListDropdownContent = document.querySelector('#fleetListDropdownBtn .dropdown-content');
        var fleetListDropdownSelected = document.getElementById('dropdownSelected');
        var shipList = document.getElementById('shipList');
        var shipCardContainer = document.getElementById('shipCardContainer');
        var points = document.getElementById('points');
        var exportPdfBtn = document.getElementById('exportPdf');

        //Reset session on page load
        document.addEventListener('DOMContentLoaded', function(){
            sessionStorage.clear();
        })

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
                sessionStorage.setItem('factionId', factionId);
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

            //Remove all ship cards
            clearShipCards();

            //Reset fleet total points
            updatePoints(null, true);

            //Clear ship list
            fleetListChangeClear();
        }

        //Submit selected faction, get related fleet lists
        function submitFaction(factionId) {
            fetch(`/api/${pageData.fleetId}/faction/${factionId}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': pageData.csrf
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
                    alert('A disruption in the sacred data-rites has occurred. Twisted forces of the Warp have cast their afflictions upon your fleet. Reinstate your will and attempt anew, lest chaos consume this endeavor.');

                    //Remove loading overlay after request is processed
                    toggleLoadingOverlay(false);
                });
        }

        //Toggle on or off the loading overlay
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

        //Reset fleet list selection dropdown
        function clearFleetListDropdown() {
            fleetListDropdown.innerHTML = '';
        }

        //Populate fleet list selection dropdown based on faction selected
        function updateFleetListDropdown(fleetLists) {
            let fleetListHtml = '';
            fleetLists.forEach(fleetList => {
                fleetListHtml += '<li data-id="'+ fleetList.id +'" data-name="'+ fleetList.name +'">'+ fleetList.name +'</li>';
            })

            fleetListDropdown.innerHTML = fleetListHtml;
        }

        //Expand/collapse fleet selection dropdown
        fleetListDropdownBtn.addEventListener('click', function () {
            fleetListDropdownContent.style.display = fleetListDropdownContent.style.display === 'none' ? 'block' : 'none';
            fleetListDropdownBtn.classList.toggle('expanded');
        })

        //Select fleet list from dropdown, refresh ship list, call ajax function
        fleetListDropdown.addEventListener('click', function (e) {
            if(e.target.tagName === 'LI') {
                toggleLoadingOverlay(true);

                fleetListChangeClear();

                let fleetListId = e.target.getAttribute('data-id');
                let fleetListName = e.target.getAttribute('data-name');

                fleetListDropdownSelected.innerHTML = fleetListName;

                sessionStorage.setItem('fleetListId', fleetListId);
                submitFleetList(fleetListId);
            }
        })

        //Reset fleet builder content based on fleet list change
        function fleetListChangeClear() {
            //Ship list clear
            shipList.innerHTML = '';
        }

        //Submit selected fleet list, get ship list
        function submitFleetList(fleetListId) {
            fetch(`/api/${pageData.fleetId}/fleet-list/${fleetListId}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': pageData.csrf
                }
            })
                .then(response => response.json())
                .then(data => {
                    //Update ship selection list based on selected fleet list
                    updateShipList(data);

                    if(data.excludedShipsData) {
                        updatePoints(data.excludedShipsData.points, false);

                        let excludedShipIds = data.excludedShipsData.shipIds;
                        for(let i=0;i<excludedShipIds.length;i++) {
                            let shipProfileCards = document.querySelectorAll("div.card-ship[data-id='" + excludedShipIds[i] + "']");
                            shipProfileCards.forEach(shipCard => {
                                shipCard.remove();
                            })
                        }
                    }

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

        //Update ship list with ships based on fleet list selected
        function updateShipList(data) {
            let shipsList = data.shipList;

            let shipListHtml = '';
            let addShipIcon = '{{ asset('images/add-ship-icon.png') }}';
            let caretIcon = '{{ asset('images/caret-icon.png') }}';

            Object.keys(shipsList).forEach(type => {
                shipListHtml += '<li class="ship-type-group collapsed">';
                shipListHtml += `<h4 class="ship-type-group-title">${type}s<span class="caret-icon"><img src="${caretIcon}" alt="caret-icon"></span></h4>`;
                shipListHtml += '<ul class="ship-type-container thin-font">';
                shipsList[type].forEach(ship => {
                    shipListHtml += `<li><span class="ship-class">${ship.class}</span> <span class="ship-pts">${ship.points}</span> <span class="ship-add-btn" data-ship-id="${ship.id}"><img src="${addShipIcon}" alt="Add Ship Icon"></span></li>`
                })
                shipListHtml += '</ul></li>';
            })

            shipList.innerHTML = shipListHtml;
        }

        //Add ship from ship list to fleet
        shipList.addEventListener('click', function (e) {
            if(e.target.parentElement.classList.contains('ship-add-btn')) {
                toggleLoadingOverlay(true);

                let shipId = e.target.parentElement.getAttribute('data-ship-id');

                addShip(shipId);
            } else if (e.target.closest('.ship-type-group-title')) {
                e.target.closest('.ship-type-group').classList.toggle('collapsed');
            }
        })

        //Submit ship you want to add to fleet, get back full ship data with relations
        function addShip(shipId) {
            fetch(`/api/${pageData.fleetId}/ship-add/${shipId}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': pageData.csrf
                }
            })
                .then(response => response.json())
                .then(data => {
                    //TODO: 2 chained ajax request are going to be needed here, 1st to get ships data, then apply modifiers (based on fleet-list or faction) to data, 2nd get blade component populated with data return HTML. go straight for the 2nd request in initial implementation before developing custom fleet list logic, conditions and modifiers
                    shipCardContainer.innerHTML += data.html;

                    //Update points counter with default ship points value
                    updatePoints(data.points, false);

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

        //Reset ship cards container
        function clearShipCards() {
            shipCardContainer.innerHTML = '';
        }

        //Ship card events and functions
        shipCardContainer.addEventListener('click', function (e) {
            //Remove individual ship from fleet
            if (e.target.classList.contains('card-ship-remove-btn')) {
                toggleLoadingOverlay(true);

                let shipProfileElement = e.target.parentElement.parentElement.parentElement;
                let shipPivotId = shipProfileElement.getAttribute('data-pivot-id');

                removeShip(shipPivotId, shipProfileElement)
            }
            //Toggle ship's refits panel
            else if (e.target.closest('.card-ship-refit-btn')) {
                let refitsBtn = e.target.closest('.card-ship-refit-btn');
                let refitsContainer = refitsBtn.nextElementSibling;

                if(refitsContainer && refitsContainer.classList.contains('card-ship-refit-container')) {
                    refitsContainer.classList.toggle('collapsed');
                }
            }
        })

        function removeShip(shipPivotId, shipProfileElement) {
            fetch(`/api/${pageData.fleetId}/ship-remove/${shipPivotId}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': pageData.csrf
                }
            })
                .then(response => response.json())
                .then(data => {
                    //Remove ship profile card
                    shipProfileElement.remove();

                    //Update points, subtract current ship's point value from total
                    updatePoints(data.points, false);

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

        //Update fleet total points
        function updatePoints(value, reset) {
            if(reset) {
                //Reset points
                points.innerText = 0;
            } else {
                //Add/subtract points
                points.innerText = value;
            }
        }

        exportPdfBtn.addEventListener('click', function (e) {
            let factionId = sessionStorage.getItem('factionId');
            let fleetListId = sessionStorage.getItem('fleetListId');

            if(factionId && fleetListId) {
                //Prepare ship data
                let shipElements = shipCardContainer.querySelectorAll('.card-ship');
                let shipsData = [];

                shipElements.forEach(ship => {
                    let data = []
                    data['id'] = ship.getAttribute('data-id');
                    data['order'] = ship.style.order;
                    data['name'] = ship.querySelector('[name="cardShipName"]').value;
                    data['points'] = ship.querySelector('[name="cardShipPts"]').value;
                    data['ld'] = ship.querySelector('[name="cardShipLd"]').value;

                    shipsData.push(data);
                });
                let shipsParams = toQueryParams(shipsData);

                //Export PDF Ajax
                exportPdf(factionId, fleetListId, shipsParams);
            } else {
                console.log('Please select a Faction and Fleet List!');
            }
        })

        function toQueryParams(array) {
            const params = new URLSearchParams();

            array.forEach((data, index) => {
                Object.keys(data).forEach(key => {
                    params.append(`ships[${index}][${key}]`, data[key]);
                });
            });

            return params.toString();
        }

        function exportPdf(factionId, fleetListId, shipsParams) {
            fetch(`/api/export/${factionId}/${fleetListId}?${shipsParams}`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => {
                    if (response.status !== 200) {
                        throw new Error('Failed to download PDF');
                    }
                    return response.blob();
                })
                .then(blob => {
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = 'fleet-builder.pdf';
                    document.body.appendChild(a);
                    a.click();
                    a.remove();
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
