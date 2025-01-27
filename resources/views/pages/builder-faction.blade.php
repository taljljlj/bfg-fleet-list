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

    <form action="{{ route('builder.submit.faction') }}" method="POST">
        @csrf
        <input type="hidden" id="step" name="step" value="faction">

        <label for="faction">Select faction:</label>
        <select id="faction" name="faction" required>
            <option></option>
            @foreach($factions as $faction)
                <option value="{{ $faction->id }}">{{ $faction->name }}</option>
            @endforeach
        </select>

        <input type="submit" value="Submit">
    </form>
@endsection
