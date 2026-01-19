@extends('layouts.app')

@section('content')
<section class="pt-28 pb-20 bg-orange-50">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Tentang IkanBakar</h1>
            <p class="text-gray-600 max-w-3xl mx-auto">
                IkanBakar menghadirkan berbagai cita rasa ikan bakar dari seluruh Indonesia, dengan pelayanan khusus untuk wilayah <strong>Surabaya dan sekitarnya</strong>.
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-10 items-center">
            <!-- Text -->
            <div>
                <h2 class="text-2xl font-bold mb-4">Cita Rasa Nusantara, Disajikan untuk Surabaya</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    Kami menyajikan beragam menu ikan bakar khas Nusantara seperti Jimbaran, Padang, hingga Manado. Setiap menu diolah dengan bumbu autentik daerah asalnya agar cita rasa tetap terjaga.
                </p>
                <p class="text-gray-700 leading-relaxed mb-4">
                    Untuk menjaga kualitas dan kecepatan layanan, saat ini <strong>Ikan Bakar Nusantara hanya melayani pemesanan di wilayah Surabaya</strong>. Dengan fokus area layanan, kami memastikan ikan selalu segar dan pesanan sampai tepat waktu.
                </p>
                <p class="text-gray-700 leading-relaxed">
                    Ikan kami berasal dari nelayan lokal Jawa Timur dan diolah setiap hari dengan proses pembakaran tradisional menggunakan arang, menghasilkan aroma dan rasa yang khas.
                </p>
            </div>

            <!-- Image -->
            <div class="flex justify-center">
                <img src="https://images.unsplash.com/photo-1604908177522-42933c47fbd0" alt="Ikan Bakar Nusantara Surabaya" class="rounded-2xl shadow-lg w-full max-w-md">
            </div>
        </div>

        <!-- Values -->
        <div class="mt-20">
            <h2 class="text-2xl font-bold text-center mb-10">Kenapa Memilih Kami?</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl shadow p-6 text-center">
                    <h3 class="font-semibold text-lg mb-2">Menu Nusantara</h3>
                    <p class="text-gray-600">Pilihan ikan bakar dari berbagai daerah di Indonesia.</p>
                </div>
                <div class="bg-white rounded-xl shadow p-6 text-center">
                    <h3 class="font-semibold text-lg mb-2">Fokus Area Surabaya</h3>
                    <p class="text-gray-600">Pengiriman cepat dan kualitas terjaga khusus wilayah Surabaya.</p>
                </div>
                <div class="bg-white rounded-xl shadow p-6 text-center">
                    <h3 class="font-semibold text-lg mb-2">Ikan Segar Harian</h3>
                    <p class="text-gray-600">Bahan baku segar dari nelayan lokal Jawa Timur.</p>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="mt-20 text-center">
            <h2 class="text-2xl font-bold mb-4">Layanan Khusus Wilayah Surabaya</h2>
            <p class="text-gray-600 mb-6">Kami siap melayani pemesanan ikan bakar nusantara untuk Anda yang berada di Surabaya.</p>
            <a href="/menu" class="bg-orange-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-orange-700">Lihat Menu</a>
        </div>
    </div>
</section>
@endsection