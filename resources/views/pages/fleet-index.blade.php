@extends('layouts.builder-layout')

@section('builder-content')
    <div class="section max-w-[600px] mx-auto">
        <div class="section-divider divider-c">
            <form action="{{ route('builder.create') }}" method="POST" class="my-6">
                @csrf
                <button type="submit" class="btn-primary text-2xl px-8 py-2">Create New Fleet</button>
            </form>
        </div>
        <div class="section-divider divider-c my-8">
            <h1 class="text-4xl">My Fleets</h1>
        </div>
        @if($fleets)
            @foreach($fleets as $fleet)
                <div class="section-divider divider-c @auth last @endauth">
                    <span>{{ $fleet->name }} </span>
                    <span>{{ $fleet->points }} </span>
                    <a href="{{ route('builder.edit', $fleet->id) }}" class="btn-primary text-md px-3 py-1">Edit</a>
                </div>
            @endforeach
            @guest
                <div>
                    <p class="font-family-secondary">*Fleets shown here are stored in your session. They’ll disappear once the session expires. To keep permanent access to your fleets, please
                        <a class="text-white underline" href="{{ route('show-register') }}">register</a> or <a class="text-white underline" href="{{ route('show-login') }}">log in</a>.</p>
                </div>
            @endguest
        @endif
    </div>
@endsection
