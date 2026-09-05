@extends('layouts.common-layout')

@section('common-content')
    <div class="relative flex flex-row pb-10">
        <div class="section section-left flex-1 h-80">
            {{-- TODO: replace vue with blade animation for overlay when user makes requests - i think it is needed only for pdf export --}}
            <div class="section-overlay" v-if="state.isLoading" style="visibility: hidden">
                <img :src="loadingIcon" alt="Loading Icon">
            </div>

            <div class="section-divider divider-r">
                <label for="battle_zone" class="block text-2xl mb-2">Choose Battle Zone (optional):</label>
                <select name="battle-zone" id="battle_zone" value="random" class="block w-4/5 mx-auto h-8 text-center text-xl rounded-md border-2 border-secondary bg-primary-500-opc-80">
                    <option value="random">Random</option>
                    <option value="flare-region">1. Flare Region</option>
                    <option value="mercurial-zone">2. Mercurial Zone</option>
                    <option value="inner-biosphere">3. Inner Biosphere</option>
                    <option value="primary-biosphere">4. Primary Biosphere</option>
                    <option value="outer-reaches">5. Outer Reaches</option>
                    <option value="deep-space">6. Deep Space</option>
                </select>
                <div id="bf_gen_generate_btn" class="btn-primary mt-6 mb-3 text-2xl">Generate</div>
            </div>
        </div>

        <div class="relative section-right flex-9">
            {{-- TODO: replace vue with blade animation for overlay when user makes requests - i think it is needed only for pdf export --}}
            <div class="section-overlay" v-if="state.isLoading" style="visibility: hidden">
                <img :src="loadingIcon" alt="Loading Icon">
            </div>

            <div class="section w-[1000px] h-[750px] mx-auto">

                {{-- TESTING --}}


                <div id="battlefield_container" class="p-6 w-full h-full">
                    <div class="border-2 border-secondary w-full h-full">
                        <div class="w-full h-7 border-b-2 border-b-secondary">Deployment Zone</div>
                        <div class="w-full h-[calc(100%-56px)]">
                            <div class="quadrant relative inline-block float-left h-1/2 w-1/2 border-b-2 border-r-2 border-secondary-300"></div>
                            <div class="quadrant relative inline-block float-left h-1/2 w-1/2 border-b-2 border-b-secondary-300"></div>
                            <div class="quadrant relative inline-block float-left h-1/2 w-1/2 border-r-2 border-secondary-300"></div>
                            <div class="quadrant relative inline-block float-left h-1/2 w-1/2"></div>
                        </div>
                        <div class="w-full h-7 border-t-2 border-t-secondary">Deployment Zone</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script data-origin="bf-gen-index">
        document.addEventListener('DOMContentLoaded', () => {
            let battlezoneSelect = document.getElementById('battle_zone');
            const generateBtn = document.getElementById('bf_gen_generate_btn');
            const battlefieldContainer = document.getElementById('battlefield_container');
            const availableBattlezones = ['flare-region', 'mercurial-zone', 'inner-biosphere', 'primary-biosphere', 'outer-reaches', 'deep-space'];

            generateBtn.addEventListener('click', async () => {
                //Cleanup if there are previously generated assets
                document.querySelectorAll('.bf-gen-asset').forEach(asset => asset.remove());
                let battlezone = battlezoneSelect.value;

                generateSunwardEdge();

                if(battlezone === 'random') {
                    const randomBattlezone = availableBattlezones[Math.floor(Math.random() * availableBattlezones.length)];
                    battlezoneSelect.value = randomBattlezone;
                    battlezone = randomBattlezone;
                }

                let quadrants = document.querySelectorAll('.quadrant');
                for(let i=0; i<quadrants.length; i++) {
                    if(passCheck()) {
                        let celestialPhenomenaHTML = battlezoneGenerator(battlezone);
                        console.log(celestialPhenomenaHTML);
                        quadrants[i].innerHTML = celestialPhenomenaHTML;
                    }
                }



            })

            function getRandomInt(min, max) {
                min = Math.ceil(min);
                max = Math.floor(max);
                return Math.floor(Math.random() * (max - min + 1)) + min;
            }

            function generateSunwardEdge() {
                const sunwardEdgeRoll = getRandomInt(1,6);
                let sunwardStyle;

                switch (sunwardEdgeRoll) {
                    case 1:
                        sunwardStyle = '-left-3 top-1/2 transform -translate-y-1/2 -rotate-90';
                        break;
                    case 2:
                    case 3:
                        sunwardStyle = 'top-0 left-1/2 transform -translate-x-1/2';
                        break;
                    case 4:
                    case 5:
                        sunwardStyle = 'bottom-0 left-1/2 transform -translate-x-1/2 rotate-180';
                        break;
                    case 6:
                        sunwardStyle = '-right-3 top-1/2 transform -translate-y-1/2 rotate-90';
                        break;
                    default:
                        sunwardStyle = 'top-0 left-1/2 transform -translate-x-1/2';
                        break;
                }

                const sunwardHtml =
                    '<div class="absolute bf-gen-asset w-20 h-12 ' + sunwardStyle + '">' +
                    '<img src="{{ asset('images/battlefield-generator/sunward-edge-image.png') }}" alt="Sunward Edge Image">' +
                    '<div class="tracking-widest">SUNWARD</div>' +
                    '</div>';

                battlefieldContainer.innerHTML += sunwardHtml;
            }

            function passCheck() {
                const passCheckRoll = getRandomInt(1,6);
                return passCheckRoll >= 4;
            }

            function battlezoneGenerator(battlezone) {
                const battlezoneRoll = getRandomInt(1,6);
                let celestialPhenomenaHTML = '';

                switch (battlezone) {
                    case 'flare-region':
                        celestialPhenomenaHTML = handleBattlezoneFlareRegion(battlezoneRoll);
                        break;
                    case 'mercurial-zone':
                        celestialPhenomenaHTML = handleBattlezoneMercurialZone(battlezoneRoll);
                        break;
                    case 'inner-biosphere':
                        celestialPhenomenaHTML = handleBattlezoneInnerBiosphere(battlezoneRoll);
                        break;
                    case 'primary-biosphere':
                        celestialPhenomenaHTML = handleBattlezonePrimaryBiosphere(battlezoneRoll);
                        break;
                    case 'outer-reaches':
                        celestialPhenomenaHTML = handleBattlezoneOuterReaches(battlezoneRoll);
                        break;
                    case 'deep-space':
                        celestialPhenomenaHTML = handleBattlezoneDeepSpace(battlezoneRoll);
                        break;
                    default:
                        break;
                }

                return celestialPhenomenaHTML;
            }

            function handleBattlezoneFlareRegion(roll) {
                let celestialPhenomenaHTML = '';
                switch(roll) {
                    case 1:
                    case 2:
                        celestialPhenomenaHTML = getSolarFlareHtml();
                        break;
                    case 3:
                        celestialPhenomenaHTML = getRadiationBurstHtml();
                        break;
                    case 4:
                        celestialPhenomenaHTML = getAsteroidFieldHtml();
                        break;
                    case 5:
                        let count = getRandomInt(1,3);
                        for(let i=0; i<count; i++) {
                            celestialPhenomenaHTML += getGasCloudHtml();
                        }
                        break;
                    case 6:
                        celestialPhenomenaHTML = getPlanetHtml();
                        break;
                    default:
                        break;
                }

                return celestialPhenomenaHTML;
            }
            function handleBattlezoneMercurialZone(roll) {
                let celestialPhenomenaHTML = '';
                switch(roll) {
                    case 1:
                        celestialPhenomenaHTML = getSolarFlareHtml();
                        break;
                    case 2:
                        celestialPhenomenaHTML = getRadiationBurstHtml();
                        break;
                    case 3:
                        celestialPhenomenaHTML = getAsteroidFieldHtml();
                        break;
                    case 4:
                    case 5:
                        let count = getRandomInt(1,3);
                        for(let i=0; i<count; i++) {
                            celestialPhenomenaHTML += getGasCloudHtml();
                        }
                        break;
                    case 6:
                        celestialPhenomenaHTML = getPlanetHtml();
                        break;
                    default:
                        break;
                }

                return celestialPhenomenaHTML;
            }
            function handleBattlezoneInnerBiosphere(roll) {
                let celestialPhenomenaHTML = '';
                let count;
                switch(roll) {
                    case 1:
                        if(passCheck()) {
                            celestialPhenomenaHTML = getSolarFlareHtml();
                        } else {
                            celestialPhenomenaHTML = getRadiationBurstHtml();
                        }
                        break;
                    case 2:
                        celestialPhenomenaHTML = getAsteroidFieldHtml();
                        break;
                    case 3:
                        count = getRandomInt(1,3);
                        for(let i=0; i<count; i++) {
                            celestialPhenomenaHTML += getAsteroidFieldHtml();
                        }
                        break;
                    case 4:
                    case 5:
                        count = getRandomInt(1,3);
                        for(let i=0; i<count; i++) {
                            celestialPhenomenaHTML += getGasCloudHtml();
                        }
                        break;
                    case 6:
                        celestialPhenomenaHTML = getPlanetHtml();
                        break;
                    default:
                        break;
                }

                return celestialPhenomenaHTML;
            }
            function handleBattlezonePrimaryBiosphere(roll) {
                let celestialPhenomenaHTML = '';
                let count;
                switch(roll) {
                    case 1:
                        celestialPhenomenaHTML = getAsteroidFieldHtml();
                        break;
                    case 2:
                        count = getRandomInt(1,3);
                        for(let i=0; i<count; i++) {
                            celestialPhenomenaHTML += getAsteroidFieldHtml();
                        }
                        break;
                    case 3:
                        celestialPhenomenaHTML = getGasCloudHtml();
                        break;
                    case 4:
                        count = getRandomInt(1,3);
                        for(let i=0; i<count; i++) {
                            celestialPhenomenaHTML += getGasCloudHtml();
                        }
                        break;
                    case 5:
                    case 6:
                        celestialPhenomenaHTML = getPlanetHtml();
                        break;
                    default:
                        break;
                }

                return celestialPhenomenaHTML;
            }
            function handleBattlezoneOuterReaches(roll) {
                let celestialPhenomenaHTML = '';
                let count;
                switch(roll) {
                    case 1:
                        count = getRandomInt(1,3) + 1;
                        for(let i=0; i<count; i++) {
                            celestialPhenomenaHTML += getAsteroidFieldHtml();
                        }
                        break;
                    case 2:
                        count = getRandomInt(1,3);
                        for(let i=0; i<count; i++) {
                            celestialPhenomenaHTML += getAsteroidFieldHtml();
                        }
                        break;
                    case 3:
                        count = getRandomInt(1,3);
                        for(let i=0; i<count; i++) {
                            celestialPhenomenaHTML += getGasCloudHtml();
                        }
                        break;
                    case 4:
                        celestialPhenomenaHTML = getGasCloudHtml();
                        break;
                    case 5:
                    case 6:
                        celestialPhenomenaHTML = getPlanetHtml();
                        break;
                    default:
                        break;
                }

                return celestialPhenomenaHTML;
            }
            function handleBattlezoneDeepSpace(roll) {
                let celestialPhenomenaHTML = '';
                let count;
                switch(roll) {
                    case 1:
                        count = getRandomInt(1,3);
                        for(let i=0; i<count; i++) {
                            celestialPhenomenaHTML += getAsteroidFieldHtml();
                        }
                        break;
                    case 2:
                        celestialPhenomenaHTML = getAsteroidFieldHtml();
                        break;
                    case 3:
                        count = getRandomInt(1,3);
                        for(let i=0; i<count; i++) {
                            celestialPhenomenaHTML += getGasCloudHtml();
                        }
                        break;
                    case 4:
                        celestialPhenomenaHTML = getGasCloudHtml();
                        break;
                    case 5:
                        celestialPhenomenaHTML = getWarpRiftHtml();
                        break;
                    case 6:
                        celestialPhenomenaHTML = getPlanetHtml();
                        break;
                    default:
                        break;
                }

                return celestialPhenomenaHTML;
            }

            function getSolarFlareHtml() {
                return '<div class="absolute bf-gen-asset" style="top:' + getRandomInt(5,95) + '%; left:' + getRandomInt(20,80) + '%;">Solar Flare</div>';
            }
            function getRadiationBurstHtml() {
                return '<div class="absolute bf-gen-asset" style="top:' + getRandomInt(5,95) + '%; left:' + getRandomInt(20,80) + '%">Radiation Burst</div>';
            }
            function getAsteroidFieldHtml() {
                return '<div class="absolute bf-gen-asset" style="top:' + getRandomInt(5,95) + '%; left:' + getRandomInt(20,80) + '%">Asteroid Field</div>';
            }
            function getGasCloudHtml() {
                return '<div class="absolute bf-gen-asset" style="top:' + getRandomInt(5,95) + '%; left:' + getRandomInt(20,80) + '%">Gas Cloud</div>';
            }
            function getPlanetHtml() {
                // TODO: planet generation needs further handling
                return '<div class="absolute bf-gen-asset" style="top:' + getRandomInt(5,95) + '%; left:' + getRandomInt(20,80) + '%">Planet</div>';
            }
            function getWarpRiftHtml() {
                return '<div class="absolute bf-gen-asset" style="top:' + getRandomInt(5,95) + '%; left:' + getRandomInt(20,80) + '%">Warp Rift</div>';
            }
        })
    </script>
@endpush
