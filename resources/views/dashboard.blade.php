<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - {{ config('app.name', 'Ikan Bakar Nusantara') }}</title>

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
                @if (session('status'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Welcome Card -->
                <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-xl shadow-lg p-8 mb-8 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-3xl font-bold mb-2">Selamat Datang Kembali!</h1>
                            <p class="text-orange-100">Halo <span
                                    class="font-semibold">{{ Auth::user()->name }}</span>,
                                semoga harimu menyenangkan
                            </p>
                        </div>
                        <div class="hidden md:block">
                            <i class="fas fa-user-circle text-8xl text-orange-200 opacity-50"></i>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-orange-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 mb-1 font-medium">Total Pesanan</p>
                                <p class="text-3xl font-bold text-gray-800">0</p>
                                <p class="text-xs text-gray-400 mt-1">Semua waktu</p>
                            </div>
                            <div class="bg-orange-100 p-4 rounded-full">
                                <i class="fas fa-shopping-bag text-orange-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 mb-1 font-medium">Pesanan Aktif</p>
                                <p class="text-3xl font-bold text-gray-800">0</p>
                                <p class="text-xs text-gray-400 mt-1">Sedang diproses</p>
                            </div>
                            <div class="bg-blue-100 p-4 rounded-full">
                                <i class="fas fa-clock text-blue-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 mb-1 font-medium">Pesanan Selesai</p>
                                <p class="text-3xl font-bold text-gray-800">0</p>
                                <p class="text-xs text-gray-400 mt-1">Berhasil diselesaikan</p>
                            </div>
                            <div class="bg-green-100 p-4 rounded-full">
                                <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Aksi Cepat</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        <a href="{{ route('user.orders.index') }}"
                            class="flex flex-col items-center justify-center p-6 bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg hover:shadow-md transition group">
                            <i class="fas fa-history text-3xl text-blue-600 mb-3 group-hover:scale-110 transition"></i>
                            <span class="text-sm font-semibold text-gray-700">Riwayat</span>
                        </a>

                        <a href="{{ route('profile.edit') }}"
                            class="flex flex-col items-center justify-center p-6 bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg hover:shadow-md transition group">
                            <i
                                class="fas fa-user-cog text-3xl text-purple-600 mb-3 group-hover:scale-110 transition"></i>
                            <span class="text-sm font-semibold text-gray-700">Profil</span>
                        </a>

                        <a href="/"
                            class="flex flex-col items-center justify-center p-6 bg-gradient-to-br from-green-50 to-green-100 rounded-lg hover:shadow-md transition group">
                            <i class="fas fa-home text-3xl text-green-600 mb-3 group-hover:scale-110 transition"></i>
                            <span class="text-sm font-semibold text-gray-700">Beranda</span>
                        </a>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold text-gray-800">Aktivitas Terbaru</h2>
                        <a href="{{ route('user.orders.index') }}"
                            class="text-sm text-orange-600 hover:text-orange-700 font-medium">Lihat Semua →</a>
                    </div>
                    <div class="text-center py-12">
                        <div class="inline-block p-6 bg-gray-50 rounded-full mb-4">
                            <i class="fas fa-inbox text-5xl text-gray-300"></i>
                        </div>
                        <p class="text-gray-500 font-medium mb-2">Belum ada aktivitas</p>
                        <p class="text-sm text-gray-400">Pesanan Anda akan muncul di sini</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
