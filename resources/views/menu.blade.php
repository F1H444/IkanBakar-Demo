@extends('layouts.app')

@section('content')
    <div class="pt-28 pb-20 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-6">
            <h1 class="text-3xl font-bold mb-10 text-center">Daftar Menu Ikan Bakar</h1>

            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-8">
                @foreach (\App\Models\Menu::all() as $menu)
                    <!-- Menu Item -->
                    <div class="bg-white rounded-xl shadow hover:shadow-lg transition flex flex-col h-full">
                        <img src="{{ Str::startsWith($menu->image, 'http') ? $menu->image : asset($menu->image) }}"
                            alt="{{ $menu->name }}" class="w-full h-48 object-cover rounded-t-xl">
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-xl font-bold">{{ $menu->name }}</h3>
                                <span class="px-2 py-1 bg-orange-100 text-orange-700 text-xs font-bold rounded">
                                    {{ $menu->category }}
                                </span>
                            </div>
                            <p class="text-gray-600 text-sm mb-4">{{ $menu->description }}</p>
                            <div class="mt-auto flex justify-between items-center">
                                <span class="text-orange-600 font-bold">Rp
                                    {{ number_format($menu->price, 0, ',', '.') }}</span>
                                <span
                                    class="text-xs {{ $menu->status == 'Tersedia' ? 'text-green-600' : 'text-red-600' }} font-semibold">
                                    {{ $menu->status }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
