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

        <div class="grid md:grid-cols-3 gap-8">
            @php
                $menus = [
                    ['nama'=>'Ikan Bakar Jimbaran','harga'=>'35.000','desc'=>'Bumbu khas Bali dengan sambal matah','img'=>'1553621042-f6e147245754'],
                    ['nama'=>'Ikan Bakar Padang','harga'=>'32.000','desc'=>'Pedas gurih dengan bumbu rempah','img'=>'1504674900247-0877df9cc836'],
                    ['nama'=>'Ikan Bakar Manado','harga'=>'34.000','desc'=>'Rica-rica pedas segar','img'=>'1529692236671-f1f6cf9683ba'],
                ];
            @endphp

            @foreach($menus as $menu)
            <div class="bg-white rounded-xl shadow hover:shadow-lg transition">
                <img src="https://images.unsplash.com/photo-{{ $menu['img'] }}"
                     class="rounded-t-xl h-48 w-full object-cover">
                <div class="p-6">
                    <h4 class="font-bold text-xl mb-2">{{ $menu['nama'] }}</h4>
                    <p class="text-gray-600 mb-4">{{ $menu['desc'] }}</p>
                    <p class="font-semibold text-orange-600">Rp {{ $menu['harga'] }}</p>
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

@endsection
