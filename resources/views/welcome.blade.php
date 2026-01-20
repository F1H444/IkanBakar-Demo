@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section id="home" class="pt-28 bg-gradient-to-r from-orange-500 to-red-500 text-white">
        <div class="max-w-7xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-10 items-center">
            <div>
                <h2 class="text-4xl md:text-5xl font-bold leading-tight mb-6">
                    Nikmati Ikan Bakar <br> Paling Lezat & Fresh
                </h2>
                <p class="mb-8 text-lg">
                    Ikan segar pilihan, dibakar dengan bumbu khas nusantara.
                    Cocok untuk keluarga & acara spesial.
                </p>
                <a href="#menu" class="bg-white text-orange-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100">
                    Lihat Menu
                </a>
            </div>
            <div class="flex justify-center">
                <img src="https://images.unsplash.com/photo-1604908177522-42933c47fbd0"
                    class="rounded-2xl shadow-xl w-full max-w-md">
            </div>
        </div>
    </section>

    <!-- Menu Section -->
    <section id="menu" class="py-20">
        <div class="max-w-7xl mx-auto px-6">
            <h3 class="text-3xl font-bold text-center mb-12">Menu Favorit</h3>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                    $menus = \App\Models\Menu::where('status', 'Tersedia')->take(6)->get();
                @endphp

                @foreach ($menus as $menu)
                    <div
                        class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 flex flex-col h-full overflow-hidden">
                        <!-- Image -->
                        <div class="relative overflow-hidden h-56">
                            <img src="{{ Str::startsWith($menu->image, 'http') ? $menu->image : asset($menu->image) }}"
                                alt="{{ $menu->name }}"
                                class="w-full h-full object-cover transform hover:scale-110 transition duration-500">

                            <!-- Status Badge -->
                            <div class="absolute top-4 right-4">
                                <span class="px-3 py-1 rounded-full text-xs font-bold shadow-lg bg-green-500 text-white">
                                    <i class="fas fa-check-circle mr-1"></i> Tersedia
                                </span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6 flex flex-col flex-grow">
                            <h4 class="text-xl font-bold text-gray-800 mb-2">{{ $menu->name }}</h4>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2 flex-grow">{{ $menu->description }}</p>

                            <!-- Price and Action -->
                            <div class="flex justify-between items-center mt-auto pt-4 border-t border-gray-100">
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Harga</p>
                                    <p class="text-xl font-bold text-orange-600">
                                        Rp {{ number_format($menu->price, 0, ',', '.') }}
                                    </p>
                                </div>
                                <a href="{{ route('menu.index') }}"
                                    class="bg-orange-600 hover:bg-orange-700 text-white px-5 py-2.5 rounded-lg font-semibold transition shadow-lg hover:shadow-xl text-sm">
                                    <i class="fas fa-shopping-cart mr-2"></i>Pesan
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- About -->
    <section id="about" class="bg-orange-50 py-20">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <h3 class="text-3xl font-bold mb-6">Tentang Kami</h3>
            <p class="text-gray-700 leading-relaxed">
                Ikan Bakar Nusantara menyajikan aneka ikan bakar khas Indonesia
                dengan bahan segar dan bumbu autentik. Saat ini kami melayani
                pemesanan khusus wilayah <strong>Surabaya</strong>.
            </p>
        </div>
    </section>

    <!-- Contact -->
    <section id="contact" class="py-20">
        <div class="max-w-5xl mx-auto px-6">
            <h3 class="text-3xl font-bold text-center mb-12">Hubungi Kami</h3>

            <div class="bg-white rounded-xl shadow p-8 max-w-xl mx-auto">
                <form>
                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Nama</label>
                        <input type="text" class="w-full border rounded-lg px-4 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Email</label>
                        <input type="email" class="w-full border rounded-lg px-4 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Pesan</label>
                        <textarea rows="4" class="w-full border rounded-lg px-4 py-2"></textarea>
                    </div>

                    <button class="w-full bg-orange-600 text-white py-3 rounded-lg hover:bg-orange-700">
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </section>
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection
