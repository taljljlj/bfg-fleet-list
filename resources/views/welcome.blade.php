@extends('layouts.main')

@section('content')
    <div class="hotpick-faction">
        <h1>Build your fleet!</h1>
        <div class="faction-container">
            @foreach($factions as $faction)
                <a href="{{ route('builder.index-hotpick', ['faction' => $faction]) }}"><img src="{{ asset('images/factions/hotpick/' . $faction->hotpick_faction_img_url) }}" alt="Faction Hotpick Image"></a>
            @endforeach
        </div>
        <!-- TODO: use gw2skills landing page for reference -->
    </div>
    <div class="explore-fleets">
        <h1>Explore fleets</h1>
        <div class="most-popular">
            <h2>Most popular fleets</h2>
        </div>
    </div>
@endsection
