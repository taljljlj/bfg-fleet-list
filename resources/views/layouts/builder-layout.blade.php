@extends('layouts.main')

@section('content')
    <div id="fleetBuilderBody">
        <div class="content-wrapper">
            <div class="section">
            @yield('builder-content')
            </div>
        </div>
    </div>
@endsection
