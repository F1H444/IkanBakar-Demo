@php
    $left_image = '/images/ikanbakar1.png';
@endphp
@extends('layouts.auth')

@section('form_header')
    <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-1">Selamat Datang</h2>
    <p class="text-sm text-gray-500">Silakan masuk ke akun Anda.</p>
@endsection

@section('content')
    <!-- Google Login -->
    <div class="mt-1">
        <a href="{{ route('auth.google') }}"
            class="w-full flex items-center justify-center px-4 py-2.5 border border-gray-200 rounded-xl shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-all duration-200 group">
            <img class="h-5 w-5 mr-3 group-hover:scale-110 transition-transform"
                src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google logo">
            Masuk dengan Google
        </a>
    </div>

    <div class="relative my-6">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-100"></div>
        </div>
        <div class="relative flex justify-center text-xs">
            <span class="px-4 bg-white text-gray-400">Atau masuk dengan email</span>
        </div>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-6 p-4 rounded-xl bg-green-50 text-green-700 text-sm border border-green-100">
            {{ session('status') }}
        </div>
    @endif

    @if (session('success'))
        <div class="mb-6 p-4 rounded-xl bg-green-50 text-green-700 text-sm border border-green-100">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 p-4 rounded-xl bg-red-50 text-red-700 text-sm border border-red-100">
            {{ session('error') }}
        </div>
    @endif

    <form class="space-y-5" action="{{ route('login') }}" method="POST">
        @csrf
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
            <input id="email" name="email" type="email" autocomplete="email" required
                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all placeholder:text-gray-300"
                placeholder="nama@email.com" value="{{ old('email') }}">
            @error('email')
                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <div class="flex items-center justify-between mb-2">
                <label for="password" class="text-sm font-semibold text-gray-700">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="text-xs font-semibold text-orange-600 hover:text-orange-700">
                        Lupa password?
                    </a>
                @endif
            </div>
            <input id="password" name="password" type="password" autocomplete="current-password" required
                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all placeholder:text-gray-300"
                placeholder="••••••••">
            @error('password')
                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="w-full flex justify-center py-3.5 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 shadow-lg shadow-orange-600/20 transition-all duration-200 active:scale-[0.98]">
            Masuk ke Akun
        </button>
    </form>
@endsection

@section('form_footer')
    <div class="mt-10 text-center">
        <p class="text-sm text-gray-500">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-bold text-orange-600 hover:text-orange-700 ml-1">
                Daftar sekarang gratis
            </a>
        </p>
    </div>
@endsection
