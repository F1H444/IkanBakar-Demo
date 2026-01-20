<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - {{ config('app.name', 'Ikan Bakar Nusantara') }}</title>

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

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white flex-shrink-0 hidden md:flex flex-col">
            <div class="p-6 border-b border-gray-800">
                <a href="/" class="text-2xl font-bold text-orange-500">IkanBakar <span
                        class="text-sm font-normal text-gray-400">Admin</span></a>
            </div>
            <nav class="flex-grow p-4 space-y-2 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-orange-600' : 'hover:bg-gray-800' }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.menus.index') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.menus.*') ? 'bg-orange-600' : 'hover:bg-gray-800' }}">
                    <i class="fas fa-utensils"></i>
                    <span>Kelola Menu</span>
                </a>
                <a href="{{ route('admin.orders.index') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.orders.*') ? 'bg-orange-600' : 'hover:bg-gray-800' }}">
                    <i class="fas fa-receipt"></i>
                    <span>Kelola Pesanan</span>
                </a>
                <a href="/" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800">
                    <i class="fas fa-globe"></i>
                    <span>Lihat Website</span>
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
                        class="w-full text-left flex items-center space-x-3 px-4 py-2 rounded-lg text-red-400 hover:bg-gray-800">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-grow overflow-y-auto">
            <!-- Header -->
            <header class="bg-white shadow px-6 py-4 flex justify-between items-center sm:hidden">
                <a href="/" class="text-xl font-bold text-orange-600">IkanBakar</a>
                <button class="text-gray-600 focus:outline-none">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </header>

            <div class="p-6 md:p-10">
                @if (session('status'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

</body>

</html>
