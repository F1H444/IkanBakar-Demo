<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - {{ config('app.name', 'Ikan Bakar Nusantara') }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden bg-gray-100">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white flex-shrink-0 hidden md:flex flex-col">
            <div class="p-6 border-b border-gray-800">
                <a href="/" class="text-2xl font-bold text-orange-500">IkanBakar <span
                        class="text-sm font-normal text-gray-400">User</span></a>
            </div>
            <nav class="flex-grow p-4 space-y-2 overflow-y-auto">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-orange-600' : 'hover:bg-gray-800' }} transition">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('user.orders.index') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('user.orders.*') ? 'bg-orange-600' : 'hover:bg-gray-800' }} transition">
                    <i class="fas fa-receipt"></i>
                    <span>Riwayat Pesanan</span>
                </a>

                <a href="{{ route('profile.edit') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('profile.*') ? 'bg-orange-600' : 'hover:bg-gray-800' }} transition">
                    <i class="fas fa-user-cog"></i>
                    <span>Pengaturan Profil</span>
                </a>

                <a href="/" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition">
                    <i class="fas fa-globe"></i>
                    <span>Ke Beranda</span>
                </a>
            </nav>
            <div class="p-4 border-t border-gray-800">
                <div class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-400">
                    <i class="fas fa-user-circle"></i>
                    <span>{{ Auth::user()->name }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button
                        class="w-full text-left flex items-center space-x-3 px-4 py-2 rounded-lg text-red-400 hover:bg-gray-800 transition">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-grow overflow-y-auto">
            <div class="p-6 md:p-10">
                <!-- Page Header -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Riwayat Pesanan</h1>
                        <p class="text-gray-500 mt-1">Lihat semua pesanan yang pernah Anda buat</p>
                    </div>
                    <a href="/menu"
                        class="mt-4 md:mt-0 bg-orange-600 text-white px-6 py-3 rounded-lg hover:bg-orange-700 transition flex items-center shadow-lg">
                        <i class="fas fa-plus mr-2"></i> Pesan Lagi
                    </a>
                </div>

                @if ($orders->isEmpty())
                    <!-- Empty State -->
                    <div class="bg-white rounded-xl shadow-sm p-12">
                        <div class="text-center">
                            <div class="inline-block p-8 bg-orange-50 rounded-full mb-6">
                                <i class="fas fa-receipt text-7xl text-orange-300"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-700 mb-3">Belum Ada Pesanan</h3>
                            <p class="text-gray-500 mb-8 max-w-md mx-auto">Anda belum memiliki riwayat pesanan.</p>
                        </div>
                    </div>
                @else
                    <!-- Orders List -->
                    <div class="space-y-4">
                        @foreach ($orders as $order)
                            <div
                                class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-lg transition-all duration-200">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                                    <div class="flex items-center space-x-4 mb-4 md:mb-0">
                                        <div class="bg-orange-100 p-3 rounded-lg">
                                            <i class="fas fa-receipt text-orange-600 text-xl"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-gray-800 text-lg">Order #{{ $order->id }}</h3>
                                            <p class="text-sm text-gray-500">
                                                <i class="fas fa-calendar-alt mr-1"></i>
                                                {{ $order->created_at->format('d M Y, H:i') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <span
                                            class="px-4 py-2 rounded-full text-sm font-semibold
                                            {{ $order->status == 'completed' ? 'bg-green-100 text-green-700' : '' }}
                                            {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                            {{ $order->status == 'processing' ? 'bg-blue-100 text-blue-700' : '' }}
                                            {{ $order->status == 'cancelled' ? 'bg-red-100 text-red-700' : '' }}">
                                            <i class="fas fa-circle text-xs mr-1"></i>
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="border-t border-gray-100 pt-4 mt-4">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="text-sm text-gray-500 mb-1">Total Pembayaran</p>
                                            <p class="text-2xl font-bold text-orange-600">Rp
                                                {{ number_format($order->total, 0, ',', '.') }}</p>
                                        </div>
                                        <a href="{{ route('user.orders.show', $order->id) }}"
                                            class="bg-gray-100 hover:bg-orange-600 hover:text-white text-gray-700 px-6 py-3 rounded-lg transition font-medium">
                                            Lihat Detail →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>
        </main>
    </div>
</body>

</html>
