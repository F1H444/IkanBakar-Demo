@php
    $single_panel = true;
    $width = 'max-w-md';
@endphp
@extends('layouts.auth')

@section('form_header')
    <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-1">Reset Password</h2>
    <p class="text-sm text-gray-500">Masukkan password baru Anda.</p>
@endsection

@section('content')
    <!-- Session Status -->
    @if (session('error'))
        <div class="mb-6 p-4 rounded-xl bg-red-50 text-red-700 text-sm border border-red-100 flex items-start">
            <svg class="h-5 w-5 text-red-400 mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                    clip-rule="evenodd" />
            </svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <!-- Form -->
    <form method="POST" action="{{ route('password.store') }}" class="mt-4 space-y-6">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">

        <div class="space-y-4">
            <!-- Email (readonly) -->
            <div>
                <label for="email-display" class="block text-sm font-semibold text-gray-700 mb-2">
                    Email Anda
                </label>
                <input id="email-display" type="email" value="{{ $email }}" readonly
                    class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 text-gray-400 cursor-not-allowed outline-none">
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                    Password Baru
                </label>
                <input id="password" name="password" type="password" required autocomplete="new-password"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all placeholder:text-gray-300 @error('password') border-red-500 @enderror"
                    placeholder="Minimal 8 karakter">
                @error('password')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Confirmation -->
            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                    Konfirmasi Password
                </label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                    autocomplete="new-password"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all placeholder:text-gray-300"
                    placeholder="Ulangi password baru">
            </div>
        </div>

        @error('token')
            <div class="p-4 rounded-xl bg-red-50 text-red-700 text-sm border border-red-100 flex items-start">
                <svg class="h-5 w-5 text-red-400 mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                        clip-rule="evenodd" />
                </svg>
                <span>{{ $message }}</span>
            </div>
        @enderror

        <div>
            <button type="submit"
                class="w-full flex justify-center py-3.5 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 shadow-lg shadow-orange-600/20 transition-all duration-200 active:scale-[0.98]">
                Atur Ulang Password
            </button>
        </div>
    </form>
@endsection

@section('form_footer')
    <div class="mt-10 text-center">
        <a href="{{ route('login') }}" class="font-bold text-orange-600 hover:text-orange-700 text-sm">
            Kembali ke Login
        </a>
    </div>
@endsection
