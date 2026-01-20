@php
    $left_image = '/images/ikanbakar2.png';
@endphp
@extends('layouts.auth')

@section('form_header')
    <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-1">Daftar Akun</h2>
    <p class="text-sm text-gray-500">Bergabunglah dengan Ikan Bakar Nusantara.</p>
@endsection

@section('content')
    <!-- Google Register -->
    <div class="mt-1">
        <a href="{{ route('auth.google') }}"
            class="w-full flex items-center justify-center px-4 py-2.5 border border-gray-200 rounded-xl shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-all duration-200 group">
            <img class="h-5 w-5 mr-3 group-hover:scale-110 transition-transform"
                src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google logo">
            Daftar dengan Google
        </a>
    </div>

    <div class="relative my-8">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-100"></div>
        </div>
        <div class="relative flex justify-center text-sm">
            <span class="px-4 bg-white text-gray-400">Atau daftar dengan email</span>
        </div>
    </div>

    <form class="space-y-4" action="{{ route('register') }}" method="POST">
        @csrf

        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
            <input id="name" name="name" type="text" autocomplete="name" required
                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all placeholder:text-gray-300"
                placeholder="Nama Lengkap Anda" value="{{ old('name') }}">
            @error('name')
                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
            <input id="email" name="email" type="email" autocomplete="email" required
                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all placeholder:text-gray-300"
                placeholder="nama@email.com" value="{{ old('email') }}">
            @error('email')
                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                <input id="password" name="password" type="password" autocomplete="new-password" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all placeholder:text-gray-300"
                    placeholder="••••••••">
                @error('password')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all placeholder:text-gray-300"
                    placeholder="••••••••">
                @error('password_confirmation')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <button type="submit"
            class="w-full flex justify-center py-3.5 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 shadow-lg shadow-orange-600/20 transition-all duration-200 active:scale-[0.98] mt-2">
            Daftar Sekarang
        </button>
    </form>
@endsection

@section('form_footer')
    <div class="mt-8 text-center text-xs text-gray-400">
        <p>Dengan mendaftar, Anda menyetujui Ketentuan Layanan dan Kebijakan Privasi kami.</p>
        <p class="mt-6 text-sm text-gray-500">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-bold text-orange-600 hover:text-orange-700 ml-1">
                Masuk di sini
            </a>
        </p>
    </div>
@endsection
