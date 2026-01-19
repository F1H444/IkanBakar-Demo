@extends('layouts.app')

@section('content')
<section class="pt-28 pb-20 bg-gray-50">
    <div class="max-w-6xl mx-auto px-6">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Hubungi Kami</h1>
            <p class="text-gray-600 max-w-3xl mx-auto">
                IkanBakar siap melayani Anda khusus wilayah <strong>Surabaya</strong>. Silakan hubungi kami untuk pemesanan, kerja sama, atau pertanyaan lainnya.
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-10">
            <!-- Informasi Kontak -->
            <div class="bg-white rounded-xl shadow p-8">
                <h2 class="text-2xl font-bold mb-6">Informasi Kontak</h2>

                <div class="space-y-4 text-gray-700">
                    <p><strong>Alamat:</strong><br>Surabaya, Jawa Timur</p>
                    <p><strong>Jam Operasional:</strong><br>Setiap hari, 10.00 – 22.00 WIB</p>
                    <p><strong>Telepon / WhatsApp:</strong><br>
                        <a href="https://wa.me/628123456789" class="text-green-600 font-semibold hover:underline">+62 812-3456-789</a>
                    </p>
                    <p><strong>Email:</strong><br>info@ikanbakarnusantara.com</p>
                </div>

                <div class="mt-6">
                    <a href="https://wa.me/628123456789" class="inline-block bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700">
                        Pesan via WhatsApp
                    </a>
                </div>
            </div>

            <!-- Form Kontak -->
            <div class="bg-white rounded-xl shadow p-8">
                <h2 class="text-2xl font-bold mb-6">Kirim Pesan</h2>

                <form method="POST" action="#">
                    @csrf
                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Nama</label>
                        <input type="text" name="name" class="w-full border rounded-lg px-4 py-2" placeholder="Nama Anda" required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Email</label>
                        <input type="email" name="email" class="w-full border rounded-lg px-4 py-2" placeholder="Email Anda" required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 font-medium">Pesan</label>
                        <textarea name="message" rows="4" class="w-full border rounded-lg px-4 py-2" placeholder="Tulis pesan Anda..." required></textarea>
                    </div>

                    <button type="submit" class="w-full bg-orange-600 text-white py-3 rounded-lg font-semibold hover:bg-orange-700">
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection