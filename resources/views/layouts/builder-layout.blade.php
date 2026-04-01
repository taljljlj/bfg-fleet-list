@extends('layouts.main')

@section('content')
    <div id="fleetBuilderBody" class="flex-1 bg-cover bg-center bg-no-repeat bg-fixed text-center">
        <div class="content-wrapper px-5 m-auto relative">
            @yield('builder-content')
        </div>
    </div>
@endsection
