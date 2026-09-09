@extends('layouts.main')

@section('content')
    <div id="commonBody" class="flex-1 bg-cover bg-center bg-no-repeat bg-fixed text-center">
        <div class="content-wrapper px-3 m-auto relative lg:px-5">
            @yield('common-content')
        </div>
    </div>
@endsection
