@extends('layouts.common-layout')

@section('common-content')
    <div class="w-full text-center pt-4">
        <div class="section max-w-[600px] mx-auto">
            <h1 class="text-4xl mb-4">Register</h1>

            <form method="POST" action="{{ route('register') }}" class="text-left px-12">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-xl">Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autofocus
                        class="w-full px-4 py-1.5 text-lg bfi-input light-input"
                    >
                    @error('name')
                    <span class="text-red-400 text-sm mt-1 block font-family-secondary">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-xl">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        class="w-full px-4 py-1.5 text-lg bfi-input light-input"
                    >
                    @error('email')
                    <span class="text-red-400 text-sm mt-1 block font-family-secondary">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-xl">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        class="w-full px-4 py-1.5 text-lg bfi-input light-input"
                    >
                    @error('password')
                    <span class="text-red-400 text-sm mt-1 block font-family-secondary">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password Confirmation -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-xl">Confirm Password</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        required
                        class="w-full px-4 py-1.5 text-lg bfi-input light-input"
                    >
                </div>

                <!-- Submit Button -->
                <div class="text-center mt-8">
                    <button type="submit" class="btn-primary text-2xl px-8 py-2">
                        Register
                    </button>
                </div>
            </form>

            <div class="mt-6">
                <p class="text-lg">
                    Already have an account?
                    <a href="{{ route('show-login') }}" class="text-primary-100 hover:opacity-80 underline">Login
                        here</a>
                </p>
            </div>
        </div>
    </div>
@endsection
