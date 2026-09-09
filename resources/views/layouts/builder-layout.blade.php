@extends('layouts.main')

@section('content')
    <div id="fleetBuilderBody" class="flex-1 bg-cover bg-center bg-no-repeat bg-fixed text-center">
        @yield('modals')
        <div class="m-auto relative px-3 lg:px-5">
            @yield('builder-content')
        </div>
    </div>
@endsection
