@extends('layouts.app')

@section('content')
<div class="pt-28 pb-20 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-6">
        <h1 class="text-3xl font-bold mb-10 text-center">Daftar Menu Ikan Bakar</h1>

        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-8">
            <!-- Menu Item -->
            <div class="bg-white rounded-xl shadow hover:shadow-lg transition">
                <img src="https://images.unsplash.com/photo-1553621042-f6e147245754" class="rounded-t-xl h-48 w-full object-cover">
                <div class="p-6">
                    <h3 class="font-bold text-xl mb-2">Ikan Bakar Jimbaran</h3>
                    <p class="text-gray-600 mb-3">Ikan segar dengan bumbu khas Bali dan sambal matah.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-orange-600 font-semibold">Rp 35.000</span>
                        <a href="#" class="bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700">Pesan</a>
                    </div>
                </div>
            </div>

            <!-- Menu Item -->
            <div class="bg-white rounded-xl shadow hover:shadow-lg transition">
                <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836" class="rounded-t-xl h-48 w-full object-cover">
                <div class="p-6">
                    <h3 class="font-bold text-xl mb-2">Ikan Bakar Padang</h3>
                    <p class="text-gray-600 mb-3">Pedas gurih dengan racikan rempah Padang.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-orange-600 font-semibold">Rp 32.000</span>
                        <a href="#" class="bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700">Pesan</a>
                    </div>
                </div>
            </div>

            <!-- Menu Item -->
            <div class="bg-white rounded-xl shadow hover:shadow-lg transition">
                <img src="https://images.unsplash.com/photo-1529692236671-f1f6cf9683ba" class="rounded-t-xl h-48 w-full object-cover">
                <div class="p-6">
                    <h3 class="font-bold text-xl mb-2">Ikan Bakar Manado</h3>
                    <p class="text-gray-600 mb-3">Rica-rica pedas segar khas Manado.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-orange-600 font-semibold">Rp 34.000</span>
                        <a href="#" class="bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700">Pesan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
