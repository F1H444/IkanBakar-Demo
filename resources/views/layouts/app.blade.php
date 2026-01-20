<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Ikan Bakar Nusantara') }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50">

    <!-- Navbar -->
    <nav class="bg-white shadow fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-orange-600">IkanBakar</a>

            <ul class="hidden md:flex space-x-8 font-medium">
                <li><a href="/" class="hover:text-orange-600">Home</a></li>
                <li><a href="/menu" class="hover:text-orange-600">Menu</a></li>
                @auth
                    <li><a href="/dashboard" class="hover:text-orange-600">Dashboard</a></li>
                @endauth
                <li><a href="/tentang" class="hover:text-orange-600">Tentang</a></li>
                <li><a href="/kontak" class="hover:text-orange-600">Kontak</a></li>
            </ul>

            <div class="flex items-center space-x-4">
                @guest
                    <a href="/login" class="text-gray-700 hover:text-orange-600 font-medium transition">Login</a>
                    <a href="/register"
                        class="border border-orange-600 text-orange-600 px-4 py-2 rounded-full hover:bg-orange-600 hover:text-white transition font-medium">Register</a>
                @else
                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                            class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-sm font-semibold hover:bg-orange-200 transition">
                            <i class="fas fa-user-shield mr-1"></i> Admin Panel
                        </a>
                    @endif

                    <div class="flex items-center space-x-3 pl-4 border-l border-gray-200">
                        <div class="text-right hidden sm:block">
                            <div class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-gray-500 uppercase tracking-wider">{{ Auth::user()->role }}</div>
                        </div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button
                                class="bg-gray-100 hover:bg-red-50 text-gray-600 hover:text-red-600 p-2 rounded-full transition"
                                title="Logout">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                            </button>
                        </form>
                    </div>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="pt-24">
        @yield('content')
        {{ $slot ?? '' }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 py-6 mt-20 text-center">
        <p>© {{ date('Y') }} Ikan Bakar Nusantara. All rights reserved.</p>
    </footer>

</body>

</html>
