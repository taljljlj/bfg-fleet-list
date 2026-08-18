@extends('layouts.common-layout')

@section('common-content')
    <div class="w-full text-center pt-24">
        <div class="section max-w-[600px] mx-auto">
            <h1 class="text-4xl mb-4">Reset Password</h1>
            @if (session('status'))
                <div class="mb-4 text-primary-100 font-family-secondary" role="status">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}" class="text-left px-12">
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

                <div class="text-center mt-8">
                    <button type="submit"
                            class="btn-primary text-2xl px-8 py-2">
                        Send Reset Link
                    </button>
                </div>
            </form>

            <div class="mt-6">
                <p class="text-lg">
                    Remember your password?
                    <a href="{{ route('show-login') }}" class="text-primary-100 hover:opacity-80 underline">Login
                        here</a>
                </p>
            </div>

        </div>
    </div>
@endsection
