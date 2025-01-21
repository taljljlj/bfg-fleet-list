@extends('layouts.main')

@section('content')
    <h1>{{ $faction->name }}</h1>
    <h3>{{ $fleetList->name }}</h3>
    <br>

    @foreach($ships as $ship)
        <p><span>{{ $ship->class }}</span> <span>{{ $ship->type }}</span> <span>{{ $ship->hitpoints }}</span> <span>{{ $ship->speed }}</span></p>
        @foreach($ship->armaments as $armament)
            <p>{{ $armament->pivot->firepower }}</p>
        @endforeach
    @endforeach
@endsection
