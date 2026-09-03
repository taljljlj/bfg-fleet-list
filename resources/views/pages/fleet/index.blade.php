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
        @if($fleets->isNotEmpty())
            <div class="section-divider divider-c @auth last @endauth px-12">
                @foreach($fleets as $fleet)
                    <div class="flex flex-row mb-4 items-center">
                        <div class="w-12 h-6 mr-1">
                            @if($fleet->faction)
                                <img src="{{ asset('images/factions/' . $fleet->faction->img_url) }}" alt="Faction Logo">
                            @endif
                        </div>
                        <div class="text-lg mr-4 flex-2/5 truncate text-left">
                            <a href="{{ route('builder.view', $fleet->id) }}" class="hover:underline">{{ $fleet->name }}</a>
                            @if($fleet->fleetList)
                                <span class="font-family-secondary tracking-tight">({{ $fleet->fleetList->name }})</span>
                            @endif
                        </div>
                        <div class="text-xl mr-4">{{ $fleet->points }} pts</div>
                        <div class="flex align-middle">
                            <a href="{{ route('builder.edit', $fleet->id) }}" class="btn-primary mr-1">
                                <div class="h-7">
                                    <img src="{{ asset('images/fleet-builder/edit-icon.png') }}" alt="Delete" class="hover:opacity-80 p-0.5">
                                </div>
                            </a>

                            <form action="{{ route('builder.delete', $fleet->id) }}" method="POST" class="h-7">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-primary">
                                    <div class="h-7">
                                        <img src="{{ asset('images/fleet-builder/delete-icon.png') }}" alt="Delete" class="hover:opacity-80 p-0.5">
                                    </div>
                                </button>
                            </form>
                        </div>
                    </div>
              @endforeach
            </div>
            @guest
                <div>
                    <p class="font-family-secondary">*Fleets shown here are stored in your session. They’ll disappear once the session expires. To keep permanent access to your fleets, please
                        <a class="text-white underline" href="{{ route('show-register') }}">register</a> or <a class="text-white underline" href="{{ route('show-login') }}">log in</a>.</p>
                </div>
            @endguest
        @else
            <div>
                <h3 class="text-2xl my-24">No fleets detected. Click "Create New Fleet" button to continue.</h3>
            </div>
        @endif
    </div>
@endsection
