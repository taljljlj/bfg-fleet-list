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
                    @foreach($shipList as $type=>$shipGroup)
                        <li class="ship-type-group collapsed">
                            <h4 class="ship-type-group-title">{{ $type }}s<span class="caret-icon"><img src="{{ asset('images/caret-icon.png') }}" alt="caret-icon"></span></h4>
                            <ul class="ship-type-container thin-font">
                                @foreach($shipGroup as $shipItem)
                                    <li><span class="ship-class">{{ $shipItem->class }}{{ $shipItem->type === 'Escort' ? ' Squadron' : '' }}</span> <span class="ship-pts">{{ $shipItem->points }}</span> <span class="ship-add-btn" data-ship-id="{{ $shipItem->id }}"><img src="{{ asset('images/add-ship-icon.png') }}" alt="Add Ship Icon"></span></li>
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
            <a href="{{ route('test.fleet.export-pdf', $fleet) }}">Test Pdf</a>
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

            //Remove all ship cards
            clearShipCards();

            //Reset fleet total points
            updateFleetPoints(null, true);

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
                        updateFleetPoints(data.excludedShipsData.points, false);

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
                    shipCardContainer.innerHTML += data.html;

                    //Update points counter with default ship points value
                    updateFleetPoints(data.points, false);

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

        //Ship card click events and functions
        shipCardContainer.addEventListener('click', function (e) {
            let shipProfileElement = e.target.closest('.card-ship');
            let shipPivotId = shipProfileElement.getAttribute('data-pivot-id');
            //Remove individual ship from fleet
            if (e.target.classList.contains('card-ship-remove-btn')) {
                toggleLoadingOverlay(true);

                removeShip(shipPivotId, shipProfileElement)
            }
            //Ship's refits panel
            else if (e.target.closest('.card-ship-refit-btn')) {
                let refitsBtn = e.target.closest('.card-ship-refit-btn');
                let refitsContainer = refitsBtn.nextElementSibling;

                if(refitsContainer && refitsContainer.classList.contains('card-ship-refit-container')) {
                    //Process and apply refits to ship
                    if(!refitsContainer.classList.contains('collapsed')) {
                        toggleLoadingOverlay(true);
                        let selectedRefits = processRefits(refitsContainer);

                        applyRefits(shipPivotId, selectedRefits, shipProfileElement);
                    }

                    //Toggle refits panel
                    refitsContainer.classList.toggle('collapsed');
                    refitsBtn.classList.toggle('collapsed');
                }
            }
        })

        //Remove ship and it's data from db, update points
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
                    updateFleetPoints(data.points, false);

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

        //Handle selected refits for ship
        function processRefits(refitsContainer) {
            let refitInputs = refitsContainer.querySelectorAll('input');
            let selectedRefits = [];

            for(let i=0; i<refitInputs.length; i++) {
                if(refitInputs[i].checked) {
                    selectedRefits.push(parseInt(refitInputs[i].getAttribute('data-refit-pivot-id'), 10));
                }
            }

            return selectedRefits;
        }

        //Apply and persist refits on backend, update points and ship profile sections with refitted data
        function applyRefits(shipPivotId, selectedRefits, shipProfileElement) {
            fetch(`/api/${pageData.fleetId}/ship-refit/${shipPivotId}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': pageData.csrf
                },
                body: JSON.stringify({ 'selected-refits': selectedRefits })
            })
                .then(response => response.json())
                .then(data => {
                    let refittedSections = data.refittedSections;
                    let htmlData = data.htmlData;
                    let pointsData = data.pointsData;

                    // Reload component if section is flagged as modified
                    if(refittedSections.shipModified) {
                        let statsSection = shipProfileElement.querySelector('.ship-stats-section-container');
                        statsSection.innerHTML =  htmlData.stats;
                    }
                    if(refittedSections.armModified) {
                        let armsSection = shipProfileElement.querySelector('.ship-armaments-section-container');
                        armsSection.innerHTML =  htmlData.armaments;
                    }
                    if(refittedSections.ruleModified) {
                        let rulesSection = shipProfileElement.querySelector('.ship-rules-section-container');
                        rulesSection.innerHTML =  htmlData.rules;
                    }

                    updateShipPoints(shipProfileElement, pointsData.ship);
                    updateFleetPoints(pointsData.fleet, false);

                    toggleLoadingOverlay(false);
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Submission failed. Please check your input.');

                    //Remove loading overlay after running into errors
                    toggleLoadingOverlay(false);
                });
        }

        //Ship card input change events and functions
        document.addEventListener('change', function (e) {
            // Disable/enable & uncheck refit children checkboxes if parent is (un)checked
            let eventTarget = e.target;
            let shipProfileElement = eventTarget.closest('.card-ship');
            let shipPivotId = shipProfileElement.getAttribute('data-pivot-id');

            // Check if this is a parent checkbox
            if (eventTarget.matches('.ship-refit > label > input[type="checkbox"]')) {
                let childList = eventTarget.closest('li.ship-refit')?.querySelector('.ship-refits-children');
                if (childList) {
                    let isChecked = eventTarget.checked;

                    childList.querySelectorAll('input[type="checkbox"]').forEach(child => {
                        // Toggle disabled attribute on child
                        child.disabled = !isChecked;

                        // Uncheck child if parent is unchecked
                        if(!isChecked) {
                            child.checked = false;
                        }
                    });
                }
            }
            //Squadron counter listener
            if(eventTarget.matches('.squadron-counter-input input[name="squadronCounter"]')) {
                toggleLoadingOverlay(true);
                let counterValue = eventTarget.value;
                updateSquadronCounter(shipPivotId, counterValue, shipProfileElement);
            }
            //Ship/squadron name listener
            if(eventTarget.matches('input[name="cardShipName"]')) {
                toggleLoadingOverlay(true);
                let value = eventTarget.value;
                let attr = 'name';
                updateShipCustomAttribute(shipPivotId, value, attr);
            }

            //Ship points listener
            if(eventTarget.matches('input[name="cardShipPts"]')) {
                toggleLoadingOverlay(true);
                let value = eventTarget.value;
                let attr = 'points';
                updateShipCustomAttribute(shipPivotId, value, attr);
            }

            //Ship leadership listener
            if(eventTarget.matches('input[name="cardShipLd"]')) {
                toggleLoadingOverlay(true);
                let value = eventTarget.value;
                let attr = 'leadership';
                updateShipCustomAttribute(shipPivotId, value, attr);
            }
        });

        //Update squadron counter and points
        function updateSquadronCounter(shipPivotId, counterValue, shipProfileElement) {
            console.log(shipPivotId);
            fetch(`/api/${pageData.fleetId}/ship-squadron-counter/${shipPivotId}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': pageData.csrf
                },
                body: JSON.stringify({ 'squadron-counter': counterValue })
            })
                .then(response => response.json())
                .then(data => {
                    let pointsData = data.pointsData;

                    updateShipPoints(shipProfileElement, pointsData.ship);
                    updateFleetPoints(pointsData.fleet, false);

                    toggleLoadingOverlay(false);
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Submission failed. Please check your input.');

                    //Remove loading overlay after running into errors
                    toggleLoadingOverlay(false);
                });
        }

        //Update ship/squadron name, points or leadership values
        function updateShipCustomAttribute(shipPivotId, value, attr) {
            fetch(`/api/${pageData.fleetId}/ship-custom-attribute/${shipPivotId}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': pageData.csrf
                },
                body: JSON.stringify({
                    'attr'  : attr,
                    'value' : value
                })
            })
                .then(response => {
                    if (response.status === 204) {
                        toggleLoadingOverlay(false);
                        return null;
                    }
                    return response.json();
                })
                .then(data => {
                    let points = data.points;
                    updateFleetPoints(points, false);

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
        function updateFleetPoints(value, reset = false) {
            if(reset) {
                //Reset points
                points.innerText = 0;
            } else {
                //Set points value
                points.innerText = value;
            }
        }

        //Update ship points
        function updateShipPoints(shipProfileElement, value) {
            console.log(shipProfileElement);
            let pointsInput = shipProfileElement.querySelector('input[name=cardShipPts]');
            pointsInput.value = value;
            console.log(pointsInput);
        }

        exportPdfBtn.addEventListener('click', function () {
            //Export PDF Ajax
            exportPdf();
        })

        function exportPdf() {
            fetch(`/api/${pageData.fleetId}/export-pdf/`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': pageData.csrf
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
