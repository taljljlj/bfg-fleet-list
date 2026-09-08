@extends('layouts.common-layout')

@section('common-content')
    <div class="relative flex flex-row pb-10">
        <div class="section section-left flex-1 h-108">
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

            <div>
                <h2 class="text-2xl my-6">Legend:</h2>
                <div class="flex justify-between mb-3 align-middle">
                    <img src="{{ asset('images/battlefield-generator/asteroid-field-asset.png') }}" alt="Asteroid Field" class="h-8 w-20">
                    <span class="ml-4">---  Asteroid Field</span>
                </div>
                <div class="flex justify-between mb-3 align-middle">
                    <img src="{{ asset('images/battlefield-generator/gas-cloud-asset.png') }}" alt="Gas Cloud" class="h-8 w-20">
                    <span class="ml-4">---  Gas/Dust Cloud</span>
                </div>
                <div class="flex justify-between mb-3 align-middle">
                    <img src="{{ asset('images/battlefield-generator/warp-rift-asset-2.png') }}" alt="Warp Rift" class="h-8 w-20">
                    <span class="ml-4">---  Warp Rift</span>
                </div>
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
            let assetOrientation = 'horizontal';
            let hasPlanet = false;

            generateBtn.addEventListener('click', async () => {
                //Cleanup if there are previously generated assets
                document.querySelectorAll('.bf-gen-asset').forEach(asset => asset.remove());
                let battlezone = battlezoneSelect.value;
                assetOrientation = 'horizontal';
                hasPlanet = false;

                generateSunwardEdge();

                if(battlezone === 'random') {
                    const randomBattlezone = availableBattlezones[Math.floor(Math.random() * availableBattlezones.length)];
                    battlezoneSelect.value = randomBattlezone;
                    battlezone = randomBattlezone;
                }

                let quadrants = document.querySelectorAll('.quadrant');

                for(let i=0; i<quadrants.length; i++) {
                    if(passCheck()) {
                        quadrants[i].innerHTML = battlezoneGenerator(battlezone);
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
                        assetOrientation = 'vertical';
                        break;
                    case 2:
                    case 3:
                        sunwardStyle = 'top-0 left-1/2 transform -translate-x-1/2';
                        assetOrientation = 'horizontal';
                        break;
                    case 4:
                    case 5:
                        sunwardStyle = 'bottom-0 left-1/2 transform -translate-x-1/2 rotate-180';
                        assetOrientation = 'horizontal';
                        break;
                    case 6:
                        sunwardStyle = '-right-3 top-1/2 transform -translate-y-1/2 rotate-90';
                        assetOrientation = 'vertical';
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
                if(hasPlanet) {
                    roll = getRandomInt(1,5);
                }

                switch(roll) {
                    case 1:
                    case 2:
                        celestialPhenomenaHTML = getSolarFlareHtml();
                        break;
                    case 3:
                        celestialPhenomenaHTML = getRadiationBurstHtml();
                        break;
                    case 4:
                        celestialPhenomenaHTML = getAsteroidFieldHtml(assetOrientation);
                        break;
                    case 5:
                        let count = getRandomInt(1,3);
                        for(let i=0; i<count; i++) {
                            celestialPhenomenaHTML += getGasCloudHtml(assetOrientation);
                        }
                        break;
                    case 6:
                        let planetSizeRoll = getRandomInt(1,6);
                        let planetSize;
                        if(planetSizeRoll < 6) {
                            planetSize = 'small';
                        } else {
                            planetSize = 'medium';
                        }
                        celestialPhenomenaHTML = getPlanetHtml(planetSize);
                        hasPlanet = true;
                        break;
                    default:
                        break;
                }

                return celestialPhenomenaHTML;
            }
            function handleBattlezoneMercurialZone(roll) {
                let celestialPhenomenaHTML = '';
                if(hasPlanet) {
                    roll = getRandomInt(1,5);
                }

                switch(roll) {
                    case 1:
                        celestialPhenomenaHTML = getSolarFlareHtml();
                        break;
                    case 2:
                        celestialPhenomenaHTML = getRadiationBurstHtml();
                        break;
                    case 3:
                        celestialPhenomenaHTML = getAsteroidFieldHtml(assetOrientation);
                        break;
                    case 4:
                    case 5:
                        let count = getRandomInt(1,3);
                        for(let i=0; i<count; i++) {
                            celestialPhenomenaHTML += getGasCloudHtml(assetOrientation);
                        }
                        break;
                    case 6:
                        let planetSizeRoll = getRandomInt(1,6);
                        let planetSize;
                        if(planetSizeRoll < 6) {
                            planetSize = 'small';
                        } else {
                            planetSize = 'medium';
                        }
                        celestialPhenomenaHTML = getPlanetHtml(planetSize);
                        hasPlanet = true;
                        break;
                    default:
                        break;
                }

                return celestialPhenomenaHTML;
            }
            function handleBattlezoneInnerBiosphere(roll) {
                let celestialPhenomenaHTML = '';
                let count;
                if(hasPlanet) {
                    roll = getRandomInt(1,5);
                }

                switch(roll) {
                    case 1:
                        if(passCheck()) {
                            celestialPhenomenaHTML = getSolarFlareHtml();
                        } else {
                            celestialPhenomenaHTML = getRadiationBurstHtml();
                        }
                        break;
                    case 2:
                        celestialPhenomenaHTML = getAsteroidFieldHtml(assetOrientation);
                        break;
                    case 3:
                        count = getRandomInt(1,3);
                        for(let i=0; i<count; i++) {
                            celestialPhenomenaHTML += getAsteroidFieldHtml(assetOrientation);
                        }
                        break;
                    case 4:
                    case 5:
                        count = getRandomInt(1,3);
                        for(let i=0; i<count; i++) {
                            celestialPhenomenaHTML += getGasCloudHtml(assetOrientation);
                        }
                        break;
                    case 6:
                        let planetSizeRoll = getRandomInt(1,6);
                        let planetSize;
                        if(planetSizeRoll < 6) {
                            planetSize = 'small';
                        } else {
                            planetSize = 'medium';
                        }
                        celestialPhenomenaHTML = getPlanetHtml(planetSize);
                        hasPlanet = true;
                        break;
                    default:
                        break;
                }

                return celestialPhenomenaHTML;
            }
            function handleBattlezonePrimaryBiosphere(roll) {
                let celestialPhenomenaHTML = '';
                let count;
                if(hasPlanet) {
                    roll = getRandomInt(1,4);
                }

                switch(roll) {
                    case 1:
                        celestialPhenomenaHTML = getAsteroidFieldHtml(assetOrientation);
                        break;
                    case 2:
                        count = getRandomInt(1,3);
                        for(let i=0; i<count; i++) {
                            celestialPhenomenaHTML += getAsteroidFieldHtml(assetOrientation);
                        }
                        break;
                    case 3:
                        celestialPhenomenaHTML = getGasCloudHtml(assetOrientation);
                        break;
                    case 4:
                        count = getRandomInt(1,3);
                        for(let i=0; i<count; i++) {
                            celestialPhenomenaHTML += getGasCloudHtml(assetOrientation);
                        }
                        break;
                    case 5:
                    case 6:
                        let planetSizeRoll = getRandomInt(1,6);
                        let planetSize;
                        if(planetSizeRoll < 6) {
                            planetSize = 'small';
                        } else {
                            planetSize = 'medium';
                        }
                        celestialPhenomenaHTML = getPlanetHtml(planetSize);
                        hasPlanet = true;
                        break;
                    default:
                        break;
                }

                return celestialPhenomenaHTML;
            }
            function handleBattlezoneOuterReaches(roll) {
                let celestialPhenomenaHTML = '';
                let count;
                if(hasPlanet) {
                    roll = getRandomInt(1,4);
                }

                switch(roll) {
                    case 1:
                        count = getRandomInt(1,3) + 1;
                        for(let i=0; i<count; i++) {
                            celestialPhenomenaHTML += getAsteroidFieldHtml(assetOrientation);
                        }
                        break;
                    case 2:
                        count = getRandomInt(1,3);
                        for(let i=0; i<count; i++) {
                            celestialPhenomenaHTML += getAsteroidFieldHtml(assetOrientation);
                        }
                        break;
                    case 3:
                        count = getRandomInt(1,3);
                        for(let i=0; i<count; i++) {
                            celestialPhenomenaHTML += getGasCloudHtml(assetOrientation);
                        }
                        break;
                    case 4:
                        celestialPhenomenaHTML = getGasCloudHtml(assetOrientation);
                        break;
                    case 5:
                    case 6:
                        let planetSizeRoll = getRandomInt(1,6);
                        let planetSize;
                        if(planetSizeRoll < 4) {
                            planetSize = 'small';
                        } else {
                            planetSize = 'large';
                        }
                        celestialPhenomenaHTML = getPlanetHtml(planetSize);
                        hasPlanet = true;
                        break;
                    default:
                        break;
                }

                return celestialPhenomenaHTML;
            }
            function handleBattlezoneDeepSpace(roll) {
                let celestialPhenomenaHTML = '';
                let count;
                if(hasPlanet) {
                    roll = getRandomInt(1,5);
                }

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
                        celestialPhenomenaHTML = getPlanetHtml('small');
                        hasPlanet = true;
                        break;
                    default:
                        break;
                }

                return celestialPhenomenaHTML;
            }

            function getSolarFlareHtml() {
                return '<div class="absolute bf-gen-asset text-3xl" style="top:50%; left:50%; width:100px; transform: translate(-50%, -50%)">' +
                    '<img src="/images/battlefield-generator/solar-flare-asset.png" alt="Solar Flare" class="drop-shadow-[0_0_10px_#c8c5dc] opacity-70">' +
                    'Solar Flare' +
                    '</div>';
            }
            function getRadiationBurstHtml() {
                return '<div class="absolute bf-gen-asset text-3xl" style="top:50%; left:50%; width:100px; transform: translate(-50%, -50%)">' +
                    '<img src="/images/battlefield-generator/radiation-burst-asset.png" alt="Radiation Burst" class="drop-shadow-[0_0_10px_#c8c5dc] opacity-70">' +
                    'Radiation Burst' +
                    '</div>';
            }
            function getAsteroidFieldHtml() {
                let xPos, yPos;
                let rotate = '';
                const dimensions = [getRandomInt(1,3) * 5, getRandomInt(1,3) * 5];
                const xSize = Math.max(...dimensions);
                const ySize = Math.min(...dimensions);
                if(assetOrientation === 'vertical') {
                    xPos = getRandomInt(8, 92);
                    yPos = getRandomInt(27, 73);
                    rotate = ' rotate(90deg)';
                } else {
                    xPos = getRandomInt(19, 81);
                    yPos = getRandomInt(13, 87);
                }

                return '<div class="absolute bf-gen-asset" style="top:' + yPos + '%; left:' + xPos + '%; width:150px; height:53px; transform: translate(-50%, -50%)' + rotate  + '">' +
                    '<div class="relative">' +
                    '<img src="/images/battlefield-generator/asteroid-field-asset.png" alt="Asteroid Field" class="drop-shadow-[0_0_10px_#c8c5dc] opacity-70">' +
                    '<div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-primary-700 text-2xl font-bold drop-shadow-[0_0_10px_#c8c5dc]">' + xSize + ' x ' + ySize + ' cm</div>' +
                    '</div>' +
                    '</div>';
            }
            function getGasCloudHtml() {
                let xPos, yPos;
                let rotate = '';
                const xSize = getRandomInt(1,6) * 5;
                const ySize = getRandomInt(1,6) * 2;
                if(assetOrientation === 'vertical') {
                    xPos = getRandomInt(8, 92);
                    yPos = getRandomInt(27, 73);
                    rotate = ' rotate(90deg)';
                } else {
                    xPos = getRandomInt(17, 83);
                    yPos = getRandomInt(12, 88);
                }

                return '<div class="absolute bf-gen-asset" style="top:' + yPos + '%; left:' + xPos + '%; width:150px; height:65px; transform: translate(-50%, -50%)' + rotate  + '">' +
                    '<div class="relative">' +
                    '<img src="/images/battlefield-generator/gas-cloud-asset.png" alt="Gas Cloud" class="opacity-70">' +
                    '<div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-primary-700 text-2xl font-bold drop-shadow-[0_0_10px_#c8c5dc]">' + xSize + ' x ' + ySize + ' cm</div>' +
                    '</div>' +
                    '</div>';
            }
            function getPlanetHtml(planetSize) {
                let xPos;
                let yPos;
                let planetDimensions;
                let moons = 0;
                let planetaryRingsHtml = '';
                switch(planetSize) {
                    case 'medium':
                        planetDimensions = '16-25';
                        moons = getRandomInt(1,3) - 1;
                        xPos = getRandomInt(38, 62);
                        yPos = 50;
                        break;
                    case 'large':
                        planetDimensions = '26-50';
                        moons = getRandomInt(1,6) - 2;
                        xPos = getRandomInt(38, 62);
                        yPos = 50;
                        if(passCheck()) {
                            planetaryRingsHtml = '<div class="absolute z-40" style="width: 260px; height: 260px; top: -41px; left: -41px;">' +
                                '<img src="/images/battlefield-generator/planetary-rings-asset.png" alt="Planetary Rings" class="opacity-80">' +
                                '</div>';
                        }
                        break;
                    default:
                        planetDimensions = '<15';
                        xPos = getRandomInt(20, 80);
                        yPos = getRandomInt(29, 71);
                        break;
                }

                let moonsHtml = '';
                for(let i=0; i<moons; i++) {
                    let moonRotation = getRandomInt(0,360);

                    moonsHtml += '<div class="absolute top-0 left-0 z-50" style="width: 170px; height: 170px; transform: rotate(' + moonRotation + 'deg)">' +
                            '<div class="absolute top-1/2 -right-20" style="width:70px; height:70px; transform: translate(0, -50%)">' +
                                '<img src="/images/battlefield-generator/moon-asset.png" alt="Moon" class="opacity-80">' +
                                '<div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-primary-700 text-2xl font-bold drop-shadow-[0_0_20px_#c8c5dc]" style="transform: rotate(-' + moonRotation + 'deg);">Moon</div>' +
                            '</div>' +
                        '</div>';
                }

                return '<div class="absolute bf-gen-asset" style="top:' + yPos + '%; left:' + xPos + '%; width:170px; height:170px; transform: translate(-50%, -50%)">' +
                        '<img src="/images/battlefield-generator/planet-asset.png" alt="Planet" class="opacity-80">' +
                        '<div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-primary-700 text-3xl font-bold drop-shadow-[0_0_20px_#c8c5dc]">Planet <p class="text-sm font-family-secondary tracking-tight">' + planetSize + ' (' + planetDimensions + 'cm)</p></div>' +
                        moonsHtml +
                        planetaryRingsHtml +
                '</div>';
            }
            function getWarpRiftHtml() {
                let xPos = getRandomInt(17, 83);
                let yPos = getRandomInt(25, 75);
                let rotateAsset = getRandomInt(90,450);
                const xSize = getRandomInt(1,3) * 10;
                const ySize = getRandomInt(1,3) * 5;
                let rotateText = 0;

                if(rotateAsset < 270) {
                    rotateText = 180;
                }

                return '<div class="absolute bf-gen-asset" style="top:' + yPos + '%; left:' + xPos + '%; width:150px; height:150px; transform: translate(-50%, -50%) rotate(' + rotateAsset  + 'deg)">' +
                    '<div class="relative">' +
                    '<img src="/images/battlefield-generator/warp-rift-asset.png" alt="Warp Rift" class="opacity-70">' +
                    '<div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-primary-700 text-2xl font-bold drop-shadow-[0_0_10px_#c8c5dc]" style="transform: rotate(' + rotateText + 'deg)">' + xSize + ' x ' + ySize + ' cm</div>' +
                    '</div>' +
                    '</div>';
            }
        })
    </script>
@endpush
