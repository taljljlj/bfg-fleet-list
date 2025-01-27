@extends('layouts.builder-layout')

@section('builder-content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('builder.submit.fleet-list', ['faction' => $faction]) }}" method="POST">
        @csrf
        <input type="hidden" id="step" name="step" value="fleet-list">
        <input type="hidden" id="faction" name="faction" value="{{ $faction->id }}">

        <label for="fleetList">Select fleet list:</label>
        <select id="fleetList" name="fleet_list" required>
            <option></option>
            @foreach($fleetLists as $fleetList)
                <option value="{{ $fleetList->id }}">{{ $fleetList->name }}</option>
            @endforeach
        </select>

        <input type="submit" value="Submit">
    </form>
@endsection
