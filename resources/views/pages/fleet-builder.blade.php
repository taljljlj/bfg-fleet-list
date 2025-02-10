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
        <div id="shipCardContainer" class="ship-card-container">

        </div>
        <!--
        <div class="card-ship export">
            <div class="card-header">
                <div class="card-subsec-l">
                    <div class="card-faction-img">
                        <img src="{{ asset('images/factions/imperium-logo.png') }}" alt="Faction logo">
                    </div>
                    <div class="card-ship-class heading">Retribution Class Battleship</div>
                </div>
                <div class="card-subsec-r">
                    <div class="card-ship-ld card-input heading">
                        <label for="cardShipLd">Ld:</label>
                        <input type="text" name="cardShipLd">
                    </div>
                    <div class="card-ship-pts card-input heading">
                        <label for="cardShipPts">Pts:</label>
                        <input type="text" name="cardShipPts">
                    </div>
                    <div class="card-ship-remove-btn">&times;</div>
                </div>
            </div>
            <div class="card-body">
                <div class="card-section-t">
                    <div class="card-subsec-l">
                        <div class="card-ship-img">
                            <img src="{{ asset('images/ships/emperor-class-battleship.png') }}" alt="">
                        </div>
                        <div class="card-ship-hp">
                            <div class="hp-row-1">
                                <div class="hp-box"></div>
                                <div class="hp-box"></div>
                                <div class="hp-box"></div>
                                <div class="hp-box"></div>
                                <div class="hp-box"></div>
                                <div class="hp-box"></div>
                            </div>
                            <div class="hp-row-2">
                                <div class="hp-box"></div>
                                <div class="hp-box"></div>
                                <div class="hp-box"></div>
                                <div class="hp-box"></div>
                                <div class="hp-box"></div>
                                <div class="hp-box"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-subsec-r">
                        <input type="text" placeholder="Ship Name">
                        <div class="card-ship-crits">
                            <h4>Critical Damages</h4>
                            <div class="card-ship-crits-container">
                                <div class="crit-box">
                                    <div class="crit-dmg-num">2</div>
                                    <div class="crit-dmg-name">Dorsal</div>
                                </div>
                                <div class="crit-box">
                                    <div class="crit-dmg-num">3</div>
                                    <div class="crit-dmg-name">Starboard</div>
                                </div>
                                <div class="crit-box">
                                    <div class="crit-dmg-num">4</div>
                                    <div class="crit-dmg-name">Port</div>
                                </div>
                                <div class="crit-box">
                                    <div class="crit-dmg-num">5</div>
                                    <div class="crit-dmg-name">Prow</div>
                                </div>
                                <div class="crit-box">
                                    <div class="crit-dmg-num">6</div>
                                    <div class="crit-dmg-name">Engine</div>
                                </div>
                                <div class="crit-box">
                                    <div class="crit-dmg-num">7</div>
                                    <div class="crit-dmg-name">Fire</div>
                                </div>
                                <div class="crit-box">
                                    <div class="crit-dmg-num">8</div>
                                    <div class="crit-dmg-name">Thrusters</div>
                                </div>
                                <div class="crit-box">
                                    <div class="crit-dmg-num">9</div>
                                    <div class="crit-dmg-name">Bridge</div>
                                </div>
                                <div class="crit-box">
                                    <div class="crit-dmg-num">10</div>
                                    <div class="crit-dmg-name">Shields</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-ship-stats">
                            <div class="stat-box card-box-container">
                                <div class="stat-name">Speed</div>
                                <div class="stat-value">15cm</div>
                            </div>
                            <div class="stat-box card-box-container">
                                <div class="stat-name">Turns</div>
                                <div class="stat-value">45°</div>
                            </div>
                            <div class="stat-box card-box-container">
                                <div class="stat-name">Shields</div>
                                <div class="stat-value">4</div>
                            </div>
                            <div class="stat-box card-box-container">
                                <div class="stat-name">Armour</div>
                                <div class="stat-value">5+/F6+</div>
                            </div>
                            <div class="stat-box card-box-container">
                                <div class="stat-name">Turrets</div>
                                <div class="stat-value">4</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-section-b">
                    <div class="card-subsec-l">
                        <div class="card-ship-additional">
                            <div class="card-ship-special"></div>
                            <div class="card-ship-options"></div>
                        </div>
                    </div>
                    <div class="card-subsec-r">
                        <table>
                            <tr>
                                <th>Armament</th>
                                <th>Speed/Range</th>
                                <th>Firepower</th>
                            </tr>
                            <tr>
                                <td>Weapons Battey</td>
                                <td>30cm</td>
                                <td>6</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        -->
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
        var shipCardContainer = document.getElementById('shipCardContainer');

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

            //Ship profile cards clear
            clearShipCards();
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
                toggleLoadingOverlay(true);

                clearShipCards();

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
            let caretIcon = '{{ asset('images/caret-icon.png') }}';

            Object.keys(shipsList).forEach(type => {
                shipListHtml += '<li class="collapsed">';
                shipListHtml += `<h4 class="ship-type-group">${type}s<span class="caret-icon"><img src="${caretIcon}" alt="caret-icon"></span></h4>`;
                shipListHtml += '<ul class="ship-type-container">';
                shipsList[type].forEach(ship => {
                    shipListHtml += `<li><span class="ship-class">${ship.class}</span> <span class="ship-pts">${ship.points}</span> <span class="ship-add-btn" data-ship-id="${ship.id}"><img src="${addShipIcon}" alt="Add Ship Icon"></span></li>`
                })
                shipListHtml += '</ul></li>';
            })

            shipList.innerHTML = shipListHtml;
        }

        shipList.addEventListener('click', function (e) {
            if(e.target.parentElement.classList.contains('ship-add-btn')) {
                toggleLoadingOverlay(true);

                let shipId = e.target.parentElement.getAttribute('data-ship-id');

                addShip(shipId);
            } else if (e.target.classList.contains('ship-type-group')) {
                e.target.parentElement.classList.toggle('collapsed');
            } else if (e.target.parentElement.parentElement.classList.contains('ship-type-group')) {
                e.target.parentElement.parentElement.parentElement.classList.toggle('collapsed');
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
                    //TODO: 2 chained ajax request are going to be needed here, 1st to get ships data, then apply modifiers (based on fleet-list or faction) to data, 2nd get blade component populated with data return HTML. go straight for the 2nd request in initial implementation before developing custom fleet list logic, conditions and modifiers
                    shipCardContainer.innerHTML += data.html;

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

        function clearShipCards() {
            shipCardContainer.innerHTML = '';
        }
    </script>
@endpush

@push('headers')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
