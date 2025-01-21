@extends('layouts.main')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('editor.submit.fleet-list', ['faction' => $faction]) }}" method="POST">
        @csrf
        <input type="hidden" id="step" name="step" value="fleet-list">
        <input type="hidden" id="faction" name="faction" value="{{ $faction->id }}">

        <label for="fleet_list">Select fleet list:</label>
        <select id="fleet_list" name="fleet_list" required>
            <option></option>
            @foreach($fleetLists as $fleetList)
                <option value="{{ $fleetList->id }}">{{ $fleetList->name }}</option>
            @endforeach
        </select>

        <input type="submit" value="Submit">
    </form>
@endsection
