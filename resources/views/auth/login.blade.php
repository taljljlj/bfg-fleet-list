@extends('layouts.common-layout')

@section('common-content')
    <div class="w-full text-center pt-24">
        <div class="section max-w-[600px] mx-auto">
            <h1 class="text-4xl mb-4">Login</h1>

            <form method="POST" action="{{ route('login') }}" class="text-left px-12">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-xl">Email</label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autofocus
                           class="w-full px-4 py-1.5 text-lg bfi-input light-input @error('email') border-red-500 @enderror">
                    @error('email')
                    <p class="text-red-500 text-sm mt-1 font-family-secondary">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-xl">Password</label>
                    <input type="password"
                           id="password"
                           name="password"
                           required
                           class="w-full px-4 py-1.5 text-lg bfi-input light-input @error('password') border-red-500 @enderror">
                    @error('password')
                    <p class="text-red-500 text-sm mt-1 font-family-secondary">{{ $message }}</p>
                    @enderror
                </div>

                <div class="text-center mt-8">
                    <button type="submit"
                            class="btn-primary text-2xl px-8 py-2">
                        Login
                    </button>
                </div>
            </form>

            <div class="mt-6">
                <p class="text-lg">
                    Don't have an account?
                    <a href="{{ route('show-register') }}" class="text-primary-100 hover:opacity-80 underline">Register
                        here</a>
                </p>
            </div>

        </div>
    </div>
@endsection
